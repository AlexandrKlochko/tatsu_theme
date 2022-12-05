<div class="order-item">
    <div class="order-item__head">
        <div class="order-item__meta"><?php _e('Order', 'tatsu_theme') ?> <?php echo $order->get_id() ?>
            - <?php echo $order->get_date_created()->date("d/m/Y H:i") ?></div>
        <?php $orderUser = $order->get_user() ?>
        <div class="order-item__info">
            <?php echo $orderUser->user_firstname ?> <?php echo $orderUser->user_lastname ?> <br>
            <?php echo $order->get_billing_state() ?> / <?php echo $order->get_billing_address_1() ?> / <br>
            <?php echo $order->get_billing_postcode() ?> <?php echo get_post_meta($order->get_id(), "billing_suffix", true); ?>
            / <?php echo $order->get_billing_city() ?>
        </div>
    </div>
    <div class="order-item__body">
        <?php foreach ($order->get_items() as $item):
            $product = $item->get_product();
            $image_url = wp_get_attachment_image_src(get_post_thumbnail_id($item->get_product_id()), 'single-post-thumbnail'); ?>
            <div class="order-item__line">
                <div class="order-item__main">
                    <img src="<?php echo $image_url[0] ?>" alt="" class=order-item__avatar laoding=lazy decoding=async
                         width=70 height=70>
                    <div class="order-item__excerpt">
                        <?php echo $item->get_name() ?>
                        <div class="order-item__quantity">x<?php echo $item->get_quantity() ?></div>
                    </div>
                </div>
                <div class="order-item__price"><?php echo get_woocommerce_currency_symbol() ?><?php echo $item->get_total() ?></div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="order-item__foot">
        <?php $pdf_url = wp_nonce_url( admin_url( 'admin-ajax.php?action=generate_wpo_wcpdf&template_type=invoice&order_ids=' . $order->get_id() . '&my-account'), 'generate_wpo_wcpdf' );?>
        <a href="<?php echo $pdf_url?>" target="_blank"><?php _e('Download Invoice','tatsu_theme')?></a>
    </div>
</div>