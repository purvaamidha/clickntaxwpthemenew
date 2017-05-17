<?php
// Featured Media Section / Other Image
Plethora_Theme::dev_comment('Head Panel Template part ( 404 version ) loaded: '. THEME_PARTIALS_DIR . '/'. basename( __FILE__ ), 'templateparts');

// Get the Title
$title_html = Plethora_Theme::html_headermedia_title();

// Get the Subtitle
$subtitle_html = Plethora_Theme::html_headermedia_subtitle();

// Get the Other Image
$header_image_html = Plethora_Theme::html_headermedia_404();

if ( !empty( $header_image_html )) { $nophoto_class = ''; $comment = '404 image display'; } else { $nophoto_class = ' no_photo';  $comment = 'should be 404 image display, but apparently no 404 image was set on theme options!'; } 
?>
<?php Plethora_Theme::dev_comment('Start >>> Header media section ( '. $comment .' )', 'layout'); ?>
<div class="full_page_photo<?php echo $nophoto_class; ?>"<?php echo $header_image_html; ?>>
     <div class="hgroup">
      <?php  
          echo $title_html;
          echo $subtitle_html;
      ?>
     </div>
</div>
<?php Plethora_Theme::dev_comment('End <<< Header media section', 'layout'); ?>
<?php Plethora_Theme::dev_comment('End <<< '. THEME_PARTIALS_DIR . '/'. basename( __FILE__ ), 'templateparts'); ?>