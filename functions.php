<?php
/**
 * Store the theme's directory path and uri in constants
 */
define('THEME_DIR_PATH', get_template_directory());
define('THEME_DIR_URI', get_template_directory_uri());

load_theme_textdomain( 'tatsu_theme', get_template_directory() . '/lang' );

require_once(THEME_DIR_PATH. '/inc/theme-setup.php');
require_once(THEME_DIR_PATH. '/inc/theme-cpt.php');
require_once(THEME_DIR_PATH. '/inc/theme-functions.php');
require_once(THEME_DIR_PATH. '/inc/theme-enqueue.php');
require_once(THEME_DIR_PATH. '/inc/theme-init.php');
require_once(THEME_DIR_PATH. '/inc/theme-woocommerce.php');
require_once(THEME_DIR_PATH. '/inc/theme-ajax.php');
require_once(THEME_DIR_PATH. '/inc/theme-shortcodes.php');
require_once(THEME_DIR_PATH. '/inc/theme-cron.php');


if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title' 	=> 'Theme General Settings',
        'menu_title'	=> 'Theme Settings',
        'menu_slug' 	=> 'theme-general-settings',
        'capability'	=> 'edit_posts',
        'redirect'		=> false
    ));
}

