<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M 				   (c) 2015

File Description: Products Grid shortcode

*/

if ( ! defined( 'ABSPATH' ) ) exit; // NO DIRECT ACCESS 

if ( class_exists('Plethora_Shortcode') && !class_exists('Plethora_Shortcode_Wooproductgrid') && class_exists('Plethora_Module_Woocommerce') ):

	/**
	 * @package Plethora Base
	 */

	class Plethora_Shortcode_Wooproductgrid extends Plethora_Shortcode { 

    	 function __construct() {

          // REGISTER SHORTCODE
 
          //     // Hook shortcode registration on init ( otherwise, will not retrieve product categories properly )
          //     $this->add('ple_wooproductrid', array($this,'content'));

          // // MAP PARAMETERS TO UI PANELS ( we use the params() method to get defined parameters )
          //  Plethora_CMS::add_action( 'init', array($this, 'set_params' ));


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
       * @since 1.2
       *
       */
       public function get_feature_options() {

          $feature_options = array ( 
              'switchable'       => true,
              'options_title'    => 'Plethora WooProducts Grid',
              'options_required' => array('module-woocommerce-status','=',array('1')),  // Required Features (similar with Plethora Redux required field)
              'options_subtitle' => 'Activate/deactivate WooProducts Grid shortcode',
              'options_desc'     => 'On deactivation, all settings related to this feature will be removed. However, they will not be deleted permanently.',
              'version'          => '1.0'
            );
          
          return $feature_options;
       }

       /** 
       * Maps shortcode parameters ( to be hooked on init please! )
       *
       * @return array
       * @since 1.2
       *
       */
       public function set_params() { 

          // MAP PARAMETERS TO UI PANELS ( we use the params() method to get defined parameters )
          $this->map_vcpanel( $this->params() );
       }


       /** 
       * Returns shortcode settings (compatible with Visual composer)
       *
       * @return array
       * @since 1.2
       *
       */
       public function params() {

          $include_categories = array() ;
          $include_categories = $include_categories + Plethora_Data::categories(array('taxonomy'=>'product_cat'));

          $sc_settings =  array(
              "base"              => $this->shortcode_slug,
              "name"              => __("Plethora WooProducts Grid", 'cleanstart'),
              "description"       => __('Display a WooCommerce products grid', 'cleanstart'),
              "class"             => "",
              "weight"            => 1,
              "category"          => 'WooCommerce',
              "admin_enqueue_css" => THEME_CORE_ASSETS_URI .'/admin-shortcodes.css',
              "icon"              => THEME_CORE_ASSETS_URI . '/icons/woo_shortcodes-32x32.png', 
              "params"            => array(
                  array(
                      "param_name"    => "include",
                      "type"          => "dropdown",
                      "heading"       => __("Results will include", 'cleanstart'),
                      "value"         => array(__('all products', 'cleanstart') =>'all_products', __('featured products', 'cleanstart') =>'featured', __('on sale products', 'cleanstart') =>'onsale', __('selected category products', 'cleanstart') =>'category'),
                      "description"   => __('Select a specific product category that you want to be included in results', 'cleanstart')
                  ),
                  array(
                      "param_name"    => "include_category",
                      "type"          => "dropdown",
                      "heading"       => __("Product categories", 'cleanstart'),
                      "value"         => $include_categories,
                      "description"   => __('Select a specific product category that you want to be included in results', 'cleanstart'),
                      'dependency'    => array( 
                                          'element' => 'include',  
                                          'value'   => array('category'),  
                                      )
                  ),
                  array(
                      "param_name"    => "layout",
                      "type"          => "dropdown",
                      "heading"       => __("Grid layout", 'cleanstart'),
                      "value"         => array(__('Classic', 'cleanstart') =>'classic', __('Masonry', 'cleanstart') =>'masonry'),
                  ),
                  array(
                      "param_name"    => "columns",
                      "type"          => "dropdown",
                      "heading"       => __("Grid columns", 'cleanstart'),
                      "value"         => array('2' => '2', '3' => '3', '4' => '4'),
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
                      "value"         => array(
                        __('Date ( newest to older )', 'cleanstart') =>'date', 
                        __('Bestselling', 'cleanstart') =>'total_sales', 
                        __('Price ( low to high )', 'cleanstart') => 'price_to_high', 
                        __('Price ( high to low )', 'cleanstart') => 'price_to_low', 
                        __('Rating', 'cleanstart') => 'rating', 
                        __('Random', 'cleanstart')  => 'rand'),
                  ),
                  array(
                      "param_name"    => "show_prices",
                      "type"          => "dropdown",
                      "heading"       => __('Display product price', 'cleanstart'),
                      "value"         => array( __('Yes', 'cleanstart') =>'yes', __('No', 'cleanstart')  => 'no'),
                  ),
                  array(
                      "param_name"    => "show_categories",
                      "type"          => "dropdown",
                      "heading"       => __('Display product categories', 'cleanstart'),
                      "value"         => array( __('Yes', 'cleanstart') =>'yes', __('No', 'cleanstart')  => 'no'),
                  ),
                  array(
                      "param_name"    => "category_filters",
                      "type"          => "dropdown",
                      "heading"       => __('Display categories filter menu', 'cleanstart'),
                      "value"         => array( __('Yes', 'cleanstart') =>'yes', __('No', 'cleanstart')  => 'no'),
                  ),
                  array(
                      "param_name"    => "category_filters_show_all",
                      "type"          => "dropdown",
                      "heading"       => __('Display "Show All" Button', 'cleanstart'),
                      "value"         => array( __('Yes', 'cleanstart') =>'yes', __('No', 'cleanstart')  => 'no'),
                      'dependency'    => array( 
                                          'element' => 'category_filters',  
                                          'value'   => array('yes'),  
                                      )
                  ),
                  array(
                      "param_name"    => "category_filters_show_all_text",
                      "type"          => "textfield",
                      "heading"       => __('"Show All" Button Text', 'cleanstart'),
                      "value"         => __('Show All', 'cleanstart'),
                      'dependency'    => array( 
                                          'element' => 'category_filters_show_all',  
                                          'value'   => array('yes'),  
                                      )
                  ),
              )
          );

          return $sc_settings;
       }

       /** 
       * Returns shortcode content
       *
       * @return array
       * @since 1.2
       *
       */
       public function content( $atts, $content = null ) {

          $this->add_script = true; // VERY IMPORTANT! This triggers loading related scripts on footer
          $wooproductgrid_id = mt_rand( 1,5000 ); // VERY IMPORTANT! This generates a unique id for javascript inits

          extract( shortcode_atts( array( 
            'include' => '',
            'include_category' => '',
            'layout'             => 'classic',
            'columns'             => '3',
            'results'            => '-1',
            'orderby'            => 'date',
            'show_prices'            => 'yes',
            'show_categories'            => 'yes',
            'category_filters'   => 'yes',
            'category_filters_show_all' => 'yes',
            'category_filters_show_all_text' => __('Show All', 'cleanstart'),
            ), $atts ) );

          
          // Declare array & basic arguments
          $args    = array();
          $args['post_type'] ='product';
          $args['posts_per_page'] = is_numeric($results) && intval($results) > 0 ? intval($results) : -1 ;
          $args['ignore_sticky_posts'] = 0;
          
          // Set orderby value
          switch ( $orderby ) { 
              case 'date':
                $args['orderby']  = 'date';
                $args['meta_key'] = 'total_sales'; // not affecting anything...just a filler
                $args['order']    = 'DESC';
                break;
              case 'total_sales':
                $args['orderby'] = 'meta_value_num';
                $args['meta_key'] = 'total_sales';
                $args['order'] = 'DESC';
                break;
              case 'price_to_high':
                $args['orderby'] = 'meta_value_num';
                $args['meta_key'] = '_price';
                $args['order'] = 'ASC';
                break;
              case 'price_to_low':
                $args['orderby'] = 'meta_value_num';
                $args['meta_key'] = '_price';
                $args['order'] = 'DESC';
               break;
              case 'rating':
                Plethora_CMS::add_filter( 'posts_clauses', array( 'WC_Query', 'order_by_rating_post_clauses' ) );              
               break;
              case 'rand':
                $args['orderby'] = 'rand';
                $args['meta_key'] = 'date';
                $args['order'] = 'DESC';
                break;
              default:
                $args['orderby'] = 'date';
                $args['meta_key'] = 'date';
                $args['order'] = 'DESC';
          }

          // Onsale products meta query arguments
          if ($include === 'onsale') { 
            $product_ids_on_sale = woocommerce_get_product_ids_on_sale();
            $args['post__in'] = $product_ids_on_sale;
          }

          // Selected category arguments
          if ($include === 'category' && ( !empty($include_category) || !$include_category == '0' )) { 
            $args['tax_query'] = array( array(
                          'taxonomy' => 'product_cat',
                          'field'    => 'id',
                          'terms'    => $include_category,
                          'operator' => 'IN',
                        ));      
          }
          // Featured products meta query arguments
          if ($include === 'featured') { 
            $args['meta_query'] = array( array(
                          'key' => '_featured',
                          'value'    => 'yes',
                          'compare'    => 'IN',
                        ));      
          }
          // we have all the arguments...let's get the posts
          $post_query = new WP_Query($args);

          // Layout: class value
          $val_layout = ($layout == 'masonry') ? 'portfolio_masonry' : 'portfolio_strict';
          // Layout: columns setup
          switch ( $columns ) {
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

          // The Loop...at first, we assign the post results to a variable. We do this first, in order to get the 
          // specific categories present (avoiding this way, to show an empty category tab)
          if( $post_query->have_posts() ) {
            // Set the array that will contain all the resulted posts categories
            $categories = array();

            // The loop
            $section_posts = '';
            while ($post_query->have_posts()) { 
            $post_query->the_post();

                
                // Get the post's categories (use wp_get_object_terms for custom post type)
                $post_categories = wp_get_object_terms( get_the_ID(), 'product_cat' );

                $post_cat_classes = '';
                $post_cat_names = '';
                if (!empty($post_categories) && !is_wp_error( $post_categories ) ) { 

                   // Set the variable that will contain all the categiry selector classes
                   foreach ($post_categories as $category) { 

                      $categories[] = $category->name;
                      $post_cat_classes .= strtolower(sanitize_html_class( $category->name )) .' ';
                      $post_cat_names .= $show_categories == 'yes' ? $category->name .'  ' : '';

                    }
                }

                // Product Price
                $_product = get_product( $post_query->post->ID );
                $price = $show_prices == 'yes' ? '<strong>'. $_product->get_price_html() .'</strong>' : '';


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
                    $section_posts .= '                    <p>'. $post_cat_names .'<br>'. $price  .'</p>'."\n";
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
                    $section_posts .= '                         <p>'. $post_cat_names . $price .'</p>'."\n";
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
            $categories       = array_diff($res_categories, array($include_category)); // remove included categories
            $section_filters .= '     <ul class="portfolio_filters" id="filt_'. $wooproductgrid_id  .'">'."\n";
            $section_filters .= $category_filters_show_all == 'yes' ? '          <li><a href="#" data-filter="*">'. $category_filters_show_all_text . '</a></li>'."\n" : '';
            foreach ($categories as $categorykey=>$categoryname) { 
              $section_filters  .= '          <li><a href="#" data-filter=".'. esc_attr(strtolower(sanitize_html_class( $categoryname ))) .'">'. $categoryname .'</a></li>'."\n";
            }
            $section_filters  .= '     </ul>'."\n";
          }

          $initscript = '<script>';
            // cache container
          $initscript .= 'jQuery(window).load(function() {'."\n";
          $initscript .= '"use strict"; '."\n";
          $initscript .= '  var container = jQuery(\'#cont_'. $wooproductgrid_id  .'\'); '."\n";
            // initialize isotope
          $initscript .= '  container.isotope({ '."\n";
          $initscript .= '  }); ';
          $initscript .= '  jQuery(\'#filt_'. $wooproductgrid_id  .' a[data-filter="*"]\').addClass(\'active\'); '."\n";
            // filter items when filter link is clicked
          $initscript .= '  jQuery(\'#filt_'. $wooproductgrid_id  .' a\').click(function(){ '."\n";
          $initscript .= '    jQuery(\'#filt_'. $wooproductgrid_id  .' a\').removeClass(\'active\'); '."\n";
          $initscript .= '    jQuery(this).addClass(\'active\'); '."\n";
          $initscript .= '    var selector = jQuery(this).attr(\'data-filter\'); '."\n";
          $initscript .= '    container.isotope({ filter: selector }); '."\n";
          $initscript .= '    return false; '."\n";
          $initscript .= '  }); '."\n";
          $initscript .= '}); '."\n";
          $initscript .= '//used for window resize'."\n";
          $initscript .= 'jQuery(window).resize(function() {'."\n";
          $initscript .= '"use strict";'."\n";
          $initscript .= 'var container = jQuery(\'#cont_'. $wooproductgrid_id  .'\');'."\n";
          $initscript .= 'container.isotope({ });'."\n";
          $initscript .= '});'."\n";
          $initscript .= '</script>';

          $return = '';
          
          // Final HTML composing
          if ($val_layout == 'portfolio_strict') { 

            $return  = '<div class="portfolio_strict">'."\n";
            if ($category_filters == 'yes') { $return .= $section_filters; } 
            $return .= '                    <div class="row isotope_portfolio_container" id="cont_'. $wooproductgrid_id  .'">'."\n";
            $return .= $section_posts;
            $return .= '                    </div>'."\n";
            $return .= '</div>'."\n";
            $return .= $initscript;

          } else { 

            if ($category_filters == 'yes') { 
              $return  = '<div>';
              $return .= $section_filters; 
              $return .= '</div>';
            } 
            $return .= '<div class="portfolio_masonry">';
            $return .= '  <div class="row isotope_portfolio_container" id="cont_'. $wooproductgrid_id  .'">'."\n";
            $return .= $section_posts;
            $return .= '  </div>'."\n";
            $return .= '</div>'."\n";
            $return .= $initscript;

          }

          wp_reset_query();

          return $return ;

       }
	}
	
 endif;