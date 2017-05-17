<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M			      (c) 2014-2015

Layout page: Page

*/
Plethora_Theme::dev_comment('Start >>> Template Part Loaded: '. THEME_PARTIALS_DIR . '/'. basename( __FILE__ ), 'templateparts');

/*** ENABLE ONE PAGE SMOOTH SCROLLING [v1.1] ***/
if ( Plethora_Theme::option( PLETHORA_META_PREFIX .'one-pager' ) === "enabled" ){

	add_action( 'wp_enqueue_scripts', "enqueue_one_pager" );

	function enqueue_one_pager(){
		wp_register_script( 'one_pager', THEME_ASSETS_URI . '/cleanstart_onepager.js' ); 
		wp_enqueue_script ( 'one_pager' );

        $one_pager_data = array( 'one_pager_speed' => Plethora_Theme::option( PLETHORA_META_PREFIX .'one-pager-speed', 300 ) );
        wp_localize_script( 'one_pager', 'one_pager', $one_pager_data );
	}

}

get_header(); 

$page_layout          = Plethora_Theme::option( PLETHORA_META_PREFIX . 'page-layout', 0);
$display_title        = Plethora_Theme::option( PLETHORA_META_PREFIX .'page-title-oncontent', 'header');          // Where to put the title
$content_has_sections = ( $page_layout == 0 ) ? Plethora_Theme::option( PLETHORA_META_PREFIX . 'content_has_sections', 0) : 0;
$the_title            = $display_title == 'display' ? '<div class="col-md-12"><h1 class="section_header elegant title_in_content">'. get_the_title() .'<small></small></h1></div>' : '';

switch ( $page_layout ) {
	case 0 : //Fullwidth
		$title_wrapper		= $display_title == 'display' ? '<section><div class="container"><div class="row">'. $the_title .'</div></div></section>' : '';
		$main_wrapper_op	= '';
		$clmn_wrapper_op	= '';
		$cont_wrapper_op	= '	<section><div class="container"><div class="row">'."\n";
		$cont_wrapper_cl	= '	</div></div></section>'."\n";
		$cmnts_wrapper_op	= '	<section><div class="container"><div class="row">'."\n";
		$cmnts_wrapper_cl	= '	</div></div></section>'."\n";
		$clmn_wrapper_cl	= '';
		$main_wrapper_cl	= '';
		break;
	case 1 : //Right Sidebar
		$title_wrapper		= '';
		$main_wrapper_op	= '	<div class="with_right_sidebar"><div class="container"><section>'. $the_title .'</section><div class="row">'."\n";
		$clmn_wrapper_op	= '		<div id="leftcol" class="col-sm-8 col-md-8">'."\n";
		$cont_wrapper_op	= '';//'			<section><div class="container"><div class="row">'."\n";
		$cont_wrapper_cl	= '';//'			</div></div></section>'."\n";
		$cmnts_wrapper_op	= '			<section><div class="container"><div class="row">'."\n";
		$cmnts_wrapper_cl	= '			</div></div></section>'."\n";
		$clmn_wrapper_cl	= '		</div>'."\n";
		$main_wrapper_cl	= '	</div></div></div>'."\n";
		break;
	case 2 : //Left Sidebar
		$title_wrapper		= '';
		$main_wrapper_op	= '	<div class="with_left_sidebar"><div class="container"><section>'. $the_title .'</section><div class="row">'."\n";
		$clmn_wrapper_op	= '		<div id="rightcol" class="col-sm-8 col-md-8">'."\n";
		$cont_wrapper_op	= '';//'			<section><div class="container"><div class="row">'."\n";
		$cont_wrapper_cl	= '';//'			</div></div></section>'."\n";
		$cmnts_wrapper_op	= '			<section><div class="container"><div class="row">'."\n";
		$cmnts_wrapper_cl	= '			</div></div></section>'."\n";
		$clmn_wrapper_cl	= '		</div>'."\n";
		$main_wrapper_cl	= '	</div></div></div>'."\n";
		break;

	default:
		$title_wrapper		= $display_title == 'display' ? '<section><div class="container"><div class="row">'. $the_title .'</div></div></section>' : '';
		$main_wrapper_op	= '';
		$clmn_wrapper_op	= get_the_title();
		$cont_wrapper_op	= '	<section><div class="container"><div class="row">'."\n";
		$cont_wrapper_cl	= '	</div></div></section>'."\n";
		$cmnts_wrapper_op	= '	<section><div class="container"><div class="row">'."\n";
		$cmnts_wrapper_cl	= '	</div></div></section>'."\n";
		$clmn_wrapper_cl	= '';
		$main_wrapper_cl	= '';
		break;
}
?>
<?php Plethora_Theme::dev_comment('Start >>> Main wrapper', 'layout'); ?>
	<div class="main">

<?php echo Plethora_Theme::html_triangles( 'header' ) // Header side corners  ?>

<?php
$customize_vc = Plethora::option( 'customizevc-status', 1, 0, false);
if ( $content_has_sections == 1 && $customize_vc ) {  // Used only when the page is edited with VC

	$cont_wrapper_op	= '';
	$cont_wrapper_cl	= '';
}
?>

<?php Plethora_Theme::dev_comment('Start >>> Column(s) wrapper', 'layout'); ?>

<?php echo $title_wrapper;  ?>
<?php echo $main_wrapper_op;  ?>
<?php if ( $page_layout == 2 ) { get_sidebar(); } // Left Sidebar ?>
<?php Plethora_Theme::dev_comment('Start >>> Main Column wrapper', 'layout'); ?>
<?php echo $clmn_wrapper_op;  ?>
	<?php
		// Main Content Area
		if ( have_posts() ) { 

			while ( have_posts() ) : the_post(); ?>
				<?php Plethora_Theme::dev_comment('Start >>> Content Section(s) wrapper', 'layout'); ?>
				<?php echo $cont_wrapper_op; ?>
				<?php the_content(); ?>
				<?php echo $cont_wrapper_cl; ?> 	
				<?php Plethora_Theme::dev_comment('End <<< Content Section(s) wrapper', 'layout'); ?>
				<?php if ( comments_open() ) { Plethora_Theme::dev_comment('Start >>> Comments wrapper', 'layout'); echo $cmnts_wrapper_op; } ?>	
				<?php if ( comments_open() ) { comments_template(); } ?>
				<?php if ( comments_open() ) { echo $cmnts_wrapper_cl; Plethora_Theme::dev_comment('End <<< Comments wrapper', 'layout'); } ?>	
				<?php  
			endwhile; 
		
		}  ?>
<?php echo $clmn_wrapper_cl;  ?>
<?php Plethora_Theme::dev_comment('End <<< Main Column wrapper', 'layout'); ?>
<?php if ( $page_layout == 1 ) { get_sidebar(); } // Right Sidebar ?>
<?php echo $main_wrapper_cl;  ?>
<?php Plethora_Theme::dev_comment('End <<< Column(s) wrapper', 'layout'); ?>
<?php get_footer(); ?>
<?php Plethora_Theme::dev_comment('End <<< '. THEME_PARTIALS_DIR . '/'. basename( __FILE__ ), 'templateparts'); ?>