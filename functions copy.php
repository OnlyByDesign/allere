<?php

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles',99);
function child_enqueue_styles() {
    $parent_style = 'parent-style';
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( $parent_style ) );
}
if ( get_stylesheet() !== get_template() ) {
    add_filter( 'pre_update_option_theme_mods_' . get_stylesheet(), function ( $value, $old_value ) {
         update_option( 'theme_mods_' . get_template(), $value );
         return $old_value; // prevent update to child theme mods
    }, 10, 2 );
    add_filter( 'pre_option_theme_mods_' . get_stylesheet(), function ( $default ) {
        return get_option( 'theme_mods_' . get_template(), $default );
    } );
}

if ( ! function_exists( 'zerif_setup' ) ) :
    function zerif_setup() {
        add_image_size( 'zerif-testimonial', 73, 73, true );
        add_image_size( 'zerif-clients', 130, 50, true );
        add_image_size( 'zerif-our-focus', 150, 150, true );
        add_image_size( 'zerif_our_team_photo', 174, 174, true );
        add_image_size( 'zerif_project_photo', 285, 500, true );
        add_image_size( 'post-thumbnail', 250, 250, true );
        add_image_size( 'post-thumbnail-large', 750, 500, true ); /* blog thumbnail */
        add_image_size( 'post-thumbnail-large-table', 600, 300, true ); /* blog thumbnail for table */
        add_image_size( 'post-thumbnail-large-mobile', 400, 200, true ); /* blog thumbnail for mobile */
    } );