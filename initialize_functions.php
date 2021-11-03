<?php
/*
Plugin Name: OpenBroker
Plugin URI: https://www.openbroker.com/
Description: Build your Real Estate website within 4 minutes. Official WordPress plugin for OpenBroker.com integration.
Author: teamopenbroker
Version: 1.0
*/

define( 'OPENBROKER_PLUGIN_PATH', plugins_url( '', __FILE__ ) );

class WPM_Core {

	private $settings;

	/**
	 * Initialize functions
	 */
	public function __construct() {
		// Init Functions
		add_action( 'init', [ $this, 'save_settings' ] );
		add_action( 'init', [ $this, 'load_settings' ] );

		// Include Styles and Scripts
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_scripts_and_styles' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'include_scripts_and_styles' ], 99 );

		// Redirect to API Single property
		add_filter( 'status_header', [ $this, 'api_properties_page_redirect' ], - 1 );

		// Admin menu
		add_action( 'admin_menu', [ $this, 'register_menu' ] );

		// Ajax Functions
		add_action( 'wp_ajax_load_cities', [ $this, 'load_cities_list' ] );
		add_action( 'wp_ajax_nopriv_load_cities', [ $this, 'load_cities_list' ] );
		add_action( 'wp_ajax_get_ajax_properties', [ $this, 'get_ajax_properties' ] );
		add_action( 'wp_ajax_nopriv_get_ajax_properties', [ $this, 'get_ajax_properties' ] );
		add_action( 'wp_ajax_send_form_agency', [ $this, 'send_form_agency' ] );
		add_action( 'wp_ajax_nopriv_send_form_agency', [ $this, 'send_form_agency' ] );

		// Create Shortcodes
		add_shortcode( 'openbroker', [ $this, 'create_shortcode' ] );
	}

	/**
	 * Send Modal Form to Agency
	 */
	public function send_form_agency() {
		if ( isset( $_POST['firstname_agency'] ) && isset( $_POST['lastname_agency'] ) ) {
			$data = [
				'first_name' => sanitize_text_field( $_POST['firstname_agency'] ),
				'last_name'  => sanitize_text_field( $_POST['lastname_agency'] ),
				'email'      => sanitize_text_field( $_POST['email_agency'] ),
				'phone'      => sanitize_text_field( $_POST['phone_agency'] ),
				'message'    => sanitize_text_field( $_POST['message_agency'] ),
				'data'       => []
			];

			$response = wp_remote_post( $this->settings['api_url'] . '/leads', array(
				'method'  => 'POST',
				"timeout" => 100,
				'headers' => [
					"Content-type" => "application/json",
					"Accept"       => "application/json",
					"APP_ID"       => $this->settings['app_id'],
					"API_KEY"      => $this->settings['api_key']
				],
				'body'    => json_encode( $data ),
			) );

			$res = json_decode( $response['body'], true );
			if ( isset( $res['status'] ) && $res['status'] == 'SUCCESS' ) {
				wp_send_json( [ 'status' => 'true' ] );
			}
		}
	}

	/**
	 * Create ShortCode
	 */
	public function create_shortcode( $args ) {
		// Clean Args
		$args = array_map( 'sanitize_text_field', $args );

		// Configure properties View
		$items_row        = 4;
		$size_description = 150;
		$content          = '';

		// Change Default Settings if Isset
		if ( isset( $args['row_items'] ) ) {
			$items_row = $args['row_items'];
		}
		if ( isset( $args['size_description'] ) ) {
			$size_description = $args['size_description'];
		}

		// Prepare String for Get Properties
		$filters = '';
		if ( isset( $args ) ) {
			foreach ( $args as $filter_name => $filter_value ) {
				$filters .= "$filter_name=$filter_value";
			}
		}

		// Check which Template is Using
		if ( isset( $args['template'] ) && $args['template'] == 'only_properties' ) {
			// Get Properties by Shortcode Args
			$properties_list = $this->properties_type( 'ajax_filter', $filters );

			// Get Template
			ob_start();
			include( 'templates/frontend/catalog/only-properties.php' );
			$content = ob_get_clean();
		} elseif ( isset( $args['template'] ) && $args['template'] == 'properties-search' ) {
			// Get Template
			ob_start();
			include( 'templates/frontend/search/properties-search.php' );
			$content = ob_get_clean();
		}

		return $content;
	}

