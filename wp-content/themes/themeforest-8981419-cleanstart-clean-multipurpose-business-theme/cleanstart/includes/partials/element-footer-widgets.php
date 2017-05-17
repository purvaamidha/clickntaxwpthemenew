<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M            (c) 2014

File Description: Footer Widgetized Areas template 

*/
Plethora_Theme::dev_comment('Start >>> Footer Widgets Area Template: '. THEME_PARTIALS_DIR . '/'. basename( __FILE__ ), 'templateparts');
Plethora_Theme::dev_comment('Start >>> Footer Widget Area 1', 'layout');
?>
<div class="col-sm-4 col-md-4'"><?php dynamic_sidebar('sidebar-footer-one'); ?></div>
<?php
Plethora_Theme::dev_comment('End <<< Footer Widget Area 1', 'layout');

Plethora_Theme::dev_comment('Start >>> Footer Widget Area 2', 'layout');
?>
<div class="col-sm-4 col-md-4'"><?php dynamic_sidebar('sidebar-footer-two'); ?></div>
<?php
Plethora_Theme::dev_comment('End <<< Footer Widget Area 2', 'layout');
Plethora_Theme::dev_comment('Start >>> Footer Widget Area 3', 'layout');
?>
<div class="col-sm-4 col-md-4'"><?php dynamic_sidebar('sidebar-footer-three'); ?></div>
<?php
Plethora_Theme::dev_comment('End <<< Footer Widget Area 3', 'layout');
Plethora_Theme::dev_comment('End <<< Footer Widgetized Areas Template'. THEME_PARTIALS_DIR . '/'. basename( __FILE__ ), 'templateparts');?>