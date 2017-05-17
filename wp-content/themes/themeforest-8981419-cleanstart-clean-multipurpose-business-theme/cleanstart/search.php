<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M			      (c) 2014-2015
*/
if ( class_exists('Plethora_Theme')) { 

	Plethora_Theme::dev_comment( Plethora_Theme::page_dev_comment(), 'page' );
	Plethora_Theme::dev_comment('Start >>> WP template file loaded: search.php ( just includes a template part file, check next comment )', 'templateparts');
	get_template_part('includes/partials/layout', 'blog' );
	Plethora_Theme::dev_comment('End <<< search.php', 'templateparts');

} else { 

	get_template_part('includes/partials/layout', 'pluginalert' );

}	