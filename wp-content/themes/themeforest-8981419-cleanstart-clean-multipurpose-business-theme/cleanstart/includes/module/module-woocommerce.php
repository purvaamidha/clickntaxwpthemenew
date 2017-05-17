<?php

/**
 * Woocommerce functionality
 * 
 */
if ( ! defined( 'ABSPATH' ) ) exit; // NO DIRECT ACCESS 

if ( !class_exists('Plethora_Module_Woocommerce') && class_exists('woocommerce') && method_exists('Plethora_CMS', 'register_sidebar') ) {

	class Plethora_Module_Woocommerce {

		function __construct() {
			// WooCommerce Theme Options Tab ( contains all theme options for WC )
	        Plethora_CMS::add_filter( 'plethora_themeoptions_thirdparty', array( 'Plethora_Module_Woocommerce', 'theme_options' ) );

			// Add WooCommerce support
	        Plethora_CMS::add_action( 'after_setup_theme', 					  array( 'Plethora_Module_Woocommerce', 'support' ) );						// Primary WC support declaration
			Plethora_CMS::add_filter( 'plethora_page_for_archive', 			  array( 'Plethora_Module_Woocommerce', 'shop_page_id' ));					// VERY IMPORTANT...hooks on page id returns for shop page
	        self::remove_hooks(); 																								// Remove hooks that will be replaced later
	        
	        // Style enqueing
	        Plethora_CMS::add_action( 'wp_enqueue_scripts', array( 'Plethora_Module_Woocommerce', 'enqueue' ), 20); 								// Keep priority to 20 to make sure that it will be loaded after Woo defaults

			// Sidebars
        	Plethora_CMS::add_action( 'widgets_init', array( 'Plethora_Module_Woocommerce', 'register_sidebars' ), 20);

	        // Wrappers
			Plethora_CMS::add_action( 'woocommerce_before_main_content', array( 'Plethora_Module_Woocommerce', 'wrapper_start'), 10 );				// Main Wrapper Start
			Plethora_CMS::add_action( 'woocommerce_after_main_content', array( 'Plethora_Module_Woocommerce', 'wrapper_end' ), 10);					// Main Wrapper End

			// Head Panel
			Plethora_CMS::add_filter( 'plethora_cleanstart_headpanel_title', 	array( 'Plethora_Module_Woocommerce', 'headpanel_title' )); 		// Head Panel Title
			Plethora_CMS::add_filter( 'plethora_cleanstart_headpanel_subtitle', array( 'Plethora_Module_Woocommerce', 'headpanel_subtitle' )); 		// Head Panel Subtitle

			// Catalog ( before loop )
	        Plethora_CMS::add_action( 'woocommerce_before_main_content',array( 'Plethora_Module_Woocommerce', 'catalog_breadcrumbs' ), 5);			// Catalog: Breadcrums
			Plethora_CMS::add_filter( 'woocommerce_show_page_title', 	array( 'Plethora_Module_Woocommerce', 'catalog_title' ) );					// Catalog: Title display
			Plethora_CMS::add_action( 'woocommerce_archive_description',array( 'Plethora_Module_Woocommerce', 'catalog_categorydescription' ), 1);	// Catalog: Category description display
			Plethora_CMS::add_action( 'woocommerce_before_shop_loop', 	array( 'Plethora_Module_Woocommerce', 'catalog_resultscount'), 1);			// Catalog: Results count display
			Plethora_CMS::add_action( 'woocommerce_before_shop_loop', 	array( 'Plethora_Module_Woocommerce', 'catalog_orderby'), 1);				// Catalog: order by field


			// Catalog ( on loop )
	        Plethora_CMS::add_filter( 'loop_shop_per_page', 					array( 'Plethora_Module_Woocommerce', 'catalog_perpage' ), 20);		// Loop: Products per page        
	        Plethora_CMS::add_filter( 'loop_shop_columns', 						array( 'Plethora_Module_Woocommerce', 'catalog_columns' ));			// Loop: Columns 
			Plethora_CMS::add_action( 'woocommerce_after_shop_loop_item_title', array( 'Plethora_Module_Woocommerce', 'catalog_rating' ), 1);		// Loop: Rating display
			Plethora_CMS::add_action( 'woocommerce_after_shop_loop_item_title', array( 'Plethora_Module_Woocommerce', 'catalog_price' ), 1);		// Loop: Price display 
			Plethora_CMS::add_action( 'woocommerce_after_shop_loop_item', 		array( 'Plethora_Module_Woocommerce', 'catalog_addtocart' ), 1);	// Loop: Add-to-cart display 
			Plethora_CMS::add_action( 'woocommerce_before_shop_loop_item_title',array( 'Plethora_Module_Woocommerce', 'catalog_salesflash' ), 1);	// Loop: Sales flash icon display 
	        
	        // Single product 
	        Plethora_CMS::add_action( 'woocommerce_before_main_content', 		  array( 'Plethora_Module_Woocommerce', 'single_breadcrumbs' ), 5);	// Single: Breadcrums
	        Plethora_CMS::add_action( 'woocommerce_before_single_product_summary',array( 'Plethora_Module_Woocommerce', 'single_salesflash' ), 1);	// Single: Sales flash icon display 
			Plethora_CMS::add_action( 'woocommerce_single_product_summary', 	  array( 'Plethora_Module_Woocommerce', 'single_title' ) , 1);		// Single: Title display
			Plethora_CMS::add_action( 'woocommerce_single_product_summary', 	  array( 'Plethora_Module_Woocommerce', 'single_rating' ), 1 );		// Single: Rating display
			Plethora_CMS::add_action( 'woocommerce_single_product_summary', 	  array( 'Plethora_Module_Woocommerce', 'single_price' ), 1 );		// Single: Price display
			Plethora_CMS::add_action( 'woocommerce_single_product_summary', 	  array( 'Plethora_Module_Woocommerce', 'single_addtocart' ), 1 );	// Single: add-to-cart display
			Plethora_CMS::add_action( 'woocommerce_single_product_summary', 	  array( 'Plethora_Module_Woocommerce', 'single_meta' ), 1 );		// Single: Meta display
			Plethora_CMS::add_filter( 'woocommerce_product_tabs',	array( 'Plethora_Module_Woocommerce', 'single_tab_description' ), 98 );			// Single: Description tab display
			Plethora_CMS::add_filter( 'woocommerce_product_tabs',	array( 'Plethora_Module_Woocommerce', 'single_tab_reviews' ), 98 );				// Single: Reviews tab display
			Plethora_CMS::add_filter( 'woocommerce_product_tabs',	array( 'Plethora_Module_Woocommerce', 'single_tab_attributes' ), 98 );			// Single: Additional info tab display
	        Plethora_CMS::add_filter( 'woocommerce_related_products_args',  	  array( 'Plethora_Module_Woocommerce', 'single_related' ), 10);	// Single: Related products config
	        Plethora_CMS::add_filter( 'woocommerce_output_related_products_args', array( 'Plethora_Module_Woocommerce', 'single_related_config' ));	// Single: Related products status
			Plethora_CMS::remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );	// Single: Upsell products ( remove default )
			Plethora_CMS::add_action( 'woocommerce_after_single_product_summary', array( 'Plethora_Module_Woocommerce', 'single_upsell'), 15); 		// Single: Upsell products display ( "You May Also Like...")

	        // Global configuration
	        // Plethora_CMS::add_filter( 'woocommerce_product_single_add_to_cart_text', array( $this,'global_cartbuttontext'));// Global: add-to-cart text 
	        // Plethora_CMS::add_filter( 'woocommerce_product_add_to_cart_text',	array( $this, 'global_cartbuttontext'));	// Global: add-to-cart text
		}

		public static function support() {

    		add_theme_support( 'woocommerce' );
		}

		public static function remove_hooks() { 
			
			// Remove global wrappers and sidebar
			Plethora_CMS::remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 ); 
			Plethora_CMS::remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
			Plethora_CMS::remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
			// Disable stylesheet enqueues 
			Plethora_CMS::add_filter( 'woocommerce_enqueue_styles', '__return_false' );
		}

		public static function enqueue() {

    		Plethora_CMS::wp_register_style( 'plethora-woocommerce', THEME_ASSETS_URI . '/css/woocommerce.css');
            Plethora_CMS::wp_enqueue_style( 'plethora-woocommerce' );
		}

		public static function shop_page_id( $id ) {

            if ( is_shop() || (is_shop() && is_search()) || is_product_category() || is_product_tag() ) { 
				$id	= get_option( 'woocommerce_shop_page_id', 0 );           
            } 
            return $id;
		}
		
		public static function register_sidebars() {

			$sidebar_catalog = array(
		        'name'          => __( 'Products Catalog Sidebar', 'cleanstart' ),
              	'description'   => __( 'Default sidebar for catalog page','cleanstart' ),
		        'id'            => 'sidebar-woo-catalog',
		        'class'         => '',
		        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		        'after_widget'  => '</aside>',
		        'before_title'  => '<h4>',
		        'after_title'   => '</h4>' );

			$sidebar_product = array(
		        'name'          => __( 'Single Product Posts Sidebar', 'cleanstart' ),
              	'description'   => __( 'Default sidebar for single product posts','cleanstart' ),
		        'id'            => 'sidebar-woo-product',
		        'class'         => '',
		        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		        'after_widget'  => '</aside>',
		        'before_title'  => '<h4>',
		        'after_title'   => '</h4>' ); 

			$sidebar_general = array(
		        'name'          => __( 'General WooCommerce Sidebar', 'cleanstart' ),
              	'description'   => __( 'Default sidebar for cart, checkout, terms and my account pages','cleanstart' ),
		        'id'            => 'sidebar-woo-general',
		        'class'         => '',
		        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		        'after_widget'  => '</aside>',
		        'before_title'  => '<h4>',
		        'after_title'   => '</h4>' ); 

      		Plethora_CMS::register_sidebar( $sidebar_catalog ); 
      		Plethora_CMS::register_sidebar( $sidebar_product ); 
      		Plethora_CMS::register_sidebar( $sidebar_general ); 

		}

		public static function sidebar_to_hook( $sidebar ) {

			if ( is_singular( 'product' ) ) { 

				$sidebar = Plethora::option( PLETHORA_META_PREFIX .'wooproduct-sidebar' );

			} else { 

				$sidebar = Plethora::option( PLETHORA_META_PREFIX .'wooarchive-sidebar' );

			}
			return $sidebar;

		}

		public static function get_sidebar() { 
			// Set loaded sidebar with 'plethora_sidebar' filter
			Plethora_CMS::add_filter( 'plethora_sidebar', array('Plethora_Module_Woocommerce', 'sidebar_to_hook') );
			// Load sidebar
			get_sidebar();
		}

		public static function get_layout() { 

			if ( is_singular( 'product' ) ) { 

				$layout	 = Plethora::option( PLETHORA_META_PREFIX .'wooproduct-layout' );

			} else { 

				$layout	 = Plethora::option( PLETHORA_META_PREFIX .'wooarchive-layout' );

			}
			return $layout;			

		}

		public static function wrapper_start() {
			
			echo '<div class="main">' . Plethora_Theme_Html::triangles( 'header' ) ;
			$plethora_grid_shop = 'plethora-woo-shop-grid-'. Plethora::option( PLETHORA_META_PREFIX .'wooarchive-columns', 4);
			$plethora_grid_related = 'plethora-woo-related-grid-'. Plethora::option( PLETHORA_META_PREFIX .'wooproduct-related-columns', 4);
			$plethora_classes  = 'plethora-woo';
			$plethora_classes .= ( is_shop() && !is_search() ) || ( is_shop() && is_search() ) || is_product_category() || is_product_tag() ? ' '.$plethora_grid_shop.'' : '';	// if is shop, place also a column class
			$plethora_classes .= is_product() ? ' '.$plethora_grid_related.'' : '';	// if is single product, place also a related products column class
			$layout	 = self::get_layout();
			switch ( $layout ) {
				case 'full':
					echo '<section class="'.$plethora_classes.'"><div class="container">';
					break;

				case 'right_sidebar':
					echo '<div class="with_right_sidebar"><div class="container"><section></section>';
					echo '<div class="row">';
					echo '<div id="leftcol" class="'.$plethora_classes.' col-sm-8 col-md-8">';
					break;

				case 'left_sidebar':
					echo '<div class="with_left_sidebar"><div class="container"><section></section>';
					echo '<div class="row">';
					self::get_sidebar();
					echo '<div id="rightcol" class="'.$plethora_classes.' col-sm-8 col-md-8">';
					break;

				default:
					echo '<section class="'.$plethora_classes.'"><div class="container">';
					break;
			}
		}

		public static function wrapper_end() {

		  $layout	 = self::get_layout();
	      switch ( $layout ) {
		        case 'full':
	      			echo '</div></section>';
	      			break;

		        case 'right_sidebar':
					echo '</div>';
					self::get_sidebar();
					echo '</div></div></div>';
	      			break;

		        case 'left_sidebar':
					echo '</div>';
					echo '</div></div></div>';
	     			break;

	    		default:
	      			echo '</div></section>';
	      			break;
          	}
		}

		public static function headpanel_title( $title ) { 

      
            if ( is_shop() && !is_search() ) { 
              
	          $shop_header_title  = Plethora_Theme::option( PLETHORA_META_PREFIX .'wooarchive-headpanel-title');         
	          $title = ( !empty( $shop_header_title )) ? $shop_header_title : '';

            } elseif ( is_shop() && is_search() ) { 

	          $shop_header_title_search = Plethora_Theme::option( PLETHORA_META_PREFIX .'wooarchive-headpanel-title-search');         
	          $title_prfx = ( !empty( $shop_header_title_search )) ? $shop_header_title_search : '';
	          $title =  $title_prfx . get_search_query();

            } elseif ( is_product_category() ) { 
              
              $shop_header_title_cat    = Plethora_Theme::option( PLETHORA_META_PREFIX .'wooarchive-headpanel-title-cat');         
              $title_prfx = ( !empty( $shop_header_title_cat )) ? $shop_header_title_cat : '';
              $title = single_cat_title($title_prfx, false);

            } elseif ( is_product_tag() ) { 
              
              $shop_header_title_tag    = Plethora_Theme::option( PLETHORA_META_PREFIX .'wooarchive-headpanel-title-tag');         
              $title_prfx = ( !empty( $shop_header_title_tag )) ? $shop_header_title_tag : '';
              $title = single_cat_title($title_prfx, false);

            } elseif ( is_product() ) { 

	          $title_behavior           = Plethora_Theme::option( PLETHORA_META_PREFIX . 'wooproduct-headpanel-title', 'shoptitle');
	          
	          if ( $title_behavior == 'producttitle' ) { 

	            $title = get_the_title();

	          } elseif ( $title_behavior == 'customtitle' ) {
	          
	            $title   = Plethora_Theme::option( PLETHORA_META_PREFIX . 'wooproduct-headpanel-customtitle', '');

	          } elseif ( $title_behavior == 'shoptitle' ) {

	            $shop_title   = Plethora_Theme::option( PLETHORA_META_PREFIX .'wooarchive-headpanel-title' );
	            $title = ( !empty( $shop_title )) ? $shop_title : '';

	          } elseif ( $title_behavior == 'notitle' ) {

	            $title = '';

	          }

            }
			return $title;

		}

		public static function headpanel_subtitle( $subtitle ) { 

            if ( is_shop() && !is_search() ) { 
              
	          $shop_header_subtitle  = Plethora_Theme::option( PLETHORA_META_PREFIX .'wooarchive-headpanel-subtitle');         
	          $subtitle = ( !empty( $shop_header_subtitle )) ? $shop_header_subtitle : '';

            } elseif ( is_shop() && is_search() ) { 

              $shop_header_subtitle_search  = Plethora_Theme::option( PLETHORA_META_PREFIX .'wooarchive-headpanel-subtitle-search');

              $subtitle_type = ( !empty( $shop_header_subtitle_search )) ? $shop_header_subtitle_search : '';
              switch ( $subtitle_type ) {
                  
                  case 'nosubtitle' :
                    $subtitle = '';
                    break;

                  case 'usedefault' :
                    $shop_header_subtitle = Plethora_Theme::option( PLETHORA_META_PREFIX .'wooarchive-headpanel-subtitle');         
                    $subtitle = ( !empty( $shop_header_subtitle )) ? $shop_header_subtitle : '';
                    break;

                  case 'usecustom' :
                    $shop_header_subtitle_search_custom = Plethora_Theme::option( PLETHORA_META_PREFIX .'wooarchive-headpanel-subtitle-search-custom');         
                    $subtitle = ( !empty( $shop_header_subtitle_search_custom )) ? $shop_header_subtitle_search_custom : '';
                    break;
              }

            } elseif ( is_product_category() ) { 
              
              $shop_header_subtitle_cat = Plethora_Theme::option( PLETHORA_META_PREFIX .'wooarchive-headpanel-subtitle-cat');         

              $subtitle_type = ( !empty( $shop_header_subtitle_cat )) ? $shop_header_subtitle_cat : '';
              switch ( $subtitle_type ) {
                  
                  case 'nosubtitle' :
                    $subtitle = '';
                    break;

                  case 'usedefault' :
                    $shop_header_subtitle     = Plethora_Theme::option( PLETHORA_META_PREFIX .'wooarchive-headpanel-subtitle');         
                    $subtitle = ( !empty( $shop_header_subtitle )) ? $shop_header_subtitle : '';
                    break;

                  case 'usedescription' :
                    $subtitle = category_description();
                    break;

                  case 'usecustom' :
                   $shop_header_subtitle_cat_custom  = Plethora_Theme::option( PLETHORA_META_PREFIX .'wooarchive-headpanel-subtitle-cat-custom');
                   $subtitle = ( !empty( $shop_header_subtitle_cat_custom )) ? $shop_header_subtitle_cat_custom : '';
                    break;
              }

            } elseif ( is_product_tag() ) { 

              $shop_header_subtitle_tag         = Plethora_Theme::option( PLETHORA_META_PREFIX .'wooarchive-headpanel-subtitle-tag');         

              $subtitle_type = ( !empty( $shop_header_subtitle_tag )) ? $shop_header_subtitle_tag : '';
              switch ( $subtitle_type ) {
                  
                  case 'nosubtitle' :
                    $subtitle = '';
                    break;

                  case 'usedefault' :
                    $shop_header_subtitle     = Plethora_Theme::option( PLETHORA_META_PREFIX .'wooarchive-headpanel-subtitle');         
                    $subtitle = ( !empty( $shop_header_subtitle )) ? $shop_header_subtitle : '';
                    break;

                  case 'usedescription' :
                    $subtitle = tag_description();
                    break;

                  case 'usecustom' :
                   $shop_header_subtitle_tag_custom  = Plethora_Theme::option( PLETHORA_META_PREFIX .'wooarchive-headpanel-subtitle-tag-custom');
                   $subtitle = ( !empty( $shop_header_subtitle_tag_custom )) ? $shop_header_subtitle_tag_custom : '';
                    break;
              }
              
            } elseif ( is_product() ) { 

	          $title_behavior           = Plethora_Theme::option( PLETHORA_META_PREFIX . 'wooproduct-headpanel-title', 'shoptitle');

	          if ( $title_behavior == 'producttitle' ) { 

	            $subtitle   = Plethora_Theme::option( PLETHORA_META_PREFIX . 'wooproduct-headpanel-customsubtitle', '');

	          } elseif ( $title_behavior == 'customtitle' ) {
	          
	            $subtitle   = Plethora_Theme::option( PLETHORA_META_PREFIX . 'wooproduct-headpanel-customsubtitle', '');

	          } elseif ( $title_behavior == 'shoptitle' ) {

	            $shop_header_subtitle       = Plethora_Theme::option( PLETHORA_META_PREFIX .'wooarchive-headpanel-subtitle');         
	            $subtitle = ( !empty( $shop_header_subtitle )) ? $shop_header_subtitle : '';
	          }

            }
			return $subtitle;

		}

		public static function catalog_title() {

			$display = true;
			if ( is_shop() ) { 
				$title_display = Plethora::option( PLETHORA_META_PREFIX .'wooarchive-title', 'display' );
				if ( $title_display == 'hide') { 

					$display = false; 
				}
			}
			return $display;
		}

		public static function catalog_categorydescription() {
			$category_display = Plethora::option( PLETHORA_META_PREFIX .'wooarchive-categorydescription', 'display' );
			if ( $category_display == 'hide') { 
				Plethora_CMS::remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
			}
		}

		public static function catalog_perpage() {
			$products_per_page = Plethora::option( PLETHORA_META_PREFIX .'wooarchive-perpage', 12, 0, false);
			return $products_per_page;			
		}

		public static function catalog_columns() {

			$products_per_page = Plethora::option( PLETHORA_META_PREFIX .'wooarchive-columns', 4, 0, false);
			return $products_per_page;			
		}

		public static function catalog_breadcrumbs() {

			if ( is_shop() ) {
				$breadcrumbs = Plethora::option( PLETHORA_META_PREFIX .'wooarchive-breadcrumbs', 'display');
				if ( $breadcrumbs == 'hide') { 
					Plethora_CMS::remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
				}
			}
		}

		public static function catalog_resultscount() { 

			$resultscount_display = Plethora::option( PLETHORA_META_PREFIX .'wooarchive-resultscount', 'display' );
			if ( $resultscount_display == 'hide' ) { 
				Plethora_CMS::remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
			}			
		}

		public static function catalog_orderby() {

			$orderby_display = Plethora::option( PLETHORA_META_PREFIX .'wooarchive-orderby', 'display', 0, false);
			if ( $orderby_display == 'hide') { 
				Plethora_CMS::remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
			}
		}

		public static function catalog_rating() { 

			$rating_display = Plethora::option( PLETHORA_META_PREFIX .'wooarchive-rating', 'display' );
			if ( $rating_display == 'hide') { 
				Plethora_CMS::remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
			}
		}

		public static function catalog_price() {

			$price_display = Plethora::option( PLETHORA_META_PREFIX .'wooarchive-price', 'display' );
			if ( $price_display == 'hide') { 
				Plethora_CMS::remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
			}
		}

		public static function catalog_addtocart() { 

			$cart_display = Plethora::option( PLETHORA_META_PREFIX .'wooarchive-addtocart', 'display' );
			if ( $cart_display == 'hide' ) { 
    			Plethora_CMS::remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
			}
		}

		public static function catalog_salesflash() {

			$salesflash_display = Plethora::option( PLETHORA_META_PREFIX .'wooarchive-salesflash', 'display' );
			if ( $salesflash_display == 'hide' ) { 
				Plethora_CMS::remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
			}			
		}

		public static function single_breadcrumbs() {

			if ( is_product() ) {
				$breadcrumbs = Plethora::option( PLETHORA_META_PREFIX .'wooproduct-breadcrumbs', 'display');
				if ( $breadcrumbs == 'hide') { 
					Plethora_CMS::remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
				}

			}
		}

		public static function single_title() {

			$title_display = Plethora::option( PLETHORA_META_PREFIX .'wooproduct-title', 'display' );
			if ( $title_display == 'hide') { 
				Plethora_CMS::remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
			}
		}

		public static function single_rating() {

			$rating_display = Plethora::option( PLETHORA_META_PREFIX .'wooproduct-rating', 'display' );
			if ( $rating_display == 'hide') {
				Plethora_CMS::remove_action( 'woocommerce_single_product_summary', 	 'woocommerce_template_single_rating', 10 );
			}
		}

		public static function single_salesflash() {

			$salesflash_display = Plethora::option( PLETHORA_META_PREFIX .'wooproduct-sale', 'display' );
			if ( $salesflash_display == 'hide') {
				Plethora_CMS::remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );		
			}
		}

		public static function single_price() {

			$price_display = Plethora::option( PLETHORA_META_PREFIX .'wooproduct-price', 'display' );
			if ( $price_display == 'hide') {
				Plethora_CMS::remove_action( 'woocommerce_single_product_summary', 	 'woocommerce_template_single_price', 10 );	
			}
		}

		public static function single_addtocart() { 

			$cart_status = Plethora::option( PLETHORA_META_PREFIX .'wooproduct-addtocart', 'display');
			if ( $cart_status == 'hide') { 
				Plethora_CMS::remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
			}
		}

		public static function single_meta() { 

			$meta_display = Plethora::option( PLETHORA_META_PREFIX .'wooproduct-meta', 'display');
			if ( $meta_display == 'hide') { 
				Plethora_CMS::remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
			}
		}

		public static function single_tab_description( $tabs ) {

			$tab_display = Plethora::option( PLETHORA_META_PREFIX .'wooproduct-tab-description', 'display');
			if ( $tab_display == 'hide') { 
			    unset( $tabs['description'] );
		    }
		    return $tabs;
		}	        

		public static function single_tab_reviews( $tabs ) {
		  
			$tab_display = Plethora::option( PLETHORA_META_PREFIX .'wooproduct-tab-reviews', 'display');
			if ( $tab_display == 'hide') { 
			    unset( $tabs['reviews'] );
		    }
		    return $tabs;
		}	        

		public static function single_tab_attributes( $tabs ) {
		  
			$tab_display = Plethora::option( PLETHORA_META_PREFIX .'wooproduct-tab-attributes', 'display');
			if ( $tab_display == 'hide') { 
			    unset( $tabs['additional_information'] );
		    }
		    return $tabs;
		}	        

		public static function single_related( $args ) {

			$related = Plethora::option( PLETHORA_META_PREFIX .'wooproduct-related', 'display');
			if ($related == 'display') {
				return $args;
			} else { 
				return array();
			}
		} 

		public static function single_related_config( $args ) {

			$posts_per_page = Plethora::option( PLETHORA_META_PREFIX .'wooproduct-related-number', 4);
			$columns 		= Plethora::option( PLETHORA_META_PREFIX .'wooproduct-related-columns', 4);
			$args['posts_per_page'] = $posts_per_page; 
			$args['columns'] 		= $columns;
			return $args;
		}

		public static function single_upsell() {
			$upsell_display = Plethora::option( PLETHORA_META_PREFIX .'wooproduct-upsell', 'display');
			$upsell_results = Plethora::option( PLETHORA_META_PREFIX .'wooproduct-related-number', 4);
			$upsell_columns = Plethora::option( PLETHORA_META_PREFIX .'wooproduct-related-columns', 4);
			if ( $upsell_display == 'display' ) {
				woocommerce_upsell_display( $upsell_results, $upsell_columns ); 
			}
		}

		public static function global_cartbuttontext() {

			$button_text = Plethora::option( PLETHORA_META_PREFIX .'woo-cart-buttontext', __('Add to cart', 'cleanstart'), 0, false);
			return $button_text;
		}

	    public static function theme_options( $sections ) { 
			$page_for_shop	= get_option( 'woocommerce_shop_page_id', 0 );
			$desc_1 = '<a href="'. admin_url('/post.php?post='. $page_for_shop .'&action=edit') .'" target="blank">'.  __('Click here', 'cleanstart') .'</a> '. __('if you need to configure shop catalog display', 'cleanstart');
			$desc_2 = __('It seems that you <span style="color:red">have not set a shop page yet!</span> You should go for it, in order to be able to configure <u>shop catalog</u> display on selected page edit', 'cleanstart');
			$desc = $page_for_shop === 0 || empty($page_for_shop) ? $desc_2 :  $desc_1 ;
			$desc .= __('<br>If you are using a speed optimization plugin, don\'t forget to <strong>clear cache</strong> after options update', 'cleanstart');
	    	$this_section = array(
				'icon'       => 'el-icon-shopping-cart-sign',
				'icon_class' => 'icon-large',
				'title'      => __('WooCommerce', 'cleanstart'),
				'desc' =>  $desc,
				'fields'     => array(
					array(
						'id'    =>'header-singleproduct',
						'type'  => 'info',
						'title' => '<center>'. __('Single Product Display', 'cleanstart') .'</center>',
						'desc'  => '<center>'. __('All options can be overriden on a single product post', 'cleanstart') .'</center>',
				        ),

		            array(
		                'id'        =>  PLETHORA_META_PREFIX .'wooproduct-layout',
		                'title'     => __( 'Product Post Layout', 'cleanstart' ),
		                'default'   => 'right_sidebar',
		                'type'      => 'image_select',
		                'customizer'=> array(),
						'options' => array( 
								'full'         => ReduxFramework::$_url . 'assets/img/1c.png',
								'right_sidebar'         => ReduxFramework::$_url . 'assets/img/2cr.png',
								'left_sidebar'         => ReduxFramework::$_url . 'assets/img/2cl.png',
			                )
		            ),
					array(
						'id'=> PLETHORA_META_PREFIX .'wooproduct-sidebar',
						'required'=> array( PLETHORA_META_PREFIX .'wooproduct-layout','!=', 'full' ),
						'type' => 'select',
						'data' => 'sidebars',
						'multi' => false,
						'title' => __('Product Post Sidebar', 'cleanstart'), 
						'default'  => 'sidebar-woo-product',
						),

					array(
						'id'      => PLETHORA_META_PREFIX .'wooproduct-title',
						'type'    => 'button_set',
						'title'   => __('Title Display', 'cleanstart'),
						'desc'   => __('Display product title on content view', 'cleanstart'),
						"default" => 'display',
						'options' => array(
								'display' => __('Display', 'cleanstart'),
								'hide'   => __('Hide', 'cleanstart'),
								),
						),

					array(
						'id'      => PLETHORA_META_PREFIX .'wooproduct-breadcrumbs',
						'type'    => 'button_set',
						'title'   => __('Breadcrumbs ( Product Page )', 'cleanstart'),
						"default" => 'display',
						'options' => array(
								'display' => __('Display', 'cleanstart'),
								'hide'   => __('Hide', 'cleanstart'),
								),
						),
					array(
						'id'      => PLETHORA_META_PREFIX .'wooproduct-rating',
						'type'    => 'button_set',
						'title'   => __('Ratings ( Product Page )', 'cleanstart'),
						"default" => 'display',
						'options' => array(
								'display' => __('Display', 'cleanstart'),
								'hide'   => __('Hide', 'cleanstart'),
								),
						),
					array(
						'id'      => PLETHORA_META_PREFIX .'wooproduct-price',
						'type'    => 'button_set',
						'title'   => __('Price  ( Product Page )', 'cleanstart'),
						"default" => 'display',
						'options' => array(
								'display' => __('Display', 'cleanstart'),
								'hide'   => __('Hide', 'cleanstart'),
								),
						),
					array(
						'id'      => PLETHORA_META_PREFIX .'wooproduct-addtocart',
						'type'    => 'button_set',
						'title'   => __('"Add To Cart" Button ( Product Page )', 'cleanstart'),
						"default" => 'display',
						'options' => array(
								'display'		=> __('Display', 'cleanstart'),
								'hide'	=> __('Hide', 'cleanstart'),
								),
						),
					array(
						'id'      => PLETHORA_META_PREFIX .'wooproduct-meta',
						'type'    => 'button_set',
						'title'   => __('Product Categories', 'cleanstart'),
						"default" => 'display',
						'options' => array(
								'display'		=> __('Display', 'cleanstart'),
								'hide'	=> __('Hide', 'cleanstart'),
								),
						),
					array(
						'id'      => PLETHORA_META_PREFIX .'wooproduct-sale',
						'type'    => 'button_set',
						'title'   => __('"Sale" Icon ( Product Page )', 'cleanstart'),
						"default" => 'display',
						'options' => array(
								'display'		=> __('Display', 'cleanstart'),
								'hide'	=> __('Hide', 'cleanstart'),
								),
						),
					array(
						'id'      => PLETHORA_META_PREFIX .'wooproduct-tab-description',
						'type'    => 'button_set',
						'title'   => __('Description Tab', 'cleanstart'),
						"default" => 'display',
						'options' => array(
								'display'		=> __('Display', 'cleanstart'),
								'hide'	=> __('Hide', 'cleanstart'),
								),
						),
					array(
						'id'      => PLETHORA_META_PREFIX .'wooproduct-tab-reviews',
						'type'    => 'button_set',
						'title'   => __('Reviews Tab', 'cleanstart'),
						"default" => 'display',
						'options' => array(
								'display'		=> __('Display', 'cleanstart'),
								'hide'	=> __('Hide', 'cleanstart'),
								),
						),
					array(
						'id'      => PLETHORA_META_PREFIX .'wooproduct-tab-attributes',
						'type'    => 'button_set',
						'title'   => __('Additional Information Tab', 'cleanstart'),
						'descr'   => __('Remember that this tab is NOT displayed by defaul if product has no attributes', 'cleanstart'),
						"default" => 'display',
						'options' => array(
								'display'		=> __('Display', 'cleanstart'),
								'hide'	=> __('Hide', 'cleanstart'),
								),
						),
					array(
						'id'      => PLETHORA_META_PREFIX .'wooproduct-related',
						'type'    => 'button_set',
						'title'   => __('Related Products', 'cleanstart'),
						"default" => 'display',
						'options' => array(
								'display' => __('Display', 'cleanstart'),
								'hide'   => __('Hide', 'cleanstart'),
								),
						),
					array(
						'id'      => PLETHORA_META_PREFIX .'wooproduct-upsell',
						'type'    => 'button_set',
						'title'   => __('Upsell Products', 'cleanstart'),
						"default" => 'display',
						'options' => array(
								'display' => __('Display', 'cleanstart'),
								'hide'   => __('Hide', 'cleanstart'),
								),
						),

					array(
						'id'      => PLETHORA_META_PREFIX .'wooproduct-related-number',
						'type'        => 'slider',
						'title'       => __('Related/Upsell Products Max Results', 'cleanstart'), 
					    "default" => 4,
					    "min" => 2,
					    "step" => 1,
					    "max" => 36,
					    'display_value' => 'text'
						),

					array(
						'id'      => PLETHORA_META_PREFIX .'wooproduct-related-columns',
						'type'        => 'slider',
						'title'       => __('Related/Upsell Products Columns', 'cleanstart'), 
					    "default" => 4,
					    "min" => 2,
					    "step" => 1,
					    "max" => 4,
					    'display_value' => 'text'
						),

					array(
					       'id' => 'section-start',
					       'type' => 'section',
					       'title' => __('Single Product Head Panel', 'cleanstart'),
					       'subtitle' => __('Head Panel title & subtitle behavior on single product posts', 'cleanstart'),
					       'indent' => true
					   ),
					array(
						'id'       => PLETHORA_META_PREFIX .'wooproduct-headpanel-title',
						'type'     => 'button_set', 
						'title'    => __('Head Panel Title / Subtitle Behaviour', 'cleanstart'),
						'default'  => 'producttitle',
						'options'  => array(
								// 'shoptitle'   => __('Catalog Title / Subtitle', 'cleanstart'),
								'producttitle'   => __('Product Title / Custom Subtitle', 'cleanstart'),
								'customtitle' => __('Custom Title / Custom Subtitle', 'cleanstart'),
								'notitle'     => __('No Title / Subtitle', 'cleanstart')
							),
						),
					array(
						'id'       => PLETHORA_META_PREFIX .'wooproduct-headpanel-customtitle',
						'type'     => 'text', 
						'required' => array( PLETHORA_META_PREFIX .'wooproduct-headpanel-title','=', array('customtitle')),
						'title'    => __('Head Panel Title Text // Custom', 'cleanstart'),
						'default'  => __('This is the default single product custom title', 'cleanstart'),
						),
					array(
						'id'       => PLETHORA_META_PREFIX .'wooproduct-headpanel-customsubtitle',
						'required' => array( PLETHORA_META_PREFIX .'wooproduct-headpanel-title','=', array('producttitle','customtitle' )),
						'type'     => 'text', 
						'title'    => __('Head Panel Subtitle Text // Custom', 'cleanstart'),
						'default'  => __('This is the default single product custom subtitle', 'cleanstart'),
						),
					array(
					    'id'     => 'section-end',
					    'type'   => 'section',
					    'indent' => false,
					),
					// array(
					// 	'id'    =>'header-addtocart',
					// 	'type'  => 'info',
					// 	'title' => '<center>'. __('Cart Display Options', 'cleanstart') .'</center>'
				 //        ),
					// array(
					// 	'id'      => PLETHORA_META_PREFIX .'woo-cart-buttontext',
					// 	'type'     => 'text',
					// 	'title'    => __('"Add To Cart" Button Text', 'cleanstart'),
					// 	'default'  => __('Add to cart', 'cleanstart'),
					// 	),
				),	
			);
			$sections[] = $this_section;
			return $sections;
	    }

       /** 
       * Returns feature information for several uses by Plethora Core (theme options etc.)
       *
       * @return array
       * @since 1.0
       *
       */
       public static function get_feature_options() {

          $feature_options = array ( 
				'switchable'       => false,
				'options_title'    => 'Woocommerce Module',
				'options_subtitle' => 'Activate/deactivate Woocommerce module',
				'options_desc'     => 'On deactivation, all settings related to this feature will be removed. However, they will not be deleted permanently.',
            );
          
          return $feature_options;
       }

	}
}

// This should be applied before WC's activation, as it should declare shop image sizes right after theme activation
if ( !function_exists( 'plethora_woo_image_dimensions')) { 

	if ( !class_exists('Plethora_CMS')) { 

	class Plethora_CMS { 

		static function add_action() { }

	}

	}
	Plethora_CMS::add_action( 'after_setup_theme', 'image_dimensions' );

	function image_dimensions() { 

		global $pagenow;
		if ( ! isset( $_GET['activated'] ) || $pagenow != 'themes.php' ) {
		return;
		}
		$catalog = array(
		'width' => '326', // px
		'height'	=> '326', // px
		'crop'	=> 1 // true
		);
		$single = array(
		'width' => '547', // px
		'height'	=> '547', // px
		'crop'	=> 1 // true
		);
		$thumbnail = array(
		'width' => '168', // px
		'height'	=> '168', // px
		'crop'	=> 0 // false
		);
		// Image sizes
		Plethora_CMS::update_option( 'shop_catalog_image_size', $catalog ); // Product category thumbs
		Plethora_CMS::update_option( 'shop_single_image_size', $single ); // Single product image
		Plethora_CMS::update_option( 'shop_thumbnail_image_size', $thumbnail ); // Image gallery thumbs 

	}


}