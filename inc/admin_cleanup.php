<?php

/**
 * Clean Up Dashboard
 */
function remove_dashboard_widgets() {

     global $wp_meta_boxes;

     // Welcome Panel.
     remove_action( 'welcome_panel', 'wp_welcome_panel' );

     // Normal Widgets.
     unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press'] );
     unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links'] );
     unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins'] );
     unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts'] );
     unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments'] );
     unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_primary'] );
     unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary'] );
     unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now'] );

     // WP Engine Widgets.
     unset( $wp_meta_boxes['dashboard']['normal']['core']['wpe_dify_news_feed'] );

 }
 add_action( 'wp_dashboard_setup', 'remove_dashboard_widgets', 99 );


/**
 * Remove comments
 */

// Removes from admin menu
function remove_admin_menus() {
    remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'remove_admin_menus' );

// Removes from post and pages
function remove_comment_support() {
    remove_post_type_support( 'post', 'comments' );
    remove_post_type_support( 'page', 'comments' );
}
add_action('init', 'remove_comment_support', 100);


// Removes from admin bar
function theme_admin_bar_render() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}
add_action( 'wp_before_admin_bar_render', 'theme_admin_bar_render' );


/**
 * Remove the WordPress logo from backend
 *
 * Not essential, but it cleans up the dashboard a little.
 */
function remove_wp_logo( $wp_admin_bar ) {
    $wp_admin_bar->remove_node('wp-logo');
}
add_action('admin_bar_menu', 'remove_wp_logo', 999);


/**
 * Change custom greeting
 *
 * Change the custom greeting at the top right side
 * of the admin bar.
 */
function custom_replace_howdy( $wp_admin_bar ) {
    $my_account=$wp_admin_bar->get_node('my-account');
    $newtitle = str_replace( 'Howdy', 'Welcome', $my_account->title );
    $wp_admin_bar->add_node( array(
        'id' => 'my-account',
        'title' => $newtitle,
    ) );
}
add_filter( 'admin_bar_menu', 'custom_replace_howdy', 12 );
