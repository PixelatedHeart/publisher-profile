<?php
/**
 * Plugin Name: Publisher Profile
 * Plugin URI: https://wordpress.org/plugins/publisher-profile
 * Description: Adds a publisher profile that can only publish, without editing permissions.
 * Version: 1.0
 * Author: bi0xid
 * Author URI: http://bi0xid.es
 * License: GPL3
*/


// We add the publisher role with level 0
function add_publisher_role() {
  add_role( 'publisher', 'Publisher', array( 
    'level_0' => true,
  ) );
}
add_action('plugins_loaded', 'add_publisher_role');

// We add the capabilities - edit and publish
function add_theme_caps() {
    // gets the publisher role
    $role = get_role( 'publisher' );

    // This only works, because it accesses the class instance.
    // would allow the publisher to edit others' posts for current theme only
    $role->add_cap( 'edit_others_posts' ); 
    $role->add_cap( 'edit_posts' ); 
    $role->add_cap( 'edit_others_pages' ); 
    $role->add_cap( 'edit_pages' ); 
    $role->add_cap( 'publish_posts' ); 
    $role->add_cap( 'publish_pages' ); 
}
add_action( 'admin_init', 'add_theme_caps');


// We make tinyMCE read-only for the publishers
function my_format_TinyMCE( $in ) {
$user = wp_get_current_user();
  if ( in_array( 'publisher', (array) $user->roles ) ) {
    $in['readonly'] = 1;
    return $in;
  }
}
add_filter( 'tiny_mce_before_init', 'my_format_TinyMCE' );

// We make tinyMCE the default editor for everyone
add_filter( 'wp_default_editor', create_function('', 'return "tinymce";') );

// We disable the HTML tag for publishers - publishers can only use the visual view, which is blocked
function disable_html() {
  $user = wp_get_current_user();
  if ( in_array( 'publisher', (array) $user->roles ) ) {
   echo '<style type="text/css">#content-html, #quicktags {display: none;}</style>' . "\n";
  }
}
add_action( 'admin_head', 'disable_html' );
