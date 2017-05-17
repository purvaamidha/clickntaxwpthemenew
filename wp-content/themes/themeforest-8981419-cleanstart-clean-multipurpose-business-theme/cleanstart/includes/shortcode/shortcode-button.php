<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M 				   (c) 2013

File Description: Button shortcode

*/

if ( ! defined( 'ABSPATH' )) exit; // NO ACCESS IF DIRECT OR TEAM POST TYPE NOT EXISTS

if ( class_exists('Plethora_Shortcode') && !class_exists('Plethora_Shortcode_Button') ):

  /**
   * @package Plethora Base
   */

  class Plethora_Shortcode_Button extends Plethora_Shortcode { 

    public $shortcode_title       = "Button Shortcode";
    public $shortcode_subtitle    = "Activate/Deactivate Button Shortcode";
    public $shortcode_description = "Button shortcode";

    function __construct() {

          // REGISTER SHORTCODE
 
              // Hook shortcode registration on init
              $this->add( $this->params() );
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
              'switchable'       => true,
              'options_title'    => $this->shortcode_title,
              'options_subtitle' => $this->shortcode_subtitle,
              'options_desc'     => $this->shortcode_description,
              'version'          => '1.0'
            );
          
          return $feature_options;
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
              "base"          => 'sc_button',
              "name"          => __("Button", 'cleanstart'),
              "description"   => __('Simple button', 'cleanstart'),
              "class"         => "",
              "weight"        => 1,
              "category"      => 'Plethora Shortcodes',
              "admin_enqueue_css" => THEME_CORE_ASSETS_URI .'/admin-shortcodes.css',
              "icon"              => THEME_CORE_ASSETS_URI . '/icons/plethora_shortcodes-32x32.png', 
              "params"        => array(
                  array(
                      "param_name"    => "button_link",
                      "type"          => "vc_link",
                      "holder"        => "h4",
                      "class"         => "vc_hidden",
                      "heading"       => __("Button text and link", 'cleanstart'),
                      "value"         => 'Buy this theme!',
                      "description"   => __("Add button text and link. Button gets its text from the value you enter in the title field.", 'cleanstart'),
                      "admin_label"   => false                                               
                 )
                 ,array(
                      "param_name"    => "button_class",                                  
                      "type"          => "dropdown",                                        
                      "holder"        => "h4",                                               
                      "class"         => "vc_hidden",                                           
                      "heading"       => __("Select button class", 'cleanstart'),      
                      "value"         => array(
                        'Primary'=>'btn-primary',
                        'Default'=>'btn-default',
                        'Success'=>'btn-success',
                        'Info'   =>'btn-info',
                        'Warning'=>'btn-warning',
                        'Danger' => 'btn-danger',
                        'Inverted' => 'btn-primary-inv',
                        'Alternative' => 'btn-primary-alt'
                        ),
                      "description"   => __("Button styling class.", 'cleanstart'),       
                      "admin_label"   => false,                                              
                  )
                  ,array(
                      "param_name"    => "button_size",                                  
                      "type"          => "dropdown",                                        
                      "holder"        => "h4",                                               
                      "class"         => "vc_hidden",                                           
                      "heading"       => __("Select button size", 'cleanstart'),      
                      "value"         => array(
                        'Default'     =>'btn',
                        'Small'       =>'btn-sm',
                        'Extra Small' =>'btn-xs'
                        ),
                      "description"   => __("Button styling class.", 'cleanstart'),       
                      "admin_label"   => false,                                              
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

        $this->add_script = true; 

          extract( shortcode_atts( array( 
            'button_class'     => 'btn-primary',
            'button_size'      => 'btn',
            "button_link"      =>  'Buy this theme!'
          ), $atts ) );

          $button_link = self::vc_build_link( $button_link );
          $target = ( trim($button_link['target']) !== '' ) ? 'target="'. esc_attr( trim($button_link['target']) ).'"' : '';
          $output      = '<div class="centered_button"><a class="' . esc_attr( $button_size ) . ' ' . esc_attr( $button_class ) . '" '.$target.' title="'. esc_attr( $button_link['title'] ).'" href="' . esc_url( $button_link['url'] ) . '">'. esc_attr($button_link['title']).'</a></div>';
          return $output;

       }

	}
	
 endif;