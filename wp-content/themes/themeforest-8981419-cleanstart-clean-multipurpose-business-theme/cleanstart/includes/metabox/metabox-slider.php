<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M                    (c) 2014

File Description: Metabox class for slider CPT

*/

if ( ! defined( 'ABSPATH' ) ) exit; // NO DIRECT ACCESS 

if ( class_exists('Plethora_Metabox') && !class_exists('Plethora_Metabox_Slider') ): 

	/**
	 * @package Plethora Framework
	 */

	class Plethora_Metabox_Slider {

		public static function metabox(){

	    $sections = array();
	    $sections[] = array(
	        'title'         => __('Slides', 'cleanstart'),
	        'icon_class'    => 'icon-large',
	        'icon'          => 'el-icon-photo',
	        'fields'        => array(
				array(
					'id'          => PLETHORA_META_PREFIX .'slider-slides',
					'type'        => 'slides',
					'title'       => __('Slides Options', 'cleanstart'),
					'subtitle'    => __('Add as many slides as you need', 'cleanstart'),
					'placeholder' => array('url' => __('Not enabled yet, leave this empty', 'cleanstart'),)
				)
	        )
	    );

    	$sections[] = array(
			'title'      => __('Settings', 'cleanstart'),
			'icon_class' => 'icon-large',
			'icon'       => 'el-icon-wrench-alt',
			'fields'     => array(
				array(
					'id'    => PLETHORA_META_PREFIX .'slider-slideshow',
					'type'  => 'switch', 
					'title' => __('Auto Slideshow', 'cleanstart'),
					'on'    => 'Yes',
					'off'   => 'No',
					),	

				/*** ADDING SLIDER ANIMATION TYPE [v1.3] ***/

				array(
					'id'      => PLETHORA_META_PREFIX .'slider-animationtype',
					'type'    => 'button_set',
					'title'   => __('Animation Type', 'cleanstart'),
					"default" => 'slide',
					'options' => array(
							'slide' => __('Slide', 'cleanstart'),
							'fade'  => __('Fade', 'cleanstart'),
							),
					),	

				array(
					'id'      => PLETHORA_META_PREFIX .'slider-direction',
					'type'    => 'button_set',
					'required'=> array( PLETHORA_META_PREFIX .'slider-animationtype','=', array('slide')),						
					'title'   => __('Slideshow Direction', 'cleanstart'),
					'options' => array(
							'horizontal' => 'Horizontal',
							'vertical'   => 'Vertical',
							),
					),	
				array(
					'id'    => PLETHORA_META_PREFIX .'slider-animationloop',
					'type'  => 'switch', 
					'title' => __('Slideshow Loop', 'cleanstart'),
					'on'    => 'Yes',
					'off'   => 'No',
					),
				array(
					'id'    => PLETHORA_META_PREFIX .'slider-slideshowspeed',
					'type'  => 'spinner', 
					'title' => __('Slideshow Speed', 'cleanstart'),
					'desc'  => __('Set the speed of the slideshow cycling, in seconds', 'cleanstart'),
					"min"   => 1,
					"step"  => 1,
					"max"   => 60,
					),	
				array(
					'id'    => PLETHORA_META_PREFIX .'slider-animationspeed',
					'type'  => 'spinner', 
					'title' => __('Animation Speed', 'cleanstart'),
					'desc'  => __('Set the speed of the animations, in MILLIseconds', 'cleanstart'),
					"min"   => 100,
					"step"  => 100,
					"max"   => 3000,
					),	
				array(
					'id'    => PLETHORA_META_PREFIX .'slider-showarrows',
					'type'  => 'switch', 
					'title' => __('Show navigation arrows', 'cleanstart'),
					'on'    => 'Yes',
					'off'   => 'No',
					),
				array(
					'id'    => PLETHORA_META_PREFIX .'slider-showbullets',
					'type'  => 'switch', 
					'title' => __('Show navigation bullets', 'cleanstart'),
					'on'    => 'Yes',
					'off'   => 'No',
					),
				array(
					'id'    => PLETHORA_META_PREFIX .'slider-randomize',
					'type'  => 'switch', 
					'title' => __('Randomize', 'cleanstart'),
					'desc'  => __('Random slide order everytime the slider starts', 'cleanstart'),
					'on'    => 'Yes',
					'off'   => 'No',
					),
				array(
					'id'=> PLETHORA_META_PREFIX .'slider-pauseonaction',
					'type' => 'switch', 
					'title' => __('Pause On Action', 'cleanstart'),
					'desc'=> __('Pause the slideshow when interacting with control elements, highly recommended', 'cleanstart'),
					'on' => 'Yes',
					'off' => 'No',
					),
				array(
					'id'    => PLETHORA_META_PREFIX .'slider-pauseonhover',
					'type'  => 'switch', 
					'title' => __('Pause On Hover', 'cleanstart'),
					'desc'  => __('Pause the slideshow when hovering over slider, then resume when no longer hovering', 'cleanstart'),
					'on'    => 'Yes',
					'off'   => 'No',
					),
				array(
					'id'       => PLETHORA_META_PREFIX .'slider-urltarget',
					'type'     => 'button_set', 
					'title'    => __('Linked Slides Behavior', 'cleanstart'),
					'subtitle' => __('Set browser window behavior for linked slides', 'cleanstart'),
					'options'  => array(
							'_self' => __('Open in same window', 'cleanstart'),
							'_blank'    => __('Open in new window', 'cleanstart'),
							),
					),	

			)
        );

	    $metabox = array(
	        'id'            => 'metabox-slider',
	        'title'         => __( 'Slider Options', 'cleanstart' ),
	        'post_types'    => array( 'slider'),
	        'position'      => 'normal', // normal, advanced, side
	        'priority'      => 'high', // high, core, default, low
	        'sidebar'       => false, // enable/disable the sidebar in the normal/advanced positions
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
				'switchable'       => true,
				'options_title'    => 'Metabox // Slider Options',
				'options_subtitle' => 'Activate/deactivate slider metabox fields',
				'options_desc'     => 'On deactivation, this metabox will not be available. CAREFULL, you should know what you are doing here!',
				'version'          => '1.0',
            );
          
          return $feature_options;
       }


	}

endif;