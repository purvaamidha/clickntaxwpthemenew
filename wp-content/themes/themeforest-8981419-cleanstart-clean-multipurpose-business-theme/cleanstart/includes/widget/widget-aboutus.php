<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M 				   (c) 2013

File Description: Twitter Feed Widget Class

*/

if ( ! defined( 'ABSPATH' ) ) exit; // NO DIRECT ACCESS 


if ( class_exists('Plethora_Widget') && !class_exists('Plethora_Widget_AboutUs') ) {
 
	/**
	 * @package Plethora Base
	 * DEBUG: PHP 5.3+ Only
	 */
	add_action( 'widgets_init', create_function( '','return register_widget("Plethora_Widget_AboutUs");' ) );

	class Plethora_Widget_AboutUs extends Plethora_Widget  {

        public $widget_class = 'Plethora_Widget_AboutUs'; 

    	function __construct() {

			$widget_ops = array(

				'classname' => 'aboutus',
				'description' => 'About Us Widget'

			);

			$control_ops = array( 'id_base' => 'aboutus-widget' );
			parent::__construct( 
				'aboutus-widget',
				'> PL | About Us',
				$widget_ops,
				$control_ops

			);

		}


		function widget( $args, $instance ) {

			extract($args);

			$title 		 = apply_filters('widget_title', $instance['title'] );
			$description = ( '' !== trim($instance['description'] )) ? '<p>' . $instance['description'] . '</p>' : false;
			$telephone   = ( '' !== trim($instance['telephone'] )) ? '<p><i class="fa fa-phone"></i> ' . $instance['telephone'] . '</p>' : false;
			$email   	 = ( '' !== trim($instance['email'] )) ? '<p><i class="fa fa-envelope"></i><a href="mailto:'.$instance['email'].'">'.$instance['email'].'</a></p> ' : false;
			$skype 		 = ( '' !== trim($instance['skype'] )) ? '<a href="callto:' . esc_attr( $instance['skype'] ) . '"><i class="fa fa-skype"></i></a> ' : false;
			$facebook 	 = ( '' !== trim($instance['facebook'] )) ? '<a href="' . esc_url( $instance['facebook'] ) . '" target="_blank"><i class="fa fa-facebook-square"></i></a> ' : false;
			$twitter 	 = ( '' !== trim($instance['twitter'] )) ? '<a href="' . esc_url( $instance['twitter'] ) . '" target="_blank"><i class="fa fa-twitter"></i></a> ' : false;
			$youtube 	 = ( '' !== trim($instance['youtube'] )) ? '<a href="' . esc_url( $instance['youtube'] ) . '" target="_blank"><i class="fa fa-youtube"></i></a> ' : false;

			$linkedin 	 = ( '' !== trim($instance['linkedin'] )) ? '<a href="' . esc_url( $instance['linkedin'] ) . '" target="_blank"><i class="fa fa-linkedin"></i></a> ' : false;
			$pinterest 	 = ( '' !== trim($instance['pinterest'] )) ? '<a href="' . esc_url( $instance['pinterest'] ) . '" target="_blank"><i class="fa fa-pinterest"></i></a> ' : false;
			$googleplus	 = ( '' !== trim($instance['googleplus'] )) ? '<a href="' . esc_url( $instance['googleplus'] ) . '" target="_blank"><i class="fa fa-google-plus"></i></a> ' : false;
			$tumblr 	 = ( '' !== trim($instance['tumblr'] )) ? '<a href="' . esc_url( $instance['tumblr'] ) . '" target="_blank"><i class="fa fa-tumblr"></i></a> ' : false;
			$instagram 	 = ( '' !== trim($instance['instagram'] )) ? '<a href="' . esc_url( $instance['instagram'] ) . '" target="_blank"><i class="fa fa-instagram"></i></a> ' : false;
			$flickr 	 = ( '' !== trim($instance['flickr'] )) ? '<a href="' . esc_url( $instance['flickr'] ) . '" target="_blank"><i class="fa fa-flickr"></i></a> ' : false;

			echo $before_widget;

			echo '<div class="pl_about_us_widget">';
			if ( $title ) {	    echo $before_title . $title . $after_title; 		}
			if ( $description ) echo $description; 
			if ( $telephone )   echo $telephone;
			if ( $email )  	    echo $email;
			echo '	<div class="aboutus_social">';
			echo '		<div class="social_wrapper">';
			if ( $facebook )  	echo $facebook;
			if ( $twitter )  	echo $twitter;
			if ( $skype )  	    echo $skype;
			if ( $youtube )  	echo $youtube;
			if ( $linkedin )  	echo $linkedin;
			if ( $pinterest )  	echo $pinterest;
			if ( $googleplus )	echo $googleplus;
			if ( $tumblr )  	echo $tumblr;
			if ( $instagram )  	echo $instagram;
			if ( $flickr )  	echo $flickr;
			echo '		</div>';
			echo '	</div>';
			echo '</div>';

			echo $after_widget;

		}

		function update( $new_instance, $old_instance ) {

			$instance = $old_instance;
			$instance['title'] 		 = strip_tags($new_instance['title']);
			$instance['description'] = $new_instance['description'];
			$instance['telephone']   = $new_instance['telephone'];
			$instance['email']   	 = $new_instance['email'];
			$instance['skype']   	 = $new_instance['skype'];
			$instance['facebook']    = $new_instance['facebook'];
			$instance['twitter']   	 = $new_instance['twitter'];
			$instance['youtube']   	 = $new_instance['youtube'];
			$instance['linkedin']	 = $new_instance['linkedin'];
			$instance['pinterest']	 = $new_instance['pinterest'];
			$instance['googleplus']	 = $new_instance['googleplus'];
			$instance['tumblr']   	 = $new_instance['tumblr'];
			$instance['instagram']	 = $new_instance['instagram'];
			$instance['flickr']   	 = $new_instance['flickr'];
		
			return $instance;
		}

		function form( $instance ) {

			$defaults = array(
				'title' 	  => 'About us',
				'description' => 'PLETHORA THEMES Web-Development Company<br/>795 Folsom Ave, Suite 600, San Francisco, CA 94107',
				'telephone'   => '(+30) 210 1234567',
				'email'		  => 'info@plethorathemes.com',
				'url'		  => 'http://plethorathemes.com',
				'skype'		  => '',
				'youtube'	  => '',
				'facebook'	  => '',
				'twitter'	  => '',
				'linkedin'	  => '',
				'pinterest'	  => '',
				'googleplus'  => '',
				'tumblr'	  => '',
				'instagram'	  => '',
				'flickr'	  => '',
			);

			$instance = wp_parse_args((array) $instance, $defaults); ?>
			
			<p>
				<div><label for="<?php echo $this->get_field_id('title'); ?>"><?php echo __('Title', 'cleanstart'); ?></label></div>
				<div><input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" /></div>
			</p>

			<p>
				<div><label for="<?php echo $this->get_field_id('description'); ?>"><?php echo __('Description', 'cleanstart'); ?></label></div>
				<div><textarea class="widefat" id="<?php echo $this->get_field_id('description'); ?>" name="<?php echo $this->get_field_name('description'); ?>"><?php echo wp_kses_post( $instance['description'] ); ?></textarea></div>
			</p>

			<p>
				<div><label for="<?php echo $this->get_field_id('telephone'); ?>"><?php echo __('Telephone', 'cleanstart'); ?></label></div>
				<div><input type="text" class="widefat" id="<?php echo $this->get_field_id('telephone'); ?>" name="<?php echo $this->get_field_name('telephone'); ?>" value="<?php echo esc_attr( $instance['telephone'] ); ?>" /></div>
			</p>

			<p>
				<div><label for="<?php echo $this->get_field_id('email'); ?>"><?php echo __('Email', 'cleanstart'); ?></label></div>
				<div><input type="text" class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" value="<?php echo esc_attr( $instance['email'] ); ?>" /></div>
			</p>

			<p>
				<div><label for="<?php echo $this->get_field_id('skype'); ?>"><?php echo __('Skype', 'cleanstart'); ?></label></div>
				<div><input type="text" class="widefat" id="<?php echo $this->get_field_id('skype'); ?>" name="<?php echo $this->get_field_name('skype'); ?>" value="<?php echo esc_attr( $instance['skype'] ); ?>" /></div>
			</p>

			<p>
				<div><label for="<?php echo $this->get_field_id('facebook'); ?>"><?php echo __('Facebook', 'cleanstart'); ?></label></div>
				<div><input type="text" class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" value="<?php echo esc_attr( $instance['facebook'] ); ?>" /></div>
			</p>

			<p>
				<div><label for="<?php echo $this->get_field_id('twitter'); ?>"><?php echo __('Twitter', 'cleanstart'); ?></label></div>
				<div><input type="text" class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" value="<?php echo esc_attr( $instance['twitter'] ); ?>" /></div>
			</p>

			<p>
				<div><label for="<?php echo $this->get_field_id('youtube'); ?>"><?php echo __('YouTube', 'cleanstart'); ?></label></div>
				<div><input type="text" class="widefat" id="<?php echo $this->get_field_id('youtube'); ?>" name="<?php echo $this->get_field_name('youtube'); ?>" value="<?php echo esc_attr( $instance['youtube'] ); ?>" /></div>
			</p>

			<p>
				<div><label for="<?php echo $this->get_field_id('linkedin'); ?>"><?php echo __('LinkedIn', 'cleanstart'); ?></label></div>
				<div><input type="text" class="widefat" id="<?php echo $this->get_field_id('linkedin'); ?>" name="<?php echo $this->get_field_name('linkedin'); ?>" value="<?php echo esc_attr( $instance['linkedin'] ); ?>" /></div>
			</p>

			<p>
				<div><label for="<?php echo $this->get_field_id('pinterest'); ?>"><?php echo __('Pinterest', 'cleanstart'); ?></label></div>
				<div><input type="text" class="widefat" id="<?php echo $this->get_field_id('pinterest'); ?>" name="<?php echo $this->get_field_name('pinterest'); ?>" value="<?php echo esc_attr( $instance['pinterest'] ); ?>" /></div>
			</p>

			<p>
				<div><label for="<?php echo $this->get_field_id('googleplus'); ?>"><?php echo __('Google+', 'cleanstart'); ?></label></div>
				<div><input type="text" class="widefat" id="<?php echo $this->get_field_id('googleplus'); ?>" name="<?php echo $this->get_field_name('googleplus'); ?>" value="<?php echo esc_attr( $instance['googleplus'] ); ?>" /></div>
			</p>

			<p>
				<div><label for="<?php echo $this->get_field_id('tumblr'); ?>"><?php echo __('Tumblr', 'cleanstart'); ?></label></div>
				<div><input type="text" class="widefat" id="<?php echo $this->get_field_id('tumblr'); ?>" name="<?php echo $this->get_field_name('tumblr'); ?>" value="<?php echo esc_attr( $instance['tumblr'] ); ?>" /></div>
			</p>

			<p>
				<div><label for="<?php echo $this->get_field_id('instagram'); ?>"><?php echo __('Instagram', 'cleanstart'); ?></label></div>
				<div><input type="text" class="widefat" id="<?php echo $this->get_field_id('instagram'); ?>" name="<?php echo $this->get_field_name('instagram'); ?>" value="<?php echo esc_attr( $instance['instagram'] ); ?>" /></div>
			</p>

			<p>
				<div><label for="<?php echo $this->get_field_id('flickr'); ?>"><?php echo __('Flickr', 'cleanstart'); ?></label></div>
				<div><input type="text" class="widefat" id="<?php echo $this->get_field_id('flickr'); ?>" name="<?php echo $this->get_field_name('flickr'); ?>" value="<?php echo esc_attr( $instance['flickr'] ); ?>" /></div>
			</p>

		<?php
		}

 

       /** 
       * Returns feature information for several uses by Plethora Core (theme options etc.)
       *
       * @return array
       * @since 1.0
       *
       */
       public static function get_feature_options() {

          $feature_options = array ( 
              'switchable' => true,
              'options_title' => 'About Us widget',
              'options_subtitle' => 'Activate/deactivate "About Us" widget',
              'options_desc' => 'On deactivation, all settings related to this feature will be removed. However, they will not be deleted permanently.',
              'version' => '1.0',
            );
          
          return $feature_options;
       }

	}
	
 }