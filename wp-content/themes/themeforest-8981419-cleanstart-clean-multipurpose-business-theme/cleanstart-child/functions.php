<?php
@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M			      (c) 2014-2015

File Description: Child Theme Functions file 

*/

if ( ! defined( 'ABSPATH' ) ) exit; // NO DIRECT ACCESS 

//---------------------------------------------------------------//
//						DO YOUR STUFF HERE!!
//---------------------------------------------------------------//

function my_jquery_scripts() {

    $PathToMyScript = get_stylesheet_directory_uri() . "/js/my-scripts.js";

    wp_register_script('my-jquery-js', $PathToMyScript, array( 'jquery' ), time(), true);
    wp_enqueue_script('my-jquery-js');

} add_action('wp_enqueue_scripts', 'my_jquery_scripts');