<?php if (!isset($all_categories)):
    $all_categories = get_categories(array(
        'taxonomy' => 'product_cat',
        'hierarchical' => false,
        'hide_empty' => true
    ));
endif; ?>
<nav class="menu-list js__menu-list">
    <?php if (!empty($all_categories)): ?>
        <ul>
            <?php foreach ($all_categories as $key => $category): ?>
                <li><a href="#<?php echo $category->slug ?>" data-offset="120"
                       class="<?php if ($key == array_key_first($all_categories)): ?>is-active<?php endif; ?>"><?php echo $category->name ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</nav>