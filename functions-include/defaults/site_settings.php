<?php

    /**
    * @package WordPress
    * @subpackage projectname
    * @since 2023
    */
    if ( !defined('ABSPATH') ) {
        die( 'Forbidden' );
    }

// サイト設定ページ
function site_settings_page() {
    // 画像削除処理
    if (isset($_POST['delete_ogp_image']) && check_admin_referer('delete_ogp_image_nonce')) {
        delete_option('default_ogp_image');
        echo '<div class="notice notice-success"><p>OGP画像を削除しました。</p></div>';
    }
    ?>
    <div class="wrap">
        <h1>サイト設定</h1>
        <form method="post" action="options.php" enctype="multipart/form-data">
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
                <tr>
                    <th scope="row">デフォルトOGP画像</th>
                    <td>
                        <?php
                        $ogp_image_id = get_option('default_ogp_image');
                        $ogp_image_url = $ogp_image_id ? wp_get_attachment_url($ogp_image_id) : '';
                        ?>
                        <div id="ogp_image_preview" style="margin-bottom: 10px;">
                            <?php if ($ogp_image_url) : ?>
                                <img src="<?php echo esc_url($ogp_image_url); ?>" style="max-width: 300px; height: auto; display: block; margin-bottom: 10px;">
                            <?php endif; ?>
                        </div>
                        <input type="hidden" name="default_ogp_image" id="default_ogp_image" value="<?php echo esc_attr($ogp_image_id); ?>">
                        <button type="button" class="button" id="upload_ogp_image_button">画像を選択</button>
                        <?php if ($ogp_image_id) : ?>
                            <button type="button" class="button" id="remove_ogp_image_button" style="margin-left: 5px;">画像を削除</button>
                        <?php endif; ?>
                        <p class="description">推奨サイズ: 1200×630px（Facebook, Twitter等のOGPに使用されます）</p>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
        
        <?php if ($ogp_image_id) : ?>
        <form method="post" style="display: inline;">
            <?php wp_nonce_field('delete_ogp_image_nonce'); ?>
            <input type="hidden" name="delete_ogp_image" value="1">
        </form>
        <?php endif; ?>
    </div>
    
    <script>
    jQuery(document).ready(function($) {
        var frame;
        
        $('#upload_ogp_image_button').on('click', function(e) {
            e.preventDefault();
            
            if (frame) {
                frame.open();
                return;
            }
            
            frame = wp.media({
                title: 'OGP画像を選択',
                button: {
                    text: 'この画像を使用'
                },
                multiple: false
            });
            
            frame.on('select', function() {
                var attachment = frame.state().get('selection').first().toJSON();
                $('#default_ogp_image').val(attachment.id);
                $('#ogp_image_preview').html('<img src="' + attachment.url + '" style="max-width: 300px; height: auto; display: block; margin-bottom: 10px;">');
                $('#remove_ogp_image_button').remove();
                $('#upload_ogp_image_button').after('<button type="button" class="button" id="remove_ogp_image_button" style="margin-left: 5px;">画像を削除</button>');
            });
            
            frame.open();
        });
        
        $(document).on('click', '#remove_ogp_image_button', function(e) {
            e.preventDefault();
            $('#default_ogp_image').val('');
            $('#ogp_image_preview').html('');
            $(this).remove();
        });
    });
    </script>
    <?php
}

// 設定を登録
add_action('admin_init', 'site_settings_init');
function site_settings_init() {
    register_setting('site_settings_group', 'disable_cache_assets');
    register_setting('site_settings_group', 'default_ogp_image');
}

// メディアアップローダーのスクリプトを読み込む
add_action('admin_enqueue_scripts', 'enqueue_media_uploader');
function enqueue_media_uploader($hook) {
    if ($hook !== 'admin_page_site-settings') {
        return;
    }
    wp_enqueue_media();
}