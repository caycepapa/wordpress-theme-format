<?php

    /**
    * @package WordPress
    * @subpackage projectname
    * @since 2023
    */
    if ( !defined('ABSPATH') ) {
        die( 'Forbidden' );
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <?php wp_head(); ?>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo esc_url(get_template_directory_uri());?>/assets/css/style.css?<?php echo date('YmdHis'); ?>">
    <link rel="icon" href="<?php echo esc_url(get_template_directory_uri());?>/favicon.ico">
    <meta name="viewport" content="width=device-width, height=device-height ,initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="<?php bloginfo('description');?>">
    <meta property="og:title" content="<?php the_create_title();?>">
    <meta property="og:site_name" content="<?php bloginfo('site_name');?>">
    <meta property="og:description" content="<?php bloginfo('description');?>">
    <meta property="og:url" content="<?php the_permalink();?>">
    <meta property="og:type" content="website">
    <meta property="og:image" content="<?php echo esc_url(get_template_directory_uri());?>/assets/img/cmn/ogp.png">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php the_create_title();?>">
    <meta name="twitter:description" content="<?php bloginfo('description');?>">
    <meta property="twitter:image" content="<?php echo esc_url(get_template_directory_uri());?>/assets/img/cmn/ogp.png">
    <title><?php the_create_title();?></title>
</head>
<body <?php body_class(); ?>>
    <div class="l-container" id="top">
        <?php get_template_part('template-parts/header/common'); ?>
        <main class="l-main">