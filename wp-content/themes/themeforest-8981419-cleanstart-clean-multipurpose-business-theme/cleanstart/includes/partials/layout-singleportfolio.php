<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M			          (c) 2014-2015

Layout page: 404

*/
Plethora_Theme::dev_comment('Start >>> Template Part Loaded: '. THEME_PARTIALS_DIR . '/'. basename( __FILE__ ), 'templateparts');
get_header();
$portfolio_layout          = Plethora_Theme::option( PLETHORA_META_PREFIX .'portfolio-layout', 'side' );
$portfolio_title_oncontent = Plethora_Theme::option( PLETHORA_META_PREFIX .'portfolio-title-oncontent', 'display' );

?>
<?php Plethora_Theme::dev_comment('Start >>> Main Wrapper', 'layout'); ?>
<div class="main">
	<?php echo Plethora_Theme::html_triangles( 'header' ) // Header side corners  ?>
     <?php Plethora_Theme::dev_comment('Start >>> Portfolio Info Section', 'layout'); ?>
          <section class="portfolio_slider_wrapper">
               <div class="container">
<?php if ( $portfolio_layout == 'side' ) { ?>               
                    <div class="row">
                         <div class="col-sm-12 col-md-8">
                              <div class="portfolio_slider_wrapper">
<?php } ?>               
                              <?php
                               $media_type = Plethora_Theme::option(PLETHORA_META_PREFIX .'portfolio-media', 'gallery');

                               if ( $media_type == 'gallery') { 

                                 echo html_portfolio_gallery(); // Portfolio gallery 
                               
                               } elseif ( $media_type == 'featured_image') {

                                 echo html_portfolio_featuredimage(); // Portfolio featured image 

                               } 
                               ?>
<?php if ( $portfolio_layout == 'side' ) { ?>   
                              </div>
                         </div>
                         <div class="col-sm-12 col-md-4">
 <?php } ?>    


 <?php if ( $portfolio_layout == 'full') {  ?>   

          <?php if ( have_posts() ) {  ?>

                              <div class="portfolio_details">
                                   <div class="row">
                                        <div class="col-sm-9 col-md-9">
          <?php     while ( have_posts() ) : the_post(); ?>
          <?php          if ( $portfolio_title_oncontent == 'display' ) { echo '<h2 class="section_header">'; the_title(); echo '</h2>'; } ?>
                                             <?php the_content(); ?>               
          <?php     endwhile; ?>                              
                                       </div>
                                   <?php echo html_portfolio_details(); // Portfolio details  ?>
                                   </div>
                              </div>
          <?php } ?>                              
 <?php } elseif  ( $portfolio_layout == 'side') { ?>   
          <?php if ( have_posts() ) {  ?>
                              <div class="portfolio_details">
          <?php     while ( have_posts() ) : the_post(); ?>
          <?php          if ( $portfolio_title_oncontent == 'display' ) { echo '<h2 class="section_header">'; the_title(); echo '</h2>'; } ?>
                                   <?php the_content(); ?>
                                   <br>
                                   <br>
          <?php     endwhile; ?>                              
                                   <?php echo html_portfolio_details(); // Portfolio details  ?>
                              </div>
          <?php } ?>                              
 <?php } ?>    

<?php if ( $portfolio_layout == 'side' ) { ?>               
                         </div>
                    </div>
 <?php } ?> 
 <?php 
$prev_text = Plethora_Theme::option(  PLETHORA_META_PREFIX .'portfolio-navbuttons-prev', __('Previous', 'cleanstart') );
$next_next = Plethora_Theme::option(  PLETHORA_META_PREFIX .'portfolio-navbuttons-next', __('Next', 'cleanstart') );
 ?>              

                    <ul class="pager">
                         <?php
                         // NAVIGATION BUTTONS SWITCHED 
                         $navigation_buttons = Plethora_Theme::option(  PLETHORA_META_PREFIX .'portfolio-navbuttons', 'display' );
                         if ( $navigation_buttons === "display" ):
                         ?>
                         <li class="previous">
                              <?php 
                              echo previous_post_link('%link', '<i class="fa fa-chevron-left"></i> '. $prev_text ); 
                              ?>
                         </li>
                         <li class="next">
                              <?php 
                              echo next_post_link('%link', $next_next .' <i class="fa fa-chevron-right"></i>'); 
                              ?>
                         </li>
                         <?php endif; ?>
                    </ul>

               </div>
          </section>
<?php Plethora_Theme::dev_comment('End <<< Portfolio Info Section', 'layout'); ?>
<?php Plethora_Theme::dev_comment('Start >>> Related Portfolio Section', 'layout'); ?>
<?php echo html_portfolio_related(); // Portfolio related posts ( check function below )  ?>
<?php Plethora_Theme::dev_comment('End <<< Related Portfolio Section', 'layout'); ?>

