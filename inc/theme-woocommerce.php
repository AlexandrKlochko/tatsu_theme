<?php
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 20);
remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
remove_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
add_action('woocommerce_checkout_step_2','woocommerce_checkout_payment', 20);
add_filter('woocommerce_checkout_update_customer_data', '__return_false' );

add_filter( 'add_to_cart_fragments', function($fragments) {
    global $woocommerce;
    ob_start();
    woocommerce_mini_cart();
    $fragments['div.woocommerce-basket-content'] = ob_get_clean();
    $fragments['span.basket-link-count'] = '<span class="basket-link-count">'.$woocommerce->cart->cart_contents_count.'</span>';
    return $fragments;
});

add_filter( 'woocommerce_my_account_my_orders_query', 'custom_my_account_orders', 10, 1 );
function custom_my_account_orders( $args ) {

    $args['posts_per_page'] =2;
    return $args;
}