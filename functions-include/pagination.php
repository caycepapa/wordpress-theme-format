<?php

    /**
    * @package WordPress
    * @subpackage valo
    * @since 2023
    */
    if ( !defined('ABSPATH') ) {
        die( 'Forbidden' );
    }


/* 
ページネーション
---------------------------------------------- */
function pagination( $pages, $paged, $range = 2, $show_only = false ) {

    $pages = ( int ) $pages;    //float型で渡ってくるので明示的に int型 へ
    $paged = $paged ?: 1;       //get_query_var('paged')をそのまま投げても大丈夫なように

    //表示テキスト
    $text_first   = "<< 最初へ";
    $text_before  = "＜";
    $text_next    = "＞";
    $text_last    = "最後へ >>";

    if ( $show_only && $pages === 1 ) {
        // １ページのみで表示設定が true の時
        echo '<div class="p-pagenation"><span class="current pager">1</span></div>';
        return;
    }

    if ( $pages === 1 ) return;    // １ページのみで表示設定もない場合

    if ( 1 !== $pages ) {
        //２ページ以上の時
        echo '<div class="p-pagenation">';
        if ( $paged > 1 ) {
            // 「前へ」 の表示
            echo '<a href="', get_pagenum_link( $paged - 1 ) ,'" class="prev">', $text_before ,'</a>';
        }
        for ( $i = 1; $i <= $pages; $i++ ) {

            if ( $i <= $paged + $range && $i >= $paged - $range ) {
                // $paged +- $range 以内であればページ番号を出力
                if ( $paged === $i ) {
                    echo '<span class="current pager">', $i ,'</span>';
                } else {
                    echo '<a href="', get_pagenum_link( $i ) ,'" class="pager">', $i ,'</a>';
                }
            }

        }
        if ( $paged < $pages ) {
            // 「次へ」 の表示
            echo '<a href="', get_pagenum_link( $paged + 1 ) ,'" class="next">', $text_next ,'</a>';
        }
        echo '</div>';
    }
}