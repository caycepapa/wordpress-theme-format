<?php

    /**
    * @package WordPress
    * @subpackage projectname
    * @since 2023
    */
    if ( !defined('ABSPATH') ) {
        die( 'Forbidden' );
    }

function create_ogpimage(){
    $ogp_image = '';
    
    // 個別ページの場合
    if(is_singular()){
        // アイキャッチ画像を取得
        if(has_post_thumbnail()){
            $thumbnail_id = get_post_thumbnail_id();
            $thumbnail_url = wp_get_attachment_image_src($thumbnail_id, 'large');
            if($thumbnail_url){
                $ogp_image = $thumbnail_url[0];
            }
        }
    }
    
    // アイキャッチ画像が存在しない場合、デフォルトのOGP画像を設定
    if(!$ogp_image){
        $ogp_image = get_template_directory_uri() . '/assets/img/ogp.png';
    }
    
    return $ogp_image;
}

function the_create_ogpimage(){
    echo create_ogpimage();
}