<footer class=footer-cabinet>
    <div class=wrap>
        <small class=copyright><?php _e('© Tatsu - All Rights Reserved','tatsu_theme')?></small>
        <?php if($footerPhone = get_field('footer_phone','tatsu_theme')):?>
            <a data-phone href="tel:+<?php echo preg_replace('~\D~', '', $footerPhone)?>"><?php echo $footerPhone?></a>
        <?php endif;?>
        <?php if($privacyLink = get_field('privacy_policy_page','option')):?>
            <a data-link href="<?php echo $privacyLink?>"><?php _e('Privacy policy','tatsu_theme')?></a>
        <?php endif;?>
        <?php if($termsLink = get_field('terms_&_conditions_page','option')):?>
            <a data-link href="<?php echo $termsLink?>"><?php _e('Terms & Conditions','tatsu_theme')?></a>
        <?php endif;?>
        <?php $languages = pll_the_languages(array('raw'=>1,'hide_current'=>1));?>
        <?php if($languages):?>
        <aside class="lang-selector js__lang-selector">
            <button class="lang-selector__current <?php if($languages):?> enabled <?php endif?>" type="button" data-current-lang><?php echo pll_current_language()?></button>
            <ul class="lang-selector__list">
                <?php foreach ($languages as $language):?>
                    <li><a href="<?php echo $language['url']?>"><?php echo $language['slug']?></a></li>
                <?php endforeach;?>
            </ul>
        </aside>
        <?php endif;?>
    </div>
</footer>
<?php echo get_template_part('/tpl-parts/tpl-modal') ?>

<?php wp_footer(); ?>
</body>
</html>