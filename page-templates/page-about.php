<?php /**
 * Template Name: About Page
 */ ?>
<?php get_header(); ?>
    <main class="main">

        <div class="page-about-grid">
            <div class="page-about-grid__content">
                <section class="desc-with-img" data-check-position>
                    <?php if ($heroImage = get_field('hero_section_image')): ?>
                        <img src="<?php echo $heroImage['url'] ?>" alt="" class="desc-with-img__img">
                    <?php endif; ?>
                    <div class="desc-with-img__excerpt font-rules">
                        <?php the_field('hero_section_content'); ?>
                        <p><br></p>
                        <p><br></p>
                        <?php if ($mobileImages = get_field('hero_section_mobile_images')): ?>
                            <div class="three-images only-mobile">
                                <?php foreach ($mobileImages as $mobileImage): ?>
                                    <img src="<?php echo esc_url($mobileImage['url']); ?>" alt="">
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <p><br></p>
                        <p><br></p>
                        <blockquote>
                            <?php the_field('hero_section_quote') ?>
                            <cite>- <?php the_field('hero_section_quote_author') ?></cite>
                        </blockquote>
                    </div>
                </section>
                <section class="desc-with-img" data-check-position>
                    <img src="<?php echo get_the_post_thumbnail_url() ?>" alt="" class="desc-with-img__img">
                    <div class="desc-with-img__excerpt font-rules">
                        <p><br></p>
                        <p><br></p>
                        <p><br></p>
                        <p><br></p>
                        <?php the_content(); ?>
                    </div>
                </section>
                <?php $workSectionTitle = get_field('work_section_title'); ?>
                <?php $args = array(
                    'post_type' => 'job',
                    'numberposts' => get_field('work_section_number_of_posts')
                );
                query_posts($args); ?>
                <?php if (have_posts()): ?>
                    <section class="page-section">
                        <h3 class="section-title"><?php echo $workSectionTitle?></h3>
                        <div class="vacancies-loop">
                            <?php while (have_posts()):?>
                                <?php the_post();?>
                                <div class="vacancy-card" data-check-position>
                                    <ul class="vacancy-card__meta">
                                        <li>
                                            <time><?php the_date('d M.')?></time>
                                        </li>
                                        <?php if($location = get_field('location')):?>
                                            <li>
                                                <address><?php echo $location?></address>
                                            </li>
                                        <?php endif;?>
                                    </ul>
                                    <h4 class="vacancy-card__title"><a href="<?php the_permalink()?>"><?php the_title()?> - <?php the_field('experience')?></a></h4>
                                    <div class="vacancy-card__excerpt">
                                        <?php the_excerpt()?>
                                    </div>
                                    <?php if(have_rows('duration')):?>
                                        <ul class="vacancy-card__duties">
                                            <?php while(have_rows('duration')): the_row();?>
                                                <li><?php the_sub_field('option')?></li>
                                            <?php endwhile;?>
                                        </ul>
                                    <?php endif;?>
                                    <img src="<?php echo THEME_DIR_URI?>/dist/img/icons/long-arrow-light.svg" alt="" class="js__img-to-svg">
                                </div>
                            <?php endwhile;?>
                        </div>
                    </section>
                <?php endif; ?>
                <?php wp_reset_query();?>
            </div>
            <?php if ($stickyImage = get_field('sticky_image')): ?>
                <div class="page-about-grid__sticky">
                    <img src="<?php echo $stickyImage['url'] ?>" alt="">
                </div>
            <?php endif; ?>
        </div>


    </main>
<?php get_footer(); ?>