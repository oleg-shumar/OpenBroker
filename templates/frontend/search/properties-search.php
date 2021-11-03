<?php if ( isset( $filters_array ) ) { ?>
    <div class="collections-filters">
        <div class="collections-features-select">Properties Filter</div>
        <div class="collections-options">
            <div class="col-option">
                <label for="property_type">Property Type</label> <select name="property_type" id="property_type">
                    <option value="all" <?php if ( $filters_array['property_type'] == 'all' ) {
						echo esc_attr( 'selected' );
					} ?>>All
                    </option>
                    <option value="house" <?php if ( $filters_array['property_type'] == 'house' ) {
						echo esc_attr( 'selected' );
					} ?>>House
                    </option>
                    <option value="apartment" <?php if ( $filters_array['property_type'] == 'apartment' ) {
						echo esc_attr( 'selected' );
					} ?>>Apartment
                    </option>
                    <option value="plot" <?php if ( $filters_array['property_type'] == 'plot' ) {
						echo esc_attr( 'selected' );
					} ?>>Plot
                    </option>
                    <option value="commercial" <?php if ( $filters_array['property_type'] == 'commercial' ) {
						echo esc_attr( 'selected' );
					} ?>>Commercial
                    </option>
                </select>
            </div>
            <div class="col-option">
                <label for="beds">Bedrooms</label> <select name="beds" id="beds">
                    <option value="">Any</option>
                    <option value="1" <?php if ( isset( $filters_array['beds'] ) && $filters_array['beds'] == '1' ) {
						echo esc_attr( 'selected' );
					} ?>>1+
                    </option>
                    <option value="2" <?php if ( isset( $filters_array['beds'] ) && $filters_array['beds'] == '2' ) {
						echo esc_attr( 'selected' );
					} ?>>2+
                    </option>
                    <option value="3" <?php if ( isset( $filters_array['beds'] ) && $filters_array['beds'] == '3' ) {
						echo esc_attr( 'selected' );
					} ?>>3+
                    </option>
                    <option value="4" <?php if ( isset( $filters_array['beds'] ) && $filters_array['beds'] == '4' ) {
						echo esc_attr( 'selected' );
					} ?>>4+
                    </option>
                    <option value="5" <?php if ( isset( $filters_array['beds'] ) && $filters_array['beds'] == '5' ) {
						echo esc_attr( 'selected' );
					} ?>>5+
                    </option>
                    <option value="6" <?php if ( isset( $filters_array['beds'] ) && $filters_array['beds'] == '6' ) {
						echo esc_attr( 'selected' );
					} ?>>6+
                    </option>
                    <option value="7" <?php if ( isset( $filters_array['beds'] ) && $filters_array['beds'] == '7' ) {
						echo esc_attr( 'selected' );
					} ?>>7+
                    </option>
                    <option value="8" <?php if ( isset( $filters_array['beds'] ) && $filters_array['beds'] == '8' ) {
						echo esc_attr( 'selected' );
					} ?>>8+
                    </option>
                    <option value="9" <?php if ( isset( $filters_array['beds'] ) && $filters_array['beds'] == '9' ) {
						echo esc_attr( 'selected' );
					} ?>>9+
                    </option>
                    <option value="10" <?php if ( isset( $filters_array['beds'] ) && $filters_array['beds'] == '10' ) {
						echo esc_attr( 'selected' );
					} ?>>10+
                    </option>
                </select>
            </div>
            <div class="col-option">
                <label for="baths">Bathrooms</label> <select name="baths" id="baths">
                    <option value="">Any</option>
                    <option value="1" <?php if ( isset( $filters_array['baths'] ) && $filters_array['baths'] == '1' ) {
						echo esc_attr( 'selected' );
					} ?>>1+
                    </option>
                    <option value="2" <?php if ( isset( $filters_array['baths'] ) && $filters_array['baths'] == '2' ) {
						echo esc_attr( 'selected' );
					} ?>>2+
                    </option>
                    <option value="3" <?php if ( isset( $filters_array['baths'] ) && $filters_array['baths'] == '3' ) {
						echo esc_attr( 'selected' );
					} ?>>3+
                    </option>
                    <option value="4" <?php if ( isset( $filters_array['baths'] ) && $filters_array['baths'] == '4' ) {
						echo esc_attr( 'selected' );
					} ?>>4+
                    </option>
                    <option value="5" <?php if ( isset( $filters_array['baths'] ) && $filters_array['baths'] == '5' ) {
						echo esc_attr( 'selected' );
					} ?>>5+
                    </option>
                    <option value="6" <?php if ( isset( $filters_array['baths'] ) && $filters_array['baths'] == '6' ) {
						echo esc_attr( 'selected' );
					} ?>>6+
                    </option>
                    <option value="7" <?php if ( isset( $filters_array['baths'] ) && $filters_array['baths'] == '7' ) {
						echo esc_attr( 'selected' );
					} ?>>7+
                    </option>
                    <option value="8" <?php if ( isset( $filters_array['baths'] ) && $filters_array['baths'] == '8' ) {
						echo esc_attr( 'selected' );
					} ?>>8+
                    </option>
                    <option value="9" <?php if ( isset( $filters_array['baths'] ) && $filters_array['baths'] == '9' ) {
						echo esc_attr( 'selected' );
					} ?>>9+
                    </option>
                    <option value="10" <?php if ( isset( $filters_array['baths'] ) && $filters_array['baths'] == '10' ) {
						echo esc_attr( 'selected' );
					} ?>>10+
                    </option>
                </select>
            </div>
            <div class="col-option">
                <label for="min_price">Price Min</label> <select name="type" id="min_price">
                    <option value="">Any</option>
                    <option value="1000" <?php if ( isset( $filters_array['min_price'] ) && $filters_array['min_price'] == '1000' ) {
						echo esc_attr( 'selected' );
					} ?>>€1,000
                    </option>
                    <option value="5000" <?php if ( isset( $filters_array['min_price'] ) && $filters_array['min_price'] == '5000' ) {
						echo esc_attr( 'selected' );
					} ?>>€5,000
                    </option>
                    <option value="10000" <?php if ( isset( $filters_array['min_price'] ) && $filters_array['min_price'] == '10000' ) {
						echo esc_attr( 'selected' );
					} ?>>€10,000
                    </option>
                    <option value="50000" <?php if ( isset( $filters_array['min_price'] ) && $filters_array['min_price'] == '50000' ) {
						echo esc_attr( 'selected' );
					} ?>>€50,000
                    </option>
                    <option value="100000" <?php if ( isset( $filters_array['min_price'] ) && $filters_array['min_price'] == '100000' ) {
						echo esc_attr( 'selected' );
					} ?>>€100,000
                    </option>
                    <option value="200000" <?php if ( isset( $filters_array['min_price'] ) && $filters_array['min_price'] == '200000' ) {
						echo esc_attr( 'selected' );
					} ?>>€200,000
                    </option>
                    <option value="300000" <?php if ( isset( $filters_array['min_price'] ) && $filters_array['min_price'] == '300000' ) {
						echo esc_attr( 'selected' );
					} ?>>€300,000
                    </option>
                    <option value="400000" <?php if ( isset( $filters_array['min_price'] ) && $filters_array['min_price'] == '400000' ) {
						echo esc_attr( 'selected' );
					} ?>>€400,000
                    </option>
                    <option value="500000" <?php if ( isset( $filters_array['min_price'] ) && $filters_array['min_price'] == '500000' ) {
						echo esc_attr( 'selected' );
					} ?>>€500,000
                    </option>
                    <option value="600000" <?php if ( isset( $filters_array['min_price'] ) && $filters_array['min_price'] == '600000' ) {
						echo esc_attr( 'selected' );
					} ?>>€600,000
                    </option>
                    <option value="700000" <?php if ( isset( $filters_array['min_price'] ) && $filters_array['min_price'] == '700000' ) {
						echo esc_attr( 'selected' );
					} ?>>€700,000
                    </option>
                    <option value="800000" <?php if ( isset( $filters_array['min_price'] ) && $filters_array['min_price'] == '800000' ) {
						echo esc_attr( 'selected' );
					} ?>>€800,000
                    </option>
                    <option value="900000" <?php if ( isset( $filters_array['min_price'] ) && $filters_array['min_price'] == '900000' ) {
						echo esc_attr( 'selected' );
					} ?>>€900,000
                    </option>
                    <option value="1000000" <?php if ( isset( $filters_array['min_price'] ) && $filters_array['min_price'] == '1000000' ) {
						echo esc_attr( 'selected' );
					} ?>>€1,000,000
                    </option>
                    <option value="1500000" <?php if ( isset( $filters_array['min_price'] ) && $filters_array['min_price'] == '1500000' ) {
						echo esc_attr( 'selected' );
					} ?>>€1,500,000
                    </option>
                    <option value="2000000" <?php if ( isset( $filters_array['min_price'] ) && $filters_array['min_price'] == '2000000' ) {
						echo esc_attr( 'selected' );
					} ?>>€2,000,000
                    </option>
                    <option value="2500000" <?php if ( isset( $filters_array['min_price'] ) && $filters_array['min_price'] == '2500000' ) {
						echo esc_attr( 'selected' );
					} ?>>€2,500,000
                    </option>
                    <option value="5000000" <?php if ( isset( $filters_array['min_price'] ) && $filters_array['min_price'] == '5000000' ) {
						echo esc_attr( 'selected' );
					} ?>>€5,000,000
                    </option>
                </select>
            </div>
            <div class="col-option">
                <label for="max_price">Price Max</label> <select name="type" id="max_price">
                    <option value="">Any</option>
                    <option value="5000" <?php if ( isset( $filters_array['max_price'] ) && $filters_array['max_price'] == '5000' ) {
						echo esc_attr( 'selected' );
					} ?>>€5,000
                    </option>
                    <option value="10000" <?php if ( isset( $filters_array['max_price'] ) && $filters_array['max_price'] == '10000' ) {
						echo esc_attr( 'selected' );
					} ?>>€10,000
                    </option>
                    <option value="50000" <?php if ( isset( $filters_array['max_price'] ) && $filters_array['max_price'] == '50000' ) {
						echo esc_attr( 'selected' );
					} ?>>€50,000
                    </option>
                    <option value="100000" <?php if ( isset( $filters_array['max_price'] ) && $filters_array['max_price'] == '100000' ) {
						echo esc_attr( 'selected' );
					} ?>>€100,000
                    </option>
                    <option value="200000" <?php if ( isset( $filters_array['max_price'] ) && $filters_array['max_price'] == '200000' ) {
						echo esc_attr( 'selected' );
					} ?>>€200,000
                    </option>
                    <option value="300000" <?php if ( isset( $filters_array['max_price'] ) && $filters_array['max_price'] == '300000' ) {
						echo esc_attr( 'selected' );
					} ?>>€300,000
                    </option>
                    <option value="400000" <?php if ( isset( $filters_array['max_price'] ) && $filters_array['max_price'] == '400000' ) {
						echo esc_attr( 'selected' );
					} ?>>€400,000
                    </option>
                    <option value="500000" <?php if ( isset( $filters_array['max_price'] ) && $filters_array['max_price'] == '500000' ) {
						echo esc_attr( 'selected' );
					} ?>>€500,000
                    </option>
                    <option value="600000" <?php if ( isset( $filters_array['max_price'] ) && $filters_array['max_price'] == '600000' ) {
						echo esc_attr( 'selected' );
					} ?>>€600,000
                    </option>
                    <option value="700000" <?php if ( isset( $filters_array['max_price'] ) && $filters_array['max_price'] == '700000' ) {
						echo esc_attr( 'selected' );
					} ?>>€700,000
                    </option>
                    <option value="800000" <?php if ( isset( $filters_array['max_price'] ) && $filters_array['max_price'] == '800000' ) {
						echo esc_attr( 'selected' );
					} ?>>€800,000
                    </option>
                    <option value="900000" <?php if ( isset( $filters_array['max_price'] ) && $filters_array['max_price'] == '900000' ) {
						echo esc_attr( 'selected' );
					} ?>>€900,000
                    </option>
                    <option value="1000000" <?php if ( isset( $filters_array['max_price'] ) && $filters_array['max_price'] == '1000000' ) {
						echo esc_attr( 'selected' );
					} ?>>€1,000,000
                    </option>
                    <option value="1500000" <?php if ( isset( $filters_array['max_price'] ) && $filters_array['max_price'] == '1500000' ) {
						echo esc_attr( 'selected' );
					} ?>>€1,500,000
                    </option>
                    <option value="2000000" <?php if ( isset( $filters_array['max_price'] ) && $filters_array['max_price'] == '2000000' ) {
						echo esc_attr( 'selected' );
					} ?>>€2,000,000
                    </option>
                    <option value="2500000" <?php if ( isset( $filters_array['max_price'] ) && $filters_array['max_price'] == '2500000' ) {
						echo esc_attr( 'selected' );
					} ?>>€2,500,000
                    </option>
                    <option value="5000000" <?php if ( isset( $filters_array['max_price'] ) && $filters_array['max_price'] == '5000000' ) {
						echo esc_attr( 'selected' );
					} ?>>€5,000,000
                    </option>
                    <option value="10000000" <?php if ( isset( $filters_array['max_price'] ) && $filters_array['max_price'] == '10000000' ) {
						echo esc_attr( 'selected' );
					} ?>>€10,000,000
                    </option>
                </select>
            </div>
        </div>
        <div class="collections-options two">
            <div class="col-option" style="display: none;">
                <label for="show-pagination">Show Pagination</label> <select name="show-pagination" id="show-pagination">
                    <option value="">No</option>
                    <option value="yes" <?php if ( isset( $filters_array['show-pagination'] ) && $filters_array['show-pagination'] == 'yes' ) {
						echo esc_attr( 'selected' );
					} ?>>Yes
                    </option>
                </select>
            </div>
            <div class="col-option" style="display: none;">
                <label for="per_page">Count Properties</label> <input type="number" id="per_page" value="<?php if ( isset( $filters_array['per_page'] ) ) {
					echo esc_attr( $filters_array['per_page'] );
				} ?>">
            </div>
            <div class="col-option" style="display: none;">
                <label for="row_items">Properties in Row</label> <input type="number" id="row_items" value="<?php echo esc_attr( $items_row ) ?>">
            </div>
            <div class="col-option" style="display: none;">
                <label for="size_description">Size Description</label> <input type="number" id="size_description" value="<?php echo esc_attr( $size_description) ?>">
            </div>
            <div class="col-option" style="display: none;">
                <label for="page">Page</label> <input type="number" id="page" value="<?php if ( isset( $filters_array['page'] ) ) {
					echo esc_attr( $filters_array['page'] )
				} ?>">
            </div>
            <div class="col-option" style="display: none;">
                <input type="hidden" id="search_area_id" value="<?php if ( isset( $filters_array['search_area_id'] ) ) {
					echo esc_attr( $filters_array['search_area_id'] )
				} ?>">
            </div>
            <div class="col-option" style="display: none;">
                <input type="hidden" id="template" value="only_properties">
            </div>
            <div class="col-option">
                <label for="transaction_type">Sale/Rent</label> <select name="transaction_type" id="transaction_type">
                    <option value="for_sale" <?php if ( isset( $filters_array['transaction_type'] ) && $filters_array['transaction_type'] == 'for_sale' ) {
						echo esc_attr( 'selected' );
					} ?>>For Sale
                    </option>
                    <option value="for_rent" <?php if ( isset( $filters_array['transaction_type'] ) && $filters_array['transaction_type'] == 'for_rent' ) {
						echo esc_attr( 'selected' );
					} ?>>For Rent
                    </option>
                </select>
            </div>
            <div class="col-option">
                <label for="search_city">Location City/State (ID)</label> <input type="text" id="search_city" placeholder="All" value="<?php if ( isset( $filters_array['search_city'] ) ) {
					echo esc_attr( $filters_array['search_city'] )
				} ?>">
                <div id="auto-city"></div>
            </div>
            <div class="col-option">
                <label for="min_built_area">Built Area</label> <input placeholder="Min (m2)" type="text" name="min_built_area" id="min_built_area" value="<?php if ( isset( $filters_array['min_built_area'] ) ) {
					echo esc_attr( $filters_array['min_built_area'] )
				} ?>">
            </div>
            <div class="col-option">
                <label for="min_plot_size">Plot Size</label> <input placeholder="Min (m2)" type="text" name="min_plot_size" id="min_plot_size" value="<?php if ( isset( $filters_array['min_plot_size'] ) ) {
					echo esc_attr( $filters_array['min_plot_size'] )
				} ?>">
            </div>
            <div class="col-option">
                <label for="sort_by">Sort By</label> <select name="sort-properties" id="sort_by">
                    <option value="">Default</option>
                    <option value="created_at_desc" <?php if ( isset( $filters_array['sort_by'] ) && $filters_array['sort_by'] == 'created_at_desc' ) {
						echo esc_attr( 'selected' );
					} ?>>Newest First
                    </option>
                    <option value="created_at_asc" <?php if ( isset( $filters_array['sort_by'] ) && $filters_array['sort_by'] == 'created_at_asc' ) {
						echo esc_attr( 'selected' );
					} ?>>Oldest First
                    </option>
                    <option value="price_asc" <?php if ( isset( $filters_array['sort_by'] ) && $filters_array['sort_by'] == 'price_asc' ) {
						echo esc_attr( 'selected' );
					} ?>>Price (Low - High)
                    </option>
                    <option value="price_desc" <?php if ( isset( $filters_array['sort_by'] ) && $filters_array['sort_by'] == 'price_desc' ) {
						echo esc_attr( 'selected' );
					} ?>>Price (High - Low)
                    </option>
                    <option value="price_square_asc" <?php if ( isset( $filters_array['sort_by'] ) && $filters_array['sort_by'] == 'price_square_asc' ) {
						echo esc_attr( 'selected' );
					} ?>>Price per m2 (Low - High)
                    </option>
                    <option value="price_square_desc" <?php if ( isset( $filters_array['sort_by'] ) && $filters_array['sort_by'] == 'price_square_desc' ) {
						echo esc_attr( 'selected' );
					} ?>>Price per m2 (High - Low)
                    </option>
                </select>
            </div>
        </div>
        <div class="collections-features-tabs">
            <div class="collections-features-title">Additional Features:</div>
            <div class="collection-tab-content">
                <ul class="ks-cboxtags">
                    <li><input type="checkbox" id="feature-exclusive" value="exclusive" <?php if ( isset( $filters_array['exclusive'] ) ) {
							echo esc_attr( 'checked' );
						} ?>><label for="feature-exclusive">Exclusive</label></li>
                    <li><input type="checkbox" id="feature-has_parking" value="has_parking" <?php if ( isset( $filters_array['has_parking'] ) ) {
							echo esc_attr( 'checked' );
						} ?>><label for="feature-has_parking">Parking</label></li>
                    <li><input type="checkbox" id="feature-has_ac" value="has_ac" <?php if ( isset( $filters_array['has_ac'] ) ) {
							echo esc_attr( 'checked' );
						} ?>><label for="feature-has_ac">A/C & Heating</label></li>
                    <li><input type="checkbox" id="feature-has_pool" value="has_pool" <?php if ( isset( $filters_array['has_pool'] ) ) {
							echo esc_attr( 'checked' );
						} ?>><label for="feature-has_pool">Pool</label></li>
                    <li><input type="checkbox" id="feature-has_balcony" value="has_balcony" <?php if ( isset( $filters_array['has_balcony'] ) ) {
							echo esc_attr( 'checked' );
						} ?>><label for="feature-has_balcony">Balcony</label></li>
                    <li><input type="checkbox" id="feature-is_furnished" value="is_furnished" <?php if ( isset( $filters_array['is_furnished'] ) ) {
							echo esc_attr( 'checked' );
						} ?>><label for="feature-is_furnished">Furnished</label></li>
                    <li><input type="checkbox" id="feature-has_elevator" value="has_elevator" <?php if ( isset( $filters_array['has_elevator'] ) ) {
							echo esc_attr( 'checked' );
						} ?>><label for="feature-has_elevator">Elevator</label></li>
                    <li><input type="checkbox" id="feature-has_garden" value="has_garden" <?php if ( isset( $filters_array['has_garden'] ) ) {
							echo esc_attr( 'checked' );
						} ?>><label for="feature-has_garden">Garden</label></li>
                    <li><input type="checkbox" id="feature-has_fireplace" value="has_fireplace" <?php if ( isset( $filters_array['has_fireplace'] ) ) {
							echo esc_attr( 'checked' );
						} ?>><label for="feature-has_fireplace">Fireplace</label></li>
                </ul>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="collections-table"></div>
<?php } ?>