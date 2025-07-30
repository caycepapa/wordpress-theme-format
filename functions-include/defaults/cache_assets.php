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

// キャッシュ設定を登録
add_action('admin_init', 'cache_assets_settings_init', 5);
function cache_assets_settings_init() {
    register_setting('site_settings_group', 'disable_cache_assets');
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