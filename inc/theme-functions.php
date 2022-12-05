<?php
function get_nav_menu_items_by_location( $location, $args = [] ) {
    $locations = get_nav_menu_locations();
    $object = wp_get_nav_menu_object( $locations[$location] );
    $menu_items = wp_get_nav_menu_items( $object->name, $args );
    return $menu_items;
}
function get_background_vars(){
    global $post;
    if($desktop_background = get_field('desktop_background')){ echo '--desktop-background:url('.$desktop_background['url'].'); ';}
    if($tablet_background = get_field('tablet_background')){ echo '--tablet-background:url('.$tablet_background['url'].');';}
    if($mobile_background = get_field('desktop_background')){ echo '--mobile-background:url('.$mobile_background['url'].');';}
}
function get_pattern_vars(){
    if($pattern_white = get_field('pattern_white','option')){ echo '--pattern-white:url('.$pattern_white['url'].');';}
    if($pattern_color = get_field('pattern_color','option')){ echo '--pattern-color:url('.$pattern_color['url'].');';}
}

function hoursRange( $from = "15:00", $to = "22:30",$format = '' ) {
    $times = array();

    if ( empty( $format ) ) {
        $format = 'g:i a';
    }
    $from = new DateTime('today '.$from);
    $to = new DateTime('today '.$to);
    for($date=clone $from; $date<=$to; $date->modify('+30 minutes')){
        $times[] = array(
            'object' => clone $date,
            'formated' =>  $date->format($format)
            );
        //$times[] = $date->format($format);
    }

    return $times;
}
