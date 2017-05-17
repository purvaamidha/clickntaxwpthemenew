<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M 				   (c) 2013

File Description: Team Grid shortcode

*/

if ( ! defined( 'ABSPATH' )) exit; // NO ACCESS IF DIRECT OR TEAM POST TYPE NOT EXISTS


if ( class_exists('Plethora_Shortcode') && class_exists('Plethora_Posttype_Person') && !class_exists('Plethora_Shortcode_Teamgrid') ):

	/**
	 * @package Plethora Base
	 */

	class Plethora_Shortcode_Teamgrid extends Plethora_Shortcode { 

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
              'options_title'    => 'Team members grid shortcode',
              'options_required' => array('posttype-portfolio-status','=',array('1')),  // Required Features (similar with Plethora Redux required field)
              'options_subtitle' => 'Activate/deactivate team members grid shortcode',
              'options_desc'     => 'On deactivation, all settings related to this feature will be removed. However, they will not be deleted permanently.',
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
              "base"              => 'sc_teamgrid',
              "name"              => __("Team Members Grid", 'cleanstart'),
              "description"       => __('Build a grid with team members', 'cleanstart'),
              "class"             => "",
              "weight"            => 1,
              "category"          => 'Plethora Shortcodes',
              "admin_enqueue_css" => THEME_CORE_ASSETS_URI.'/admin-shortcodes.css',
              "icon"              => THEME_CORE_ASSETS_URI . '/icons/plethora_shortcodes-32x32.png', 
              "params"            => array(

                  array(
                      "param_name"    => "columns",
                      "type"          => "dropdown",
                      "heading"       => __("Grid columns", 'cleanstart'),
                      "value"         => array('1'=>'1', '2'=>'2','3'=>'3', '4'=>'4'),
                      "description"   => __("Select how many persons to display per row", 'cleanstart'),
                      "admin_label"   => false,                                               
                  ),
                  array(
                      "param_name"    => "members",
                      "type"          => "dropdown_posts",
                      "type_posts"    => array("person"), // 'post', 'page' or any custom post type slug. 
                      "heading"       => __("Team members", 'cleanstart'),
                      "description"   => __('Check team members you want to be displayed in grid. Use \'Ctrl + click\' to select multiple persons', 'cleanstart'),
                      "admin_label"   => false,                                               
                  ),                  
                  array(
                      "param_name"    => "orderby",
                      "type"          => "dropdown",
                      "heading"       => __('Order by', 'cleanstart'),
                      "value"         => array('Name'=>'title', 'Display order (set on each team member Attributes box)'=>'display_order', 'Random'=>'random'),
                      "description"   => __("Select order", 'cleanstart'),
                      "admin_label"   => false,                                               
                  ),
                  array(
                      "param_name"    => "order",
                      "type"          => "dropdown",
                      "heading"       => __('Order by', 'cleanstart'),
                      "value"         => array('Ascending'=>'ASC', 'Descending'=>'DESC'),
                      "description"   => __("Select order", 'cleanstart'),
                      "admin_label"   => false,                                               
                  ),

                  array(
                      "param_name"    => "show_photo",
                      "type"          => "dropdown",
                      "heading"       => __("Show Image", 'cleanstart'),
                      "value"         => array('No'=>'0', 'Yes'=>'1'),
                      "description"   => __("Show photo for each team member ( if yes, please make sure that you have set an image for all persons selected )", 'cleanstart'),
                      "admin_label"   => false,                                               
                  ),
                  array(
                      "param_name"    => "photo_effect",
                      "type"          => "dropdown",
                      "heading"       => __("Image effect", 'cleanstart'),
                      "value"         => array('No'=>'0', 'Yes'=>'1'),
                      "description"   => __("Display photo change effect ( if yes, please make sure that you have set a hover image for all persons selected )", 'cleanstart'),
                      "admin_label"   => false,                                               
                      'dependency'    => array( 
                                          'element' => 'show_photo',  //  Param name (linked field) which will be observed for changes. Must be the same as param_name param for shortcode attribute 
                                          'value' => '1',                                   //  List of linked element's values which will allow to display param 
                                      )
                  ),
                  array(
                      "param_name"    => "show_profession",
                      "type"          => "dropdown",
                      "heading"       => __("Show Profession ", 'cleanstart'),
                      "value"         => array('Yes'=>'1', 'No'=>'0'),
                      "description"   => __("Show profession info for each team member", 'cleanstart'),
                      "admin_label"   => false,                                               
                  ),

                  array(
                      "param_name"    => "show_desc",
                      "type"          => "dropdown",
                      "heading"       => __("Show Description ", 'cleanstart'),
                      "value"         => array('Yes'=>'1', 'No'=>'0'),
                      "description"   => __("Show description text for each team member", 'cleanstart'),
                      "admin_label"   => false,                                               
                  ),

                  array(
                      "param_name"    => "show_social",
                      "type"          => "dropdown",
                      "heading"       => __("Show Social Icons ", 'cleanstart'),
                      "value"         => array('Yes'=>'1', 'No'=>'0'),
                      "description"   => __("Show social icons for each team member", 'cleanstart'),
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
       public function content( $atts, $content ) {

        $this->add_script = true; // VERY IMPORTANT! This triggers loading related scripts on footer

          extract( shortcode_atts( array( 
            'columns'         => '4',
            'members'         => '',
            'orderby'         => 'name',
            'order'           => 'DESC',
            'show_photo'      => '0',
            'photo_effect'    => '0',
            'show_profession' => '1',
            'show_desc'       => '1',
            'show_social'     => '1',
            ), $atts ) );

          
          // Set orderby value 
          switch ( $orderby ) {
              case 'title':
                $args_orderby = array( 'order'=>$order, 'orderby' => 'title' );
                  break;
              case 'display_order':
                $args_orderby = array( 'order'=>$order, 'orderby' => 'menu_order' );
                  break;
              case 'random':
                 $args_orderby = array( 'order'=>$order, 'orderby' => 'rand' );
                  break;
              default:
                $args_orderby = array( 'order'=>$order, 'orderby' => 'title' );
          }

          // Set columns valueS
          switch ( $columns ) {
              case '1':
                $class_cols = 'col-sm-12 col-md-12';
                  break;
              case '2':
                $class_cols = 'col-sm-6 col-md-6';
                  break;
              case '3':
                $class_cols = 'col-sm-6 col-md-4';
                  break;
              case '4':
                $class_cols = 'col-sm-6 col-md-3';
                  break;
              default:
                $class_cols = 'col-sm-6 col-md-3';
          }

          // Set post ids 
          $teammembers_post_ids = ($members != '') ? explode(',', $members) : array();

          // Query arguments (basic)
          $args = array(
                  'posts_per_page'   => -1,
                  'post_type'        => 'person',
                  'post__in'         => $teammembers_post_ids,
                  'post_status'      => 'publish',
          );

          // Merge order arguments with basic ones

          $args = array_merge($args, $args_orderby);


          // Results query
          $posts = get_posts($args);

          // At first, we assign the post results to a variable. We do this first, in order to get the 
          // specific categories present (avoiding this way, to show an empty category tab)
          $return_posts = '';
          if ( count($posts) > 0) { 


            // Start HTML variable for posts (opening section)
            $return_posts .= '<div class="team_members">'."\n";
            $rowcounter    = 0;
            //Loop start
            foreach ($posts as $post) {

              if ($rowcounter == 0) { $return_posts .= '     <div class="row">'."\n";  } // start row

              //loop post values
              $rowcounter   = $rowcounter + 1;

                // Image         
                $img_normal_id  = get_post_meta( $post->ID, PLETHORA_META_PREFIX .'person-photo', true );                        // Team member main image
                $img_hover_id   = get_post_meta( $post->ID, PLETHORA_META_PREFIX .'person-photohover', true );                   // Team member hover image
                $img_normal_arr = (isset($img_normal_id['id']) && !empty($img_normal_id['id'])) ? wp_get_attachment_image_src( $img_normal_id['id'], 'large' ) : '';                      
                $img_hover_arr  = (isset($img_hover_id['id']) && !empty($img_hover_id['id'])) ? wp_get_attachment_image_src( $img_hover_id['id'], 'large' ) : '';                      
                $img_normal     = (isset( $img_normal_arr[0] ) && !empty($img_normal_arr[0] )) ? $img_normal_arr[0] : '';
                $img_hover      = (isset( $img_hover_arr[0] ) && !empty($img_hover_arr[0] )) ? $img_hover_arr[0] : '';
                $figure         = '';
                
                if ( $show_photo && !empty( $img_normal )) { 

                    if ( $photo_effect == 1 && !empty( $img_hover )) { 

                      $figure = '<figure style="background-image: url('. esc_url( $img_hover ) .')"><img src="'. esc_url( $img_normal )  .'" alt="'. esc_attr( $post->post_title ) .'"/></figure>'."\n";

                    } else { 

                      $figure = '<figure style="background-image: url('. esc_url( $img_normal ) .')"><img src="'. esc_url( $img_normal )  .'" alt="'. esc_attr( $post->post_title ) .'"/></figure>'."\n";

                    }

                }
                // Name
                $member_name    = ( !empty( $post->post_title )) ? '<h5>'. $post->post_title .'</h5>'."\n" : '';         
                
                // Profession  
                $member_prof    = get_post_meta( $post->ID, PLETHORA_META_PREFIX .'person-job', true );      
                $member_prof    = ( $show_profession && !empty(  $member_prof )) ? '<small>'.  $member_prof .'</small>'."\n"  : '' ;
                
                // Description         
                $member_desc    = get_post_meta( $post->ID, PLETHORA_META_PREFIX .'person-notes', true );      
                $member_desc    = ( $show_desc && !empty( $member_desc )) ? '<p class="short_bio">'. $member_desc .'</p>'."\n" : '';
                
                // Contact icons
                $contact_mail    = get_post_meta( $post->ID, PLETHORA_META_PREFIX .'person-email', true );
                $contact_skype   = get_post_meta( $post->ID, PLETHORA_META_PREFIX .'person-skype', true );
                $member_contact  = ( !empty( $contact_mail  )) ? '<a href="mailto:'. sanitize_email( $contact_mail ).'"><i class="fa fa-envelope"></i></a>'."\n" : '';       
                $member_contact .= ( !empty( $contact_skype )) ? '<a href="callto:'. esc_attr( $contact_skype ) .'"><i class="fa fa-skype"></i></a>'."\n" : '';       
                
                // Social icons
                $social_facebook   = get_post_meta( $post->ID, PLETHORA_META_PREFIX .'person-facebook', true );
                $social_twitter    = get_post_meta( $post->ID, PLETHORA_META_PREFIX .'person-twitter', true );
                $social_googleplus = get_post_meta( $post->ID, PLETHORA_META_PREFIX .'person-googleplus', true );
                $social_linkedin   = get_post_meta( $post->ID, PLETHORA_META_PREFIX .'person-linkedin', true );
                $social_youtube    = get_post_meta( $post->ID, PLETHORA_META_PREFIX .'person-youtube', true );
                $social_vimeo      = get_post_meta( $post->ID, PLETHORA_META_PREFIX .'person-vimeo', true );
                $social_pinterest  = get_post_meta( $post->ID, PLETHORA_META_PREFIX .'person-pinterest', true );
                $social_tumblr     = get_post_meta( $post->ID, PLETHORA_META_PREFIX .'person-tumblr', true );
                $social_flickr     = get_post_meta( $post->ID, PLETHORA_META_PREFIX .'person-flickr', true );
                $social_dribbble   = get_post_meta( $post->ID, PLETHORA_META_PREFIX .'person-dribble', true );
                $social_instagram  = get_post_meta( $post->ID, PLETHORA_META_PREFIX .'person-instagram', true );

                $member_social  = ( !empty( $social_facebook   )) ? '<a href="'. esc_url( $social_facebook ) .'" target="_blank"><i class="fa fa-facebook"></i></a>'."\n" : '';       
                $member_social .= ( !empty( $social_twitter    )) ? '<a href="'. esc_url( $social_twitter ) .'" target="_blank"><i class="fa fa-twitter"></i></a>'."\n" : '';       
                $member_social .= ( !empty( $social_googleplus )) ? '<a href="'. esc_url( $social_googleplus ) .'" target="_blank"><i class="fa fa-google-plus"></i></a>'."\n" : '';       
                $member_social .= ( !empty( $social_linkedin   )) ? '<a href="'. esc_url( $social_linkedin ) .'" target="_blank"><i class="fa fa-linkedin"></i></a>'."\n" : '';    
                $member_social .= ( !empty( $social_youtube    )) ? '<a href="'. esc_url( $social_youtube ) .'" target="_blank"><i class="fa fa-youtube"></i></a>'."\n" : '';       
                $member_social .= ( !empty( $social_vimeo      )) ? '<a href="'. esc_url( $social_vimeo ) .'" target="_blank"><i class="fa fa-vimeo-square"></i></a>'."\n" : '';       
                $member_social .= ( !empty( $social_pinterest  )) ? '<a href="'. esc_url( $social_pinterest ) .'" target="_blank"><i class="fa fa-pinterest"></i></a>'."\n" : '';       
                $member_social .= ( !empty( $social_tumblr     )) ? '<a href="'. esc_url( $social_tumblr ) .'" target="_blank"><i class="fa fa-tumblr"></i></a>'."\n" : '';       
                $member_social .= ( !empty( $social_flickr     )) ? '<a href="'. esc_url( $social_flickr ) .'" target="_blank"><i class="fa fa-flickr"></i></a>'."\n" : '';       
                $member_social .= ( !empty( $social_dribbble   )) ? '<a href="'. esc_url( $social_dribbble ) .'" target="_blank"><i class="fa fa-dribbble"></i></a>'."\n" : '';       
                $member_social .= ( !empty( $social_instagram  )) ? '<a href="'. esc_url( $social_instagram ) .'" target="_blank"><i class="fa fa-instagram"></i></a>'."\n" : '';       
                $member_social  = ( $show_social && !empty($member_social) ) ? '<hr><div class="team_social">'. $member_contact . $member_social .'</div>' : '<hr><div class="team_social">'. $member_contact .'</div>';


              $return_posts .= '          <div class="'. esc_attr( $class_cols ) .'">'."\n";
              $return_posts .= '               <div class="team_member">'."\n";
              $return_posts .= '                    '. $figure;
              $return_posts .= '                    '. $member_name;
              $return_posts .= '                    '. $member_prof;
              $return_posts .= '                    '. $member_social;
              $return_posts .= '                    '. $member_desc ;
              $return_posts .= '               </div>'."\n";
              $return_posts .= '          </div>'."\n";

              if ($rowcounter == $columns) { $return_posts .= '    </div>'."\n"; $rowcounter = 0; } // end row  

            }
            //Loop end

            // Finishing HTML variable for posts (closing section)
            $return_posts  .= '</div>';

          } 

          return $return_posts;

       }

	}
	
 endif;