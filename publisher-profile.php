<?php
/**
 * Plugin Name: Publisher Profile
 * Plugin URI: https://wordpress.org/plugins/publisher-profile
 * Description: Adds a publisher profile that can only publish, without editing permissions.
 * Version: 1.0.9
 * Author: bi0xid
 * Author URI: http://bi0xid.es
 * License: GPL3
*/


// We add the publisher role with level 0
function publisher_profile_add_publisher_role() {
  add_role( 'publisher', 'Publisher', array( 
    'level_0' => true,
  ) );
}
add_action('admin_init', 'add_publisher_role');

// We add the capabilities - edit and publish
function publisher_profile_add_caps() {
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
add_action( 'admin_init', 'publisher_profile_add_caps');


function publisher_profile_launch(){
    $user = wp_get_current_user();
    if ( in_array( 'publisher', (array) $user->roles ) ) {
      add_filter( 'tiny_mce_before_init', 'publisher_profile_format_TinyMCE' );
    }
}
add_filter( 'admin_init', 'publisher_profile_launch' );


// We make tinyMCE read-only for the publishers
function publisher_profile_format_TinyMCE( $in ) {
  $user = wp_get_current_user();
    if ( in_array( 'publisher', (array) $user->roles ) ) {
      $in['readonly'] = 1;
      return $in;
    }
}

// We make tinyMCE the default editor for everyone
add_filter( 'wp_default_editor', create_function('', 'return "tinymce";') );

// We disable the HTML tag for publishers - publishers can only use the visual view, which is blocked
function publisher_profile_disable_html() {
  $user = wp_get_current_user();
  if ( in_array( 'publisher', (array) $user->roles ) ) {
   echo '<style type="text/css">#content-html, #quicktags {display: none;}</style>' . "\n";
  }
}
add_action( 'admin_head', 'publisher_profile_disable_html' );
