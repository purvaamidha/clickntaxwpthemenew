<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M 				   (c) 2014

Description: Plethora Starter Theme
Version: 1.0

*/

if ( ! defined( 'ABSPATH' ) ) exit; // NO DIRECT ACCESS 

if ( !class_exists('Plethora_Dashboard') ) {

	class Plethora_Dashboard {

	    // Widget ID
	    public $widget_id; 

	    // Dashboard widget name
	    public $widget_name;

	    // Dashboard widget related script files
	    public $dashboard_scripts;
	 
	    // Dashboard widget style files
	    public $dashboard_styles;

	    // Dynamic scripts switch value. It is checked inside callback(). If set to true, it triggers script printing in footer
	    public $add_script;

        /** 
        * Add shortcode action
        *
        */
        public function add( $widget_id, $widget_name) {

        	$this->widget_id	= $widget_id;
        	$this->widget_name	= $widget_name;
        	Plethora_CMS::add_action('wp_dashboard_setup', array( $this, 'action' ) );

        }

        /** 
        * Add shortcode action
        *
        */
        public function action() {

        	$widget_id			= $this->widget_id;
        	$widget_name		= $this->widget_name;
        	$control_callback	= method_exists($this, 'control_callback') ? array( $this, 'control_callback' ) : null;
        	$callback_args 		= method_exists($this, 'callback_args') ? array( $this, 'callback_args' ) : null;

        	Plethora_CMS::wp_add_dashboard_widget( $widget_id, $widget_name, array( $this, 'callback'), $control_callback, $callback_args );

		 	global $wp_meta_boxes;
		 	
		 	// Get the regular dashboard widgets array 
		 	// (which has our new widget already but at the end)
		 
		 	$normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];
		 	
		 	// Backup and delete our new dashboard widget from the end of the array
		 
		 	$widget_backup = array( $widget_id => $normal_dashboard[$widget_id] );
		 	unset( $normal_dashboard[$widget_id] );
		 
		 	// Merge the two arrays together so our widget is at the beginning
		 
		 	$sorted_dashboard = array_merge( $widget_backup, $normal_dashboard );
		 
		 	// Save the sorted array back into the original metaboxes 
		 	$wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;

        }
 
         /** 
        * It contains the dashboard widget's content. Should be overriden on extending classes
        *
        */
        public function callback() {

        	echo "This is the default dashboard content! You can override this content using the <strong>content</strong> method of your dashboard class";

        }

		/**
		* Dashboard widget script actions
		*
		*/
		public function add_script( $scripts ) {

			// Assign $scripts to shortocode_scripts variable
			$this->dashboard_scripts = $scripts; 
			
			// Add script registration hooks
			Plethora_CMS::add_action( 'init', array( $this, 'register_script' ));
		}		

		/**
		 * Dashboard widget script registrations
		 *
		 */
		public function register_script() {

			// Get scripts parameters
			$scripts = $this->dashboard_scripts;

			if (is_array($scripts)) { 

				foreach ($scripts as $script) { 

					// Make sure that required parameters are ok
					if (( isset($script['handle']) && !empty($script['handle'] ))) { 

						if ( isset($script['src']) && !empty($script['src'] ) ){

							// Fixing parameters for wp_register_script ( https://codex.wordpress.org/Function_Reference/wp_register_script )
							$handle 	= $script['handle']; 
							$src 		= $script['src']; 
							$deps 		= ( !isset( $script['deps'] ) || !is_array( $script['deps'] )) ? array() : $script['deps'];
							$ver 		= ( !isset( $script['ver'] ) || !is_string( $script['ver'] )) ? false : $script['ver'] ;
							$in_footer 	= ( !isset( $script['in_footer'] ) || !is_bool( $script['in_footer'] )) ? false : $script['in_footer'] ;

							//Register script
			        		Plethora_CMS::wp_register_script( $handle, $src, $deps, $ver, $in_footer );
			        		Plethora_CMS::wp_enqueue_script( $handle );

						} elseif ( isset( $script['type'] ) && $script['type'] === 'localized_script' ){

							$handle   = $script['handle']; 
							$variable = $script['variable']; 
							$data     = ( !isset( $script['data'] ) || !is_array( $script['data'] )) ? array() : $script['data'];

							//Localize script
							Plethora_CMS::wp_localize_script( $handle, $variable, $data );        

						} 


		        	}
		        }
			}
		}

	   /**
        * Dashboard widget style action
	    *
	    * @since 1.0
	    *
	    */

       public function add_style( $style ) {

			// assign $scripts to shortocode_style variable
			$this->dashboard_styles = $style; 
			
			// Add style registration hooks
			Plethora_CMS::add_action( 'init', array( $this, 'register_style' ));
       }		


	   /**
	    * Dashboard widget styles registration
	    *
	    * @since 1.0
	    *
	    */
       public function register_style() {

			$styles = $this->dashboard_styles;

			if (is_array($styles)) { 

				foreach ($styles as $style) { 

					if (( isset($style['handle']) && !empty($style['handle'] )) && (isset($style['src']) && !empty($style['src'] ))) { 

						// Fixing parameters for wp_register_style ( http://codex.wordpress.org/Function_Reference/wp_register_style )
						$handle = $style['handle']; 
						$src	= $style['src']; 
						$deps	= ( !isset( $style['deps'] ) || !is_array( $style['deps'] )) ? array() : $style['deps'];
						$ver	= ( !isset( $style['ver'] ) || !is_string( $style['ver'] )) ? false : $style['ver'] ;
						$media 	= ( !isset( $style['media'] ) || !is_string( $style['media'] )) ? 'all' : $style['media'] ;

						// Register style
		        		Plethora_CMS::wp_register_style ( $handle, $src, $deps, $ver, $media );

						// Enqueue style
		         		Plethora_CMS::wp_enqueue_style  ( $handle );
		        	}
		        }
			}
       }


	}

}