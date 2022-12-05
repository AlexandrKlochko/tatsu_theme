<div class="modal-auth js__modal-auth" id="modal-register">
    <div class="modal-auth__head">
        <div class="modal-auth__title"><?php _e('Register', 'tatsu_theme') ?></div>
        <a href="#modal-login"
           class="modal-auth__link js__modal-auth-open"><span><?php _e('Already an account?', 'tatsu_theme') ?> </span><?php _e('Login', 'tatsu_theme') ?>
        </a>
    </div>
    <div class="modal-auth__body">
        <form id="register" action="<?php echo admin_url('admin-ajax.php') ?>" method="post" novalidate>
            <input name="action" type="hidden" value="ajaxregister"/>
            <div class="default-input">
                <input type="text" name="firstname" value="" required>
                <label><?php _e('First name', 'tatsu_theme') ?></label>
            </div>
            <div class="default-input">
                <input type="text" name="lastname" value="" required>
                <label><?php _e('Last name', 'tatsu_theme') ?></label>
            </div>
            <div class="default-input">
                <input type="email" name="email" value="" required>
                <label><?php _e('Email address', 'tatsu_theme') ?></label>
            </div>
            <?php if ('no' === get_option('woocommerce_registration_generate_password')) : ?>
                <div class="default-input">
                    <input type="password" name="password" id="reg_password" value="" autocomplete="new-password" minlength="6"
                           required><span class="show-password-input"></span>
                    <label><?php _e('Password', 'tatsu_theme') ?></label>
                </div>
            <?php else : ?>
                <div class="default-input">
                    <label><?php esc_html_e('A password will be sent to your email address.', 'woocommerce'); ?></label>
                </div>
            <?php endif; ?>
            <div class="default-checkbox">
                <input type="checkbox" id="sub-to-newsletter" name="sub-to-newsletter" value="1">
                <label for="sub-to-newsletter"><?php _e('Subscribe to our newsletter', 'tatsu_theme') ?></label>
            </div>
            <?php wp_nonce_field('ajax-register-nonce', 'signonsecurity'); ?>
            <button class="submit-btn" type="submit">
                <?php _e('Register', 'tatsu_theme') ?>
                <img src="<?php echo THEME_DIR_URI ?>/dist/img/icons/long-arrow-dark.svg" alt="" class="js__img-to-svg">
            </button>
        </form>
    </div>
    <span class="modal-auth__close js__modal-auth-close"></span>
</div>