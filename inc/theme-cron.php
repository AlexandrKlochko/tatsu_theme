<?php
if( !wp_next_scheduled('remove_restaurant_disabled_time' ) ) {
    wp_schedule_event(strtotime('00:00:00'), 'daily', 'remove_restaurant_disabled_time');
}
function removeRestaurantsDisabledTime(){
    $restaurants = get_posts(array(
        'post_type' => 'restaurants',
        'numberposts' => -1,
    ));
    foreach ($restaurants as $restaurant){
        if ( have_rows( 'disabled_time_items', $restaurant->ID ) ):
            while ( have_rows( 'disabled_time_items', $restaurant->ID ) ): the_row();
                delete_row('disabled_time_items', 1,$restaurant->ID);
            endwhile;
        endif;
    }
}
add_action('remove_restaurant_disabled_time', 'removeRestaurantsDisabledTime');