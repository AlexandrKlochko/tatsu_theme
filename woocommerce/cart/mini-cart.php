<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined('ABSPATH') || exit; ?>

<div class="woocommerce-basket-content">

    <?php do_action('woocommerce_before_mini_cart'); ?>
    <?php if (!WC()->cart->is_empty()) : ?>
        <div class="section-title"><?php _e('Your bag', 'tatsu_theme') ?></div>
        <div class="section-subtitle"><?php _e('Menu', 'tatsu_theme') ?></div>
        <div class="basket-list woocommerce-mini-cart cart_list product_list_widget <?php echo esc_attr($args['list_class']); ?>">
            <?php do_action('woocommerce_before_mini_cart_contents'); ?>
            <?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

                if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key)) {
                    $product_name = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);
                    $product_price = apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
                    $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
                    $image = wp_get_attachment_image_src(get_post_thumbnail_id($product_id), 'single-post-thumbnail');
                    ?>
                    <div class="basket-item woocommerce-mini-cart-item <?php echo esc_attr(apply_filters('woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key)); ?>">
                        <div class="basket-item__line">
                            <div class="basket-item__main">
                                <a href="<?php echo esc_url($product_permalink); ?>">
                                    <img src="<?php echo $image['0'] ?>" alt=""
                                         class="basket-item__photo" loading="lazy" decoding="async" width="70"
                                         height="70x">
                                </a>
                                <div class="basket-item__excerpt"><?php echo $product_name ?></div>
                            </div>
                            <div class="basket-item__price"><?php echo $product_price ?> <?php
                                echo apply_filters(
                                    'woocommerce_cart_item_remove_link',
                                    sprintf(
                                        '<a href="%s" class=" remove_from_cart_button modal-basket__close" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">&times;</a>',
                                        esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                        esc_attr( $product_id ),
                                        esc_attr( $cart_item_key ),
                                        esc_attr( $_product->get_sku() )
                                    ),
                                    $cart_item_key
                                );
                                ?></div>
                        </div>
                        <div class="quantity-counter" data-item-key="<?php echo $cart_item_key?>">
                            <button type="button" data-minus><?php _e('Minus', 'tatsu_theme') ?></button>
                            <input type="text" name="quantity" readonly value="<?php echo $cart_item['quantity']?>">
                            <button type="button" data-plus><?php _e('Plus', 'tatsu_theme') ?></button>
                        </div>
                    </div>
                    <?php
                }
            } ?>

        </div>
        <div class="modal-basket__add">
            <a href="<?php echo wc_get_page_permalink( 'shop' );?>"><?php _e('Add Items','tatsu_theme')?></a>
        </div>
        <div class="default-checkbox">
            <input type="checkbox" id="coupon-checkmark" class="js__toggle-coupon-input" data-toggle="#coupon-block">
            <label for="coupon-checkmark"><?php _e('I have a coupon code','tatsu_theme')?></label>
        </div>
        <div class="default-input" id="coupon-block" style="display:none;">
            <input type="text" name="coupon_code" >
            <?php wp_nonce_field( 'apply-coupon', 'security' ); ?>
            <label><?php _e('Enter your coupon','tatsu_theme')?></label>
            <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?></button>
        </div>
        <div class="basket-totals">
            <div class="basket-totals__row">
                <div class="basket-totals__label"><?php _e('Delivery','tatsu_theme')?></div>
                <div class="basket-totals__value">-</div>
            </div>
            <div class="basket-totals__row">
                <div class="basket-totals__label"><?php _e( 'Subtotal excl. BTW', 'tatsu_theme' ); ?></div>
                <div class="basket-totals__value"><?php echo wc_cart_totals_subtotal_html();?></div>
            </div>
            <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
                <div class="basket-totals__row coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                    <div class="basket-totals__label"><?php wc_cart_totals_coupon_label( $coupon ); ?></div>
                    <div class="basket-totals__value"><?php wc_cart_totals_coupon_html( $coupon ); ?></div>
                </div>
            <?php endforeach; ?>
            <?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) {
                $taxable_address = WC()->customer->get_taxable_address();
                $estimated_text  = '';

                if ( WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping() ) {
                    /* translators: %s location. */
                    $estimated_text = sprintf( ' <small>' . esc_html__( '(estimated for %s)', 'woocommerce' ) . '</small>', WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] );
                }

                if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) {
                    foreach ( WC()->cart->get_tax_totals() as $code => $tax ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
                        ?>
                        <div class="basket-totals__row tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                            <div class="basket-totals__label"><?php echo esc_html( $tax->label ) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
                            <div class="basket-totals__value"><?php echo wp_kses_post( $tax->formatted_amount ); ?></div>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <div class="basket-totals__row ">
                        <div class="basket-totals__label"><?php echo esc_html( WC()->countries->tax_or_vat() ) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
                        <div class="basket-totals__value"><?php wc_cart_totals_taxes_total_html(); ?></div>
                    </div>
                    <?php
                }
            }            ?>
            <div class="basket-totals__row">
                <div class="basket-totals__label"><b><?php _e('Grand total','tatsu_theme')?></b> <span><?php _e('(Includes btw)','tatsu_theme')?></span></div>
                <div class="basket-totals__value"><?php wc_cart_totals_order_total_html(); ?></div>
            </div>
        </div>
        <a href="<?php echo wc_get_checkout_url()?>" class="submit-btn">
            <?php _e('Next','tatsu_theme')?>
            <img src="<?php echo THEME_DIR_URI ?>/dist/img/icons/long-arrow-dark.svg" alt="" class="js__img-to-svg">
        </a>
    <?php else : ?>
        <div class="modal-basket__empty">
            <div class="section-title"><?php _e('Looks like it’s empty','tatsu_theme')?></div>
            <a href="<?php echo wc_get_page_permalink( 'shop' );?>" class="submit-btn ">
                <?php _e('Go to order', 'tatsu_theme') ?>
                <img src="<?php echo THEME_DIR_URI ?>/dist/img/icons/long-arrow-dark.svg" alt="" class="js__img-to-svg">
            </a>
        </div>
    <?php endif; ?>
    <span class="modal-basket__close js__modal-basket-close"></span>

    <?php do_action('woocommerce_after_mini_cart'); ?>
</div>