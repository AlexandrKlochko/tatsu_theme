<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

<div class="u-columns col2-set " id="customer_login">

	<div class="u-column1 col-1">

<?php endif; ?>

		<h2><?php esc_html_e( 'Login', 'woocommerce' ); ?></h2>

		<form class="woocommerce-form woocommerce-form-login login account-form" method="post" novalidate>

			<?php do_action( 'woocommerce_login_form_start' ); ?>
            <div class="default-input">
                <input name="username" type="text" required>
                <label><?php _e('Email address','tatsu_theme')?></label>
            </div>
            <div class="default-input">
                <input name="password" type="password" minlength="6" required><span class="show-password-input"></span>
                <label><?php _e('Password','tatsu_theme')?></label>
            </div>
            <?php do_action( 'woocommerce_login_form' ); ?>
            <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
            <div class="default-checkbox">
                <input name="rememberme" type="checkbox" id="rememberme" value="forever">
                <label for="rememberme"><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></label>
            </div>
            <button class="submit-btn" type="submit" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>">
                <?php _e('Login','tatsu_theme')?>
                <img src="<?php echo THEME_DIR_URI?>/dist/img/icons/long-arrow-dark.svg" alt="" class="js__img-to-svg">
            </button>

            <div class="tar">
                <a href="<?php echo esc_url(wp_lostpassword_url())?>" class="grey-link"><?php _e('Forgot password?','tatsu_theme')?></a>
            </div>

			<?php do_action( 'woocommerce_login_form_end' ); ?>

		</form>

<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

	</div>

	<div class="u-column2 col-2">

		<h2><?php esc_html_e( 'Register', 'woocommerce' ); ?></h2>

		<form method="post" class="woocommerce-form woocommerce-form-register register account-form" <?php do_action( 'woocommerce_register_form_tag' ); ?> >

			<?php do_action( 'woocommerce_register_form_start' ); ?>
            <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
                <div class="default-input">
                    <input type="text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" required>
                    <label><?php _e('Username','tatsu_theme')?><span class="required">*</span></label>
                </div>
            <?php endif; ?>
            <div class="default-input">
                <input type="email" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" required>
                <label><?php _e('Email address','tatsu_theme')?></label>
            </div>
            <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
                <div class="default-input">
                    <input type="password" name="password" id="reg_password" autocomplete="new-password" minlength="6" required>
                    <label><?php _e('Password','tatsu_theme')?></label>
                </div>
            <?php else : ?>
                <div class="default-input">
                    <label><?php esc_html_e( 'A password will be sent to your email address.', 'woocommerce' ); ?></label>
                </div>
            <?php endif;?>
            <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
			<?php do_action( 'woocommerce_register_form' ); ?>
            <button class="submit-btn" type="submit" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>">
                <?php _e('Register','tatsu_theme')?>
                <img src="<?php echo THEME_DIR_URI?>/dist/img/icons/long-arrow-dark.svg" alt="" class="js__img-to-svg">
            </button>

			<?php do_action( 'woocommerce_register_form_end' ); ?>

		</form>

	</div>

</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
