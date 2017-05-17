<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M 				   (c) 2014

Description: Metabox controller class ( requires Redux Metaboxes extension )
Version: 1.0

*/

if ( ! defined( 'ABSPATH' ) ) exit; // NO DIRECT ACCESS 

if ( !class_exists('Plethora_Metabox')  ) {

	class Plethora_Metabox {

		public $metaboxes = array();

		// Load RFM extension, along with parent & child theme metabox classes
		function init() {

			  if ( class_exists( 'ReduxFramework' )) {

			  	// Load the Redux Framework Metaboxes extension
				Plethora_CMS::add_action("redux/extensions/". THEME_OPTVAR ."/before", array( $this, 'redux_metaboxes_class_loader'), 0);
			  
				// Load child theme metabox classes first
				$this->child_metaboxes_loader();
				
				// Load parent theme metabox classes 
				$this->parent_metaboxes_loader();

				// Add action for Redux 
				Plethora_CMS::add_action('redux/metaboxes/'.THEME_OPTVAR.'/boxes', array( $this, 'add_theme_metaboxes' ));
			  }
		}


		function redux_metaboxes_class_loader( $ReduxFramework ) {
			$path = THEME_CORE_LIBS_DIR . '/ReduxFramework/extensions/metaboxes';
			if( !class_exists( 'ReduxFramework_extension_metaboxes' ) ) {
					
				$class_file = $path . '/extension_metaboxes.php';
				$class_file = Plethora_CMS::apply_filters( 'redux/extension/'.$ReduxFramework->args['opt_name'].'/metaboxes', $class_file );
				if( $class_file ) {
					require_once( $class_file );
					$extension = new ReduxFramework_extension_metaboxes( $ReduxFramework );
				}
			}
		}

		function parent_metaboxes_loader() {
			$path = THEME_INCLUDES_DIR . '/metabox/';
			$mb_files = Plethora_Data::class_files( $path, 'metabox' );		   
			foreach($mb_files as $mb_file) {
	            // fix metabox slug
	            $mb_slug = str_replace( 'metabox-', '', $mb_file );
	            $mb_slug = str_replace( '.php', '', $mb_slug );
	            // fix metabox class name
				$metabox_class = 'Plethora_Metabox_' . ucfirst( $mb_slug );

				$metaboxes = $this->metaboxes;
				if( !class_exists( $metabox_class ) ) {
					$class_file = $path . '/'. $mb_file .'';
					require_once( $class_file );
					if ( class_exists( $metabox_class ) && method_exists($metabox_class, 'metabox')) { 

						// $metaboxes[] = $metabox_class::metabox(); // TICKET: 560
						$metaboxes[] = call_user_func($metabox_class."::metabox"); // PHP 5.2.x COMPATIBILITY
					}
				}
				$this->metaboxes = $metaboxes;
			}
		}

		function child_metaboxes_loader() {

			// Scan child theme metaboxes ( the official way )			
			$path = CHILD_INCLUDES_DIR . '/metabox/';

			if ( file_exists($path)) { 
				$mb_files = Plethora_Data::class_files( $path, 'metabox' );		   
				foreach($mb_files as $mb_file) {
		            // fix metabox slug
		            $mb_slug = str_replace( 'metabox-', '', $mb_file );
		            $mb_slug = str_replace( '.php', '', $mb_slug );
		            // fix metabox class name
					$metabox_class = 'Plethora_Metabox_' . ucfirst( $mb_slug );

					$metaboxes = $this->metaboxes;
					if( !class_exists( $metabox_class ) ) {
						$class_file = $path . '/'. $mb_file .'';
						require_once( $class_file );
						if ( class_exists( $metabox_class ) && method_exists($metabox_class, 'metabox')) { 

							// $metaboxes[] = $metabox_class::metabox(); // TICKET: 560
							$metaboxes[] = call_user_func($metabox_class."::metabox"); // PHP 5.2.x COMPATIBILITY
						}
					}
					$this->metaboxes = $metaboxes;
				}
			}
		}				

		function add_theme_metaboxes( $metaboxes ) {

			// just in case!
			$metaboxes = $this->metaboxes;
			return $metaboxes;

		}

	    /**
	     * Returns class index data
	     * 
	     * @return array
	     * 
	     */
	    public function get_class_data() {

	        $class_data = array ( 
	                'type'   => 'global',
	                'status' => 'activated',
	                'descr'  => 'Metabox controller class ( requires Redux Metaboxes extension )',
	            );
	        return $class_data;
	    }

	}
	// Create the Plethora_Metabox object
	$Theme_Metaboxes = new Plethora_Metabox;
	$Theme_Metaboxes->init();

}