<?php
    /**
    * @package WordPress
    * @subpackage projectname
    * @since 2023
    */

    if ( !defined('ABSPATH') ) {
        die( 'Forbidden' );
    }

/* 
投稿記事のスラッグをID番号で採番
---------------------------------------------- */
function custom_auto_post_slug( $slug, $post_ID, $post_status, $post_type ) {
    if( $post_type == 'posts'){
        $slug = $post_ID;
    }
    return $slug;
}
add_filter( 'wp_unique_post_slug', 'custom_auto_post_slug', 10, 4 );