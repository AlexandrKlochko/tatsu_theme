<?php
/**
 * Checkout shipping information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-shipping.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
 */

defined('ABSPATH') || exit;
$fields = $checkout->get_checkout_fields('shipping');
?>
<div class="woocommerce-shipping-fields">
    <?php do_action('woocommerce_before_checkout_shipping_form', $checkout); ?>
    <fieldset>
        <legend><?php _e('Contact', 'tatsu_theme') ?>
            <?php if (!is_user_logged_in()): ?>
                <a href="#modal-login"
                   class="bordered-link js__modal-auth-open"><?php _e('I have an account', 'tatsu_theme') ?></a>
            <?php endif; ?>
        </legend>
        <?php if (isset($fields['shipping_email'])): ?>
            <div class="default-input">
                <input type="text" name="shipping_email" id="shipping_email" placeholder=""
                       value="<?php echo $checkout->get_value('shipping_email') ?>"
                       required>
                <label><?php _e('Email address', 'tatsu_theme') ?>*</label>
            </div>
        <?php endif; ?>
        <div class="inputs-grid">
            <?php if (isset($fields['shipping_first_name'])): ?>
                <div class="default-input">
                    <input type="text" name="shipping_first_name" id="shipping_first_name" placeholder=""
                           value="<?php echo $checkout->get_value('shipping_first_name') ?>"
                           required>
                    <label><?php _e('First name', 'tatsu_theme') ?>*</label>
                </div>
            <?php endif; ?>
            <?php if (isset($fields['shipping_last_name'])): ?>
                <div class="default-input">
                    <input type="text" name="shipping_last_name" id="shipping_last_name" placeholder=""
                           value="<?php echo $checkout->get_value('shipping_last_name') ?>"
                           required>
                    <label><?php _e('Last name', 'tatsu_theme') ?>*</label>
                </div>
            <?php endif; ?>
            <?php if (isset($fields['shipping_phone'])): ?>
                <div class="default-input">
                    <input type="tel" name="shipping_phone" id="shipping_phone" placeholder=""
                           value="<?php echo $checkout->get_value('shipping_phone') ?>"
                           required>
                    <label><?php _e('Phone number', 'tatsu_theme') ?>*</label>
                </div>
            <?php endif; ?>
        </div>
        <?php if (!is_user_logged_in() && $checkout->is_registration_enabled()) : ?>
            <div class="inputs-grid">
                <div class="default-checkbox">
                    <input type="checkbox" name="subscribe" value="1" id="subs-news">
                    <label for="subs-news"><?php _e('Subscribe to our newsletter', 'tatsu_theme') ?></label>
                </div>
                <?php if (!$checkout->is_registration_required()) : ?>
                    <div class="default-checkbox">
                        <input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox"
                               id="createaccount" <?php checked((true === $checkout->get_value('createaccount') || (true === apply_filters('woocommerce_create_account_default_checked', false))), true); ?>
                               type="checkbox" name="createaccount" value="1"/>
                        <span><?php esc_html_e('Create an account?', 'woocommerce'); ?></span>
                        <label for="createaccount"><?php _e('Create an account', 'tatsu_theme') ?></label>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </fieldset>
    <fieldset class="shipping-address-data">
        <legend><?php _e('Your delivery address', 'tatsu_theme') ?></legend>

        <?php if (is_array($fields)): ?>
            <input type="hidden" name="shipping_country" id="shipping_country"
                   value="<?php echo $checkout->get_value('shipping_country') ?>">
            <input type="hidden" name="shipping_state" id="shipping_state"
                   value="<?php echo $checkout->get_value('shipping_state') ?>">
            <div class="inputs-grid">
                <?php if (isset($fields['shipping_postcode'])): ?>
                    <div class="default-input">
                        <input type="text" name="shipping_postcode" id="shipping_postcode" placeholder=""
                               value="<?php echo $checkout->get_value('shipping_postcode') ?>" required>
                        <label><?php _e('Zip Code', 'tatsu_theme') ?>*</label>
                    </div>
                <?php endif; ?>
                <div class="inputs-grid">
                    <?php if (isset($fields['shipping_address_2'])): ?>
                        <div class="default-input">
                            <input type="text" name="shipping_address_2" id="shipping_address_2" placeholder=""
                                   value="<?php echo $checkout->get_value('shipping_address_2') ?>" required>
                            <label><?php _e('House num.', 'tatsu_theme') ?>*</label>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($fields['shipping_postcode_suffix'])): ?>
                        <div class="default-input">
                            <input type="text" name="shipping_postcode_suffix" id="shipping_postcode_suffix"
                                   placeholder=""
                                   value="<?php echo $checkout->get_value('shipping_postcode_suffix') ?>" required>
                            <label><?php _e('Suffix', 'tatsu_theme') ?>*</label>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="inputs-grid">
                <?php if (isset($fields['shipping_address_1'])): ?>
                    <div class="default-input">
                        <input type="text" name="shipping_address_1" id="shipping_address_1" placeholder=""
                               value="<?php echo $checkout->get_value('shipping_address_1') ?>" required>
                        <label><?php _e('Street name', 'tatsu_theme') ?>*</label>
                    </div>
                <?php endif; ?>
                <?php if (isset($fields['shipping_city'])): ?>
                    <div class="default-input">
                        <input type="text" name="shipping_city" id="shipping_city" placeholder="" required
                               value="<?php echo $checkout->get_value('shipping_city') ?>" autocomplete="address-level2">
                        <label><?php _e('City', 'tatsu_theme') ?>*</label>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </fieldset>
    <?php do_action('woocommerce_after_checkout_shipping_form', $checkout); ?>
</div>


