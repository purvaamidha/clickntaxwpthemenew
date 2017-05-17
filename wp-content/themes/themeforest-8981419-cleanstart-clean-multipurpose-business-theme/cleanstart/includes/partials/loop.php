<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M			      (c) 2014-2015

Layout page: Main Loop

*/
Plethora_Theme::dev_comment('Start >>> Main Loop Template Part Loaded: '. THEME_PARTIALS_DIR . '/'. basename( __FILE__ ), 'templateparts');
	if ( have_posts() ) { 
		$count = 0;

		wp_link_pages(array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'cleanstart' ) . '</span>',
			'after'       => '</div><br>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
		));

		Plethora_Theme::dev_comment('Start >>> Main Post(s) Loop', 'layout');
		while ( have_posts() ) : the_post(); 

			$post_format = get_post_format();
			get_template_part('includes/partials/content', $post_format );

		endwhile; 
		Plethora_Theme::dev_comment('End <<< Main Post(s) Loop', 'layout');

	} else {

			Plethora_Theme::dev_comment('Start >>> Main Post(s) Loop ( no posts found though! )', 'layout');
			$post_type = get_post_type();
			get_template_part('includes/partials/content', 'noposts' );
			Plethora_Theme::dev_comment('End <<<  Main Post(s) Loop', 'layout');

	};

	?>
<?php Plethora_Theme::dev_comment('Start >>> Posts Pagination', 'layout'); ?>
<?php
         $html = '';
         $pages = '';
         $range = 5;
         $showitems = ($range * 2)+1;  
         global $paged;
         if(empty($paged)) $paged = 1;

         if($pages == '')
         {
             global $wp_query;
             $pages = $wp_query->max_num_pages;
             if(!$pages)
             {
                 $pages = 1;
             }
         }   

        if ( $pages != 1 ) {

            $html .= '<div class="pagination_wrapper">';
            $html .= '  <ul class="pagination pagination-centered">';
            $html .= '    <li>'. get_previous_posts_link( __('Prev', 'cleanstart') ).'</li>';
            if ( $paged > 2 && $paged > $range+1 && $showitems < $pages ) { 

              $html .= '    <li><a href="'.get_pagenum_link(1).'">&laquo;</a></li>'; 

            }
            if ( $paged > 1 && $showitems < $pages ) { 

              $html .= '    <li><a href="'.get_pagenum_link($paged - 1).'">&lsaquo;</a></li>'; 

            }
            for ( $i=1; $i <= $pages; $i++ ) { 

              if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {

              $class = ( $paged == $i ) ? $class = ' class="active"': $class = '';
              $html .= '    <li'.$class.'><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
              
              }
            }
            if ($paged < $pages && $showitems < $pages) {

              $html .= '    <li><a href="' .get_pagenum_link($paged + 1). '">&rsaquo;</a></li>';  

            }
            if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) {

              $html .= '    <li><a href="' .get_pagenum_link($pages).'">&raquo;</a></li>';

            }
            
            $html .= '    <li>'. get_next_posts_link( __('Next', 'cleanstart') ).'</li>';
            $html .= '  </ul>';
            $html .= '</div>';
        
        }

        echo $html;
?>
<?php Plethora_Theme::dev_comment('End <<< Posts Pagination', 'layout'); ?>
<?php Plethora_Theme::dev_comment('End <<< '. THEME_PARTIALS_DIR . '/'. basename( __FILE__ ), 'templateparts'); ?>