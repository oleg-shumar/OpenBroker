<?php if ( count( $properties_list['data'] ) > 0 ) { ?>
    <style>
        .properties-list-items .items-properties .item-property {
            width: <?php echo echo_html ( 100 / max($items_row, 1) - 1 ) ?>%;
        }
    </style>
    <div class="items-properties">
		<?php foreach ( $properties_list['data'] as $object ) { ?>
            <div class="item-property">
                <div class="item-property-image">
                    <a href="<?php echo esc_attr( get_home_url() . "/property/" . esc_html( $object['id'] ) ) ?>" target="_blank"> <img src="<?php echo esc_attr( $object['pictures'][0]['url'] ) ?>" alt=""> </a>
                </div>
                <div class="item-property-title">
                    <a href="<?php echo esc_attr( get_home_url() . "/property/" . esc_html( $object['id'] ) ) ?>" target="_blank">
						<?php echo esc_html( ucfirst( ( $object['property_type'] ) ) . " in " . ( $object['address']['city'] ) . ", " . ( $object['address']['province'] ) ) ?>
                    </a>
                </div>
                <div class="item-property-description">
					<?php echo esc_html( substr( $object['descriptions']['english'], 0, $size_description ) ) ?>...
                </div>
                <div class="item-property-price">
					<?php echo esc_html( '€' . number_format( $object['price'], 0, ",", "," ) ) ?>
                </div>
                <a href="<?php echo esc_attr( get_home_url() . "/property/" . esc_html( $object['id'] ) ) ?>" target="_blank" class="item-property-btn">View property</a>
            </div>
		<?php } ?>
    </div>
	<?php if ( in_array( 'show-pagination=yes', $filters ) ) { ?>
        <div class="pagination-properties">
            <button class="left-page-properties" <?php if ( $properties_list['meta']['current_page'] == 1 ) {
				echo esc_attr( 'disabled' );
			} ?>><i class="fas fa-arrow-left"></i></button>
            <span class="properties-pages">Page: <?php echo esc_html( $properties_list['meta']['current_page'] ) . '/' . esc_html( $properties_list['meta']['total_pages'] ); ?></span>
            <button data-total="<?php echo esc_attr( $properties_list['meta']['total_pages'] ); ?>" class="right-page-properties" <?php if ( $properties_list['meta']['current_page'] == $properties_list['meta']['total_pages'] ) {
				echo esc_attr( 'disabled' );
			} ?>><i class="fas fa-arrow-right"></i></button>
        </div>
	<?php } ?>
    <div class="use-shortcode">
        <div class="use-shortcode-title">Use this Shortcode:</div>
        <div class="shortcode-properties">
			<?php echo esc_html( stripslashes( $shortcode ) ); ?>
        </div>
    </div>
<?php } else { ?>
    <div class="no-properties-found">No Properties Found. Please, change your filters.</div>
	<?php
}