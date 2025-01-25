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
get_template_part('functions-include/text_cut');

// リライトルールの調整が必要な場合
// get_template_part('functions-include/rewrite_rule');

// スラッグの自動採番
get_template_part('functions-include/post_slug_auto');

// 投稿をお知らせに変更
get_template_part('functions-include/admin_nav_setting');

// gutenberg init
get_template_part('functions-include/gutenberg_init');

// パンくずリスト
get_template_part('functions-include/breadcrumb');

// 外部チェックのリミット解除（public post previewのプラグインが必要）
// get_template_part('functions-include/public_post_limit');

// リンク（ACFのプラグインが必要）
// optionページの設定が必要
// get_template_part('functions-include/origin_links');

// contact form7のPタグ削除
// get_template_part('functions-include/contactform7');
