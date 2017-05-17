<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M 				   (c) 2014

Description: Includes every data array returning methods used in Plethora Framework
Version: 1.0

*/

if ( ! defined( 'ABSPATH' ) ) exit; // NO DIRECT ACCESS 


/**
 * Includes every data array returning methods used in Plethora Framework
 * 
 * @package Plethora Framework
 * @version 1.0
 * @author Plethora Dev Team
 * @copyright Plethora Themes (c) 2014
 *
 */
class Plethora_Data {


	/**
	 * (needs description)
	 * 
	 * @param 
	 * 
	 */

	static function class_files( $folder, $filename_prefix = '', $filename_ext = 'php' ) {

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
     * Return categories in title->value array. Based on WP get_categories. Used mostly on shortcode features. 
     * Check http://codex.wordpress.org/Function_Reference/get_categories for further documentation
     *
	 * @param $user_args, $taxonomy, $fieldtitle, $fieldvalue
   	 * @return array
     * @since 1.0
     *
     */

    static function categories( $user_args = array(), $fieldtitle = 'name', $fieldvalue = 'cat_ID'  ) {

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

    static function posttypes_with_editor( $user_args = array() ) {

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

    static function widgetized_areas( $exclude_ids = array()  ) {

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

  /** 
   * Returns feature settings for the given controller/feature.
   *
   * @param $features_sections
   * @return array
   * @since 1.0
   *
   */

	static function features_settings( $features_sections = array() ) {
	    
		$plethora_classes = Plethora_CMS::get_option(PLETHORA_CLASSES_OPTNAME);

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


}


?>