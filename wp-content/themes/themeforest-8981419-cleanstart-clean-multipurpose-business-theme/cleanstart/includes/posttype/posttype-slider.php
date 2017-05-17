<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M 				   (c) 2013

File Description: Slider Post Type Feature Class

*/

if ( ! defined( 'ABSPATH' ) ) exit; // NO DIRECT ACCESS 

if ( class_exists('Plethora_Posttype') && !class_exists('Plethora_Posttype_Slider') ) {  
  /**
   * @package Plethora Base
   */

  class Plethora_Posttype_Slider {

        public function __construct() {

        /////// Basic post type configuration

            // Names
            $names = array(

              'post_type_name'  =>  'slider', 
              'slug'            =>  'slider', 
              'menu_item_name'  =>  __('Sliders', 'cleanstart'),
              'singular'        =>  __('Slider', 'cleanstart'),
              'plural'          =>  __('Sliders', 'cleanstart'),

            );

            // Options
            $options = array(

              'enter_title_here' => 'Slider reference title', 
              'description'         => '',   
              'public'              => true,    
              'exclude_from_search' => false,    
              'publicly_queryable'  => false,    
              'show_ui'             => true,    
              'show_in_nav_menus'   => false,    
              'show_in_menu'        => true,    
              'show_in_admin_bar'   => true,    
              'menu_position'       => 10,       
              'menu_icon'           => 'dashicons-slides',
              'hierarchical'        => false,    
              'supports'        => array( 
                                'title', 
                               ), 
            );    

            $slider = new Plethora_Posttype( $names, $options );

            // Scripts/styles for post/post-new pages
            add_action('admin_print_styles-post.php'    , array( $this, 'admin_post_print_css')); 
            add_action('admin_print_styles-post-new.php', array( $this, 'admin_post_print_css')); 

          }

         /** 
         * CSS fixes for slider-related admin pages
         *
         * @return array
         * @since 1.0
         *
         */
          function admin_post_print_css() {

              global $post_type;

              if ( $post_type == 'slider' ) {

                echo '<style type="text/css">#edit-slug-box { display: none !important; visibility: hidden; }</style>';
                echo '<style type="text/css">#post-preview { display: none !important; visibility: hidden; }</style>';
              }
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
                'switchable'       => true,
                'options_title'    => 'Slider post type',
                'options_subtitle' => 'Activate/deactivate Slider custom post type',
                'options_desc'     => 'On deactivation, all settings related to this feature will be removed. However, they will not be deleted permanently.',
                'version'          => '1.0',
              );
            
            return $feature_options;
         }
  }
}