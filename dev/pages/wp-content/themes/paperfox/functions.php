<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Your_Theme_Name
 */

/**
 * Enqueue scripts and styles.
 */
function your_theme_name_scripts() {
    // Enqueue style.css from the styles directory.
    wp_enqueue_style( 'your-theme-name-style', get_template_directory_uri() . '/styles/style.css', array(), wp_get_theme()->get( 'Version' ) );

    // Enqueue app.js from the scripts directory.
    wp_enqueue_script( 'your-theme-name-app', get_template_directory_uri() . '/js/app.js', array( 'jquery' ), wp_get_theme()->get( 'Version' ), true );
}
add_action( 'wp_enqueue_scripts', 'your_theme_name_scripts' );