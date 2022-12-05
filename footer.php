<footer class="footer">
    <div class="wrap">
        <div class="footer__grid">
            <div class="footer__col">
                <?php if ($footerLogo = get_field('footer_logo', 'option')): ?>
                    <a href="<?php echo pll_home_url() ?>" class="logo">
                        <img src="<?php echo $footerLogo['url'] ?>" alt="" loading="lazy" decoding="async" width="55"
                             height="27">
                    </a>
                <?php endif; ?>
            </div>
            <div class="footer__col">
                <h4><?php _e('About Tatsu', 'tatsu_theme') ?></h4>
                <?php wp_nav_menu(array(
                    'theme_location' => 'footer-about',
                    'container' => 'nav',
                    'container_class' => '',
                    'menu_id' => false,
                    'echo' => true,
                    'menu_class' => '',
                    'depth' => 1,
                    'walker' => new Tatsu_Walker_Nav_Menu()
                )); ?>
            </div>
            <div class="footer__col">
                <h4><?php _e('Restaurants', 'tatsu_theme') ?></h4>
                <?php $args = array(
                    'post_type' => 'restaurants',
                );
                query_posts($args); ?>
                <?php if (have_posts()): ?>
                    <nav>
                        <ul>
                            <?php while (have_posts()): ?>
                                <?php the_post(); ?>
                                <li>
                                    <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    </nav>
                <?php endif; ?>
                <?php wp_reset_query(); ?>
            </div>
            <div class="footer__col">
                <h4><?php _e('Follow', 'tatsu_theme') ?></h4>
                <?php wp_nav_menu(array(
                    'theme_location' => 'footer-follow',
                    'container' => 'nav',
                    'container_class' => '',
                    'menu_id' => false,
                    'echo' => true,
                    'menu_class' => '',
                    'depth' => 1,
                    'walker' => new Tatsu_Walker_Nav_Menu()
                )); ?>
            </div>
        </div>
        <div class="footer__grid">
            <div class="footer__col">
                <small class="copyright"><?php the_field('copyright', 'option') ?></small>
            </div>
            <?php if ($privacyLink = get_field('privacy_policy_page', 'option')): ?>
                <div class="footer__col">
                    <a href="<?php echo $privacyLink ?>"><?php _e('Privacy policy', 'tatsu_theme') ?></a>
                </div>
            <?php endif; ?>
            <?php if ($termsLink = get_field('terms_&_conditions_page', 'option')): ?>
                <div class="footer__col">
                    <a href="<?php echo $termsLink ?>"><?php _e('Terms & Conditions', 'tatsu_theme') ?></a>
                </div>
            <?php endif; ?>
            <?php $languages = pll_the_languages(array('raw' => 1, 'hide_current' => 1)); ?>
            <?php if ($languages): ?>
                <div class="footer__col">
                    <aside class="lang-selector js__lang-selector">
                        <button class="lang-selector__current <?php if ($languages): ?> enabled <?php endif ?>"
                                type="button" data-current-lang><?php echo pll_current_language() ?></button>
                        <ul class="lang-selector__list">
                            <?php foreach ($languages as $language): ?>
                                <li><a href="<?php echo $language['url'] ?>"><?php echo $language['slug'] ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </aside>
                </div>
            <?php endif; ?>
        </div>
    </div>
</footer>

<?php echo get_template_part('/tpl-parts/tpl-modals','footer') ?>
<div class="overlay js__overlay-footer js__overlay"></div>
<?php wp_footer(); ?>
</body>
</html>