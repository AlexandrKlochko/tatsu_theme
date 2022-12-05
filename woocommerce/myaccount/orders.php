<?php
/**
 * Orders
 *
 * Shows orders on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/orders.php.
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

do_action('woocommerce_before_account_orders', $has_orders);?>

<div class="cabinet-page">
    <h1 class="cabinet-title"><?php _e('Your orders', 'tatsu_theme') ?></h1>
    <?php if ($has_orders) : ?>
        <div class="cabinet-desc">
            <p><?php echo apply_filters('woocommerce_my_account_my_orders_description', esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce blandit odio nec ultrices placerat.', 'woocommerce')); ?></p>
        </div>
        <?php if ($has_orders): ?>
            <div class="orders-list" id="orders-list">
                <?php foreach ($customer_orders->orders as $customer_order): ?>
                    <?php $order = wc_get_order($customer_order); ?>
                    <?php set_query_var('order', $order); ?>
                    <?php echo get_template_part('/tpl-parts/shortcodes/tpl-part-order', 'item'); ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php do_action('woocommerce_before_account_orders_pagination'); ?>

        <?php if (1 < $customer_orders->max_num_pages) : ?>
            <div class="tac">
                <form method="post" action="<?php echo admin_url("admin-ajax.php") ?>">
                    <input type="hidden" name="action" value="get_more_orders"/>
                    <input type="hidden" name="page" value="2"/>
                    <a href="#" class="order-add"><?php _e('Add', 'tatsu_theme') ?></a>
                </form>
            </div>
        <?php endif; ?>
    <?php else : ?>
        <div class="cabinet-desc">
            <p><?php esc_html_e('No order has been made yet.', 'woocommerce'); ?></p>
        </div>
    <?php endif; ?>
</div>

<?php do_action('woocommerce_after_account_orders', $has_orders); ?>
