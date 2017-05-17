<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M			      (c) 2014-2015

File Description: Handles all sidebars

*/
Plethora_Theme::dev_comment('Start >>> Sidebar template part loaded: '. THEME_PARTIALS_DIR . '/'. basename( __FILE__ ), 'templateparts');
// if showing a single page
if ( is_page() ) { $sidebar = Plethora_Theme::option( PLETHORA_META_PREFIX . 'page-sidebar', 'sidebar-default'); }
// if showing a blog post
if ( is_single() ) { $sidebar = Plethora_Theme::option( PLETHORA_META_PREFIX . 'post-sidebar', 'sidebar-default'); }
// if showing a blog / archive / search page
if ( is_home() || is_archive() || is_search() ) { $sidebar   = Plethora_Theme::option('blog-sidebar', 'sidebar-default'); }
// Filter selected sidebar
$sidebar = apply_filters( 'plethora_sidebar', $sidebar );

if ( is_active_sidebar( $sidebar ) ) :
	Plethora_Theme::dev_comment('Start >>> Sidebar ( sidebar id: '. $sidebar .' ) ', 'layout');
	echo '<div id="sidebar" class="col-sm-4 col-md-4">';
		dynamic_sidebar( $sidebar ); 
	echo '</div>'; 
	Plethora_Theme::dev_comment('End >>> Sidebar ( sidebar id: '. $sidebar .' ) ', 'layout');
endif;
Plethora_Theme::dev_comment('End <<< '. THEME_PARTIALS_DIR . '/'. basename( __FILE__ ), 'templateparts');