	/**
	 * Get Properties from Ajax Search
	 */
	public function get_ajax_properties() {
		if ( isset( $_POST['filters'] ) ) {
			$filters     = [];
			$tmp_filters = (array) $_POST['filters'];
			foreach ( $tmp_filters as $filter_key => $filter_value ) {
				$filters[ $filter_key ] = sanitize_text_field( $filter_value );
			}

			$properties_list = $this->properties_type( 'ajax_filter', $filters );

			if ( isset( $_POST['shortcode'] ) ) {
				$shortcode = sanitize_text_field( $_POST['shortcode'] );
			}

			// Configure properties View
			$items_row        = 4;
			$size_description = 150;
			$filters_array    = [];
			foreach ( $filters as $filter ) {
				$data                      = explode( '=', $filter );
				$filters_array[ $data[0] ] = $data[1];
			}

			// Check if Default Value is Changed
			if ( isset( $filters_array['row_items'] ) ) {
				$items_row = $filters_array['row_items'];
			}
			if ( isset( $filters_array['size_description'] ) ) {
				$size_description = $filters_array['size_description'];
			}

			// Load Template for Properties
			ob_start();
			if ( isset( $_POST['template'] ) && $_POST['template'] == 'admin_properties' ) {
				include( 'templates/admin/ajax_properties.php' );
			} elseif ( isset( $_POST['template'] ) && $_POST['template'] == 'only_properties' ) {
				include( 'templates/frontend/catalog/only-properties.php' );
			}
			$content = ob_get_clean();

			// Load Template for Filters
			ob_start();
			include( 'templates/frontend/search/properties-search.php' );
			$search_filter = ob_get_clean();

			// Return Answer to Ajax
			wp_send_json( [
				'status'  => 'true',
				'content' => $content,
				'search'  => $search_filter
			] );
		}
	}

	/**
	 * Load Data from API
	 */
	public function properties_type( $type, $object = null ) {
		if ( $type == 'ajax_filter' ) {
			$objects_list = $this->get_properties_data( "/properties/?" . implode( '&', $object ) );
		} elseif ( $type == 'similar_objects' && $object ) {
			// Set Settings before Get properties
			$num_posts = 4;
			$beds      = isset( $object['beds'] ) && $object['beds'] > 0 ? $object['beds'] : '';
			$baths     = isset( $object['baths'] ) && $object['baths'] > 0 ? $object['baths'] : '';
			$prop_type = isset( $object['property_type'] ) ? $object['property_type'] : '';
			$price     = isset( $object['price'] ) ? (int) $object['price'] : 0;

			$fireplace        = $object['climate_control']['fireplace'] == 1 ? 'true' : '';
			$balcony          = $object['feature']['has_balcony'] == 1 ? 'true' : '';
			$garage           = ! empty( array_keys( array_filter( $object['parking'] ) ) ) ? 'true' : '';
			$elevator         = $object['feature']['has_elevator'] == 1 ? 'true' : '';
			$air_conditioning = $object['climate_control']['air_conditioning'] == 1 ? 'true' : '';
			$pool             = ! empty( array_keys( array_filter( $object['pool'] ) ) ) ? 'true' : '';
			$security         = ! empty( array_keys( array_filter( $object['security'] ) ) ) ? 'true' : '';
			$garden           = $object['view']['garden'] == 1 ? 'true' : '';
			$furnished        = $object['furniture'] == 'furnished' ? 'true' : '';
			$exclusive        = $object['exclusive'] != '' ? 'true' : '';

			// Range Price Similar Objects
			$discount  = 40;
			$price_min = $price - ( $price * ( $discount / 100 ) );
			$price_max = $price + ( $price * ( $discount / 100 ) );

			// Get Objects from API
			$objects_list = $this->get_properties_data( "/properties/?max_price={$price_max}&min_price={$price_min}&exclusive={$exclusive}&is_furnished={$furnished}&has_garden={$garden}&has_security={$security}&has_pool={$pool}&has_ac={$air_conditioning}&has_elevator={$elevator}&has_parking={$garage}&has_balcony={$balcony}&has_fireplace={$fireplace}&per_page={$num_posts}&property_type={$prop_type}&beds={$beds}&baths={$baths}" );
		} elseif ( $type == 'city_list' && $object ) {
			$objects_list = $this->get_properties_data( "/search_areas?query={$object}" );
		}

		return $objects_list;
	}

