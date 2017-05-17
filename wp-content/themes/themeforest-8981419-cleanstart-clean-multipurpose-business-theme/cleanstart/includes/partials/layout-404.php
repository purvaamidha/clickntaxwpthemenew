<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M			(c) 2014-2015

Layout page: 404

*/
Plethora_Theme::dev_comment('Start >>> Layout Template Part Loaded: '. THEME_PARTIALS_DIR . '/'. basename( __FILE__ ), 'templateparts');
get_header();
$four04_title = Plethora_Theme::option('404-title');
$four04_subtitle = Plethora_Theme::option('404-subtitle');
?>
<?php Plethora_Theme::dev_comment('Start >>> Main Wrapper', 'layout'); ?>
<div class="main">
	<?php echo Plethora_Theme::html_triangles( 'header' ) // Header side corners  ?>
          <section class="call_to_action four-o-four">
               <div class="container"> <i class="fa fa-ambulance"></i>
                    <h3><?php echo $four04_title; ?></h3>
                    <h4><?php echo $four04_subtitle; ?></h4>
               </div>
          </section>
          <section>
               <div class="container">
			<?php get_search_form( true ); ?>
               </div>
          </section>
<?php get_footer(); ?>
<?php Plethora_Theme::dev_comment('End <<< '. THEME_PARTIALS_DIR . '/'. basename( __FILE__ ), 'templateparts'); ?>