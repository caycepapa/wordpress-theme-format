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

// キャッシュ設定をサイト設定ページに追加
add_action('admin_init', 'cache_assets_settings_init');
function cache_assets_settings_init() {
    add_settings_section(
        'cache_assets_section',
        'キャッシュ設定',
        'cache_assets_section_callback',
        'site_settings'
    );
    
    add_settings_field(
        'disable_cache_assets',
        'キャッシュ無効化',
        'disable_cache_assets_callback',
        'site_settings',
        'cache_assets_section'
    );
    
    register_setting('site_settings_group', 'disable_cache_assets');
}

// セクションの説明
function cache_assets_section_callback() {
    echo '<p>CSS・JavaScriptファイルのキャッシュに関する設定を行います。</p>';
}

// キャッシュ無効化フィールドの表示
function disable_cache_assets_callback() {
    $disable_cache = get_option('disable_cache_assets');
    ?>
    <label>
        <input type="checkbox" name="disable_cache_assets" value="1" <?php checked($disable_cache, 1); ?> />
        CSS・JavaScriptをキャッシュさせない
    </label>
    <p class="description">チェックを入れると、style.cssとbundle.jsの後に日付時分秒のパラメータが付与されます。</p>
    <?php
}