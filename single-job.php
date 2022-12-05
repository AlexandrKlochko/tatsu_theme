<?php get_header(); ?>
    <main class="main">

        <div class="page-with-img page-with-img--revert" data-check-position>
            <div class="page-with-img__sticky">
                <div class="job-details">
                    <?php if ($pdf = get_field('pdf')): ?>
                        <div class="job-details__part">
                            <a href="<?php echo $pdf ?>"
                               class="default-link"><?php _e('Download PDF', 'tatsu_theme') ?></a>
                        </div>
                    <?php endif; ?>
                    <?php if ($questionsMail = get_field('email_for_questions', 'option')): ?>
                        <div class="job-details__part" data-title="Questions?">
                            <a href="mailto:<?php echo $questionsMail ?>"
                               class="default-link"><?php echo $questionsMail ?></a>
                        </div>
                    <?php endif; ?>
                    <?php if (have_rows('social_links')): ?>
                        <div class="job-details__part" data-title="Socials">
                            <ul class="socials-list">
                                <?php while (have_rows('social_links')): the_row(); ?>
                                    <?php $link = get_sub_field('link'); ?>
                                    <?php $icon = get_sub_field('icon'); ?>
                                    <li>
                                        <a href="<?php echo esc_url($link['url']) ?>" rel="noopener"
                                           target="<?php echo $link['target'] ?>">
                                            <img src="<?php echo esc_url($icon['url']) ?>"
                                                 alt="<?php echo esc_attr($icon['alt']); ?>"
                                                 class="js__img-to-svg"></a></li>
                                <?php endwhile; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <?php if ($resumeMail = get_field('email_for_resume', 'option')): ?>
                        <div class="job-details__part">
                            <a href="mailto:<?php echo $resumeMail ?>" class="btn-arrow">
                                <?php _e('Apply now', 'tatsu_theme') ?>
                                <img src="<?php echo THEME_DIR_URI ?>/dist/img/icons/long-arrow-dark.svg" alt=""
                                     class="js__img-to-svg">
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="page-with-img__content font-rules">
                <h1><?php the_title() ?></h1>
                <h3><?php the_field('experience') ?></h3>
                <p><br></p>
                <p><br></p>
                <?php the_content() ?>
            </div>
        </div>

    </main>
<?php get_footer(); ?>