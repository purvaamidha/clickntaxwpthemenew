<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M 				   (c) 2013

File Description: Contact Card shortcode

*/

if ( ! defined( 'ABSPATH' )) exit; // NO ACCESS IF DIRECT OR TEAM POST TYPE NOT EXISTS

if ( class_exists('Plethora_Shortcode') && !class_exists('Plethora_Shortcode_Contactcard') ):

  /**
   * @package Plethora Base
   */

  class Plethora_Shortcode_Contactcard extends Plethora_Shortcode { 

    public $shortcode_title       = "Contact Card Shortcode";
    public $shortcode_subtitle    = "Activate/Deactivate Contact Card Shortcode";
    public $shortcode_description = "Contact Card shortcode";

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
              "base"          => 'sc_contactcard',
              "name"          => __("Contact Card", 'cleanstart'),
              "description"   => __('Contact information block.', 'cleanstart'),
              "class"         => "",
              "weight"        => 1,
              "category"      => 'Plethora Shortcodes',
              "admin_enqueue_css" => THEME_CORE_ASSETS_URI .'/admin-shortcodes.css',
              "icon"              => THEME_CORE_ASSETS_URI . '/icons/plethora_shortcodes-32x32.png', 
              "params"        => array(

                  array(
                      "param_name"    => "brand_logo",                                  
                      "type"          => "attach_image",                                        
                      "holder"        => "h4",                                               
                      "class"         => "vc_hidden",                                                  
                      "heading"       => __("Some Image", 'cleanstart'),      
                      "value"         => '',
                      "description"   => __("Put some image", 'cleanstart'),       
                      "admin_label"   => false,                                              
                  )
                  ,array(
                      "param_name"    => "brand_name",                                  
                      "type"          => "textfield",                                        
                      "holder"        => "h3",                                               
                      "class"         => "",                                                    
                      "heading"       => __("Company name", 'cleanstart'),
                      "value"         => 'PLETHORA THEMES',                                     
                      "description"   => __("Company name (accepts html)", 'cleanstart'),      
                      "admin_label"   => false,                                             
                  )
                  ,array(
                      "param_name"    => "industry",                                  
                      "type"          => "textfield",                                        
                      "holder"        => "h4",                                               
                      "class"         => "vc_hidden",                                                    
                      "heading"       => __("Industry", 'cleanstart'),
                      "value"         => 'Web-Development Company',                                     
                      "description"   => __("Company description (accepts html)", 'cleanstart'),      
                      "admin_label"   => false,                                             
                  )
                  ,array(
                      "param_name"    => "content",
                      "type"          => "textarea_html",
                      "holder"        => "h4",
                      "class"         => "vc_hidden", 
                      "heading"       => __("Contact information", 'cleanstart'),
                      "value"         => '795 Folsom Ave, Suite 600<br>San Francisco, CA 94107<br><abbr title="Phone">P:</abbr> (123) 456-7890<br><abbr title="Email">E:</abbr> <a href="mailto:#">first.last@example.com</a>',
                      "description"   => __("Add phone, email, Skype, etc. (accepts html)", 'cleanstart'),
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
            'brand_name' => 'PLETHORA THEMES',
            'brand_logo' => '',
            'industry'   => 'Web-Development Company'
            ), $atts ) );

          $brand_logo = (!empty($brand_logo)) ? wp_get_attachment_image_src( $brand_logo, 'full' ) : '';
          $content = wpb_js_remove_wpautop($content, true);

          $output  = '<div class="team_member office_address">'; 
          $output .= ( isset($brand_logo[0]) && $brand_logo[0] !== '' ) ? '<img src="' . esc_url($brand_logo[0]) . '"  alt="'. esc_attr($brand_name).'">' : '';
          $output .= ( trim($brand_name) !== '' )? '<h5>' . $brand_name . '</h5>' : '';
          $output .= ( trim($output) !== '' ) ? '<small>' . $industry . '</small><br><br>' : '';
          $output .= $content;
          $output .= '</div>';

          return $output;

       }

	}
	
 endif;