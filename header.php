<!DOCTYPE html>
<html lang="ja">
<head>
    <?php wp_head(); ?>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo esc_url(get_template_directory_uri());?>/assets/css/style.css?<?php echo date('YmdHis'); ?>">
    <link rel="icon" href="<?php echo esc_url(get_template_directory_uri());?>/favicon.ico">
    <meta name="viewport" content="width=device-width, height=device-height ,initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="<?php bloginfo('description');?>">
    <meta property="og:title" content="<?php bloginfo('site_name');?>">
    <meta property="og:description" content="<?php bloginfo('description');?>">
    <meta property="og:url" content="https://www.one-dejima.com/">
    <meta property="og:type" content="website">
    <meta property="og:image" content="<?php echo esc_url(get_template_directory_uri());?>/assets/img/ogp.jpg">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php bloginfo('site_name');?>">
    <meta name="twitter:description" content="<?php bloginfo('description');?>">
    <meta property="twitter:image" content="<?php echo esc_url(get_template_directory_uri());?>/assets/img/ogp.jpg">
    <title><?php bloginfo('site_name');?></title>
    <script src="https://webfont.fontplus.jp/accessor/script/fontplus.js?ou1T6RM1Jn0%3D&box=8adkOtDQDRQ%3D&aa=1&ab=2"></script>
</head>
<body <?php body_class(); ?>>
    <div class="l-container" id="top">
        <?php get_template_part('template-parts/header/common'); ?>
        <main class="l-main">