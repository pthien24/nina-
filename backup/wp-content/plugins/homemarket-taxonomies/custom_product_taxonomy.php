<?php

/* Add Image Upload to Brand Taxonomy */

// Add Upload fields to "Add New Taxonomy" form

if ( ! class_exists( 'BrandTaxonomyField' ) ) {
	class BrandTaxonomyField {
		public function __construct() {
			//
		}

		// Initialize the class and start calling our hooks and filters
		public function init() {
			add_action( 'brand_taxonomy_add_form_fields', array ( $this, 'add_category_image' ), 10, 2 );
			add_action( 'created_brand_taxonomy', array ( $this, 'save_category_image' ), 10, 2 );
			add_action( 'brand_taxonomy_edit_form_fields', array ( $this, 'update_category_image' ), 10, 2 );
			add_action( 'edited_brand_taxonomy', array ( $this, 'updated_category_image' ), 10, 2 );
			add_action( 'admin_enqueue_scripts', array ( $this, 'add_script' ) );
		}

		// Add a form field in the new category page
		public function add_category_image ( $taxonomy ) {
			?>
			<div class="form-field term-group">
				<label for="category-image-id"><?php _e('Image', 'homemarket'); ?></label>
				<input type="hidden" id="category-image-id" name="category-image-id" class="custom_media_url" value="" aria-required="true">
				<div id="category-image-wrapper"></div>
				<p>
					<input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="<?php _e( 'Add Image', 'homemarket' ); ?>" />
					<input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="<?php _e( 'Remove Image', 'homemarket' ); ?>" />
				</p>
			</div>
			<?php
		}

		// Save the field
		public function save_category_image ( $term_id, $tt_id ) {
			if( isset( $_POST['category-image-id'] ) && '' !== $_POST['category-image-id'] ){
				$image = $_POST['category-image-id'];
				add_term_meta( $term_id, 'category-image-id', $image, true );
			}
		}

		// Edit the form field
		public function update_category_image ( $term, $taxonomy ) {
			?>
			<tr class="form-field term-group-wrap">
				<th scope="row">
					<label for="category-image-id"><?php _e( 'Image', 'homemarket' ); ?></label>
				</th>
				<td>
					<?php $image_id = get_term_meta ( $term -> term_id, 'category-image-id', true ); ?>
					<input type="hidden" id="category-image-id" name="category-image-id" value="<?php echo $image_id; ?>">

					<div id="category-image-wrapper">
					<?php if ( $image_id ) { ?>
					<?php echo wp_get_attachment_image ( $image_id, 'thumbnail' ); ?>
					<?php } ?>
					</div>

					<p>
						<input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="<?php _e( 'Add Image', 'homemarket' ); ?>" />
						<input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="<?php _e( 'Remove Image', 'homemarket' ); ?>" />
					</p>
				</td>
			</tr>
			<?php
		}

		// Update the form field value
		public function updated_category_image ( $term_id, $tt_id ) {
			if( isset( $_POST['category-image-id'] ) && '' !== $_POST['category-image-id'] ){
				$image = $_POST['category-image-id'];
				update_term_meta ( $term_id, 'category-image-id', $image );
			} else {
				update_term_meta ( $term_id, 'category-image-id', '' );
			}
		}

		public function add_script() {
			wp_enqueue_script('homemarket-taxonomy-js', plugin_dir_url(__FILE__) . 'taxonomy.js', array('jquery'), '1.0', false );
		}
	}

	$BrandTaxonomyField = new BrandTaxonomyField();
	$BrandTaxonomyField -> init();
}