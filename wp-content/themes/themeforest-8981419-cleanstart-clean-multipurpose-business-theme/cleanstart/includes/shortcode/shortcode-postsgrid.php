<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M			          (c) 2014-2015

File Description: Posts Grid shortcode

*/

if ( ! defined( 'ABSPATH' ) ) exit; // NO DIRECT ACCESS 

if ( class_exists('Plethora_Shortcode') && !class_exists('Plethora_Shortcode_Postsgrid')):

	/**
	 * @package Plethora Base
	 */

	class Plethora_Shortcode_Postsgrid extends Plethora_Shortcode { 

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
                ));
              }

              // Note: scripts are loaded only when the shortcode is visible in frontend. You may add more than one

          // ADD STYLES 
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
              'options_title'    => 'Posts Grid shortcode',
              'options_required' => array(),  // Required Features (similar with Plethora Redux required field)
              'options_subtitle' => 'Activate/deactivate posts grid shortcode',
              'options_desc'     => 'On deactivation, all settings related to this feature will be removed. However, they will not be deleted permanently.',
              'version'          => '1.1'
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
              "base"              => 'sc_postsgrid',
              "name"              => __("Posts Grid", 'cleanstart'),
              "description"       => __('Build a custom posts grid', 'cleanstart'),
              "class"             => "",
              "weight"            => 1,
              "category"          => 'Plethora Shortcodes',
              "admin_enqueue_css" => THEME_CORE_ASSETS_URI .'/admin-shortcodes.css',
              "icon"              => THEME_CORE_ASSETS_URI . '/icons/plethora_shortcodes-32x32.png', 
              "params"            => array(
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
                  array(
                      "param_name"    => "results",
                      "type"          => "textfield",
                      "heading"       => __('Maximum post results', 'cleanstart'),
                      "value"         => '12',
                      "description"   => __("Set the maximum results in grid. Leave empty or set it to zero to display all results", 'cleanstart')
                  ),
                  array(
                      "param_name"    => "orderby",
                      "type"          => "dropdown",
                      "heading"       => __('Order by', 'cleanstart'),
                      "value"         => array(__('Date', 'cleanstart') =>'date', __('Random', 'cleanstart')  => 'random'),
                      "description"   => __("Select order", 'cleanstart')
                  ),
                  array(
                      "param_name"    => "showall",
                      "type"          => "dropdown",
                      "heading"       => __('Display SHOW ALL', 'cleanstart'),
                      "value"         => array( __('Show', 'cleanstart') => '1', __('Hide', 'cleanstart')  => '0'),
                      "description"   => __("Display SHOW ALL Button", 'cleanstart')
                  ),
                  array(
                      "param_name"    => "category_filters",
                      "type"          => "dropdown",
                      "heading"       => __('Project types menu', 'cleanstart'),
                      "value"         => array( __('Yes', 'cleanstart') =>'yes', __('No', 'cleanstart')  => 'no'),
                      "description"   => __("Display the categories menu", 'cleanstart')
                  ),
                  array(
                      "param_name"    => "exclude_categories",
                      "type"          => "checkbox",
                      "heading"       => __("Exclude categories", 'cleanstart'),
                      "value"         => class_exists('Plethora_Data') ? Plethora_Data::categories(array('taxonomy'=>'category')) : Plethora_Helper::array_categories(array('taxonomy'=>'category')) ,
                      "description"   => __("Check every category that you don't want to be included in results", 'cleanstart')
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
          $postsgrid_id = mt_rand( 1,5000 ); // VERY IMPORTANT! This generates a unique id for javascript inits

          extract( shortcode_atts( array( 
            'layout'             => 'classic',
            'layout_columns'     => '3',
            'results'            => '-1',
            'orderby'            => 'date',
            'category_filters'   => 'yes',
            'exclude_categories' => '',
            'showall'            => '1'
            ), $atts ) );

          
          // Set layout class value
          $val_layout = ($layout == 'masonry') ? 'portfolio_masonry' : 'portfolio_strict';
          // Set orderby value
          $val_orderby = ( $orderby == 'Random') ? 'rand' : 'date';
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

          $exclude = array();
          if ( !empty($exclude_categories) ) { 
            $exclude = explode(",", $exclude_categories);
          }

          //Make sure that max results is number...if empty or zero convert it to -1
          $results = is_numeric($results) && intval($results) > 0 ? intval($results) : -1 ;
          // Query arguments
          $args = array(
            'posts_per_page'      => $results,
            'ignore_sticky_posts' => 0,
            'post_type'           => 'post',
            'orderby'             => $val_orderby,
            'tax_query' => array(
                        array(
                          'taxonomy' => 'category',
                          'field'    => 'id',
                          'terms'    => $exclude,
                          'operator' => 'NOT IN'                          
                        )
            )        
          );
          $post_query = new WP_Query($args);


          // At first, we assign the post results to a variable. We do this first, in order to get the 
          // specific categories present (avoiding this way, to show an empty category tab)
          if( $post_query->have_posts() ) {

            // Set the array that will contain all the resulted posts categories
            $categories = array();

            // The loop
            $section_posts = '';
            while ($post_query->have_posts()) { 
            $post_query->the_post();

                // Get the post's categories (use wp_get_object_terms for custom post type)
                $post_categories = wp_get_object_terms( get_the_ID(), 'category' );

                $post_cat_classes = '';
                $post_cat_names = '';
                if (!empty($post_categories) && !is_wp_error( $post_categories ) ) { 

                   // Set the variable that will contain all the categiry selector classes
                   foreach ($post_categories as $category) { 

                      $categories[] = $category->name;
                      $post_cat_classes .= strtolower(sanitize_html_class( $category->name )) .' ';
                      $post_cat_names .= $category->name .' ';

                    }
                } 

                // Prepare posts section
                if ($val_layout == 'portfolio_strict') { 

                    $thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ),  $thumbsize) ;

                    $section_posts .= '<div class="'. $post_cat_classes .'col-xs-12 col-sm-6 col-md-'. $val_cols .' col-lg-'. $val_cols .'">'."\n";
                    $section_posts .= '     <div class="portfolio_item">'."\n"; 
                    $section_posts .= '       <a href="'. get_permalink() .'">'."\n";
                    $section_posts .= '          <figure style="background-image:url('. esc_url( $thumb_url[0] ) .')">'."\n";
                    $section_posts .= '               <figcaption>'."\n";
                    $section_posts .= '                 <div class="portfolio_description">'."\n";
                    $section_posts .= '                    <h3>'. get_the_title()  .'</h3>'."\n";
                    $section_posts .= '                    <span class="cross"></span>'."\n";
                    $section_posts .= '                    <p>'. $post_cat_names .'</p>'."\n";
                    $section_posts .= '                 </div>'."\n";
                    $section_posts .= '               </figcaption>'."\n";
                    $section_posts .= '          </figure>'."\n";
                    $section_posts .= '       </a>'."\n";
                    $section_posts .= '      </div>'."\n";
                    $section_posts .= '</div>'."\n";

                } else { 

                    $thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ),  $thumbsize) ;
                    
                    $section_posts .= '          <div class="'. $post_cat_classes .'col-sm-'. $val_cols .' col-md-'. $val_cols .'">'."\n";
                    $section_posts .= '             <div class="portfolio_item">'."\n";
                    $section_posts .= '               <a href="'. get_permalink() .'">'."\n";
                    $section_posts .= '                   <img src="'. esc_url( $thumb_url[0] ) .'" alt="'. esc_attr( get_the_title() ) .'" />'."\n";
                    $section_posts .= '                   <div class="overlay">'."\n";
                    $section_posts .= '                      <div class="desc">'."\n";
                    $section_posts .= '                         <h3>'. get_the_title()  .'</h3>'."\n";
                    $section_posts .= '                         <span class="cross"></span>'."\n";
                    $section_posts .= '                         <p>'. $post_cat_names .'</p>'."\n";
                    $section_posts .= '                      </div>'."\n";
                    $section_posts .= '                   </div>'."\n";
                    $section_posts .= '               </a>'."\n";
                    $section_posts .= '             </div>'."\n";
                    $section_posts .= '          </div>'."\n";
                }
            }



          } else {

            return;

          }
          
          $section_filters = "";

          if (!empty($categories)) { 

            $res_categories   = array_unique($categories); // get the unique categories found in results
            $categories       = array_diff($res_categories, $exclude); // remove excluded categories
            $section_filters .= '     <ul class="portfolio_filters" id="filt_'. $postsgrid_id  .'">'."\n";

            if ( $showall === '1' ) {
              $section_filters .= '          <li><a href="#" data-filter="*">'. __('Show All', 'cleanstart') . '</a></li>'."\n";
            }

            foreach ($categories as $categorykey=>$categoryname) { 
              $section_filters  .= '          <li><a href="#" data-filter=".'. esc_attr(strtolower(sanitize_html_class( $categoryname ))) .'">'. $categoryname .'</a></li>'."\n";
            }
            $section_filters  .= '     </ul>'."\n";
          }

