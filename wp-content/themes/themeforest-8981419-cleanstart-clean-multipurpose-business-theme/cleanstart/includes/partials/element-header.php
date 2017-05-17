<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M            (c) 2014

File Description: Header 

*/
Plethora_Theme::dev_comment('Start >>> Header Template Part Loaded: '. THEME_PARTIALS_DIR . '/'. basename( __FILE__ ), 'templateparts');
$header_layout    = Plethora_Theme::option( PLETHORA_META_PREFIX .'header-layout', 'classic'); 
$header_bcg_trans = Plethora_Theme::option('header-background-transparency', 100);
$header_toolbar   = Plethora_Theme::option( PLETHORA_META_PREFIX .'header-toolbar');
$icon_retina114   = Plethora_Theme::option( 'icon-retina114');
$icon_retina72    = Plethora_Theme::option( 'icon-retina72');
$icon_retina57    = Plethora_Theme::option( 'icon-retina57');
$icon_favicon     = Plethora_Theme::option( 'favicon');
?><!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
<meta charset="utf-8">

<title><?php wp_title('|',1,'right'); ?> <?php bloginfo('name'); ?></title>
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="HandheldFriendly" content="true" />
<meta name="apple-touch-fullscreen" content="yes" />
<?php if ( isset( $icon_retina114['url'] ) && !empty( $icon_retina114['url'] )) { ?>
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo esc_url( $icon_retina114['url'] ) ?>">
<?php } ?>
<?php if ( isset( $icon_retina72['url'] ) && !empty( $icon_retina72['url'] )) { ?>
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo esc_url( $icon_retina72['url'] ) ?>">
<?php } ?>
<?php if ( isset( $icon_retina57['url'] ) && !empty( $icon_retina57['url'] )) { ?>
<link rel="apple-touch-icon-precomposed" href="<?php echo esc_url( $icon_retina57['url'] ) ?>">
<?php } ?>
<?php if ( isset( $icon_favicon['url'] ) && !empty( $icon_favicon['url'] )) { ?>
<link rel="shortcut icon" href="<?php echo esc_url( $icon_favicon['url'] ) ?>">
<?php } ?>
<link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" type="text/css">
<?php echo method_exists('Plethora_Theme', 'analytics') ? Plethora_Theme::analytics('header') : ''; // Analytics code ?>
<?php
$thread_comments = method_exists('Plethora_CMS', 'get_option') ? Plethora_CMS::get_option('thread_comments') : get_option('thread_comments');
if ( is_singular() && comments_open() && $thread_comments ) { wp_enqueue_script( 'comment-reply' ); } // WP Javascript Comment Functionality 
?>
<?php wp_head(); ?>
</head>
<?php 
$body_classes = array('sticky_header');
$body_classes[] = $header_bcg_trans != 100 ? 'transparent_header' : '';
?>
<body <?php body_class( $body_classes ); ?>>
<?php Plethora_Theme::dev_comment('Start >>> Overflow Wrapper ( holds everything, ends right before </body> )', 'layout'); ?>
	<div class="overflow_wrapper">
<?php Plethora_Theme::dev_comment('Start >>> Header Section', 'layout'); ?>
	  <header<?php if ( $header_layout == 'centered') { echo ' class="nav_header centered"'; } else { echo ' class="nav_header"'; } ?>>
      <?php if ( $header_toolbar == 1 ) { get_template_part('includes/partials/element', 'toolbar' ); } ?>
	  <?php get_template_part('includes/partials/element', 'navigation-main'); // Main Navigation ?>
	  </header>
<?php Plethora_Theme::dev_comment('End <<< Header Section', 'layout'); ?>
<?php Plethora_Theme::html_headermedia(); // Header Media section ?>
<?php Plethora_Theme::dev_comment('End <<< '. THEME_PARTIALS_DIR . '/'. basename( __FILE__ ), 'templateparts');?>