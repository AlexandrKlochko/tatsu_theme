<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if (!defined('ABSPATH')) {
    exit;
}

do_action('woocommerce_before_checkout_form', $checkout);

// If checkout registration is disabled and not logged in, the user cannot checkout.
if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
    echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
    return;
}

?>
<div class="checkout-page">
    <a href="#" class="back-btn" onclick="history.back(); return false;">
        <img src="<?php echo THEME_DIR_URI?>/dist/img/icons/arrow-left-dark.svg" alt="">
    </a>
    <form name="checkout" method="post" class="checkout woocommerce-checkout account-form"
          action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">
        <div class="checkout-page__grid">
            <div class="checkout-page__main">
                <ul class="checkout-timeline">
                    <li class="step-li is-current"><?php _e('Information','tatsu_theme')?></li>
                    <li class="step-li"><?php _e('Payment','tatsu_theme')?></li>
                    <li><?php _e('Confirmation','tatsu_theme')?></li>
                </ul>
                <div class="steps step-1">
                <?php if ($checkout->get_checkout_fields()) : ?>

                    <?php do_action('woocommerce_checkout_before_customer_details'); ?>

                    <div class="" id="customer_details">
                        <section class="delivery-info">
                            <h4 class="section-subtitle tac"><?php _e('Delivery or Pickup','tatsu_theme')?></h4>

                            <?php $restaurants = get_posts(array(
                                    'post_type' => 'restaurants',
                                    'numberposts' => -1,
                                    'orderby' => 'title',
                                    'order' => 'ASC',
                                    'meta_query'=> array(
                                        array(
                                            'key'       => 'pick_up_enabled',
                                            'value'     => true,
                                            'compare'   => '='
                                        )
                                    )
                                )
                            )?>
                            <div class="default-select js__default-select" data-delivery="<?php _e('Delivery','tatsu_theme')?>" data-to-input="delivery_place">
                                <select name="delivery_place" style="display: none">
                                    <option value="<?php _e('Deliver at my address','tatsu_theme')?>"><?php _e('Deliver at my address','tatsu_theme')?></option>
                                    <?php foreach ($restaurants as $restaurant):?>
                                        <option value="<?php echo $restaurant->post_title?>">
                                            <?php _e('Pick up at','tatsu_theme')?> - <b><?php echo $restaurant->post_title?></b>
                                        </option>
                                    <?php endforeach;?>
                                </select>
                                <div class="default-select__current" data-current><?php _e('Deliver at my address','tatsu_theme')?></div>
                                <?php if($restaurants):?>
                                    <ul class="default-select__dropdown" data-dropdown>
                                        <li data-value="<?php _e('Deliver at my address','tatsu_theme')?>" style="display: none"><?php _e('Deliver at my address','tatsu_theme')?></li>
                                        <?php foreach ($restaurants as $restaurant):?>
                                            <li data-value="<?php echo $restaurant->post_title?>"><?php _e('Pick up at','tatsu_theme')?> - <b><?php echo $restaurant->post_title?></b></li>
                                        <?php endforeach;?>
                                    </ul>
                                <?php endif;?>
                            </div>
                            <?php echo get_template_part('tpl-parts/checkout/tpl-delivery-time')?>
                        </section>
                        <?php do_action('woocommerce_checkout_shipping'); ?>
                        <?php do_action('woocommerce_checkout_billing'); ?>
                    </div>

                    <?php do_action('woocommerce_checkout_after_customer_details'); ?>

                <?php endif; ?>

                    <a href="#" class="submit-btn step-proceed">
                        <?php _e('Next','tatsu_theme')?>
                        <img src="<?php echo THEME_DIR_URI?>/dist/img/icons/long-arrow-dark.svg" alt="" class="js__img-to-svg">
                    </a>
                </div>
                <div class="steps step-2" style="display: none">
                    <div class="payment-picker">
                        <?php echo do_action('woocommerce_checkout_step_2')?>
                        <div class="payment-picker__footer">

                            <div class="default-checkbox">
                                <input type="checkbox" name="agreement" id="agreement"  >
                                <label for="agreement"><?php _e('I have read and agree with the website terms & conditions','tatsu_theme')?></label>
                            </div>
                        </div>
                    </div>
                    <div class="inputs-grid">
                        <a href="#" class="submit-btn step-proceed step-prev">
                            <img src="<?php echo THEME_DIR_URI?>/dist/img/icons/long-arrow-dark.svg" alt="" class="js__img-to-svg">
                            <?php _e('Prev','tatsu_theme')?>
                        </a>
                        <button type="submit" class="submit-btn">
                            <?php _e('Next','tatsu_theme')?>
                            <img src="<?php echo THEME_DIR_URI?>/dist/img/icons/long-arrow-dark.svg" alt="" class="js__img-to-svg">
                        </button>
                    </div>
                </div>
            </div>
            <div class="checkout-page__aside">
                <?php do_action('woocommerce_checkout_before_order_review_heading'); ?>

                <?php do_action('woocommerce_checkout_before_order_review'); ?>

                <div id="order_review" class="woocommerce-checkout-review-order">
                    <?php do_action('woocommerce_checkout_order_review'); ?>
                </div>

                <?php do_action('woocommerce_checkout_after_order_review'); ?>
            </div>
        </div>

    </form>

    <?php do_action('woocommerce_after_checkout_form', $checkout); ?>
</div>
