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
    if(is_front_page()){
        $title = get_bloginfo('name');
    }elseif(is_post_type_archive('yakuin')){
        $title = '役員専用ページ'.' | '.get_bloginfo('name');
    }elseif(is_post_type_archive('kaiin')){
        $title = '会員専用ページ'.' | '.get_bloginfo('name');
    }elseif(is_post_type_archive('meibo')){
        $title = '会員名簿'.' | '.get_bloginfo('name');
    }elseif(is_archive('post')){
        $title = 'お知らせ'.' | '.get_bloginfo('name');
    }elseif(is_singular('kaiin')){
        $title = get_the_title().' | 会員専用ページ | '.get_bloginfo('name');
    }elseif(is_singular('yakuin')){
        $title = get_the_title().' | 役員専用ページ | '.get_bloginfo('name');
    }elseif(is_singular('meibo')){
        $title = get_the_title().' | 会員名簿 | '.get_bloginfo('name');
    }elseif(is_singular('post')){
        $title = get_the_title().' | お知らせ | '.get_bloginfo('name');
    }elseif(is_singular('page')){
        $title = get_the_title().' | '.get_bloginfo('name');
    }elseif(is_category()){
        $title = get_the_title().' | '.get_bloginfo('name');
    }else{
        $title = get_the_title().' | '.get_bloginfo('name');
    }
    return $title;
}