<?php get_footer(); ?>
<?php Plethora_Theme::dev_comment('End <<< '. THEME_PARTIALS_DIR . '/'. basename( __FILE__ ), 'templateparts'); ?>
<?php


// HELPER FUNCTIONS >>>>>>>>> 

/**
* Returns portfolio gallery (single post view)
*
*/
function html_portfolio_gallery() {

      $gallery_photos = Plethora_Theme::option( PLETHORA_META_PREFIX. 'portfolio-slides', array());
      $html  = '';
      $counter = 0;

      // Since the slides field default behaviour creates an array, we implement another method for checking if users created a slideshow
      foreach ( $gallery_photos as $gallery_photo ) { 

        $counter = !empty( $gallery_photo['image'] ) ? $counter + 1 : $counter;

      }

      if ( $counter > 0) { 
          $html .= '                    <div class="flexslider" id="portfolio_slider">'."\n";
          $html .= '                         <ul class="slides">'."\n";
          foreach ( $gallery_photos as $gallery_photo ) { 
              $html .= '                              <li class="item" data-thumb="'. $gallery_photo['image'].'" style="background-image: url('. $gallery_photo['image'].')">
        '."\n";
              $html .= '                                   <div class="container"> <a href="'. esc_url( $gallery_photo['image'] ).'" class="lightbox_single" title="'. esc_attr( $gallery_photo['title'] ).'" data-imagelightbox="gallery"></a>'."\n";
              $html .= '                                        <div class="carousel-caption">'."\n";
              if (!empty($gallery_photo['title'])) { 
              $html .= '                                             <p class="lead">'. $gallery_photo['title'] .'</p>'."\n";
              }
              $html .= '                                        </div>'."\n";
              $html .= '                                   </div>'."\n";
              $html .= '                              </li>'."\n";
            } 
          $html .= '                         </ul>'."\n";
          $html .= '                    </div>'."\n";

          $html .= '                    <div id="carousel" class="flexslider">'."\n";
          $html .= '                         <ul class="slides">'."\n";
      
          foreach ( $gallery_photos as $gallery_photo ) {
            // have to find media library id, in order to retrieve the medium size version. If image is an external url, then use the option's 'thumb' value
            $image_id = Plethora_Helper::get_imageid_by_url( $gallery_photo['image'] );
            if ( !empty( $image_id )) { 

              $attachment = wp_get_attachment_image_src( $image_id, 'thumb-portfolio' );
              $gallery_thumb = isset( $attachment[0] ) ? $attachment[0] : '';

            } else { 

              $gallery_thumb = $gallery_photo['thumb'];

            }
            
            $html .= '                              <li> <img src="'. esc_url( $gallery_thumb ).'" alt="'. esc_attr( $gallery_photo['title'] ).'"> </li>'."\n";
          } 

          $html .= '                         </ul>'."\n";
          $html .= '                    </div>'."\n";
      }
      return $html;

    }


/**
* Returns portfolio gallery (single post view)
*
*/
function html_portfolio_featuredimage() {

      $html = '';
      $postid = Plethora_Theme::get_the_id();
      if ( has_post_thumbnail( $postid ) ) { 

        $header_image_src = wp_get_attachment_image_src(get_post_thumbnail_id( $postid ), 'full');
        $html = '<img src="'. esc_url( $header_image_src[0] ) .'" class="portfolio_featuredimg" />';

      } 

      return $html;

    }
