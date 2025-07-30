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
サイドメニューにコメントを表示させない
---------------------------------------------- */
function remove_menus() {
    remove_menu_page( 'edit-comments.php' ); // コメント.
}
add_action( 'admin_menu', 'remove_menus', 999 );

// 管理画面にメニューを追加
add_action('admin_menu', 'add_origin_settings_menu');
function add_origin_settings_menu() {
    // 独自設定メニューを追加（リダイレクト用）
    add_menu_page(
        '独自設定',
        '独自設定',
        'manage_options',
        'origin-settings',
        '__return_null',
        'dashicons-admin-generic',
        100
    );

    add_submenu_page(
        'origin-settings',
        'サイト設定',
        'サイト設定',
        'manage_options',
        'site-settings',
        'site_settings_page'
    );

    add_submenu_page(
        'origin-settings',
        'リンク設定',
        'リンク設定',
        'manage_options',
        'origin-links',
        'origin_links_page'
    );
}

// 独自設定メニューをクリックした際にリンク設定にリダイレクト
add_action('admin_init', 'redirect_origin_settings');
function redirect_origin_settings() {
    global $pagenow;
    if ($pagenow == 'admin.php' && isset($_GET['page']) && $_GET['page'] == 'origin-settings') {
        wp_redirect(admin_url('admin.php?page=origin-links'));
        exit;
    }
}