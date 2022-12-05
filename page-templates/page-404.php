<?php
/** Template Name: 404
*/
get_header();?>
<main class="main">
    <section class="section-404" style="<?php get_background_vars()?>">
        <div class="wrap">
            <h1 class="section-title" data-prefix="404"><?php _e('Page not found','tatsu_theme')?></h1>
            <a href="<?php echo site_url()?>" class="section-404__link">
                <?php _e('Go to homepage','tatsu_theme')?>
                <img src="<?php echo THEME_DIR_URI?>/dist/img/icons/long-arrow-light.svg" alt="" class="js__img-to-svg">
            </a>
        </div>
    </section>
</main>
<?php get_footer('front')?>
