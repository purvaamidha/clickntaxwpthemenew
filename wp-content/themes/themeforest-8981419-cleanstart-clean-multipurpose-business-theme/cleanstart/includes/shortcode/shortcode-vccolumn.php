<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M 				   (c) 2013

File Description: Column shortcode

*/

if ( ! defined( 'ABSPATH' ) ) exit; // NO DIRECT ACCESS 

$customize_vc = Plethora::option( 'customizevc-status', 1, 0, false);

if ( class_exists('Plethora_Shortcode') && !class_exists('Plethora_Shortcode_Vccolumn') && $customize_vc ):

	/**
	 * @package Plethora
	 */

	class Plethora_Shortcode_Vccolumn extends Plethora_Shortcode { 

    	 function __construct() {
   
          // Hook shortcode registration on init
          $this->add( $this->params() );
    	 }

       /** 
       * Returns shortcode settings (compatible with Visual composer)
       *
       * @return array
       * @since 1.0
       *
       */
       public function params() {

          $sc_settings =  array(
              "base"          => 'vc_column',
              "name"          => __("Column", 'cleanstart'),
              "description"   => __('Column container ( used inside a row )', 'cleanstart'),
              "class"         => '',
              'is_container'            => true,
              'show_settings_on_create' => false,
              'content_element'         => false,
              'js_view'                 => 'VcColumnView',
              "params"        => array(
                    array(
                        "param_name"    => "width",
                        "type"          => "textfield",
                        "heading"       => __("Column Width", 'cleanstart'),
                        "description"   => __("Select the desired width for this column", 'cleanstart'),
                        "admin_label"   => false, 
                    ),
                    array(
                        "param_name"    => "extra_classes",
                        "type"          => "textfield",
                        "heading"       => __("Additional Classes", 'cleanstart'),
                        "description"   => __("Enter additional class name(s) for column ( separate with space )", 'cleanstart'),
                        "admin_label"   => false, 
                    ),
                    array(
                        "param_name"    => "align",
                        "type"          => "textfield",
                        "heading"       => __("Column Alignment", 'cleanstart'),
                        "description"   => __("Select the desired alignment for this column", 'cleanstart'),
                        "admin_label"   => false, 
                    ),
                 array(
                      "param_name"    => "border",
                      "type"          => "dropdown",
                      "heading"       => __("Column border", 'cleanstart'),
                      "value"         => array( 'None' => 'none', 'Left' =>'left', 'Right' => 'right', "Both" => "both" ),
                      "btn_menu_value"=> "none",
                      "description"   => 'Where and whether to display a border'
                  ),
                 array(
                      "param_name"    => "border_width",
                      "type"          => "textfield",
                      "heading"       => __("Border width", 'cleanstart'),
                      "value"         => "1",
                      "btn_menu_value"=> "1",
                      "description"   => 'Enter border width (in px)',
                      "dependency"    => array(
                        "element" => "border",
                        "value"   => array("left", "right", "both")
                        )
                  ),
                array(
                      "param_name"  => "color",
                      "type"        => "colorpicker",
                      "heading"     => "Border color",
                      "value"       => '#000000', //Default Red color
                      "description" => "Choose a border color",
                      "dependency"  => array(
                        "element" => "border",
                        "value"   => array("left", "right", "both")
                        )
                      )
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
            'width'                => '1/1',
            'extra_classes'        => '',
            'align'                => 'default',
            'border'               => 'none',
            'border_width'         => '1',
            'color'                => '#000000'
        ), $atts ) );

        $fraction = array('whole' => 0, 'numerator'=> 0, 'denominator'=> 0);
        preg_match('/^((?P<whole>\d+)(?=\s))?(\s*)?(?P<numerator>\d+)\/(?P<denominator>\d+)$/', $width, $fraction);
        $sum_numdenom = ( $fraction['numerator'] != 0 ) ? $fraction['numerator'] / $fraction['denominator'] : 0;
        $decimal_width = $fraction['whole'] + $sum_numdenom;

        $classes = array();
        $column_attrs = array();
        $classes[] = 'col-md-' . floor( $decimal_width * 12 );
        $classes[] = $extra_classes;
        $classes[] = 'text-' . $align;

        $style = '';

        if ( $border !== 'none' ){
          if ( $border !== 'both' ){
            $style = 'style="border-' . esc_attr( $border ) . ':' . esc_attr( $border_width ) .'px solid ' . esc_attr( $color ) . ';"';
          } else {
            $style = 'style="border-left:' . esc_attr( $border_width ) .'px solid ' . esc_attr( $color ) . '; border-right: '. esc_attr( $border_width ) .'px solid ' . $color . ';"';
          }
        }

        $output  = '<div class="' . implode( ' ', $classes ) . '" ' . $style . '>';
        $output .= do_shortcode( $content );
        $output .= '</div>';

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
              'switchable' => false, // this should be false...we don't want to make VC unusable!
              'options_title' => 'Column Shortcode',
            );
          
          return $feature_options;
       }


	}
	
 endif;