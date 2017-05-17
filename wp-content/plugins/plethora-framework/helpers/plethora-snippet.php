<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M 				   (c) 2014

Description: General snippets
Version: 1.0

*/

if ( ! defined( 'ABSPATH' ) ) exit; // NO DIRECT ACCESS 


/**
 * General snippets
 * 
 * @package Plethora Framework
 * @version 1.0
 * @author Plethora Dev Team
 * @copyright Plethora Themes (c) 2014
 *
 */
class Plethora_Snippet {

//// GENERAL PLETHORA SNIPPETS

	/**
	 * Retrieves the attachment ID from the file URL
	 * 
	 * @param  $image_url
	 * @return string
	 * @version 1.1
	 */
	static function get_imageid_by_url( $image_url ) {
		global $wpdb;
		$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ));
		if ( $attachment )  { 

	        return $attachment[0]; 
	        
		}
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
}


?>