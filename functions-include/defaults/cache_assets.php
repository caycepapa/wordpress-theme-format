<?php

    /**
    * @package WordPress
    * @subpackage projectname
    * @since 2023
    */
    if ( !defined('ABSPATH') ) {
        die( 'Forbidden' );
    }

// 独自設定メニューにサイト設定サブメニューを追加
add_action('admin_menu', 'add_site_settings_menu', 11);
function add_site_settings_menu() {
    add_submenu_page(
        'origin-settings',
        'サイト設定',
        'サイト設定',
        'manage_options',
        'site-settings',
        'site_settings_page'
    );
}

// サイト設定ページ
function site_settings_page() {
    ?>
    <div class="wrap">
        <h1>サイト設定</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('site_settings_group');
            do_settings_sections('site_settings');
            ?>
            <table class="form-table">
                <tr>
                    <th scope="row">キャッシュ設定</th>
                    <td>
                        <label>
                            <input type="checkbox" name="disable_cache_assets" value="1" <?php checked(get_option('disable_cache_assets'), 1); ?> />
                            CSS・JavaScriptをキャッシュさせない
                        </label>
                        <p class="description">チェックを入れると、style.cssとbundle.jsの後に日付時分秒のパラメータが付与されます。</p>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// 設定を登録
add_action('admin_init', 'site_settings_init');
function site_settings_init() {
    register_setting('site_settings_group', 'disable_cache_assets');
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
