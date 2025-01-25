<?php
    /**
    * @package WordPress
    * @subpackage projectname
    * @since 2024
    */

    if ( !defined('ABSPATH') ) {
        die( 'Forbidden' );
    }


function get_orign_links($name){

    $links = get_field('links', 'option');

    foreach($links as $key => $value){
        if($key == $name){
            return $value;
        }
    }
}

function the_origin_links($name){
    echo get_orign_links($name);
}