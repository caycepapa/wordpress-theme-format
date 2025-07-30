<?php

    /**
    * @package WordPress
    * @subpackage projectname
    * @since 2023
    */
    if ( !defined('ABSPATH') ) {
        die( 'Forbidden' );
    }

function create_ogpimage(){
    $ogp_image = '';
    
    // 個別ページの場合
    if(is_singular()){
        // アイキャッチ画像を取得
        if(has_post_thumbnail()){
            $thumbnail_id = get_post_thumbnail_id();
            $thumbnail_url = wp_get_attachment_image_src($thumbnail_id, 'large');
            if($thumbnail_url){
                $ogp_image = $thumbnail_url[0];
            }
        }
    }
    
    // アイキャッチ画像が存在しない場合、デフォルトのOGP画像を設定
    if(!$ogp_image){
        // サイト設定で設定されたOGP画像を取得
        $default_ogp_id = get_option('default_ogp_image');
        if($default_ogp_id){
            $default_ogp_url = wp_get_attachment_url($default_ogp_id);
            if($default_ogp_url){
                $ogp_image = $default_ogp_url;
            }
        }
    }
    
    return $ogp_image;
}

function the_create_ogpimage(){
    echo create_ogpimage();
}

// OGP画像設定をサイト設定ページに追加
add_action('admin_init', 'ogp_image_settings_init');
function ogp_image_settings_init() {
    add_settings_section(
        'ogp_image_section',
        'デフォルトOGP画像設定',
        'ogp_image_section_callback',
        'site_settings'
    );
    
    register_setting('site_settings_group', 'default_ogp_image_url');
}

// セクションの説明
function ogp_image_section_callback() {
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
                
                // 古い画像を削除
                $old_id = get_option('default_ogp_image');
                if ($old_id) {
                    wp_delete_attachment($old_id, true);
                }
                
                update_option('default_ogp_image', $attach_id);
                update_option('default_ogp_image_url', $uploaded_file['url']);
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
        delete_option('default_ogp_image_url');
        echo '<div class="notice notice-success"><p>OGP画像を削除しました。</p></div>';
    }
    
    $ogp_image_url = get_option('default_ogp_image_url');
    ?>
    <p>SNSでシェアされた際に表示されるデフォルトのOGP画像を設定します。</p>
    
    <?php if ($ogp_image_url) : ?>
        <div style="margin: 20px 0;">
            <img src="<?php echo esc_url($ogp_image_url); ?>" style="max-width: 600px; height: auto; display: block; margin-bottom: 10px; border: 1px solid #ddd;">
            <form method="post" style="display: inline;">
                <?php wp_nonce_field('delete_ogp_image_nonce'); ?>
                <input type="hidden" name="delete_ogp_image" value="1">
                <button type="submit" class="button button-secondary" onclick="return confirm('OGP画像を削除してもよろしいですか？');">画像を削除</button>
            </form>
        </div>
    <?php endif; ?>
    
    <form method="post" enctype="multipart/form-data" style="margin-top: 20px;">
        <?php wp_nonce_field('upload_ogp_image_nonce'); ?>
        <table class="form-table">
            <tr>
                <th scope="row">新しいOGP画像をアップロード</th>
                <td>
                    <input type="file" name="ogp_image_file" accept="image/*" required>
                    <p class="description">推奨サイズ: 1200×630px（Facebook、Twitter等のOGPに使用されます）</p>
                </td>
            </tr>
        </table>
        <input type="hidden" name="upload_ogp_image" value="1">
        <p>
            <button type="submit" class="button button-primary">画像をアップロード</button>
        </p>
    </form>
    <?php
}