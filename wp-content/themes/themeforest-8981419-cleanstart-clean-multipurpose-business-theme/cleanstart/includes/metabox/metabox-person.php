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

if ( class_exists('Plethora_Metabox') && !class_exists('Plethora_Metabox_Person')): 

	/**
	 * @package Plethora Base
	 */

	class Plethora_Metabox_Person {

		public static function metabox(){

		    $sections = array();

	    	$sections[] = array(
		        'title' => __('Personal info', 'cleanstart'),
				'icon_class'    => 'icon-large',
		        'icon' => 'el-icon-info-sign',
				'fields'        => array(

				// ok!
				array(
					'id'=> PLETHORA_META_PREFIX .'person-job',
					'type' => 'text',
					'title' => __('Job position', 'cleanstart'),
					'subtitle' => __('Give a short job description', 'cleanstart'),
					'validate' => 'no_special_chars',
					'default' => ''
					),

				array(
					'id'=> PLETHORA_META_PREFIX .'person-notes',
					'type' => 'textarea',
					'title' => __('About note', 'cleanstart'), 
					'subtitle' => __('A few words about this person', 'cleanstart'),
					'desc' => __('HTML can be used', 'cleanstart'),
					'validate' => 'html',
					),

				array(
					'id'=> PLETHORA_META_PREFIX .'person-photo',
					'type' => 'media', 
					'url'	=> true,
					'title' => __('Main photo', 'cleanstart'),
					'subtitle' => __('Upload a photo of this person', 'cleanstart'),
					),

				array(
					'id'=> PLETHORA_META_PREFIX .'person-photohover',
					'type' => 'media', 
					'url'	=> true,
					'title' => __('Hover photo', 'cleanstart'),
					'subtitle' => __('Upload an alternative photo for the image hover effect.', 'cleanstart'),
					),


				),

	        );

		    $sections[] = array(
		        'title'         => __('Contact & Social', 'cleanstart'),
		        'icon_class'    => 'icon-large',
		        'icon'          => 'el-icon-group',
		        'fields'        => array(
					// ok!
					array(
						'id'=> PLETHORA_META_PREFIX .'person-email',
						'type' => 'text',
						'title' => ''. __('E-mail', 'cleanstart'),
						'subtitle' => __('Enter a mail account or leave empty', 'cleanstart'),
						'default' => ''
						),

					// ok!
					array(
						'id'=> PLETHORA_META_PREFIX .'person-skype',
						'type' => 'text',
						'title' => __('Skype', 'cleanstart'),
						'subtitle' => __('Enter Skype name or leave empty', 'cleanstart'),
						'default' => ''
						),

					// ok!
					array(
						'id'=> PLETHORA_META_PREFIX .'person-facebook',
						'type' => 'text',
						'title' => ''. __('Facebook', 'cleanstart'),
						'subtitle' => __('Enter profile link or leave empty', 'cleanstart'),
						'default' => ''
						),

					// ok!
					array(
						'id'=> PLETHORA_META_PREFIX .'person-twitter',
						'type' => 'text',
						'title' => __('Twitter', 'cleanstart'),
						'subtitle' => __('Enter profile link or leave empty', 'cleanstart'),
						'default' => ''
						),

					// ok!
					array(
						'id'=> PLETHORA_META_PREFIX .'person-googleplus',
						'type' => 'text',
						'title' => __('Google+', 'cleanstart'),
						'subtitle' => __('Enter profile link or leave empty', 'cleanstart'),
						'default' => ''
						),

					// ok!
					array(
						'id'=> PLETHORA_META_PREFIX .'person-linkedin',
						'type' => 'text',
						'title' => __('LinkedIn', 'cleanstart'),
						'subtitle' => __('Enter profile link or leave empty', 'cleanstart'),
						'default' => ''
						),

					// ok!
					array(
						'id'=> PLETHORA_META_PREFIX .'person-youtube',
						'type' => 'text',
						'title' => __('YouTube', 'cleanstart'),
						'subtitle' => __('Enter profile link or leave empty', 'cleanstart'),
						'default' => ''
						),

					// ok!
					array(
						'id'=> PLETHORA_META_PREFIX .'person-vimeo',
						'type' => 'text',
						'title' => __('Vimeo', 'cleanstart'),
						'subtitle' => __('Enter profile link or leave empty', 'cleanstart'),
						'default' => ''
						),


					// ok!
					array(
						'id'=> PLETHORA_META_PREFIX .'person-pinterest',
						'type' => 'text',
						'title' => __('Pinterest', 'cleanstart'),
						'subtitle' => __('Enter profile link or leave empty', 'cleanstart'),
						'default' => ''
						),

					// ok!
					array(
						'id'=> PLETHORA_META_PREFIX .'person-tumblr',
						'type' => 'text',
						'title' => __('Tumblr', 'cleanstart'),
						'subtitle' => __('Enter profile link or leave empty', 'cleanstart'),
						'default' => ''
						),

					// ok!
					array(
						'id'=> PLETHORA_META_PREFIX .'person-flickr',
						'type' => 'text',
						'title' => __('Flickr', 'cleanstart'),
						'subtitle' => __('Enter profile link or leave empty', 'cleanstart'),
						'default' => ''
						),

					// ok!
					array(
						'id'=> PLETHORA_META_PREFIX .'person-dribble',
						'type' => 'text',
						'title' => __('Dribble', 'cleanstart'),
						'subtitle' => __('Enter profile link or leave empty', 'cleanstart'),
						'default' => ''
						),

					// ok!
					array(
						'id'=> PLETHORA_META_PREFIX .'person-instagram',
						'type' => 'text',
						'title' => __('Instagram', 'cleanstart'),
						'subtitle' => __('Enter profile link or leave empty', 'cleanstart'),
						'default' => ''
						),

		        )
		    );



		    $metabox = array(
		        'id'            => 'metabox-person',
		        'title'         => __( 'Person Options', 'cleanstart' ),
		        'post_types'    => array( 'person'),
		        'position'      => 'normal', // normal, advanced, side
		        'priority'      => 'high', // high, core, default, low
		        // 'sidebar'       => false, // enable/disable the sidebar in the normal/advanced positions
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
              'options_title' => 'Metabox // Person Options',
              'options_subtitle' => 'Activate/deactivate person options metabox fields',
              'options_desc' => 'On deactivation, this metabox will not be available. CAREFULL, you should know what you are doing here!',
              'version' => '1.0',
            );
          
          return $feature_options;
       }

	}

endif;