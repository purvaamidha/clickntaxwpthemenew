<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M                       (c) 2014

File Description: Comments Display Template Part 

*/
Plethora_Theme::dev_comment('Start >>> Comments template part loaded: '. THEME_PARTIALS_DIR . '/'. basename( __FILE__ ), 'templateparts');

if ( post_password_required() || !comments_open()  ) { return; } ?>
<?php Plethora_Theme::dev_comment('Start >>> Comments section', 'layout'); ?>
<div id="post_comments">

  <?php if ( have_comments() ) : ?>

  <h4 class="comments-title">
    <?php
      printf( _n( 'One comment', '%1$s comments', get_comments_number(), 'cleanstart' ), number_format_i18n( get_comments_number() ), get_the_title() );
    ?>
  </h4>

<div class="comment">
  <ul class="row">
    <?php
      wp_list_comments( array(
        'style'      => 'ul',
        'avatar_size'=> 90,
      ) );
    ?>
  </ul><!-- .comment-list -->
</div>
  <?php 
  $page_comments = class_exists('Plethora_CMS') ? Plethora_CMS::get_option('page_comments') : get_option('page_comments');
  if ( get_comment_pages_count() > 1 && $page_comments ) : 
  ?>
  <nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
    <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'cleanstart' ) ); ?></div>
    <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'cleanstart' ) ); ?></div>
  </nav><!-- #comment-nav-below -->
  <?php endif; // Check for comment navigation. ?>

  <?php if ( ! comments_open() ) : ?>
  <p class="no-comments"><?php _e( 'Comments are closed.', 'cleanstart' ); ?></p>
  <?php endif; ?>

  <?php endif; // have_comments() ?>

  <?php 
  $new_comment_args = array( 
    'fields'               => apply_filters( 'comment_form_default_fields', array('<div class="row"><div class="col-sm-6 col-md-4"><input class="form-control" placeholder="'. __('Your name', 'cleanstart') .'" type="text" id="author" name="author" type="text" value="" aria-required="true"></div>', '<div class="col-sm-6 col-md-4"><input class="form-control" placeholder="'. __('Your email', 'cleanstart') .'" type="text" id="email" name="email" type="text" value="" aria-required="true"></div></div>')),
    'comment_field'        => '<div class="row"><div class="col-sm-12 col-md-8"><br/><textarea rows="7" placeholder="'. __( 'Your comment', 'cleanstart' ) .'" id="comment" name="comment" class="form-control" aria-required="true"></textarea></div></div>',
    'comment_notes_before' => '',
    'comment_notes_after'  => '',
    'logged_in_as'         => '',
    'title_reply'          => __( 'Add comment', 'cleanstart' ),
    'title_reply_to'       => __( 'Reply to %s', 'cleanstart' ),
    'cancel_reply_link'    => __( 'Cancel', 'cleanstart' ),
    'label_submit'         => __( 'Reply', 'cleanstart' ),
  );
  ?>
  <div class="new_comment">
    <?php comment_form( $new_comment_args ); ?>
  </div>

</div>
<?php Plethora_Theme::dev_comment('End <<< Comments section', 'layout'); ?>
<?php Plethora_Theme::dev_comment('End <<< '. THEME_PARTIALS_DIR . '/'. basename( __FILE__ ), 'templateparts'); ?>