$initscript = <<<INITSCRIPT

<script>

jQuery(function() {

  "use strict"; 

  var container = jQuery('#cont_${postsgrid_id}'); 
  var filt      = jQuery('#filt_${postsgrid_id} a'); 
      filt.eq(0).addClass('active'); 

  var selector = filt.eq(0).attr('data-filter'); 
  window.onload = function(){
    container.isotope({ filter: selector });
  }

  // filt.find("a[data-filter="*"]").addClass('active'); 


  filt.click(function(){ 

    filt.removeClass('active'); 
    jQuery(this).addClass('active'); 
    selector = jQuery(this).attr('data-filter'); 
    container.isotope({ filter: selector }); 
    return false; 

  }); 

  jQuery(window).resize(function() {

        container.isotope({});

  });

}); 


</script>

INITSCRIPT;

          $return = '<!-- POSTS GRID -->';
          
          // Final HTML composing
          if ($val_layout == 'portfolio_strict') { 

            $return .= '<div class="portfolio_strict">'."\n";
            if ($category_filters == 'yes') { $return .= $section_filters; } 
            $return .= '                    <div class="row isotope_portfolio_container" id="cont_'. $postsgrid_id  .'">'."\n";
            $return .= $section_posts;
            $return .= '                    </div>'."\n";
            $return .= '</div>'."\n";
            $return .= '<!-- /POSTS GRID -->';
            $return .= $initscript;

          } else { 

            if ($category_filters == 'yes') { 
              $return .= '<div>';
              $return .= $section_filters; 
              $return .= '</div>';
            } 
            $return .= '<div class="portfolio_masonry">';
            $return .= '  <div class="row isotope_portfolio_container" id="cont_'. $postsgrid_id  .'">'."\n";
            $return .= $section_posts;
            $return .= '  </div>'."\n";
            $return .= '</div>'."\n";
            $return .= '<!-- /POSTS GRID -->';
            $return .= $initscript;

          }

          wp_reset_query();

          return $return ;

       }

	}
	
 endif;