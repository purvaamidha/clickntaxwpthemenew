<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M 				   (c) 2014

File Description: Controller class for shortcodes

*/

if ( ! defined( 'ABSPATH' ) ) exit; // NO DIRECT ACCESS 


if ( !class_exists('Plethora_Shortcode')) {
 
	/**
	 * @package Plethora Base
	 */

	class Plethora_Shortcode {

	    // Shortcode class
	    public $shortcode_slug; 

	    // Shortcode content function name
	    public $shortcode_content;

	    // Shortcode related script files
	    public $shortcode_scripts;
	 
	    // Shortcode localized script files
	    public $shortcode_localized_scripts;

	    // Shortcode related style files
	    public $shortcode_styles;

	    // Dynamic scripts switch value. It is checked inside HTML output. If set to true, it triggers script printing in footer
	    public $add_script;

   	  	
        /** 
        * Initializes Shortcode controller customization
        *
        * @since 1.0
        *
        */
   	  	public function init() {

		////// VISUAL COMPOSER CUSTOMIZATION

			// set VC to behave as installed on theme
			if( function_exists('vc_set_as_theme') ) {

			    vc_set_as_theme( true );
			
			}
			// disable frontend editor
			if( function_exists( 'vc_disable_frontend' ) ) {

			    vc_disable_frontend( true );

			}

			if( function_exists( 'vc_map' ) ) {

			    Plethora_CMS::add_action( 'admin_print_scripts-post.php', array( 'Plethora_Shortcode', 'custom_vc_enqueues' ));
			    Plethora_CMS::add_action( 'admin_print_scripts-post-new.php', array( 'Plethora_Shortcode', 'custom_vc_enqueues' ));

			}

			// remove VC default templates
			if ( function_exists( 'vc_remove_element' )) {

			    Plethora_CMS::add_filter( 'vc_load_default_templates', array( 'Plethora_Shortcode', 'remove_default_templates' ));
			    
			}

			// add custom VC fields
   	  		if ( is_admin() ) { 

				// Add the post dropdown field function, via add_shortcode_param
			    $this->add_shortcode_param( 'dropdown_posts', array( 'Plethora_Shortcode', 'vc_field_select_posts'), '');

				// Add the icon dropdown field function, via add_shortcode_param
			    $this->add_shortcode_param('iconpicker', array( 'Plethora_Shortcode', 'vc_field_select_icons' ), THEME_CORE_ASSETS_URI . '/vcfields/iconpicker/icon-picker.js' );


			}

			// Regenarate shortcode parameters option (important!)
   	  		if ( is_admin() ) { 

				// Get saved parameters
        		$update = Plethora_CMS::update_option(PLETHORA_PREFIX .'_shortcode_params', array());
			}	
			
  		}

        /** 
        * Add shortcode action
        *
        * @since 1.0
        *
        */
        public function add( $map, $vc_options = array() ) {

        	// PREPARE SETTINGS VARIABLES FOR FILTERING
			$tag = !empty( $map['base'] ) ? $map['base'] : strtolower( get_called_class() ) ;   // If no slug name given, shortcode slug will be the shortcode class name
			$this->shortcode_slug   = $tag;   		// SET SHORTCODE SLUG
			$this->shortcode_map    = $map;			// SET PARAMS
			$this->shortcode_extras = $vc_options;	// VC EXTRAS

            // Add the shortcode. content() must prepare attributes/content and return an output OR a template part file
            if ( ! shortcode_exists( $tag ) ) {

            	add_shortcode( $tag, array( $this, 'content' ) );
            }
			// VC panel options mapping
   	  		if ( is_admin() ) { 

	            // Map shortcode options on 'init'...this will allow filter application
	        	add_action( 'init', array( $this, 'map_vcpanel'), 50 );
        	}
        }

	    /**
        * Mapping shortcode parameters for Visual Composer Panel
	     *
	     * @since 1.0
	     *
	     */
        public function map_vcpanel() {

        	$map = $this->shortcode_map;
			if ( !isset($map) || empty($map) || !is_array($map) ) { return; }
        	// Filter hook to override shortcode parameters
			$filter_name     = strtolower( get_called_class() ) .'_map';		// Set the class name variable as a hook prefix
			$shortcode_vcmap = apply_filters( $filter_name, $map );				// Filter mapping using a hook name pattern ( ie. 'plethora_shortcode_button_map' will filter Button shortcode mapping )
	        $this->vc_map( $shortcode_vcmap, $this->shortcode_extras );
		}


        /** 
        * Mapping shortcode parameters for shortcode panel ( TinyMCE ). ( DEPRECATED )
        *
        * @since 1.0 
        * 
        */
		public function map_panel( $params ) {
		
		}

	    /**
         * Shortcode script actions
	     *
	     * @since 1.0
	     *
	     */

       public function add_script( $scripts ) {

			// Assign $scripts to shortocode_scripts variable
			$this->shortcode_scripts = $scripts; 
			
			// Add script registration hooks
			Plethora_CMS::add_action( 'init', array( $this, 'register_script' ));
            Plethora_CMS::add_action( 'wp_footer', array( $this, 'print_script'));
       }		

	    /**
         * Shortcode script registrations
	     *
	     * @since 1.0
	     *
	     */

       public function register_script() {

			// Get scripts parameters
			$scripts = $this->shortcode_scripts;

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
         * Shortcode scripts dynamic output. Scripts are printed only when the shortcode is active
	     *
	     * @since 1.0
	     *
	     */

       public function print_script() {

			// Get scripts parameters
			$scripts = $this->shortcode_scripts;

			if (is_array($scripts)) { 

				foreach ($scripts as $script) { 

					// Make sure that required parameters are ok
					if (( isset($script['handle']) && !empty($script['handle'] )) && ($this->add_script )) { 

						// Fixing parameters for wp_print_scripts ( https://codex.wordpress.org/Plugin_API/Action_Reference/wp_print_scripts )
						$handle 	= $script['handle']; 

						//Register script
		        		Plethora_CMS::wp_print_scripts( $handle );
		        	}
		        }
        	}
       }


	    /**
         * Shortcode style action
	     *
	     * @since 1.0
	     *
	     */

       public function add_style( $style ) {

			// assign $scripts to shortocode_style variable
			$this->shortcode_styles = $style; 
			
			// Add style registration hooks
			Plethora_CMS::add_action( 'init', array( $this, 'register_style' ));
       }		


	    /**
         * Shortcode styles registration
	     *
	     * @since 1.0
	     *
	     */

       public function register_style() {

			$styles = $this->shortcode_styles;

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

///// Visual Composer by Plethora


	    /**
	     * Add shortcode parameter method ( extends Visual Composer parameters ).
	     *
	     * @since 1.0
	     *
	     */
		function add_shortcode_param( $name, $callback_function, $js = '') {

			if ( function_exists('add_shortcode_param') ) { 

				if ( empty($js) ) { 

					add_shortcode_param( $name, $callback_function );

				} else { 
					add_shortcode_param( $name, $callback_function, $js );

				}
			}
		}

		public static function remove_default_templates( $data ) {

			    return array(); // This will remove all default templates

		}

	    /**
        * Mapping shortcode parameters for Visual Composer Panel
	     *
	     * @since 1.0
	     *
	     */
        public static function custom_vc_enqueues() {

			// First, on which post types VC is applied
			$post_types = Plethora_CMS::get_option( 'wpb_js_content_types', array( 'page' ) );
        	
			// Apply the script/style on specific post types
        	if( $post_types ==! null ) {
        		
        		if( in_array( get_post_type(), $post_types ) ) {

		            Plethora_CMS::wp_enqueue_style(  'plethora-vc-admin', THEME_CORE_ASSETS_URI . '/visual-composer/vc_custom.css', array( 'js_composer' ) );
		            Plethora_CMS::wp_enqueue_script( 'plethora-vc-admin', THEME_CORE_ASSETS_URI . '/visual-composer/vc_custom.js',  array( 'wpb_js_composer_js_view' ), PLETHORA_VERSION, true);
			
		        }
			}	            
		}

	    /**
         * Mapping shortcode parameters for Visual Composer Panel ( statically )
         * VC wrapper method 
	     * @since 1.0
	     */
        public static function vc_map( $map, $vc_options = '' ) {

			global $vc_add_css_animation;

			$vc_design_options_tab = array(
					'type'           => 'css_editor',
					'heading'        => esc_html__( 'CSS box', 'plethora-framework' ),
					'param_name'     => 'css',
				 // 'description' 	 => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'plethora-framework' ),
					'group'          => esc_html__( 'Design Options', 'plethora-framework' )
	        );

			$vc_options_array = array(
				"design_options" => $vc_design_options_tab,
				"css_animation"  => $vc_add_css_animation
			);

			if ( !empty($vc_options) ){

				foreach ( $vc_options as $value ) array_push( $map['params'], $vc_options_array[$value] );

			}

		    if ( function_exists( 'vc_map' )) vc_map( $map );

		}


	    /**
         * Shortcode script actions only for Visual Composer integration
	     *
	     * @since 1.0
	     *
	     */

        public function add_vc_script( $script ) {

			if ( function_exists('add_shortcode_param') ) { 
				// Assign $scripts to shortocode_scripts variable
				$this->shortcode_scripts = $script; 

				// Add script registration hooks
				Plethora_CMS::add_action( 'admin_enqueue_scripts', array( $this, 'load_vc_script' ));
 
       		}
        }		

	    /**
         * Shortcode script registrations, only for Visual Composer integration
	     *
	     * @since 1.0
	     *
	     */

	    public function load_vc_script() {

			if ( function_exists('add_shortcode_param') ) { 
				// Get script parameters
				$scripts = $this->shortcode_scripts;

				if (is_array($scripts)) { 

					foreach ($scripts as $script) { 

						// Make sure that required parameters are ok
						if (( isset($script['handle']) && !empty($script['handle'] )) && (isset($script['src']) && !empty($script['src'] ))) { 

							// Fixing parameters for wp_register_script ( https://codex.wordpress.org/Function_Reference/wp_register_script )
							$handle 	= $script['handle']; 
							$src 		= $script['src']; 
							$deps 		= ( !isset( $script['deps'] ) || !is_array( $script['deps'] )) ? array() : $script['deps'];
							$ver 		= ( !isset( $script['ver'] ) || !is_string( $script['ver'] )) ? false : $script['ver'] ;
							$in_footer 	= ( !isset( $script['in_footer'] ) || !is_bool( $script['in_footer'] )) ? false : $script['in_footer'] ;

							//Register script
			        		Plethora_CMS::wp_register_script( $handle, $src, $deps, $ver, $in_footer );
						    Plethora_CMS::wp_enqueue_script ( $handle );
			        	}
			        }
			    }
       		}
	    }

	    /**
         * Shortcode style actions only for Visual Composer integration
	     *
	     * @since 1.0
	     *
	     */

        public function add_vc_style( $style ) {

			if ( function_exists('add_shortcode_param') ) { 
				// Assign $scripts to shortocode_scripts variable
				$this->shortcode_styles = $style; 

				// Add script registration hooks
				Plethora_CMS::add_action( 'admin_print_styles', array( $this, 'load_vc_style' ));

       		}
        }		


	    /**
         * Shortcode script registrations, only for Visual Composer integration
	     *
	     * @since 1.0
	     *
	     */

	    public function load_vc_style() {

			if ( function_exists('add_shortcode_param') ) { 
				// Get style parameters
				$styles = $this->shortcode_styles;

				if (is_array($styles)) { 

					foreach ( $styles as $style ) { 
						// Make sure that required parameters are ok
						if (( isset($style['handle']) && !empty($style['handle'] )) && (isset($style['src']) && !empty($style['src'] ))) { 

							// Fixing parameters for wp_register_script ( https://codex.wordpress.org/Function_Reference/wp_register_script )
							$handle 	= $style['handle']; 
							$src 		= $style['src']; 
							$deps 		= ( !isset( $style['deps'] ) || !is_array( $style['deps'] )) ? array() : $style['deps'];
							$ver 		= ( !isset( $style['ver'] ) || !is_string( $style['ver'] )) ? false : $style['ver'] ;
							$media 		= ( !isset( $style['media'] ) || !is_string( $style['media'] )) ? 'all' : $style['media'] ;

							//Register script
			        		Plethora_CMS::wp_register_style( $handle, $src, $deps, $ver, $media );
						    Plethora_CMS::wp_enqueue_style  ( $handle );
			        	}
			        }
	        	}
       		}
	    }

		static function vc_field_select_posts( $settings, $value) {

		   $dependency = vc_generate_dependencies_attributes($settings);
		   $post_type  = (isset($settings['type_posts']) && !empty($settings['type_posts'])) ? $settings['type_posts'] : array('post') ;

		   $return  = '<div class="'.$settings['param_name'].'_block">'. "\n";
		   
		   $return .= '<script language="JavaScript" type="text/javascript">'. "\n";
		   $return .= 'function loopSelected_'. $settings['param_name'] .'()'. "\n";
		   $return .= '{'. "\n";
		   $return .= '  var txtSelectedValuesObj = document.getElementById("'. $settings['param_name'] .'");'. "\n";
		   $return .= '  var selectedArray = new Array();'. "\n";
		   $return .= '  var selObj = document.getElementById("'. $settings['param_name'] .'_select");'. "\n";
		   $return .= '  var i;'. "\n";
		   $return .= '  var count = 0;'. "\n";
		   $return .= '  for (i=0; i<selObj.options.length; i++) {'. "\n";
		   $return .= '    if (selObj.options[i].selected) {'. "\n";
		   $return .= '      selectedArray[count] = selObj.options[i].value;'. "\n";
		   $return .= '      count++;'. "\n";
		   $return .= '    }'. "\n";
		   $return .= '  }'. "\n";
		   $return .= '  txtSelectedValuesObj.value = selectedArray;'. "\n";
		   $return .= '}'. "\n";
		   $return .= '</script>'. "\n";

		   $return  .= '<select multiple id="'. $settings['param_name'] .'_select" onchange="loopSelected_'. $settings['param_name'] .'();"  ' . $dependency . '>';
					
		 		    // Set selected values array from saved string
		 		    $sel_value = ( is_string($value) ) ? explode (',', $value) : $value;

					$args = array( 

						'posts_per_page'   => -1,
						'orderby'          => 'post_date',
						'order'            => 'DESC',
						'post_type'        => $post_type,
						'post_status'      => 'publish',
						'suppress_filters' => false,

						);
					$posts = get_posts( $args );

					foreach ($posts as $post) { 

							if ( is_array($sel_value) && in_array($post->ID, $sel_value) ) { 

								$selected = ' selected="selected"';
								
							} elseif (!is_array($sel_value) && $sel_value == $post->ID) { 

								$selected = ' selected="selected"';

							} else {

								$selected = '';

							}

							$return  .= '<option value="'. $post->ID .'"'. $selected .'>'. $post->post_title .'</option>'. "\n";

					}           
		   $return .= '</select>'. "\n";
		   $return .= '<input name="'.$settings['param_name'].'" id="'.$settings['param_name'].'" class="wpb_vc_param_value '.$settings['param_name'].' '.$settings['type'].'" type="hidden" value="'. $value .'"/>';
		  

		   $return .= '</div>'. "\n";



          return $return;
		}


	    /**
	     * Loads custom VC parameter types
	     *
	     * @param 
	     * @return string
	     * @version 1.0
	     * @since version 1.2
	     *
	     */
	    function vc_field_select_icons( $settings, $value ) {

	      $dependency = vc_generate_dependencies_attributes( $settings );

	      if( isset( $value ) && $value !== "" ) { 

	        $input_value = esc_attr( $value ); 
	        $ev = explode( '|', $value ); 
	        $selected_icon = $ev[0].' '.$ev[1];

	      } else {

	        $input_value = ''; 
	        $selected_icon = "fa fa-plus-circle";

	      }

	       return '<div class="iconpicker_block">'
	       // name="icon_picker_settings[icon1]"
	        .'<input id="icon_picker" name="'.$settings['param_name'].'" class="wpb_vc_param_value wpb-textinput '
	        .$settings['param_name'].' '.$settings['type'].'_field" type="hidden" value="'
	        .$input_value.'" '.$dependency.'/>'
	        .'<div id="preview_icon_picker" data-target="#icon_picker" class="button icon-picker '.$selected_icon.'"></div>'
	        .'</div>';

	    }		

	    /**
         * Handles Visual Composer's vc_build_link, in case VC is not installed
	     *
	     * @since 1.0
	     *
	     */

		static function vc_build_link( $string ) {

			if ( function_exists('vc_build_link')) { 

            	$link = vc_build_link( $string );

			} else { 

	            $array = explode('|', $string);
	            $link['url'] 	= ( isset($array[0]) && !empty($array[0]) ) ? rawurldecode(substr($array[0], 4)) : '';
	            $link['title'] 	= ( isset($array[1]) && !empty($array[1]) ) ? rawurldecode(substr($array[1], 6)) : '';
	            $link['target'] = ( isset($array[2]) && !empty($array[2]) ) ? rawurldecode( substr($array[2], 7)) : '';
			}
			
			return $link;

		}


	}



    // Initialize class
    if ( class_exists( 'Plethora_Shortcode' ) ) { 

        $shortcodes = new Plethora_Shortcode;
        $shortcodes->init();

    }

	
 }