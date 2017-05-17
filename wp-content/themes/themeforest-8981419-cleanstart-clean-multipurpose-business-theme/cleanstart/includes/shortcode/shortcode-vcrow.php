<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M 				   (c) 2013

File Description: Row shortcode

*/

if ( ! defined( 'ABSPATH' ) ) exit; // NO DIRECT ACCESS 

$customize_vc = Plethora::option( 'customizevc-status', 1, 0, false);

if ( class_exists('Plethora_Shortcode') && !class_exists('Plethora_Shortcode_Vcrow') && $customize_vc ):

	/**
	 * @package Plethora
	 */

	class Plethora_Shortcode_Vcrow extends Plethora_Shortcode { 

      function __construct() {

          // Hook shortcode registration on init
          $this->add( $this->params() );

          // MAP PARAMETERS TO UI PANELS ( we use the params() method to get defined parameters )
          if ( is_admin() ) { 

            // This is an additional hook that checks the post content for the [vc_row] shortcode.
            // If a [vc_row] is present, it updates 'content_has_sections' meta option to true 
            add_action('save_post', array($this, 'content_has_sections'), 99);

          }
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
              "base"          => 'vc_row',
              "name"          => __("Row", 'cleanstart'),
              "description"   => __('Create an section to add content', 'cleanstart'),
              "class"         => '',
              "weight"        => 1,
              "category"      => __('Content', 'js_composer'),
              "icon"          => "icon-wpb-row",
              'is_container'            => true,
              'show_settings_on_create' => false,
              'js_view'                 => 'VcRowView',
              "params"        => array(

                    array(
                        "param_name"    => "title_header",                                  
                        "type"          => "textfield",                                        
                        "heading"       => __("Header Text", 'cleanstart'),      
                        "value"         => '',                                     
                        "description"   => __("Leave empty to remain invisible", 'cleanstart'),        
                        "admin_label"   => false,                                               
                    ),

                    array(
                        "param_name"    => "title_subheader",                                  
                        "type"          => "textfield",                                        
                        "heading"       => __("Subheader Text", 'cleanstart'),      
                        "value"         => '',                                     
                        "description"   => __("Enter a subheader text for the section", 'cleanstart'),        
                        "admin_label"   => false,                                               
                    ),

                    array(
                        "param_name"    => "title_style",                                  
                        "type"          => "dropdown",
                        "heading"       => __("Header style", 'cleanstart'),
                        "value"         => array('Fancy'=>'fancy', 'Elegant'=>'elegant'),
                        "description"   => __("Choose a layout for your header/subheader texts", 'cleanstart'),
                        "admin_label"   => false, 
                    ),

                    array(
                        "param_name"    => "background",
                        "type"          => "dropdown",
                        "heading"       => __("Color setup", 'cleanstart'),
                        "value"         => array('Light'=>'light_section', 'Dark'=>'dark_section', 'Skin colored'=>'skincolored_section'),
                        "description"   => __("Choose a color setup for this section", 'cleanstart'),
                        "admin_label"   => false, 
                    ),
                    array(
                        "param_name"    => "background_image",
                        "type"          => "attach_image",
                        "heading"       => __("Background Image", 'cleanstart'),
                        "value"         => '',
                        "description"   => __("Upload/select a background image for this section", 'cleanstart'),
                        "admin_label"   => false, 
                    ),
                    array(
                        "param_name"    => "parallax",
                        "type"          => "dropdown",
                        "heading"       => __("Parallax effect", 'cleanstart'),
                        "value"         => array('Disable'=>'off', 'Enable'=>'on'),
                        "description"   => __("Effect will be visible only if you have set a background image", 'cleanstart'),
                        "admin_label"   => false, 
                    ),
                    array(
                        "param_name"    => "top_margin",
                        "type"          => "dropdown",
                        "heading"       => __("Remove top margin", 'cleanstart'),
                        "value"         => array('No'=>'off', 'Yes'=>'on'),
                        "description"   => __("ATTENTION: select 'Yes' to remove possible top margin on top", 'cleanstart'),
                        "admin_label"   => false, 
                    ),
                     array(
                        "param_name"    => "triangles",
                        "type"          => "dropdown",
                        "heading"       => __("Top Side Corners", 'cleanstart'),
                        "value"         => array('Hide'=>'off', 'Show'=>'on'),
                        "description"   => __("Enable/disable the top side corners effect", 'cleanstart'),
                        "admin_label"   => false 
                   ),
                    array(
                        "param_name"    => "section_id",                                  
                        "type"          => "textfield",                                    
                        "heading"       => __("Section ID", 'cleanstart'),       
                        "value"         => '',                                   
                        "description"   => __("Give your section a unique ID ", 'cleanstart'),  
                        "admin_label"   => false,                                           
                    ),
                    array(
                        "param_name"    => "extra_class",                                  
                        "type"          => "textfield",                                    
                        "heading"       => __("Extra class", 'cleanstart'),       
                        "value"         => '',                                   
                        "description"   => __("Give your extra class(es) ", 'cleanstart'),  
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
              'title_header'     => '',
              'title_subheader'  => '',
              'title_style'      => 'fancy',
              'background'       => 'light',
              'background_image' => '',
              'parallax'         => 'off',
              'top_margin'       => 'off',
              'triangles'        => 'off',
              'extra_class'      => '',
              'section_id'       => ''
              ), $atts ) );

            $section_id               = ' id="' . $section_id . '" ';
            $section_class            = ' class="';
            $section_class           .= ($background != '') ? $background : 'light_section' ;
            $section_class           .= ($top_margin == 'on') ? ' following_dark' : '' ;
            $section_class           .= ($parallax == 'on') ? ' parallax' : '' ;
            $section_class           .= ( !empty( $extra_class )) ? ' '. $extra_class .'' : '' ;
            $section_class           .= '"' ;
            $background_image = (!empty($background_image)) ? wp_get_attachment_image_src( $background_image, 'full' ) : '';
            $section_background_image = (isset($background_image[0]) && $background_image[0] != '') ? ' style="background-image:url('. esc_url( $background_image[0] ) .'); background-size:cover;"' :  '' ;

            $output = '<section'.$section_id.$section_class.$section_background_image.'>';

            if ($triangles == 'on') { 
              $output .= '  <div class="container triangles-of-section">';
              $output .= '    <div class="triangle-up-left"></div>';
              $output .= '    <div class="square-left"></div>';
              $output .= '    <div class="triangle-up-right"></div>';
              $output .= '    <div class="square-right"></div>';
              $output .= '  </div>';
            }
            // Container start
            $output .= ' <div class="container">';
            $output .= '  <div class="row">';
            
            // Section title
            if ( $title_header != '') { 
                
                $output .= '<h2 class="section_header '. esc_attr( $title_style ) .' centered">';
                $output .= $title_header;
                $output .= ( $title_subheader != '' ) ? '<small>'. $title_subheader .'</small>' : '';
                $output .= '</h2>';
            }

            if( !empty( $content ) ) {
                $output .= do_shortcode( $content );
            }

            $output .= '  </div>';

            // Container end
            $output .= '  </div>';
            $output .= '</section>';

            return $output;
       }

       /** 
       * Save the 'content_has_sections' post meta option, that affects the markup exported. 
       *
       * @return array
       * @since 1.0
       *
       */
       public function content_has_sections( $post_id ) {

          global $pagenow;
          $is_postedit = in_array( $pagenow, array( 'post.php' ));
          global $typenow;
          if ( $is_postedit && ( $typenow == 'post' || $typenow == 'page' ) ) { 

            // $content = wp_unslash(!empty($_POST['content']) ? $_POST['content'] : $post_data['content'] );
            $content = (isset($_POST['content'])) ? $_POST['content'] : '' ;

            if ( has_shortcode( $content, 'vc_row' )) { 

              update_post_meta( $post_id, PLETHORA_META_PREFIX .'content_has_sections', true );

            } else {

               update_post_meta( $post_id, PLETHORA_META_PREFIX .'content_has_sections', false );
             
            }
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
              'switchable'    => false, // this should be false...we don't want to make VC unusable!
              'options_title' => 'Row Shortcode',
            );
          
          return $feature_options;
       }

	}
	
 endif;