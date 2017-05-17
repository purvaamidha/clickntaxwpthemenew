<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M 				   (c) 2013

File Description: Clients shortcode

*/

if ( ! defined( 'ABSPATH' )) exit; // NO ACCESS IF DIRECT OR TEAM POST TYPE NOT EXISTS

if ( class_exists('Plethora_Shortcode') && !class_exists('Plethora_Shortcode_Clients') ):

  /**
   * @package Plethora Base
   */

  class Plethora_Shortcode_Clients extends Plethora_Shortcode { 

    public $shortcode_title       = "Clients Shortcode";
    public $shortcode_subtitle    = "Activate/Deactivate Clients Shortcode";
    public $shortcode_description = "Clients shortcode [description]";

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
              "base"          => 'sc_clients',
              "name"          => __("Clients", 'cleanstart'),
              "description"   => __('Our Clients Section', 'cleanstart'),
              "class"         => "",
              "weight"        => 1,
              "category"      => 'Plethora Shortcodes',
              "admin_enqueue_css" => THEME_CORE_ASSETS_URI .'/admin-shortcodes.css',
              "icon"              => THEME_CORE_ASSETS_URI . '/icons/plethora_shortcodes-32x32.png', 
              "params"        => array(
                  array(
                      "param_name"    => "client_images",                                  
                      "type"          => "attach_images",                                        
                      "holder"        => "h3",                                               
                      "class"         => "",                                                  
                      "heading"       => __("Client images", 'cleanstart'),      
                      "value"         => '',
                      "description"   => __("Select client images and set Title and (optional) URL as Caption.", 'cleanstart'),       
                      "admin_label"   => false                                              
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
            'client_images' => ''
            ), $atts ) );

          $output = '<div class="clients_list">';
          $client_images = explode( ",", $client_images );
          foreach ( $client_images as $key => $value) {
            $client_image     = wp_prepare_attachment_for_js($value);
            $image_caption    = $client_image['caption'] ? $client_image['caption'] : '#'; 
            $image_url_target = $image_caption != '#' ? ' target="_blank"' : '';
            $image_title      = $client_image['title']; 
            $output          .= '<a href="' . esc_url( $image_caption ). '"'. $image_url_target .'><img src="' . esc_url( $client_image['url'] ) . '" alt="'. esc_attr( $image_title ) .'"></a>';
          }
          $output .= '</div>';

          return $output;

       }

	}
	
 endif;