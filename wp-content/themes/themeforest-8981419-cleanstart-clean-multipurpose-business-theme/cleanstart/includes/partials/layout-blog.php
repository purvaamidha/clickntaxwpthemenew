<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M			      (c) 2014-2015

Layout page: Blog

*/
Plethora_Theme::dev_comment('Start >>> Layout Template Part Loaded: '. THEME_PARTIALS_DIR . '/'. basename( __FILE__ ), 'templateparts');
get_header();
$blog_layout   = Plethora_Theme::option('blog-layout', 'right_sidebar');
switch ( $blog_layout ) {
	case 'right_sidebar' :
		$sectionwrap_add	= ' class="with_right_sidebar"';
		$contentdiv_add		= ' id="leftcol" class="col-sm-8 col-md-8"';
		break;
	case 'left_sidebar' :
		$sectionwrap_add	= ' class="with_left_sidebar"';
		$contentdiv_add		= ' id="rightcol" class="col-sm-8 col-md-8"';
		break;
	default:
		$sectionwrap_add	= ' class="with_right_sidebar"';
		$contentdiv_add		= ' id="leftcol" class="col-sm-8 col-md-8"';
		break;
}
?>
<?php Plethora_Theme::dev_comment('Start >>> Main Wrapper', 'layout'); ?>
<div class="main">
	<?php echo Plethora_Theme::html_triangles( 'header' ) // Header side corners  ?>
	<section<?php echo $sectionwrap_add; ?>>
		<div class="container">
			<div class="row">
				<?php if ( $blog_layout == 'left_sidebar' ) { get_sidebar(); } // Left Sidebar ?>
				<div<?php echo $contentdiv_add; // Content area ?>>

				<?php get_template_part('includes/partials/loop'); // Get the loop template part for displaying posts ?>

				</div>
				<?php if ( $blog_layout == 'right_sidebar' ) { get_sidebar(); } // Right Sidebar ?>

			</div>
		</div>
	</section>
<?php get_footer(); ?>
<?php Plethora_Theme::dev_comment('End <<< '. THEME_PARTIALS_DIR . '/'. basename( __FILE__ ), 'templateparts'); ?>