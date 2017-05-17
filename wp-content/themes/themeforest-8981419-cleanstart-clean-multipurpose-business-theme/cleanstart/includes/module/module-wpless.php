<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M			      (c) 2014-2015

Description: WP Less ( Please reference to this on https://github.com/oyejorge/less.php - DO NOT USE THE OFFICIAL RELEASE )
Module Customization: /assets/wp-less/lib/vendor/lessphp/less.inc.php ( lines 125-127 - raising memory limit to 128M only on recompiling )
Version: 1.0

*/

if ( ! defined( 'ABSPATH' ) ) exit; // NO DIRECT ACCESS 

	class Plethora_Module_Wpless{

		public function __construct() {


			// Load WP-LESS, if not already loaded by other plugin

			if (!class_exists('WPLessPlugin')) {

				// Check set memory limit. If less than 128M, begin a safe memory limit raise for PHP, in order to assist LESS compiling procedure
				$this->set_memory_limit( '128M' ); // For premium performance
				$this->set_memory_limit( '96M' ); // For best performance
				$this->set_memory_limit( '80M' ); // Least demanded RAM to work 100%
				$this->set_memory_limit( '64M' ); // Again, if 80M not available try with 64, which is a risky setting

				// If xdebug is present, make sure nesting level is raised to 100
				@ini_set('xdebug.max_nesting_level', 500);

				define('WP_LESS_COMPILATION', 'deep');

				require_once THEME_ASSETS_DIR .'/wp-less/lib/Plugin.class.php';

				// The file is empty...just used for core directory reference
				$WPLessPlugin = WPPluginToolkitPlugin::create('WPLess', THEME_ASSETS_DIR .'/wp-less/bootstrap-for-theme.php', 'WPLessPlugin');
		
				if ( method_exists('Plethora', 'option') ) {

					// General > Body & Headings
					$wp_body_bg          			= Plethora::option('body-backround', '#EFEFEF', 0, false);
					$option              			= Plethora::option('font-headers', array( 'font-family'=>'Raleway' ), 0, false);
					$wp_font_alternative 			= isset( $option['font-family'] ) ? $option['font-family'] : 'Raleway' ;
					$wp_font_alternative_transform	= Plethora::option('font-headers-transform', 'uppercase', 0, false);
					$option              			= Plethora::option('font-body', array( 'font-family'=>'Open Sans' ), 0, false);
					$wp_font_sansserif   			= isset( $option['font-family'] ) ? $option['font-family'] : 'Open Sans' ;
					$wp_font_sansserif_size			= Plethora::option('font-body-size', '14', 0, false);
					$wp_text_color   				= Plethora::option('body-text-color', '#666666', 0, false);
					$wp_link_color   				= Plethora::option('body-link-color', '#428BCA', 0, false);
					$wp_font_buttons_transform		= Plethora::option('font-buttons-transform', 'uppercase', 0, false);

					// General > Skin Coloured Sections
					$wp_skin_color       			= Plethora::option('skin-color', '#428BCA', 0, false);
					$wp_skin_colored_section_text	= Plethora::option('skin-text-color', '#ffffff', 0, false);
					$wp_skin_colored_section_link 	= Plethora::option('skin-link-color', '#FFFF00', 0, false);
					// General > Dark Coloured Sections
					$wp_dark_section_bgcolor		= Plethora::option('darksection-bgcolor', '#222222', 0, false);
					$wp_dark_section_text			= Plethora::option('darksection-text-color', '#cccccc', 0, false);
					$wp_dark_section_link			= Plethora::option('darksection-link-color', '#428BCA', 0, false);
					// Header > Colors & Typography
					$wp_header_bgcolor				= Plethora::option('header-background', '#EFEFEF', 0, false);
					$wp_sticky_header_transparency	= Plethora::option('header-background-transparency', 100, 0, false);
					$option 						= Plethora::option( 'header-link-color', array('regular' => '#555555', 'hover' => '#428BCA' ), 0, false);
					$wp_header_link_color 			= isset( $option['regular'] ) ? $option['regular'] : '#555555';
					$wp_header_link_hover_color 	= isset( $option['hover'] ) ? $option['hover'] : '#428BCA';
					// Header > Top Toolbar
					$wp_topbar_bgcolor 				= Plethora::option( PLETHORA_META_PREFIX .'header-toolbar-bgcolor', '#EFEFEF', 0, false);
					$wp_topbar_text_color 			= Plethora::option( PLETHORA_META_PREFIX .'header-toolbar-text-color', '#555555', 0, false);
					$wp_topbar_link_color			= Plethora::option( PLETHORA_META_PREFIX .'header-toolbar-link-color', '#555555', 0, false);
					// Footer > Main Section
					$wp_footer_bgcolor				= Plethora::option( PLETHORA_META_PREFIX .'footer-bgcolor', '#222222', 0, false);
					$wp_footer_text_color 			= Plethora::option( PLETHORA_META_PREFIX .'footer-text-color', '#cccccc', 0, false);
					$wp_footer_link_color 			= Plethora::option( PLETHORA_META_PREFIX .'footer-link-color', '#428BCA', 0, false);
					// Head Panel > General
					$option              			= Plethora::option( PLETHORA_META_PREFIX .'header-slider-dimensions', array('height' => '580px', 'units' => 'px' ), 0, false);
					$wp_slider_height    			= isset( $option['height'] ) ? $option['height'] : '580px' ;
					// General > Miscellaneous
					$text_shadows        			= Plethora::option( 'text-shadows', 0, 0, false);

				} else { 

					$wp_body_bg          			= '#EFEFEF';
					$wp_font_alternative 			= 'Raleway';
					$wp_font_alternative_transform	= 'uppercase';
					$wp_font_sansserif   			= 'Open Sans';
					$wp_font_sansserif_size			= '14px';
					$wp_text_color 					= '#666666';
					$wp_link_color 					= '#428BCA';
					$wp_skin_color       			= '#428BCA';
					$wp_font_buttons_transform		= 'uppercase';
					$wp_skin_colored_section_text 	= '#ffffff';
					$wp_skin_colored_section_link 	= '#FFFF00';
					$wp_dark_section_bgcolor		= '#222222';
					$wp_dark_section_text			= '#cccccc';
					$wp_dark_section_link			= '#428BCA';
					$wp_header_bgcolor				= '#EFEFEF';
					$wp_sticky_header_transparency	= 100;
					$wp_header_link_color 			= '#555555';
					$wp_header_link_hover_color 	= '#428BCA';
					$wp_topbar_bgcolor 				= '#EFEFEF';
					$wp_topbar_text_color 			= '#555555';
					$wp_topbar_link_color			= '#555555';
					$wp_footer_bgcolor				= '#222222';
					$wp_footer_text_color 			= '#cccccc';
					$wp_footer_link_color 			= '#428BCA';
					$wp_slider_height    			= '580px';
					$text_shadows 		 			= 0;

				}

				// die(gettype($text_shadows)); // 0 string

				$text_shadows = ( $text_shadows == 0 ) ? "none" : "0 1px 2px rgba(0, 0, 0, 0.6)";

			    $WPLessPlugin->setVariables(array(
					'wp-body-bg'                 	=> $wp_body_bg, 					// '#EFEFEF',
					'wp-font-family-alternative' 	=> '"'. $wp_font_alternative .'"', // 'Raleway'
					'wp-font-family-sans-serif'  	=> '"'. $wp_font_sansserif .'"', 	// 'Open Sans'
					'wp-text-color'					=> $wp_text_color,
					'wp-link-color'					=> $wp_link_color,
					'wp-skin-color'              	=> $wp_skin_color, 				// '#A59C78',
					'wp-skin-colored-section-text'	=> $wp_skin_colored_section_text,
					'wp-skin-colored-section-link'	=> $wp_skin_colored_section_link,
					'wp-dark-section-bgcolor'		=> $wp_dark_section_bgcolor,
					'wp-dark-section-text'			=> $wp_dark_section_text,
					'wp-dark-section-link'			=> $wp_dark_section_link,
					'wp-header-bgcolor'				=> $wp_header_bgcolor,
					'wp-sticky-header-transparency'	=> $wp_sticky_header_transparency,
					'wp-header-link-color'			=> $wp_header_link_color,
					'wp-header-link-hover-color'	=> $wp_header_link_hover_color,
					'wp-topbar-bgcolor'				=> $wp_topbar_bgcolor,
					'wp-topbar-text-color'			=> $wp_topbar_text_color,
					'wp-topbar-link-color'			=> $wp_topbar_link_color,
					'wp-footer-bgcolor'				=> $wp_footer_bgcolor,
					'wp-footer-text-color'			=> $wp_footer_text_color,
					'wp-footer-link-color'			=> $wp_footer_link_color,
					'wp-slider-height'           	=> $wp_slider_height, 				// '580px'
					'wp-text-shadows' 				=> $text_shadows,				
					'wp-font-size-base'				=> $wp_font_sansserif_size . 'px',	// Don't forget the px!!!			
					'wp-cs-headings-text-transform'	=> $wp_font_alternative_transform,				
					'wp-btn-text-transform'			=> $wp_font_buttons_transform,				
			    ));

				add_action('init', array($this, 'enqueue_less'), 1);

				// READY and WORKING
				add_action('after_setup_theme', array($WPLessPlugin, 'install'));

				// NOT WORKING
				//@see http://core.trac.wordpress.org/ticket/14955
				add_action('uninstall_theme', array($WPLessPlugin, 'uninstall'));

				$WPLessPlugin->dispatch();
			}

		}

       /** 
       * Enqueues less files
       *
       * @return array
       * @since 1.0
       *
       */
		function enqueue_less() {

			if ( !is_admin() ) { 

	            // Should load custom bootstrap stylesheet first
	            wp_register_style( 'bootstrap-cleanstart',  THEME_ASSETS_URI . '/css/cleanstart_custom_bootstrap.css'); 
	            wp_enqueue_style(  'bootstrap-cleanstart');

			    wp_enqueue_style('style-less', get_template_directory_uri().'/assets/less/style.less');

			}
		}	


	   public static function set_memory_limit( $memory_limit ) { 

			$current_memory_limit = @ini_get('memory_limit');

			// Check if SET limit is in MB or KB and adjust the number to MBs
			if (preg_match('/^(\d+)(.)$/', $current_memory_limit, $matches)) {
			    if ($matches[2] == 'M') {
			        $current_memory_limit = $matches[1]; // nnnM -> nnn MB
			    } else if ($matches[2] == 'K') {
			        $current_memory_limit = $matches[1] / 1024; // nnnK -> nnn KB
			    }
			}
			// Check if GIVEN limit is in MB or KB and adjust the number to MBs
			$given_memory_limit = $memory_limit;
			if (preg_match('/^(\d+)(.)$/', $given_memory_limit, $matches)) {
			    if ($matches[2] == 'M') {
			        $given_memory_limit = $matches[1]; // nnnM -> nnn MB
			    } else if ($matches[2] == 'K') {
			        $given_memory_limit = $matches[1] / 1024; // nnnK -> nnn KB
			    }
			}

			if ( $current_memory_limit < $given_memory_limit ) { @ini_set('memory_limit', $memory_limit ); } 
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
				'switchable'       => false,
				'options_title'    => 'WP Less Module',
				'options_subtitle' => 'Activate/deactivate WP Less module',
				'options_desc'     => 'On deactivation, all settings related to this feature will be removed. However, they will not be deleted permanently.',
            );
          
          return $feature_options;
       }
	}