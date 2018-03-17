<?php
/**
 * @package Wp_Custom_Profile_Picture
 * @version 1.0
 */
/*
Plugin Name: ScriptHere's Simple Custom Profile.
Plugin URI: https://github.com/blogscripthere/simple-wordpress-custom-profile-picture
Description: Simple Custom Profile to WordPress with wordpress built in media uploader and settings api.
Author: Narendra Padala
Author URI: https://in.linkedin.com/in/narendrapadala
Text Domain: shcp
Version: 1.0
Last Updated: 17/03/2018
*/

/**
 * Enqueue required javascript libraries callback
 */
function sh_load_custom_settings_scripts(){
    //enqueue media js library to use wordpress media library in our plugin / theme.
    wp_enqueue_media();
    // if your using code in theme then add js url path like below
    //$url = get_template_directory_uri() . '/assets/js/sh.media.js';
    //include plugin js file path
    $url = plugin_dir_url( __FILE__ ).'/assets/js/sh.media.js';
    wp_register_script( 'sh-custom-settings-script', $url, array('jquery'), '1.0.0', true );
    wp_enqueue_script( 'sh-custom-settings-script' );
}
/**
 * Enqueue required javascript libraries hook
 */
add_action( 'admin_enqueue_scripts', 'sh_load_custom_settings_scripts' );

/**
 * Add custom settings menu option to the admin page callback
 */
function sh_add_admin_page_callback(){
    //Generate custom settings admin page
    add_menu_page( 'Custom Options', 'Custom Settings', 'manage_options', 'custom_settings', 'sh_create_custom_settings_page' );
}
/**
 * Add custom configuration page templates in the administration page
 */
function sh_create_custom_settings_page() {
    //Includes settings for the html template
    //require_once( get_template_directory() . '/templates/admin_custom_settings.php' );
    require_once( plugin_dir_path(__FILE__)  . '/templates/admin_custom_settings.php' );
}

/**
 * Add custom setting option menu option on hook of admin page.
 */
add_action( 'admin_menu', 'sh_add_admin_page_callback' );


/**
 * Register the custom setting group and set the field to be displayed in the setting template callback
 */
function sh_custom_settings_callback() {
    //register the user picture field in the custom settings group
    register_setting( 'sh-custom-settings-group', 'user_picture');
    //register the user name field in the custom settings group
    register_setting( 'sh-custom-settings-group', 'user_name' );
    //register the user description field in the custom settings group
    register_setting( 'sh-custom-settings-group', 'user_description' );
    //add settings section
    add_settings_section( 'sh-custom-settings-options', 'Custom Options', 'sh_custom_settings_options_callback', 'custom_settings');
    //add the user name field to the hooked group of custom settings
    add_settings_field( 'sh-user-name', 'User Name', 'sh_custom_user_name_callback', 'custom_settings', 'sh-custom-settings-options');
    //add the user description field to the hooked group of custom settings
    add_settings_field( 'sh-user-description', 'User Description', 'sh_custom_user_description_callback', 'custom_settings', 'sh-custom-settings-options');
    //add the user picture field to the hooked group of custom settings
    add_settings_field( 'sh-user-picture', 'User Picture', 'sh_custom_user_picture_callback', 'custom_settings', 'sh-custom-settings-options');
}
/**
 * Start a custom setting group and set the fields to display in the settings template hook
 */
add_action( 'admin_init', 'sh_custom_settings_callback' );

/**
 * Add a custom configuration block title callback request
 */
function sh_custom_settings_options_callback(){
    echo 'Add your custom  information';
}


/**
 * Add a user name field to the custom configuration for the group callback request
 */
function sh_custom_user_name_callback() {
    $userName = esc_attr( get_option( 'user_name' ) );
    echo '<input type="text" name="user_name" value="'.$userName.'" placeholder="Full Name" />';
}
/**
 * Add a user description field to the custom configuration for the group callback request
 */
function sh_custom_user_description_callback() {
    $userDescription = esc_attr( get_option( 'user_description' ) );
    echo '<input type="text" name="user_description" value="'.$userDescription.'" placeholder="Description" /><p><i>Write something clever here..!</i></p>';
}
/**
 * Add a user picture field to the custom configuration for the group callback request
 */
function sh_custom_user_picture_callback(){
    $userPicture = esc_attr( get_option( 'user_picture' ) );
    echo '<input type="button" value="Upload Picture" id="upload-picture-button">
          <input type="hidden" id="user-picture" name="user_picture" value="'.$userPicture.'" />';
}

/**
 * Display user profile with custom fields short code callback
 */
function sh_display_custom_settings_callback(){
    require_once( plugin_dir_path(__FILE__)  . '/templates/display_custom_settings.php' );
}
/**
 * Display user profile with custom fields  add shortcode hook
 */
add_shortcode('display_profile', 'sh_display_custom_settings_callback');