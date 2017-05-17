<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M 				   (c) 2013

File Description: Gallery Grid shortcode

*/

if ( ! defined( 'ABSPATH' ) ) exit; // NO DIRECT ACCESS 

if ( class_exists('Plethora_Shortcode') && !class_exists('Plethora_Shortcode_Gallerygrid')):

	/**
	 * @package Plethora Base
	 */

	class Plethora_Shortcode_Gallerygrid extends Plethora_Shortcode { 

    	 function __construct() {

          // REGISTER SHORTCODE
 
              // Hook shortcode registration on init
              $this->add( $this->params() );

          // ADD SCRIPTS 
              // Prepare array for script registration according to wp_register_script usage. 
              if (!is_admin()) {
                $this->add_script( array(
                  array(
                    'handle'    => 'isotope-plethora', 
                    'src'       => THEME_ASSETS_URI . '/js/isotope/jquery.isotope.min.js', 
                    'deps'      => array( 'jquery' ), 
                    'ver'       => '1.0', 
                    'in_footer' => true
                  ),
                   array(
                    'handle'    => 'imagelightbox-plethora', 
                    'src'       => THEME_ASSETS_URI . '/js/imagelightbox.min.js', 
                    'deps'      => array( 'jquery' ), 
                    'ver'       => '1.0', 
                    'in_footer' => true
                  ),
                 
                ));
              }

              // Prepare array for script registration according to wp_register_script usage. 

              if (!is_admin()) {
              // Prepare shortcode related styles array according to wp_register_style usage (may add more than one)
                $this->add_style( array(
                  array(
                    'handle'    => 'isotope-plethora', 
                    'src'       => THEME_ASSETS_URI . '/js/isotope/css/style.css', 
                    'deps'      => array(),  
                    'ver'       => false,    
                    'media'     => 'all'     
                  ),
                  array(
                    'handle'    => 'imagelightbox-plethora', 
                    'src'       => THEME_ASSETS_URI . '/css/imagelightbox.css', 
                    'deps'      => array(),  
                    'ver'       => false,    
                    'media'     => 'all'     
                  ),
                ));           
              }

              // Note: scripts are loaded only when the shortcode is visible in frontend. You may add more than one

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
              'switchable' => true,
              'options_title' => 'Gallery Grid shortcode',
              'options_subtitle' => 'Activate/deactivate gallery grid shortcode',
              'version' => '1.0'
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
              "base"              => 'sc_gallerygrid',
              "name"              => __("Gallery Grid", 'cleanstart'),
              "description"       => __('Build a custom gallery grid', 'cleanstart'),
              "class"             => "",
              "weight"            => 1,
              "category"          => 'Plethora Shortcodes',
              "admin_enqueue_css" => THEME_CORE_ASSETS_URI .'/admin-shortcodes.css',
              "icon"              => THEME_CORE_ASSETS_URI . '/icons/plethora_shortcodes-32x32.png', 
              "params"            => array(
                  array(
                      "param_name"    => "images",
                      "type"          => "attach_images",
                      "heading"       => __("Select images", 'cleanstart'),
                      "description"   => __("Multiple images selection", 'cleanstart'),
                      "admin_label"   => false,                                               
                  ),
                  array(
                      "param_name"    => "layout",
                      "type"          => "dropdown",
                      "heading"       => __("Grid layout", 'cleanstart'),
                      "value"         => array(__('Classic', 'cleanstart') =>'classic', __('Masonry', 'cleanstart') =>'masonry'),
                      "description"   => __("Select the desired post grid layout", 'cleanstart')
                  ),

                  array(
                      "param_name"    => "layout_columns",
                      "type"          => "dropdown",
                      "heading"       => __("Grid columns", 'cleanstart'),
                      "value"         => array('2' => '2', '3' => '3', '4' => '4'),
                      "description"   => __("Set the number of grid columns you need", 'cleanstart')
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

          $this->add_script = true; 
          $gallerygrid_id   = mt_rand( 1,5000 ); 

          extract( shortcode_atts( array( 
            'images'         => '',
            'layout'         => 'masonry',
            'layout_columns' => '3',
            ), $atts ) );

          
          // Set layout class value
          $val_layout = ($layout == 'masonry') ? 'portfolio_masonry' : 'portfolio_strict';
          // Set columns valueS
          switch ( $layout_columns ) {
              case '2':
                $val_cols = '6';
                $thumbsize = 'large';
                  break;
              case '3':
                $val_cols = '4';
                $thumbsize = 'large';
                  break;
              case '4':
                $val_cols = '3';
                $thumbsize = 'large';
                  break;
              default:
                $val_cols = '3';
                $thumbsize = 'large';
          }
          $section_images = '';
          if( !empty($images) ) {

            $images = explode(',', $images);
            foreach ($images as $key=>$image_id) { 
               
               $thumb_url  = wp_get_attachment_image_src( $image_id,  $thumbsize) ;
               $image_url  = wp_get_attachment_image_src( $image_id,  'full') ;
               if ( $thumb_url == false ) { break; } // Go to the next if the image was deleted
              
               $image_info    = get_post( $image_id );
               $image_title   = $image_info->post_title;
               $image_descr   = $image_info->post_content;
               $image_caption = $image_info->post_excerpt; // GET Alt: = get_post_meta( $image_id , '_wp_attachment_image_alt', true);

               // Prepare images section
                if ($val_layout == 'portfolio_strict') { 

                    $section_images .= '<div class="col-xs-12 col-sm-6 col-md-'. $val_cols .' col-lg-'. $val_cols .'">'."\n";
                    $section_images .= '     <div class="portfolio_item">'."\n"; 
                    $section_images .= '       <a href="'. esc_url($image_url[0]) .'" class="lightbox_gallery" data-caption="'. esc_attr($image_caption) .'" data-description="' . esc_attr($image_descr) . '" data-imagelightbox="gallery">'."\n";
                    $section_images .= '          <figure style="background-image:url('. esc_url($thumb_url[0]) .')">'."\n";
                    $section_images .= '               <figcaption>'."\n";
                    $section_images .= '                 <div class="portfolio_description">'."\n";
                    $section_images .= '                    <h3>'. $image_title  .'</h3>'."\n";
                    $section_images .= '                    <span class="cross"></span>'."\n";
                    $section_images .= '                    <p>'. $image_caption .'</p>'."\n";
                    $section_images .= '                 </div>'."\n";
                    $section_images .= '               </figcaption>'."\n";
                    $section_images .= '          </figure>'."\n";
                    $section_images .= '       </a>'."\n";
                    $section_images .= '      </div>'."\n";
                    $section_images .= '</div>'."\n";

                } else { 

                    $section_images .= '          <div class="col-sm-'. $val_cols .' col-md-'. $val_cols .'">'."\n";
                    $section_images .= '             <div class="portfolio_item">'."\n";
                    $section_images .= '               <a href="'. esc_url($image_url[0]) .'" class="lightbox_gallery" data-caption="'. esc_attr($image_caption) .'" data-description="' . esc_attr($image_descr) . '" data-imagelightbox="gallery">'."\n";
                    $section_images .=                    '<img src="'. esc_url($thumb_url[0]) .'" alt="'. esc_attr($image_title) .'" />'."\n";
                    $section_images .= '                   <div class="overlay">'."\n";
                    $section_images .= '                      <div class="desc">'."\n";
                    $section_images .= '                         <h3>'. $image_title  .'</h3>'."\n";
                    $section_images .= '                         <span class="cross"></span>'."\n";
                    $section_images .= '                         <p>'. $image_caption .'</p>'."\n";
                    $section_images .= '                      </div>'."\n";
                    $section_images .= '                   </div>'."\n";
                    $section_images .= '               </a>'."\n";
                    $section_images .= '             </div>'."\n";
                    $section_images .= '          </div>'."\n";
                }

            }

          }



         
          $section_filters = "";

          $initscript = '<script>';
            // cache container
          $initscript .= 'jQuery(window).load(function() {'."\n";
          $initscript .= '"use strict"; '."\n";
          $initscript .= '  var container = jQuery(\'#cont_'. $gallerygrid_id  .'\'); '."\n";
            // initialize isotope
          $initscript .= '  container.isotope({ '."\n";
          $initscript .= '  }); ';
          $initscript .= '}); '."\n";
          $initscript .= '//used for window resize'."\n";
          $initscript .= 'jQuery(window).resize(function() {'."\n";
          $initscript .= '"use strict";'."\n";
          $initscript .= 'var container = jQuery(\'#cont_'. $gallerygrid_id  .'\');'."\n";
          $initscript .= 'container.isotope({ });'."\n";
          $initscript .= '});'."\n";
          $initscript .= '</script>';

          $return = '<!-- GALLERY SHORTCODE -->';
          
          // Final HTML composing
          if ($val_layout == 'portfolio_strict') { 

            $return .= '<div class="portfolio_strict">'."\n";
            $return .= '                    <div class="row isotope_portfolio_container" id="cont_'. $gallerygrid_id  .'">'."\n";
            $return .= $section_images;
            $return .= '                    </div>'."\n";
            $return .= '</div>'."\n";
            $return .= '<!-- /GALLERY SHORTCODE -->';
            $return .= $initscript;

          } else { 

            $return .= '<div class="portfolio_masonry">';
            $return .= '  <div class="row isotope_portfolio_container" id="cont_'. $gallerygrid_id  .'">'."\n";
            $return .= $section_images;
            $return .= '  </div>'."\n";
            $return .= '</div>'."\n";
            $return .= '<!-- /GALLERY SHORTCODE -->';
            $return .= $initscript;

          }

          return $return ;

       }

	}
	
 endif;