/**
* Returns portfolio details (single post view)
*
*/
 function html_portfolio_details() {

      $details_status = Plethora_Theme::option( PLETHORA_META_PREFIX .'portfolio-infofields-box');

      if ( $details_status != 'display' ) { return; }

      $postid = Plethora_Theme::get_the_id();
      $html     = '';
      $layout   = Plethora_Theme::option( PLETHORA_META_PREFIX. 'portfolio-layout' );
      $but_title= Plethora_Theme::option( PLETHORA_META_PREFIX. 'portfolio-site-title' );
      $but_url  = Plethora_Theme::option( PLETHORA_META_PREFIX. 'portfolio-site-url' );
      $fields   = Plethora_Theme::option( PLETHORA_META_PREFIX .'portfolio-infofields' );
      $rating   = Plethora_Theme::option( PLETHORA_META_PREFIX. 'portfolio-rating' );

      $args = array('hierarchical' => 0,'taxonomy' => 'project-type' ); 
      $project_types = wp_get_post_terms( $postid , 'project-type', array( 'fields' => 'names' ));
      $project_types = implode(', ', $project_types);

      //version full
      if ( $layout == 'full') { 
        $html .= '                              <div class="well col-sm-3 col-md-3">'."\n";
        if( !empty($project_types)) { $html .= '                                   <p><strong>'.__('Category', 'cleanstart').': </strong>'. $project_types .'</p>'."\n"; }
        if( !empty($fields) ) {      $html .=  $fields ."\n"; }
        if( !empty($rating) ) {       $html .= '                                   <p><strong>'.__('Rating', 'cleanstart').': </strong><span class="rating r'.$rating.'"></span></p>'."\n"; }
        if( !empty($but_title) && !empty($but_url) ) { $html .= '                  <p><a href="'. esc_url( $but_url ).'" class="btn btn-danger center-block" target="_blank">'. $but_title .'</a></p>'."\n"; }
        $html .= '                              </div>'."\n";
        $html .= '                              <br>'."\n";

      } elseif ( $layout == 'side') { 
        //version side
        $html .= '                                   <div>'."\n";
        if( !empty($project_types)) { $html .= '                                        <p><strong>'.__('Category', 'cleanstart').': </strong>'. $project_types .'</p>'."\n"; }
        if( !empty($fields) ) {      $html .=  $fields ."\n"; }
        if( !empty($rating) ) {       $html .= '                                        <p><strong>'.__('Rating', 'cleanstart').': </strong><span class="rating r'.$rating.'"></span></p>'."\n"; }
        $html .= '                                   </div>'."\n";
        $html .= '                                   <br>'."\n";
        $html .= '                                   <br>'."\n";
        if( !empty($but_title) && !empty($but_url) ) { $html .= '                                   <a href="'. esc_url( $but_url ) .'" class="btn btn-danger center-block" target="_blank">'. $but_title .'</a>'."\n";}
      }

      return $html;
}

/**
* Returns portfolio related posts (single post view)
*/
function html_portfolio_related() {

 $postid = Plethora_Theme::get_the_id();
 $html = '';

 //check post/theme settings for display. If is hidden...then get out of here!
 $related = Plethora_Theme::option(  PLETHORA_META_PREFIX .'portfolio-related', 'hide' );
 if ($related == 'hide') { return; }    

 // Get Related Portfolio override/default options
 $related_header   = Plethora_Theme::option(  PLETHORA_META_PREFIX .'portfolio-related-header', __('Related Projects', 'cleanstart') );
 $related_results  = Plethora_Theme::option(  PLETHORA_META_PREFIX .'portfolio-related-results', '3' );
 
 // Get portfolio's project type(s). 
 $tags = wp_get_post_terms( $postid , 'project-type', array( 'fields' => 'ids' ));

 if ( !empty($tags) ) {
   $related_type = $tags[0]; // take the first set project type
   $args = array(
     'posts_per_page'=>$related_results,
     'ignore_sticky_posts'=>1,
     'post_type' => 'portfolio',
     'post__not_in' => array($postid),
     'tax_query' => array(
                 array(
                   'taxonomy' => 'project-type',
                   'field' => 'id',
                   'terms' => array($related_type),
                 )
     )        
   );
   $rel_query = new WP_Query($args);
   if( $rel_query->have_posts() ) {

     $html .= '          <section class="portfolio_teasers_wrapper">'."\n";
     $html .= '               <div class="container">'."\n";
     $html .= '                    <h2 class="elegant centered section_header">'. $related_header .'<small></small></h2>'."\n";
     $html .= '                    <div class="portfolio_strict row">'."\n";

     while ($rel_query->have_posts()) { 

       $rel_query->the_post();
       
       $project_types = wp_get_post_terms( $postid , 'project-type', array( 'fields' => 'names' ));
       $project_types = implode(', ', $project_types);
       $thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ),  'large') ;

       $html .= '                         <div class="col-sm-4 col-md-4">'."\n";
       $html .= '                              <div class="portfolio_item">'."\n";
       $html .= '                                <a href="'. get_permalink() .'">'."\n";
       $html .= '                                   <figure style="background-image:url('. esc_url( $thumb_url[0] ) .')">'."\n";
       $html .= '                                        <figcaption>'."\n";
       $html .= '                                             <div class="portfolio_description">'."\n";
       $html .= '                                                  <h3>'. get_the_title() .'</h3>'."\n";
       $html .= '                                                  <span class="cross"></span>'."\n";
       $html .= '                                                  <p>'. $project_types .'</p>'."\n";
       $html .= '                                             </div>'."\n";
       $html .= '                                        </figcaption>'."\n";
       $html .= '                                   </figure>'."\n";
       $html .= '                                </a>'."\n";
       $html .= '                              </div>'."\n";
       $html .= '                         </div>'."\n";         

     } 
     
     $html .= '                    </div>'."\n";
     $html .= '               </div>'."\n";
     $html .= '          </section>'."\n";

   }

   wp_reset_query();
 }
 return $html;
}
// <<<<<<<<< HELPER FUNCTIONS
?>