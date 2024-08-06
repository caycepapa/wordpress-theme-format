<?php
    /**
    * @package WordPress
    * @subpackage valo
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

/* 
投稿の名前を変更
---------------------------------------------- */
function Change_menulabel() {
	global $menu;
	global $submenu;
	$name = 'お知らせ';
	$menu[5][0] = $name;
	$submenu['edit.php'][5][0] = $name.'一覧';
	$submenu['edit.php'][10][0] = '新しい'.$name;
}
function Change_objectlabel() {
	global $wp_post_types;
	$name = 'お知らせ';
	$labels = &$wp_post_types['post']->labels;
	$labels->name = $name;
	$labels->singular_name = $name;
	$labels->add_new = _x('追加', $name);
	$labels->add_new_item = $name.'の新規追加';
	$labels->edit_item = $name.'の編集';
	$labels->new_item = '新規'.$name;
	$labels->view_item = $name.'を表示';
	$labels->search_items = $name.'を検索';
	$labels->not_found = $name.'が見つかりませんでした';
	$labels->not_found_in_trash = 'ゴミ箱に'.$name.'は見つかりませんでした';
}
add_action( 'init', 'Change_objectlabel' );
add_action( 'admin_menu', 'Change_menulabel' );

/* 
メニュー並び替え
---------------------------------------------- */
function my_custom_menu_order($menu_order) {
    if (!$menu_order) return true;
    return array(
        'index.php', //ダッシュボード
		'separator1', //セパレータ２
        'edit.php', //お知らせ
        'edit.php?post_type=kaiin', //ブログページ
        'edit.php?post_type=yakuin', //固定ページ
        'separator2', //セパレータ２
        'edit.php?post_type=meibo', //ブログページ
        'edit.php?post_type=options', //ブログページ
        'upload.php', //メディア (一番下に移動しました)
		'separator3', //セパレータ２
        'separator-last', //最後のセパレータ
        'themes.php', //外観
        'plugins.php', //プラグイン
        'users.php', //ユーザー
        'tools.php', //ツール
        'options-general.php', //設定
    );
}
add_filter('custom_menu_order', 'my_custom_menu_order'); 
add_filter('menu_order', 'my_custom_menu_order');
