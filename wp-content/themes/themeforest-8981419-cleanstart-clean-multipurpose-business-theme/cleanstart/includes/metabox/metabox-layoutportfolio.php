<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M                    (c) 2013

File Description: Theme Specific Metaboxes

*/

if ( ! defined( 'ABSPATH' ) ) exit; // NO DIRECT ACCESS 

if ( class_exists('Plethora_Metabox') && !class_exists('Plethora_Metabox_LayoutPortfolio') ): 

	/**
	 * @package Plethora Base
	 */

	class Plethora_Metabox_LayoutPortfolio {

		public static function metabox(){

	    $page_options = array();
	    $page_options[] = array(
	        //'title'         => __('General Settings', 'cleanstart'),
	        'icon_class'    => 'icon-large',
	        'icon'          => 'el-icon-home',
	        'fields'        => array(


	            array(
	                'id'        =>  PLETHORA_META_PREFIX .'portfolio-layout',
	                'title'     => __( 'Select Layout', 'cleanstart' ),
	                'type'      => 'image_select',
	                'options'   => array( 
				                'side'	=> ReduxFramework::$_url . 'assets/img/2cr.png',
				                'full'	=> ReduxFramework::$_url . 'assets/img/1c.png',
	                )
	                ),
	        ),
	    );

	    $metabox = array(
	        'id'            => 'portfolio-display',
	        'title'         => __( 'Layout Options', 'cleanstart' ),
	        'post_types'    => array( 'portfolio'),
	        'position'      => 'side', // normal, advanced, side
	        'priority'      => 'high', // high, core, default, low
	        'sidebar'       => false, // enable/disable the sidebar in the normal/advanced positions
	        'sections'      => $page_options,
	    );



	    return $metabox;
	  }

	}

endif;