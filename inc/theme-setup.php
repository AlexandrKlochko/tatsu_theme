<?php

if (!function_exists('tatsu_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function tatsu_setup()
    {
        load_theme_textdomain('tatsu', get_template_directory() . '/languages');

        add_theme_support('post-thumbnails');
        add_theme_support( 'custom-logo' );
        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus(
            array(
                'main-menu' => __('Main - Menu', 'tatsu_theme'),
                'secoundary-header-menu' => __('Secondary header - Menu', 'tatsu_theme'),
                'front-page-menu' => __('Home page - Menu', 'tatsu_theme'),
                'footer-about' => __('Footer About - Menu', 'tatsu_theme'),
                'footer-follow' => __('Footer Follow - Menu', 'tatsu_theme'),
                'account-info' => __('Account Info - Menu', 'tatsu_theme'),
            )
        );

    }
endif;
add_action('after_setup_theme', 'tatsu_setup');

if(!class_exists('Tatsu_Walker_Nav_Menu')){
    require_once(get_template_directory() . '/inc/walker/tatsu_walker_nav_menu.php');
}