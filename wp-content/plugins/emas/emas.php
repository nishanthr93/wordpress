<?php
/**
 * Plugin Name: EMAS custom plugin
 * Plugin URI: http://www.google.com
 * Description: This contains custom made code.
 * Version: 1.0
 * Author: Daniyal Hasan
 * Author URI: http://www.google.com
 */

/*add_filter( 'wp_nav_menu_items', 'add_loginout_link', 10, 2 );
function add_loginout_link( $items, $args ) {
    if (!is_front_page() && $args->theme_location == 'primary' && is_user_logged_in()) {
//        $items .= '<li><a href="'. wp_logout_url() .'">Log Out</a></li>';
        $items = '<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-6"><a href="https://pafssh.provirtualmeeting.com"><span class="menu-item-text"><span class="menu-text">Home</span></span></a></li>';
        $items .= '<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-7"><a href="https://pafssh.provirtualmeeting.com/#!/schedule"><span class="menu-item-text"><span class="menu-text">Schedule</span></span></a></li>';
        $items .= '<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-8"><a href="https://pafssh.provirtualmeeting.com/#!/speakers"><span class="menu-item-text"><span class="menu-text">Speakers</span></span></a></li>';
        $items .= '<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-9"><a href="https://pafssh.provirtualmeeting.com/#!/faculty"><span class="menu-item-text"><span class="menu-text">Faculty</span></span></a></li>';
        $items .= '<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-11"><a href="https://pafssh.provirtualmeeting.com/exhibitionpage/"><span class="menu-item-text"><span class="menu-text">Exhibition</span></span></a></li>';
        $items .= '<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-11"><a href="https://pafssh.provirtualmeeting.com/registration/"><span class="menu-item-text"><span class="menu-text">Registration</span></span></a></li>';
        $items .= '<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-12"><a href="https://pafssh.provirtualmeeting.com/lobby-2/"><span class="menu-item-text"><span class="menu-text">Lobby</span></span></a></li>';
    }
//    else {
//        $items .= '<li><a href="'. site_url('wp-login.php') .'">Log In</a></li>';
//    }
    return $items;
}
*/
?>