<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M 				   (c) 2013

File Description: Horizontal Teaser shortcode

*/

if ( ! defined( 'ABSPATH' )) exit; // NO ACCESS IF DIRECT OR TEAM POST TYPE NOT EXISTS

if ( class_exists('Plethora_Shortcode') && !class_exists('Plethora_Shortcode_Horizontalteaser') ):

  /**
   * @package Plethora Base
   */

  class Plethora_Shortcode_Horizontalteaser extends Plethora_Shortcode { 

    public $shortcode_title       = "Horizontal Teaser";
    public $shortcode_subtitle    = "Activate/Deactivate Horizontal Teaser Shortcode";
    public $shortcode_description = "A Horizontal Teaser with text and media.";
    
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
              "base"              => 'sc_Horizontalteaser',
              "name"              => $this->shortcode_title,
              "description"       => $this->shortcode_description,
              "class"             => "",
              "weight"            => 1,
              "category"          => 'Plethora Shortcodes',
              "admin_enqueue_css" => THEME_CORE_ASSETS_URI .'/admin-shortcodes.css',
              "icon"              => THEME_CORE_ASSETS_URI . '/icons/plethora_shortcodes-32x32.png', 
              "params"            => array(
                  array(
                      "param_name"    => "title",                                  
                      "type"          => "textfield",                                        
                      "holder"        => "h3",                                               
                      "class"         => "",                                                    
                      "heading"       => __("Title", 'cleanstart'),
                      "value"         => 'We care for our work',                                     
                      "description"   => __("Place your title", 'cleanstart'),      
                      "admin_label"   => false,                                             
                  )
                 ,array(
                      "param_name"    => "content",
                      "type"          => "textarea_html",
                      "holder"        => "h4",
                      "class"         => "vc_hidden", 
                      "heading"       => __("Text content", 'cleanstart'),
                      "value"         => '<p>Vivamus vestibulum neque quis nunc convallis venenatis. Nulla tristique lorem sit amet ipsum ornare sit amet feugiat nulla condimentum. Sed faucibus volutpat nunc, at ullamcorper augue elementum id. Quisque at lectus leo, nec placerat mi. Curabitur egestas eleifend interdum. Suspendisse potenti. Suspendisse nec risus. </p><p>Curabitur egestas eleifend interdum. Suspendisse potenti. Suspendisse nec risus. Vivamus vestibulum neque quis nunc convallis venenatis. Nulla tristique lorem sit amet ipsum ornare sit amet feugiat nulla condimentum. </p>',
                      "description"   => __("Place your text content here (accepts html)", 'cleanstart'),
                      "admin_label"   => false,                                               
                  )
                  ,array(
                      "param_name"    => "text_width",                                  
                      "type"          => "dropdown",                                        
                      "holder"        => "h4",                                               
                      "class"         => "vc_hidden",                                           
                      "heading"       => __("Text section width", 'cleanstart'),      
                      "value"         => array('30%'=>'4','50%'=>'6','70%'=>'8'),
                      "description"   => __("Set your text section's width", 'cleanstart'),       
                      "admin_label"   => false,                                              
                  )
                  ,array(
                      "param_name"    => "textposition",                                  
                      "type"          => "dropdown",                                        
                      "holder"        => "h4",                                               
                      "class"         => "vc_hidden",                                           
                      "heading"       => __("Text content position", 'cleanstart'),      
                      "value"         => array('Left'=>'left','Right'=>'right'),
                      "description"   => __("Position your text content.", 'cleanstart'),       
                      "admin_label"   => false,                                              
                  )
                 ,array(
                      "param_name"    => "media_type",                                  
                      "type"          => "dropdown",                                        
                      "holder"        => "h4",                                               
                      "class"         => "vc_hidden",                                                    
                      "heading"       => __("Select type for the media section", 'cleanstart'),
                      "value"         => array('Video'=>'video','Image Compare'=>'2020','Image'=>'image'),
                      "description"   => __("Embed video", 'cleanstart'),      
                      "admin_label"   => false                                             
                  )
                  ,array(
                      "param_name"    => "video_link",                                  
                      "type"          => "textfield",                                        
                      "holder"        => "h4",                                               
                      "class"         => "vc_hidden",                                                    
                      "heading"       => __("Video link", 'cleanstart'),
                      "value"         => 'http://player.vimeo.com/video/71409522?title=0&amp;byline=0&amp;portrait=0',                                     
                      "description"   => __("Add a video link.<br><span style='color:red'>For YouTube videos</span> you must use the <strong>http://www.youtube.com/embed/myvideo</strong> format.<br><strong>Example: https://www.youtube.com/watch?v=j6pwTk4D8WI -> https://www.youtube.com/embed/j6pwTk4D8WI</strong></span>", 'cleanstart'),      
                      "admin_label"   => false,                                             
                      'dependency'    => array( 
                                          'element' => 'media_type', 
                                          'value' => array('video'),   
                                      )
                  )

                  /****** MEDIA TYPE: TWENTY TWENTY ******/

                  ,array(
                      "param_name"    => "before_image",                                  
                      "type"          => "attach_image",                                        
                      "holder"        => "h4",                                               
                      "class"         => "vc_hidden",                                                 
                      "heading"       => __("Before Image", 'cleanstart'),      
                      "value"         => '',
                      "description"   => __("Upload before-image", 'cleanstart'),       
                      "admin_label"   => false,                                              
                      'dependency'    => array( 
                                          'element' => 'media_type', 
                                          'value' => array('2020'), 
                      )
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
                      'dependency'    => array( 
                                          'element' => 'media_type', 
                                          'value' => array('2020'), 
                      )
                  )
                  ,array(
                      "param_name"    => "default_offset",                                  
                      "type"          => "textfield",                                        
                      "holder"        => "h4",                                               
                      "class"         => "vc_hidden",                                                 
                      "heading"       => __("Image offset", 'cleanstart'),      
                      "value"         => '0.5',
                      "description"   => __("Set the default split offset", 'cleanstart'),       
                      "admin_label"   => false,                                              
                      'dependency'    => array( 
                                          'element' => 'media_type', 
                                          'value' => array('2020'), 
                      )
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
                      'dependency'    => array( 
                                          'element' => 'media_type', 
                                          'value' => array('2020'), 
                      )
                  )

                  /****** MEDIA TYPE: IMAGE ******/

                  ,array(
                      "param_name"    => "image",                                  
                      "type"          => "attach_image",                                        
                      "holder"        => "h4",                                               
                      "class"         => "vc_hidden",                                                  
                      "heading"       => __("Image", 'cleanstart'),      
                      "value"         => '',
                      "description"   => __("Put some image", 'cleanstart'),       
                      "admin_label"   => false,    
                      'dependency'    => array( 
                                          'element' => 'media_type', 
                                          'value' => array('image'),   
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
            'image'         => '',
            'title'         => 'We care for our work',                                     
            'text_width'    => '4',
            'textposition'  => 'left',
            'media_type'    => 'video',
            'video_link'    => 'http://player.vimeo.com/video/71409522?title=0&amp;byline=0&amp;portrait=0',
            'before_image'  => '',
            'after_image'   => '',
            'default_offset'=> '0.5',
            'orientation'   => 'horizontal'
            ), $atts ) );


          // ADD SCRIPTS 
              // Prepare array for script registration according to wp_register_script usage. 
              //if (!is_admin()) {
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
              //}

              // Note: scripts are loaded only when the shortcode is visible in frontend. You may add more than one

          // ADD STYLES 
              //if (!is_admin()) {
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
              //}

          $image = (!empty($image)) ? wp_get_attachment_image_src( $image, 'full' ) : '';

          $output = '<div class="row horizontal_teaser">';

          $horizontal_teaser_media_width = ( $text_width === '4' ) ? '8' : ( ( $text_width === '6' ) ? '6' : '4' );

          // TEXT
          $content = wpb_js_remove_wpautop($content, true);
          $horizontal_teaser_text = '<div class="col-sm-12 col-md-' . $text_width . ' horizontal_teaser_text_' . $textposition . '"><h3>' . $title . '</h3>' . $content . '</div>';

          // VIDEO / IMAGE / 2020
          $media_position          = ( $textposition === 'left' ) ? 'right' : 'left';
          $horizontal_teaser_media = '<div class="col-sm-12 col-md-' . $horizontal_teaser_media_width . ' horizontal_teaser_media_' .  $media_position . '">';

          switch ( $media_type ) {
            case 'video':
              $horizontal_teaser_media .= '<iframe class="video_iframe" src="' . esc_url( $video_link ) . '"></iframe>';
              break;

            case '2020':
              $before_image = (!empty($before_image)) ? wp_get_attachment_image_src( $before_image, 'full' ) : '';
              $after_image  = (!empty($after_image)) ? wp_get_attachment_image_src( $after_image, 'full' ) : '';
                $horizontal_teaser_media .= '<div class="twentytwenty-container">';
                $horizontal_teaser_media .= '<img src="'. esc_url( $before_image[0] ) .'" alt="before" />';
                $horizontal_teaser_media .= '<img src="' . esc_url ( $after_image[0] ) . '" alt="after" />';
                $horizontal_teaser_media .= '</div>';
                $horizontal_teaser_media .= '<script>';
                $horizontal_teaser_media .= 'jQuery(window).load(function(){';
                $horizontal_teaser_media .= 'var $twentytwentyContainer = jQuery(".twentytwenty-container");';
                $horizontal_teaser_media .= 'if ( $twentytwentyContainer.length) {
                   $twentytwentyContainer.twentytwenty({ 
                    default_offset_pct: "' . $default_offset . '", 
                    orientation: "' . $orientation . '"
                  });
                };';
                $horizontal_teaser_media .= '});';
                $horizontal_teaser_media .= '</script>';
              break;

            case 'image':
              $horizontal_teaser_media.= '<figure style="background-image:url(' . esc_url($image[0]) . ')"> </figure>';
              break;

          }

          $horizontal_teaser_media .= '</div>';
          $output .= ( $textposition === 'left' ) ? $horizontal_teaser_text . $horizontal_teaser_media : $horizontal_teaser_media . $horizontal_teaser_text;
          $output .= '</div>';

          return $output;

       }

	}
	
 endif;