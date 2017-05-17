<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M 				   (c) 2013

File Description: Price Plan shortcode

*/

if ( ! defined( 'ABSPATH' )) exit; // NO ACCESS IF DIRECT OR TEAM POST TYPE NOT EXISTS

if ( class_exists('Plethora_Shortcode') && !class_exists('Plethora_Shortcode_Priceplan') ):

  /**
   * @package Plethora Base
   */

  class Plethora_Shortcode_Priceplan extends Plethora_Shortcode { 

    public $shortcode_title       = "Priceplan Shortcode";
    public $shortcode_subtitle    = "Activate/Deactivate Priceplan Shortcode";
    public $shortcode_description = "Priceplan shortcode [description]";

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
              "base"          => 'sc_priceplan',
              "name"          => __("Priceplan", 'cleanstart'),
              "description"   => __('Add a Price Plan Block', 'cleanstart'),
              "class"         => "",
              "weight"        => 1,
              "category"      => 'Plethora Shortcodes',
              "admin_enqueue_css" => THEME_CORE_ASSETS_URI .'/admin-shortcodes.css',
              "icon"              => THEME_CORE_ASSETS_URI . '/icons/plethora_shortcodes-32x32.png', 
              "params"        => array(
                  array(
                      "param_name"    => "top_box",                                  
                      "type"          => "dropdown",                                        
                      "holder"        => "h4",                                               
                      "class"         => "vc_hidden",                                           
                      "heading"       => __("Top Box", 'cleanstart'),      
                      "value"         => array('Vector pattern'=>'vector','Image'=>'image','Solid color'=>'color'),
                      "description"   => __("Select the type of media for the top box", 'cleanstart'),       
                      "admin_label"   => false,                                              
                  )
                  ,array(
                      "param_name"    => "image",                                  
                      "type"          => "attach_image",                                        
                      "holder"        => "h4",                                               
                      "class"         => "vc_hidden",                                                  
                      "heading"       => __("Image (optional)", 'cleanstart'),      
                      "value"         => '',
                      "description"   => __("Replace vector pattern with an image", 'cleanstart'),       
                      "admin_label"   => false,                                              
                      "dependency"    => array(
                        "element" => "top_box",
                        "value"   => array('image')
                        )  
                  )
                ,array(
                      "param_name"  => "color",
                      "type"        => "colorpicker",
                      "heading"     => "Top Box Color",
                      "value"       => '#C9E1F6', 
                      "description" => "Choose a color for the top box",
                      "dependency"  => array(
                        "element" => "top_box",
                        "value"   => array("color")
                        )
                  )
                  ,array(
                      "param_name"    => "header_title",                                  
                      "type"          => "textfield",                                        
                      "holder"        => "h4",                                               
                      "class"         => "vc_hidden",                                                    
                      "heading"       => __("Price Plan Header Title", 'cleanstart'),
                      "value"         => 'Plan<strong>One</strong>',                                     
                      "description"   => __("Add a header for your price plan (accepts html)", 'cleanstart'),      
                      "admin_label"   => false,                                             
                  )
                  ,array(
                      "param_name"    => "header_subtitle",                                  
                      "type"          => "textfield",                                        
                      "holder"        => "h4",                                               
                      "class"         => "vc_hidden",                                                    
                      "heading"       => __("Price Plan Header Subtitle", 'cleanstart'),
                      "value"         => 'This is where you start',                                     
                      "btn_menu_value"=> 'This is where you start',                                  
                      "description"   => __("Add a subheader for your price plan (accepts html)", 'cleanstart'),      
                      "admin_label"   => false,                                             
                  )
                  ,array(
                      "param_name"    => "pricing",                                  
                      "type"          => "textfield",                                        
                      "holder"        => "h4",                                               
                      "class"         => "vc_hidden",                                                    
                      "heading"       => __("Pricing", 'cleanstart'),
                      "value"         => '<span>$</span>250<small>/year</small>',                                     
                      "description"   => __("Add a pricing", 'cleanstart'),      
                      "admin_label"   => false,                                             
                  )
                  ,array(
                      "param_name"    => "special",                                  
                      "type"          => "dropdown",                                        
                      "holder"        => "h4",                                               
                      "class"         => "vc_hidden",                                           
                      "heading"       => __("Special Plan", 'cleanstart'),      
                      "value"         => array('Disabled'=>'0','Enabled'=>'1'),
                      "description"   => __("Make this a special plan?", 'cleanstart'),       
                      "admin_label"   => false,                                              
                  )
                  ,array(
                      "param_name"    => "button_text",                                  
                      "type"          => "textfield",                                        
                      "holder"        => "h4",                                               
                      "class"         => "vc_hidden",                                           
                      "heading"       => __("Button Text", 'cleanstart'),      
                      "value"         => __('Get it now!', 'cleanstart'),
                      "btn_menu_value"=> __('Get it now!', 'cleanstart'),                                 
                      "description"   => __("Leave it empty, if you don't need a button", 'cleanstart'),       
                      "admin_label"   => false,                                              
                  )

                  ,array(
                      "param_name"    => "button_link",                                  
                      "type"          => "vc_link",                                        
                      "holder"        => "h4",                                               
                      "class"         => "vc_hidden",                                           
                      "heading"       => __("Button Link", 'cleanstart'),      
                      "value"         => '#',
                      "admin_label"   => false,                                              
                  )

                  ,array(
                      "param_name"    => "features",                                  
                      "type"          => "dropdown",                                        
                      "holder"        => "h4",                                               
                      "class"         => "vc_hidden",                                           
                      "heading"       => __("Number of Features", 'cleanstart'),      
                      "value"         => array('0' => '0', '1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10'),
                      "description"   => __("How many features to add?", 'cleanstart'),       
                      "admin_label"   => false
                  )
                  ,array(
                      "param_name"    => "feature_1",                                  
                      "type"          => "textfield",                                        
                      "holder"        => "h4",                                               
                      "class"         => "vc_hidden",                                                    
                      "heading"       => __("Feature #1", 'cleanstart'),
                      "value"         => 'Feature <strong>One</strong>',                                     
                      "description"   => __("Add feature description (html enabled)", 'cleanstart'),      
                      "admin_label"   => false,
                      "dependency"    => array(
                        "element" => "features",
                        "value"   => array('1','2','3','4','5','6','7','8','9','10')
                        )                                             
                  )                  
                  ,array(
                      "param_name"    => "feature_2",                                  
                      "type"          => "textfield",                                        
                      "holder"        => "h4",                                               
                      "class"         => "vc_hidden",                                                    
                      "heading"       => __("Feature #2", 'cleanstart'),
                      "value"         => 'Feature <strong>Two</strong>',                                     
                      "description"   => __("Add feature description (html enabled)", 'cleanstart'),      
                      "admin_label"   => false,
                      "dependency"    => array(
                        "element" => "features",
                        "value"   => array('2','3','4','5','6','7','8','9','10')
                        )                                             
                  )                  
                  ,array(
                      "param_name"    => "feature_3",                                  
                      "type"          => "textfield",                                        
                      "holder"        => "h4",                                               
                      "class"         => "vc_hidden",                                                    
                      "heading"       => __("Feature #3", 'cleanstart'),
                      "value"         => 'Feature <strong>Three</strong>',                                     
                      "description"   => __("Add feature description (html enabled)", 'cleanstart'),      
                      "admin_label"   => false,
                      "dependency"    => array(
                        "element" => "features",
                        "value"   => array('3','4','5','6','7','8','9','10')
                        )                                             
                  )                  
                  ,array(
                      "param_name"    => "feature_4",                                  
                      "type"          => "textfield",                                        
                      "holder"        => "h4",                                               
                      "class"         => "vc_hidden",                                                    
                      "heading"       => __("Feature #4", 'cleanstart'),
                      "value"         => 'Feature <strong>Four</strong>',                                     
                      "description"   => __("Add feature description (html enabled)", 'cleanstart'),      
                      "admin_label"   => false,
                      "dependency"    => array(
                        "element" => "features",
                        "value"   => array('4','5','6','7','8','9','10')
                        )                                             
                  )                  
                  ,array(
                      "param_name"    => "feature_5",                                  
                      "type"          => "textfield",                                        
                      "holder"        => "h4",                                               
                      "class"         => "vc_hidden",                                                    
                      "heading"       => __("Feature #5", 'cleanstart'),
                      "value"         => 'Feature <strong>Five</strong>',                                     
                      "btn_menu_value"=> 'Feature <strong>Five</strong>',                                  
                      "description"   => __("Add feature description (html enabled)", 'cleanstart'),      
                      "admin_label"   => false,
                      "dependency"    => array(
                        "element" => "features",
                        "value"   => array('5','6','7','8','9','10')
                        )                                             
                  )                  
                  ,array(
                      "param_name"    => "feature_6",                                  
                      "type"          => "textfield",                                        
                      "holder"        => "h4",                                               
                      "class"         => "vc_hidden",                                                    
                      "heading"       => __("Feature #6", 'cleanstart'),
                      "value"         => 'Feature <strong>Six</strong>',                                     
                      "description"   => __("Add feature description (html enabled)", 'cleanstart'),      
                      "admin_label"   => false,
                      "dependency"    => array(
                        "element" => "features",
                        "value"   => array('6','7','8','9','10')
                        )                                             
                  )                  
                  ,array(
                      "param_name"    => "feature_7",                                  
                      "type"          => "textfield",                                        
                      "holder"        => "h4",                                               
                      "class"         => "vc_hidden",                                                    
                      "heading"       => __("Feature #7", 'cleanstart'),
                      "value"         => 'Feature <strong>Seven</strong>',                                     
                      "description"   => __("Add feature description (html enabled)", 'cleanstart'),      
                      "admin_label"   => false,
                      "dependency"    => array(
                        "element" => "features",
                        "value"   => array('7','8','9','10')
                        )                                             
                  )                  
                  ,array(
                      "param_name"    => "feature_8",                                  
                      "type"          => "textfield",                                        
                      "holder"        => "h4",                                               
                      "class"         => "vc_hidden",                                                    
                      "heading"       => __("Feature #8", 'cleanstart'),
                      "value"         => 'Feature <strong>Eight</strong>',                                     
                      "description"   => __("Add feature description (html enabled)", 'cleanstart'),      
                      "admin_label"   => false,
                      "dependency"    => array(
                        "element" => "features",
                        "value"   => array('8','9','10')
                        )                                             
                  )                  
                  ,array(
                      "param_name"    => "feature_9",                                  
                      "type"          => "textfield",                                        
                      "holder"        => "h4",                                               
                      "class"         => "vc_hidden",                                                    
                      "heading"       => __("Feature #9", 'cleanstart'),
                      "value"         => 'Feature <strong>Nine</strong>',                                     
                      "description"   => __("Add feature description (html enabled)", 'cleanstart'),      
                      "admin_label"   => false,
                      "dependency"    => array(
                        "element" => "features",
                        "value"   => array('9','10')
                        )                                             
                  )                  
                  ,array(
                      "param_name"    => "feature_10",                                  
                      "type"          => "textfield",                                        
                      "holder"        => "h4",                                               
                      "class"         => "vc_hidden",                                                    
                      "heading"       => __("Feature #10", 'cleanstart'),
                      "value"         => 'Feature <strong>Ten</strong>',                                     
                      "description"   => __("Add feature description (html enabled)", 'cleanstart'),      
                      "admin_label"   => false,
                      "dependency"    => array(
                        "element" => "features",
                        "value"   => array('10')
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
            "top_box"         => 'vector',
            "image"           => '',
            "color"           => '#C9E1F6',
            "pricing"         => '<span>$</span>250<small>/year</small>',                                     
            "special"         => '0',                                     
            "button_text"     => '',                                     
            "button_link"     => '',                                     
            "features"        => '3',
            "feature_1"       => 'Feature <strong>One</strong>', 
            "feature_2"       => 'Feature <strong>Two</strong>', 
            "feature_3"       => 'Feature <strong>Three</strong>', 
            "feature_4"       => 'Feature <strong>Four</strong>', 
            "feature_5"       => 'Feature <strong>Five</strong>', 
            "feature_6"       => 'Feature <strong>Six</strong>', 
            "feature_7"       => 'Feature <strong>Seven</strong>', 
            "feature_8"       => 'Feature <strong>Eight</strong>', 
            "feature_9"       => 'Feature <strong>Nine</strong>', 
            "feature_10"      => 'Feature <strong>Ten</strong>' 
            ), $atts ) );

          $header_title    = isset( $atts['header_title'] ) ? $atts['header_title'] : '';
          $header_subtitle = isset( $atts['header_subtitle'] ) ? $atts['header_subtitle'] : '';

          // USER ATTRIBUTES AS VARIABLES

          $special = ($special == '1') ? 'special' : '';

          $topbox = '';

          switch ($top_box) {
            case 'image':
              $image = (!empty($image)) ? wp_get_attachment_image_src( $image, 'full' ) : '';
              $topbox  = ( $image !== '' ) ? 'background-image: url(' . $image[0] . ');' : '';
              break;
            case 'color':
              $topbox  = 'background-image: none; background-color:' . $color . ';';
              break;
          }

          $output = '<div class="pricing_plan ' . $special . ' wow fadeInUp">';
          $output .= '<h3 style="' . esc_attr($topbox) .  '">' . $header_title . '<small>' . $header_subtitle . '</small></h3>';
          $output .= '<div class="the_price">' . $pricing . '</div>';
          $output .= '<div class="the_offerings">';
          if ( $features !== '0' ){

            $features = (int)$features;

            for ($i=1; $i <= $features; $i++) { 
              $output .= "<p>" . ${ 'feature_' . $i } . "</p>";
            }

          }

          $button_link = self::vc_build_link( $button_link );
          if (!empty($button_text)) { 
            $target = ( $button_link['target'] !== '' )? 'target="'.esc_attr($button_link['target'] ).'"' : '';
            $output .= '<a  href="' . esc_url( $button_link['url'] ) . '" title="' . esc_attr( $button_link['title'] ) . '" '.$target.' class="btn btn-primary">'. $button_text . '</a>';
          }
          $output .= '</div>';
          $output .= '</div>';

          return $output;

       }

	}
	
 endif;