
<?php get_header(); ?>
    <main class="main">

        <div class="page-with-img" data-check-position>
            <div class="page-with-img__sticky">
                <img src="<?php echo get_the_post_thumbnail_url() ?>" alt="" loading="lazy" decoding="async">
            </div>
            <div class="page-with-img__content font-rules">
                <h1><?php the_title()?></h1>
                <?php the_content()?>
            </div>
        </div>

    </main>
<?php get_footer();?>