<aside class="modal js__modal" id="modal-allergies">
    <div class="modal__inner">
        <div class="modal-content">
            <?php if (!isset($all_tags)):
                $all_tags = get_categories(array(
                    'taxonomy' => 'product_tag',
                    'hierarchical' => false,
                    'hide_empty' => false
                ));
            endif; ?>
            <nav class="allergies-list">
                <?php if (!empty($all_tags)): ?>
                    <ul>
                        <?php foreach ($all_tags as $key => $tag): ?>
                            <?php if ($icon = get_field('tag_icon', 'product_tag_'.$tag->term_id)): ?>
                                <li>
                                    <a href="#">
                                        <?php echo file_get_contents($icon['url']) ?>
                                        <?php echo $tag->name ?>
                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </nav>

            <button class="modal__close js__modal-close" type="button">
                <img src="<?php echo THEME_DIR_URI ?>/dist/img/icons/close.svg" alt="" class="js__img-to-svg">
            </button>
        </div>

    </div>

</aside>