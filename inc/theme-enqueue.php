<?php
function tatsu_theme_scripts()
{
    // Load css
    wp_enqueue_style('_owl-carousel-styles', 'https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css', false, time());
    wp_enqueue_style('_owl-carousel-theme-styles', 'https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css', false, time());

    wp_enqueue_style('style-css', get_stylesheet_uri());
    wp_enqueue_style('_main-styles', THEME_DIR_URI . '/dist/css/style.css', false, time());

    // Load js
    wp_enqueue_script('_main-js', THEME_DIR_URI . '/dist/js/scripts.min.js', array('jquery'), time());
    wp_enqueue_script('_owl-carousel-js', 'https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js', array('jquery'), time());


}

add_action('wp_enqueue_scripts', 'tatsu_theme_scripts');