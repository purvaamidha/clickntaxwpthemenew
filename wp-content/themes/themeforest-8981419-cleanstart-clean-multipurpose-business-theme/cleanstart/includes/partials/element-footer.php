<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M            (c) 2014

File Description: Footer 

*/
Plethora_Theme::dev_comment('Start >>> Footer Template Part Loaded: '. THEME_PARTIALS_DIR . '/'. basename( __FILE__ ), 'templateparts');

$twitterfeed = Plethora_Theme::option( PLETHORA_META_PREFIX . 'footer-twitterfeed', 0);
if ( $twitterfeed == 1 ) { 

	get_template_part('includes/partials/element', 'twitterfeed');

}   

Plethora_Theme::dev_comment('Start >>> Footer Section', 'layout');
$footer_mainsection = Plethora_Theme::option('footer-mainsection', 1);
$footer_infobar 	= Plethora_Theme::option('footer-infobar', 1);
$footer_layout   	= Plethora_Theme::option( 'footer-layout', 5);
 ?>
		<footer>
		<?php
		if ( $footer_mainsection ) { 
		?>	<section class="footer_teasers_wrapper">
			<?php echo Plethora_Theme::html_triangles( 'footer' ) // Footer side corners  ?>
      			<div class="container">
			      <div class="row">
					<?php get_template_part('includes/partials/element-footer-widgets', $footer_layout); ?>
			     </div>
		      </div>
			</section>
		<?php } 
		if ( $footer_infobar ) {
	      	$footer_infobar           = Plethora_Theme::option( 'footer-infobar', 0);
	     	$footer_infobar_copyright = Plethora_Theme::option( 'footer-infobar-copyright', 0);
	     	$footer_infobar_credits   = Plethora_Theme::option( 'footer-infobar-credits', 0);

		  	Plethora_Theme::dev_comment('Start >>> Footer Info Bar', 'layout'); ?>
	        <div class="copyright">
	             <div class="container">

	                  <div class="row">
	                       <div class="col-sm-4 col-md-4 infobar_copyright">
	        <?php echo $footer_infobar_copyright; ?>
	                       </div>
	                       <div class="col-sm-4 col-md-4"></div>
	                       <div class="text-right col-sm-4 col-md-4 infobar_credits">
	        <?php echo $footer_infobar_credits; ?>
	                       </div>
	                  </div>
	             </div>
	        </div>
	    	<?php 
			Plethora_Theme::dev_comment('End <<< Footer Info Bar', 'layout');
		}
		?>
		</footer>
<?php Plethora_Theme::dev_comment('End <<< Footer section', 'layout'); ?>
	</div>
<?php Plethora_Theme::dev_comment('End <<< Main Wrapper', 'layout'); ?>
</div>
<?php Plethora_Theme::dev_comment('End <<< Overflow Wrapper', 'layout'); ?>
<?php
wp_footer();
echo Plethora_Theme::analytics( 'footer' ) // Analytics code ?>
</body>
</html><?php Plethora_Theme::dev_comment('End <<< '. THEME_PARTIALS_DIR . '/'. basename( __FILE__ ), 'templateparts');?>