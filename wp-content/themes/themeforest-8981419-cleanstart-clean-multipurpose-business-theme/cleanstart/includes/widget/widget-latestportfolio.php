<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M                       (c) 2013

File Description: Latest Portfolio Widget Class

*/

if ( ! defined( 'ABSPATH' ) ) exit; // NO DIRECT ACCESS 


if ( class_exists('Plethora_Widget') && class_exists('Plethora_Posttype_Portfolio') && !class_exists('Plethora_Widget_Latestportfolio') ) {
 
     /**
      * @package Plethora Base
      */
     add_action('widgets_init', create_function( '','return register_widget("Plethora_Widget_Latestportfolio");') );

     class Plethora_Widget_Latestportfolio extends Plethora_Widget  {

        public $widget_class = 'Plethora_Widget_Latestportfolio'; 
 

        function __construct() {

               $widget_ops = array(
                    'classname'   => 'latestportfolio',
                    'description' => 'Latest Portfolio'
               );

               $control_ops = array( 'id_base' => 'latestportfolio-widget' );
               parent::__construct( 
                    'latestportfolio-widget',
                    '> PL | Latest Portfolio',
                    $widget_ops,
                    $control_ops
               );

          add_action( 'save_post', array($this, 'flush_widget_cache') );
          add_action( 'deleted_post', array($this, 'flush_widget_cache') );
          add_action( 'switch_theme', array($this, 'flush_widget_cache') );

          }

          function widget( $args, $instance ) {

               $cache = wp_cache_get('widget_latestportfolio_posts', 'widget');

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

               $title    = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Latest Portfolio', 'cleanstart' );
               $project_type = ( ! empty( $instance['project_type'] ) ) ? $instance['project_type'] : 0;
               $title    = apply_filters( 'widget_title', $title, $instance, $this->id_base );
               $number   = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 10;
               if ( ! $number )
                    $number = 10;

               $ln_query_args = array( 
                    'post_type'           => 'portfolio',
                    'posts_per_page'      => $number, 
                    'no_found_rows'       => true, 
                    'post_status'         => 'publish', 
                    'ignore_sticky_posts' => true 
                    ); 

               if ( !empty($project_type)) { 

                  $ln_query_args['tax_query'] = array ( array( 'taxonomy' =>  'project-type', 'field'=> 'id', 'terms' => $project_type )) ; 

                }

               $ln_query = new WP_Query( apply_filters( 'widget_posts_args', $ln_query_args ) );

               if ($ln_query->have_posts()) :
               ?>
               <?php echo $before_widget; ?>
                <div class="pl_latest_portfolio_widget">  
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
               wp_cache_set('widget_latestportfolio_posts', $cache, 'widget');

          }

          function update( $new_instance, $old_instance ) {

               $instance             = $old_instance;
               $instance['title']    = strip_tags($new_instance['title']);
               $instance['project_type'] = strip_tags($new_instance['project_type']);
               $instance['number']   = (int) $new_instance['number'];

               $this->flush_widget_cache();

               $alloptions = wp_cache_get( 'alloptions', 'options' );
               if ( isset($alloptions['widget_latestportfolio_entries']) )
                    delete_option('widget_latestportfolio_entries');

               return $instance;

          }

          function flush_widget_cache() {

               wp_cache_delete( 'widget_latestportfolio_posts', 'widget' );

          }

          function form( $instance ) {

               $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
               $selected_project  = isset( $instance['project_type'] ) ? esc_attr( $instance['project_type'] ) : 0;
               $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
               ?>
               <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'cleanstart' ); ?></label>
               <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

               <p><label for="<?php echo $this->get_field_id( 'project_type' ); ?>"><?php _e( 'Project Type:', 'cleanstart' ); ?></label>
               <select class="widefat" id="<?php echo $this->get_field_id( 'project_type' ); ?>" name="<?php echo $this->get_field_name( 'project_type' ); ?>">
               <option id="0" value="">--</option>
               <?php 
               $project_types = get_terms('project-type', array('hide_empty' => false));
               foreach ( $project_types as $project_type ) {
                    $selected = ($selected_project == $project_type->term_id ) ? ' selected="selected"' : '';
                    echo '<option id="' . $project_type->term_id . '" value="' . $project_type->term_id  . '"'.$selected.'>' . $project_type->name . '</option>';
               }
               ?>
               </select>

               <p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of portfolio items to show:', 'cleanstart' ); ?></label>
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
                  'options_title'      => 'Latest Portfolio widget',
                  'options_subtitle'   => 'Activate/deactivate "Latest Portfolio" widget',
                  'options_desc'       => 'On deactivation, all settings related to this feature will be removed. However, they will not be deleted permanently.',
                );
              
              return $feature_options;
           }


     }
    
 }