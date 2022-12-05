<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta name="viewport" content="initial-scale=1.0, width=device-width"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="theme-color" content="#131517"/>
    <meta charset="<?php bloginfo('charset'); ?>">

    <title><?php bloginfo('name'); ?><?php wp_title('|', true, 'left'); ?></title>

    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?> style="<?php get_pattern_vars(); ?>">
<header class="header js__header">
    <div class="wrap">
        <button class="toggle-menu js__toggle-menu" type="button"><span></span></button>
        <?php $custom_logo_id = get_theme_mod('custom_logo'); ?>
        <?php if ($image = wp_get_attachment_image_src($custom_logo_id, 'full')): ?>
            <a href="<?php echo pll_home_url() ?>" class="logo"  width="55" height="27">
                <?php echo file_get_contents($image[0]) ?>
            </a>
        <?php endif; ?>
        <div class="header-menu js__header-menu">
            <?php wp_nav_menu(array(
                'theme_location' => 'main-menu',
                'container' => 'nav',
                'container_class' => 'primary-menu',
                'menu_id' => false,
                'echo' => true,
                'menu_class' => '',
                'depth' => 1,
                'walker' => new Tatsu_Walker_Nav_Menu()
            )); ?>
            <?php $menuItems = get_nav_menu_items_by_location('secoundary-header-menu')?>
                <ul class="secondary-menu">
                    <?php foreach($menuItems as $menuItem):?>
                        <li><a href="<?php echo $menuItem->url ?>" class="small-btn"><?php echo $menuItem->post_title?></a></li>
                    <?php endforeach;?>
                    <li><a href="<?php if(is_user_logged_in()):?><?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?><?php else:?>#modal-login<?php endif;?>"
                           class="user-link <?php if(!is_user_logged_in()):?>js__modal-auth-open<?php endif;?>">
                            <img src="<?php echo THEME_DIR_URI?>/dist/img/icons/user.svg" alt="<?php _e('Log in','tatsu_theme')?>"></a></li>
                    <li><a href="#" class="basket-link js__basket-link"><span class="basket-link-count"><?php echo WC()->cart->cart_contents_count?></span></a></li>
                </ul>
            <button class="header-menu__close js__toggle-menu" type="button">
                <img src="<?php echo THEME_DIR_URI ?>/dist/img/icons/close.svg" alt="" loading="lazy" decoding="async">
            </button>
            <?php echo get_template_part('/tpl-parts/tpl-modals','header') ?>
        </div>
        <a href="#" class="mobile-basket-link basket-link js__basket-link"><span class="basket-link-count"><?php echo WC()->cart->cart_contents_count?></span></a></li>
    </div>
</header>