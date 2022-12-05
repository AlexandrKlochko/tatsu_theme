<?php
/**
 * Template Name: Page Menu
 */ ?>
<?php
$all_categories = get_categories(array(
    'taxonomy' => 'product_cat',
    'hierarchical' => false,
    'hide_empty' => true
));
$all_tags = get_categories(array(
    'taxonomy' => 'product_tag',
    'hierarchical' => false,
    'hide_empty' => false
)); ?>
<?php get_header(); ?>
<?php

// Load css

//echo '<link rel="stylesheet" href="' . THEME_DIR_URI . '/inc/share-button/needsharebutton.min.css' . '">';
//echo '<script  src="' . THEME_DIR_URI . '/inc/share-button/needsharebutton.js' . '"></script>';


?>
    <main class="main">
        <div class="wrap">
            <div class="page-menu-grid">
                <aside class="page-menu-grid__sidebar">
                    <div class="sticky-zone">
                        <div class="allergies_menu" >
                            <button class="allergies-list__toggle"
                                    data-toggle><?php _e('Allergies', 'tatsu_theme') ?></button>
                        </div>
                        <?php echo get_template_part('tpl-parts/menu-page/tpl-menu-list');?>
                        <?php echo get_template_part('tpl-parts/menu-page/tpl-allergies-list');?>
                    </div>
                </aside>
                <div class="page-menu-grid__main">

                    <h1 class="section-title"><?php _e('Order Menu') ?></h1>
                    <div class="zipcode-checker js__zipcode-checker">
                        <div class="zipcode-checker__caption"><?php _e('Enter your zipcode and see if we deliver to you.','tatsu_theme')?></div>
                        <form class="zipcode-checker__form" method="post" action="<?php echo admin_url('admin-ajax.php')?>">
                            <input type="hidden" name="action" value="WCZP_check_location">
                            <input type="text" class="zipcode-checker__field" placeholder="<?php _e('Zipcode','tatsu_theme')?>" required name="postcode">
                            <button class="btn-arrow" type="submit">
                                <?php _e('Check Zipcode','tatsu_theme')?>
                                <img src="<?php echo THEME_DIR_URI?>/dist/img/icons/long-arrow-dark.svg" alt="" class="js__img-to-svg">
                            </button>
                        </form>
                        <div class="zipcode-checker__result" data-result="yes">
                            <div class="zipcode-checker__result-title"><?php _e('Yes we deliver to your place!','tatsu_theme')?></div>
                            <div class="zipcode-checker__result-text"><a href="#" data-close-result><?php _e('Check another
                                    address','tatsu_theme')?></a></div>
                        </div>
                        <div class="zipcode-checker__result" data-result="no">
                            <div class="zipcode-checker__result-title"><?php _e('Sorry we don’t deliver to your place yet','tatsu_theme')?></div>
                            <div class="zipcode-checker__result-text"><a href="#" data-close-result><?php _e('Check another
                                    address','tatsu_theme')?></a></div>
                        </div>
                    </div>

                    <!--<div class="mobile-download-menu" >
                        <?php /*if (have_rows('menu_files', 'option')): */?>
                            <?php /*while (have_rows('menu_files', 'option')): the_row(); */?>
                                <?php /*$link = get_sub_field('file'); */?>
                                <?php /*$link_title = get_sub_field('link_title'); */?>
                                <div class="menu-link">
                                    <a href="<?php /*echo esc_url($link) */?>" rel="noopener" class="btn-arrow"
                                       target="_blank">
                                        <?php /*echo $link_title*/?>
                                    </a>
                                </div>
                            <?php /*endwhile; */?>
                        <?php /*endif;*/?>
                    </div>-->
                    <?php foreach ($all_categories as $key => $category): ?>
                        <div class="menu-section js__menu-section" id="<?php echo $category->slug ?>">
                            <div class="menu-section__head">
                                <div class="menu-section__title"><?php echo $category->name ?></div>
                                <?php if ($key == 0): ?>
                                    <ul class="menu-section__links" data-links>
                                            <?php /*if (have_rows('menu_files', 'option')): */?><!--
                                                <?php /*while (have_rows('menu_files', 'option')): the_row(); */?>
                                                    <?php /*$link = get_sub_field('file'); */?>
                                                    <?php /*$link_title = get_sub_field('link_title'); */?>
                                                    <li class="menu-link download-link">
                                                        <a href="<?php /*echo esc_url($link) */?>" rel="noopener" class="btn-arrow"
                                                           target="_blank">
                                                            <?php /*echo $link_title*/?>
                                                        </a>
                                                    </li>
                                                <?php /*endwhile; */?>
                                            --><?php /*endif;*/?>
                                        <!--<li><a href="#" class="download_menu"><?php _e('Download Menu') ?></a></li>
                                        <li>
                                            <div class="share-wrap">
                                                <div class="share-item">
                                                    <div id="share-button-1"
                                                         class="need-share-button-default default-link"
                                                         data-share-position="middleLeft"
                                                         data-share-icon-style="box"
                                                         data-share-networks="Mailto,Twitter,Pinterest,Facebook,GooglePlus,Linkedin"
                                                         data-share-share-button-class="default-link"><span
                                                                class="default-link"><strong><?php _e('Share the menu', 'tatsu_theme') ?></strong></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>-->
                                    </ul>
                                <?php endif; ?>
                            </div>
                            <div class="menu-section__grid">
                                <?php $products = wc_get_products(array(
                                        'category' => array($category->slug),
		                                'posts_per_page' => -1,
                                )); ?>
                                <?php foreach ($products as $key => $product):?>
                                    <div class="menu-card <?php if ($key == array_key_first($products) && count($products)>=3): ?>menu-card--large<?php endif; ?>"
                                         data-check-position>
                                        <?php if (!empty($product->get_image_id())): ?>
                                            <img src="<?php echo get_the_post_thumbnail_url($product->get_id()) ?>"
                                                 alt=""
                                                 class="menu-card__img" loading="lazy" decoding="async">
                                        <?php endif; ?>
                                        <div class="menu-card__head">
                                            <h4 class="menu-card__title"><?php echo $product->get_name() ?></h4>
                                            <span class="menu-card__price"><?php echo $product->get_price_html() ?></span>
                                        </div>
                                        <div class="menu-card__excerpt">
                                            <?php echo get_the_excerpt($product->get_id()); ?>
                                        </div>
                                        <div class="menu-card__footer">
                                            <ul class="menu-card__allergies">
                                                <?php
                                                $terms = get_the_terms($product->get_id(), 'product_tag');

                                                $product_tags = array();
                                                if (!empty($terms) && !is_wp_error($terms)) {
                                                    foreach ($terms as $term) {
                                                        $product_tags[] = $term;
                                                    }
                                                } ?>
                                                <?php foreach ($product_tags as $tag): ?>
                                                    <li>
                                                        <?php if ($icon = get_field('tag_icon', 'product_tag_'.$tag->term_id)): ?>
                                                            <?php echo file_get_contents($icon['url']) ?>
                                                        <?php endif; ?>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                            <a href="<?php echo esc_url( $product->add_to_cart_url() );?>" class="small-btn ajax_add_to_cart add_to_cart_button product_type_simple" data-quantity="1"
                                               data-product_id="<?php echo $product->get_id(); ?>" data-product_sku="<?php echo esc_attr($product->get_sku()) ?>"><?php _e('Add to bag','tatsu_theme')?></a>
                                        </div>
                                        <?php if ($key == array_key_first($products) && count($products)>=3): ?>
                                            <span class="menu-card__label"><?php _e('Best seller', 'tatsu_theme') ?></span>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </main>
    <script>
        jQuery(document).ready(function(){
            // new needShareDropdown(document.getElementById('share-button-1'));
            // new needShareDropdown(document.getElementById('share-button-2'));
        });
    </script>
<?php get_footer(); ?>