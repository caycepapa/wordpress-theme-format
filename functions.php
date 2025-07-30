<?php

    /**
    * @package WordPress
    * @subpackage projectname
    * @since 2024
    */
    if ( !defined('ABSPATH') ) {
        die( 'Forbidden' );
    }

// アイキャッチ有効化
add_theme_support( 'post-thumbnails' );

/* 
ROOTSデフォルト関数
---------------------------------------------- */
// タイトルの文字数制限
get_template_part('functions-include/defaults/text_cut');
// タイトル生成
get_template_part('functions-include/defaults/create_title');
// ディスクリプション生成
get_template_part('functions-include/defaults/create_description');
// OGP画像生成
get_template_part('functions-include/defaults/create_ogpimage');
// gutenbergのカスタマイズ
get_template_part('functions-include/defaults/gutenberg_init');
// スラッグの自動採番
get_template_part('functions-include/defaults/post_slug_auto');
// 外部チェックのリミット解除
get_template_part('functions-include/defaults/public_post_limit');
// 管理画面メニューのカスタマイズ
get_template_part('functions-include/defaults/admin_menu');
// リンク（ACFのプラグインが必要）
get_template_part('functions-include/defaults/origin_links');
// css・jsをキャッシュさせるかどうか
get_template_part('functions-include/defaults/cache_assets');

// ページネーション
get_template_part('functions-include/pagination');

// リライトルールの調整が必要な場合
// get_template_part('functions-include/rewrite_rule');

// 投稿をお知らせに変更
get_template_part('functions-include/admin_nav_setting');

// パンくずリスト
get_template_part('functions-include/breadcrumb');

// contact form7のPタグ削除
// get_template_part('functions-include/contactform7');
