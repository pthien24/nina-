<?php
/**
 * Lost password form
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices(); ?>

<div class="grid__item large--one-third push--large--one-third text-center">

	<form method="post" class="woocommerce-ResetPassword lost_reset_password">

		<h3><?php _e( 'Reset your password', 'homemarket' ); ?></h3>

		<p class="description"><?php echo apply_filters( 'woocommerce_lost_password_message', __( 'We will send you an email to reset your password.', 'homemarket' ) ); ?></p>

		<p class="woocommerce-FormRow woocommerce-FormRow--first form-row">
			<input class="woocommerce-Input woocommerce-Input--text input-text" type="text" name="user_login" id="user_login" placeholder="<?php _e( 'Email', 'homemarket' ); ?>" />
		</p>

		<div class="clear"></div>

		<?php do_action( 'woocommerce_lostpassword_form' ); ?>

		<p class="woocommerce-FormRow form-row">
			<input type="hidden" name="wc_reset_password" value="true" />
			<input type="submit" class="woocommerce-Button button" value="<?php esc_attr_e( 'Submit', 'homemarket' ); ?>" />

			<?php if (('lost_password') === $args['form']) : ?>
                <a class="back-login" href="<?php echo get_permalink( wc_get_page_id( 'myaccount' ) ) ?>"><?php _e('Back to login', 'homemarket') ?></a>
            <?php endif; ?>
		</p>

		<?php wp_nonce_field( 'lost_password' ); ?>

	</form>

</div>


