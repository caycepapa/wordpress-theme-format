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
テーマカラーの設定
----------------------------------------------
function my_color_pallet(){
    add_theme_support('editor-color-palette',array(
        array(
            'name' => __('main-color1','NGS blue'),
            'slug' => 'blue',
            'color' => '#008CD6',
        ),
    ));
}
add_action('after_setup_theme', 'my_color_pallet');
*/


/*
ブロックエディタのクラス付与
---------------------------------------------- 
function mytheme_register_block_styles() {

    // グループのスタイル
    register_block_style(
        'core/group',
        array(
            'name'  => 'has-bg-color-gray',
            'label' => __( '背景色グレー', 'mytheme' ),
        )
    );
    register_block_style(
        'core/group',
        array(
            'name'  => 'has-bg-color-lightblue',
            'label' => __( '背景色水色', 'mytheme' ),
        )
    );
    register_block_style(
        'core/group',
        array(
            'name'  => 'has-bg-color-white',
            'label' => __( '背景色白', 'mytheme' ),
        )
    );
    register_block_style(
        'core/group',
        array(
            'name'  => 'has-bg-color-yellow',
            'label' => __( '背景色黄色', 'mytheme' ),
        )
    );

    // 見出しのh2のスタイル
    register_block_style(
        'core/heading',
        array(
            'name'  => 'has-text-color-yellow',
            'label' => __( 'h2黄色背景青文字', 'mytheme' ),
        )
    );

    // ボタンのスタイル
    register_block_style(
        'core/button',
        array(
            'name'  => 'has-bg-color-yellow',
            'label' => __( '黄色背景', 'mytheme' ),
        )
    );
}
add_action( 'init', 'mytheme_register_block_styles' );*/