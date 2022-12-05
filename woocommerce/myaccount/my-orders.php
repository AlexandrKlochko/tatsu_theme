<?php
/**
 * My Orders - Deprecated
 *
 * @deprecated 2.6.0 this template file is no longer used. My Account shortcode uses orders.php.
 * @package WooCommerce\Templates
 */

defined( 'ABSPATH' ) || exit;


$customer_orders = get_posts(
	apply_filters(
		'woocommerce_my_account_my_orders_query',
		array(
			'numberposts' => '2',
			'meta_key'    => '_customer_user',
			'meta_value'  => get_current_user_id(),
			'post_type'   => wc_get_order_types( 'view-orders' ),
			'post_status' => array_keys( wc_get_order_statuses() ),
		)
	)
);
var_dump($customer_orders);
if ( $customer_orders ) : ?>

        <h1 class="cabinet-title"><?php _e('Your orders','tatsu_theme')?></h1>
        <div class="cabinet-desc">
            <p><?php echo apply_filters( 'woocommerce_my_account_my_orders_description', esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce blandit odio nec ultrices placerat.', 'woocommerce' ) );?></p>
        </div>
        <?php if($customer_orders):?>
            <div class="orders-list" id="orders-list">
                <?php foreach ($customer_orders as $customer_order):?>
                    <?php $order = wc_get_order( $customer_order );?>
                    <?php set_query_var( 'order', $order);?>
                    <?php echo get_template_part('/tpl-parts/shortcodes/tpl-part-order','item');?>
                <?php endforeach;?>
            </div>
        <?php endif;?>
        <div class="tac">
            <form method="post" action="<?php echo admin_url( "admin-ajax.php" ) ?>">
                <input type="hidden" name="action" value="get_more_orders"/>
                <input type="hidden" name="page" value="2"/>
                <a href="#" class="order-add"><?php _e('Add','tatsu_theme')?></a>
            </form>
        </div>
    </div>
<?php endif; ?>
