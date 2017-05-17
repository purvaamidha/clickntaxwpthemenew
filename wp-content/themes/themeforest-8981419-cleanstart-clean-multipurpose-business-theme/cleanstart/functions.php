<?php
@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M 				   (c) 2013

File Description: Theme Functions file 

*/

if ( ! defined( 'ABSPATH' ) ) exit; // NO DIRECT ACCESS 

//---------------------------------------------------------------//
//							  SETUP
//---------------------------------------------------------------//

require_once( get_template_directory() . '/assets/tgm/class-tgm-plugin-activation.php' );

/**
 * @package Plethora
 */
if (class_exists('Plethora')) { 

	$plethora = new Plethora();

}