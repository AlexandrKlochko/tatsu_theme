<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined('ABSPATH') || exit;
?>
<div class="checkout-page woocommerce-order">
    <a href="#" class="back-btn" onclick="history.back(); return false;">
        <img src="<?php echo THEME_DIR_URI ?>/dist/img/icons/arrow-left-dark.svg" alt="">
    </a>
    <?php
    if ($order) :
        do_action('woocommerce_before_thankyou', $order->get_id()); ?>

        <div class="checkout-page__grid">
            <div class="checkout-page__main">
                <ul class="checkout-timeline">
                    <li class="step-li"><?php _e('Information', 'tatsu_theme') ?></li>
                    <li class="step-li"><?php _e('Payment', 'tatsu_theme') ?></li>
                    <li class=" is-current"><?php _e('Confirmation', 'tatsu_theme') ?></li>
                </ul>
            </div>
            <div class="checkout-page__aside"></div>
        </div>
        <?php if ($order->has_status('failed')) : ?>
            <div class="checkout-page__grid">
                <div class="checkout-page__main">
                    <h1 class="section-title">
                        <?php _e('Payment failed', 'tatsu_theme') ?>
                        <img src="<?php echo THEME_DIR_URI ?>/dist/img/icons/error.svg" alt="" width="19" height="19">
                    </h1>
                    <div class="checkout-end">
                        <div class="checkout-end__content">
                            <div class="checkout-end__info"><?php esc_html_e('Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce'); ?>
                            </div>
                            <a href="<?php echo esc_url($order->get_checkout_payment_url()); ?>"
                               class="button pay submit-btn"><?php esc_html_e('Pay', 'woocommerce'); ?>
                                <img src="<?php echo THEME_DIR_URI ?>/dist/img/icons/long-arrow-dark.svg" alt=""
                                     class="js__img-to-svg">
                            </a>
                            <?php if (is_user_logged_in()) : ?>
                                <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>"
                                   class="button pay submit-btn"><?php esc_html_e('My account', 'woocommerce'); ?>
                                    <img src="<?php echo THEME_DIR_URI ?>/dist/img/icons/long-arrow-dark.svg" alt=""
                                         class="js__img-to-svg"></a>
                            <?php endif; ?>
                        </div>
                        <a href="<?php echo get_post_type_archive_link('restaurants')?>" class="grey-link"><?php _e('Contact us', 'tatsu_theme') ?></a>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <div class="checkout-page__grid">
            <div class="checkout-page__main">
                <h1 class="section-title">
                    <?php _e('We received your order', 'tatsu_theme') ?>
                    <img src="<?php echo THEME_DIR_URI ?>/dist/img/icons/checked-radio.svg" alt="" width="18"
                         height="18">
                </h1>
                <div class="checkout-end">
                    <div class="checkout-end__content">
                        <div class="checkout-end__order"><?php _e('Order #', 'tatsu_theme') ?><?php echo $order->get_order_number(); ?>
                            - <?php echo $order->get_date_created()->date("d/m/Y H:i") ?></div>
                        <div class="checkout-end__info">
                            <?php $orderUser = $order->get_user() ?>
                            <?php echo $orderUser->user_firstname ?> <?php echo $orderUser->user_lastname ?> <br>
                            <?php echo $order->get_shipping_state() ?> / <?php echo $order->get_shipping_address_1() ?>
                            / <?php echo $order->get_shipping_postcode() ?> <?php echo get_post_meta($order->get_id(), "billing_postcode_suffix", true); ?>
                            / <?php echo $order->get_shipping_city() ?>
                        </div>
                        <?php $pdf_url = wp_nonce_url(admin_url('admin-ajax.php?action=generate_wpo_wcpdf&template_type=invoice&order_ids=' . $order->get_id()), 'generate_wpo_wcpdf'); ?>
                        <a class="submit-btn" href="<?php echo $pdf_url ?>" target="_blank">
                            <?php _e('Download Invoice', 'tatsu_theme') ?>
                            <img src="<?php echo THEME_DIR_URI ?>/dist/img/icons/long-arrow-dark.svg" alt=""
                                 class="js__img-to-svg">
                        </a>
                    </div>
                    <a href="<?php echo get_post_type_archive_link('restaurants')?>" class="grey-link"><?php _e('Contact us', 'tatsu_theme') ?></a>
                </div>
            </div>
            <div class="checkout-page__aside">
                <div class="checkout-final-text"><?php _e('While you’re waiting for your delicious food, check out our social media ;', 'tatsu_theme') ?></div>
                <?php if (have_rows('social_links', 'option')): ?>
                    <ul class="socials-list">
                        <?php while (have_rows('social_links', 'option')): the_row(); ?>
                            <?php $link = get_sub_field('link'); ?>
                            <?php $icon = get_sub_field('icon'); ?>
                            <li>
                                <a href="<?php echo esc_url($link['url']) ?>" rel="noopener"
                                   target="<?php echo $link['target'] ?>">
                                    <img src="<?php echo esc_url($icon['url']) ?>"
                                         alt="<?php echo esc_attr($icon['alt']); ?>"
                                         class="js__img-to-svg">
                                </a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
        <?php endif ?>
    <?php endif; ?>
</div>
