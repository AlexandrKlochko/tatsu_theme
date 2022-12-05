<?php
/**
 * Pay for order form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-pay.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

$totals = $order->get_order_item_totals(); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
?>
<form id="order_review" method="post">
    <div class="basket-list">
        <?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) :
            $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
            $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

            if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key)):
                $product_name = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);
                $product_price = apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
                $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
                $image = wp_get_attachment_image_src(get_post_thumbnail_id($product_id), 'single-post-thumbnail');
                ?>
                <div class="basket-item">
                    <div class="basket-item__line">
                        <div class="basket-item__main">
                            <a href="<?php echo esc_url($product_permalink); ?>">
                                <img src="<?php echo $image['0'] ?>" alt=""
                                     class="basket-item__photo" loading="lazy" decoding="async" width="70"
                                     height="70x">
                            </a>
                            <div class="basket-item__excerpt">
                                <?php echo $product_name ?>
                                <div class="basket-item__quantity">x<?php echo $cart_item['quantity'] ?></div>
                            </div>
                        </div>
                        <div class="basket-item__price"><?php echo $product_price ?></div>
                    </div>
                </div>
            <?php endif;
        endforeach; ?>

    </div>
    <div class="basket-totals">
        <div class="basket-totals__row">
            <div class="basket-totals__label"><?php _e('Delivery', 'tatsu_theme') ?></div>
            <div class="basket-totals__value">-</div>
        </div>
        <div class="basket-totals__row">
            <div class="basket-totals__label"><?php _e('Subtotal exl. VAT', 'tatsu_theme'); ?></div>
            <div class="basket-totals__value"><?php echo wc_cart_totals_subtotal_html(); ?></div>
        </div>
        <?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
            <div class="basket-totals__row coupon-<?php echo esc_attr(sanitize_title($code)); ?>">
                <div class="basket-totals__label"><?php wc_cart_totals_coupon_label($coupon); ?></div>
                <div class="basket-totals__value"><?php wc_cart_totals_coupon_html($coupon); ?></div>
            </div>
        <?php endforeach; ?>
        <?php if (wc_tax_enabled() && !WC()->cart->display_prices_including_tax()) {
            $taxable_address = WC()->customer->get_taxable_address();
            $estimated_text = '';

            if (WC()->customer->is_customer_outside_base() && !WC()->customer->has_calculated_shipping()) {
                /* translators: %s location. */
                $estimated_text = sprintf(' <small>' . esc_html__('(estimated for %s)', 'woocommerce') . '</small>', WC()->countries->estimated_for_prefix($taxable_address[0]) . WC()->countries->countries[$taxable_address[0]]);
            }

            if ('itemized' === get_option('woocommerce_tax_total_display')) {
                foreach (WC()->cart->get_tax_totals() as $code => $tax) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
                    ?>
                    <div class="basket-totals__row tax-rate-<?php echo esc_attr(sanitize_title($code)); ?>">
                        <div class="basket-totals__label"><?php echo esc_html($tax->label) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
                        <div class="basket-totals__value"><?php echo wp_kses_post($tax->formatted_amount); ?></div>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class="basket-totals__row ">
                    <div class="basket-totals__label"><?php echo esc_html(WC()->countries->tax_or_vat()) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
                    <div class="basket-totals__value"><?php wc_cart_totals_taxes_total_html(); ?></div>
                </div>
                <?php
            }
        } ?>
        <div class="basket-totals__row">
            <div class="basket-totals__label"><b><?php _e('Grand total', 'tatsu_theme') ?></b>
                <span><?php _e('(Includes btw)', 'tatsu_theme') ?></span></div>
            <div class="basket-totals__value"><?php wc_cart_totals_order_total_html(); ?></div>
        </div>
    </div>

	<div id="payment">
		<?php if ( $order->needs_payment() ) : ?>
			<ul class="wc_payment_methods payment_methods methods">
				<?php
				if ( ! empty( $available_gateways ) ) {
					foreach ( $available_gateways as $gateway ) {
						wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );
					}
				} else {
					echo '<li class="woocommerce-notice woocommerce-notice--info woocommerce-info">' . apply_filters( 'woocommerce_no_available_payment_methods_message', esc_html__( 'Sorry, it seems that there are no available payment methods for your location. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce' ) ) . '</li>'; // @codingStandardsIgnoreLine
				}
				?>
			</ul>
		<?php endif; ?>
		<div class="form-row">
			<input type="hidden" name="woocommerce_pay" value="1" />

			<?php wc_get_template( 'checkout/terms.php' ); ?>

			<?php do_action( 'woocommerce_pay_order_before_submit' ); ?>
            <button type="submit" class="submit-btn">
                <?php _e('Next','tatsu_theme')?>
                <img src="<?php echo THEME_DIR_URI?>/dist/img/icons/long-arrow-dark.svg" alt="" class="js__img-to-svg">
            </button>
			<?php //echo apply_filters( 'woocommerce_pay_order_button_html', '<button type="submit" class=" submit-btn"  value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '">' . esc_html( $order_button_text ) . '</button>' ); // @codingStandardsIgnoreLine ?>

			<?php do_action( 'woocommerce_pay_order_after_submit' ); ?>

			<?php wp_nonce_field( 'woocommerce-pay', 'woocommerce-pay-nonce' ); ?>
		</div>
	</div>
</form>
