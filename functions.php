<?php

    /**
    * @package WordPress
    * @subpackage projectname
    * @since 2024
    */
    if ( !defined('ABSPATH') ) {
        die( 'Forbidden' );
    }

/* 
アイキャッチの許可
---------------------------------------------- */
add_theme_support( 'post-thumbnails' );

// タイトル生成
get_template_part('functions-include/create_title');

// ページネーション
get_template_part('functions-include/pagination');

// タイトルの文字数制限
get_template_part('functions-include/the_text_cut');

// rewrite rule
get_template_part('functions-include/rewrite_rule');

// スラッグの自動採番
get_template_part('functions-include/post_slug_auto');

// 投稿をお知らせに変更
get_template_part('functions-include/admin_nav_setting');

// gutenberg init
get_template_part('functions-include/gutenberg_init');

// パンくずリスト
get_template_part('functions-include/breadcrumb');