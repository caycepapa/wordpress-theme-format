<?php

    /**
    * @package WordPress
    * @subpackage projectname
    * @since 2023
    */
    if ( !defined('ABSPATH') ) {
        die( 'Forbidden' );
    }

function create_description(){
    $description = '';
    
    // 個別ページの場合
    if(is_singular()){
        // 抜粋を取得
        $excerpt = get_the_excerpt();
        if($excerpt){
            $description = $excerpt;
        } else {
            $description = get_bloginfo('description');
        }
    } else {
        $description = get_bloginfo('description');
    }

    return $description;
}

function the_create_description(){
    echo create_description();
}