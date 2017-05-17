<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M                       (c) 2013

File Description: Latest News Widget Class

*/

if ( ! defined( 'ABSPATH' ) ) exit; // NO DIRECT ACCESS 


if ( class_exists('Plethora_Widget') && !class_exists('Plethora_Widget_LatestNews') ) {
 
     /**
      * @package Plethora Base
      */
     add_action( 'widgets_init', create_function( '','return register_widget("Plethora_Widget_LatestNews");' ) );

     class Plethora_Widget_LatestNews extends Plethora_Widget  {

          public $widget_class = 'Plethora_Widget_LatestNews'; 
 
          function __construct() {

               $widget_ops = array(
                    'classname'   => 'latestnews',
                    'description' => 'Latest News'
               );

               $control_ops = array( 'id_base' => 'latestnews-widget' );
               parent::__construct( 
                    'latestnews-widget',
                    '> PL | Latest News',
                    $widget_ops,
                    $control_ops
               );

          add_action( 'save_post', array($this, 'flush_widget_cache') );
          add_action( 'deleted_post', array($this, 'flush_widget_cache') );
          add_action( 'switch_theme', array($this, 'flush_widget_cache') );

          }

          function widget( $args, $instance ) {

               $cache = wp_cache_get('widget_latestnews_posts', 'widget');

               if ( !is_array($cache) )
                    $cache = array();

               if ( ! isset( $args['widget_id'] ) )
                    $args['widget_id'] = $this->id;

               if ( isset( $cache[ $args['widget_id'] ] ) ) {
                    echo $cache[ $args['widget_id'] ];
                    return;
               }

               ob_start();
               extract($args);

               $title    = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Latest News', 'cleanstart' );
               $category = ( ! empty( $instance['category'] ) ) ? $instance['category'] : '';
               $title    = apply_filters( 'widget_title', $title, $instance, $this->id_base );
               $number   = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 10;
               if ( ! $number )
                    $number = 10;

               $ln_query_args = array( 
                    'posts_per_page'      => $number, 
                    'no_found_rows'       => true, 
                    'post_status'         => 'publish', 
                    'ignore_sticky_posts' => true 
                    ); 

               if ( !empty($category)) { $ln_query_args['category_name'] = $category; }

               $ln_query = new WP_Query( apply_filters( 'widget_posts_args', $ln_query_args ) );

               if ($ln_query->have_posts()) :
               ?>
               <?php echo $before_widget; ?>
               <div class="pl_latest_news_widget">
               <?php if ( $title ) echo $before_title . $title . $after_title; ?>
               <ul class="media-list">
               <?php while ( $ln_query->have_posts() ) : $ln_query->the_post(); ?>

                    <li class="media"> 
                    <?php
                        $xtra_class = "";
                        if ( has_post_thumbnail( get_the_ID() )) {
                            $latestnews_featured_image  = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ) );
                            echo '<a href="' . get_permalink() . '" class="media-photo" style="background-image:url(' . esc_url( $latestnews_featured_image[0] ) . ')"></a>'; 
                            $xtra_class = "";
                      } else {
                            $xtra_class = "no-featured-image"; 
                      };
                    ?>
                         <a href="<?php the_permalink(); ?>" class="media-date <?php echo $xtra_class; ?>"><?php echo get_the_date('j'); ?><span><?php echo strtoupper(get_the_date('M')); ?></span></a>
                         <h5 class="media-heading"><a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a></h5>
                         <p><?php echo wp_trim_words( strip_shortcodes( get_the_content() ), 10 ); ?></p>
                    </li>

               <?php endwhile; ?>
               </ul>
               </div>
               <?php echo $after_widget; ?>
               <?php
               // Reset the global $the_post as this query will have stomped on it
               wp_reset_postdata();

               endif;

               $cache[$args['widget_id']] = ob_get_flush();
               wp_cache_set('widget_latestnews_posts', $cache, 'widget');

          }

          function update( $new_instance, $old_instance ) {

               $instance             = $old_instance;
               $instance['title']    = strip_tags($new_instance['title']);
               $instance['category'] = strip_tags($new_instance['category']);
               $instance['number']   = (int) $new_instance['number'];

               $this->flush_widget_cache();

               $alloptions = wp_cache_get( 'alloptions', 'options' );
               if ( isset($alloptions['widget_latestnews_entries']) )
                    delete_option('widget_latestnews_entries');

               return $instance;

          }

          function flush_widget_cache() {

               wp_cache_delete( 'widget_latestnews_posts', 'widget' );

          }

          function form( $instance ) {

               $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
               $category  = isset( $instance['category'] ) ? esc_attr( $instance['category'] ) : 'Uncategorized';
               $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
               ?>
               <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'cleanstart' ); ?></label>
               <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

               <p><label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category:', 'cleanstart' ); ?></label>
               <select class="widefat" id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>">
               <option id="" value="">--</option>
               <?php 
               $cats = get_terms('category', array('hide_empty' => false));
               foreach ( $cats as $cat ) {
                    echo '<option id="' . $cat->name . '" value="' . $cat->name . '"' , ( $category == $cat->name ? ' selected="selected"' : '' ), '>' . $cat->name . '</option>';
               }
               ?>
               </select>

               <p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:', 'cleanstart' ); ?></label>
               <input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>

          <?php               
          }

          /**
          * Register and enqueue stylesheets and scripts for backend and frontend
          */
         private function register_scripts_and_styles() {

             if( is_admin() ) {
             } else { 
              // $this->load_file( 'widget-NAME-js', '/widget/widget-NAME.js', true, array('wow') );
             } 
         } 
 
         /**
          * Helper function for registering and enqueueing scripts and styles.
          *
          * @name    The     ID to register with WordPress
          * @file_path       The path to the actual file
          * @is_script       Optional argument for if the incoming file_path is a JavaScript source file.
          */
         private function load_file( $name, $file_path, $is_script = false, $deps = false ) {
              
         $url = THEME_INCLUDES_URI . $file_path;
             $file = THEME_INCLUDES_DIR . $file_path;

             if ( file_exists( $file ) ) {
                 if ( $is_script ) {
                    if ( is_array( $deps ) ){
                          wp_register_script( $name, $url, $deps );
                    } else {
                          wp_register_script( $name, $url );
                    }
                     wp_enqueue_script( $name );
                 } else {
                     wp_register_style( $name, $url );
                     wp_enqueue_style( $name );
                 } 
             } 
         
         } // private function load_file()


           /** 
           * Returns feature information for several uses by Plethora Core (theme options etc.)
           *
           * @return array
           * @since 1.0
           *
           */
           public static function get_feature_options() {

              $feature_options = array ( 
                  'switchable'         => true,
                  'options_title'      => 'Latest News widget',
                  'options_subtitle'   => 'Activate/deactivate "Latest News" widget',
                  'options_desc'       => 'On deactivation, all settings related to this feature will be removed. However, they will not be deleted permanently.',
                );
              
              return $feature_options;
           }


     }
    
 }