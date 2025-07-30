<?php

    /**
    * @package WordPress
    * @subpackage projectname
    * @since 2023
    */
    if ( !defined('ABSPATH') ) {
        die( 'Forbidden' );
    }

// キャッシュバスターパラメータを取得
function get_cache_assets() {
    $disable_cache = get_option('disable_cache_assets');
    
    if ($disable_cache) {
        return '?' . date('YmdHis');
    }
    
    return '';
}

// キャッシュバスターパラメータを出力
function the_cache_assets() {
    echo get_cache_assets();
}