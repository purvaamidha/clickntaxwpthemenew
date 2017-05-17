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

if ( class_exists('Plethora_Metabox') && !class_exists('Plethora_Metabox_LayoutPage') ): 

	/**
	 * @package Plethora Base
	 */

	class Plethora_Metabox_LayoutPage {

		public static function metabox(){

	    $page_options[] = array(
	        //'title'         => __('General Settings', 'cleanstart'),
	        'icon_class'    => 'icon-large',
	        'icon'          => 'el-icon-home',
	        'fields'        => array(
	            array(
	                'id'        =>  PLETHORA_META_PREFIX .'page-layout',
	                'title'     => __( 'Select Layout', 'cleanstart' ),
	                'type'      => 'image_select',
	                'customizer'=> array(),
	                'options'   => array( 
		                0           => ReduxFramework::$_url . 'assets/img/1c.png',
		                1           => ReduxFramework::$_url . 'assets/img/2cr.png',
		                2           => ReduxFramework::$_url . 'assets/img/2cl.png',
		                )
	                ),

	                array(
	                    'id'=> PLETHORA_META_PREFIX .'page-sidebar',
	                    'type' => 'select',
	                    'required' => array(PLETHORA_META_PREFIX .'page-layout','equals',array('1','2')),  
	                    'data' => 'sidebars',
	                    'multi' => false,
	                    'title' => __('Select Sidebar', 'cleanstart'), 
					),

	        ),
	    );

	    $blog_options[] = array(
	        //'title'         => __('General Settings', 'cleanstart'),
	        'icon_class'    => 'icon-large',
	        'icon'          => 'el-icon-home',
	        'fields'        => array(

	            array(
	                'id'        => 'blog-layout',
	                'title'     => __( 'Layout', 'cleanstart' ),
	                'type'      => 'image_select',
					'default'  => 'right_sidebar',
	                'options'   => array( 
							'right_sidebar'	=> ReduxFramework::$_url . 'assets/img/2cr.png',
							'left_sidebar'	=> ReduxFramework::$_url . 'assets/img/2cl.png',
	                )
	            ),
				array(
					'id'=>'blog-sidebar',
					'type' => 'select',
					'data' => 'sidebars',
					'multi' => false,
					'default'  => 'sidebar-default',
					'title' => __('Sidebar', 'cleanstart'), 
				),
	        ),
	    );

	    $shop_options[] = array(
	        'icon_class'    => 'icon-large',
	        'icon'          => 'el-icon-home',
	        'fields'        => array(

	            array(
	                'id'        =>  PLETHORA_META_PREFIX .'wooarchive-layout',
	                'title'     => __( 'Catalog Layout', 'cleanstart' ),
	                'default'   => 'right_sidebar',
	                'type'      => 'image_select',
					'options' => array( 
							'full'         => ReduxFramework::$_url . 'assets/img/1c.png',
							'right_sidebar'         => ReduxFramework::$_url . 'assets/img/2cr.png',
							'left_sidebar'         => ReduxFramework::$_url . 'assets/img/2cl.png',
		                )
	            ),
				array(
					'id'=> PLETHORA_META_PREFIX .'wooarchive-sidebar',
					'required'=> array( PLETHORA_META_PREFIX .'wooarchive-layout','!=', 'full' ),
					'type' => 'select',
					'data' => 'sidebars',
					'multi' => false,
					'title' => __('Catalog Sidebar', 'cleanstart'), 
					'default'  => 'sidebar-woo-catalog',
				),
	        ),
	    );

		// Cannot use global $post, so we are getting the 'post' url parameter
		$postid = isset( $_GET['post'] ) && is_numeric( $_GET['post'] )  ? $_GET['post'] : 0;
		// Get page IDs for blog/shop
		$page_for_posts = class_exists('Plethora_CMS') ? Plethora_CMS::get_option('page_for_posts') : get_option('page_for_posts');
		$page_for_shop	= get_option( 'woocommerce_shop_page_id', 0 );

		// Blog Metabox. Should be displayed only if this is the static blog page
		if ( $postid === $page_for_posts ) {  

		    $metabox = array(
		        'id'            => 'page-display',
		        'title'         => __( 'Blog Layout Options', 'cleanstart' ),
		        'post_types'    => array( 'page'),
		        'position'      => 'side', // normal, advanced, side
		        'priority'      => 'high', // high, core, default, low
		        'sidebar'       => false, // enable/disable the sidebar in the normal/advanced positions
		        'sections'      => $blog_options,
		    );
	  		if ( function_exists('vc_set_default_editor_post_types') ) { vc_set_default_editor_post_types( array() ); }
		    add_action( 'admin_init', array( 'Plethora_Metabox_LayoutPage', 'hide_editor'));
		
		// Shop Metabox. Should be displayed only if this is the WooCommerce shop page
		} elseif ( class_exists('woocommerce') && $postid === $page_for_shop ) {  

		    $metabox = array(
		        'id'            => 'page-display',
		        'title'         => __( 'Layout Options', 'cleanstart' ),
		        'post_types'    => array( 'page'),
		        'position'      => 'side', // normal, advanced, side
		        'priority'      => 'high', // high, core, default, low
		        'sidebar'       => false, // enable/disable the sidebar in the normal/advanced positions
		        'sections'      => $shop_options,
		    );
	  		if ( function_exists('vc_set_default_editor_post_types') ) { vc_set_default_editor_post_types( array() ); }
		    add_action( 'admin_init', array( 'Plethora_Metabox_LayoutPage', 'hide_editor'));
		
		// Page Metabox. Should be displayed only if this is the static blog page
		} else { 

		    $metabox = array(
		        'id'            => 'page-display',
		        'title'         => __( 'Layout Options', 'cleanstart' ),
		        'post_types'    => array( 'page'),
		        'position'      => 'side', // normal, advanced, side
		        'priority'      => 'high', // high, core, default, low
		        'sidebar'       => false, // enable/disable the sidebar in the normal/advanced positions
		        'sections'      => $page_options 
		    );

		}
	    return $metabox;
	  }

	  static function hide_editor() { 

	  	remove_post_type_support('page', 'editor');
	  }

	}

endif;