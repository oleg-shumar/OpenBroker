<div class="single-property-content">
	<?php if ( isset( $object['pictures'] ) && count( $object['pictures'] ) > 0 ) { ?>
        <div class="slides-row">
            <ul class="rslides">
				<?php foreach ( $object['pictures'] as $image ) { ?>
                    <li><img src="<?php echo esc_attr( $image['url'] ); ?>" alt=""></li>
				<?php } ?>
            </ul>
            <ul id="slider-pager">
				<?php foreach ( $object['pictures'] as $image ) { ?>
                    <li><a href="#"><img src="<?php echo esc_attr( $image['url'] ); ?>" alt=""></a></li>
				<?php } ?>
            </ul>
        </div>
	<?php } ?>
    <div class="main-features">
        <div class="price-address">
            <div class="address-line"><?php echo esc_html( $object['address']['address_name'] ) ?></div>
            <div class="price-line">
				<?php echo esc_html( '€' . number_format( $object['price'], 0, ",", "," ) ) ?>
				<?php if ( $object['exclusive'] != '' ) { ?>
                    <span class="exclusive">Exclusive</span>
				<?php } ?>
            </div>
        </div>
        <ul class="main-features-property">
			<?php if ( isset( $object['built_area_meters'] ) && $object['built_area_meters'] > 0 ) {
				?>
                <li>Area Size: <?php echo esc_html( $object['built_area_meters'] ) ?> m2</li><?php
			} ?><?php if ( isset( $object['beds'] ) && $object['beds'] > 0 ) {
				?>
                <li>Bedrooms: <?php echo esc_html( $object['beds'] ) ?></li><?php
			} ?><?php if ( isset( $object['baths'] ) && $object['baths'] > 0 ) {
				?>
                <li>Bathrooms: <?php echo esc_html( $object['baths'] ) ?></li><?php
			} ?><?php if ( isset( $object['parking']['garage'] ) && $object['parking']['garage'] != '' ) {
				$garage = $object['parking']['garage'];
				?>
                <li>Garages: <?php echo esc_html( $garage ) ?></li><?php
			} ?><?php if ( isset( $object['plot_size_meters'] ) && $object['plot_size_meters'] > 0 ) {
				?>
                <li>Lot Size: <?php echo esc_html( $object['plot_size_meters'] ) ?> m2</li><?php
			} ?><?php if ( isset( $object['ref_number'] ) ) {
				?>
                <li>Property ID: <?php echo esc_html( $object['ref_number'] ) ?></li><?php
			} ?>
        </ul>
        <div class="description-property">
			<?php echo esc_html( $object['descriptions']['english'] ); ?>
        </div>
        <div class="all-features">
            <div class="all-features-title">Features</div>
            <ul class="all-features-list">
				<?php
				$already_added = [];

				// Prepare Features
				$security = array_keys( array_filter( $object['security'] ) );
				$setting  = array_keys( array_filter( $object['setting'] ) );
				$feature  = array_keys( array_filter( $object['feature'] ) );
				$view     = array_keys( array_filter( $object['view'] ) );

				// Security Features
				foreach ( $security as $value ) {
					$already_added[] = $value; ?>
                    <li><?php echo esc_html( ucfirst( str_replace( '_', ' ', esc_html( $value ) ) ) ) ?></li><?php
				}

				// Settings Features
				foreach ( $setting as $value ) {
					if ( ! in_array( $value, $already_added ) ) {
						$already_added[] = $value; ?>
                        <li><?php echo esc_html( ucfirst( str_replace( '_', ' ', esc_html( $value ) ) ) ) ?></li><?php
					}
				}

				// Other Features
				foreach ( $feature as $value ) {
					if ( ! in_array( $value, $already_added ) ) {
						$already_added[] = $value; ?>
                <li><?php echo esc_html( ucfirst( str_replace( '_', ' ', $value ) ) ) ?></li><?php
					}
				}

				// View Features
				foreach ( $feature as $value ) {
					if ( ! in_array( $value, $already_added ) ) {
						$already_added[] = $value;
						?>
                        <li><?php echo esc_html( ucfirst( str_replace( '_', ' ', $value ) ) ) ?></li>
						<?php
					}
				}
				?>
            </ul>
        </div>
    </div>
    <div class="send-message-property">
        <button id="send-to-agency">Send Message to Agency</button>
    </div>
	<?php if ( count( $objects_similar['data'] ) > 2 ) { ?>
        <div class="similar-objects">
            <div class="similar-objects-title">Similar Properties</div>
			<?php
			$items_row        = 3;
			$size_description = 100;

			include( 'similar-properties.php' );
			?>
        </div>
	<?php } ?>
</div>
<div class="send-agency-modal">
    <div class="agency-modal-content">
        <div class="modal-header">Contact our Agency <span id="close-agency-modal">x</span></div>
        <div class="modal-form">
            <div class="modal-double">
                <div class="modal-field">
                    <label for="firstname-agency">First Name</label> <input type="text" id="firstname-agency">
                </div>
                <div class="modal-field">
                    <label for="lastname-agency">Last Name</label> <input type="text" id="lastname-agency">
                </div>
            </div>
            <div class="modal-double">
                <div class="modal-field">
                    <label for="email-agency">Email</label> <input type="text" id="email-agency">
                </div>
                <div class="modal-field">
                    <label for="phone-agency">Phone</label> <input type="text" id="phone-agency">
                </div>
            </div>
            <div class="modal-field">
                <label for="message-agency">Your Message</label> <textarea id="message-agency"><?php echo esc_html( "Property ID: " . $object['ref_number'] ) ?>. Hello! I need this property. Your message...</textarea>
            </div>
            <button id="send-modal-agency">Send Message</button>
            <div class="message-sended">Message is sent! We will contact you soon as possible!</div>
        </div>
    </div>
</div>