<?php if (!isset($all_tags)):
    $all_tags = get_categories(array(
        'taxonomy' => 'product_tag',
        'hierarchical' => false,
        'hide_empty' => false
    ));
endif; ?>
<nav class="menu-section__toggle allergies-list js__allergies-list">
    <button class="allergies-list__toggle"
            data-toggle><?php _e('Allergies', 'tatsu_theme') ?></button>
    <?php if (!empty($all_tags)): ?>
        <ul data-dropdown>
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