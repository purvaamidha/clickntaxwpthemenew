<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M 				   (c) 2013

File Description: Inner Row shortcode

*/

if ( ! defined( 'ABSPATH' ) ) exit; // NO DIRECT ACCESS 

$customize_vc = Plethora::option( 'customizevc-status', 1, 0, false);

if ( class_exists('Plethora_Shortcode') && !class_exists('Plethora_Shortcode_Vcrowinner') && $customize_vc ):

	/**
	 * @package Plethora
	 */

	class Plethora_Shortcode_Vcrowinner extends Plethora_Shortcode { 

    	 function __construct() {

           // Hook shortcode registration on init
          $this->add( $this->params() );

    	 }

       /** 
       * Returns shortcode content
       *
       * @return array
       * @since 1.0
       *
       */
       public function params() {

          $sc_settings =  array(
              "base"          => 'vc_row_inner',
              "name"          => __("Row Inner", 'cleanstart'),
              "description"   => __('Create an nested row to add content', 'cleanstart'),
              "class"         => '',
              "weight"        => 1,
              "icon"          => "icon-wpb-row",
              'is_container'            => true,
              'show_settings_on_create' => false,
              'content_element'         => false,
              'weight'                  => 999,
              'js_view'                 => 'VcRowView',
              "params"        => array(
                    array(
                        "param_name"    => "extra_classes",
                        "type"          => "textfield",
                        "heading"       => __("Additional Classes", 'cleanstart'),
                        "description"   => __("Enter additional class name(s) for inner row ( separate with space )", 'cleanstart'),
                        "admin_label"   => false, 
                    ),


              )
          );

          return $sc_settings;
       }


       /** 
       * Returns shortcode content
       *
       * @return array
       * @since 1.0
       *
       */
       public function content( $atts, $content = null ) {

            extract( shortcode_atts( array( 
              'extra_classes'         => '',
              ), $atts ) );

            $extra_classes = !empty($extra_classes) ? ' '. $extra_classes : '';
            $output = '   <div class="row'. esc_attr( $extra_classes ).'">';

            if( !empty( $content ) ) {
                $output .= do_shortcode( $content );
            }
            $output .= '    </div>';

            return $output;
       }


       /** 
       * Returns feature information for several uses by Plethora Core (theme options etc.)
       *
       * @return array
       * @since 1.0
       *
       */
       public function get_feature_options() {

          $feature_options = array (  
              'switchable'    => false, // this should be false...we don't want to make VC unusable!
              'options_title' => 'Inner Row Shortcode',
            );
          
          return $feature_options;
       }


	}
	
 endif;