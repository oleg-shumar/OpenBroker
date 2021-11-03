<div class="properties-list-items">
	<?php if ( count( $objects_similar['data'] ) > 0 ) { ?>
        <style>
            .properties-list-items .items-properties .item-property {
                width: <?php echo esc_html ( 100 / max($items_row, 1) - 1 ) ?>%;
            }
        </style>
        <div class="items-properties">
			<?php

			$exlude_id = $object['id'];
			$added     = 0;

			foreach ( $objects_similar['data'] as $object ) {
				if ( $object['id'] != $exlude_id ) { ?>
                    <div class="item-property">
                        <div class="item-property-image">
                            <a href="<?php echo esc_attr( get_home_url() . "/property/" . $object['id'] ) ?>" target="_blank"> <img src="<?php echo esc_attr( $object['pictures'][0]['url'] ) ?>" alt=""> </a>
                        </div>
                        <div class="item-property-title">
                            <a href="<?php echo esc_attr( get_home_url() . "/property/" . esc_html( $object['id'] ) ) ?>" target="_blank">
								<?php echo esc_html( ucfirst( $object['property_type'] . " in " . $object['address']['city'] . ", " . $object['address']['province'] ) ) ?>
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
					<?php
					$added ++;
					if ( $added == 3 ) {
						break;
					}
				}
			} ?>
        </div>
	<?php } else { ?>
        <div class="no-properties-found">No Properties Found. Please, change your filters.</div>
	<?php } ?>
</div>