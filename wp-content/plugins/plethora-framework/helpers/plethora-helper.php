<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M 				   (c) 2014

Description: Plethora Helper Class // CAREFULL...THIS IS A DEPRECATED CLASS ----> SHOULD BE REMOVED ON PLETHORA FRAMEWORK 1.3 VERSION
Version: 1.0

*/

if ( ! defined( 'ABSPATH' ) ) exit; // NO DIRECT ACCESS 


/**
 * Includes any helper function. Divided in 3 sections: 1. WP interface functions | 2. Data Arrays | 3. General Snippets.
 * 
 * @package Plethora Framework
 * @version 1.0
 * @author Plethora Dev Team
 * @copyright Plethora Themes (c) 2014
 *
 */
class Plethora_Helper {


//// WORDPRESS FUNCTIONALITY


	/**
	 * Manages every wordpress add action hook
	 * 
	 * @param $action (hook to an action) | $function_to_add (custom function), $priority (execution order), $accepted_args (extra custom function arguments)
	 * 
	 */

    static function add_action($action, $function, $priority = 10, $accepted_args = 1) {

        add_action($action, $function, $priority, $accepted_args);

    }

	/**
	 * Manages every wordpress add filter hook
	 * 
	 * @param $action (hook to an action) | $function_to_add (custom function), $priority (execution order), $accepted_args (extra custom function arguments)
	 * 
	 */

    static function add_filter($action, $function, $priority = 10, $accepted_args = 1) {

        add_filter($action, $function, $priority, $accepted_args);

    }

	/**
	 * Manages every wordpress filter removal hook
	 * 
	 * @param $action (hook to an action) | $function_to_remove (custom function), $priority (execution order)
	 * 
	 */

    static function remove_action($tag, $function_to_remove, $priority = 10) {

		remove_action( $tag, $function_to_remove, $priority );   

    }   

	/**
	 * Manages every wordpress filter removal hook
	 * 
	 * @param $action (hook to an action) | $function_to_remove (custom function), $priority (execution order)
	 * 
	 */

    static function remove_filter($tag, $function_to_remove, $priority = 10) {

		remove_filter( $tag, $function_to_remove, $priority );   

    }        


//// DATA ARRAYS

    /**
     * Return categories in title->value array. Based on WP get_categories. Used mostly on shortcode features. 
     * Check http://codex.wordpress.org/Function_Reference/get_categories for further documentation
     *
	 * @param $user_args, $taxonomy, $fieldtitle, $fieldvalue
   	 * @return array
     * @since 1.0
     *
     */

    static function array_categories( $user_args = array(), $fieldtitle = 'name', $fieldvalue = 'cat_ID'  ) {

		// Default arguments
		$default_args = array(
			'type'                     => '',
			'child_of'                 => 0,
			'parent'                   => '',
			'orderby'                  => 'name',
			'order'                    => 'ASC',
			'hide_empty'               => 0,
			'hierarchical'             => 1,
			'exclude'                  => '',
			'include'                  => '',
			'number'                   => '',
			'taxonomy'                 => 'category',
			'pad_counts'               => false 

		); 		    

		// Merge default and user given arguments
		$args = array_merge($default_args, $user_args);

		// Get the categories
	    $categories = get_categories( $args );

		// Return values in array, according to $fieldtitle and $fieldvalue variables
		$return = Array();
	    
    	foreach ( $categories as $category ) { 

            $return[$category->$fieldtitle] = $category->$fieldvalue;
    	}

	    ksort($return);
	    return $return;

	}	

    /**
     * Returns the registered post types as found in $wp_post_types, but only those with UI and TinyMce editor capabilities. 
     * Based on WP get_post_types. Used mostly on shortcode features. 
     * Check http://codex.wordpress.org/Function_Reference/get_post_types for further documentation
     * Check http://codex.wordpress.org/Function_Reference/post_type_supports for further documentation
     *
	 * @param $user_args
   	 * @return array
     * @since 1.0
     *
     */

    static function array_posttypes_with_editor( $user_args = array() ) {

		// Default arguments
		$default_args = array(
			'show_ui'		=> true,
		); 		    

		// Merge default and user given arguments
		$args = array_merge($default_args, $user_args);

		// Get the post types
	    $post_types = get_post_types( $args, 'objects' );

		// Return post types that support editor in array
		$return = Array();
	    
    	foreach ( $post_types as $post_type ) { 

    		if ( post_type_supports($post_type->name, 'editor') ) { 

	            $return[] = $post_type->name;

            }
    	}

	    ksort($return);
	    return $return;
	}	

    /**
     * Return widgetized areas in array (id=>name), according to $wp_registered_sidebars global variable
     *
	 * @param $exclude_ids ( sidebar ids to exlcude )
   	 * @return array
     * @since 1.0
     *
     */

    static function array_widgetized_areas( $exclude_ids = array()  ) {

		global $wp_registered_sidebars;
	    
	    $sidebars = $wp_registered_sidebars;

    	foreach ( $sidebars as $key=>$sidebar ) { 
    		if ( !in_array($key, $exclude_ids) ) { 
	            $return[$key] = $sidebar['name'] ;
            }
    	}
    	if (isset($return) && is_array($return)) { 

		    ksort($return);
		    return $return;
	    } else { 

		    return array();
	    }

	}	

//// GENERAL PLETHORA SNIPPETS

	/**
	 * (needs description)
	 * 
	 * @param 
	 * 
	 */

