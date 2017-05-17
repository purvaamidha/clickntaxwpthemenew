<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M 				   (c) 2013

File Description: Flickr widdget class

*/

if ( ! defined( 'ABSPATH' ) ) exit; // NO DIRECT ACCESS 


if ( class_exists('Plethora_Widget') && !class_exists('Plethora_Widget_Flickr') ) {
 
	/**
	 * @package Plethora Base
	 */
	add_action( 'widgets_init', create_function( '','return register_widget("Plethora_Widget_Flickr");' ) );

	class Plethora_Widget_Flickr extends Plethora_Widget  {

        public $widget_class = 'Plethora_Widget_Flickr'; 
 
    	function __construct() {

			$widget_ops = array('classname' => 'flickr', 'description' => 'The most recent photos from flickr.');

			$control_ops = array('id_base' => 'flickr-widget');

			parent::__construct('flickr-widget', '> PL | Flickr Feed', $widget_ops, $control_ops);

		}


		function widget($args, $instance) {

			extract($args);

			$title = apply_filters('widget_title', $instance['title']);
			$screen_name = $instance['screen_name'];
			$photos_to_display = $instance['photos_to_display'];
			//die($photos_to_display);
			if ( is_numeric($photos_to_display) && !empty($photos_to_display)) { 

				$photos_to_display = $photos_to_display - 1;
			} else { 

				$photos_to_display = 7;
			}

			echo $before_widget . '<div id="latest-flickr-images">';

			if($title) {
				echo  $before_title.$title.$after_title;
			}

			echo '<div id="flickr-widget" class="'. esc_attr( $args['widget_id'] ) .'"></div></div>';

			$http_type = is_ssl() ? 'https' : 'http';	// Make a request over https if an ssl is used
			
			if($screen_name) { ?>
				<script type="text/javascript">
				//Flickr Widget in Sidebar			
				jQuery(document).ready(function($){	 			   
					// Our very special jQuery JSON fucntion call to Flickr, gets details of the most recent images			   
					$.getJSON("<?php echo $http_type; ?>://api.flickr.com/services/feeds/photos_public.gne?id=<?php echo $screen_name; ?>&lang=en-us&format=json&jsoncallback=?", function(data){  //YOUR IDGETTR GOES HERE

						var htmlString = "<ul>";					
						$.each(data.items, function(i,item){																														   

						if(i<=<?php echo $photos_to_display; ?>) {
													
								// I only want the ickle square thumbnails
								var sourceSquare = (item.media.m).replace("_m.jpg", "_s.jpg");		
								
								// Here's where we piece together the HTML
								htmlString += '<li><a href="' + item.link + '" target="_blank">';
								htmlString += '<img src="' + sourceSquare + '" alt="' + item.title + '" title="' + item.title + '"/>';
								htmlString += '</a></li>';
							}
						});		
						
					// Pop our HTML in the #images DIV	
					$('.<?php echo $args['widget_id']; ?>').html(htmlString + "</ul>");
					
					// Close down the JSON function call
					});
					
				// The end of our jQuery function	
				});
				</script>
			<?php }
			
			echo $after_widget;

		}

		function update($new_instance, $old_instance) {
			$instance = $old_instance;

			$instance['title'] = strip_tags($new_instance['title']);
			$instance['screen_name'] = $new_instance['screen_name'];
			$instance['photos_to_display'] = $new_instance['photos_to_display'];
			
			return $instance;
		}

		function form($instance) {
			$defaults = array('title' => 'Photos from Flickr', 'screen_name' => '', 'photos_to_display' => 7);
			$instance = wp_parse_args((array) $instance, $defaults); ?>
			
			<p>
				<div><label for="<?php echo $this->get_field_id('title'); ?>">Title</label></div>
				<div><input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" /></div>
			</p>

			<p>
				<div><label for="<?php echo $this->get_field_id('photos_to_display'); ?>">How many photos to display (default:8)</label></div>
				<div><input class="widefat" type="text" id="<?php echo $this->get_field_id('photos_to_display'); ?>" name="<?php echo $this->get_field_name('photos_to_display'); ?>" value="<?php echo $instance['photos_to_display']; ?>" /></div>
			</p>
			
			<p>
				<div><label for="<?php echo $this->get_field_id('screen_name'); ?>">Flickr ID ( Find with <a href='http://idgettr.com' target='_blank' style='text-decoration:none;color:#0063DC;font-weight:bold;'>idGett<span style='color:#FF0084;'>r</span></a> )</label></div>
				<div><input class="widefat" type="text" id="<?php echo $this->get_field_id('screen_name'); ?>" name="<?php echo $this->get_field_name('screen_name'); ?>" value="<?php echo $instance['screen_name']; ?>" /></div>
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
              'options_title' => 'Flickr feed widget',
              'options_subtitle' => 'Activate/deactivate flickr feed widget',
              'options_desc' => 'On deactivation, all settings related to this feature will be removed. However, they will not be deleted permanently.',
            );
          
          return $feature_options;
       }


	}
	
 }