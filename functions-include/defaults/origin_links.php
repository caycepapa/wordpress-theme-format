<?php
    /**
    * @package WordPress
    * @subpackage projectname
    * @since 2024
    */

    if ( !defined('ABSPATH') ) {
        die( 'Forbidden' );
    }

// 独自設定メインページ
function origin_settings_page() {
    ?>
    <div class="wrap">
        <h1>独自設定</h1>
        <p>独自設定のメインページです。</p>
    </div>
    <?php
}

// リンク設定ページ
function origin_links_page() {
    ?>
    <div class="wrap">
        <h1>リンク設定</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('origin_links_settings');
            do_settings_sections('origin_links_settings');
            ?>
            <div id="origin-links-container">
                <?php
                $links = get_option('origin_links', array());
                if (!empty($links)) {
                    foreach ($links as $index => $link) {
                        ?>
                        <div class="origin-link-item" style="margin-bottom: 20px; padding: 10px; border: 1px solid #ddd;">
                            <p>
                                <label>リンク名: <input type="text" name="origin_links[<?php echo $index; ?>][name]" value="<?php echo esc_attr($link['name'] ?? ''); ?>" style="width: 300px;" /></label>
                            </p>
                            <p>
                                <label>URL: <input type="url" name="origin_links[<?php echo $index; ?>][url]" value="<?php echo esc_url($link['url'] ?? ''); ?>" style="width: 500px;" /></label>
                            </p>
                            <p>
                                <button type="button" class="button remove-link" onclick="removeLink(this)">削除</button>
                            </p>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <div class="origin-link-item" style="margin-bottom: 20px; padding: 10px; border: 1px solid #ddd;">
                        <p>
                            <label>リンク名: <input type="text" name="origin_links[0][name]" value="" style="width: 300px;" /></label>
                        </p>
                        <p>
                            <label>URL: <input type="url" name="origin_links[0][url]" value="" style="width: 500px;" /></label>
                        </p>
                        <p>
                            <button type="button" class="button remove-link" onclick="removeLink(this)">削除</button>
                        </p>
                    </div>
                    <?php
                }
                ?>
            </div>
            <p>
                <button type="button" class="button button-secondary" onclick="addLink()">リンクを追加</button>
            </p>
            <?php submit_button(); ?>
        </form>
        
        <hr style="margin: 40px 0;">
        
        <h2>設定した値の取得方法</h2>
        <pre style="background: #f1f1f1; padding: 15px; overflow: auto;">
                // リンク名を指定してURLを取得
                get_origin_link('リンク名');
                // リンク名を指定してURLを表示
                the_origin_link('リンク名');
        </pre>
    </div>
    
    <script>
    function addLink() {
        var container = document.getElementById('origin-links-container');
        var items = container.getElementsByClassName('origin-link-item');
        var newIndex = items.length;
        
        var newItem = document.createElement('div');
        newItem.className = 'origin-link-item';
        newItem.style.cssText = 'margin-bottom: 20px; padding: 10px; border: 1px solid #ddd;';
        newItem.innerHTML = `
            <p>
                <label>リンク名: <input type="text" name="origin_links[${newIndex}][name]" value="" style="width: 300px;" /></label>
            </p>
            <p>
                <label>URL: <input type="url" name="origin_links[${newIndex}][url]" value="" style="width: 500px;" /></label>
            </p>
            <p>
                <button type="button" class="button remove-link" onclick="removeLink(this)">削除</button>
            </p>
        `;
        
        container.appendChild(newItem);
    }
    
    function removeLink(button) {
        var item = button.closest('.origin-link-item');
        item.remove();
        
        // インデックスを再設定
        var container = document.getElementById('origin-links-container');
        var items = container.getElementsByClassName('origin-link-item');
        for (var i = 0; i < items.length; i++) {
            var inputs = items[i].getElementsByTagName('input');
            for (var j = 0; j < inputs.length; j++) {
                var name = inputs[j].getAttribute('name');
                if (name) {
                    inputs[j].setAttribute('name', name.replace(/\[\d+\]/, '[' + i + ']'));
                }
            }
        }
    }
    </script>
    <?php
}

// 設定を登録
add_action('admin_init', 'origin_links_settings_init');
function origin_links_settings_init() {
    register_setting('origin_links_settings', 'origin_links', 'sanitize_origin_links');
}

// サニタイズ関数
function sanitize_origin_links($input) {
    $sanitized = array();
    
    if (is_array($input)) {
        foreach ($input as $link) {
            if (!empty($link['name']) || !empty($link['url'])) {
                $sanitized[] = array(
                    'name' => sanitize_text_field($link['name'] ?? ''),
                    'url' => esc_url_raw($link['url'] ?? '')
                );
            }
        }
    }
    
    return $sanitized;
}

function get_origin_link($name){
    $links = get_option('origin_links', array());
    foreach ($links as $link) {
        if (isset($link['name']) && $link['name'] === $name) {
            return isset($link['url']) ? esc_url($link['url']) : '';
        }
    }
    return '';
}

function the_origin_link($name){
    echo get_origin_link($name);
}