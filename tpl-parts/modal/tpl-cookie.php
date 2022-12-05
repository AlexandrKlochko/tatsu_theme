
<aside class="modal js__modal" id="modal-cookie">
    <div class="modal__inner">
        <form id="modal-cookie-form" method="post" class="cookie-modal" action="<?php echo admin_url('admin-ajax.php') ?>">
            <input type="hidden" name="action" value="set_cookie">
            <h4 class="section-subtitle"><?php _e('Cookies', 'tatsu_theme') ?></h4>
            <div class="cookie-modal__head">
                <div class="cookie-modal__excerpt">
                    <?php the_field('modal_content', 'option') ?>
                </div>
                <button class="cookie-modal__toggle js__toggle-cookies-list" type="button"
                        data-open-text="<?php _e('See more', 'tatsu_theme') ?>"
                        data-close-text="<?php _e('See less', 'tatsu_theme') ?>"><?php _e('See more', 'tatsu_thme') ?></button>
            </div>
            <div class="cookie-modal__body js__cookies-list">
                <div class="cookie-modal__item">
                    <div class="cookie-modal__item-checkbox">
                        <div class="default-checkbox">
                            <input type="checkbox" name="marketing" id="check_1" checked>
                            <label for="check_1"><?php _e('Marketing', 'tatsu_theme') ?></label>
                        </div>
                    </div>
                    <div class="cookie-modal__item-excerpt">
                        <?php the_field('modal_marketing_content', 'option') ?>
                    </div>
                </div>
                <div class="cookie-modal__item">
                    <div class="cookie-modal__item-checkbox">
                        <div class="default-checkbox">
                            <input type="checkbox" name="performance" id="check_2" checked>
                            <label for="check_2"><?php _e('Performance', 'tatsu_theme') ?></label>
                        </div>
                    </div>
                    <div class="cookie-modal__item-excerpt">
                        <?php the_field('modal_performance_content', 'option') ?>
                    </div>
                </div>
                <div class="cookie-modal__item">
                    <div class="cookie-modal__item-checkbox">
                        <div class="default-checkbox">
                            <input type="checkbox" name="necessary" id="check_3" checked>
                            <label for="check_3"><?php _e('Necessary', 'tatsu_theme') ?></label>
                        </div>
                    </div>
                    <div class="cookie-modal__item-excerpt">
                        <?php the_field('modal_necessary_content', 'option') ?>
                    </div>
                </div>
            </div>
            <div class="cookie-modal__footer">
                <button class="btn-arrow btn-arrow--dark" type="submit">
                    <?php _e('Accept all cookies', 'tatsu_theme') ?>
                    <img src="<?php echo THEME_DIR_URI ?>/dist/img/icons/long-arrow-light.svg" alt=""
                         class="js__img-to-svg">
                </button>
            </div>
            <button class="modal__close js__modal-close" type="button">
                <img src="<?php echo THEME_DIR_URI ?>/dist/img/icons/close.svg" alt="" class="js__img-to-svg">
            </button>
        </form>
    </div>
</aside>