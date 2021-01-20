<?php
/**
 * Custom functions
 */


// Thumbnails //

if ( function_exists( 'add_theme_support' ) ) {
    add_image_size( 'post_thumbnail', 64, 64, true ); // Soft Crop Mode
    add_image_size( 'post_thumbnail_lg', 400, 300, true ); // Soft Crop Mode
}