	static function get_core_files( $folder, $filename_prefix = '', $filename_ext = 'php' ) {

		if ( is_dir( $folder ) != true ) return false;

		$filenames = scandir( $folder );

		$returnfilenames = array();

		foreach ( $filenames as $filename ) {

			if ( substr( $filename, -4 ) == '.'. $filename_ext ) {
			
				if ( $filename_prefix != '' ) {

					$fileparts = explode( '-', $filename );

					if ( $fileparts[0] != '' && $fileparts[0] == $filename_prefix ) {

						$returnfilenames[] = $filename;

					}

				} else { 

						$returnfilenames[] = $filename;

				}
			}
		}
		return $returnfilenames ;

	}


	  /** 
	   * Returns feature settings for the given controller/feature.
	   *
	   * @param $features_sections
	   * @return array
	   * @since 1.0
	   *
	   */

		static function features_settings( $features_sections = array() ) {
		    
			$plethora_classes = get_option(PLETHORA_CLASSES_OPTNAME);

		    //create option array
		     $editable_features_sections = $features_sections;

			 $redux_settings = array();
		     foreach ($editable_features_sections as $section) { 

		        $features = (isset($plethora_classes[$section]['features'])) ? $plethora_classes[$section]['features'] : array();

		        foreach ($features as $feature_slug => $feature_settings) { 
		        
				  if (array_key_exists('feature_options', $feature_settings)) {
				  	  $feature_options = $feature_settings['feature_options'];
                      $id = ''. $section .'-'. $feature_slug .'-status';
                      $switchable = ( array_key_exists('switchable', $feature_options) ? $feature_options['switchable'] : 0 );
			          $title = ( array_key_exists('options_title', $feature_options) ? $feature_options['options_title'] : $feature_slug );
			          $subtitle = ( array_key_exists('options_subtitle', $feature_options) ? $feature_options['options_subtitle'] : '' );
			          $desc = ( array_key_exists('options_desc', $feature_options) ? $feature_options['options_desc'] : '' );
                      $required = ( array_key_exists('options_required', $feature_options) ? $feature_options['options_required'] : '' );

                      if ( $switchable == 1 && !is_array($required)) { 
 
    			          $redux_setting = array(
    			           'id'=>''. $id ,
    			           'type' => 'switch',
    			           'title' => $title,
    			           'subtitle' => $subtitle,
    			           'desc' => $desc,
    						'on' => 'Activated',
    						'off' => 'Deactivated',
    						'default' => 1,
    			           );
   			          $redux_settings[] = $redux_setting;
                    
                      } elseif ( $switchable == 1 && is_array($required)) { 

                          $redux_setting = array(
                           'id'=>''. $id ,
                           'type' => 'switch',
                           'required' => $required,
                           'title' => $title,
                           'subtitle' => $subtitle,
                           'desc' => $desc,
                            'on' => 'Activated',
                            'off' => 'Deactivated',
                            'default' => 1,
                           );
                        $redux_settings[] = $redux_setting;

                      }
		          }
		        }
		     }
		      return $redux_settings;
		} 	


	/**
	 * Convert hyphens to underscore inside a string
	 * 
	 * @param $action (hook to an action) | $function_to_add (custom function), $priority (execution order), $accepted_args (extra custom function arguments)
	 * 
	 */

    static function hyphens_to_underscores( $string ) {

        $return = str_replace("-", "_", $string );
        return $return;

    }

	/**
	 * is_edit_page 
	 * function to check if the current page is a post edit page
	 * 
	 * @param  string  $new_edit what page to check for accepts new - new post page ,edit - edit post page, null for either
	 * @return boolean
	 */

	static function is_edit_page($new_edit = null){
	    global $pagenow;
	    //make sure we are on the backend
	    if (!is_admin()) return false;


	    if($new_edit == "edit")
	        return in_array( $pagenow, array( 'post.php',  ) );
	    elseif($new_edit == "new") //check for new post page
	        return in_array( $pagenow, array( 'post-new.php' ) );
	    else //check for either new or edit
	        return in_array( $pagenow, array( 'post.php', 'post-new.php' ) );
	}

	
	/**
	 * This returns any value with its correct data type for use in WP ( STILL IN LAB...NOT USED YET )
	 * 
	 * @param  $value
	 * @return string, int, float, bool, NULL
	 * @version 1.0
	 */
	static function set_data_type( $value = NULL ) {

		// Definitely an array
		if ( is_array( $value )) { 

			return (array) $value;

		// Definitely a string
		} elseif ( is_string( $value )) { 

			// Definitely a string containing numbers
			if ( is_numeric( $value )) { 

				// This checks if the number is an octal ( check http://php.net/manual/en/function.octdec.php ). If this so, must be returned as it is
				if ( decoct( octdec( $value ) ) == $value ) { 

					return $value;

				// If the string DOES NOT contain non-digit characters, this means that it is an integer
				} elseif ( ctype_digit( $value ) ) { 

					settype( $value, 'integer');
					return $value;

				// If the string DOES contain non-digit characters, this means that it's a float number
				} else { 

					settype( $value, 'float');
					return $value;

				} 

			// A string that should be returned normally as a string
			} else { 

				return $value;
			} 

		// Definitely an integer
		} elseif ( is_int( $value )) { 

			settype( $value, 'integer');
			return $value;

		// Definitely a float/double number
		} elseif ( is_float( $value )) { 

			settype( $value, 'float');
			return $value;

		// Definitely a boolean
		} elseif ( is_bool( $value )) { 

			settype( $value, 'boolean');
			return $value;

		// Definitely a NULL
		} elseif ( is_null( $value )) { 

			return NULL;
		}
	}


	/**
	 * Retrieves the attachment ID from the file URL
	 * 
	 * @param  $image_url
	 * @return string
	 * @version 1.1
	 */

	// 
	static function get_imageid_by_url( $image_url ) {
		global $wpdb;
		$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ));
		if ( $attachment )  { 

	        return $attachment[0]; 
	        
		}
	}		    

}


?>