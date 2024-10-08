<?php 

    /**
    * @package WordPress
    * @subpackage projectname
    * @since 2023
    */
    if ( !defined('ABSPATH') ) {
        die( 'Forbidden' );
    }

/* 
ブロックエディタ CSS
---------------------------------------------- */
if ( ! function_exists( 'editor_setup' ) ) :
    function editor_setup() {
        add_theme_support( 'wp-block-styles' );
        add_theme_support( 'editor-styles' );
        add_editor_style( 'assets/css/editor.css' );
    }
endif;
add_action( 'after_setup_theme', 'editor_setup' );


/* 
パターンの非表示 & 親カテゴリの非表示
---------------------------------------------- */
function my_head() {
    ?>
        <style>
            #tab-panel-0-patterns{
                display: none !important;
            }
            .editor-post-taxonomies__hierarchical-terms-add + form .components-base-control:not(:first-child){
                display: none !important;
            }
            #postbox-container-1 #wp-version{
                display: none !important;
            }
            #dashboard_right_now .page-count{
                display: none !important;
            }
        </style>
    <?php
}
add_action('admin_head', 'my_head', 11);

/* 
ブロックエディタ非表示
---------------------------------------------- */
add_action('acf/init', 'my_acf_init_block_types', 10, 2);
function my_acf_init_block_types() {
    if( function_exists('acf_register_block_type') ) {

        // ページダウン
        acf_register_block_type(array(
            'name'              => 'pagedown',
            'title'             => __('ページダウン'),
            'description'       => __('ページダウンのカスタムブロックです。'),
            'render_template'   => 'acf/blocks/pagedown.php',
            'category'          => 'acf-blocks',
            'icon'              => 'button',
            'keywords'          => array( 'button', 'pagedown' ),
            'mode' => 'auto',
        ));

        // h1-ttl
        acf_register_block_type(array(
            'name'              => 'h1-ttl',
            'title'             => __('H1タイトル'),
            'description'       => __('H1タイトルのカスタムブロックです。'),
            'render_template'   => 'acf/blocks/h1-ttl.php',
            'category'          => 'acf-blocks',
            'icon'              => 'admin-site',
            'keywords'          => array( 'h1', 'ttl' ),
            'mode' => 'auto',
        ));
    }
}

/* 
ブロックエディタ非表示
---------------------------------------------- */
add_filter( 'allowed_block_types_all', 'my_plugin_allowed_block_types_all', 10, 2 );
function my_plugin_allowed_block_types_all( $allowed_block_types) {
	$allowed_block_types = array(
		'core/paragraph',
		'core/heading',
		'core/image',
        'core/button',
        'core/buttons',
        'core/embed',
        'core/file',
        'core/gallery',
        'core/list',
        'core/shortcode',
        'core/table',
        'core/columns',
        'core/group',
        'acf/pagedown',
        'acf/h1-ttl',
	);
	return $allowed_block_types;
}

function add_block_categories( $categories ) {
    $add_categories = [
        [
        'slug' => 'acf-blocks',
        'title' => '専用ブロック',
        ],
    ];

    $categories = array_merge( $add_categories, $categories );
    return $categories;
}

add_filter( 'block_categories', 'add_block_categories', 10, 2 );