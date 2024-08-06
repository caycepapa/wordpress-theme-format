<?php

    /**
    * @package WordPress
    * @subpackage valo
    * @since 2023
    */
    if ( !defined('ABSPATH') ) {
        die( 'Forbidden' );
    }

// パンくずリスト生成

function breadcrumb() {
    global $post;
    $str ='';
    if ( !is_home() && !is_admin() ) {
        $str.= '<ul class="c-breadcrumb">';
        $str.= '<li><a href="'.esc_url(home_url()).'">ホーム</i></a></li>';

        if(is_page()){
            $str.= '<li>'.get_the_title().'</li>';
        }elseif(is_post_type_archive('blog')){
            $str.= '<li>ブログ</li>';
        }elseif(is_category()){
            $str.= '<li><a href="'.esc_url( home_url() ).'/topics/">お知らせ</a></li>';
            $str.= '<li>'.single_cat_title('',false).'</li>';
        }elseif(is_archive()){
            $str.= '<li>お知らせ</li>';
        }else{
            $str.= '<li>'.get_the_title().'</li>';
        }
    }
    $str.= '</ul>';
    return $str;
}