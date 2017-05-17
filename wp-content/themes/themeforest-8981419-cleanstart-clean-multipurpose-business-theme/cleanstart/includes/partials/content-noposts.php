<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M                       (c) 2014

File Description: No post Template Part 

*/
Plethora_Theme::dev_comment('Start >>> No post template part loaded: '. THEME_PARTIALS_DIR . '/'. basename( __FILE__ ), 'templateparts');
$blog_noposts_title       = Plethora_Theme::option( 'blog-noposts-title');
$blog_noposts_description = Plethora_Theme::option( 'blog-noposts-description');
?>
     <article id="post-nopost" <?php post_class('post'); ?>>
          <div class="post_header">
               <h2 class="post_title">
                   <?php echo $blog_noposts_title ; ?>
               </h2>
          </div>
          <div class="post_content">
               <p><?php echo $blog_noposts_description ; ?></p>
          </div>
     </article>
<?php Plethora_Theme::dev_comment('End <<< '. THEME_PARTIALS_DIR . '/'. basename( __FILE__ ), 'templateparts'); ?>