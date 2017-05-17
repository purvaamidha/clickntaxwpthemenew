<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M            (c) 2013

File Description: Features Teaser shortcode

*/

if ( ! defined( 'ABSPATH' )) exit; // NO ACCESS IF DIRECT OR TEAM POST TYPE NOT EXISTS

if ( class_exists('Plethora_Shortcode') && !class_exists('Plethora_Shortcode_FeaturesTeaser') ):

  /**
   * @package Plethora Base
   */

  class Plethora_Shortcode_FeaturesTeaser extends Plethora_Shortcode { 

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
              'options_title'    => 'Features Teaser shortcode',
              'options_subtitle' => 'Activate/deactivate Features Teaser shortcode',
              'options_desc'     => 'Add a Features Teaser Block',
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
              "base"              => 'sc_featureteaser',
              "name"              => __("Features Teaser", 'cleanstart'),
              "description"       => __('Add a Features Teaser Block', 'cleanstart'),
              "class"             => "",
              "weight"            => 1,
              "category"          => 'Plethora Shortcodes',
              'admin_enqueue_js'       => array(), 
              'admin_enqueue_css'       => array( 
                  THEME_CORE_ASSETS_URI .'/admin-shortcodes.css',
                  THEME_ASSETS_URI . '/css/icon-picker.css', 
                  THEME_ASSETS_URI . '/fonts/font-awesome-4/css/font-awesome.css' 
                ),
              "icon"              => THEME_CORE_ASSETS_URI . '/icons/plethora_shortcodes-32x32.png', 
              "params"            => array(

                  /*** ICON / IMAGE SWITCHER ***/

                  array(
                      "param_name"    => "image_font_selector",
                      "type"          => "dropdown",
                      "heading"       => __('Select Image or Icon', 'cleanstart'),
                      "value"         => array( 
                        __('Image', 'cleanstart') =>'image',
                        __('Icon', 'cleanstart')  => 'icon'
                        ),
                      "btn_menu_value"=> '',
                      "description"   => __("Select whether to display an image or an icon.", 'cleanstart')
                  )

                  /*** ICON PICKER ***/

                  ,array(
                      "param_name"    => "iconpicker",
                      "type"          => "iconpicker",
                      "heading"       => __('Select Icon', 'cleanstart'),
                      "description"   => __("Select icon to display.", 'cleanstart'),
                      'dependency'    => array( 
                                          'element' => 'image_font_selector', 
                                          'value'   => array('icon'),  
                                      )
                  )
                  ,array(
                      "param_name"  => "icon_color",
                      "type"        => "colorpicker",
                      "heading"     => "Top Box Color",
                      "value"       => method_exists('Plethora', 'option') ? Plethora::option('skin-color')  : '#428BCA' , 
                      "description" => "Choose a color for the top box",
                      'dependency'  => array( 
                                          'element' => 'image_font_selector', 
                                          'value'   => array('icon'),  
                                      )
                  )

                  /*** IMAGE CHOOSER ***/

                  ,array(
                      "param_name"    => "image",                                  
                      "type"          => "attach_image",                                        
                      "holder"        => "h4",                                               
                      "class"         => "vc_hidden",                                                 
                      "heading"       => __("Image", 'cleanstart'),      
                      "value"         => '',
                      "description"   => __("Image to display", 'cleanstart'),       
                      "admin_label"   => false,                                              
                      'dependency'    => array( 
                                          'element' => 'image_font_selector', 
                                          'value' => array('image'),   
                                      )
                  )
                  ,array(
                      "param_name"    => "image_link",
                      "type"          => "vc_link",
                      "holder"        => "h4",
                      "class"         => "vc_hidden", 
                      "heading"       => __("Image/Icon link", 'cleanstart'),
                      "value"         => '#',
                      "description"   => __("Enter a link for the image/icon.", 'cleanstart'),
                      "admin_label"   => false,                                               
                 )
                 ,array(
                      "param_name"    => "title",                                  
                      "type"          => "textfield",                                        
                      "holder"        => "h3",                                               
                      "class"         => "",                                                 
                      "heading"       => __("Title", 'cleanstart'),
                      "value"         => '',                                     
                      "description"   => __("Add a title (accepts html)", 'cleanstart'),      
                      "admin_label"   => false,                                             
                  )
                  ,array(
                      "param_name"    => "content",
                      "type"          => "textarea_html",
                      "holder"        => "h4",
                      "class"         => "vc_hidden",
                      "heading"       => __("Text Content", 'cleanstart'),
                      "value"         => 'Your text content here.',
                      "description"   => __("Add a description text for your price plan (accepts html)", 'cleanstart'),
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
            'image_font_selector' => 'image',
            'title'               => '',
            'button_link_1'       => '#',
            'image'               => '',
            'image_link'          => '',
            'icon_selector'       => '',
            'iconpicker'          => '',
            'icon_color'          => method_exists('Plethora', 'option') ? Plethora::option('skin-color')  : '#428BCA'
            ), $atts ) );

          /*** GET IMAGE ALT ATTRIBUTE ***/
          $image_id   = $image; 
          $alt        = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
          $alt        = ( count( $alt ) ) ? $alt : '';  
          
          $image      = (!empty($image)) ? wp_get_attachment_image_src( $image, 'full' ) : '';
          $image_link = self::vc_build_link( $image_link );

          $content = wpb_js_remove_wpautop($content, true);

          $output  = "<div class='feature_teaser'>\n";

          if ( $image_font_selector !== 'icon' && $image !== '' ){
            if ( $image_link['url'] !== '') { $output .= '<a href="' . esc_url( $image_link['url'] ) . '" target="' . esc_attr( $image_link['target'] ) . '" title="' . esc_attr( $image_link['title'] ) . '">'; }
            $output .= "  <img alt='" . $alt . "' src='" . esc_url( $image[0] ). "'>\n";
            if ( $image_link['url'] !== '') { $output .= '</a>'; }
          } elseif ( $iconpicker !== '' ) {
              $selected_icon = explode( '|', $iconpicker ); 
              $selected_icon = $selected_icon[0].' '.$selected_icon[1];
              if ( $image_link['url'] !== '') { $output .= '<a href="' . esc_url( $image_link['url'] ) . '" target="' . esc_attr( $image_link['target'] ) . '" title="' . esc_attr( $image_link['title'] ) . '">'; }
              $output .= '<i class="' . $selected_icon . '" style="font-size:180px;color:'.$icon_color.'"></i>';
              if ( $image_link['url'] !== '') { $output .= '</a>'; }
          }

          $output .= ( $title !== "" ) ?"  <h3>" . $title . "</h3>\n" : "";
          $output .= ( $content !== "" ) ? $content . "\n" : "";
          $output .= "</div>";

          return $output;

       }

  }
  
 endif;