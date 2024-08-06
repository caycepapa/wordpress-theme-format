<?php

    /**
    * @package WordPress
    * @subpackage valo
    * @since 2023
    */
    if ( !defined('ABSPATH') ) {
        die( 'Forbidden' );
    }

function custom_rewrite_basic() {

    $cats = get_categories();

    $catList = '';

    $i = 0;
    foreach ($cats as $cat) {
        if($i!=0){ $catList .= '|'; }
        $catList .= $cat->slug;
        $i++;
    }

    // $catList = 'topics/('.$catList.')';

    // // アーカイブページにアクセスがあった場合
    add_rewrite_rule('topics?$', 'index.php?post_type=post', 'top' );
    // // アーカイブページのページネーションがあった場合
    add_rewrite_rule('topics/page/?([0-9]{1,})?$', 'index.php?post_type=post&paged=$matches[1]', 'top');
    // add_rewrite_rule($catList.'?$', 'index.php?p=$matches[2]?category_name=$matches[1]', 'top');
    // add_rewrite_rule($catList.'/?([0-9]{1,})?$', 'index.php?p=$matches[2]', 'top');
    // add_rewrite_rule($catList.'/feed/(feed|rdf|rss|rss2|atom)/?$', 'index.php?category_name=$matches[1]&feed=$matches[2]', 'top');
    // add_rewrite_rule($catList.'/(feed|rdf|rss|rss2|atom)/?$', 'index.php?category_name=$matches[1]&feed=$matches[2]', 'top');
    // add_rewrite_rule($catList.'/embed/?$', 'index.php?category_name=$matches[1]&embed=true', 'top');
    // add_rewrite_rule($catList.'/page/?([0-9]{1,})?$', 'index.php?category_name=$matches[1]&paged=$matches[2]', 'top');
}

add_action('init', 'custom_rewrite_basic');



/* 
初期のpostをリネーム
---------------------------------------------- */
function post_has_archive( $args, $post_type ) {

if ( 'post' == $post_type ) {
    $args['rewrite'] = true;
    $args['has_archive'] = 'topics';
}
return $args;

}
add_filter( 'register_post_type_args', 'post_has_archive', 10, 2 );