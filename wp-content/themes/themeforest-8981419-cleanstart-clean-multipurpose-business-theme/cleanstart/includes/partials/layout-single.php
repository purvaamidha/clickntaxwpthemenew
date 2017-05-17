<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M			      (c) 2014-2015

Layout page: 404

*/
Plethora_Theme::dev_comment('Start >>> Template Part Loaded: '. THEME_PARTIALS_DIR . '/'. basename( __FILE__ ), 'templateparts');
get_header();
$post_layout = Plethora_Theme::option(  PLETHORA_META_PREFIX .'post-layout', 'right_sidebar' );
$display_title = Plethora_Theme::option( PLETHORA_META_PREFIX .'post-title-oncontent', 'display');          // Where to put the title / subtitles
$title_behavior = Plethora_Theme::option( PLETHORA_META_PREFIX . 'header-title-type-post', 'blogtitle'); 

switch ( $post_layout ) {
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
	<section<?php echo $sectionwrap_add?>>
		<div class="container">
	<?php if ( $display_title  == 'display') { ?>

			<?php 
			// This is a hack to display normally the title / title info. Use the Loop routine, and call rewind_posts() after finish.
			// This way, posts will be displayed normally on single post view.
			if ( have_posts() ) { 

				wp_link_pages(array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'cleanstart' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					));

				while ( have_posts() ) : the_post(); 

					if ( $title_behavior === 'notitle' ) {

						echo '<h1 class="section_header elegant">' . the_title('','',false) . Plethora_Theme::html_post_info() . '</h1>';

					} else {

						echo '<h2 class="section_header elegant">' . the_title('','',false) . Plethora_Theme::html_post_info() . '</h2>';

					}
				endwhile; 
				rewind_posts();
			}
			?>

	<?php } ?>
			<div class="row">
				<?php if ( $post_layout == 'left_sidebar' ) { get_sidebar(); } // Left Sidebar ?>
				<div<?php echo $contentdiv_add; // Content area ?>>

					<?php get_template_part('includes/partials/loop'); // Get the loop template part for displaying posts ?>

				</div>
				<?php if ( $post_layout == 'right_sidebar' ) { get_sidebar(); } // Right Sidebar ?>
			</div>
		</div>
	</section>

<?php get_footer(); ?>
<?php Plethora_Theme::dev_comment('End >>> '. THEME_PARTIALS_DIR . '/'. basename( __FILE__ ), 'templateparts'); ?>