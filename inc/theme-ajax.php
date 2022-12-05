<?php
if (wp_doing_ajax()) {
    add_action('wp_ajax_set_cookie', 'set_cookie_handler');
    add_action('wp_ajax_nopriv_set_cookie', 'set_cookie_handler');
    function set_cookie_handler()
    {
        setcookie("accept_cookie", 'true', strtotime('+30 days'), '/');
        $return = array(
            'success' => true
        );

        wp_send_json_success($return);
        wp_die();
    }

    add_action('wp_ajax_save_account_details', 'save_account_details_handler');
    function save_account_details_handler()
    {
        $postdata = $_POST;
        $user = wp_get_current_user();

        $user->first_name = $postdata['user_firstname'];
        $user->last_name = $postdata['user_lastname'];
        $user->user_email = $postdata['user_email'];
        wp_update_user($user);

        $metaKeyVals = array(
            'billing_same' => ($postdata['billing_same']) ? 1 : 0,
            'billing_address_1' => $postdata['billing_address_1'],
            'billing_country' => $postdata['billing_country'],
            'billing_postcode' => $postdata['billing_postcode'],
            'billing_house' => $postdata['billing_house'],
            'billing_postcode_suffix' => $postdata['billing_postcode_suffix'],
            'billing_city' => $postdata['billing_city'],
            'shipping_address_1' => $postdata['shipping_address_1'],
            'shipping_country' => $postdata['shipping_country'],
            'shipping_postcode' => $postdata['shipping_postcode'],
            'shipping_house' => $postdata['shipping_house'],
            'shipping_postcode_suffix' => $postdata['shipping_postcode_suffix'],
            'shipping_city' => $postdata['shipping_city']
        );
        if($postdata['billing_same']){
            $metaKeyVals['billing_address_1'] = $postdata['shipping_address_1'];
            $metaKeyVals['billing_country'] = $postdata['shipping_country'];
            $metaKeyVals['billing_postcode'] = $postdata['shipping_postcode'];
            $metaKeyVals['billing_house'] = $postdata['shipping_house'];
            $metaKeyVals['billing_postcode_suffix'] = $postdata['shipping_postcode_suffix'];
            $metaKeyVals['billing_city'] = $postdata['shipping_city'];
        }
        foreach ($metaKeyVals as $key => $val) {
            update_user_meta($user->ID, $key, $val);
        }
        $return = array(
            'success' => true
        );

        wp_send_json_success($return);
        wp_die();
    }

    add_action('wp_ajax_get_more_orders', 'get_more_orders_handler');
    function get_more_orders_handler()
    {
        $page = $_POST['page'];
        $user = wp_get_current_user();
        $orders = wc_get_orders(array('customer_id' => $user->ID, 'numberposts' => 2, 'paged' => $page));
        ob_start();
        $response = '';
        foreach ($orders as $order) {
            set_query_var('order', $order);
            get_template_part('/tpl-parts/shortcodes/tpl-part-order', 'item');
        }
        $response = ob_get_clean();
        if ($response != '') {
            $return = array(
                'success' => true,
                'html' => $response,
            );
        } else {
            $return = array(
                'success' => false
            );
        }

        wp_send_json($return);
        wp_die();
    }

    add_action('wp_ajax_nopriv_ajaxlogin', 'ajax_login');
    function ajax_login()
    {

        check_ajax_referer('ajax-login-nonce', 'security');

        $info = array();
        $info['user_login'] = $_POST['username'];
        $info['user_password'] = $_POST['password'];
        $info['remember'] = true;

        $user_signon = wp_signon($info, false);
        if (is_wp_error($user_signon)) {
            $return = array(
                'success' => false,
            );
        } else {
            $return = array(
                'success' => true,
            );
        }
        wp_send_json($return);
        wp_die();
    }

    add_action('wp_ajax_nopriv_ajaxregister', 'ajax_register');
    function ajax_register()
    {

        check_ajax_referer('ajax-register-nonce', 'signonsecurity');

        $info = array();
        $info['user_nicename'] = $info['nickname'] = $info['display_name'] = $info['first_name'] = $info['user_login'] = sanitize_user($_POST['firstname']);
        $info['last_name'] = sanitize_text_field($_POST['lastname']);
        $info['user_pass'] = sanitize_text_field($_POST['password']);
        $info['user_email'] = sanitize_email($_POST['email']);

        // Register the user
        $user_id = wc_create_new_customer($info['user_email'], $info['nickname'], $info['user_pass'], $info);
        if (!is_wp_error($user_id)) {
            wp_update_user(array('ID' => $user_id, 'role' => 'customer'));

            wp_send_json(array('success' => true, 'redirect' => get_permalink(get_option('woocommerce_myaccount_page_id'))));
        } else {
            wp_send_json(array('success' => false,'error'=> $user_id->get_error_message()));
        }

        wp_die();
    }

    add_action('wp_ajax_ajaxchange_quantity', 'ajax_change_minicart_quantity');
    add_action('wp_ajax_nopriv_ajaxchange_quantity', 'ajax_change_minicart_quantity');
    function ajax_change_minicart_quantity()
    {
        $cartKeySanitized = filter_var($_POST['cart_item_key'], FILTER_SANITIZE_STRING);
        $cartQtySanitized = filter_var($_POST['cart_item_qty'], FILTER_SANITIZE_STRING);
        WC()->cart->set_quantity($cartKeySanitized, $cartQtySanitized);
        wp_send_json(array('success' => true));
        wp_die();
    }

    add_action('wp_ajax_ajaxapply_coupon', 'ajax_apply_minicart_coupon');
    add_action('wp_ajax_nopriv_ajaxapply_coupon', 'ajax_apply_minicart_coupon');
    function ajax_apply_minicart_coupon()
    {
        $couponcode = filter_var($_POST['code'], FILTER_SANITIZE_STRING);
        //WC()->cart->remove_coupons();
        $res = WC()->cart->add_discount($couponcode);
        wp_send_json(array('success' => $res));
        wp_die();
    }

    add_action('wp_ajax_ajaxremove_coupon', 'ajax_remove_minicart_coupon');
    add_action('wp_ajax_nopriv_ajaxremove_coupon', 'ajax_apply_majax_remove_minicart_couponinicart_coupon');
    function ajax_remove_minicart_coupon()
    {
        $couponcode = filter_var($_POST['code'], FILTER_SANITIZE_STRING);
        //WC()->cart->remove_coupons();
        $res = WC()->cart->remove_coupon($couponcode);
        wp_send_json(array('success' => $res));
        wp_die();
    }


    add_action('wp_ajax_change_delivery_place', 'change_delivery_place');
    add_action('wp_ajax_nopriv_change_delivery_place', 'change_delivery_place');
    function change_delivery_place()
    {
        $posts = get_posts(
            array(
                'title' => $_POST['delivery_place'],
                'post_type' => 'restaurants'
            )
        );

        $data = array();
        ob_start();
        if($posts[0]){
            set_query_var('restaurant', $posts[0]);
            $data = array(
                'shipping_state' => get_field('state',$posts[0]->ID),
                'shipping_address_1' => get_field('address',$posts[0]->ID),
                'shipping_address_2' => get_field('house',$posts[0]->ID),
                'shipping_postcode' => get_field('postcode',$posts[0]->ID),
                'shipping_postcode_suffix' => get_field('suffix',$posts[0]->ID),
                'shipping_city' => get_field('city',$posts[0]->ID),
                'shipping_country' => 'NL',
                'billing_state' => get_field('state',$posts[0]->ID),
                'billing_address_1' => get_field('address',$posts[0]->ID),
                'billing_address_2' => get_field('house',$posts[0]->ID),
                'billing_postcode' => get_field('postcode',$posts[0]->ID),
                'billing_postcode_suffix' => get_field('suffix',$posts[0]->ID),
                'billing_city' => get_field('city',$posts[0]->ID),
                'billing_country' => 'NL',
            );
        }
        get_template_part('tpl-parts/checkout/tpl-delivery-time');
        $html = ob_get_clean();
        $return = array(
            'success' => true,
            'timepicker' => $html,
            'data' => $data
        );


        wp_send_json($return);
        wp_die();
    }
}