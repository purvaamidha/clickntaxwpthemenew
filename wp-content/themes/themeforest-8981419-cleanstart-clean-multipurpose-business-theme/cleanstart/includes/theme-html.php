    <?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M            (c) 2014

Description: Inlcudes theme and third party HTML markup.

*/

if ( ! defined( 'ABSPATH' ) ) exit; // NO DIRECT ACCESS 

if ( !class_exists('Plethora_Theme_Html') ) {

  class Plethora_Theme_Html { 

    /**
     * Returns featured media template_part
     *
     * @param 
     * @return string
     *
     */
    static function headermedia() {
      
      // There is a different treat of featured media section for each of the following cases
      if ( is_404() ) { 

        get_template_part('includes/partials/headermedia', '404');

      } else { 

        $page_featuredmedia = Plethora_Theme::option( PLETHORA_META_PREFIX .'header-media', 'nomedia');
        get_template_part('includes/partials/headermedia', strtolower( $page_featuredmedia ));
      
      }
    }    

    /**
     * Returns header media title
     *
     * @param 
     * @return string
     *
     */
    static function headermedia_title() {
      
      $html = '';
      $title = '';

      if ( is_front_page() && is_home() ) { 

          $blog_header_title  = Plethora_Theme::option( 'blog-header-title');         
          $title = ( !empty( $blog_header_title )) ? $blog_header_title : '';
     
      } elseif ( is_home() ) { 

          $blog_header_title        = Plethora_Theme::option( 'blog-header-title');         
          $title = ( !empty( $blog_header_title )) ? $blog_header_title : '';
     
      } elseif ( is_search() ) { 

          $blog_header_title_search = Plethora_Theme::option( 'blog-header-title-search');         
          $title_prfx = ( !empty( $blog_header_title_search )) ? $blog_header_title_search : '';
          $title =  $title_prfx . get_search_query();

      } elseif ( is_404() ) { 

          $four04_header_title = Plethora_Theme::option( '404-header-title');         
          $title = ( !empty( $four04_header_title )) ? $four04_header_title : '';

      } elseif ( is_archive() ) { 
      
            if ( is_category() ) { //ok
              
              $blog_header_title_cat    = Plethora_Theme::option( 'blog-header-title-cat');         
              $title_prfx = ( !empty( $blog_header_title_cat )) ? $blog_header_title_cat : '';
              $title = single_cat_title($title_prfx, false);

            } elseif ( is_tag() ) { //ok
              
              $blog_header_title_tag    = Plethora_Theme::option( 'blog-header-title-tag');         
              $title_prfx = ( !empty( $blog_header_title_tag )) ? $blog_header_title_tag : '';
              $title = single_cat_title($title_prfx, false);

            } elseif ( is_author() ) { //ok
              
              $blog_header_title_author = Plethora_Theme::option( 'blog-header-title-author');         
              $title_prfx = ( !empty( $blog_header_title_author )) ? $blog_header_title_author : '';
              $title =  $title_prfx . get_the_author();

            } elseif ( is_date() ) {//ok
              
              $blog_header_title_date   = Plethora_Theme::option( 'blog-header-title-date');         
              $title_prfx = ( !empty( $blog_header_title_date )) ? $blog_header_title_date : '';
              $title =  $title_prfx . single_month_title('', false ) ;
            }

      } else { 
         
          $post_type = get_post_type();
          $title_behavior           = Plethora_Theme::option( PLETHORA_META_PREFIX . 'header-title-type-'. $post_type .'', 'blogtitle');
          if ( $title_behavior == 'posttitle' ) { 

            $title = get_the_title();

          } elseif ( $title_behavior == 'customtitle' ) {
          
            $title   = Plethora_Theme::option( PLETHORA_META_PREFIX . 'header-customtitle-'. $post_type .'', '');

          } elseif ( $title_behavior == 'blogtitle' ) {

            $blog_title   = Plethora_Theme::option( 'blog-header-title');
            $title = ( !empty( $blog_title )) ? $blog_title : '';

          } elseif ( $title_behavior == 'notitle' ) {

            $title = '';

          }
      }

      $title = apply_filters( 'plethora_cleanstart_headpanel_title', $title );

      if ( !empty( $title )) { 

        $html  .= '<div class="hgroup_title animated bounceInUp">'."\n";
        $html  .= '   <div class="container">'."\n";
        $html  .= '     <h1>'. $title .'</h1>'."\n";
        $html  .= '   </div>'."\n";
        $html  .= '</div>'."\n";

      } 

      return $html;
    } 

    /**
     * Returns header media subtitle
     *
     * @param 
     * @return string
     *
     */
    static function headermedia_subtitle() {

      $html = '';
      $subtitle = '';

      if ( is_front_page() && is_home() ) { 

          $blog_header_subtitle = Plethora_Theme::option( 'blog-header-subtitle');         
          $subtitle = ( !empty( $blog_header_subtitle )) ? $blog_header_subtitle : '';
     
      } elseif ( is_home() ) { 

          $blog_header_subtitle = Plethora_Theme::option( 'blog-header-subtitle');         
          $subtitle = ( !empty( $blog_header_subtitle )) ? $blog_header_subtitle : '';
     
      } elseif ( is_search() ) { 

              $blog_header_subtitle_search  = Plethora_Theme::option( 'blog-header-subtitle-search');

              $subtitle_type = ( !empty( $blog_header_subtitle_search )) ? $blog_header_subtitle_search : '';
              switch ( $subtitle_type ) {
                  
                  case 'nosubtitle' :
                    $subtitle = '';
                    break;

                  case 'usedefault' :
                    $blog_header_subtitle = Plethora_Theme::option( 'blog-header-subtitle');         
                    $subtitle = ( !empty( $blog_header_subtitle )) ? $blog_header_subtitle : '';
                    break;

                  case 'usecustom' :
                    $blog_header_subtitle_search_custom = Plethora_Theme::option( 'blog-header-subtitle-search-custom');         
                    $subtitle = ( !empty( $blog_header_subtitle_search_custom )) ? $blog_header_subtitle_search_custom : '';
                    break;
              }


      } elseif ( is_404() ) { 

          $four04_header_subtitle = Plethora_Theme::option( '404-header-subtitle');         
          $subtitle = ( !empty( $four04_header_subtitle )) ? $four04_header_subtitle : '';


      } elseif ( is_archive() ) { 
      
            if ( is_category() ) { 

              $blog_header_subtitle_cat = Plethora_Theme::option( 'blog-header-subtitle-cat');         

              $subtitle_type = ( !empty( $blog_header_subtitle_cat )) ? $blog_header_subtitle_cat : '';
              switch ( $subtitle_type ) {
                  
                  case 'nosubtitle' :
                    $subtitle = '';
                    break;

                  case 'usedefault' :
                    $blog_header_subtitle     = Plethora_Theme::option( 'blog-header-subtitle');         
                    $subtitle = ( !empty( $blog_header_subtitle )) ? $blog_header_subtitle : '';
                    break;

                  case 'usedescription' :
                    $subtitle = category_description();
                    break;

                  case 'usecustom' :
                   $blog_header_subtitle_cat_custom  = Plethora_Theme::option( 'blog-header-subtitle-cat-custom');
                   $subtitle = ( !empty( $blog_header_subtitle_cat_custom )) ? $blog_header_subtitle_cat_custom : '';
                    break;
              }


            } elseif ( is_tag() ) {

              $blog_header_subtitle_tag         = Plethora_Theme::option( 'blog-header-subtitle-tag');         

              $subtitle_type = ( !empty( $blog_header_subtitle_tag )) ? $blog_header_subtitle_tag : '';
              switch ( $subtitle_type ) {
                  
                  case 'nosubtitle' :
                    $subtitle = '';
                    break;

                  case 'usedefault' :
                    $blog_header_subtitle     = Plethora_Theme::option( 'blog-header-subtitle');         
                    $subtitle = ( !empty( $blog_header_subtitle )) ? $blog_header_subtitle : '';
                    break;

                  case 'usedescription' :
                    $subtitle = tag_description();
                    break;

                  case 'usecustom' :
                   $blog_header_subtitle_tag_custom  = Plethora_Theme::option( 'blog-header-subtitle-tag-custom');
                   $subtitle = ( !empty( $blog_header_subtitle_tag_custom )) ? $blog_header_subtitle_tag_custom : '';
                    break;
              }

              
            } elseif ( is_author() ) {

              $blog_header_subtitle_author        = Plethora_Theme::option( 'blog-header-subtitle-author');         

              $subtitle_type = ( !empty( $blog_header_subtitle_author )) ? $blog_header_subtitle_author : '';
              switch ( $subtitle_type ) {
                  
                  case 'nosubtitle' :
                    $subtitle = '';
                    break;

                  case 'usedefault' :
                    $blog_header_subtitle = Plethora_Theme::option( 'blog-header-subtitle');         
                    $subtitle = ( !empty( $blog_header_subtitle )) ? $blog_header_subtitle : '';
                    break;

                  case 'usebio' :
                    $subtitle = get_the_author_meta('description');
                    break;

                  case 'usecustom' :
                    $blog_header_subtitle_author_custom = Plethora_Theme::option( 'blog-header-subtitle-author-custom');   
                    $subtitle = ( !empty( $blog_header_subtitle_author_custom )) ? $blog_header_subtitle_author_custom : '';
                    break;
              }
              
            } elseif ( is_date() ) {

              $blog_header_subtitle_date  = Plethora_Theme::option( 'blog-header-subtitle-date');         
              $subtitle_type = ( !empty( $blog_header_subtitle_date )) ? $blog_header_subtitle_date : '';
              switch ( $subtitle_type ) {
                  
                  case 'nosubtitle' :
                    $subtitle = '';
                    break;

                  case 'usedefault' :
                    $blog_header_subtitle       = Plethora_Theme::option( 'blog-header-subtitle');         
                    $subtitle = ( !empty( $blog_header_subtitle )) ? $blog_header_subtitle : '';
                    break;

                  case 'usecustom' :
                    $blog_header_subtitle_date_custom = Plethora_Theme::option( 'blog-header-subtitle-date-custom');         
                    $subtitle = ( !empty( $blog_header_subtitle_date_custom )) ? $blog_header_subtitle_date_custom : '';
                    break;
              }
            }

      } else { 

          $post_type = get_post_type();
          $title_behavior           = Plethora_Theme::option( PLETHORA_META_PREFIX . 'header-title-type-'. $post_type .'', 'blogtitle');

          if ( $title_behavior == 'posttitle' ) { 

            $subtitle   = Plethora_Theme::option( PLETHORA_META_PREFIX . 'header-customsubtitle-'. $post_type .'', '');

          } elseif ( $title_behavior == 'customtitle' ) {
          
            $subtitle   = Plethora_Theme::option( PLETHORA_META_PREFIX . 'header-customsubtitle-'. $post_type .'', '');

          } elseif ( $title_behavior == 'blogtitle' ) {

            $blog_header_subtitle       = Plethora_Theme::option( 'blog-header-subtitle');         
            $subtitle = ( !empty( $blog_header_subtitle )) ? $blog_header_subtitle : '';
          }
      }

      $subtitle = apply_filters( 'plethora_cleanstart_headpanel_subtitle', $subtitle );

      if ( !empty( $subtitle )) { 

          $html  = '<div class="hgroup_subtitle animated bounceInUp skincolored">'."\n";
          $html  .= '   <div class="container">'."\n";
          $html  .= '     <p>'. $subtitle .'</p>'."\n";
          $html  .= '   </div>'."\n";
          $html  .= '</div>'."\n";

      } 

      return $html;
    } 

     /**
     * Returns header section 404 image
     *
     * @param 
     * @return string
     *
     */
    static function headermedia_404() {

      $html = '';
      $four04_header_img = Plethora_Theme::option( '404-header-img');

      if ( !empty( $four04_header_img )) { 

        $html = ' style="background-image: url('. $four04_header_img['url'] .');"';

      }
      return $html;

    }

    /**
     * Returns featured media slider
     *
     * @param 
     * @return string
     *
     */
    static function headermedia_slider() {

      $html     = '';
      $sliderid = Plethora_Theme::option( PLETHORA_META_PREFIX . 'header-media-slider', 0);
      $slides   = Plethora_Theme::option( PLETHORA_META_PREFIX . 'slider-slides', array(), $sliderid);

      // $height   = self::option( PLETHORA_META_PREFIX . 'header-media-dimensions', array());
      // $units    = $height['units'];
      // $height   = intval($height['height']);
      // $height --> Array ( [height] => 240px [units] => px )

      if ( !empty( $slides ) && is_array( $slides )) { 

        $url_target = Plethora_Theme::option( PLETHORA_META_PREFIX .'slider-urltarget', '_self', $sliderid );

/*        $html .= '<section id="slider_wrapper" class="slider_wrapper full_page_photo">'."\n";
        $html .= '    <div id="main_flexslider" class="flexslider">'."\n";
        $html .= '         <ul class="slides">'."\n";
        */
		
		$html .= '<section id="slider_wrapper" class="slider_wrapper full_page_photo">'."\n";
		
        $html .= '    <div id="main_flexslider" class="flexslider">'."\n";
        $html .= '         <ul class="slides">'."\n";
		

        foreach ( $slides as $slide ) { 
            $title  =  ( !empty( $slide['title'] )) ? $slide['title'] : '';
            $descr  =  ( !empty( $slide['description'] )) ? $slide['description'] : '';
            $image  =  ( !empty( $slide['image'] )) ? $slide['image'] : '';
            $url    =  ( !empty( $slide['url'] )) ? $slide['url'] : '#';
            if ( !empty( $slide['url'] )) { 

              $url_open = '                <a href="'. esc_url( $url )  .'" target="'. $url_target .'" title="'. esc_attr( wp_strip_all_tags( $title )) .'">'."\n";
              $url_clos = '                </a>'."\n";

            } else { 

              $url_open = '';
              $url_clos = '';

            }
            $html .= '                        <div class="col-md-6">'."\n";
			$html .= '              <li class="item" style="background-image: url('.  $image .')">'."\n";
			$html .= '                        </div>'."\n";
            $html .= $url_open;
            $html .= '                   <div class="container">'."\n";
            
			
			
			$html .= '                        <div class="col-md-6">'."\n";
			$html .= '                        <div class="change">'."\n";
            if ( !empty( $title )) { $html .= '                             <h1>'. $title .'</h1>'."\n"; }
            if ( !empty( $descr )) { $html .= '                             <p class="lead skincolored">'. $descr .'</p>'."\n"; }
            $html .= '                        </div>'."\n";
			
			$html .= '                        </div>'."\n";
			
			
			
            if ( !empty( $descr )) { $html .= '                             <p class="box">'. $descr .'</p>'."\n"; }
            
			$html .= '                        </div>'."\n";
			
			
      
            $html .= $url_clos;
            $html .= '              </li>'."\n";
        }

        $html .= '         </ul>'."\n";
        $html .= '    </div>'."\n";
        $html .= '</section>'."\n";

        // Enqueue flexslider script in the footer
        wp_enqueue_script(  'flexslider-cleanstart' );
                 
        // Additional config ---> send slider settings to init
        $slider_options = Plethora_Theme::get_slider_options( $sliderid );
        $slider         = array('slider_options'=> $slider_options);

        wp_register_script( 'fmslider',  THEME_ASSETS_URI . '/cleanstart_fmslider.min.js',  array('flexslider-cleanstart'),  '', TRUE ); // OK
        wp_localize_script( 'fmslider', 'plethora_slider', $slider );
        wp_enqueue_script ( 'fmslider' );

      }
      
      return $html;
    } 

     /**
     * Returns header section featured image
     *
     * @param 
     * @return string
     *
     */
    static function headermedia_featuredimage() {

      $html = '';
        $postid = Plethora_Theme::get_the_id();
        if ( has_post_thumbnail( $postid ) ) { 

          $header_image_src = wp_get_attachment_image_src(get_post_thumbnail_id( $postid ), 'full');
          $html = ' style="background-image: url('. esc_url( $header_image_src[0] ) .');"';

        } 

      return $html;
    }

     /**
     * Returns header section other image
     *
     * @param 
     * @return string
     *
     */
    static function headermedia_otherimage() {

      $html = '';
      $otherimage = Plethora_Theme::option( PLETHORA_META_PREFIX . 'header-media-otherimage');

      if ( isset( $otherimage['url'] ) &&  !empty( $otherimage['url'] )) { 

        $html = ' style="background-image: url('. esc_url( $otherimage['url'] ) .');"';

      }

      return $html;

    }
     /**
     * Returns featured video (local video )
     *
     * @param 
     * @return string
     *
     */
    static function headermedia_localvideo() {

      $html = '';

      // GET LOCAL VIDEO OPTIONS
      $localvideo     = Plethora_Theme::option( PLETHORA_META_PREFIX .'header-media-localvideo');
      $video_poster   = Plethora_Theme::option( PLETHORA_META_PREFIX .'header-media-localvideo-poster'); // Get video poster
      $video_controls = Plethora_Theme::option( PLETHORA_META_PREFIX .'header-media-localvideo-controls', 'true'); // Get Controls option
      $video_autoplay = Plethora_Theme::option( PLETHORA_META_PREFIX .'header-media-localvideo-autoplay', 'false'); // Get Autoplay option
      $video_loop     = Plethora_Theme::option( PLETHORA_META_PREFIX .'header-media-localvideo-loop', 'false'); // Get Loop option
      $video_sound    = Plethora_Theme::option( PLETHORA_META_PREFIX .'header-media-localvideo-sound', 'false'); //Get Sound option

      if ( isset( $localvideo['url'] ) && !empty($localvideo['url'])) { 

          $video_url = pathinfo( $localvideo['url'] );
          $video_ext = $video_url['extension'];
          $video_url = $video_url['dirname'] . "/" . $video_url['filename'] . "." . $video_ext;

          // ALLOW ONLY MP4/WEBM VIDEO FORMATS
          if ( $video_ext == 'mp4' || $video_ext == 'flv' || $video_ext == 'webm' || $video_ext == 'ogg' || $video_ext == 'ogv' ) { 
              
              $video_poster_img = ( isset( $video_poster['url'] ) && !empty($video_poster['url'] )) ? $video_poster['url'] : '';

              /* CHECK IF BROWSER SUPPORTS WEBM
              if( strpos( $_SERVER['HTTP_ACCEPT'], 'image/webp' ) !== false || strpos( $_SERVER['HTTP_USER_AGENT'], ' Chrome/' ) !== false ) {
                $video_url = $video_url . ".webm"; 
              } else {
                $video_url = $video_url . ".mp4"; 
              }
              */

              $html  .= ' id="video" data-video="'. esc_url( $video_url ) .'" data-imagefallback="'. esc_url( $video_poster_img ) .'"';

              // REGISTER & ENQUEUE VIDEO SCRIPTS
              wp_register_script( 'jquery-ui-custom',   THEME_ASSETS_URI . '/js/jquery-ui-1.8.22.custom.min.js',       array( 'jquery' ),  '', TRUE ); 
              wp_register_script( 'imagesloaded',       THEME_ASSETS_URI . '/js/jquery.imagesloaded.min.js',          array('jquery'), '', TRUE); 
              wp_register_script( 'plethora-videojs',   THEME_ASSETS_URI . '/js/video.min.js',          array('jquery-ui-custom'), '', TRUE); 
              wp_register_script( 'plethora-bigvideo',  THEME_ASSETS_URI . '/js/bigvideo.min.js',       array('plethora-videojs','imagesloaded'), '', TRUE); 
              wp_enqueue_script(  'plethora-videojs' );
              wp_enqueue_script(  'plethora-bigvideo' );
              wp_register_script( 'bigvideo-init',  THEME_ASSETS_URI . '/cleanstart_fmvideo.js',  array('plethora-bigvideo'), '', TRUE); 
              wp_enqueue_script(  'bigvideo-init' );

              // Additional config ---> send video settings to init
              $video_options = array();
              $video_options['video_controls']    = ( $video_controls === 'true' ) ? true : false;
              $video_options['video_autoplay']    = ( $video_autoplay === 'true' ) ? true : false;
              $video_options['video_loop']        = ( $video_loop === 'true' ) ? true : false;
              $video_options['video_sound']       = ( $video_sound === 'true' ) ? true : false;
              $video_options['video_poster']      = $video_poster;

              $video_options = json_encode( $video_options );
              $video         = array('video_options'=> $video_options) ;
              wp_localize_script( 'bigvideo-init', 'plethora_video', $video );
          }
      }  
      
      return $html;
     }

     /**
     * Returns featured Google Map
     * v1.1.0
     *
     * @return string
     *
     */
    static function headermedia_googlemap() {

      $map_options                             = array();
      $map_options['map_lat']                   = Plethora_Theme::option( PLETHORA_META_PREFIX .'header-media-map-lang');
      $map_options['map_lon']                   = Plethora_Theme::option( PLETHORA_META_PREFIX .'header-media-map-long');
      $map_options['map_controls']              = Plethora_Theme::option( PLETHORA_META_PREFIX .'header-media-map-controls', 'true');
      $map_options['map_title']                 = Plethora_Theme::option( PLETHORA_META_PREFIX .'header-media-map-title', 'We are right here!' );
      /*** MAP TYPE CONTROL OPTIONS ***/      
      $map_options['map_type']                  = Plethora_Theme::option( PLETHORA_META_PREFIX .'header-media-map-type', 'ROADMAP');
      $map_options['map_type_switch']           = Plethora_Theme::option( PLETHORA_META_PREFIX .'header-media-map-type-switch', 'false');
      $map_options['map_type_switch_style']     = Plethora_Theme::option( PLETHORA_META_PREFIX .'header-media-map-type-switch-style', 'DROPDOWN_MENU' );
      $map_options['map_type_switch_position']  = Plethora_Theme::option( PLETHORA_META_PREFIX .'header-media-map-type-switch-position', 'RIGHT_CENTER' );
      /*** MAP PAN CONTROL OPTIONS ***/
      $map_options['map_pan_control']           = Plethora_Theme::option( PLETHORA_META_PREFIX .'header-media-map-pan-control', 'true');
      $map_options['map_pan_control_position']  = Plethora_Theme::option( PLETHORA_META_PREFIX .'header-media-map-pan-control-position', 'RIGHT_CENTER');
      /*** MAP ZOOM CONTROL OPTIONS ***/
      $map_options['map_zoom']                  = Plethora_Theme::option( PLETHORA_META_PREFIX .'header-media-map-zoom', '12');
      $map_options['map_zoom_control']          = Plethora_Theme::option( PLETHORA_META_PREFIX .'header-media-map-zoom-control', 'true');
      $map_options['map_zoom_control_style']    = Plethora_Theme::option( PLETHORA_META_PREFIX .'header-media-map-zoom-control-style', 'SMALL');
      $map_options['map_zoom_control_position'] = Plethora_Theme::option( PLETHORA_META_PREFIX .'header-media-map-zoom-control-position', 'LEFT_CENTER');
      /*** MAP MARKER OPTIONS ***/
      $map_options['map_mark']                  = Plethora_Theme::option( PLETHORA_META_PREFIX .'header-media-map-mark', 'true');
      $map_options['map_icon']                  = Plethora_Theme::option( PLETHORA_META_PREFIX .'header-media-map-icon', ''); 
      $map_options['info_window']               = Plethora_Theme::option( PLETHORA_META_PREFIX .'header-media-map-infowinfow', ''); 
      $map_options['map_icon_x']                = Plethora_Theme::option( PLETHORA_META_PREFIX .'header-media-map-icon-anchor-x', '0'); 
      $map_options['map_icon_y']                = Plethora_Theme::option( PLETHORA_META_PREFIX .'header-media-map-icon-anchor-y', '0');
      /*** MAP STREETVIEW OPTIONS ***/
      $map_options['map_streetview']            = Plethora_Theme::option( PLETHORA_META_PREFIX .'header-media-map-streetview', 'false' );
      $map_options['map_streetview_position']   = Plethora_Theme::option( PLETHORA_META_PREFIX .'header-media-map-streetview-position', 'LEFT_CENTER' );
      /*** MAP SCALE OPTIONS ***/
      $map_options['map_scale_control']         = Plethora_Theme::option( PLETHORA_META_PREFIX .'header-media-map-scale-control', 'false');
      /*** MAP SNAZZY OPTIONS ***/
      $map_snazzy = Plethora_Theme::option( PLETHORA_META_PREFIX .'header-google-maps-snazzy', '');
      if ( $map_snazzy !== '' ){
        $map_snazzy = json_decode($map_snazzy);
        if ( $map_snazzy !== NULL ){
          $map_options['map_snazzy'] = $map_snazzy;
        }
      }      


      if ( !empty($map_options['map_lat']) && !empty($map_options['map_lon']) ) { 

        $googlemaps_apikey = Plethora_Theme::option( 'googlemaps_apikey', '' );

        wp_enqueue_script(  'plethora-gmap', 'https://maps.googleapis.com/maps/api/js?key='. esc_attr( $googlemaps_apikey ) , array(), NULL, true);
        wp_register_script( 'gmap-init',  THEME_ASSETS_URI . '/js/googlemaps.min.js', array('plethora-gmap'), '', TRUE);
        wp_enqueue_script(  'gmap-init' );
        // INJECT JS OBJECT 'map_options' CONTAINING ALL THE OPTIONS INTO THE PAGE
        wp_localize_script( 'gmap-init', 'plethora_map', array( 'map_options'=> json_encode( $map_options ) ) );
      }

       return 'ok';
    }

    /**
     * Returns featured image. Use only inside a loop
     * Attention...use get_the_ID() method to retrieve the postid ( not self::get_the_id() )
     * Also, the self:option() calls if this is_single() must be called with all their attributes ( option($option_id, $user_value, $postid) )
     * @param 
     * @return string
     *
     */
    static function content_featuredimage() {

      $html = '';
      
      if ( has_post_thumbnail() ) { 

        $featured_image_src = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');

        if ( !empty( $featured_image_src )) {
          if ( !is_single()) { 

             $html .= '<a href="'. get_permalink( get_the_ID() ) .'" title="'. esc_attr( get_the_title()) .'"><img alt="'. esc_attr( get_the_title() ) .'" src="'. esc_url( $featured_image_src[0] ) .'"></a>';

          } else { 

             $html .= '<img alt="'. esc_attr( get_the_title() ).'" src="'. esc_url( $featured_image_src[0] ) .'">';

          }
        }
      }
      return $html;
    } 
    
    /**
     * Returns featured video (embeded video ). Use only inside a loop
     * Attention...use get_the_ID() method to retrieve the postid ( not self::get_the_id() )
     * Also, the self:option() calls if this is_single() must be called with all their attributes ( option($option_id, $user_value, $postid) )
     *
     * @param $video_position, $is_blog, $postid 
     * @return string
     *
     */
    static function content_video() {

      $html = '';
      $postid = get_post() ? get_the_ID() : NULL; // Get the postid using the get_the_ID()
      $post_type = get_post_type();

      // Check if this post is forced to display a featured image on list view ( for classic posts only )
      if ( $post_type == 'post' && !is_single() ) {

        $listview     = Plethora_Theme::option( PLETHORA_META_PREFIX .'post-listview', 'inherit', $postid );
        if ( $listview == 'featuredimage' ) { 

          $html = self::content_featuredimage();
          return $html;

        }
      }
      // Show the vid
      $embedvideo     = Plethora_Theme::option( PLETHORA_META_PREFIX .'content-video', '', $postid );
      
      if ( !empty( $embedvideo )) {   

             // $html .= wp_oembed_get( $embedvideo, array('width' => 740));
             $html .= wp_oembed_get( $embedvideo );
      }  
      
      return $html;
    } 
    
    /**
     * Returns featured audio html (embeded audio ). Use only inside a loop
     * Attention...use get_the_ID() method to retrieve the postid ( not Plethora_Theme::get_the_id() )
     * Also, the Plethora_Theme:option() calls if this is_single() must be called with all their attributes ( option($option_id, $user_value, $postid) )
     * 
     * @param $position_ignore
     * @return null
     *
     */
    static function content_audio() {

      $html = '';
      $postid = get_post() ? get_the_ID() : NULL; // Get the postid using the get_the_ID()
      $post_type = get_post_type();

      // Check if this post is forced to display a featured image on list view ( for classic posts only )
      if ( $post_type == 'post' && !is_single() ) {

        $listview     = Plethora_Theme::option( PLETHORA_META_PREFIX .'post-listview', 'inherit', $postid );
        if ( $listview == 'featuredimage' ) { 

          $html = self::content_featuredimage();
          return $html;

        }
      }
      // Show the audio

      $embedaudio     = Plethora_Theme::option( PLETHORA_META_PREFIX .'content-audio', '',  $postid );
      
      if ( !empty( $embedaudio )) {   

             $html .= wp_oembed_get( $embedaudio, array('width' => 740));
      }  
      
      return $html;

    }   

    /**
     * Returns post date html. Use only inside a loop
     * Attention...use get_the_ID() method to retrieve the postid ( not Plethora_Theme::get_the_id() )
     * Also, the Plethora_Theme:option() calls if this is_single() must be called with all their attributes ( option($option_id, $user_value, $postid) )
     *
     * @param 
     * @return string
     *
     */
    static function post_info() {
      $html = '';
      $postid = get_post() ? get_the_ID() : NULL; // Get the postid using the get_the_ID()

      // get options depending on the view
      if ( is_single() ) { 

        $show_categories  = Plethora_Theme::option( PLETHORA_META_PREFIX .'post-info-category', 1, $postid );
        $show_tags        = Plethora_Theme::option( PLETHORA_META_PREFIX .'post-info-tags', 1, $postid );
        $show_author      = Plethora_Theme::option( PLETHORA_META_PREFIX .'post-info-author', 1, $postid );
        $show_date        = Plethora_Theme::option( PLETHORA_META_PREFIX .'post-info-date', 1, $postid );
        $show_comments    = Plethora_Theme::option( PLETHORA_META_PREFIX .'post-info-comments', 1, $postid );

      } else { 

        $show_categories  = Plethora_Theme::option( 'blog-info-category', 1 );
        $show_tags        = Plethora_Theme::option( 'blog-info-tags', 1 );
        $show_author      = Plethora_Theme::option( 'blog-info-author', 1 );
        $show_date        = Plethora_Theme::option( 'blog-info-date', 1 );
        $show_comments    = Plethora_Theme::option( 'blog-info-comments', 1 );

      }

      // date info
      $html_date  = '';
      if ( $show_date ) { 

        $html_date  = '<span class="post_info post_date"><i class="fa fa-clock-o"></i> '.get_the_date() .'</span> ';

      }

      // author info
      $html_author  = '';
      if ( $show_author ) { 

        $html_author  = '<span class="post_info post_author"><i class="fa fa-user"></i> <a href="'. get_author_posts_url(get_the_author_meta( 'ID' )).'" title="' . esc_attr( sprintf( get_the_author() )) . '">'. get_the_author() .'</a></span> ';
      }


      // categories info
      $html_categories  = '';
      if ( $show_categories ) { 
        $categories = get_the_category();
        $sep = '';
        $count = 0;
        
        if ( $categories ) {
          $html_categories .= '<i class="fa fa-folder"></i> ';
          foreach($categories as $key=>$category) {

            $count = $count + 1;
            $sep = $count > 1 ? ', ': '';
            $html_categories .= $sep .'<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in category: %s", 'cleanstart' ), $category->name ) ) . '">'.$category->cat_name.'</a>';
        
          }
          $html_categories = '<span class="post_info post_categories">'. $html_categories .'</span>';
        }
      }

      // tags info
      $html_tags  = '';
      if ( $show_tags ) { 
        $tags = get_the_tags();
        $sep = '';
        $count = 0;
        
        if ( $tags ) {
          $html_tags .= '<i class="fa fa-tag"></i> ';

          foreach($tags as $key=>$tag) {
            $count = $count + 1;
            $sep = $count > 1 ? ', ': '';
            $html_tags .= $sep .'<a href="'.get_tag_link( $tag->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts tagged with: %s", 'cleanstart' ), $tag->name ) ) . '">'. $tag->name .'</a>';
        
          }
          $html_tags = '<span class="post_info post_tags">'. $html_tags .'</span> ';
        }
      }

      // comments info
      $html_comments  = '';
      if ( $show_comments && comments_open()  ) { 

          $num_comments = get_comments_number();
          
          if ( $num_comments > 0 ) {

            $html_comments = '<i class="fa fa-comments"></i> <a href="'. esc_url( get_permalink() .'#post_comments').'"> '. $num_comments .'</a>' ;

          } 
           $html_categories = '<span class="post_info post_comments">'. $html_categories .'</span> ';
     }

      $html = $html_date . $html_author . $html_categories . $html_tags . $html_comments;

      $display_title = Plethora_Theme::option( PLETHORA_META_PREFIX .'post-title-oncontent', 'display', $postid);          // Where to put the title / subtitles
      // wrap them depending on the view
      if ( is_single() && $display_title == 'display' ) {      // Displayed on single view, with header

        $html = '<small>'. $html .'</small>';

      } elseif ( is_single() && $display_title == 'hide' ) {   // Displayed on single view, with hidden header

        $html = '<div class="post_sub">'. $html .'</div>';

      } else {                                                // Catalog view

        $html = '<div class="post_sub">'. $html .'</div>'; 

      }

      return $html;
    
    }

    /**
     * Returns post author bio. Use only inside a loop
     *
     * @param 
     * @return string
     *
     */
    static function post_author_bio() {

      $author_bio = "";

      if ( is_singular() && get_the_author_meta( 'description' ) && is_multi_author() ) {

        $author_bio .= '
        <hr style="border-bottom:dashed 1px #CCC;">
               <div class="author-info">
                    <div class="author-description">';
        $author_bio .= "<h2>" . sprintf( __( 'About %s', 'cleanstart' ), get_the_author() ) . "</h2>"; 
        $author_bio .= get_avatar( get_the_author_meta( 'user_email' ), 68 );
        $author_bio .= '<p>' . get_the_author_meta( 'description' ) . '</p>';
        $author_bio .= '<div class="author-link">';
        $author_bio .= '<a class="post-edit-link" href="' . get_edit_post_link() . '"><span class="edit-link">' . __('Edit', 'cleanstart') . ' | </span></a>';
        $author_bio .= '<a href="'. esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'" rel="author">';
        $author_bio .= sprintf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'cleanstart' ), get_the_author() );
        $author_bio .= '</a></div>';
        $author_bio .= '
                    </div>
                </div>';
      } 
      return $author_bio;

    }

    /**
     * Returns side corners for all the positions
     *
     * @param $position ( header, content, footer )
     * @return string
     *
     */
    static function triangles( $position ) {

    if ( empty($position) ) { return; }
      
      $html = '';
      $triangles = Plethora_Theme::option( PLETHORA_META_PREFIX . $position .'-triangles', 'display');

      if ( $triangles == 'display') { 
            $html .= '<div class="container triangles-of-section">'."\n";
            $html .= '  <div class="triangle-up-left"></div>'."\n";
            $html .= '  <div class="square-left"></div>'."\n";
            $html .= '  <div class="triangle-up-right"></div>'."\n";
            $html .= '  <div class="square-right"></div>'."\n";
            $html .= '</div>'."\n";

      }
      return $html;
    }

    /**
     * Returns post excerpt text limited to 140 chars
     *
     * @param $text
     * @return string
     *
     */
    static function excerpt($text) {

      $chars_limit = 140;
      $chars_text = strlen($text);
      $text = $text." ";
      $text = substr($text,0,$chars_limit);
      $text = substr($text,0,strrpos($text,' '));
      if ($chars_text > $chars_limit){$text = $text."...";}
      return $text;
    
    }
  } 

}