<aside class="modal js__modal" id="modal-menu">
    <div class="modal__inner">
        <div class="modal-content">
            <?php if (have_rows('menu_files', 'option')): ?>
                    <?php while (have_rows('menu_files', 'option')): the_row(); ?>
                        <?php $link = get_sub_field('file'); ?>
                        <?php $link_title = get_sub_field('link_title'); ?>
                        <div class="menu-link">
                            <a href="<?php echo esc_url($link) ?>" rel="noopener"
                               target="_blank">
                                <?php echo $link_title?>
                            </a>
                        </div>
                    <?php endwhile; ?>
            <?php else:?>
                <div class="">
                    <?php _e('Sorry. Menu files not set yet.','tatsu_theme')?>
                </div>
            <?php endif; ?>
            <div class="menu-link">
                <div class="share-item">
                    <div id="share-button-2"
                         class="need-share-button-default default-link"
                         data-share-position="middleLeft"
                         data-share-icon-style="box"
                         data-share-networks="Mailto,Twitter,Pinterest,Facebook,GooglePlus,Linkedin"
                         data-share-share-button-class="default-link"><span
                                class="default-link"><?php _e('Share the menu', 'tatsu_theme') ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</aside>