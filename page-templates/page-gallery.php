<?php /**
 * Template Name: Gallery Page
 */?>
<?php get_header();?>
    <main class="main">

        <section class="page-section">
            <div class="wrap">
                <h1 class="section-subtitle"><?php _e('Our latest feed','tatsu_teme')?></h1>
                <?php the_content()?>
            </div>
        </section>

    </main>
<?php get_footer();?>