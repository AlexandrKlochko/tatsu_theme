<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
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
$fields = $checkout->get_checkout_fields('billing'); ?>
<div class="woocommerce-billing-section">
    <div class="default-checkbox">
        <input id="ship-to-same-address-checkbox"
               class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" checked
               type="checkbox" name="ship_to_same_address" value="1"/>
        <label for="ship-to-same-address-checkbox"><?php _e('Billing address is the same as my billing address', 'tatsu') ?></label>
    </div>
    <div class="woocommerce-billing-fields" style="display: none">
        <?php do_action('woocommerce_before_checkout_billing_form', $checkout); ?>
        <fieldset>
            <legend><?php _e('Billing Contact', 'tatsu_theme') ?></legend>
            <?php if (isset($fields['billing_email'])): ?>
                <div class="default-input">
                    <input type="text" name="billing_email" id="billing_email" placeholder=""
                           value="<?php echo $checkout->get_value('billing_email') ?>" required>
                    <label><?php _e('Email address', 'tatsu_theme') ?>*</label>
                </div>
            <?php endif; ?>
            <div class="inputs-grid">
                <?php if (isset($fields['billing_first_name'])): ?>
                    <div class="default-input">
                        <input type="text" name="billing_first_name" id="billing_first_name" placeholder=""
                               value="<?php echo $checkout->get_value('billing_first_name') ?>" required>
                        <label><?php _e('First name', 'tatsu_theme') ?>*</label>
                    </div>
                <?php endif; ?>
                <?php if (isset($fields['billing_last_name'])): ?>
                    <div class="default-input">
                        <input type="text" name="billing_last_name" id="billing_last_name" placeholder=""
                               value="<?php echo $checkout->get_value('billing_last_name') ?>" required>
                        <label><?php _e('Last name', 'tatsu_theme') ?>*</label>
                    </div>
                <?php endif; ?>
                <?php if (isset($fields['billing_phone'])): ?>
                    <div class="default-input">
                        <input type="tel" name="billing_phone" id="billing_phone" placeholder=""
                               value="<?php echo $checkout->get_value('billing_phone') ?>" required>
                        <label><?php _e('Phone number', 'tatsu_theme') ?>*</label>
                    </div>
                <?php endif; ?>
            </div>
        </fieldset>
        <fieldset>
            <legend><?php _e('Your billing address', 'tatsu_theme') ?></legend>

            <?php if (is_array($fields)): ?>
                <input type="hidden" name="billing_country" id="billing_country" placeholder=""
                       value="<?php echo $checkout->get_value('billing_country') ?>">
                <input type="hidden" name="billing_state" id="billing_state" placeholder=""
                       value="<?php echo $checkout->get_value('billing_state') ?>">
                <div class="inputs-grid">
                    <?php if (isset($fields['billing_postcode'])): ?>
                        <div class="default-input">
                            <input type="text" name="billing_postcode" id="billing_postcode" placeholder=""
                                   value="<?php echo $checkout->get_value('billing_postcode') ?>" >
                            <label><?php _e('Zip Code', 'tatsu_theme') ?>*</label>
                        </div>
                    <?php endif; ?>
                    <div class="inputs-grid">
                        <?php if (isset($fields['billing_address_2'])): ?>
                            <div class="default-input">
                                <input type="text" name="billing_address_2" id="billing_address_2" placeholder=""
                                       value="<?php echo $checkout->get_value('billing_address_2') ?>" >
                                <label><?php _e('House num.', 'tatsu_theme') ?>*</label>
                            </div>
                        <?php endif; ?>

                        <?php if (isset($fields['billing_postcode_suffix'])): ?>
                            <div class="default-input">
                                <input type="text" name="billing_postcode_suffix" id="billing_postcode_suffix"
                                       placeholder="" required
                                       value="<?php echo $checkout->get_value('billing_postcode_suffix') ?>">
                                <label><?php _e('Suffix', 'tatsu_theme') ?>*</label>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="inputs-grid">
                    <?php if (isset($fields['billing_address_1'])): ?>
                        <div class="default-input">
                            <input type="text" name="billing_address_1" id="billing_address_1" placeholder=""
                                   value="<?php echo $checkout->get_value('billing_address_1') ?>" >
                            <label><?php _e('Street name', 'tatsu_theme') ?>*</label>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($fields['billing_city'])): ?>
                        <div class="default-input">
                            <input type="text" name="billing_city" id="billing_city" placeholder=""
                                   value="<?php echo $checkout->get_value('billing_city') ?>" 
                                   autocomplete="address-level2">
                            <label><?php _e('City', 'tatsu_theme') ?>*</label>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </fieldset>
        <?php do_action('woocommerce_after_checkout_billing_form', $checkout); ?>
    </div>
</div>
