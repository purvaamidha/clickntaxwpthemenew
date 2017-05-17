<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M 				   (c) 2013

File Description: Call To Action shortcode

*/

if ( ! defined( 'ABSPATH' )) exit; // NO ACCESS IF DIRECT OR TEAM POST TYPE NOT EXISTS

if ( class_exists('Plethora_Shortcode') && !class_exists('Plethora_Shortcode_Calltoaction') ):

	/**
	 * @package Plethora Base
	 */

	class Plethora_Shortcode_Calltoaction extends Plethora_Shortcode { 


    	 function __construct() {

          // REGISTER SHORTCODE
 
              // Hook shortcode registration on init
              $this->add( $this->params() );

          // MAP PARAMETERS TO UI PANELS ( we use the params() method to get defined parameters )

              if (!is_admin()) {

                $simple_text_rotator_speed = method_exists('Plethora', 'option') ? Plethora::option('font-text-rotator-speed', 6000, 0, false) : 6000 ;
                // $simple_text_rotator_speed = ( $cleanstart_options['font-text-rotator-speed'] !== null ) ? $cleanstart_options['font-text-rotator-speed'] : 6000;

                $this->add_script( array(
                  array(
                    'handle'    => 'simple-text-rotator', 
                    'src'       => THEME_ASSETS_URI . '/js/jquery.simple-text-rotator.min.js', 
                    'deps'      => array( 'jquery' ), 
                    'ver'       => '1.0', 
                    'in_footer' => true
                  ),
                  array(
                    'type'     => 'localized_script',
                    'handle'   => 'simple-text-rotator',
                    'variable' => 'textRotatorOptions',
                  //'data'     => array( 'speed' =>  Plethora::option('font-text-rotator-speed', 6000, 0, false))
                    'data'     => array( 'speed' => $simple_text_rotator_speed )

                    
                  )
                 
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
              'options_title'    => 'Call To Action shortcode',
              'options_subtitle' => 'Activate/deactivate Call To Action shortcode',
              'options_desc'     => 'Call To Action shortcode',
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
              "base"              => 'sc_calltoaction',
              "name"              => __("Call to Action", 'cleanstart'),
              "description"       => __('Call to Action Section', 'cleanstart'),
              "class"             => "",
              "weight"            => 1,
              "category"          => 'Plethora Shortcodes',
              "admin_enqueue_css" => THEME_CORE_ASSETS_URI .'/admin-shortcodes.css',
              "icon"              => THEME_CORE_ASSETS_URI . '/icons/plethora_shortcodes-32x32.png', 
              "params"            => array(
                 array(
                      "param_name"    => "icon_image",                                  
                      "type"          => "attach_image",                                        
                      "holder"        => "h4",                                               
                      "class"         => "vc_hidden",                                                 
                      "heading"       => __("Section's icon image", 'cleanstart'),      
                      "value"         => '',
                      "description"   => __("Set the icon image", 'cleanstart'),       
                      "admin_label"   => false,                                              
                  )
                  ,array(
                      "param_name"    => "title",
                      "type"          => "textarea_raw_html",
                      "holder"        => "h4",
                      "class"         => "vc_hidden", 
                      "heading"       => __("Title", 'cleanstart'),
                      "value"         => 'focus on what\'s <strong><span class="rotate">important, simple, innovative</span></strong>',
                      "description"   => __("Add Title", 'cleanstart'),
                      "admin_label"   => false,                                               
                  )
                  ,array(
                      "param_name"    => "subtitle",                                  
                      "type"          => "textfield",                                        
                      "holder"        => "h4",                                               
                      "class"         => "vc_hidden",                                                    
                      "heading"       => __("Subtitle", 'cleanstart'),
                      "value"         => 'and make the web a little bit prettier',                                     
                      "description"   => __("Add a subtitle (accepts HTML).", 'cleanstart'),      
                      "admin_label"   => false,                                             
                  )
                  ,array(
                      "param_name"    => "button",                                  
                      "type"          => "dropdown",                                        
                      "holder"        => "h4",                                               
                      "class"         => "vc_hidden",                                                    
                      "heading"       => __("Display button", 'cleanstart'),
                      "value"         => array('Hide'=>'0','Show'=>'1'),
                      "description"   => __("Add a button", 'cleanstart'),      
                      "admin_label"   => false                                             
                  ),
                  array(
                      "param_name"    => "button_link",
                      "type"          => "vc_link",
                      "holder"        => "h4",
                      "class"         => "vc_hidden",
                      "heading"       => __("Button text and link", 'cleanstart'),
                      "value"         => 'Buy this theme!',
                      "description"   => __("Add button text and link. Button gets its text from the value you enter in the title field.", 'cleanstart'),
                      "admin_label"   => false,                                               
                       'dependency'    => array( 
                                          'element' => 'button',  
                                          'value'   => array('1'),  
                                      )
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
                      'dependency'    => array( 
                                          'element' => 'button', 
                                          'value'   => array('1'),   
                                      )
                  )
                  ,array(
                      "param_name"    => "button_size",                                  
                      "type"          => "dropdown",                                        
                      "holder"        => "h4",                                               
                      "class"         => "vc_hidden",                                           
                      "heading"       => __("Select button class", 'cleanstart'),      
                      "value"         => array(
                        'Default'     =>'btn',
                        'Small'       =>'btn-sm',
                        'Extra Small' =>'btn-xs'
                        ),
                      "btn_menu_value"=> 'btn',                                     
                      "description"   => __("Button styling class.", 'cleanstart'),       
                      "admin_label"   => false,                                              
                      'dependency'    => array( 
                                          'element' => 'button', 
                                          'value'   => array('1'),   
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

        $this->add_script = true; // VERY IMPORTANT! This triggers loading related scripts on footer

          extract( shortcode_atts( array(
            'subtitle'         => '',
            'icon_image'       => '',
            'button'           => '0',
            'button_class'     => 'btn-primary',
            'button_size'      => 'btn',
            "button_link"      =>  'Buy this theme!'
            ), $atts ) );

    $icon_image = (!empty($icon_image)) ? wp_get_attachment_image_src( $icon_image, 'full' ) : '';
    $title      = isset( $atts['title'] ) ? $atts['title'] : '';

    $output = '<div class="call_to_action">';
    if ( isset($icon_image[0]) && $icon_image[0] !== '' ){
      $output .= '<img alt="responsive" src="' . esc_url( $icon_image[0] ) . '">';
    }

    $output .= '<h3>' . urldecode( base64_decode( $title ) ) . '</h3><h4>' . $subtitle . '</h4>';

    if ( $button === '1' ){

      $button_link = self::vc_build_link($button_link);
      $target_link = ( trim($button_link['target']) !== '' ) ? 'target="' . esc_attr($button_link['target']) . '"' : '';
      $output     .= '<a ' . $target_link . 'class="' . esc_attr( $button_size ) . ' ' . esc_attr( $button_class ) . '" href="' . esc_url($button_link['url']) . '" title="' . esc_attr( $button_link['title'] ) . '">' . $button_link['title'] . '</a>';

    }

    $output .= '</div>';

		return $output;

       }

	}
	
 endif;