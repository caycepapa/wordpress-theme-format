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
    
    add_settings_field(
        'default_ogp_image',
        'OGP画像',
        'default_ogp_image_callback',
        'site_settings',
        'ogp_image_section'
    );
    
    register_setting('site_settings_group', 'default_ogp_image');
}

// セクションの説明
function ogp_image_section_callback() {
    echo '<p>SNSでシェアされた際に表示されるデフォルトのOGP画像を設定します。</p>';
}

// OGP画像フィールドの表示
function default_ogp_image_callback() {
    $ogp_image_id = get_option('default_ogp_image');
    $ogp_image_url = $ogp_image_id ? wp_get_attachment_url($ogp_image_id) : '';
    ?>
    <div id="ogp_image_preview" style="margin-bottom: 10px;">
        <?php if ($ogp_image_url) : ?>
            <img src="<?php echo esc_url($ogp_image_url); ?>" style="max-width: 600px; height: auto; display: block; margin-bottom: 10px; border: 1px solid #ddd;">
        <?php endif; ?>
    </div>
    <input type="hidden" name="default_ogp_image" id="default_ogp_image" value="<?php echo esc_attr($ogp_image_id); ?>">
    <button type="button" class="button" id="upload_ogp_image_button">画像を選択</button>
    <?php if ($ogp_image_id) : ?>
        <button type="button" class="button" id="remove_ogp_image_button" style="margin-left: 5px;">画像を削除</button>
    <?php endif; ?>
    <p class="description">推奨サイズ: 1200×630px（Facebook、Twitter等のOGPに使用されます）</p>
    
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
                $('#ogp_image_preview').html('<img src="' + attachment.url + '" style="max-width: 600px; height: auto; display: block; margin-bottom: 10px; border: 1px solid #ddd;">');
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

// メディアアップローダーのスクリプトを読み込む
add_action('admin_enqueue_scripts', 'enqueue_ogp_media_uploader');
function enqueue_ogp_media_uploader($hook) {
    if ($hook !== 'origin-settings_page_site-settings') {
        return;
    }
    wp_enqueue_media();
}