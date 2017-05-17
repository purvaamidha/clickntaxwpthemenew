<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M 				   (c) 2013

File Description: Image Compare shortcode

*/

if ( ! defined( 'ABSPATH' )) exit; // NO ACCESS IF DIRECT OR TEAM POST TYPE NOT EXISTS

if ( class_exists('Plethora_Shortcode') && !class_exists('Plethora_Shortcode_ImageCompare') ):

	/**
	 * @package Plethora Base
	 */

	class Plethora_Shortcode_ImageCompare extends Plethora_Shortcode { 

    	 function __construct() {

          // REGISTER SHORTCODE
 
              // Hook shortcode registration on init
              $this->add( $this->params() );

          // ADD SCRIPTS 
              // Prepare array for script registration according to wp_register_script usage. 
              if (!is_admin()) {
                $this->add_script( array(
                  array(
                  'handle'    => 'jquery-event-move', 
                  'src'       => THEME_ASSETS_URI . '/js/twentytwenty/js/jquery.event.move.min.js', 
                  'deps'      => array( 'jquery' ), 
                  'ver'       => '1.0', 
                  'in_footer' => false
                  ),
                  array(
                  'handle'    => 'twentytwenty', 
                  'src'       => THEME_ASSETS_URI . '/js/twentytwenty/js/jquery.twentytwenty.min.js', 
                  'deps'      => array( 'jquery' ), 
                  'ver'       => '1.0', 
                  'in_footer' => false
                  )
                ));
              }

              // Note: scripts are loaded only when the shortcode is visible in frontend. You may add more than one

          // ADD STYLES 
              if (!is_admin()) {
              // Prepare shortcode related styles array according to wp_register_style usage (may add more than one)
                $this->add_style( array(
                  array(
                  'handle'    => 'twentytwenty', 
                  'src'       => THEME_ASSETS_URI . '/js/twentytwenty/css/twentytwenty.css', 
                  'deps'      => array(),  
                  'ver'       => false,    
                  'media'     => 'all'     
                  ),
                ));           
              }

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
              'options_title'    => 'Image Compare shortcode',
              'options_subtitle' => 'Activate/deactivate Image Compare shortcode',
              'options_desc'     => 'Highlight differences between two images',
              'tutorial_videos'  => array(),
              'tutorial_links'   => array(),
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
              "base"              => 'sc_imagecompare',
              "name"              => __("Image Compare", 'cleanstart'),
              "description"       => __('Highlight differences between two images', 'cleanstart'),
              "class"             => "",
              "weight"            => 1,
              "category"          => 'Plethora Shortcodes',
              "admin_enqueue_css" => THEME_CORE_ASSETS_URI .'/admin-shortcodes.css',
              "icon"              => THEME_CORE_ASSETS_URI . '/icons/plethora_shortcodes-32x32.png', 
              "params"            => array(

                  array(
                      "param_name"    => "before_image",                                  
                      "type"          => "attach_image",                                        
                      "holder"        => "h4",                                               
                      "class"         => "vc_hidden",                                                 
                      "heading"       => __("Before Image", 'cleanstart'),      
                      "value"         => '',
                      "description"   => __("Upload before-image", 'cleanstart'),       
                      "admin_label"   => false,                                              
                  ),
                  array(
                      "param_name"    => "after_image",                                  
                      "type"          => "attach_image",                                        
                      "holder"        => "h4",                                               
                      "class"         => "vc_hidden",                                                 
                      "heading"       => __("After Image", 'cleanstart'),      
                      "value"         => '',
                      "description"   => __("Upload after-image", 'cleanstart'),       
                      "admin_label"   => false,                                              
                  ),
                  array(
                      "param_name"    => "default_offset",                                  
                      "type"          => "textfield",                                        
                      "holder"        => "h4",                                               
                      "class"         => "vc_hidden",                                                 
                      "heading"       => __("Image offset", 'cleanstart'),      
                      "value"         => '0.5',
                      "description"   => __("Set the default split offset", 'cleanstart'),       
                      "admin_label"   => false,                                              
                  ),
                  array(
                      "param_name"    => "orientation",                                  
                      "type"          => "dropdown",                                        
                      "holder"        => "h4",                                               
                      "class"         => "vc_hidden",                                                 
                      "heading"       => __("Orientation", 'cleanstart'),      
                      "value"         => array(__('Horizontal', 'cleanstart') =>'horizontal', __('Vertical', 'cleanstart') =>'vertical'),
                      "description"   => __("Set the orientation of the effect", 'cleanstart'),       
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
            'default_offset' => '0.5', 
            'orientation'    => 'horizontal',
            'before_image'   => '',
            'after_image'    => ''
            ), $atts ) );

        $before_image = (!empty($before_image)) ? wp_get_attachment_image_src( $before_image, 'full' ) : '';
        $after_image  = (!empty($after_image)) ? wp_get_attachment_image_src( $after_image, 'full' ) : '';

          $random_id = uniqid('twentytwenty_');
          $output = '<div class="twentytwenty-container" id="' . esc_attr($random_id) . '">';
          $output .= '<img src="' . esc_url( $before_image[0]) .'" alt="before" />';
          $output .= '<img src="' . esc_url( $after_image[0] ) . '" alt="after" />';
          $output .= '</div>';
          $output .= '<script>';
          $output .= 'jQuery(window).load(function(){';
          $output .= 'jQuery("#' . $random_id . '").twentytwenty({ 
              default_offset_pct: "' . $default_offset . '", 
              orientation: "' . $orientation . '"
            });';
          $output .= '});';
          $output .= '</script>';

          return $output;

       }

	}
	
 endif;