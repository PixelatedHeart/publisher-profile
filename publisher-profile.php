<?php
/**
 * Plugin Name: Publisher Profile
 * Plugin URI: https://wordpress.org/plugins/publisher-profile
 * Description: Adds a publisher profile that can only publish, without editing permissions.
 * Version: 1.0.15
 * Author: bi0xid
 * Author URI: http://bi0xid.es
 * License: GPL3
*/


// We add the publisher role with a Contributor level
function publisher_profile_add_publisher_role() {

add_role('publisher_profile', 'Publisher', array( 
    'read' => true, // True allows that capability
    'edit_posts' => true,
    'delete_posts' => false, // Use false to explicitly deny
  ) );

}

add_action('admin_init', 'publisher_profile_add_publisher_role');



// We add the capabilities - edit and publish
function publisher_profile_add_caps() {
    // gets the publisher role
    $role = get_role( 'publisher_profile' );

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
    if ( in_array( 'publisher_profile', (array) $user->roles ) ) {
      add_filter( 'tiny_mce_before_init', 'publisher_profile_format_TinyMCE' );
    }
}
add_filter( 'admin_init', 'publisher_profile_launch' );


// We make tinyMCE read-only for the publishers
function publisher_profile_format_TinyMCE( $in ) {
  $user = wp_get_current_user();
    if ( in_array( 'publisher_profile', (array) $user->roles ) ) {
      $in['readonly'] = 1;
      return $in;
    }
}

// We make tinyMCE the default editor for everyone
add_filter( 'wp_default_editor', create_function('', 'return "tinymce";') );

// We disable the HTML tag for publishers - publishers can only use the visual view, which is blocked
function publisher_profile_disable_html() {
  $user = wp_get_current_user();
  if ( in_array( 'publisher_profile', (array) $user->roles ) ) {
   echo '<style type="text/css">#content-html, #quicktags, .page-title-action, #wp-admin-bar-new-content {display: none;}</style>' . "\n";
  }
}
add_action( 'admin_head', 'publisher_profile_disable_html' );

// We disable the blocks for publishers - publishers cannot see blocks that they are not going to use
function publisher_profile_disable_blocks() {
  $user = wp_get_current_user();
  if ( in_array( 'publisher_profile', (array) $user->roles ) ) {
    wp_enqueue_script( 'publisher_profile_js', plugin_dir_url( __FILE__ ) . '/js/publisher_profile.js', array(), '1.0.0', true );
  }
}
add_action( 'admin_enqueue_scripts', 'publisher_profile_disable_blocks' );


function publisher_profile_disable_controls($hook) {
    if ( 'post.php' != $hook ) {
        return;
    }
    $user = wp_get_current_user();
    if ( in_array( 'publisher_profile', (array) $user->roles ) ) {
      wp_enqueue_script( 'publisher_profile_control_js', plugin_dir_url( __FILE__ ) . '/js/publisher_profile_control.js', array(), '1.0.0', true );
    }
}
add_action( 'admin_enqueue_scripts', 'publisher_profile_disable_controls' );

