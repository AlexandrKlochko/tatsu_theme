<?php
/**
 * Lost password reset form.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-reset-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.5
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_reset_password_form' );
?>
    <div class="cabinet-page">
        <h1 class="cabinet-title"><?php _e('Set new password','tatsu_theme')?></h1>
        <div class="cabinet-desc">
            <p><?php echo apply_filters( 'woocommerce_reset_password_message', esc_html__( 'Enter a new password below.', 'woocommerce' ) ); ?></p>
        </div>
        <form novalidate method="post" class="reset-form">
            <input type="hidden" name="reset_key" value="<?php echo esc_attr( $args['key'] ); ?>" />
            <input type="hidden" name="reset_login" value="<?php echo esc_attr( $args['login'] ); ?>" />
            <input type="hidden" name="wc_reset_password" value="true" />
            <div class="default-input">
                <input type="password" name="password_1" id="password_1" autocomplete="new-password" required><span class="show-password-input"></span>
                <label><?php esc_html_e( 'New password', 'woocommerce' ); ?><span class="required">*</span></label>
            </div>
            <div class="default-input">
                <input type="password" name="password_2" id="password_2" autocomplete="new-password" required><span class="show-password-input"></span>
                <label><?php esc_html_e( 'Repeat new password', 'woocommerce' ); ?>&nbsp<span class="required">*</span></label>
            </div>
            <div class="clear"></div>

            <?php do_action( 'woocommerce_resetpassword_form' ); ?>
            <button class="submit-btn" type="submit">
                <?php _e('Confirm new password','tatsu_theme')?>
                <img src="<?php echo THEME_DIR_URI?>/dist/img/icons/long-arrow-dark.svg" alt="" class="js__img-to-svg">
            </button>
            <?php wp_nonce_field( 'reset_password', 'woocommerce-reset-password-nonce' ); ?>
        </form>
    </div>
<?php
do_action( 'woocommerce_after_reset_password_form' );