	/**
	 * Load Cities List Ajax
	 */
	public function load_cities_list() {
		$url_query = str_replace( ' ', '+', sanitize_text_field( $_POST['search'] ) );

		wp_send_json( $this->properties_type( 'city_list', $url_query ) );
	}

	/**
	 * Get Properties from OpenBroker
	 */
	public function get_properties_data( $url_query ) {
		$response = wp_remote_post( $this->settings['api_url'] . $url_query, array(
			'method'  => 'GET',
			"timeout" => 100,
			'headers' => [
				"Content-type" => "application/json",
				"APP_ID"       => $this->settings['app_id'],
				"API_KEY"      => $this->settings['api_key']
			]
		) );

		return json_decode( $response['body'], true );
	}

	/**
	 * Try to map virtual URI with property
	 */
	public function api_properties_page_redirect( $header ) {
		global $wp_query, $post, $page_name;

		if ( is_404() ) {
			// Get Request URL Parts
			$url  = parse_url( sanitize_url( $_SERVER['REQUEST_URI'] ) );
			$path = explode( '/', $url['path'] );

			// Search property ID in URL
			foreach ( $path as $name ) {
				if ( strpos( $name, "house_" ) !== false ) {
					$object_id = $name;
				}
			}

			// Check if its property ID from API
			if ( isset( $object_id ) ) {
				// Configure WP Query
				$post                        = get_post( $this->settings['single_property'] );
				$wp_query->queried_object    = $post;
				$wp_query->is_single         = true;
				$wp_query->is_404            = false;
				$wp_query->queried_object_id = $post->ID;
				$wp_query->post_count        = 1;
				$wp_query->current_post      = - 1;
				$wp_query->posts             = array( $post );

				// Get property Data
				$object = $this->get_properties_data( "/properties/$object_id" );
				$object = $object['data'];
				$beds   = $object['beds'];

				// Get Similar Properties
				$objects_similar = $this->properties_type( 'similar_objects', $object );

				// Create new Title for Page
				if ( $beds != '' ) {
					$page_name = $beds . ' Bedroom ' . ucwords( $object['property_type'] );
				} else {
					$page_name = ucwords( $object['property_type'] );
				}

				// Set H1 title on Page
				$post->post_title = $page_name;

				// Set Meta Title to Page
				add_filter( 'pre_get_document_title', function ( $title ) {
					global $page_name;

					return $page_name;
				}, 99 );

				// Set Content on Shortcode to Page
				add_filter( 'the_content', function ( $content ) use ( $object, $objects_similar ) {
					global $post;

					// Load Template for Properties
					ob_start();
					include( 'templates/frontend/page/single-property.php' );
					$template = ob_get_clean();

					// Search Shortcode and Replace it
					$new_content = str_replace( "[openbroker template='single-property']", $template, $post->post_content );

					return $new_content;
				}, 99 );

				if ( strpos( sanitize_url( $_SERVER['REQUEST_URI'] ), "house_" ) !== false && isset( $object['property_type'] ) ) {
					$header = "HTTP/1.0 200 OK";
				}
			}
		}

		return $header;
	}

	/**
	 * Save Core Settings to Option
	 */
	public function save_settings() {
		if ( isset( $_POST['wpm_core'] ) && is_array( $_POST['wpm_core'] ) ) {
			$data         = [];
			$tmp_wpm_core = (array) $_POST['wpm_core'];
			foreach ( $tmp_wpm_core as $wpm_core_key => $wpm_core_value ) {
				$data[ $wpm_core_key ] = sanitize_text_field( $wpm_core_value );
			}

			update_option( 'wpm_core', json_encode( $data ) );
		}
	}

	/**
	 * Load Saved Settings
	 */
	public function load_settings() {
		$this->settings = json_decode( get_option( 'wpm_core' ), true );
	}

