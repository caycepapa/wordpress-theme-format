<?php
    /**
    * @package WordPress
    * @subpackage projectname
    * @since 2023
    */

    if ( !defined('ABSPATH') ) {
        die( 'Forbidden' );
    }

add_filter( 'ppp_nonce_life', 'ppp_change_the_period' );
function ppp_change_the_period() {
    // 期間を変更する (秒) 60 * 60 * 24 * 30 = 30日
    return 60 * 60 * 24 * 30;
}