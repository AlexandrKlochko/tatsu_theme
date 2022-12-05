<?php
function remove_editor() {
    if (isset($_GET['post'])) {
        $id = $_GET['post'];
        $template = get_post_meta($id, '_wp_page_template', true);
        switch ($template) {
            case 'page-templates/page-404.php':
                remove_post_type_support('page', 'editor');
                break;
            default :
                break;
        }
    }
}
add_action('init', 'remove_editor');