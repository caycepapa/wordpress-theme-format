<?php
    /**
    * @package WordPress
    * @subpackage valo
    * @since 2024
    */

    if ( !defined('ABSPATH') ) {
        die( 'Forbidden' );
    }
?>

<?php
    if(is_archive()) {
        get_template_part('template-parts/archive/archive-default');
    }
?>