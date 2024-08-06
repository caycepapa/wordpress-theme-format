<?php
    // Template Name: Home
    /**
    * @package WordPress
    * @subpackage valo.com
    * @since 2024
    */

    if ( !defined('ABSPATH') ) {
        die( 'Forbidden' );
    }
?>

<?php get_header();?>

<?php the_title();?>
<?php echo breadcrumb();?>

<?php get_footer();?>