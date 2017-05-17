<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M 				   (c) 2014

Description: An intermediary class between WP and Plethora framework to handle efficiently deprecated functions
Version: 1.2

*/

if ( ! defined( 'ABSPATH' ) ) exit; // NO DIRECT ACCESS 


/**
 * An intermediary class between WP and Plethora framework to handle efficiently deprecated functions
 * 
 * @package Plethora Framework
 * @version 1.0
 * @author Plethora Dev Team
 * @copyright Plethora Themes (c) 2014
 *
 */
class Plethora_CMS {


//// WORDPRESS FUNCTIONS

	/**
	 * Manages every wordpress add action hook
	 * 
	 */
    static function add_action( $action, $function, $priority = 10, $accepted_args = 1 ) {

        return add_action( $action, $function, $priority, $accepted_args );

    }

	/**
	 * Manages every wordpress filter removal hook
	 * 
	 */
    static function remove_action($tag, $function_to_remove, $priority = 10) {

		return remove_action( $tag, $function_to_remove, $priority );   

    }


	/**
	 * Manages every wordpress add filter hook
	 * 
	 */
    static function add_filter( $action, $function, $priority = 10, $accepted_args = 1 ) {

        return add_filter( $action, $function, $priority, $accepted_args );

    }

	/**
	 * Manages every wordpress filter removal hook
	 * 
	 */
    static function remove_filter($tag, $function_to_remove, $priority = 10) {

		return remove_filter( $tag, $function_to_remove, $priority );   

    }

	/**
	 * Call the functions added to a filter hook.
	 * 
	 */
    static function apply_filters( $tag, $value ) {

        return apply_filters( $tag, $value );

    }

	/**
	 * Return values for a named option from the options database table. If the desired option does not exist, or no value is associated with it, FALSE will be returned.
	 * 
	 */
    static function get_option( $option, $default = false ) {

		return get_option( $option, $default ); 

    }

	/**
	 * Updates a named option/value pair to the options database table
	 * 
	 */
    static function update_option( $option, $new_value ) {

		return update_option( $option, $new_value ); 

    }

	/**
	 * Registers a script file in WordPress to be linked to a page later using the wp_enqueue_script() function, which safely handles the script dependencies. 
	 * 
	 */
    static function wp_register_script( $handle, $src, $deps = array(), $ver = false, $in_footer = false ) {

		wp_register_script( $handle, $src, $deps, $ver, $in_footer ); 

    }

	/**
	 * Links a script file to the generated page at the right time according to the script dependencies, if the script has not been already included and if all the dependencies have been registered.
	 * 
	 */
    static function wp_enqueue_script( $handle, $src = false, $deps = array(), $ver = false, $in_footer = false ) {

		wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer ); 

    }

	/**
	 * A safe way to register a CSS style file for later use with wp_enqueue_style()
	 * 
	 */
    static function wp_register_style( $handle, $src, $deps = array(), $ver = false, $media = 'all' ) {

		wp_register_style( $handle, $src, $deps, $ver, $media  ); 

    }

	/**
	 * A safe way to add/enqueue a CSS style file to the wordpress generated page. If it was first registered with wp_register_style() it can now be added using its handle.
	 * 
	 */
    static function wp_enqueue_style( $handle, $src = false, $deps = array(), $ver = false, $media = 'all' ) {

		wp_enqueue_style( $handle, $src, $deps, $ver, $media ); 

    }

	/**
	 * Localizes a registered script with data for a JavaScript variable. 
	 * Though localization is the primary use, it can be used to make any data available to your script that you can normally only get from the server side of WordPress. 
	 */
    static function wp_localize_script( $handle, $name, $data ) {

		return wp_localize_script( $handle, $name, $data ); 

    }

	/**
	 * Localizes a registered script with data for a JavaScript variable. 
	 * Though localization is the primary use, it can be used to make any data available to your script that you can normally only get from the server side of WordPress. 
	 */
    static function wp_print_scripts( $handles = false ) {

		return wp_print_scripts( $handles ); 

    } 
   
	/**
	 * Create or modify a post type. register_post_type should only be invoked through the 'init' action. 
	 * It will not work if called before 'init', and aspects of the newly created or modified post type will work incorrectly if called later.
	 */
    static function register_post_type( $post_type, $args = array() ) {

		return register_post_type( $post_type, $args ); 

    }    

	/**
	 * Create or modify a taxonomy object. Do not use before init.
	 */
    static function register_taxonomy( $taxonomy, $object_type, $args = array() ) { 

		return register_taxonomy( $taxonomy, $object_type, $args ); 

    }

	/**
	 * Adds a hook for a shortcode tag. 
	 * 
	 */
    static function add_shortcode( $tag, $func ) {

		add_shortcode( $tag , $func ); 

    }

	/**
	 * Adds a new widget to the administration dashboard, using the WordPress Dashboard Widgets API. 
	 * 
	 */
    static function wp_add_dashboard_widget( $widget_id, $widget_name, $callback, $control_callback = null, $callback_args = null ) {

		wp_add_dashboard_widget( $widget_id, $widget_name, $callback, $control_callback, $callback_args );    

    }

	/**
	 * Builds the definition for a single sidebar and returns the ID 
	 * 
	 */
    static function register_sidebar( $args ) {

		return register_sidebar( $args );    

    }



//// CUSTOM WORDPRESS CONDITIONALS

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

    static function get_revsliders() {

      $revsliders = array();
      if ( class_exists('RevSliderAdmin')) {
        global $wpdb;
        $rs = $wpdb->get_results( "SELECT id, title, alias FROM " . $wpdb->prefix . "revslider_sliders ORDER BY id ASC LIMIT 999");

        if ( $rs ) {
          foreach ( $rs as $slider ) {
            $revsliders[$slider->alias] = $slider->title;
          }
        } else {
            $revsliders[''] = __('No Revolution slider found', 'cleanstart');
        }
      } else { 

            $revsliders[''] = __('Revolution slider plugin is inactive )', 'cleanstart');
      }

      return $revsliders;
    }	
}
?>