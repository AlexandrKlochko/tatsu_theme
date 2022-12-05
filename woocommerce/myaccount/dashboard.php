<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>


<?php
/**
 * My Account dashboard.
 *
 * @since 2.6.0
 */
do_action('woocommerce_account_dashboard');

/**
 * Deprecated woocommerce_before_my_account action.
 *
 * @deprecated 2.6.0
 */
$WC_Countries = new WC_Countries();
$countries = $WC_Countries->get_shipping_countries();
do_action('woocommerce_before_my_account'); ?>
    <div class="cabinet-page">
        <h1 class="cabinet-title"><?php _e('Your account', 'tatsu') ?></h1>
        <div class="cabinet-desc">
            <p><?php echo apply_filters('woocommerce_my_account_description', esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce blandit odio nec ultrices placerat.', 'woocommerce')); ?></p>
        </div>
        <form novalidate class="account-form account-details" method="post"
              action="<?php echo admin_url("admin-ajax.php") ?>">
            <input type="hidden" name="action" value="save_account_details">
            <fieldset>
                <legend><?php _e('Contact', 'tatsu') ?></legend>
                <div class="default-input is-focused ">
                    <input type="email" name="user_email" required value="<?php echo WC()->customer->get_email(); ?>">
                    <label><?php _e('Email address', 'tatsu') ?>*</label>
                </div>
                <div class="inputs-grid">
                    <div class="default-input is-focused ">
                        <input type="text" required name="user_firstname"
                               value="<?php echo WC()->customer->get_first_name() ?>">
                        <label><?php _e('First name', 'tatsu') ?>*</label>
                    </div>
                    <div class="default-input">
                        <input type="text" required name="user_lastname"
                               value="<?php echo WC()->customer->get_last_name() ?>">
                        <label><?php _e('Last name', 'tatsu') ?>*</label>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend><?php _e('Shipping address', 'tatsu') ?></legend>
                <div class="default-select js__default-select" data-to-input="select_value_1">
                    <select name="shipping_country" style="display: none">
                        <?php if ($countries): ?>
                            <?php foreach ($countries as $key => $country): ?>
                                <option value="<?php echo $key ?>"
                                    <?php if ($key == WC()->customer->get_shipping_country()): ?> selected<?php endif; ?>>
                                    <?php echo $country ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                    <div class="default-select__current"
                         data-current><?php echo $countries[WC()->customer->get_shipping_country()]; ?></div>
                    <?php if ($countries): ?>
                        <ul class="default-select__dropdown" data-dropdown>
                            <?php foreach ($countries as $key => $country): ?>
                                <li data-value="<?php echo $key ?>" <?php if ($key == WC()->customer->get_shipping_country()): ?> style="display: none" <?php endif; ?>><?php echo $country ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
                <div class="inputs-grid">
                    <div class="default-input ">
                        <input type="text" required class="js__only-num" name="shipping_postcode"
                               value="<?php echo WC()->customer->get_shipping_postcode(); ?>">
                        <label><?php _e('Zip code', 'tatsu') ?>*</label>
                    </div>
                    <div class="inputs-grid">
                        <div class="default-input ">
                            <input type="text" required class="js__only-num" name="shipping_house"
                                   value="<?php echo get_user_meta(WC()->customer->get_id(), 'shipping_house', true); ?>">
                            <label><?php _e('House num.', 'tatsu') ?>*</label>
                        </div>
                        <div class="default-input ">
                            <input type="text" name="shipping_postcode_suffix"
                                   value="<?php echo get_user_meta(WC()->customer->get_id(), 'shipping_postcode_suffix', true); ?>">
                            <label><?php _e('Suffix', 'tatsu') ?></label>
                        </div>
                    </div>
                </div>
                <div class="inputs-grid">
                    <div class="default-input">
                        <input type="text" required name="shipping_address_1"
                               value="<?php echo WC()->customer->get_shipping_address_1(); ?>">
                        <label><?php _e('Street name', 'tatsu') ?>*</label>
                    </div>
                    <div class="default-input">
                        <input type="text" required name="shipping_city"
                               value="<?php echo WC()->customer->get_shipping_city(); ?>">
                        <label><?php _e('City', 'tatsu') ?>*</label>
                    </div>
                </div>
                <div class="default-checkbox">
                    <input type="checkbox" id="billing_same" name="billing_same"
                        <?php if (get_user_meta(WC()->customer->get_id(), 'billing_same', true) == 1): ?> checked <?php endif; ?>>
                    <label for="billing_same"><?php _e('Billing address is the same as my shipping address', 'tatsu') ?></label>
                </div>
            </fieldset>
            <fieldset class="billing-fieldset" 
                <?php if (get_user_meta(WC()->customer->get_id(), 'billing_same', true) == 1): ?>  style="display: none" <?php endif; ?>>
                <legend><?php _e('Billing address', 'tatsu') ?></legend>
                <div class="default-select js__default-select" data-to-input="select_value_1">
                    <select name="billing_country" style="display: none">
                        <?php if ($countries): ?>
                            <?php foreach ($countries as $key => $country): ?>
                                <option value="<?php echo $key ?>"
                                    <?php if ($key == WC()->customer->get_billing_country()): ?> selected<?php endif; ?>>
                                    <?php echo $country ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                    <div class="default-select__current"
                         data-current><?php echo $countries[WC()->customer->get_billing_country()]; ?></div>
                    <?php if ($countries): ?>
                        <ul class="default-select__dropdown" data-dropdown>
                            <?php foreach ($countries as $key => $country): ?>
                                <li data-value="<?php echo $key ?>"
                                    <?php if ($key == WC()->customer->get_billing_country()): ?> style="display: none" <?php endif; ?>>
                                    <?php echo $country ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
                <div class="inputs-grid">
                    <div class="default-input ">
                        <input type="text" required class="js__only-num" name="billing_postcode"
                               value="<?php echo WC()->customer->get_billing_postcode(); ?>">
                        <label><?php _e('Zip code', 'tatsu') ?>*</label>
                    </div>
                    <div class="inputs-grid">
                        <div class="default-input ">
                            <input type="text" required class="js__only-num" name="billing_house"
                                   value="<?php echo get_user_meta(WC()->customer->get_id(), 'billing_house', true); ?>">
                            <label><?php _e('House num.', 'tatsu') ?>*</label>
                        </div>
                        <div class="default-input ">
                            <input type="text" name="billing_postcode_suffix"
                                   value="<?php echo get_user_meta(WC()->customer->get_id(), 'billing_postcode_suffix', true); ?>">
                            <label><?php _e('Suffix', 'tatsu') ?></label>
                        </div>
                    </div>
                </div>
                <div class="inputs-grid">
                    <div class="default-input">
                        <input type="text" required name="billing_address_1"
                               value="<?php echo WC()->customer->get_billing_address_1(); ?>">
                        <label><?php _e('Street name', 'tatsu') ?>*</label>
                    </div>
                    <div class="default-input">
                        <input type="text" required name="billing_city"
                               value="<?php echo WC()->customer->get_billing_city(); ?>">
                        <label><?php _e('City', 'tatsu') ?>*</label>
                    </div>
                </div>
            </fieldset>
            <button class="submit-btn" type="submit">
                <?php _e('Save changes', 'tatsu') ?>
                <img src="<?php echo THEME_DIR_URI ?>/dist/img/icons/long-arrow-dark.svg" alt="" class="js__img-to-svg">
            </button>
        </form>
    </div>
<?php wp_nav_menu(array(
    'theme_location' => 'account-info',
    'container' => 'nav',
    'container_class' => 'account-menu',
    'menu_id' => false,
    'echo' => true,
    'menu_class' => '',
    'depth' => 1,
    'walker' => new Tatsu_Walker_Nav_Menu()
)); ?>
<?php /**
 * Deprecated woocommerce_after_my_account action.
 *
 * @deprecated 2.6.0
 */
do_action('woocommerce_after_my_account');


