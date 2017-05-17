<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M            (c) 2014

File Description: Main navigation

*/
Plethora_Theme::dev_comment('Start >>> Navigation Template Part Loaded: '. THEME_PARTIALS_DIR . '/'. basename( __FILE__ ), 'templateparts');
$postid = get_post() ? get_the_ID() : NULL;
$header_logo_type     = Plethora_Theme::option( PLETHORA_META_PREFIX .'header-logo-type', '2');         
$header_logo_img      = Plethora_Theme::option( 'header-logo-img');         
$header_logo_title    = Plethora_Theme::option( 'header-logo-title'); ?>
<?php Plethora_Theme::dev_comment('Start >>> Navigation Container', 'layout'); ?>
    <div class="container">
<?php Plethora_Theme::dev_comment('Start >>> Logo Section', 'layout'); ?>
       <div class="logo">
         <a class="brand" href="<?php echo esc_url( home_url() ); ?>">
           <?php if (( $header_logo_type == '1' || $header_logo_type == '2' || $header_logo_type == '3' ) && ( !empty( $header_logo_img['url'] ))) { ?>
           <img src="<?php echo esc_url( $header_logo_img['url'] ); ?>" alt="<?php echo esc_attr( $header_logo_title ); ?>">
           <?php } ?>
           <?php if (( $header_logo_type == '2' || $header_logo_type == '5' ) && ( !empty( $header_logo_title ) )) { ?>
           <span class="logo_title"><?php echo $header_logo_title; ?></span>
           <?php } ?>
         </a>
       </div>
<?php Plethora_Theme::dev_comment('End <<< Logo Section', 'layout'); ?>
<?php Plethora_Theme::dev_comment('Start >>> Main Menu Section', 'layout'); ?>
       <!-- <div id="mainmenu" class="menu_container"> -->
       <nav id="mainmenu" class="menu_container pull-right">
          <label class="mobile_collapser"><?php _e('MENU', 'cleanstart') ?></label> <!-- Mobile menu title -->
         
                <?php 
                  wp_nav_menu( array(
                    'container'       => false, 
                    'menu_class'      => '', 
                    'depth'           => 6,
                    'theme_location' => 'primary',
                    'walker'          => ( class_exists( 'Plethora_Module_Navwalker' )) ? new Plethora_Module_Navwalker() : ''
                  ));
                ?>
       <!-- </div> -->
       </nav>

<?php Plethora_Theme::dev_comment('End <<< Main Menu Section', 'layout'); ?>
<?php Plethora_Theme::dev_comment('Start >>> Navigation Sidecorners', 'layout'); ?>
      <div class="triangle-up-left"></div>
      <div class="triangle-up-right"></div>          
<?php Plethora_Theme::dev_comment('End <<< Navigation Sidecorners', 'layout'); ?>
   </div>
<?php Plethora_Theme::dev_comment('End <<< Navigation Container', 'layout'); ?>
<?php Plethora_Theme::dev_comment('End <<< '. THEME_PARTIALS_DIR . '/'. basename( __FILE__ ), 'templateparts');?>