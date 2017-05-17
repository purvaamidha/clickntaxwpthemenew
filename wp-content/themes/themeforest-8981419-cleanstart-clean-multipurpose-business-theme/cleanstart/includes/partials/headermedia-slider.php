<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M            (c) 2014

Head Panel Section / Slider

*/
Plethora_Theme::dev_comment('Start >>> Head Panel Template part ( slider version ) loaded: '. THEME_PARTIALS_DIR . '/'. basename( __FILE__ ), 'templateparts');

// Get the slider
$slider_html  = Plethora_Theme::html_headermedia_slider();

if ( !empty( $slider_html )) { 

  Plethora_Theme::dev_comment('Start >>> Head Panel Section ( slider display )', 'layout');
  echo $slider_html;
  Plethora_Theme::dev_comment('End <<< Head Panel Section', 'layout');

} else { // if slides are empty, then show No Media display version

  $title_html = Plethora_Theme::html_headermedia_title(); // Get the Title
  $subtitle_html = Plethora_Theme::html_headermedia_subtitle(); // Get the Subtitle

  ?>
  <?php Plethora_Theme::dev_comment('Start >>> Head Panel Section ( should be slider display, but apparently no slider was found on post meta! )', 'layout'); ?>
  <div class="full_page_photo no_photo">
       <div class="hgroup">
        <?php  
            echo $title_html;
            echo $subtitle_html;
        ?>
       </div>
  </div>
  <?php Plethora_Theme::dev_comment('End <<< Head Panel Section', 'layout'); ?>
<?php } ?>
<?php Plethora_Theme::dev_comment('End <<< '. THEME_PARTIALS_DIR . '/'. basename( __FILE__ ), 'templateparts'); ?>