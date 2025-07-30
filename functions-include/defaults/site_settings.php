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
    ?>
    <div class="wrap">
        <h1>サイト設定</h1>
        <form method="post" action="options.php" enctype="multipart/form-data">
            <?php
            settings_fields('site_settings_group');
            do_settings_sections('site_settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}