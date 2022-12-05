<?php get_header() ?>
<?php if (have_posts()): ?>
    <main class="main">
        <section class="section-hero" style="<?php get_background_vars(); ?>">
            <?php if ($gallery = get_field('gallery')): ?>
                <div class="front-page-carousel">
                    <div class="owl-carousel">
                        <?php foreach ($gallery as $image): ?>
                            <div style="background-image: url(<?php echo esc_url($image['url']); ?>)"></div>
                        <?php endforeach; ?>
                    </div>
                    <?php if ($carousel_logo = get_field('footer_logo','option')): ?>
                        <img src="<?php echo $carousel_logo['url'] ?>" alt="" class="hero-carousel__logo" loading="lazy"
                             decoding="async">
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <div class="section-hero-content">
            <?php if($gallery):?>
                <div class="front-page-carousel-controls wrap">
                    <div class="owl-carousel-counter">
                        <span class="owl-carousel-current"><?php _e('1', 'tatsu') ?></span><span><?php _e('/');
                            echo count($gallery); ?></span>
                    </div>
                    <div class="owl-controls clickable">
                        <div class="owl-buttons">
                            <div class="owl-prev">&lt;</div>
                            <div class="owl-next">&gt;</div>
                        </div>
                    </div>
                </div>
            <?php endif;?>
            <div class="wrap">
                <div class="hero-plate" data-check-position>
                    <?php if ($content_logo = get_field('content_logo')): ?>
                        <img src="<?php echo $content_logo['url'] ?>" alt="" class="hero-plate__logo" loading="lazy"
                             decoding="async">
                    <?php endif; ?>
                    <div class="hero-plate__excerpt">
                        <?php the_content(); ?>
                    </div>
                    <?php if ($menuItems = get_nav_menu_items_by_location('front-page-menu')): ?>
                        <ul class="hero-plate__links">
                            <?php foreach ($menuItems as $menuItem): ?>
                                <li>
                                    <a href="<?php echo $menuItem->url ?>">
                                        <?php echo $menuItem->post_title ?>
                                        <img src="<?php echo THEME_DIR_URI ?>/dist/img/icons/long-arrow-dark.svg" alt=""
                                             class="js__img-to-svg">
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
            </div>
        </section>
    </main>
<?php endif; ?>
<?php get_footer('front'); ?>
