<?php  
/**
 *	Create custom meta box on page editor
 */

add_action( 'add_meta_boxes', 'page_options_meta_box_add' );

if ( ! function_exists( 'page_options_meta_box_add' ) ) {
	function page_options_meta_box_add() {
		add_meta_box( 'page_options_meta_box', 'Page Options', 'page_options_meta_box_content', 'page', 'side', 'high' );
	}
}

if ( ! function_exists( 'page_options_meta_box_content' ) ) {
	function page_options_meta_box_content() {

		// $post is already set, and contains an object: the Wordpress post
		global $post;

		$values = get_post_custom( $post->ID );
		$page_title_check = isset( $values['page_title_meta_box_check'] ) ? esc_attr( $values['page_title_meta_box_check'][0] ) : 'on';
		?>

		<p>
			<input type="checkbox" id="page_title_meta_box_check" name="page_title_meta_box_check" <?php checked( $page_title_check, 'on' ) ?> />
			<label for="page_title_meta_box_check"><?php _e( 'Show Page Title', 'homemarket' ); ?></label>
		</p>

		<?php
		// We'll use this nonce field later on when saving
		wp_nonce_field( 'page_options_meta_box', 'page_options_meta_box_nonce' );

	}
}

add_action( 'save_post', 'page_options_meta_box_save' );

if ( ! function_exists( 'page_options_meta_box_save' ) ) {

	function page_options_meta_box_save( $post_id ) {
		// Bail if we`re doing an auto save
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

		// if our nonce isn`t there, or we can`t verify it, bail
		if ( !isset( $_POST['page_options_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['page_options_meta_box_nonce'] , 'page_options_meta_box') ) return;

		// if our current user can`t edit this post, bail
		if ( !current_user_can( 'edit_post', $post_id ) ) return;

		$page_title_chk = isset( $_POST['page_title_meta_box_check'] ) ? 'on' : 'off';
		update_post_meta( $post_id, 'page_title_meta_box_check', $page_title_chk );
		
	}
}