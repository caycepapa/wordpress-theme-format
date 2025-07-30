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
    // 画像アップロード処理
    if (isset($_POST['upload_ogp_image']) && check_admin_referer('upload_ogp_image_nonce')) {
        if (!empty($_FILES['ogp_image_file']['name'])) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
            require_once(ABSPATH . 'wp-admin/includes/media.php');
            require_once(ABSPATH . 'wp-admin/includes/image.php');
            
            $uploaded_file = wp_handle_upload($_FILES['ogp_image_file'], array('test_form' => false));
            
            if (!isset($uploaded_file['error'])) {
                $attachment = array(
                    'post_mime_type' => $uploaded_file['type'],
                    'post_title' => preg_replace('/\.[^.]+$/', '', basename($uploaded_file['file'])),
                    'post_content' => '',
                    'post_status' => 'inherit'
                );
                
                $attach_id = wp_insert_attachment($attachment, $uploaded_file['file']);
                $attach_data = wp_generate_attachment_metadata($attach_id, $uploaded_file['file']);
                wp_update_attachment_metadata($attach_id, $attach_data);
                
                update_option('default_ogp_image', $attach_id);
                echo '<div class="notice notice-success"><p>OGP画像をアップロードしました。</p></div>';
            } else {
                echo '<div class="notice notice-error"><p>アップロードエラー: ' . esc_html($uploaded_file['error']) . '</p></div>';
            }
        }
    }
    
    // 画像削除処理
    if (isset($_POST['delete_ogp_image']) && check_admin_referer('delete_ogp_image_nonce')) {
        $ogp_image_id = get_option('default_ogp_image');
        if ($ogp_image_id) {
            wp_delete_attachment($ogp_image_id, true);
        }
        delete_option('default_ogp_image');
        echo '<div class="notice notice-success"><p>OGP画像を削除しました。</p></div>';
    }
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
        
        <hr style="margin: 40px 0;">
        
        <h2>デフォルトOGP画像</h2>
        <?php
        $ogp_image_id = get_option('default_ogp_image');
        $ogp_image_url = $ogp_image_id ? wp_get_attachment_url($ogp_image_id) : '';
        ?>
        
        <?php if ($ogp_image_url) : ?>
            <div style="margin-bottom: 20px;">
                <img src="<?php echo esc_url($ogp_image_url); ?>" style="max-width: 600px; height: auto; display: block; margin-bottom: 10px; border: 1px solid #ddd;">
                <form method="post" style="display: inline;">
                    <?php wp_nonce_field('delete_ogp_image_nonce'); ?>
                    <input type="hidden" name="delete_ogp_image" value="1">
                    <button type="submit" class="button button-secondary" onclick="return confirm('OGP画像を削除してもよろしいですか？');">画像を削除</button>
                </form>
            </div>
        <?php endif; ?>
        
        <form method="post" enctype="multipart/form-data">
            <?php wp_nonce_field('upload_ogp_image_nonce'); ?>
            <table class="form-table">
                <tr>
                    <th scope="row">新しいOGP画像をアップロード</th>
                    <td>
                        <input type="file" name="ogp_image_file" accept="image/*" required>
                        <p class="description">推奨サイズ: 1200×630px（Facebook, Twitter等のOGPに使用されます）</p>
                    </td>
                </tr>
            </table>
            <input type="hidden" name="upload_ogp_image" value="1">
            <p class="submit">
                <button type="submit" class="button button-primary">画像をアップロード</button>
            </p>
        </form>
    </div>
    <?php
}

// 設定を登録
add_action('admin_init', 'site_settings_init');
function site_settings_init() {
    register_setting('site_settings_group', 'disable_cache_assets');
}