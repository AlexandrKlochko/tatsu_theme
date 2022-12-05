<div class="modal-auth js__modal-auth" id="modal-login">
    <div class="modal-auth__head">
        <div class="modal-auth__title"><?php _e('Login','tatsu_theme')?></div>
        <a href="#modal-register" class="modal-auth__link js__modal-auth-open"><?php _e('No account? Register','tatsu_theme')?></a>
    </div>
    <div class="modal-auth__body">
        <form id="login" action="<?php echo admin_url( 'admin-ajax.php' )?>" method="post" novalidate>
            <input name="action" type="hidden" value="ajaxlogin" />
            <div class="default-input">
                <input name="username" type="email" value="" required>
                <label><?php _e('Email address','tatsu_theme')?></label>
            </div>
            <div class="default-input">
                <input name="password" type="password" value="" minlength="6" required><span class="show-password-input"></span>
                <label><?php _e('Password','tatsu_theme')?></label>
            </div>
            <div class="tar">
                <a href="<?php echo wp_lostpassword_url()?>" class="grey-link"><?php _e('Forgot password?','tatsu_theme')?></a>
            </div>
            <?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
            <button class="submit-btn" type="submit">
                <?php _e('Login','tatsu_theme')?>
                <img src="<?php echo THEME_DIR_URI?>/dist/img/icons/long-arrow-dark.svg" alt="" class="js__img-to-svg">
            </button>
        </form>
    </div>
    <span class="modal-auth__close js__modal-auth-close"></span>
</div>