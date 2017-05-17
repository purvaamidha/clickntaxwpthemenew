<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M            (c) 2014

Head Panel Section / Google Map

*/
Plethora_Theme::dev_comment('Start >>> Head Panel Template part ( Googlemap version ) loaded: '. THEME_PARTIALS_DIR . '/'. basename( __FILE__ ), 'templateparts');

$title_html         = Plethora_Theme::html_headermedia_title(); 	// GET TITLE
$subtitle_html      = Plethora_Theme::html_headermedia_subtitle(); 	// GET SUBTITLE
$header_gmap_status = Plethora_Theme::html_headermedia_googlemap(); // GET GOOGLE MAP STATUS

if ( !empty( $header_gmap_status )) { $nophoto_class = ''; $comment = 'Google map display'; $map_wrap_start = '<div id="map"></div><div class="container">'."\n"; $map_wrap_end = '</div>'."\n";  } else { $nophoto_class = ' no_photo';  $comment = 'should be Google map display, but apparently no info found on post meta!'; $map_wrap_start = ''; $map_wrap_end = ''; } 
?>

<?php Plethora_Theme::dev_comment('Start >>> Head Panel Section ( '. $comment .' )', 'layout'); ?>

<div class="full_page_photo<?php echo $nophoto_class; ?>">
     <?php echo $map_wrap_start; ?>
     <div class="hgroup">
      <?php  
          echo $title_html;
          echo $subtitle_html;
      ?>
     </div>
     <?php echo $map_wrap_end; ?>
</div>

<?php Plethora_Theme::dev_comment('End <<< Head Panel Section', 'layout'); ?>
<?php Plethora_Theme::dev_comment('End <<< '. THEME_PARTIALS_DIR . '/'. basename( __FILE__ ), 'templateparts'); ?>