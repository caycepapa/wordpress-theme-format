<?php

    /**
    * @package WordPress
    * @subpackage projectname
    * @since 2023
    */
    if ( !defined('ABSPATH') ) {
        die( 'Forbidden' );
    }

add_filter( 'get_the_archive_title', function ($title) {
    if (is_category()) {
        $title = single_cat_title('',false);
    } elseif (is_tag()) {
        $title = single_tag_title('',false);
	} elseif (is_tax()) {
        $title = single_term_title('',false);
	} elseif (is_post_type_archive() ){
		$title = post_type_archive_title('',false);
	} elseif (is_date()) {
        $title = get_the_time('Y年n月');
	} elseif (is_search()) {
        $title = '検索結果：'.esc_html( get_search_query(false) );
	} elseif (is_404()) {
        $title = '「404」ページが見つかりません';
	} else {
        
	}
    return $title;
});

function create_title(){

    $title = '';

    // HOME
    if(is_front_page() || is_home()){
        $title = get_bloginfo('name');
    }

    // archive
    if(is_archive()){
        // カスタム投稿タイプのアーカイブページの場合
        $post_types = get_post_types(array('public' => true, 'has_archive' => true), 'objects');
        foreach($post_types as $post_type){
            if(is_post_type_archive($post_type->name)){
                $title = $post_type->label . ' | ' . get_bloginfo('name');
                break;
            }
        }
    }
    
    // singular
    if(is_singular()){
        $title = get_the_title() . ' | ' . get_bloginfo('name');
    }

    // page
    if(is_page()){
        $title = get_the_title() . ' | ' . get_bloginfo('name');
    }

    return $title;
}

function the_create_title(){
    echo create_title();
}