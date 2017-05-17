<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M                       (c) 2014

File Description: Standard Post Format Display Template Part 

*/
Plethora_Theme::dev_comment('Start >>> Standard post content template part loaded: '. THEME_PARTIALS_DIR . '/'. basename( __FILE__ ) , 'templateparts');
$featuredimage_html = Plethora_Theme::html_content_featuredimage();
$blog_linktext      = Plethora_Theme::option( PLETHORA_META_PREFIX .'blog-show-linkbutton-text', __('Read More', 'cleanstart')); // Link Button Text

// Single Post View
if ( is_single() ) : 

     Plethora_Theme::dev_comment('Start >>> Single Post Content ( standard post format )', 'layout'); 
     $display_title         = Plethora_Theme::option( PLETHORA_META_PREFIX .'post-title-oncontent', 'display');    // Display the title / subtitles on content?
     $display_media         = Plethora_Theme::option( PLETHORA_META_PREFIX .'post-media-oncontent', 'display');    // Display featured media on content?
     ?>
     <article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
          <div class="post_content">
          <?php if ( $display_title == 'hide' ) { echo Plethora_Theme::html_post_info(); } ?>
          <?php if ( $display_media == 'display' && !empty( $featuredimage_html) ) { echo '<figure>'. $featuredimage_html .'</figure>'; } ?>
          <?php the_content(); ?>
          </div>

          <?php wp_link_pages(array(
               'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'cleanstart' ) . '</span>',
               'after'       => '</div>',
               'link_before' => '<span>',
               'link_after'  => '</span>',
          )); ?>

          <?php 
               // DISPLAY AUTHOR BIO
               echo Plethora_Theme::html_post_author_bio(); 
          ?>

     </article>
     <?php Plethora_Theme::dev_comment('End <<< Single Post Content', 'layout'); ?>

     <?php comments_template(); ?>

<?php

// Listing view
else : 
     $post_type = get_post_type();
     Plethora_Theme::dev_comment('Start >>> Loop Item ( '. $post_type .' )', 'layout'); 
     $display_media_on_list = Plethora_Theme::option( PLETHORA_META_PREFIX .'post-listview', 'inherit', get_the_id()); // Display featured media on listing view?
     $blog_listing          = Plethora_Theme::option( PLETHORA_META_PREFIX .'blog-listing', 'excerpt', get_the_id()); // Display Excerpt or Content?
     $blog_linkbutton       = Plethora_Theme::option( PLETHORA_META_PREFIX .'blog-show-linkbutton', 1, get_the_id()); // Show Post Link Button
     ?>
     <article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
          <div class="post_header">
               <h2 class="post_title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
               </h2>
               <?php echo Plethora_Theme::html_post_info(); ?>
          </div>
          <div class="post_content">
          <?php if ( $display_media_on_list != 'hide' && !empty( $featuredimage_html) ) { echo '<figure>'. $featuredimage_html .'</figure>'; } ?>
               <?php 
               if ( $blog_listing === 'excerpt' || $post_type != 'post' ) {
                     if ($post_type != 'post') { echo '<p>'; }
                        the_excerpt(''); 
                     if ($post_type != 'post') { echo '</p>'; }
              } else {
                    echo apply_filters('the_content', get_the_content());
               }
               if ( $blog_linkbutton == 1 ) { ?>
                    <a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php echo wp_strip_all_tags( $blog_linktext ); ?></a> 
               <?php } ?>
          </div>
     </article>
     <?php Plethora_Theme::dev_comment('End <<< Loop Item ( '. $post_type .' )', 'layout'); ?>
<?php endif; ?>
<?php Plethora_Theme::dev_comment('End <<< '. THEME_PARTIALS_DIR . '/'. basename( __FILE__ ), 'templateparts'); ?>