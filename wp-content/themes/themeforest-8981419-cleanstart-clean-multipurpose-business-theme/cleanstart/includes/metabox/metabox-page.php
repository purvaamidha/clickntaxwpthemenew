<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M                    (c) 2014

File Description: Metabox class for slider CPT

*/

if ( ! defined( 'ABSPATH' ) ) exit; // NO DIRECT ACCESS 

if ( class_exists('Plethora_Metabox') && !class_exists('Plethora_Metabox_Page') ): 

	/**
	 * @package Plethora Framework
	 */

	class Plethora_Metabox_Page {

		public static function metabox(){

	    $sections = array();
    	$sections_content = array(
			'title'      => __('Content Display', 'cleanstart'),
			'desc'       =>  '<a href="'. admin_url('admin.php?page=cleanstart_options&tab=6') . '" target="_blank">'. __('Click here', 'cleanstart') . '</a>'. __(' to edit default page options.', 'cleanstart'),
			'icon_class' => 'icon-large',
			'icon'       => 'el-icon-info-sign',
			'fields'     => array(

				// ok!
				array(
					'id'    => PLETHORA_META_PREFIX .'page-title-oncontent',
					'type'  => 'button_set', 
					'title' => __('Show Title On Content', 'cleanstart'),
					'hint'  => array(
					        'title'   => __('Show Title On Content', 'cleanstart'),
					        'content' => __('Depending on your head panel settings, you might need to display title on content ', 'cleanstart')
					),					
					// 'desc' => __('Depending on your head panel settings, you might need to display title on content ', 'cleanstart'),
					'options' => array(
							'display' => 'Display',
							'hide'    => 'Hide',
							),
					),	

	        )
	    );

	    $sections_headpanel = array(
			'title'      => __('Head Panel', 'cleanstart'),
			'icon_class' => 'icon-large',
			'desc'       => ' <a href="'. admin_url('admin.php?page=cleanstart_options&tab=3') . '" target="_blank">'. __('Click here', 'cleanstart') . '</a>'. __(' to edit default head panel options.', 'cleanstart'),
			'icon'       => 'el-icon-website',
			'fields'     => array(

				array(
					'id'    => PLETHORA_META_PREFIX .'header-title-type-page',
					'type'  => 'button_set', 
					'title' => __('Title / Subtitle Behaviour', 'cleanstart'),
					'hint'  => array(
						'title'   => __('NOTICE', 'cleanstart'),
						'content' => __('If a slider is selected as a background, title/subtitle are set on each slide', 'cleanstart'),
						),
					// 'description' => __('Notice: if a slider is selected as a background, title/subtitle are set on each slide', 'cleanstart'),
					'options' => array(
							'posttitle'   => 'Page Title / Custom Subtitle',
							'customtitle' => 'Custom Title / Subtitle',
							'notitle'     => 'No Title / Subtitle'
						),
					),

				array(
					'id'       => PLETHORA_META_PREFIX .'header-customtitle-page',
					'type'     => 'text', 
					'required' => array( PLETHORA_META_PREFIX .'header-title-type-page','=', array('customtitle')),
					'title'    => __('Title Text // Custom', 'cleanstart'),
					),

				array(
					'id'=> PLETHORA_META_PREFIX .'header-customsubtitle-page',
					'required' => array( PLETHORA_META_PREFIX .'header-title-type-page','=', array('posttitle','customtitle' )),
					'type' => 'text', 
					'title' => __('Subtitle Text // Custom', 'cleanstart'),
					),

				array(
					'id'             => PLETHORA_META_PREFIX .'header-align',
					'type'           => 'typography', 
					'title'          => __('Title/Subtitle Text Align', 'cleanstart'),
					'google'         =>false, 
					'font-family'    =>false, 
					'font-backup'    =>false, 
					'font-style'     =>false, 
					'font-weight'    =>false, 
					'font-size'      =>false, 
					'subsets'        =>false, 
					'line-height'    =>false, 
					'word-spacing'   =>false, 
					'letter-spacing' =>false, 
					'text-transform' =>false, 
					'font-backup'    =>false, 
					'preview'        =>false, 
					'color'          => false,
					'output'         => array('.hgroup_title h1', '.hgroup_subtitle p'), // An array of CSS selectors to apply this font style to dynamically
					'units'          =>'px', 
					),	

				array(
					'id'      => PLETHORA_META_PREFIX .'header-media',
					'type'    => 'button_set',
					'title'   => __('Background Type', 'cleanstart'), 
					'options' => self::option_revslider_headermedia_buttons(),
					),

				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-dimensions',
					'type'     => 'dimensions',
					'required' => array( PLETHORA_META_PREFIX .'header-media','equals', array('featuredimage', 'otherimage', 'localvideo', 'googlemap')),						
					'width'    => false,
					'title'    => __('Panel Height', 'cleanstart'),
					),			
				array(
					'id'      => PLETHORA_META_PREFIX .'header-media-nomediadimensions',
					'type'    => 'dimensions',
					'required' => array( PLETHORA_META_PREFIX .'header-media','equals', array('nomedia')),						
					'width'   => false,
					'title'   => __('Panel Height', 'cleanstart'),
					),			
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-otherimage',
					'type'     => 'media', 
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('otherimage')),
					'url'      => true,
					'title'    => __('Other Image', 'cleanstart'),
					'desc'     => __('Upload an image other than your featured image', 'cleanstart'),
					),
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-slider',
					'type'     => 'select',
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('slider')),
					'data'     => 'posts',
					'title'    => __('Select Slider', 'cleanstart'), 
					'desc'     => __('Select a slider to be displayed. You should create one first! Slider settings will be applied here too!', 'cleanstart'),
					'args'     => array(
						'posts_per_page' => -1,
						'post_type'      => 'slider',
						'suppress_filters' => false)				
					),
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-revslider',
					'type'     => 'select',
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('revslider')),
					'title'    => __('Select Revolution Slider', 'cleanstart'), 
					'desc'     => __('Select a Revolution slider to be displayed ( must have Revolution Slider plugin installed, not included with theme )', 'cleanstart'),
					'options'  => method_exists('Plethora_CMS', 'get_revsliders') ? Plethora_CMS::get_revsliders() :  array() ,
					),
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-localvideo',
					'type'     => 'media', 
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('localvideo')),
					'url'      => true,
					'preview'  => true,
					'mode'     => false,
					'readonly' => false,
					'title'    => __('Local video', 'cleanstart'),
					'desc'     => __('Upload a video file ( supported formats: FLV | MP4 | WEBM )', 'cleanstart'),
					),
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-localvideo-poster',
					'type'     => 'media', 
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('localvideo')),
					'url'      => true,
					'readonly' => false,
					'title'    => __('Video cover image', 'cleanstart'),
					'desc'     => __('Set a cover image for this video. It MUST have a 16x9 proportion to display properly ', 'cleanstart'),
					),
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-localvideo-controls',
					'type'     => 'button_set',
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('localvideo')),
					'title'    => __('Video controls', 'cleanstart'),
					'desc'     => __('Click \'Off\' if you want to hide video controls', 'cleanstart'),
					'options'  => array( 'true' => 'On', 'false' => 'Off' ),
					'default'  => 'true',
					),
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-localvideo-sound',
					'type'     => 'button_set',
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('localvideo')),
					'title'    => __('Video sound', 'cleanstart'),
					'desc'     => __('Click \'Off\' if you want this video to be silent', 'cleanstart'),
					'options'  => array( 'true' => 'On', 'false' => 'Off' ),
					'default'  => 'false',
					),
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-localvideo-autoplay',
					'type'     => 'button_set',
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('localvideo')),
					'title'    => __('Video autoplay', 'cleanstart'),
					'desc'     => __('Click \'On\' if you want this video to start automatically', 'cleanstart'),
					'options'  => array( 'true' => 'On', 'false' => 'Off' ),
					'default'  => 'false',
					),
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-localvideo-loop',
					'type'     => 'button_set',
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('localvideo')),
					'title'    => __('Video loop', 'cleanstart'),
					'desc'     => __('Click \'On\' if you want this video to loop', 'cleanstart'),
					'options'  => array( 'true' => 'On', 'false' => 'Off' ),
					'default'  => 'false',
					),
				/*** GOOGLE MAPS ***/
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-map-lang',
					'type'     => 'text', 
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('googlemap')),
					'title'    => __('Map Latitude', 'cleanstart'),
					'desc'     => __('Example:', 'cleanstart') .'<strong>51.50852</strong>. Use <a href="http://www.latlong.net/" target="_blank">LatLong</a> to find easily your location coords.',
					),
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-map-long',
					'type'     => 'text', 
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('googlemap')),
					'title'    => __('Map Longtitude', 'cleanstart'),
					'desc'     => __('Example:', 'cleanstart') .'<strong>-0.1254</strong>. Use <a href="http://www.latlong.net/" target="_blank">LatLong</a> to find easily your location coords.',
					),
				/*** MAP TYPE CONTROLS ***/
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-map-type',
					'type'     => 'button_set',
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('googlemap')),
					'title'    => __('Map Type', 'cleanstart'),
					'options'  => array( 'ROADMAP' => 'ROADMAP', 'SATELLITE' => 'SATELLITE', 'TERRAIN' => 'TERRAIN', 'HYBRID' => 'HYBRID' ),
					'default'  => 'TERRAIN',
					),
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-map-type-switch',
					'type'     => 'button_set',
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('googlemap')),
					'title'    => __('Show Map Type Switcher', 'cleanstart'),
					'desc'     => __('Show Map Type Switcher', 'cleanstart'),
					'options'  => array( 'true' => 'On', 'false' => 'Off' ),
					'default'  => 'false',
					),
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-map-type-switch-style',
					'type'     => 'select',
					'required' => array( PLETHORA_META_PREFIX .'header-media-map-type-switch','=', array('true')),
					'title'    => __('Select MapType Switcher Style', 'cleanstart'), 
					'desc'     => __('Select the display style of the MapType Switcher button', 'cleanstart'),
					'options' => array( 
						'HORIZONTAL_BAR' => 'Horizontal Bar', 
						'DROPDOWN_MENU'  => 'Dropdown Menu',
						'DEFAULT'        => 'Default'
						),
					'default' => 'DROPDOWN_MENU'
					),
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-map-type-switch-position',
					'type'     => 'select',
					'required' => array( PLETHORA_META_PREFIX .'header-media-map-type-switch','=', array('true')),
					'title'    => __('Select MapType Switcher Style', 'cleanstart'), 
					'desc'     => __('Select the <a href="https://developers.google.com/maps/documentation/javascript/images/control-positions.png" target="_blank">position</a> of the MapType Switcher button.', 'cleanstart'),
					'options'  => array(
						"TOP_LEFT"      => "Top Left",
						"TOP_CENTER"    => "Top Center",
						"TOP_RIGHT"     => "Top Right",
						"LEFT_CENTER"   => "Center Left",
						"RIGHT_CENTER"  => "Center Right",
						"LEFT_BOTTOM"   => "Bottom Left",
						"BOTTOM_CENTER" => "Bottom Center",
						"BOTTOM_RIGHT"  => "Bottom Right",
						),
					'default'  => 'RIGHT_CENTER'
					),
				/*** MAP ZOOM CONTROLS ***/
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-map-zoom',
					'type'     => 'slider', 
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('googlemap')),
					'title'    => __('Map Zoom', 'cleanstart'),
					"default"  => "12",
					"min"      => "1",
					"step"     => "1",
					"max"      => "18",
					),
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-map-zoom-control',
					'type'     => 'button_set',
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('googlemap')),
					'title'    => __('Show Map Zoom Controls', 'cleanstart'),
					'desc'     => __('Show Map Zoom Controls', 'cleanstart'),
					'options'  => array( 'true' => 'On', 'false' => 'Off' ),
					'default'  => 'true',
					),
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-map-zoom-control-style',
					'type'     => 'select',
					'required' => array( PLETHORA_META_PREFIX .'header-media-map-zoom-control','=', array('true')),
					'title'    => __('Set Zoom Controls Style', 'cleanstart'), 
					'desc'     => __('Select the style of the Zoom Controls', 'cleanstart'),
					'options'  => array(
						"SMALL"   => "Small",
						"LARGE"   => "Large",
						"DEFAULT" => "Default"
						),
					'default'  => 'SMALL'
					),
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-map-zoom-control-position',
					'type'     => 'select',
					'required' => array( PLETHORA_META_PREFIX .'header-media-map-zoom-control','=', array('true')),
					'title'    => __('Set Zoom Controls Position', 'cleanstart'), 
					'desc'     => __('Select the <a href="https://developers.google.com/maps/documentation/javascript/images/control-positions.png" target="_blank">position</a> of the Zoom Controls', 'cleanstart'),
					'options'  => array(
						"TOP_LEFT"      => "Top Left",
						"TOP_CENTER"    => "Top Center",
						"TOP_RIGHT"     => "Top Right",
						"LEFT_CENTER"   => "Center Left",
						"RIGHT_CENTER"  => "Center Right",
						"LEFT_BOTTOM"   => "Bottom Left",
						"BOTTOM_CENTER" => "Bottom Center",
						"BOTTOM_RIGHT"  => "Bottom Right",
						),
					'default'  => 'LEFT_CENTER'
					),
				/*** MAP PAN CONTROL OPTIONS ***/
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-map-pan-control',
					'type'     => 'button_set',
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('googlemap')),
					'title'    => __('Show Map Pan Controls', 'cleanstart'),
					'desc'     => __('Show Map Pan Controls', 'cleanstart'),
					'options'  => array( 'true' => 'On', 'false' => 'Off' ),
					'default'  => 'true',
					),
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-map-pan-control-position',
					'type'     => 'select',
					'required' => array( PLETHORA_META_PREFIX .'header-media-map-pan-control','=', array('true')),
					'title'    => __('Set Pan Controls Position', 'cleanstart'), 
					'desc'     => __('Select the <a href="https://developers.google.com/maps/documentation/javascript/images/control-positions.png" target="_blank">position</a> of the Pan Controls', 'cleanstart'),
					'options'  => array(
						"TOP_LEFT"      => "Top Left",
						"TOP_CENTER"    => "Top Center",
						"TOP_RIGHT"     => "Top Right",
						"LEFT_CENTER"   => "Center Left",
						"RIGHT_CENTER"  => "Center Right",
						"LEFT_BOTTOM"   => "Bottom Left",
						"BOTTOM_CENTER" => "Bottom Center",
						"BOTTOM_RIGHT"  => "Bottom Right",
						),
					'default'  => 'RIGHT_CENTER'
					),
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-map-mark',
					'type'     => 'button_set',
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('googlemap')),
					'title'    => __('Map Mark', 'cleanstart'),
					'desc'     => __('Show a mark over the given location', 'cleanstart'),
					'options'  => array( 'true' => 'On', 'false' => 'Off' ),
					'default'  => 'true',
					),
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-map-controls',
					'type'     => 'button_set',
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('googlemap')),
					'title'    => __('Show controls', 'cleanstart'),
					'desc'     => __('Show pan and zoom controls', 'cleanstart'),
					'options'  => array( 'true' => 'On', 'false' => 'Off' ),
					'default'  => 'true',
					),
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-map-title',
					'type'     => 'text', 
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('googlemap')),
					'title'    => __('Change Marker Message', 'cleanstart'),
					'desc'     => __('Change Marker Message', 'cleanstart'),
					'default'  => 'We are right here!'
					),
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-map-icon',
					'type'     => 'media', 
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('googlemap')),
					'url'      => true,
					'title'    => __('Custom Marker Icon', 'cleanstart'),
					'desc'     => __('Upload an image to use as your map marker', 'cleanstart'),
					),
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-map-infowinfow',
					'type'     => 'textarea',
					'title'    => __(' InfoWindow', 'cleanstart'), 
					'subtitle' => __('Display Info Window on Marker click ', 'cleanstart'),
					'desc'     => __('Some HTML is allowed.', 'cleanstart'),
					'validate' => 'html_custom',
					'default'  => 'Some HTML is allowed in here.'
				),
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-map-icon-anchor-x',
				    'type'     => 'spinner',
				    'title'    => __('Anchor X Coordinate', 'cleanstart'),
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('googlemap')),
				    'subtitle' => __('Set your custom marker\'s anchor X point', 'cleanstart'),
				    'desc'     => __('Set the X point.', 'cleanstart'),
				    'default'  => '0',
				    'min'      => '0',
				    'step'     => '1',
				    'max'      => '1000',
				),
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-map-icon-anchor-y',
				    'type'     => 'spinner',
				    'title'    => __('Anchor Y Coordinate', 'cleanstart'),
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('googlemap')),
				    'subtitle' => __('Set your custom marker\'s anchor Y point', 'cleanstart'),
				    'desc'     => __('Set the Y point.', 'cleanstart'),
				    'default'  => '0',
				    'min'      => '0',
				    'step'     => '1',
				    'max'      => '1000',
				),
				/*** MAP STREETVIEW OPTIONS ***/
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-map-streetview',
					'type'     => 'button_set',
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('googlemap')),
					'title'    => __('Enable StreetView', 'cleanstart'),
					'desc'     => __('Enable StreetView', 'cleanstart'),
					'options'  => array( 'true' => 'On', 'false' => 'Off' ),
					'default'  => 'false',
				),
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-map-streetview-position',
					'type'     => 'select',
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('googlemap')),
					'title'    => __('Set StreetView Icon Position', 'cleanstart'), 
					'desc'     => __('Select the <a href="https://developers.google.com/maps/documentation/javascript/images/control-positions.png" target="_blank">position</a> of the StreetView Icon', 'cleanstart'),
					'options'  => array(
						"TOP_LEFT"      => "Top Left",
						"TOP_CENTER"    => "Top Center",
						"TOP_RIGHT"     => "Top Right",
						"LEFT_CENTER"   => "Center Left",
						"RIGHT_CENTER"  => "Center Right",
						"LEFT_BOTTOM"   => "Bottom Left",
						"BOTTOM_CENTER" => "Bottom Center",
						"BOTTOM_RIGHT"  => "Bottom Right",
						),
					'default'  => 'LEFT_CENTER'
					),
				/*** MAP SCALE CONTROL OPTIONS ***/
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-map-scale-control',
					'type'     => 'button_set',
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('googlemap')),
					'title'    => __('Show Map Scale', 'cleanstart'),
					'desc'     => __('Show Map Scale', 'cleanstart'),
					'options'  => array( 'true' => 'On', 'false' => 'Off' ),
					'default'  => 'false',
					),
	        )
	    );

	    $sections_elements = array(
	        'title'         => __('Other Elements', 'cleanstart'),
	        'icon_class'    => 'icon-large',
	        'icon'          => 'el-icon-adjust-alt',
	        'fields'        => array(
				array(
					'id'=>PLETHORA_META_PREFIX .'header-layout',
					'type' => 'select',
					'title' => __('Header layout', 'cleanstart'), 
					'width' => '80%',
					'options' => array('classic' => 'Classic ( logo on the left / menu on the right )', 'centered' => 'Centered ( logo & menu centered )'),//Must provide key => value pairs for radio options
					),
				array( 
					'id'      => PLETHORA_META_PREFIX .'footer-twitterfeed',
					'type'    => 'button_set', 
					'title'   => __('Twitter feed display', 'cleanstart'),
					'desc'    => __('For further Twitter feed options, please check', 'cleanstart') .'<strong>'. __('Theme Settings > Social & APIs tab', 'cleanstart') .'</strong>',
					'options' => array(
							1 => 'Display',
							0 => 'Hide',
							),
					),	

				/*** ONE PAGE SETTINGS ***/

				array(
					'id'      => PLETHORA_META_PREFIX .'one-pager',
					'type'    => 'button_set', 
					'title'   => __('One Page Scrolling', 'cleanstart'),
					'desc'    => __('Enables smooth page scrolling for one-pager implementations', 'cleanstart'),
					'default' => 'disabled',
					'options' => array(
							"disabled" => 'Disabled',
							"enabled"  => 'Enabled',
							),
					),	
				array(
					'id'       => PLETHORA_META_PREFIX .'one-pager-speed',
					'type'     => 'spinner', 
					'title'    => __('One Page Scrolling Speed', 'cleanstart'),
					'required' => array( PLETHORA_META_PREFIX .'one-pager','=', array("enabled")),
					"min"      => 100,
					"step"     => 100,
					"max"      => 4000,
					"default"  => 300,
					),	

				/*** << ONE PAGE SETTINGS ***/

				array(
					'id'      => PLETHORA_META_PREFIX .'header-triangles',
					'type'    => 'button_set', 
					'title'   => __('Header Side Corners', 'cleanstart'),
					'options' => array(
							'display' => 'Display',
							'hide'    => 'Hide',
							),
					),	
				array(
					'id'      => PLETHORA_META_PREFIX .'footer-triangles',
					'type'    => 'button_set', 
					'title'   => __('Footer Side Corners', 'cleanstart'),
					'options' => array(
							'display' => 'Display',
							'hide'    => 'Hide',
							),
					),	
				array(
					'id'    => PLETHORA_META_PREFIX .'header-toolbar',
					'type'  => 'switch', 
					'title' => __('Top toolbar', 'cleanstart'),
					'on'    => 'Display',
					'off'   => 'Hide',
					),
				array(
					'id'       => PLETHORA_META_PREFIX .'header-toolbar-layout',
					'type'     => 'select',
					'required' => array( PLETHORA_META_PREFIX .'header-toolbar','=','1'),						
					'title'    => __('Top toolbar layout', 'cleanstart'), 
					'options'  => array(
						'1' => 'Menu | Custom Text', 
						'2' => 'Custom Text | Menu', 
						'3' => 'Custom Text Only', 
						),
					),
				array(
					'id'           =>PLETHORA_META_PREFIX .'header-toolbar-html',
					'type'         => 'textarea',
					'required'     => array( PLETHORA_META_PREFIX .'header-toolbar','=','1'),						
					'title'        => __('Top toolbar custom text', 'cleanstart'), 
					'desc'         => __('HTML tags allowed', 'cleanstart'),
					'validate'     => 'html_custom',
					),
				// array( 
				// 	'id'          => PLETHORA_META_PREFIX .'header-toolbar-langswitcher',
				// 	'type'        => 'switch', 
				// 	'required'    => array( PLETHORA_META_PREFIX .'header-toolbar','=','1'),						
				// 	'title'       => __('Language switcher', 'cleanstart'),
				// 	'description' => __('Displayed on the right side, only if <strong>WPML</strong> plugin is active.', 'cleanstart'),
				// 	'on'          => 'Display',
				// 	'off'         => 'Hide',
				// 	),
	        )
	    );

    	$sections_blog_content = array(
			'title'      => __('Blog Listings Display', 'cleanstart'),
			'icon_class' => 'icon-large',
			'icon'       => 'el-icon-info-sign',
			'fields'     => array(
					array(
						'id'      => PLETHORA_META_PREFIX .'blog-listing',
						'type'    => 'button_set', 
						'title'    => __('Content/Excerpt Display', 'cleanstart'), 
						'descr' => __('Displaying content will allow you to display posts containing the WP editor "More" tag.', 'cleanstart'),
						'default'  => 'excerpt',
						'options' => array(
							'excerpt' => __('Display Excerpt', 'cleanstart'), 
							'content' => __('Display Content', 'cleanstart') 
						)
					),	
					array(
						'id'      => PLETHORA_META_PREFIX .'blog-show-linkbutton',
						'type'    => 'switch', 
						'title'   => __('Show "Read More" Button', 'cleanstart'),
						"default" => 1,
						),	
					array(
						'id'      =>PLETHORA_META_PREFIX .'blog-show-linkbutton-text',
						'type'    => 'text',
						'required' => array(PLETHORA_META_PREFIX .'blog-show-linkbutton', '=', 1),
						'title' => __('Button Text', 'cleanstart'),
						"default" => __('Read More', 'cleanstart'),
					),	
					array(
						'id'      =>'blog-noposts-title',
						'type'    => 'text', 
						'title' => '<strong>'. __('No Posts', 'cleanstart') .'</strong> '. __('Title', 'cleanstart'),
						"default" => __('No posts where found!', 'cleanstart'),
					),	
					array(
						'id'      =>'blog-noposts-description',
						'type'    => 'textarea', 
						'title' => '<strong>'. __('No Posts', 'cleanstart') .'</strong> '. __('Description', 'cleanstart'),
						"default" => __('Unfortunately, no posts were found! Please try again soon!', 'cleanstart'),
					),	
					array(
						'id'      => 'blog-info-category',
						'type'    => 'switch', 
						'title'   => __('Show Categories Info', 'cleanstart'),
						"default" => 1,
						),	
					array(
						'id'      => 'blog-info-tags',
						'type'    => 'switch', 
						'title'   => __('Show Tag Info', 'cleanstart'),
						"default" => 1,
						),	
					array(
						'id'      => 'blog-info-author',
						'type'    => 'switch', 
						'title'   => __('Show Author Info', 'cleanstart'),
						"default" => 1,
						),	
					array(
						'id'      => 'blog-info-date',
						'type'    => 'switch', 
						'title'   => __('Show Date Info', 'cleanstart'),
						"default" => 1,
						),	
					array(
						'id'      => 'blog-info-comments',
						'type'    => 'switch', 
						'title'   => __('Show Comments Count Info', 'cleanstart'),
						"default" => 1,
						),	
			)
		);

	    $sections_blog_headpanel = array(
			'title'      => __('Head Panel', 'cleanstart'),
			'icon_class' => 'icon-large',
			'desc'       => ' <a href="'. admin_url('admin.php?page=cleanstart_options&tab=3') . ' target="_blank">'. __('Click here', 'cleanstart') . '</a>'. __(' to edit default head panel options.', 'cleanstart'),
			'icon'       => 'el-icon-website',
			'fields'     => array(
				array(
					'id'      => PLETHORA_META_PREFIX .'header-media',
					'type'    => 'button_set',
					'title'   => __('Background Type', 'cleanstart'), 
					'options' => self::option_revslider_headermedia_buttons(),
					),
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-dimensions',
					'type'     => 'dimensions',
					'required' => array( PLETHORA_META_PREFIX .'header-media','equals', array('featuredimage', 'otherimage', 'localvideo', 'googlemap')),						
					'width'    => false,
					'title'    => __('Panel Height', 'cleanstart'),
					),			
				array(
					'id'      => PLETHORA_META_PREFIX .'header-media-nomediadimensions',
					'type'    => 'dimensions',
					'required' => array( PLETHORA_META_PREFIX .'header-media','equals', array('nomedia')),						
					'width'   => false,
					'title'   => __('Panel Height / Skin Color', 'cleanstart'),
					),			
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-otherimage',
					'type'     => 'media', 
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('otherimage')),
					'url'      => true,
					'title'    => __('Other Image', 'cleanstart'),
					'desc'     => __('Upload an image other than your featured image', 'cleanstart'),
					),

				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-revslider',
					'type'     => 'select',
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('revslider')),
					'title'    => __('Select Revolution Slider', 'cleanstart'), 
					'desc'     => __('Select a Revolution slider to be displayed ( must have Revolution Slider plugin installed, not included with theme )', 'cleanstart'),
					'options'  => method_exists('Plethora_CMS', 'get_revsliders') ? Plethora_CMS::get_revsliders() :  array() ,
					),

				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-slider',
					'type'     => 'select',
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('slider')),
					'data'     => 'posts',
					'title'    => __('Select Slider', 'cleanstart'), 
					'desc'     => __('Select a slider to be displayed. You should create one first! Slider settings will be applied here too!', 'cleanstart'),
					'args'     => array(
						'posts_per_page' => -1,
						'post_type'      => 'slider', 				
						'suppress_filters' => false)				
					),

				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-localvideo',
					'type'     => 'media', 
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('localvideo')),
					'url'      => true,
					'preview'  => true,
					'mode'     => false,
					'readonly' => false,
					'title'    => __('Local video', 'cleanstart'),
					'desc'     => __('Upload a video file ( supported formats: FLV | MP4 )', 'cleanstart'),
					),

				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-localvideo-poster',
					'type'     => 'media', 
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('localvideo')),
					'url'      => true,
					'readonly' => false,
					'title'    => __('Video cover image', 'cleanstart'),
					'desc'     => __('Set a cover image for this video. It MUST have a 16x9 proportion to display properly ', 'cleanstart'),
					),

				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-localvideo-controls',
					'type'     => 'button_set',
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('localvideo')),
					'title'    => __('Video controls', 'cleanstart'),
					'desc'     => __('Click \'Off\' if you want to hide video controls', 'cleanstart'),
					'options'  => array( 'true' => 'On', 'false' => 'Off' ),
					'default'  => 'true',
					),
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-localvideo-sound',
					'type'     => 'button_set',
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('localvideo')),
					'title'    => __('Video sound', 'cleanstart'),
					'desc'     => __('Click \'Off\' if you want this video to be silent', 'cleanstart'),
					'options'  => array( 'true' => 'On', 'false' => 'Off' ),
					'default'  => 'false',
					),
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-localvideo-autoplay',
					'type'     => 'button_set',
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('localvideo')),
					'title'    => __('Video autoplay', 'cleanstart'),
					'desc'     => __('Click \'On\' if you want this video to start automatically', 'cleanstart'),
					'options'  => array( 'true' => 'On', 'false' => 'Off' ),
					'default'  => 'false',
					),
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-localvideo-loop',
					'type'     => 'button_set',
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('localvideo')),
					'title'    => __('Video loop', 'cleanstart'),
					'desc'     => __('Click \'On\' if you want this video to loop', 'cleanstart'),
					'options'  => array( 'true' => 'On', 'false' => 'Off' ),
					'default'  => 'false',
					),
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-map-lang',
					'type'     => 'text', 
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('googlemap')),
					'title'    => __('Map Latitude', 'cleanstart'),
					'desc'     => __('Example:', 'cleanstart') .'<strong>51.50852</strong>',
					),
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-map-long',
					'type'     => 'text', 
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('googlemap')),
					'title'    => __('Map Longtitude', 'cleanstart'),
					'desc'     => __('Example:', 'cleanstart') .'<strong>-0.1254</strong>',
					),
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-map-type',
					'type'     => 'button_set',
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('googlemap')),
					'title'    => __('Map Type', 'cleanstart'),
					'options'  => array( 'ROADMAP' => 'Roadmap', 'SATELITE' => 'Satelite' ),
					'default'  => 'ROADMAP',
					),
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-map-zoom',
					'type'     => 'slider', 
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('googlemap')),
					'title'    => __('Map Zoom', 'cleanstart'),
					"default"  => "12",
					"min"      => "1",
					"step"     => "1",
					"max"      => "18",
					),
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-map-mark',
					'type'     => 'button_set',
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('googlemap')),
					'title'    => __('Map Mark', 'cleanstart'),
					'desc'     => __('Show a mark over the given location', 'cleanstart'),
					'options'  => array( 'true' => 'On', 'false' => 'Off' ),
					'default'  => 'true',
					),
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-map-controls',
					'type'     => 'button_set',
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('googlemap')),
					'title'    => __('Show controls', 'cleanstart'),
					'desc'     => __('Show pan and zoom controls', 'cleanstart'),
					'options'  => array( 'true' => 'On', 'false' => 'Off' ),
					'default'  => 'true',
					),
				array(
					'id'             => PLETHORA_META_PREFIX .'header-align',
					'type'           => 'typography', 
					'title'          => __('Title/Subtitle Text Align', 'cleanstart'),
					'google'         =>false, 
					'font-family'    =>false, 
					'font-backup'    =>false, 
					'font-style'     =>false, 
					'font-weight'    =>false, 
					'font-size'      =>false, 
					'subsets'        =>false, 
					'line-height'    =>false, 
					'word-spacing'   =>false, 
					'letter-spacing' =>false, 
					'text-transform' =>false, 
					'font-backup'    =>false, 
					'preview'        =>false, 
					'color'          => false,
					'output'         => array('.hgroup_title h1', '.hgroup_subtitle p'), // An array of CSS selectors to apply this font style to dynamically
					'units'          =>'px', 
					),	
				array(
					'id'    =>'blog-header-title',
					'type'  => 'text', 
					'title' => __('Title Text', 'cleanstart'),
				),	
				array(
					'id'    =>'blog-header-subtitle',
					'type'  => 'text', 
					'title' => __('Subtitle Text', 'cleanstart'),
				),	
				array(
					'id'    =>'blog-header-title-cat',
					'type'  => 'text', 
					'title' => __('Title Text Prefix // Category', 'cleanstart'),
					'desc'  => __('Will be displayed on the <strong>head panel title</strong>, right before the selected category name', 'cleanstart'),
				),	
				array(
					'id'      =>'blog-header-subtitle-cat',
					'type'    => 'button_set', 
					'title'   => __('Subtitle Text Source // Category', 'cleanstart'),
					'desc'    => __('Select the <strong>head panel subtitle</strong> behavior when a category is selected.<br/><small>Descriptions for each category can be set on <a href="'.  admin_url( 'edit-tags.php?taxonomy=category' ) .'"><strong>Posts > Categories</strong></a> menu</small>', 'cleanstart'),
					'options' => array(
							'nosubtitle'     => 'No Subtitle',
							'usedefault'     => 'Use Blog Subtitle',
							'usedescription' => 'Use Selected Category Description',
							'usecustom'      => 'Use Custom Subtitle',
					)
				),	
				array(
					'id'       =>'blog-header-subtitle-cat-custom',
					'type'     => 'text', 
					'required' => array('blog-header-subtitle-cat','equals','usecustom'),						
					'title'    => __('Custom Subtitle // Category', 'cleanstart'),
					'desc'     => __('Will be displayed when any <strong>category</strong> is selected', 'cleanstart'),
				),	
				array(
					'id'    =>'blog-header-title-tag',
					'type'  => 'text', 
					'title' => __('Title Text Prefix // Tag', 'cleanstart'),
					'desc'  => __('Will be displayed right before the selected <strong>tag</strong> name', 'cleanstart'),
				),	
				array(
					'id'      =>'blog-header-subtitle-tag',
					'type'    => 'button_set', 
					'title'   => __('Subtitle Text Source // Tag', 'cleanstart'),
					'desc'    => __('Select the <strong>head panel subtitle</strong> behavior when a <strong>tag</strong> is selected.<br/><small>Descriptions for each tag can be set on <a href="'.  admin_url( 'edit-tags.php?taxonomy=post_tag' ) .'"><strong>Posts > Tags</strong></a> menu</small>', 'cleanstart'),
					'options' => array(
							'nosubtitle'     => 'No Subtitle',
							'usedefault'     => 'Use Blog Subtitle',
							'usedescription' => 'Use Selected Tag Description',
							'usecustom'      => 'Use Custom Subtitle',
					)
				),	
				array(
					'id'       =>'blog-header-subtitle-tag-custom',
					'type'     => 'text', 
					'required' => array('blog-header-subtitle-tag','equals','usecustom'),						
					'title'    => __('Custom Subtitle // Tag', 'cleanstart'),
					'desc'     => __('Will be displayed  when a <strong>tag</strong> is selected', 'cleanstart'),
				),	
				array(
					'id'    =>'blog-header-title-date',
					'type'  => 'text', 
					'title' => __('Title Prefix // Date', 'cleanstart'),
					'desc'  => __('This text will be displayed on the <strong>head panel title</strong>, right before the selected <strong>date range</strong>', 'cleanstart'),
				),	
				array(
					'id'      =>'blog-header-subtitle-date',
					'type'    => 'button_set', 
					'title'   => __('Subtitle Text // Date', 'cleanstart'),
					'desc'    => __('Select the <strong>head panel subtitle</strong> behavior when a <strong>date range</strong> is selected', 'cleanstart'),
					'options' => array(
							'nosubtitle' => 'No Subtitle',
							'usedefault' => 'Use Blog Subtitle',
							'usecustom'  => 'Use Custom Subtitle',
					)
				),	
				array(
					'id'       =>'blog-header-subtitle-date-custom',
					'type'     => 'text', 
					'required' => array('blog-header-subtitle-date','equals','usecustom'),						
					'title'    => __('Custom Subtitle Text // Date', 'cleanstart'),
					'desc'     => __('Will be displayed when a <strong>date range</strong> is selected', 'cleanstart'),
				),	
				array(
					'id'    =>'blog-header-title-author',
					'type'  => 'text', 
					'title' => __('Title Text Prefix // Author', 'cleanstart'),
					'desc'  => __('Will be displayed right before the <strong>author\'s name</strong>', 'cleanstart'),
				),	
				array(
					'id'      =>'blog-header-subtitle-author',
					'type'    => 'button_set', 
					'title'   => __('Subtitle Text // Author', 'cleanstart'),
					'desc'    => __('Select the <strong>head panel subtitle</strong> behavior when an <strong>author</strong> is selected.<br/><small>Biographical info for each user can be set on <a href="'.  admin_url( 'users.php' ) .'"><strong>Users</strong></a> menu</small>', 'cleanstart'),
					'options' => array(
							'nosubtitle' => 'No Subtitle',
							'usedefault' => 'Use Blog Subtitle',
							'usebio'     => 'Use Selected Author\'s Biographical Info',
							'usecustom'  => 'Use Custom Subtitle',
					)
				),	
				array(
					'id'       =>'blog-header-subtitle-author-custom',
					'type'     => 'text', 
					'required' => array('blog-header-subtitle-author','equals','usecustom'),						
					'title'    => __('Custom Subtitle Text // Author', 'cleanstart'),
					'desc'     => __('Will be displayed when an <strong>author</strong> is selected', 'cleanstart'),
				),	
				array(
					'id'    =>'blog-header-title-search',
					'type'  => 'text', 
					'title' => __('Title Text Prefix // Search', 'cleanstart'),
					'desc'  => __('Will be displayed right before the user <strong>search term</strong>', 'cleanstart'),
				),	
				array(
					'id'      =>'blog-header-subtitle-search',
					'type'    => 'button_set', 
					'title'   => __('Subtitle Text // Search', 'cleanstart'),
					'desc'    => __('Select the <strong>head panel subtitle</strong> behavior when a <strong>search</strong> is done', 'cleanstart'),
					'options' => array(
							'nosubtitle' => 'No Subtitle',
							'usedefault' => 'Use Blog Subtitle',
							'usecustom'  => 'Use Custom Subtitle',
					)
				),	
				array(
					'id'       =>'blog-header-subtitle-search-custom',
					'type'     => 'text', 
					'required' => array('blog-header-subtitle-search','equals','usecustom'),						
					'title'    => __('Custom Subtitle Text // Search', 'cleanstart'),
					'desc'     => __('Will be displayed when a <strong>search</strong> is done', 'cleanstart'),
				),	
	        )
	    );

	    $sections_shop_content = array(
			'title'      => __('Catalog Options', 'cleanstart'),
			'desc'      => __('Notice: these options affect only the shop catalog view. Click here for default single product view options', 'cleanstart'),
			'icon_class' => 'icon-large',
			'icon'       => 'el-icon-info-sign',
			'fields'     => array(

					array(
						'id'      => PLETHORA_META_PREFIX .'wooarchive-perpage',
						'type'        => 'slider',
						'title'       => __('Products Displayed Per Page', 'cleanstart'), 
					    "default" => 12,
					    "min" => 4,
					    "step" => 4,
					    "max" => 240,
					    'display_value' => 'text'
						),
					array(
						'id'      => PLETHORA_META_PREFIX .'wooarchive-columns',
						'type'        => 'slider',
						'title'       => __('Products Grid Columns', 'cleanstart'), 
					    "default" => 4,
					    "min" => 2,
					    "step" => 1,
					    "max" => 4,
					    'display_value' => 'text'
						),
					array(
						'id'      => PLETHORA_META_PREFIX .'wooarchive-title',
						'type'    => 'button_set',
						'title'   => __('Catalog Page Title', 'cleanstart'),
						'desc'   => __('By default, category description ( if exists ) is displayed right after shop title.', 'cleanstart'),
						"default" => 'display',
						'options' => array(
								'display' => __('Display', 'cleanstart'),
								'hide'   => __('Hide', 'cleanstart'),
								),
						),

					array(
						'id'      => PLETHORA_META_PREFIX .'wooarchive-categorydescription',
						'type'    => 'button_set',
						'title'   => __('Category Description', 'cleanstart'),
						'desc'   => __('By default, category description ( if exists ) is displayed right after shop title.', 'cleanstart'),
						"default" => 'display',
						'options' => array(
								'display' => __('Display', 'cleanstart'),
								'hide'   => __('Hide', 'cleanstart'),
								),
						),

					array(
						'id'      => PLETHORA_META_PREFIX .'wooarchive-breadcrumbs',
						'type'    => 'button_set',
						'title'   => __('Breadcrumbs ( Catalog View )', 'cleanstart'),
						"default" => 'display',
						'options' => array(
								'display' => __('Display', 'cleanstart'),
								'hide'   => __('Hide', 'cleanstart'),
								),
						),
					array(
						'id'      => PLETHORA_META_PREFIX .'wooarchive-resultscount',
						'type'    => 'button_set',
						'title'   => __('Results Count Info', 'cleanstart'),
						"default" => 'display',
						'options' => array(
								'display' => __('Display', 'cleanstart'),
								'hide'   => __('Hide', 'cleanstart'),
								),
						),
					array(
						'id'      => PLETHORA_META_PREFIX .'wooarchive-orderby',
						'type'    => 'button_set',
						'title'   => __('Order Dropdown Field', 'cleanstart'),
						"default" => 'display',
						'options' => array(
								'display' => __('Display', 'cleanstart'),
								'hide'   => __('Hide', 'cleanstart'),
								),
						),
					array(
						'id'      => PLETHORA_META_PREFIX .'wooarchive-rating',
						'type'    => 'button_set',
						'title'   => __('Ratings ( Catalog View )', 'cleanstart'),
						"default" => 'display',
						'options' => array(
								'display' => __('Display', 'cleanstart'),
								'hide'   => __('Hide', 'cleanstart'),
								),
						),
					array(
						'id'      => PLETHORA_META_PREFIX .'wooarchive-price',
						'type'    => 'button_set',
						'title'   => __('Prices ( Catalog View )', 'cleanstart'),
						"default" => 'display',
						'options' => array(
								'display' => __('Display', 'cleanstart'),
								'hide'   => __('Hide', 'cleanstart'),
								),
						),
					array(
						'id'      => PLETHORA_META_PREFIX .'wooarchive-addtocart',
						'type'    => 'button_set',
						'title'   => __('"Add To Cart" Button ( Catalog View )', 'cleanstart'),
						"default" => 'display',
						'options' => array(
								'display' => __('Display', 'cleanstart'),
								'hide'   => __('Hide', 'cleanstart'),
								),
						),
					array(
						'id'      => PLETHORA_META_PREFIX .'wooarchive-salesflash',
						'type'    => 'button_set',
						'title'   => __('"Sale!" Icon ( Catalog View )', 'cleanstart'),
						"default" => 'display',
						'options' => array(
								'display' => __('Display', 'cleanstart'),
								'hide'   => __('Hide', 'cleanstart'),
								),
						),
	        )
	    );
		$sections_shop_headpanel = array(
			'title'      => __('Head Panel', 'cleanstart'),
			'desc'      => __('Notice: these options affect only the shop catalog head panel.', 'cleanstart'),
			'icon_class' => 'icon-large',
			'icon'       => 'el-icon-website',
			'fields'     => array(

				array(
					'id'      => PLETHORA_META_PREFIX .'header-media',
					'type'    => 'button_set',
					'title'   => __('Background Type', 'cleanstart'), 
					'options' => self::option_revslider_headermedia_buttons(),
					),
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-dimensions',
					'type'     => 'dimensions',
					'required' => array( PLETHORA_META_PREFIX .'header-media','equals', array('featuredimage', 'otherimage', 'localvideo', 'googlemap')),						
					'width'    => false,
					'title'    => __('Panel Height', 'cleanstart'),
					),			
				array(
					'id'      => PLETHORA_META_PREFIX .'header-media-nomediadimensions',
					'type'    => 'dimensions',
					'required' => array( PLETHORA_META_PREFIX .'header-media','equals', array('nomedia')),						
					'width'   => false,
					'title'   => __('Panel Height / Skin Color', 'cleanstart'),
					),			
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-otherimage',
					'type'     => 'media', 
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('otherimage')),
					'url'      => true,
					'title'    => __('Other Image', 'cleanstart'),
					'desc'     => __('Upload an image other than your featured image', 'cleanstart'),
					),

				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-slider',
					'type'     => 'select',
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('slider')),
					'data'     => 'posts',
					'title'    => __('Select Slider', 'cleanstart'), 
					'desc'     => __('Select a slider to be displayed. You should create one first! Slider settings will be applied here too!', 'cleanstart'),
					'args'     => array(
						'posts_per_page' => -1,
						'post_type'      => 'slider', 				
						'suppress_filters' => false)				
					),

				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-revslider',
					'type'     => 'select',
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('revslider')),
					'title'    => __('Select Revolution Slider', 'cleanstart'), 
					'desc'     => __('Select a Revolution slider to be displayed ( must have Revolution Slider plugin installed, not included with theme )', 'cleanstart'),
					'options'  => method_exists('Plethora_CMS', 'get_revsliders') ? Plethora_CMS::get_revsliders() :  array() ,
					),

				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-localvideo',
					'type'     => 'media', 
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('localvideo')),
					'url'      => true,
					'preview'  => true,
					'mode'     => false,
					'readonly' => false,
					'title'    => __('Local video', 'cleanstart'),
					'desc'     => __('Upload a video file ( supported formats: FLV | MP4 )', 'cleanstart'),
					),

				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-localvideo-poster',
					'type'     => 'media', 
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('localvideo')),
					'url'      => true,
					'readonly' => false,
					'title'    => __('Video cover image', 'cleanstart'),
					'desc'     => __('Set a cover image for this video. It MUST have a 16x9 proportion to display properly ', 'cleanstart'),
					),

				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-localvideo-controls',
					'type'     => 'button_set',
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('localvideo')),
					'title'    => __('Video controls', 'cleanstart'),
					'desc'     => __('Click \'Off\' if you want to hide video controls', 'cleanstart'),
					'options'  => array( 'true' => 'On', 'false' => 'Off' ),
					'default'  => 'true',
					),
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-localvideo-sound',
					'type'     => 'button_set',
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('localvideo')),
					'title'    => __('Video sound', 'cleanstart'),
					'desc'     => __('Click \'Off\' if you want this video to be silent', 'cleanstart'),
					'options'  => array( 'true' => 'On', 'false' => 'Off' ),
					'default'  => 'false',
					),
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-localvideo-autoplay',
					'type'     => 'button_set',
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('localvideo')),
					'title'    => __('Video autoplay', 'cleanstart'),
					'desc'     => __('Click \'On\' if you want this video to start automatically', 'cleanstart'),
					'options'  => array( 'true' => 'On', 'false' => 'Off' ),
					'default'  => 'false',
					),
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-localvideo-loop',
					'type'     => 'button_set',
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('localvideo')),
					'title'    => __('Video loop', 'cleanstart'),
					'desc'     => __('Click \'On\' if you want this video to loop', 'cleanstart'),
					'options'  => array( 'true' => 'On', 'false' => 'Off' ),
					'default'  => 'false',
					),
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-map-lang',
					'type'     => 'text', 
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('googlemap')),
					'title'    => __('Map Latitude', 'cleanstart'),
					'desc'     => __('Example:', 'cleanstart') .'<strong>51.50852</strong>',
					),
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-map-long',
					'type'     => 'text', 
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('googlemap')),
					'title'    => __('Map Longtitude', 'cleanstart'),
					'desc'     => __('Example:', 'cleanstart') .'<strong>-0.1254</strong>',
					),
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-map-type',
					'type'     => 'button_set',
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('googlemap')),
					'title'    => __('Map Type', 'cleanstart'),
					'options'  => array( 'ROADMAP' => 'Roadmap', 'SATELITE' => 'Satelite' ),
					'default'  => 'ROADMAP',
					),
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-map-zoom',
					'type'     => 'slider', 
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('googlemap')),
					'title'    => __('Map Zoom', 'cleanstart'),
					"default"  => "12",
					"min"      => "1",
					"step"     => "1",
					"max"      => "18",
					),
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-map-mark',
					'type'     => 'button_set',
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('googlemap')),
					'title'    => __('Map Mark', 'cleanstart'),
					'desc'     => __('Show a mark over the given location', 'cleanstart'),
					'options'  => array( 'true' => 'On', 'false' => 'Off' ),
					'default'  => 'true',
					),
				array(
					'id'       => PLETHORA_META_PREFIX .'header-media-map-controls',
					'type'     => 'button_set',
					'required' => array( PLETHORA_META_PREFIX .'header-media','=', array('googlemap')),
					'title'    => __('Show controls', 'cleanstart'),
					'desc'     => __('Show pan and zoom controls', 'cleanstart'),
					'options'  => array( 'true' => 'On', 'false' => 'Off' ),
					'default'  => 'true',
					),
				array(
					'id'             => PLETHORA_META_PREFIX .'header-align',
					'type'           => 'typography', 
					'title'          => __('Title/Subtitle Text Align', 'cleanstart'),
					'google'         =>false, 
					'font-family'    =>false, 
					'font-backup'    =>false, 
					'font-style'     =>false, 
					'font-weight'    =>false, 
					'font-size'      =>false, 
					'subsets'        =>false, 
					'line-height'    =>false, 
					'word-spacing'   =>false, 
					'letter-spacing' =>false, 
					'text-transform' =>false, 
					'font-backup'    =>false, 
					'preview'        =>false, 
					'color'          => false,
					'output'         => array('.hgroup_title h1', '.hgroup_subtitle p'), // An array of CSS selectors to apply this font style to dynamically
					'units'          =>'px', 
					),	
				array(
					'id'      =>PLETHORA_META_PREFIX .'wooarchive-headpanel-title',
					'type'    => 'text', 
					'title'   => __('Title Text', 'cleanstart'),
					"default" => __('This is the default catalog title', 'cleanstart'),
				),	
				array(
					'id'      =>PLETHORA_META_PREFIX .'wooarchive-headpanel-subtitle',
					'type'    => 'text', 
					'title'   => __('Subtitle Text', 'cleanstart'),
					"default" => __('This is the default catalog subtitle', 'cleanstart'),
				),	
				array(
					'id'      =>PLETHORA_META_PREFIX .'wooarchive-headpanel-title-cat',
					'type'    => 'text', 
					'title'   => __('Title Text Prefix // Shopping Category', 'cleanstart'),
					'desc'    => __('Will be displayed on the <strong>head panel title</strong>, right before the selected shopping category name', 'cleanstart'),
					"default" => __('Shopping Category: ', 'cleanstart'),
				),	
				array(
					'id'      =>PLETHORA_META_PREFIX .'wooarchive-headpanel-subtitle-cat',
					'type'    => 'button_set', 
					'title'   => __('Subtitle Text Source // Shopping Category', 'cleanstart'),
					'desc'    => __('Select the <strong>head panel subtitle</strong> behavior when a shopping category is selected.<br/><small>Descriptions for each shopping category can be set on <a href="'.  admin_url( 'edit-tags.php?taxonomy=product_cat&post_type=product' ) .'"><strong>Products > Categories</strong></a> menu</small>', 'cleanstart'),
					"default" => 'usedescription',
					'options' => array(
							'nosubtitle'     => __('No Subtitle', 'cleanstart'),
							'usedefault'     => __('Use Catalog Subtitle', 'cleanstart'),
							'usedescription' => __('Use Selected Shopping Category Description', 'cleanstart'),
							'usecustom'      => __('Use Custom Subtitle', 'cleanstart'),
					)
				),	
				array(
					'id'       =>PLETHORA_META_PREFIX .'wooarchive-headpanel-subtitle-cat-custom',
					'type'     => 'text', 
					'required' => array(PLETHORA_META_PREFIX .'wooarchive-headpanel-subtitle-cat','equals','usecustom'),						
					'title'    => __('Custom Subtitle // Shopping Category', 'cleanstart'),
					'desc'     => __('Will be displayed when any <strong>shopping category</strong> is selected', 'cleanstart'),
					"default"  => __('This is the custom head panel subtitle text, displayed when any shopping category is selected.', 'cleanstart'),
				),	
				array(
					'id'      =>PLETHORA_META_PREFIX .'wooarchive-headpanel-title-tag',
					'type'    => 'text', 
					'title'   => __('Title Text Prefix // Shopping Tag', 'cleanstart'),
					'desc'    => __('Will be displayed right before the selected <strong>shopping tag</strong> name', 'cleanstart'),
					"default" => 'Tag: ',
				),	
				array(
					'id'      =>PLETHORA_META_PREFIX .'wooarchive-headpanel-subtitle-tag',
					'type'    => 'button_set', 
					'title'   => __('Subtitle Text Source // Shopping Tag', 'cleanstart'),
					'desc'    => __('Select the <strong>head panel subtitle</strong> behavior when a <strong>shopping tag</strong> is selected.<br/><small>Descriptions for each tag can be set on <a href="'.  admin_url( 'edit-tags.php?taxonomy=product_tag&post_type=product' ) .'"><strong>Products > Tags</strong></a> menu</small>', 'cleanstart'),
					"default" => 'usedefault',
					'options' => array(
							'nosubtitle'     => __('No Subtitle', 'cleanstart'),
							'usedefault'     => __('Use Catalog Subtitle', 'cleanstart'),
							'usedescription' => __('Use Selected Shopping Tag Description', 'cleanstart'),
							'usecustom'      => __('Use Custom Subtitle', 'cleanstart'),
					)
				),	
				array(
					'id'       =>PLETHORA_META_PREFIX .'wooarchive-headpanel-subtitle-tag-custom',
					'type'     => 'text', 
					'required' => array(PLETHORA_META_PREFIX .'wooarchive-headpanel-subtitle-tag','equals','usecustom'),						
					'title'    => __('Custom Subtitle // Shopping Tag', 'cleanstart'),
					'desc'     => __('Will be displayed  when a <strong>shopping tag</strong> is selected', 'cleanstart'),
					"default"  => __('This is the custom head panel subtitle text, displayed when a shopping tag is selected', 'cleanstart'),
				),	
				array(
					'id'      =>PLETHORA_META_PREFIX .'wooarchive-headpanel-title-search',
					'type'    => 'text', 
					'title'   => __('Title Text Prefix // Product Search', 'cleanstart'),
					'desc'    => __('Will be displayed right before the user <strong>product search term</strong>', 'cleanstart'),
					"default" => __('Product search: ', 'cleanstart'),
				),	
				array(
					'id'      =>PLETHORA_META_PREFIX .'wooarchive-headpanel-subtitle-search',
					'type'    => 'button_set', 
					'title'   => __('Subtitle Text // Product Search', 'cleanstart'),
					'desc'    => __('Select the <strong>head panel subtitle</strong> behavior when a <strong>product search</strong> is done', 'cleanstart'),
					"default" => 'usedefault',
					'options' => array(
							'nosubtitle' => __('No Subtitle', 'cleanstart'),
							'usedefault' => __('Use Catalog Subtitle', 'cleanstart'),
							'usecustom'  => __('Use Custom Subtitle', 'cleanstart'),
					)
				),	
				array(
					'id'       =>PLETHORA_META_PREFIX .'wooarchive-headpanel-subtitle-search-custom',
					'type'     => 'text', 
					'required' => array(PLETHORA_META_PREFIX .'wooarchive-headpanel-subtitle-search','equals','usecustom'),						
					'title'    => __('Custom Subtitle Text // Product Search', 'cleanstart'),
					'desc'     => __('Will be displayed when a <strong>product search</strong> is done', 'cleanstart'),
					"default"  => __('This is the custom header subtitle text, displayed when when a <strong>product search</strong> is done', 'cleanstart'),
				),	
			)
		);
		$sections = array();

		// Cannot use global $post, so we are getting the 'post' url parameter
		$postid = isset( $_GET['post'] ) && is_numeric( $_GET['post'] )  ? $_GET['post'] : 0;

		// Get page IDs for blog/shop
		$page_for_posts = class_exists('Plethora_CMS') ? Plethora_CMS::get_option('page_for_posts') : get_option('page_for_posts');
		$page_for_shop	= get_option( 'woocommerce_shop_page_id', 0 );

		// Blog Metabox. Should be displayed only if this is the static blog page
		if ( $postid === $page_for_posts ) {  

			$sections[] = $sections_blog_content;
			$sections[] = $sections_blog_headpanel;
			$sections[] = $sections_elements;
		    $metabox = array(
		        'id'            => 'metabox-blog',
		        'title'         => __( 'Blog Options', 'cleanstart' ),
		        'post_types'    => array( 'page' ),
		        'position'      => 'normal', // normal, advanced, side
		        'priority'      => 'high', // high, core, default, low
		        'sidebar'       => false, // enable/disable the sidebar in the normal/advanced positions
		        'sections'      => $sections,
		    );

		    // Produce a notice...this is a static blog page!
			// add_action('admin_notices', array( 'Plethora_Metabox_Page', 'staticblogpage_notice'));
			// add_action('admin_init',	array( 'Plethora_Metabox_Page', 'staticblogpage_ignorenotice'));

		// Shop Metabox. Should be displayed only if this is the WooCommerce shop page
		} elseif ( class_exists('woocommerce') && $postid === $page_for_shop ) {  

			$sections[] = $sections_shop_content;
			$sections[] = $sections_shop_headpanel;
			$sections[] = $sections_elements;
		    $metabox = array(
		        'id'            => 'metabox-shop',
		        'title'         => __( 'Products Catalog Options', 'cleanstart' ),
		        'post_types'    => array( 'page' ),
		        'position'      => 'normal', // normal, advanced, side
		        'priority'      => 'high', // high, core, default, low
		        'sidebar'       => false, // enable/disable the sidebar in the normal/advanced positions
		        'sections'      => $sections,
		    );

		// Page Metabox. Should be displayed only if this is the static blog page
		} else { 

			$sections[] = $sections_content;
			$sections[] = $sections_headpanel;
			$sections[] = $sections_elements;
		    $metabox = array(
		        'id'            => 'metabox-page',
		        'title'         => __( 'Page Options', 'cleanstart' ),
		        'post_types'    => array( 'page' ),
		        'position'      => 'normal', // normal, advanced, side
		        'priority'      => 'high', // high, core, default, low
		        'sidebar'       => false, // enable/disable the sidebar in the normal/advanced positions
		        'sections'      => $sections,
		    );

		}


	    return $metabox;
	}


       /** 
       * Returns alternatuve button selection for header media option, when Rev Slider plugin is installed
       *
       * @return array
       * @since 1.0
       *
       */
		static function option_revslider_headermedia_buttons() {

      		if ( class_exists('RevSliderAdmin')) {
				$return = array(
							'nomedia'       => 'Skin Color',
							'featuredimage' => 'Featured Image',
							'otherimage'    => 'Other Image',
							'slider'        => 'Slider',
							'revslider'     => 'Revolution Slider',
							'localvideo'    => 'Local video',
							'googlemap'     => 'Map',
							);		
			} else { 

				$return = array(
							'nomedia'       => 'Skin Color',
							'featuredimage' => 'Featured Image',
							'otherimage'    => 'Other Image',
							'slider'        => 'Slider',
							'localvideo'    => 'Local video',
							'googlemap'     => 'Map',
							);		
			}

			return $return;
 		}

      /** 
       * Echoes a notice, if this is a static blog posts page
       *
       * @return array
       * @since 1.0
       *
       */
		static function staticblogpage_notice(){

			$postid = isset( $_GET['post'] ) && is_numeric( $_GET['post'] )  ? $_GET['post'] : NULL;
			global $current_user ;
			$user_id = $current_user->ID;
			$page_for_posts = class_exists('Plethora_CMS') ? Plethora_CMS::get_option('page_for_posts') : get_option('page_for_posts');
			if ( $postid == $page_for_posts && ! get_user_meta($user_id, 'staticblogpage_ignorenotice')  ) {  

		        echo '<div class="update-nag">'; 
		        echo '<h3>'. __('This is important!', 'cleanstart') .'</h3>';
		        echo '<p>'. __('This is the static <strong>Posts page</strong>, or let\'s simply say that this is your blog page!. Here are all the blog settings you need!', 'cleanstart');
				echo '<br/>'. __('However, if you plan to change your static Posts page frequently (!), we advise you to set up first the default blog settings on: ', 'cleanstart') ;
		        echo '<ul><li><strong><a href="'. admin_url('admin.php?page='. THEME_OPTIONSPAGE .'&tab=4' ) .'" target="_blank">'. __('Theme Settings > Blog', 'cleanstart') .'</a></strong></li><li><strong><a href="'. admin_url('admin.php?page='. THEME_OPTIONSPAGE .'&tab=3' ) .'" target="_blank">'. __('Theme Settings > Head Panel > Blog Pages', 'cleanstart') .'</a></strong></li></ul>';
				echo  __('By doing so, every time you change your static Posts page, most of your settings will follow!', 'cleanstart') .'<br/><br/>' ;
		        printf( '<a href="%1$s">'. __('Hide This GIANT Notice Please!', 'cleanstart') .'</a>', '?post='. $postid .'&action=edit&staticblogpage_ignorenotice=1');
		        echo "</p></div>";

			}
		}

       /** 
       * Set notice to be ignored from the specific user, meaning that he had already dismissed it
       *
       * @return array
       * @since 1.0
       *
       */

		static function staticblogpage_ignorenotice(){

			$postid = isset( $_GET['post'] ) && is_numeric( $_GET['post'] )  ? $_GET['post'] : NULL;
			global $current_user ;
			$user_id = $current_user->ID;

			$page_for_posts = class_exists('Plethora_CMS') ? Plethora_CMS::get_option('page_for_posts') : get_option('page_for_posts');
			if ( $postid == $page_for_posts && (isset($_GET['staticblogpage_ignorenotice']) && $_GET['staticblogpage_ignorenotice'] == 1) ) {  

            	add_user_meta( $user_id, 'staticblogpage_ignorenotice', 'true', true);

			}
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
              'options_title' => 'Metabox // Post Options',
              'options_subtitle' => 'Activate/deactivate page options metabox fields',
              'options_desc' => 'On deactivation, this metabox will not be available. CAREFULL, you should know what you are doing here!',
              'version' => '1.0',
            );
          
          return $feature_options;
       }


	}

endif;