	/**
	 * Include Scripts And Styles on Admin Pages
	 */
	public function admin_scripts_and_styles() {
		// Register styles
		wp_enqueue_style( 'wpm-core-selectstyle', plugins_url( 'templates/libs/selectstyle/selectstyle.css', __FILE__ ) );
		wp_enqueue_style( 'wpm-font-awesome', plugins_url( 'templates/libs/font-awesome/scripts/all.min.css', __FILE__ ) );
		wp_enqueue_style( 'wpm-core-tips', plugins_url( 'templates/libs/tips/tips.css', __FILE__ ) );
		wp_enqueue_style( 'wpm-core-select2', plugins_url( 'templates/libs/select2/select2.min.css', __FILE__ ) );
		wp_enqueue_style( 'wpm-core-lightzoom', plugins_url( 'templates/libs/lightzoom/style.css', __FILE__ ) );
		wp_enqueue_style( 'wpm-core-modal', plugins_url( 'templates/libs/jquery-modal/jquery.modal.min.css', __FILE__ ) );
		wp_enqueue_style( 'wpm-core-admin', plugins_url( 'templates/assets/css/admin.css', __FILE__ ) );

		// Register Scripts
		wp_enqueue_script( 'wpm-core-selectstyle', plugins_url( 'templates/libs/selectstyle/selectstyle.js', __FILE__ ) );
		wp_enqueue_script( 'wpm-font-awesome', plugins_url( 'templates/libs/font-awesome/scripts/all.min.js', __FILE__ ) );
		wp_enqueue_script( 'wpm-core-tips', plugins_url( 'templates/libs/tips/tips.js', __FILE__ ) );
		wp_enqueue_script( 'wpm-core-select2', plugins_url( 'templates/libs/select2/select2.min.js', __FILE__ ) );
		wp_enqueue_script( 'wpm-core-lightzoom', plugins_url( 'templates/libs/lightzoom/lightzoom.js', __FILE__ ) );
		wp_enqueue_script( 'wpm-core-modal', plugins_url( 'templates/libs/jquery-modal/jquery.modal.min.js', __FILE__ ) );
		wp_enqueue_script( 'wpm-core-admin', plugins_url( 'templates/assets/js/admin.js', __FILE__ ) );
		wp_localize_script( 'wpm-core-admin', 'admin', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
		wp_enqueue_script( 'wpm-core-admin' );
	}

	/**
	 * Include Scripts And Styles on FrontEnd
	 */
	public function include_scripts_and_styles() {
		// Register styles
		wp_enqueue_style( 'wpm-core', plugins_url( 'templates/assets/css/frontend.css', __FILE__ ), false, '1.0.0', 'all' );
		wp_enqueue_style( 'wpm-font-awesome', plugins_url( 'templates/libs/font-awesome/scripts/all.min.css', __FILE__ ) );
		wp_enqueue_style( 'responsiveslides', plugins_url( 'templates/libs/rslides/responsiveslides.css', __FILE__ ) );

		// Register scripts
		wp_enqueue_script( 'wpm-font-awesome', plugins_url( 'templates/libs/font-awesome/scripts/all.min.js', __FILE__ ) );
		wp_enqueue_script( 'responsiveslides', plugins_url( 'templates/libs/rslides/responsiveslides.min.js', __FILE__ ) );
		wp_register_script( 'wpm-core', plugins_url( 'templates/assets/js/frontend.js', __FILE__ ), array( 'jquery' ), '1.0.0', 'all' );
		wp_localize_script( 'wpm-core', 'admin', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
		wp_enqueue_script( 'wpm-core' );
	}

	/**
	 * Add Settings to Admin Menu
	 */
	public function register_menu() {
		add_menu_page( 'OpenBroker', 'OpenBroker', 'edit_others_posts', 'wpm_core_settings' );
		add_submenu_page( 'wpm_core_settings', 'OpenBroker', 'OpenBroker', 'manage_options', 'wpm_core_settings', function () {
			global $wp_version, $wpdb;

			// Get Saved Settings
			$settings = $this->settings;

			// Get Pages
			$args = array(
				'post_type'      => 'page',
				'orderby'        => 'desc',
				'posts_per_page' => - 1
			);

			$pages = get_posts( $args );

			include 'templates/admin/settings.php';
		} );
	}
}

new WPM_Core();