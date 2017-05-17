<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M            (c) 2014

Description: Inlcudes theme and third party configuration methods.
Class index:
1. Init method
2. Basic configuration methods
3. Third party configuration methods
4. Data returning methods
5. Plethora Framework intermediary methods 
6. Cleanstart-only deprecated methods

*/

if ( ! defined( 'ABSPATH' ) ) exit; // NO DIRECT ACCESS 

if ( !class_exists('Plethora_Theme') ) {

  class Plethora_Theme { 

    static function init() {

    // BASIC CONFIGURATION ------> START

       // Tasks performed after theme update
        self::after_theme_update();
      // Enqueue scripts & styles
        add_action( 'wp_enqueue_scripts', array( 'Plethora_Theme', 'enqueue'), 1 );
      // Dequeue scripts & styles
        add_action( 'admin_enqueue_scripts', array( 'Plethora_Theme', 'dequeue' ), 100 );
      // Register navgation 
        add_action( 'init', array( 'Plethora_Theme', 'register_navigation' ));
      // Register widgetized areas 
        add_action( 'widgets_init', array( 'Plethora_Theme', 'register_sidebars' ));
      // Add post thumbnails
        add_theme_support( 'post-thumbnails' );
      // Additional thumbnail sizes
        add_image_size( 'thumb-portfolio', 210, 210, true );
      // Post formats support
        add_theme_support( 'post-formats', array( 'video', 'audio' ) );
      // Automatic feed links support
        add_theme_support( 'automatic-feed-links' );        
      // Set the $content_width variable
        if ( ! isset( $content_width ) ) {  $content_width = 960; }
      // Filter for body class
        add_filter('body_class', array('Plethora_Theme', 'body_class'));
      // Place custom JS on footer ( depending on theme settings )
        add_action('wp_footer', array('Plethora_Theme', 'set_custom_js'), 20); 
      // Place custom CSS on head ( depending on theme settings )
        add_action('wp_head', array('Plethora_Theme', 'set_custom_css'), 1007); 
      // Place headpanel CSS on head ( depending on theme settings )
        add_action('wp_head', array('Plethora_Theme', 'set_headpanel_height_css'), 1006); 

    // BASIC CONFIGURATION <------ END

    // THIRD PARTY CONFIGURATION > START

      // VISUAL COMPOSER
        // VC shortcodes configuration
        self::vc_config(); 
        // add Prettyphoto functionality to single image shortcode                                                                                   
        add_action('vc_after_init', array( 'Plethora_Theme', 'vc_single_image_prettyphoto' )); 
        // Custom VC Templates               
        add_action('vc_load_default_templates_action', array( 'Plethora_Theme', 'load_custom_templates' ) );  

      // CONTACT FORM 7
      // Fix for default markup & styling
        add_filter( 'wpcf7_form_elements', array('Plethora_Theme', 'wpcf7_form_elements') );

      // SOUNDCLOUD & OTHER EMBEDED MEDIA
      // FIX for oEMBEDS to comply with W3C validation
        add_filter('oembed_dataparse', array( 'Plethora_Theme', 'soundcloud_oembed_filter'), 90, 3 );

      // Check saved GMap API key value
      $googlemaps_apikey = Plethora_Theme::option( 'googlemaps_apikey', 'AIzaSyASx7Yyj-g_0QtSwOsaDXiTPy5_SVdujbU' );

      if ( empty( $googlemaps_apikey ) ) {

        add_action( 'admin_notices', array( 'Plethora_Theme', 'notice_gmaps_apikey_not_found' ) );
      }

    // THIRD PARTY CONFIGURATION > END

    // ADDITIONAL CONFIGURATION -> START

      // Convert menu item 'css class' input into select field ( check Admin > Appearence > Menus )
        add_action('admin_footer', array('Plethora_Theme', 'menu_item_classes')); 

    // ADDITIONAL CONFIGURATION -> END

    }

//////////////// BASIC CONFIGURATION METHODS ------> START

    /**
    * The method compares theme saved version with this one running. 
    * If different, it executes all actions set for execution right after theme update
    *
    * @since 1.2
    *
    */
    static function after_theme_update() { 

      $theme_version_db = method_exists('Plethora_CMS', 'get_option') ? Plethora_CMS::get_option( 'plethora_theme_version' ) : get_option( 'plethora_theme_version' ) ;
      if (  $theme_version_db != THEME_VERSION ) { 

        // Recovers TGM notices, even if the user has dismissed this. 
        // MUST be done on every theme update, to make sure the current user gets a notice about the Plethora Framework plugin update
        update_user_meta( get_current_user_id(), 'tgmpa_dismissed_notice', 0 );

        // Remove per-page logo settings metabox values ( otherwise, global settings cannot be applied and users will not have any other way to control it! )
        $args = array();
        $args['post_type'] = array( 'post', 'page', 'portfolio' );
        $args['post_status'] = array( 'any' );
        $args['posts_per_page'] = -1;
        $args['ignore_sticky_posts'] = 1;
        $args['fields'] = 'ids';
        $query = new WP_Query( $args );
        if ($query->have_posts()) { 
           while ( $query->have_posts() ) : $query->the_post(); 
              delete_post_meta( get_the_ID(), 'header-logo-img-size');
              delete_post_meta( get_the_ID(), 'header-logo-container-padding');
           endwhile; 
        }
        wp_reset_postdata();
        // After done with all actions, we update saved theme version
        $is_updated = method_exists('Plethora_CMS', 'update_option') ? Plethora_CMS::update_option('plethora_theme_version', THEME_VERSION ) : update_option('plethora_theme_version', THEME_VERSION );

      }

    }

    /**
     * Enqueue Scripts and Styles
     *
     * @param 
     * @return 
     * @since 1.0
     *
     */
    static function enqueue() {

    //  Registering MANDATORY theme SCRIPTS / STYLES

            $development = self::option( PLETHORA_META_PREFIX . 'development' );

            if ( $development === 'development' ) {

              // SCRIPTS
              wp_register_script ( 'modernizr',           THEME_ASSETS_URI . '/js/modernizr.custom.48287.js',            array(),            '', FALSE ); 
              wp_register_script ( 'boostrap',            THEME_ASSETS_URI . '/twitter-bootstrap/js/bootstrap.min.js',   array( 'jquery' ),  '', TRUE ); 
              wp_register_script ( 'easing',              THEME_ASSETS_URI . '/js/jquery.easing.1.3.min.js',             array( 'jquery' ),  '', TRUE ); 
              wp_register_script ( 'wow',                 THEME_ASSETS_URI . '/js/wow.min.js',                           array( 'jquery' ),  '', TRUE ); 
              wp_register_script ( 'simple-text-rotator', THEME_ASSETS_URI . '/js/jquery.simple-text-rotator.min.js',    array( 'jquery' ),  '', TRUE ); 
              wp_register_script ( 'cleanstart',          THEME_ASSETS_URI . '/cleanstart_theme.js',                     array( 'jquery' ),  '', TRUE ); 
              wp_register_script ( 'collapser',           THEME_ASSETS_URI . '/js/collapser.min.js',                     array( 'jquery' ),  '', TRUE ); 
              wp_register_script ( 'flexslider-cleanstart', THEME_ASSETS_URI . '/js/flexslider/jquery.flexslider-min.js',array( 'jquery' ),  '', TRUE ); 
              wp_register_script ( 'js_composer_front',   WP_PLUGIN_URL . '/js_composer/assets/js/js_composer_front.js', array( 'jquery' ),  '', TRUE ); 
            
              wp_enqueue_script( 'modernizr' );
              wp_enqueue_script( 'boostrap' );
              wp_enqueue_script( 'easing' );
              wp_enqueue_script( 'wow' );
              wp_enqueue_script( 'simple-text-rotator' );
              wp_enqueue_script( 'js_composer_front' );

              // STYLES
              wp_register_style( 'animate-css',          THEME_ASSETS_URI . '/css/animate.css' ); 
              wp_register_style( 'mainmenu-css',         THEME_ASSETS_URI . '/css/mainmenu.css' ); 
              wp_register_style( 'fontawesome',          THEME_ASSETS_URI . '/fonts/font-awesome-4/css/font-awesome.min.css' ); 
              wp_register_style( 'simple-text-rotator',  THEME_ASSETS_URI . '/css/simpletextrotator.css' ); 
              wp_register_style( 'flexslider-cleanstart',THEME_ASSETS_URI . '/js/flexslider/flexslider.css' ); 

              wp_enqueue_style( 'animate-css' );
              wp_enqueue_style( 'bootstrap' );
              wp_enqueue_style( 'mainmenu-css' );
              wp_enqueue_style( 'fontawesome' );
              wp_enqueue_style( 'simple-text-rotator' );
              wp_enqueue_style( 'flexslider-cleanstart' );  

            } else {

              wp_register_script ( 'cleanstart_libs',     THEME_ASSETS_URI . '/cleanstart_libs.js',                      array( 'jquery' ),  '', TRUE ); 
              wp_register_script ( 'collapser',           THEME_ASSETS_URI . '/js/collapser.min.js',                     array( 'jquery' ),  '', TRUE ); 
              wp_register_script ( 'flexslider-cleanstart', THEME_ASSETS_URI . '/js/flexslider/jquery.flexslider-min.js',array( 'jquery' ),  '', TRUE ); 

              // STYLES
              wp_register_style( 'cleanstart_style',THEME_ASSETS_URI . '/css/cleanstart_style.min.css' ); 
              wp_enqueue_style( 'bootstrap' );
              wp_enqueue_style( 'cleanstart_style' );

            }

    //  OPTIONAL SCRIPTS / STYLES ( loaded selectively )

         // Back to top button
        $backtotop   = self::option( 'backtotop-status', 1, 0, false);
        if ( $backtotop == 1 ) { 

            wp_register_script( 'backtotop', THEME_ASSETS_URI . '/js/jquery.ui.totop.js', 'jquery', '', TRUE); 
            wp_enqueue_script( 'backtotop' ); 
        }

        // Twitter Feed Script
        $twitterfeed   = self::option( PLETHORA_META_PREFIX .'footer-twitterfeed', 1, 0, false);
        if ( $twitterfeed == 1 ) {
            wp_register_script( 'twitter_feed', THEME_ASSETS_URI . '/cleanstart_twitterfeedslider.min.js', array('jquery','flexslider-cleanstart'), '', TRUE); 
            wp_enqueue_script( 'twitter_feed' ); 
        }

        // Portfolio single view // Slider
        if ( is_single() && get_post_type() == 'portfolio' ) { 
            
            wp_register_script('imagelightbox-plethora',  THEME_ASSETS_URI . '/js/imagelightbox.min.js',  array( 'jquery' ),  '', TRUE ); 
            wp_enqueue_script( 'imagelightbox-plethora');
            wp_register_style( 'imagelightbox-plethora',  THEME_ASSETS_URI . '/js/flexslider/flexslider.css' ); 
            wp_enqueue_style(  'imagelightbox-plethora');


            wp_enqueue_script('flexslider-cleanstart');
            wp_enqueue_style( 'flexslider-cleanstart' );

            //inits
            wp_register_script ( 'portfolio-slider',  THEME_ASSETS_URI . '/cleanstart_portfolioslider.min.js',  array('flexslider-cleanstart'),  '', TRUE ); // OK

        }

            if ( $development === 'development' ) { 
              wp_enqueue_script( 'cleanstart' );
            } else {
              wp_enqueue_script( 'cleanstart_libs' );
            }

            wp_enqueue_script( 'portfolio-slider' );
            wp_enqueue_script( 'collapser' );

    }

    /**
     * Dequeue ace.js editor from post/page editor to avoid conflicts with VC ace.js editor
     *
     * @param 
     * @return 
     * @since 1.0
     *
     */
    static function dequeue( $hook ) {
      if ( 'toplevel_page_cleanstart_options' == $hook ) { return; }
      wp_dequeue_script( 'ace-editor-js' );
      wp_dequeue_script( 'redux-field-ace-editor-js' );
      wp_dequeue_style( 'redux-field-ace-editor-css' );
    }

    /**
     * Register Navigation Menu
     *
     * @param 
     * @return 
     * @since 1.0
     *
     */
    static function register_navigation() {

      register_nav_menu( 'primary', __( 'Primary Navigation', 'cleanstart') );
	  register_nav_menu( 'footer', __( 'Footer Navigation', 'cleanstart') );
      register_nav_menu( 'toolbar', __( 'Top Header Navigation', 'cleanstart') );
	  register_nav_menu( 'taxtools', __( 'Tax Tools Navigation', 'cleanstart') );
	  register_nav_menu( 'sidebarmenu', __( 'Side Bar Navigation', 'cleanstart') );
	  register_nav_menu( 'individual', __( 'individual Bar Navigation', 'cleanstart') );
	  register_nav_menu( 'startabusiness', __( 'startabusiness Bar Navigation', 'cleanstart') );
	  register_nav_menu( 'businesssol', __( 'businesssol Bar Navigation', 'cleanstart') );
	  register_nav_menu( 'learningcentre', __( 'learningcentre Bar Navigation', 'cleanstart') );
	  register_nav_menu( 'contactus', __( 'contactus Bar Navigation', 'cleanstart') );


    }

    /**	
     * Register Sidebars. 
     *
     * @param 
     * @return 
     * @since 1.0
     *
     */
    static function register_sidebars() {

      $footer_layout   = self::option( 'footer-layout', 5, 0, false);

      switch ( $footer_layout ) {
        case '1':
          $sidebar1_desc = __( 'Footer Widget Area | Column 1', 'cleanstart' );
          $sidebar2_desc = __( 'This widget area is inactive. You may activate this area on CleanStart > Header', 'cleanstart' );
          $sidebar3_desc = __( 'This widget area is inactive. You may activate this area on CleanStart > Header', 'cleanstart' );
          $sidebar4_desc = __( 'This widget area is inactive. You may activate this area on CleanStart > Header', 'cleanstart' );
          break;

        case '2':
          $sidebar1_desc = __( 'Footer Widget Area | Column 1', 'cleanstart' );
          $sidebar2_desc = __( 'Footer Widget Area | Column 2', 'cleanstart' );
          $sidebar3_desc = __( 'This widget area is inactive. You may activate this area on CleanStart > Header', 'cleanstart' );
          $sidebar4_desc = __( 'This widget area is inactive. You may activate this area on CleanStart > Header', 'cleanstart' );
          break;

        case '3':
          $sidebar1_desc = __( 'Footer Widget Area | Column 1', 'cleanstart' );
          $sidebar2_desc = __( 'Footer Widget Area | Column 2', 'cleanstart' );
          $sidebar3_desc = __( 'This widget area is inactive. You may activate this area on CleanStart > Header', 'cleanstart' );
          $sidebar4_desc = __( 'This widget area is inactive. You may activate this area on CleanStart > Header', 'cleanstart' );
          break;

        case '4':
          $sidebar1_desc = __( 'Footer Widget Area | Column 1', 'cleanstart' );
          $sidebar2_desc = __( 'Footer Widget Area | Column 2', 'cleanstart' );
          $sidebar3_desc = __( 'This widget area is inactive. You may activate this area on CleanStart > Header', 'cleanstart' );
          $sidebar4_desc = __( 'This widget area is inactive. You may activate this area on CleanStart > Header', 'cleanstart' );
          break;

        case '5':
          $sidebar1_desc = __( 'Footer Widget Area | Column 1', 'cleanstart' );
          $sidebar2_desc = __( 'Footer Widget Area | Column 2', 'cleanstart' );
          $sidebar3_desc = __( 'Footer Widget Area | Column 3', 'cleanstart' );
          $sidebar4_desc = __( 'This widget area is inactive. You may activate this area on CleanStart > Header', 'cleanstart' );
          break;

        case '6':
          $sidebar1_desc = __( 'Footer Widget Area | Column 1', 'cleanstart' );
          $sidebar2_desc = __( 'Footer Widget Area | Column 2', 'cleanstart' );
          $sidebar3_desc = __( 'Footer Widget Area | Column 3', 'cleanstart' );
          $sidebar4_desc = __( 'This widget area is inactive. You may activate this area on CleanStart > Header', 'cleanstart' );
          break;

        case '7':
          $sidebar1_desc = __( 'Footer Widget Area | Column 1', 'cleanstart' );
          $sidebar2_desc = __( 'Footer Widget Area | Column 2', 'cleanstart' );
          $sidebar3_desc = __( 'Footer Widget Area | Column 3', 'cleanstart' );
          $sidebar4_desc = __( 'This widget area is inactive. You may activate this area on CleanStart > Header', 'cleanstart' );
          break;

        case '8':
          $sidebar1_desc = __( 'Footer Widget Area | Column 1', 'cleanstart' );
          $sidebar2_desc = __( 'Footer Widget Area | Column 2', 'cleanstart' );
          $sidebar3_desc = __( 'Footer Widget Area | Column 3', 'cleanstart' );
          $sidebar4_desc = __( 'Footer Widget Area | Column 4', 'cleanstart' );
          break;

        default:
          $sidebar1_desc = __( 'Footer Widget Area | Column 1', 'cleanstart' );
          $sidebar2_desc = __( 'Footer Widget Area | Column 2', 'cleanstart' );
          $sidebar3_desc = __( 'Footer Widget Area | Column 3', 'cleanstart' );
          $sidebar4_desc = __( 'This widget area is inactive. You may activate this area on CleanStart > Header', 'cleanstart' );
          break;
      }

     $sidebar_default = array(
        'name'          => __( 'Blog Sidebar', 'cleanstart' ),
        'id'            => 'sidebar-default',
        'class'         => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>' ); 

     $sidebar_pages = array(
        'name'          => __( 'Pages Sidebar', 'cleanstart' ),
        'id'            => 'sidebar-pages',
        'class'         => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>' ); 

     $sidebar_footer_one = array(
        'name'          => __( 'Footer Column #1', 'cleanstart' ),
        'id'            => 'sidebar-footer-one',
        'description'   => $sidebar1_desc,
        'class'         => '',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>' ); 

      $sidebar_footer_two = array(
        'name'          => __( 'Footer Column #2', 'cleanstart' ),
        'id'            => 'sidebar-footer-two',
        'description'   => $sidebar2_desc,
        'class'         => '',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>' ); 

      $sidebar_footer_three = array(
        'name'          => __( 'Footer Column #3', 'cleanstart' ),
        'id'            => 'sidebar-footer-three',
        'description'   => $sidebar3_desc,
        'class'         => '',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>' ); 

      $sidebar_footer_four = array(
        'name'          => __( 'Footer Column #4', 'cleanstart' ),
        'id'            => 'sidebar-footer-four',
        'description'   => $sidebar4_desc,
        'class'         => '',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>' ); 


      register_sidebar( $sidebar_default ); 
      register_sidebar( $sidebar_pages ); 
      register_sidebar( $sidebar_footer_one ); 
      register_sidebar( $sidebar_footer_two ); 
      register_sidebar( $sidebar_footer_three ); 
      register_sidebar( $sidebar_footer_four );       

      $sidebars   = self::option( 'sidebars-number', 0, 0, false);
      for ($x=1; $x<=$sidebars; $x++) {

          $sidebar = array(
              'name'          => __( 'Sidebar #', 'cleanstart' ) . $x ,
              'id'            => 'sidebar-'. $x .'',
              'description'   => __('This is a custom bar, created using Theme Settings panel','cleanstart'),
                'class'         => '',
              'before_widget' => '<aside id="%1$s" class="widget %2$s">',
              'after_widget'  => '</aside>',
              'before_title'  => '<h4>',
              'after_title'   => '</h4>' );  
          register_sidebar( $sidebar ); 
      }

    }

    /**
     * Adds custom JS script to footer
     *
     * @param
     * @return string
     *
     */
    static function set_custom_js() {

      $custom_js = self::option('custom-js');

      if ( !empty( $custom_js ) ) { 

          $html  = "\n<script type=\"text/javascript\">\n";
          $html .= trim($custom_js) ."\n"; 
          $html .= "</script>\n";
        
        echo $html;

      } 
    }    

    /**
     * Adds custom CSS style field to footer
     *
     * @param 
     * @return string
     *
     */
    static function set_custom_css() {

      $custom_css = self::option('custom-css');

      if ( !empty( $custom_css ) ) { 

          $html  = '<style type="text/css">' ."\n"; 
          $html .= trim($custom_css) ."\n"; 
          $html .= "</style>\n";
        
        echo $html;

      } 
    }    

    /**
     * Adds custom CSS style field to footer
     *
     * @param 
     * @return string
     *
     */
    static function set_headpanel_height_css() {

      // Media height
      $dims_media   = self::option( PLETHORA_META_PREFIX .'header-media-dimensions' );
      $height_media = !empty($dims_media['height']) ? $dims_media['height'] : '265';
      $unit_media =  is_numeric($height_media) ? 'px' : '';
      // No media height
      $dims_no   = self::option( PLETHORA_META_PREFIX .'header-media-nomediadimensions' );
      $height_no = !empty($dims_no['height']) ? $dims_no['height'] : '480';
      $unit_no =  is_numeric($height_no) ? 'px' : '';

      // Output
      $html  = '<style type="text/css">' ."\n"; 
      $html .= !empty($height_media) ? '.full_page_photo { height:'.$height_media.$unit_media.';}' ."\n" : '';
      $html .= !empty($height_no) ? '.full_page_photo.no_photo { height:'.$height_no.$unit_no.';}' ."\n" : '';
      $html .= "</style>\n";
      echo $html;

    }    

    /**
     * A filter for body_class, when menu is not sticky
     *
     * @param 
     * @return number / string ('nonstatic', '404page')
     * @since 1.0
     *
     */

    static function body_class( $classes ) { 

      $header_sticky = self::option( PLETHORA_META_PREFIX .'header-sticky', 1, 0, false);

      if ( $header_sticky == 0) { 

        $classes = str_replace( 'sticky_header', '', $classes);  // Just removed sticky_header class;

      }
      return $classes;

    }

    /**
     * Returns analytics script
     *
     * @param $position ( header, footer )
     * @return string
     *
     */
    static function analytics( $position ) {

      if ( empty($position) ) { return; }

      $analytics_code           = self::option('analytics-code');
      $analytics_code_placement = self::option('analytics-code-placement');

      if ( !empty( $analytics_code ) && $analytics_code_placement ===  $position ) { 

          $html  = "\n<script type='text/javascript'>\n";
          $html .= trim($analytics_code) ."\n"; 
          $html .= "</script>\n";
        
        return $html;

      } 
    }    

    /**
     * Enqueue a JS hack that converts CSS classes input to select on menu items ( Appearence > Menus )
     *
     * @param 
     * @return
     * @since 1.0
     *
     */

    static function menu_item_classes(){
        global $pagenow;
        if ($pagenow == "nav-menus.php") {
            wp_register_script('menuitem-plethora',  THEME_ASSETS_URI . '/js/menu_class_input_to_select.js',  array( 'jquery' ),  '', TRUE ); // ok
            wp_enqueue_script( 'menuitem-plethora');
        }
    }

//////////////// BASIC CONFIGURATION METHODS <------ END


//////////////// THIRD PARTY CONFIGURATION METHODS ----> START

    /**
    * Enable/disable Visual Composer elements
    *
    * @since 1.3
    *
    */
    static function vc_config() { 

      if ( function_exists( 'vc_remove_element' )) {

        // VC Elements configuration
          // vc_remove_element( 'vc_accordion' );
          // vc_remove_element( 'vc_accordion_tab' );
          vc_remove_element( 'vc_button' );
          vc_remove_element( 'vc_button2' );
          vc_remove_element( 'vc_carousel' );
          // vc_remove_element( 'vc_column_text' );
          vc_remove_element( 'vc_cta_button' );
          vc_remove_element( 'vc_cta_button2' );
          // vc_remove_element( 'vc_facebook' );
          vc_remove_element( 'vc_flickr' );
          vc_remove_element( 'vc_gallery' );
          vc_remove_element( 'vc_gmaps' );
          // vc_remove_element( 'vc_googleplus' );
          vc_remove_element( 'vc_images_carousel' );
          // vc_remove_element( 'vc_message' );
          // vc_remove_element( 'vc_pie' );
          // vc_remove_element( 'vc_pinterest' );
          vc_remove_element( 'vc_posts_grid' );
          vc_remove_element( 'vc_posts_slider' );
          vc_remove_element( 'vc_progress_bar' );
          // vc_remove_element( 'vc_raw_html' );
          // vc_remove_element( 'vc_raw_js' );
          // vc_remove_element( 'vc_separator' );
          // vc_remove_element( 'vc_single_image' );
          // vc_remove_element( 'vc_tab' );
          // vc_remove_element( 'vc_tabs' );
          vc_remove_element( 'vc_teaser_grid' );
          // vc_remove_element( 'vc_text_separator' );
          // vc_remove_element( 'vc_toggle' );
          vc_remove_element( 'vc_tour' );
          // vc_remove_element( 'vc_twitter' );
          // vc_remove_element( 'vc_tweetmeme' );
          // vc_remove_element( 'vc_video' );
          // vc_remove_element( 'vc_widget_sidebar' );
          // WP shortcodes by VC
          // vc_remove_element( 'vc_wp_archives' );
          // vc_remove_element( 'vc_wp_calendar' );
          // vc_remove_element( 'vc_wp_categories' );
          // vc_remove_element( 'vc_wp_custommenu' );
          // vc_remove_element( 'vc_wp_links' );
          // vc_remove_element( 'vc_wp_meta' );
          // vc_remove_element( 'vc_wp_posts' );
          // vc_remove_element( 'vc_wp_recentcomments' );
          // vc_remove_element( 'vc_wp_pages' );
          // vc_remove_element( 'vc_wp_rss' );
          // vc_remove_element( 'vc_wp_tagcloud' );
          // vc_remove_element( 'vc_wp_text' );
          // vc_remove_element( 'vc_wp_search' );
          // Third party 
          // vc_remove_element( 'contact-form-7' );
          // vc_remove_element( 'gravityform' );
          // vc_remove_element( 'layerslider_vc' );
          // vc_remove_element( 'rev_slider_vc' );
          vc_remove_element( 'vc_custom_heading' );

        // VC Elements Parameter Configuration
          vc_remove_param("vc_single_image", "img_link_target"); // Remove link target ( since we use prettyphoto by default )

      }

    }

    /**
     * Loads custom VC templates
     *
     * @param 
     * @return string
     *
     */
    static function load_custom_templates() {

      /** Home Page Template */

      $data                  = array();
      $data['name']          = __( 'Home Page', 'cleanstart' );
      $data['image_path']    = preg_replace( '/\s/', '%20', get_template_directory_uri() . '/assets/images/vc_template_home.jpg' ); 
      $data['custom_class']  = 'custom_template_for_vc_custom_template';
      $data['content']       = '[vc_row][vc_column width="1/3" border="right" border_width="1" color="#cccccc"][sc_featureteaser image="37" border_line="Right" title="CLEAN, RESPONSIVE DESIGN" text_content="A multipurpose but mainly business oriented design, built to serve as a foundation for your web projects. Suspendisse nec risus fermentum sapien congue fermentum sed at lorem." image="37" image_link="#"]A multipurpose but mainly business oriented design, built to serve as a foundation for your web projects. The post-flat approach in UI will add uniqueness to your project.[/sc_featureteaser][/vc_column][vc_column width="1/3" border="right" border_width="1" color="#cccccc"][sc_featureteaser image="35" border_line="Right" title="BASED ON TWITTER BOOTSTRAP" text_content="The front-end development framework with a steep learning curve. It changes the way you develop sites. Suspendisse nec risus fermentum sapien congue fermentum sed at lorem." image="35" image_link="#"]<span style="color: #666666;">The front-end development framework with a steep learning curve. Cleanstart comes with a style.less file that tries to use all the power of {less} and bootstrap combined.</span>[/sc_featureteaser][/vc_column][vc_column width="1/3"][sc_featureteaser image="36" border_line="None" title="Visual Composer Integration" text_content="Cleanstart comes with a style.less file that tries to use all the power of {less} and bootstrap combined. Suspendisse nec risus fermentum sapien congue fermentum sed at lorem." image="36" image_link="#"]<span style="color: #666666;">Cleanstart lets you build your pages and posts with a Visual Builder and a great collection of Custom Shortcodes that offer flexibility and pixel-perfect design.</span>[/sc_featureteaser][/vc_column][/vc_row][vc_row title_style="fancy" background="dark_section" parallax="off" overlay="on" triangles="off" top_margin="off"][vc_column width="1/1"][sc_calltoaction subtitle="and make the web a little bit prettier" button="1" button_text="Buy this theme!" button_link="url:%23|title:Buy%20this%20theme!|" button_class="btn-primary" button_size="btn" title="Zm9jdXMlMjBvbiUyMHdoYXQlRTIlODAlOTlzJTIwJTNDc3Ryb25nJTNFJTNDc3BhbiUyMGNsYXNzJTNEJTIycm90YXRlJTIyJTNFaW1wb3J0YW50JTJDJTIwc2ltcGxlJTJDJTIwaW5ub3ZhdGl2ZSUzQyUyRnNwYW4lM0UlM0MlMkZzdHJvbmclM0U="]
      <h3 style="font-weight: 300; color: #efefef;">FOCUS ON WHAT\'S <span style="font-weight: bold;"><span class="rotate"><span class="rotating flip up"><span class="front">INNOVATIVE,</span><span class="back">IMPORTANT</span></span></span></span></h3>
      [/sc_calltoaction][/vc_column][/vc_row][vc_row title_header="RECENT PROJECTS FROM PORTFOLIO" title_subheader="we take pride in our work" title_style="fancy" background="light_section" parallax="off" overlay="on" triangles="on"][vc_column width="1/1"][sc_portfoliogrid layout="classic" layout_columns="3" results="3" orderby="date" category_filters="no"][sc_button button_link="url:http%3A%2F%2Fplethorathemes.com%2Fdev%2Fcleanstart%2F%3Fp%3D395|title:MORE%20WORK|target:%20_blank" button_class="btn-primary" button_size="btn"][/vc_column][/vc_row][vc_row title_header="OUR DEAR CLIENTS" title_subheader="all of them are satisfied" title_style="elegant" background="light_section" parallax="off" overlay="on" triangles="off"][vc_column width="1/1"][sc_clients client_images="112,111,110,113"][/vc_column][/vc_row]';

      vc_add_default_templates( $data );

      /** About Us Page Template */

      $data                 = array();
      $data['name']         = __( 'About Us Page', 'cleanstart' );
      $data['image_path']    = preg_replace( '/\s/', '%20', get_template_directory_uri() . '/assets/images/vc_template_about_us.jpg' ); 
      $data['custom_class'] = 'custom_template_for_vc_custom_template';
      $data['content']      = '[vc_row][vc_column width="1/1"][sc_Horizontalteaser title="We care for our work" text="Vivamus vestibulum neque quis nunc convallis venenatis. Nulla tristique lorem sit amet ipsum ornare sit amet feugiat nulla condimentum. Sed faucibus volutpat nunc, at ullamcorper augue elementum id. Quisque at lectus leo, nec placerat mi. Curabitur egestas eleifend interdum. Suspendisse potenti. Suspendisse nec risus. Curabitur egestas eleifend interdum. Suspendisse potenti. Suspendisse nec risus. Vivamus vestibulum neque quis nunc convallis venenatis. Nulla tristique lorem sit amet ipsum ornare sit amet feugiat nulla condimentum." text_width="4" textposition="left" media_type="video" video_link="http://player.vimeo.com/video/71409522?title=0&amp;byline=0&amp;portrait=0" default_offset="0.5" orientation="horizontal"]Our team strives to achieve excellence in every aspect of the production process, from the preliminary hand-drawn sketches to the aftersales support. We carefully design our themes to be easy and flexible while making sure that most FAQ of our customers can be answered by our <a href="/documentation/">detailed documentation</a>. We focus on using the latest web standards and practices regarding UX guidelines and Wordpress theme development and strongly encourage our customers to follow us on this. The use of a child theme and the plugin-based development of &copy;Plethora Framework ensure hassle-free updates and peace of mind.[/sc_Horizontalteaser][/vc_column][/vc_row][vc_row title_style="elegant" background="dark_section" background_image="80" parallax="on" overlay="on" triangles="off"][vc_column width="1/1"][sc_calltoaction title="Z2l2ZSUyMHlvdXIlMjAlM0NzdHJvbmclM0VjcmVhdGl2ZSUzQyUyRnN0cm9uZyUzRSUyMGlkZWFzJTIwYSUyMGJvb3N0" subtitle="Mouse over our team photos to see a cool effect!" button="0" button_text="Buy this theme!" icon_image="85" button_link="Buy this theme!" button_class="btn-primary" button_size="btn"]GIVE YOUR <strong>CREATIVE</strong> IDEAS A BOOST[/sc_calltoaction][/vc_column][/vc_row][vc_row title_header="MEET OUR TEAM..." title_subheader="they are always up to something good!" title_style="fancy" background="light_section" parallax="off" overlay="off" triangles="on"][vc_column width="1/1"][sc_teamgrid columns="4" members="97,94,91,88" orderby="title" order="ASC" show_photo="1" photo_effect="1" show_profession="1" show_desc="1" show_social="1"][/vc_column][/vc_row]';

      vc_add_default_templates( $data );

      /** Services Page Template */

      $data                 = array();
      $data['name']         = __( 'Services Page', 'cleanstart' );
      $data['image_path']    = preg_replace( '/\s/', '%20', get_template_directory_uri() . '/assets/images/vc_template_services.jpg' ); 
      $data['custom_class'] = 'custom_template_for_vc_custom_template';
      $data['content']      = '[vc_row][vc_column width="1/1"][sc_Horizontalteaser title="Trust our vision!" text="Vivamus vestibulum neque quis nunc convallis venenatis. Nulla tristique lorem sit amet ipsum ornare sit amet feugiat nulla condimentum. Sed faucibus volutpat nunc, at ullamcorper augue elementum id. Quisque at lectus leo, nec placerat mi. Curabitur egestas eleifend interdum. Suspendisse potenti. Suspendisse nec risus. Vivamus vestibulum neque quis nunc convallis venenatis. Nulla tristique lorem sit amet ipsum ornare sit amet feugiat nulla condimentum. Sed faucibus volutpat nunc, at ullamcorper augu." text_width="4" textposition="left" media_type="2020" video_link="http://player.vimeo.com/video/71409522?title=0&amp;byline=0&amp;portrait=0" before_image="121" after_image="117" default_offset="0.5" orientation="horizontal"]Vivamus vestibulum neque quis nunc convallis venenatis. Nulla tristique lorem sit amet ipsum ornare sit amet feugiat nulla condimentum. Sed faucibus volutpat nunc, at ullamcorper augue elementum id. Quisque at lectus leo, nec placerat mi. Curabitur egestas eleifend interdum. Suspendisse potenti. Suspendisse nec risus. Vivamus vestibulum neque quis nunc convallis venenatis. Nulla tristique lorem sit amet ipsum ornare sit amet feugiat nulla condimentum. Sed faucibus volutpat nunc, at ullamcorper augu.[/sc_Horizontalteaser][/vc_column][/vc_row][vc_row title_header="WE PROVIDE SERVICES" title_subheader="that stand out for their quality" title_style="fancy" background="dark_section" parallax="off" overlay="on" triangles="on"][vc_column width="1/3"][sc_serviceteaser image="125" title="Design" text_content="Quisque at lectus leo, nec placerat mi. Curabitur egestas eleifend interdum. Suspendisse potenti. Suspendisse nec risus fermentum." button_enable="2" button_link="url:%23||" button_class="btn-primary" image_link="#" button_size="btn"]Quisque at lectus leo, nec placerat mi. Curabitur egestas eleifend interdum. Suspendisse potenti. Suspendisse nec risus fermentum.[/sc_serviceteaser][/vc_column][vc_column width="1/3"][sc_serviceteaser image="127" title="Development" text_content="Quisque at lectus leo, nec placerat mi. Curabitur egestas eleifend interdum. Suspendisse potenti. Suspendisse nec risus fermentum." button_enable="1" button_link="#" button_class="btn-primary" image_link="#" button_size="btn"]Quisque at lectus leo, nec placerat mi. Curabitur egestas eleifend interdum. Suspendisse potenti. Suspendisse nec risus fermentum.[/sc_serviceteaser][sc_button button_link="url:%23|title:CALL%20TO%20ACTION|" button_class="btn-primary" button_size="btn"][/vc_column][vc_column width="1/3"][sc_serviceteaser image="126" title="Support" text_content="Quisque at lectus leo, nec placerat mi. Curabitur egestas eleifend interdum. Suspendisse potenti. Suspendisse nec risus fermentum." button_enable="1" button_link="#" button_class="btn-primary" image_link="#" button_size="btn"]Quisque at lectus leo, nec placerat mi. Curabitur egestas eleifend interdum. Suspendisse potenti. Suspendisse nec risus fermentum.[/sc_serviceteaser][/vc_column][/vc_row][vc_row title_header="PRICE PLANS FOR SERVICES" title_subheader="there is always one that fits you" title_style="fancy" background="light_section" parallax="off" overlay="on" triangles="on" top_margin="off"][vc_column width="1/3"][sc_priceplan header_title="<strong>Lite Plan</strong>" header_subtitle="This is where you start" pricing="$150<small>/year</small>" special="0" features="3" feature_1="1 <strong>Design Template</strong>" feature_2="2 <strong>Revisions</strong>" feature_3="5 <strong>HTML Pages</strong>" feature_4="Feature <strong>Four</strong>" feature_5="Feature <strong>Five</strong>" feature_6="Feature <strong>Six</strong>" feature_7="Feature <strong>Seven</strong>" feature_8="Feature <strong>Eight</strong>" feature_9="Feature <strong>Nine</strong>" feature_10="Feature <strong>Ten</strong>" button_text="Get it now!" button_link="url:www.leonart.gr||"][/vc_column][vc_column width="1/3"][sc_priceplan header_title="<strong>Medium Plan</strong>" header_subtitle="this is what you should choose" pricing="$250<small>/year</small>" special="1" features="3" feature_1=" <strong>1</strong>Design Template" feature_2=" <strong>2</strong>Revisions" feature_3="<strong>5</strong>HTML Pages" feature_4="Feature <strong>Four</strong>" feature_5="Feature <strong>Five</strong>" feature_6="Feature <strong>Six</strong>" feature_7="Feature <strong>Seven</strong>" feature_8="Feature <strong>Eight</strong>" feature_9="Feature <strong>Nine</strong>" feature_10="Feature <strong>Ten</strong>" button_text="Get it now!" button_link="url:%23||"][/vc_column][vc_column width="1/3"][sc_priceplan header_title="<strong>Pro Plan</strong>" header_subtitle="this is what you really need" pricing="$350<small>/year</small>" special="0" features="3" feature_1="<strong>1</strong>Design Template" feature_2="<strong>2</strong> Revisions" feature_3="<strong>5</strong>HTML Pages" feature_4="Feature <strong>Four</strong>" feature_5="Feature <strong>Five</strong>" feature_6="Feature <strong>Six</strong>" feature_7="Feature <strong>Seven</strong>" feature_8="Feature <strong>Eight</strong>" feature_9="Feature <strong>Nine</strong>" feature_10="Feature <strong>Ten</strong>" button_text="Get it now!" button_link="url:%23||"][/vc_column][/vc_row][vc_row title_style="elegant" background="dark_section" background_image="434" parallax="on" overlay="on" triangles="off" top_margin="off"][vc_column width="1/1"][sc_calltoaction icon_image="135" title="d2UlMjBkZXNpZ24lMjAlM0NzdHJvbmclM0V2YWx1ZSUzQyUyRnN0cm9uZyUzRSUyMGludG8lMjBwcm9maXQ=" subtitle="our <strong>customers</strong> are always <strong>happy</strong>!" button="0" button_text="Buy this theme!" button_link="Buy this theme!" button_class="btn-primary" button_size="btn"]WE DESIGN <strong>VALUE</strong> INTO PROFIT[/sc_calltoaction][/vc_column][/vc_row]';
      vc_add_default_templates( $data );

      /** Contact Page Template */

      $data                 = array();
      $data['name']         = __( 'Contact Page', 'cleanstart' );
      $data['image_path']   = preg_replace( '/\s/', '%20', get_template_directory_uri() . '/assets/images/vc_template_contact.jpg' ); 
      $data['custom_class'] = 'custom_template_for_vc_custom_template';
      $data['content']      = '[vc_row][vc_column width="2/6"][sc_contactcard brand_logo="451" brand_name="PLETHORA THEMES" industry="Web-Development Company"]<address>795 Folsom Ave, Suite 600 San Francisco, CA 94107</address><abbr title="Phone">P:</abbr> (123) 456-7890<abbr title="Email">E:</abbr> <a href="mailto:#">first.last@example.com</a>[/sc_contactcard][/vc_column][vc_column width="4/6"][vc_column_text][contact-form-7 id="4" title="Contact form 1"][/vc_column_text][/vc_column][/vc_row][vc_row title_style="fancy" background="dark_section" background_image="1464" parallax="on" top_margin="off" triangles="off"][vc_column width="1/1"][sc_newsletterform title="NEVER MISS A <strong>SINGLE</strong> FEATURE" subtitle="subscribe to our awesome newsletter" email_placeholder="Give Us your e-mail..." button_text="Go AHEAD!"][/vc_column][/vc_row]';

      vc_add_default_templates( $data );

    }      

    /**
    * Add Prettyphoto functionality to single image shortcode
    *
    * @since 1.3
    *
    */
    static function vc_single_image_prettyphoto() {

      // Update extra class parameter...'prettyphoto' value is a must here!
      $param = WPBMap::getParam('vc_single_image', 'el_class');
      // print_r($param);
      $param['param_name'] = 'el_class';
      $param['value'] = 'prettyphoto';
      $param['description'] = __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file. Leave "prettyphoto" class for popup functionality, if you want link to larger image.', 'cleanstart');
      WPBMap::mutateParam('vc_single_image', $param);

       // Update "Link To Larger Image" description
      $param = WPBMap::getParam('vc_single_image', 'img_link_large');
      $param['param_name'] = 'img_link_large';
      $param['description'] = __('If checked, image will be linked to a popup displaying a larger version', 'cleanstart');
      WPBMap::mutateParam('vc_single_image', $param);
    }

    /**
    * Fix Contact Form 7 default markup and styling
    *
    * @since 1.0
    *
    */
    static function wpcf7_form_elements( $content ) {
      // global $wpcf7_contact_form;

      $content = preg_replace( "/wpcf7-text/", "wpcf7-form-control form-control", $content );
      $content = preg_replace( "/wpcf7-email/", "wpcf7-form-control form-control", $content );
      $content = preg_replace( "/form-controlarea/", "wpcf7-form-control form-control", $content );
      $content = preg_replace( "/wpcf7-submit/", "wpcf7-submit btn btn-primary", $content );
      return $content;  
    }
 
    /**
     * Fix oEmbed W3C validation issues
     *
     * @since 1.0
     *
     */
    static function soundcloud_oembed_filter( $return, $data, $url ) {

      $style = '';

      if ( strpos($return, 'frameborder="0"') !== FALSE ){
        $style .= 'border:none;';
        $return = str_replace('frameborder="0"', '', $return);
      } elseif ( strpos($return, 'frameborder="no"') !== FALSE ) {
        $style .= 'border:none;';
        $return = str_replace('frameborder="no"', '', $return);
      }

      if ( strpos($return, 'scrolling="no"') !== FALSE ){
        $style .= 'overflow:hidden;';
        $return = str_replace('scrolling="no"', 'style="'.$style.'"', $return);
      } else {
        $return = str_replace('<iframe', '<iframe style="'.$style.'"', $return);
      }

      return $return;
    }

    static function notice_gmaps_apikey_not_found() {

      if ( isset( $_GET['plethora_notice_gmaps_apikey_not_found'] ) && sanitize_key( $_GET['plethora_notice_gmaps_apikey_not_found'] ) === 'hide' ) {

          update_option( 'plethora_notice_gmaps_apikey_not_found', 'hide' );
      }

      $notice_status = get_option( 'plethora_notice_gmaps_apikey_not_found' );

      if ( $notice_status !== 'hide' ) {

          $article_link  = 'http://googlegeodevelopers.blogspot.gr/2016/06/building-for-scale-updates-to-google.html';
          $getapi_link = 'https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key';
          $output         = '<h4 style="margin:0 0 10px;">'. esc_html__( 'Google Maps API key is missing', 'healthflex' ) .'</h4>' ;
          $output        .= esc_html__( 'Note that as of June 22, 2016 the Google Maps demands an API key to function properly. ', 'healthflex' );
          $output        .= sprintf( esc_html__( 'Please visit %1$sTheme Settings > Social & APIs Ons > Google Maps API%2$s to set an API Key.', 'healthflex' ), '<strong>', '</strong>' );
          $output        .= '<p>';
          $output        .= '<a href="'. esc_url( $article_link ) .'" target="_blank"><strong>'. esc_html__( 'Read more on Google Geo Developers blog', 'healthflex' ) .'</strong></a> | ';
          $output        .= '<a href="'. esc_url( $getapi_link ) .'" target="_blank"><strong>'. esc_html__( 'Get a Google Maps API key', 'healthflex' ) .'</strong></a> | ';
          $output        .= '<a href="'.admin_url( '/') .'?plethora_notice_gmaps_apikey_not_found=hide"><strong>'. esc_html__( 'Dismiss this notice', 'healthflex' ) .'</strong></a>';
          $output        .= '</p>';
          echo '<div class="notice notice-info is-dismissible"><p>'. $output .'</p></div>'; 
      }
    }

//////////////// THIRD PARTY CONFIGURATION METHODS <---- END

//////////////// DATA RETURNING METHODS ---------------> START

    /**
     * Returns slider options array
     *
     * @param $sliderid
     * @return array
     * @since 1.0
     *
     */
    static function get_slider_options( $sliderid ) {

        $slider_options = array();

        if ( $sliderid > 0 ) { 

          $slider_options['slideshow']      = self::option( PLETHORA_META_PREFIX . 'slider-slideshow', 'true', $sliderid );
          $slider_options['direction']      = self::option( PLETHORA_META_PREFIX . 'slider-direction', 'vertical', $sliderid );
          $slider_options['animationloop']  = self::option( PLETHORA_META_PREFIX . 'slider-animationloop', 'true', $sliderid );
          $slider_options['slideshowspeed'] = self::option( PLETHORA_META_PREFIX . 'slider-slideshowspeed', '10', $sliderid );
          $slider_options['animationspeed'] = self::option( PLETHORA_META_PREFIX . 'slider-animationspeed', '600', $sliderid );
          $slider_options['showarrows']     = self::option( PLETHORA_META_PREFIX . 'slider-showarrows', 'true', $sliderid );
          $slider_options['showbullets']    = self::option( PLETHORA_META_PREFIX . 'slider-showbullets', 'true', $sliderid );
          $slider_options['randomize']      = self::option( PLETHORA_META_PREFIX . 'slider-randomize', 'false', $sliderid );
          $slider_options['pauseonaction']  = self::option( PLETHORA_META_PREFIX . 'slider-pauseonaction', 'true', $sliderid );
          $slider_options['pauseonhover']   = self::option( PLETHORA_META_PREFIX . 'slider-pauseonhover', 'true', $sliderid );
          $slider_options['animationtype']  = self::option( PLETHORA_META_PREFIX . 'slider-animationtype', 'slide', $sliderid );

        }

        return $slider_options;
    }

// DATA RETURNING METHODS ----> END

// PLETHORA FRAMEWORK INTERMEDIARY METHODS ----> START

    /**
     * INTERMEDIARY: Returns current page's postid, even if it is a blog page...if page is fphp
     * @param 
     * @return number / string ('nonstatic', '404page')
     * @since 1.0
     */
    static function get_the_id() {

      if ( method_exists('Plethora', 'get_the_id') ) { 

        $get_the_id = Plethora::get_the_id();
        return $get_the_id;

      } else { 

        // If this method is not found, it means that Plethora Framework is not updated...so we recover TGM notices, even if the user has dismissed this. 
        update_user_meta( get_current_user_id(), 'tgmpa_dismissed_notice', 0 );
        return;

      }
    }      

    /**
     * INTERMEDIARY: Handles developer comments according to theme settings
     *
     * @param $comment, $commentgroup
     * @return string
     * @since 1.0
     */
    static function dev_comment( $comment = '', $commentgroup = '' ) {

       if ( method_exists('Plethora', 'dev_comment') ) { 

         Plethora::dev_comment( $comment, $commentgroup );

       } else {

        // If this method is not found, it means that Plethora Framework is not updated...so we recover TGM notices, even if the user has dismissed this. 
        update_user_meta( get_current_user_id(), 'tgmpa_dismissed_notice', 0 );

       }
    }

    /**
     * INTERMEDIARY: Returns developer comments for current page
     *
     * @param $comment, $commentgroup
     * @return string
     * @since 1.0
     */
    static function page_dev_comment() { 

       if ( method_exists('Plethora', 'page_dev_comment') ) { 

        $page_dev_comment = Plethora::page_dev_comment();
        return $page_dev_comment;

      } else { 

        // If this method is not found, it means that Plethora Framework is not updated...so we recover TGM notices, even if the user has dismissed this. 
        update_user_meta( get_current_user_id(), 'tgmpa_dismissed_notice', 0 );
        return;
      }

    }

    /**
     * INTERMEDIARY: This is a method for displaying post/pages override options. Checks post meta, if nothing found uses the default option
     * $postid should be given on call, when we need to get other posts info (e.g. inside posts page loop). Otherwise, is not necessary!
     *
     * @param $option_id, $user_value, $postid, $comment
     * @return string/array/bool
     * @since 1.0
     *
     */
    static function option( $option_id, $user_value = '', $postid = 0, $comment = true ) {

       if ( method_exists('Plethora', 'option') ) { 

        $option_val = Plethora::option( $option_id, $user_value, $postid, $comment );
        return $option_val;

      } else {

        // If this method is not found, it means that Plethora Framework is not updated...so we recover TGM notices, even if the user has dismissed this. 
        update_user_meta( get_current_user_id(), 'tgmpa_dismissed_notice', 0 );
        return;

      }
    }

//////////////// PLETHORA FRAMEWORK INTERMEDIARY METHODS <---- END

//////////////// CLEANSTART-ONLY DEPRECATED METHODS ----> START

    static function html_pre_wphead() {
      if (current_user_can("manage_options")) { // Only for users that can manage options 
        echo "\n".'<!-- Plethora_Theme::html_pre_wphead() is a deprecated method. Output moved to includes/partials/element-header.php -->'."\n";
      }
    }    
    static function html_analytics($position) {

      if ( method_exists('Plethora_Theme_Html', 'headermedia')) { 

        return self::analytics($position);
      }    
    }    

    static function html_toolbar() {
      if (current_user_can("manage_options")) { // Only for users that can manage options 
        echo "\n".'<!-- Plethora_Theme::html_toolbar() is a deprecated method. Output moved to includes/partials/element-header.php -->'."\n";
      }
    }    

    static function html_navigation() {
      if (current_user_can("manage_options")) { // Only for users that can manage options 
        echo "\n".'<!-- Plethora_Theme::html_navigation() is a deprecated method. Output moved to includes/partials/element-header.php -->'."\n";
      }
    }    

    static function html_headermedia() {

      if ( method_exists('Plethora_Theme_Html', 'headermedia')) { 

         Plethora_Theme_Html::headermedia();
      }    
    }    

    static function html_headermedia_title() {

      if ( method_exists('Plethora_Theme_Html', 'headermedia_title')) { 

         return Plethora_Theme_Html::headermedia_title();
      }    
    } 

    static function html_headermedia_subtitle() {

      if ( method_exists('Plethora_Theme_Html', 'headermedia_subtitle')) { 

         return Plethora_Theme_Html::headermedia_subtitle();
      }    
    } 

    static function html_headermedia_404() {

      if ( method_exists('Plethora_Theme_Html', 'headermedia_404')) { 

         return Plethora_Theme_Html::headermedia_404();
      }    
    }

    static function html_headermedia_slider() {

      if ( method_exists('Plethora_Theme_Html', 'headermedia_slider')) { 

         return Plethora_Theme_Html::headermedia_slider();
      }    
    } 

    static function html_headermedia_featuredimage() {

      if ( method_exists('Plethora_Theme_Html', 'headermedia_featuredimage')) { 

         return Plethora_Theme_Html::headermedia_featuredimage();
      }    
    }

    static function html_headermedia_otherimage() {

      if ( method_exists('Plethora_Theme_Html', 'headermedia_otherimage')) { 

         return Plethora_Theme_Html::headermedia_otherimage();
      }    
    }

    static function html_headermedia_localvideo() {

      if ( method_exists('Plethora_Theme_Html', 'headermedia_localvideo')) { 

         return Plethora_Theme_Html::headermedia_localvideo();
      }    
    }

    static function html_headermedia_googlemap() {

      if ( method_exists('Plethora_Theme_Html', 'headermedia_googlemap')) { 

         return Plethora_Theme_Html::headermedia_googlemap();
      }    
    }

    static function html_content_featuredimage() {

      if ( method_exists('Plethora_Theme_Html', 'content_featuredimage')) { 

         return Plethora_Theme_Html::content_featuredimage();
      }    
    } 
    
    static function html_content_video() {

      if ( method_exists('Plethora_Theme_Html', 'content_video')) { 

         return Plethora_Theme_Html::content_video();
      }    
    } 
    
    static function html_content_audio() {

      if ( method_exists('Plethora_Theme_Html', 'content_audio')) { 

         return Plethora_Theme_Html::content_audio();
      }    
    }   


    static function html_post_info() {

      if ( method_exists('Plethora_Theme_Html', 'post_info')) { 

         return Plethora_Theme_Html::post_info();
      }    
    }

    static function html_post_author_bio() {

      if ( method_exists('Plethora_Theme_Html', 'post_author_bio')) { 

         return Plethora_Theme_Html::post_author_bio();
      }
    }


    static function html_triangles( $position ) {

      if ( method_exists('Plethora_Theme_Html', 'triangles')) { 

         return Plethora_Theme_Html::triangles( $position );
      }
    }

    static function excerpt($text) {

      if ( method_exists('Plethora_Theme_Html', 'excerpt')) { 

         return Plethora_Theme_Html::excerpt( $text );
      }
    }

//////////////// CLEANSTART-ONLY DEPRECATED METHODS <---- END

  } 
  $cleanstart_theme = Plethora_Theme::init();

}