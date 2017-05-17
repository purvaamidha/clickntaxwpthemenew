<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M 				   (c) 2013

File Description: Service Teaser shortcode

*/

if ( ! defined( 'ABSPATH' )) exit; // NO ACCESS IF DIRECT OR TEAM POST TYPE NOT EXISTS

if ( class_exists('Plethora_Shortcode') && !class_exists('Plethora_Shortcode_ServiceTeaser') ):

  /**
   * @package Plethora Base
   */

  class Plethora_Shortcode_ServiceTeaser extends Plethora_Shortcode { 

    public $shortcode_title       = "Service Teaser Shortcode";
    public $shortcode_subtitle    = "Activate/Deactivate Service Teaser Shortcode";
    public $shortcode_description = "Service Teaser shortcode [description]";

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
              "base"          => 'sc_serviceteaser',
              "name"          => __("Service Teaser", 'cleanstart'),
              "description"   => __('Add a Service Teaser Block', 'cleanstart'),
              "class"         => "",
              "weight"        => 1,
              "category"      => 'Plethora Shortcodes',
              "admin_enqueue_css" => THEME_CORE_ASSETS_URI .'/admin-shortcodes.css',
              "icon"              => THEME_CORE_ASSETS_URI . '/icons/plethora_shortcodes-32x32.png', 
              "params"        => array(
                  array(
                      "param_name"    => "image",                                  
                      "type"          => "attach_image",                                        
                      "holder"        => "h4",                                               
                      "class"         => "vc_hidden", 
                      "heading"       => __("Image", 'cleanstart'),      
                      "value"         => '',
                      "description"   => __("Put some image", 'cleanstart'),       
                      "admin_label"   => false,                                              
                  )
                  ,array(
                      "param_name"    => "image_link",
                      "type"          => "vc_link",
                      "holder"        => "h4",
                      "class"         => "vc_hidden", 
                      "heading"       => __("Image link", 'cleanstart'),
                      "value"         => '#',
                      "description"   => __("Add an image link.", 'cleanstart'),
                      "admin_label"   => false                                               
                 )
                  ,array(
                      "param_name"    => "title",                                  
                      "type"          => "textfield",                                        
                      "holder"        => "h3",                                               
                      "class"         => "",                                                    
                      "heading"       => __("Title", 'cleanstart'),
                      "value"         => 'Design',                                     
                      "description"   => __("Enter title.", 'cleanstart'),      
                      "admin_label"   => false,                                             
                  )
                  ,array(
                      "param_name"    => "content",
                      "type"          => "textarea_html",
                      "holder"        => "h4",
                      "class"         => "vc_hidden", 
                      "heading"       => __("Text Content", 'cleanstart'),
                      "value"         => 'Quisque at lectus leo, nec placerat mi. Curabitur egestas eleifend interdum. Suspendisse potenti. Suspendisse nec risus fermentum.',
                      "description"   => __("Add text content.", 'cleanstart'),
                      "admin_label"   => false,                                               
                  )
                  ,array(
                      "param_name"    => "button_enable",                                  
                      "type"          => "dropdown",                                        
                      "holder"        => "h4",                                               
                      "class"         => "vc_hidden",                                         
                      "heading"       => __("Display button", 'cleanstart'),      
                      "value"         => array('Hide'=>'1','Show'=>'2'),
                      "description"   => __("Display a button", 'cleanstart'),       
                      "admin_label"   => false,                                              
                  )
                  ,array(
                      "param_name"    => "button_link",
                      "type"          => "vc_link",
                      "holder"        => "h4",
                      "class"         => "vc_hidden", 
                      "heading"       => __("Button link", 'cleanstart'),
                      "value"         => '#',
                      "description"   => __("Add a button link.", 'cleanstart'),
                      "admin_label"   => false,                                               
                       'dependency'    => array( 
                                          'element' => 'button_enable',  
                                          'value'   => array('2'),  
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
                                          'element' => 'button_enable', 
                                          'value'   => array('2'),   
                                      )
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
                      "description"   => __("Button size", 'cleanstart'),       
                      "admin_label"   => false,                                              
                      'dependency'    => array( 
                                          'element' => 'button_enable', 
                                          'value'   => array('2'),   
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

        $this->add_script = true; 

          extract( shortcode_atts( array( 
            'title'         => 'Design',
            'button_enable' => '1',
            'image'         => '',
            'image_link'    => '',
            'button_link'   => '#',
            'button_class'  => 'btn-primary',
            'button_size'   => 'btn'
            ), $atts ) );

          $image = (!empty($image)) ? wp_get_attachment_image_src( $image, 'full' ) : '';
          $content = wpb_js_remove_wpautop($content, true);

          $output = '<div class="service_teaser vertical">';
          if ( $image !== '' ){
            $image_link = self::vc_build_link($image_link);
            $output .= '<div class="service_photo">';
            if ( $image_link['url'] !== '' ) { $output .= '<a href="'. esc_url( $image_link['url'] ) .'" title="' . esc_attr( $image_link['title'] ) . '" target="' . esc_attr( $image_link['target'] ) . '">'; }
            $output .= '<figure style="background-image:url(' . esc_url( $image[0] ) . ')"></figure>';
            if ( $image_link['url'] !== '' ) { $output .= '</a>'; }
            $output .= '</div>';
          }
          $output .= '<div class="service_details">';
          if ( $title !== '' ){
            $output .= '<h2>' . $title . '</h2>';
          }
          if ( $content !== '' ){
            $output .= $content;
          }  
          $button_link = self::vc_build_link( $button_link );
          if ( $button_enable == '2' && $button_link['title'] !== "" ){

            $target = ( trim($button_link['target']) !== '' ) ? 'target="'. esc_attr( $button_link['target'] ).'"' : "";
            $output .= '<a class="' . esc_attr( $button_size ) . ' ' . esc_attr( $button_class ) . '" title="' . esc_url( $button_link['title'] ) . '" '.$target.' href="' . esc_url( $button_link['url'] ) . '">' . $button_link['title'] . '</a>';
          }
          $output .= '</div></div>';

          return $output;

       }

	}
	
 endif;