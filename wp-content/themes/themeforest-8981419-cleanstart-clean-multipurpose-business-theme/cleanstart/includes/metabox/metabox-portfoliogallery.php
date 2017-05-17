<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M                    (c) 2014

File Description: Post Options Metabox ( Post Format: Image )

*/

if ( ! defined( 'ABSPATH' ) ) exit; // NO DIRECT ACCESS 

if ( class_exists('Plethora_Metabox') && !class_exists('Plethora_Metabox_Portfoliogallery') ): 

	/**
	 * @package Plethora Framework
	 */

	class Plethora_Metabox_Portfoliogallery {

		public static function metabox(){

	    $sections = array();

	    $sections[] = array(
	        'title'         => '',
	        'icon_class'    => 'icon-large',
	        'icon'          => 'el-icon-website',
	        'fields'        => array(

				array(
					'id'=> PLETHORA_META_PREFIX .'portfolio-media',
					'type' => 'button_set',
					'title' => __('Media format', 'cleanstart'),
					'options' => array( 'gallery' => 'Gallery', 'featured_image' => 'Featured Image' ),
					'default' => 'gallery',
					),

				array(
					'id'=> PLETHORA_META_PREFIX .'portfolio-slides',
					'type' => 'slides',
					'required' => array( PLETHORA_META_PREFIX .'portfolio-media','=', array('gallery')),
					'description' => false,
					'url' => false,
					'title' => __('Gallery', 'cleanstart'),
					'desc'=> __('Add as many images as you need for the presentation.', 'cleanstart') .'<br/><span style="color:red">'. __('Description and URL fields will not be displayed on the frontend', 'cleanstart') .'</span>',
					'placeholder' => array( 
							'title' => __('This title will be displayed on image gallery.', 'cleanstart'),
							'description' => __('This will not be used on the front end!', 'cleanstart'),
							'url' => __('This will not be used on the front end!', 'cleanstart'),
						)
				),
	        )
	    );




	    $metabox = array(
	        'id'            => 'formatdiv-image2',
	        'title'         => __( 'Featured Gallery', 'cleanstart' ),
	        'post_types'    => array( 'portfolio'),
	        'position'      => 'side', // normal, advanced, side
	        'priority'      => 'default', // high, core, default, low
	        'sections'      => $sections,
	    );



	    return $metabox;
	  }

       /** 
       * Returns feature information for several uses by Plethora Core (theme options etc.)
       *
       * @return array
       * @since 1.0
       *
       */
       public static function get_feature_options() {

          $feature_options = array ( 
              'switchable' => true,
              'options_title' => 'Metabox // Post Options ( Post Format: Gallery )',
              'options_subtitle' => 'Activate/deactivate post metabox fields',
              'options_desc' => 'On deactivation, this metabox will not be available. CAREFULL, you should know what you are doing here!',
              'version' => '1.0',
            );
          
          return $feature_options;
       }


	}

endif;