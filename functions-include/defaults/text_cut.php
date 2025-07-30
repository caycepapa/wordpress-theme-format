<?php

    /**
    * @package WordPress
    * @subpackage projectname
    * @since 2023
    */
    if ( !defined('ABSPATH') ) {
        die( 'Forbidden' );
    }

function get_text_cut($text , $cutNum){
    if(mb_strlen($text, 'UTF-8') > $cutNum){
        $afterTxt = mb_substr(strip_tags($text), 0, $cutNum, 'UTF-8');
        return $afterTxt.'…';
    }else{
        return strip_tags($text);
    }
}

function the_text_cut($text , $cutNum){
    echo get_text_cut($text, $cutNum);
}