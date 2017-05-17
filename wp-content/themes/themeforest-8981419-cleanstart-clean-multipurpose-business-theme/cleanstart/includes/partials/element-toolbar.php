<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M            (c) 2014

File Description: Top Toolbar

*/
Plethora_Theme::dev_comment('Start >>> Top Toolbar Template Part Loaded: '. THEME_PARTIALS_DIR . '/'. basename( __FILE__ ), 'templateparts');
$header_toolbar_layout        = Plethora_Theme::option( PLETHORA_META_PREFIX .'header-toolbar-layout', 1); 
$header_toolbar_html          = Plethora_Theme::option( PLETHORA_META_PREFIX .'header-toolbar-html');
$header_toolbar_langswitcher  = function_exists('icl_get_languages') ? Plethora_Theme::option( PLETHORA_META_PREFIX .'header-toolbar-langswitcher', 0) : 0;

// Language bar setup


Plethora_Theme::dev_comment('Start >>> Top Toolbar Section', 'layout'); ?>
<?php if ( $header_toolbar_layout == 1 ) { 
?>
<section class="top_bar">
     <div class="container">
          <div class="row">
               <div class="tob_bar_left_col hidden-xs col-sm-6 col-md-6">
                    <?php 
                      wp_nav_menu( array(
                        'container'       => false, 
                        'menu_class'      => 'top_menu', 
                        'depth'           => 6,
                        'theme_location' => 'toolbar',
                        'walker'          => ( class_exists( 'Plethora_Module_Navwalker' )) ? new Plethora_Module_Navwalker() : '',
                      ));
                    ?>
               </div>
               <div class="tob_bar_right_col col-xs-12 col-sm-6 col-md-6">
                    <p><?php echo $header_toolbar_html; ?></p>
                    <?php if ( $header_toolbar_langswitcher == 1 ) { do_action('icl_language_selector'); } ?>
               </div>
          </div>
     </div>
</section>

<?php } elseif ( $header_toolbar_layout == 2 ) {  ?>

<section class="top_bar">
     <div class="container">
          <div class="row">
               <div class="tob_bar_left_col col-xs-12 col-sm-6 col-md-6">
                    <p><?php echo $header_toolbar_html; ?></p>
                    <?php if ( $header_toolbar_langswitcher == 1 ) { do_action('icl_language_selector'); } ?>
               </div>

               <div class="tob_bar_right_col hidden-xs col-sm-6 col-md-6">
                    <?php 
                      wp_nav_menu( array(
                        'container'       => false, 
                        'menu_class'      => 'top_menu pull-right', 
                        'depth'           => 6,
                        'theme_location' => 'toolbar',
                        'walker'          => ( class_exists( 'Plethora_Module_Navwalker' )) ? new Plethora_Module_Navwalker() : '',
                      ));
                    ?>
               </div>
          </div>
     </div>
</section>

<?php } elseif ( $header_toolbar_layout == 3 ) {  ?>

<section class="top_bar">
     <div class="container">
          <div class="row">
               <div class="tob_bar_right_col col-xs-12 col-sm-12 col-md-12 align_left">
                    <p><?php echo $header_toolbar_html; ?></p>
                    <?php if ( $header_toolbar_langswitcher == 1 ) { do_action('icl_language_selector'); } ?>
               </div>
          </div>
     </div>
</section>
<?php } ?>

<?php Plethora_Theme::dev_comment('End <<< Top Toolbar Section', 'layout'); ?>
<?php Plethora_Theme::dev_comment('End <<< '. THEME_PARTIALS_DIR . '/'. basename( __FILE__ ), 'templateparts');?>