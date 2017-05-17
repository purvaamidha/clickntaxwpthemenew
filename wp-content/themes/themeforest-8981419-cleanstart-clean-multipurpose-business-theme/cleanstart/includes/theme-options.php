<?php

if ( !class_exists( 'Plethora_Cleanstart_Options' ) ):

	class Plethora_Cleanstart_Options {

	    public $args        = array();
	    public $sections    = array();
	    public $theme;
	    public $ReduxFramework;


		public function __construct() { 

	        if (!class_exists('ReduxFramework')) {
	            return;
	        }

            add_action('init', array($this, 'initSettings'), 10);
		}

		public function initSettings() {

		// ARGUMENTS --> GENERAL CONFIGURATION
		    $this->setArguments();


		// HELP TABS CONFIGURATION
			$this->setHelpTabs();

		// SECTIONS CONFIGURATION
			$this->setSections();


	    if (!isset($this->args['opt_name'])) { // No errors please
	                return;
		}

		// CREATE THE THEME OPTIONS PAGE
			$this->ReduxFramework = new ReduxFramework($this->sections, $this->args);

		}
	    

		public function setArguments() {

			$theme = wp_get_theme(); // For use with some settings. Not necessary.

			$args = array();
			$args['opt_name']			= THEME_OPTVAR;				// Theme options name & the global variable in which data options are retrieved via code
			$args['display_name']	    = THEME_DISPLAYNAME;		// Set the title appearing at the top of the options panel 
			$args['display_version']	= 'ver.'. THEME_VERSION ;	// Set the version number that appears after the title at the top of the options panel.
			$args['menu_type']			= 'menu';					// Set whether or not the admin menu is displayed.  Accepts either menu (default) or submenu.
			$args['allow_sub_menu']		= true;						// Enable/disable labels display below the admin menu
			$args['menu_title']			= THEME_OPTIONSPAGEMENU; // Set the WP admin menu title 
			$args['page_title']		    = THEME_OPTIONSPAGETITLE ; // Set the WP admin page title (appearing on browsers page title)
	        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth to generate a Google API key to use this feature.
			$args['google_api_key']  	= 'AIzaSyAhCFO56k_xL212g8j2LK88wK0I_CRwzDE';	// Set an API key for Google Webfonts usage (more on: https://developers.google.com/fonts/docs/developer_api)
			$args['google_update_weekly'] = false;					// In case this is set to true, you HAVE to set your own private API key...I suppose that you don't want your website fail to display its fonts!  (more on: https://developers.google.com/fonts/docs/developer_api)
			$args['async_typography']  	= false;                    // Use a asynchronous font on the front end or font string
			$args['admin_bar']			= true;						// Enable/disable Plethora settings menu on admin bar
			$args['dev_mode']			= false;					// Enable/disable Dev Tab (view class settings / info in panel)
			$args['customizer']			= true;						// Enable/disable basic WordPress customizer support
			// $args['open_expanded']		= true;						// Allow you to start the panel in an expanded way initially.
			// $args['disable_save_warn']	= true;						// Disable the save warning when a user changes a field

		// ARGUMENTS --> EXTRA FEATURES
			$args['page_priority']		= '110'; 						// Set the order number specifying where the menu will appear in the admin area
			$args['page_parent']		= ''; 						// Set where the options menu will be placed on the WordPress admin sidebar. For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
			$args['page_permissions']	= 'manage_options';			// Set the permission level required to access the options panel.  For a complete list of roles and capabilities, please visit this page:  https://codex.wordpress.org/Roles_and_Capabilities
			$args['menu_icon']			= THEME_ASSETS_URI .'/images/plethora20x20.png'; 						// Set the WP admin menu icon 
			$args['last_tab']			= '0';						// Set the default tab to open when the page is loaded
			$args['page_icon']			= 'icon-themes';			// Set the icon appearing in the admin panel, next to the menu title
			$args['page_slug']			= THEME_OPTIONSPAGE;		// Set the page slug (i.e. wp-admin/themes.php?page=plethora_settings)
			$args['save_defaults']		= true;						// Set whether or not the default values are saved to the database on load, before Save Changes is clicked
			$args['default_show']		= false;					// Enable/disable default value display by the field title.
			$args['default_mark']		= '*';						// Setup symbol to be displayed on default valued fields (e.g an asterisk *)
			$args['show_import_export']	= true;						// Enable/disable Import/Export Tab


		// ARGUMENTS --> ADVANCED FEATURES
			$args['transient_time']		= 60 * MINUTE_IN_SECONDS;	// Set the amount of time to assign to transient values used.
			$args['output']				= true;						// Enable/disable dynamic CSS output. When set to false, Google fonts are also disabled
	        $args['output_tag'] 		= true;                     // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
			$args['footer_credit']		= __('Plethora Theme Options panel. Based on Redux Framework', 'cleanstart');						// Set the text to be displayed at the bottom of the options panel, in the footer across from the WordPress version (where it normally says 'Thank you for creating with WordPress') (HTML is allowed)


		// ARGUMENTS --> FUTURE ( Not in use yet, but reserved or partially implemented. Use at your own risk. )
			// $args['database']			= '';						// possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
			// $args['system_info']		= false;					// Remove

			
		// ARGUMENTS --> PLETHORA SOCIAL ICONS (displayed in footer)

			$args['share_icons']['twitter']   = array( 'link' => 'https://twitter.com/plethorathemes', 'title' => __('Follow me on Twitter', 'cleanstart'), 'img' => THEME_CORE_ASSETS_URI.'/redux/social/Twitter.png' );
			$args['share_icons']['facebook']  = array( 'link' => 'https://www.facebook.com/plethorathemes', 'title' => __('Find me on Facebook', 'cleanstart'), 'img' => THEME_CORE_ASSETS_URI.'/redux/social/Facebook.png' );
			$args['share_icons']['youtube']	  = array( 'link' => 'https://www.youtube.com/channel/UCRk3LXfZj7CpEwTjaI0BLDQ', 'title' => __('Watch us on YouTube', 'cleanstart'), 'img' => THEME_CORE_ASSETS_URI.'/redux/social/YouTube.png' );

		// ARGUMENTS --> HELP FEATURES CONFIGURATION
			// Wordpress Help Panel features
			$args['hints']				= array(
	                    'icon'          => 'icon-question-sign',
	                    'icon_position' => 'right',
	                    'icon_color'    => '#D7B574',
	                    'icon_size'     => 'normal',
	                    'tip_style'     => array(
	                        'color'         => 'light',
	                        'shadow'        => true,
	                        'rounded'       => false,
	                        'style'         => 'bootstrap',
	                    ),
	                    'tip_position'  => array(
	                        'my' => 'bottom right',
	                        'at' => 'top left',
	                    ),
	                    'tip_effect'    => array(
	                        'show'          => array(
	                            'effect'        => 'fade',
	                            'duration'      => '50',
	                            'event'         => 'mouseover',
	                        ),
	                        'hide'      => array(
	                            'effect'    => 'fade',
	                            'duration'  => '50',
	                            'event'     => 'click mouseleave',
	                        ),
	                    ),
	                );

			$this->args = $args;
				
		}


	    public function setHelpTabs() {

	        // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
	        $this->args['help_tabs'][] = array(
	            'id'        => 'redux-help-tab-1',
	            'title'     => __('Theme Information 1', 'cleanstart'),
	            'content'   => '<p>'. __('This is the tab content, HTML is allowed.', 'cleanstart') .'</p>'
	        );

	        $this->args['help_tabs'][] = array(
	            'id'        => 'redux-help-tab-2',
	            'title'     => __('Theme Information 2', 'cleanstart'),
	            'content'   => '<p>'.__('This is the tab content, HTML is allowed.', 'cleanstart') .'</p>'
	        );

	        // Set the help sidebar
	        $this->args['help_sidebar'] = '<p>'.__('This is the sidebar content, HTML is allowed.', 'cleanstart') .'</p>';
	    }

		public function setSections() {

		// SECTIONS CONFIGURATION
			$sections = array();              
			$sections[] = $this->section_general();		// General section options
			$sections[] = $this->section_header();		// head panel options
			$sections[] = $this->section_footer();		// Footer section options
			$sections[] = $this->section_headpanel();	// Head panel options
			$sections[] = $this->section_posts();		// Posts section options
			$sections[] = $this->section_pages();		// Pages section options
			$sections[] = $this->section_portfolio();	// Portfolio section options
			$sections[] = $this->section_404();			// 404 page section options
			$sections[] = $this->section_slider();		// Slider section options
			$sections[] = $this->section_social();		// Social section options
	    	if ( has_filter( 'plethora_themeoptions_thirdparty') ) {

				$sections = apply_filters( 'plethora_themeoptions_thirdparty', $sections );
			
			}
			$sections[] = $this->section_advanced();	// Advanced section options

			$this->sections = $sections;

		}


	    function section_general() { 

			$return = array(
				'title'      => __('General', 'cleanstart'),
				'header'     => __('Style & typography options applied globally', 'cleanstart'),
				'icon_class' => 'icon-large',
				'icon'       => 'el-icon-home-alt',
				'fields'     => array(
					array(
							'id'    =>'section-body',
							'type'  => 'info',
							'title' => '<center>'. __('General > Global Colors & Typography', 'cleanstart') .'</center>'
				        ),
					array(
						'id'          =>'body-backround',
						'type'        => 'color',
						'title'       => __('Body Background Color', 'cleanstart'), 
						'subtitle'    => __('default: #EFEFEF.', 'cleanstart'),
						'default'     => '#EFEFEF',
						'transparent' => false,
						'validate'    => 'color',
						),
					//
					array(
						'id'          =>'skin-color',
						'type'        => 'color',
						'title'       => __('Skin Color', 'cleanstart'), 
						'subtitle'    => __('default: #428BCA.', 'cleanstart'),
						'default'     => '#428BCA',
						'transparent' => false,
						'validate'    => 'color',
						),


					array(
						'id'          =>'body-text-color',
						'type'        => 'color',
						'title'       => __('Body Text Color', 'cleanstart'), 
						'subtitle'    => __('Affects text & headings color on body areas. default: #666666.', 'cleanstart'),
						'default'     => '#666666',
						'transparent' => false,
						'validate'    => 'color',
						),

					array(
						'id'          =>'body-link-color',
						'type'        => 'color',
						'title'       => __('Body Links Color', 'cleanstart'), 
						'subtitle'    => __('default: #428BCA.', 'cleanstart'),
						'default'     => '#428BCA',
						'transparent' => false,
						'validate'    => 'color',
						),

					array(
						'id'             =>'font-body',
						'type'           => 'typography', 
						'title'          => __('Body Text Typography', 'cleanstart'),
						'google'         =>true, 
						'font-style'     => false,
						'font-weight'    => false,
						'font-size'      => false,
						'line-height'    => false,
						'word-spacing'   => false,
						'letter-spacing' => false,
						'text-align'     => false,
						'text-transform' => false,
						'color'          => false,
						'subsets'        =>true,
						'preview'        =>true, 
						'all_styles'     => true, // import all google font weights
						'default'        => array( 'font-family'=>'Open Sans' )
						),	

					array(
					    'id'       => 'font-body-size',
					    'type'     => 'spinner',
					    'title'    => __('Body Text Font Size', 'cleanstart'),
					    'subtitle' => __('default:14'),
					    'desc'     => __('Font size in pixels', 'cleanstart'),
					    'default'  => '14',
					    'min'      => '4',
					    'step'     => '1',
					    'max'      => '36',
					),
					array(
						'id'             =>'font-headers',
						'type'           => 'typography', 
						'title'          => __('Navigation & Headings Text Typography', 'cleanstart'),
						'google'         =>true, 
						'font-style'     => false,
						'font-weight'    => false,
						'font-size'      => false,
						'line-height'    => false,
						'word-spacing'   => false,
						'letter-spacing' => false,
						'text-align'     => false,
						'text-transform' => false,
						'color'          => false,
						'subsets'        =>true,
						'preview'        =>true, 
						'all_styles'     => true, // import all google font weights
						'default'        => array( 'font-family'=>'Raleway' )
						),	

					array(
						'id'       => 'font-headers-transform',
						'type'     => 'select',
						'title'    => __('Headings Text Transform', 'cleanstart'), 
						'options'  => array('none' => __('None', 'cleanstart'), 'uppercase' => __('Uppercase', 'cleanstart')), //Must provide key => value pairs for radio options
						'default'  => 'uppercase'
						),

					array(
						'id'       => 'font-buttons-transform',
						'type'     => 'select',
						'title'    => __('Buttons Text Tranform', 'cleanstart'), 
						'options'  => array('none' => __('None', 'cleanstart'), 'uppercase' => __('Uppercase', 'cleanstart')), //Must provide key => value pairs for radio options
						'default'  => 'uppercase'
						),

					array(
							'id'    =>'section-skin',
							'type'  => 'info',
							'title' => '<center>'. __('General > Skin Coloured Sections', 'cleanstart') .'</center>'
				        ),
					//
					array(
						'id'          =>'skin-text-color',
						'type'        => 'color',
						'title'       => __('Skin Sections Text Color', 'cleanstart'), 
						'subtitle'    => __('default: #ffffff.', 'cleanstart'),
						'default'     => '#ffffff',
						'transparent' => false,
						'validate'    => 'color',
						),

					//
					array(
						'id'          =>'skin-link-color',
						'type'        => 'color',
						'title'       => __('Skin Sections Link Color', 'cleanstart'), 
						'subtitle'    => __('default: #FFFF00.', 'cleanstart'),
						'default'     => '#FFFF00',
						'transparent' => false,
						'validate'    => 'color',
						),

					array(
							'id'    =>'section-dark',
							'type'  => 'info',
							'title' => '<center>'. __('General > Dark Coloured Sections', 'cleanstart') .'</center>'
				        ),

					//
					array(
						'id'          =>'darksection-bgcolor',
						'type'        => 'color',
						'title'       => __('Dark Sections Background Color', 'cleanstart'), 
						'subtitle'    => __('default: #222222', 'cleanstart'),
						'default'     => '#222222',
						'transparent' => false,
						'validate'    => 'color',
						),

					//
					array(
						'id'          =>'darksection-text-color',
						'type'        => 'color',
						'title'       => __('Dark Sections Text Color', 'cleanstart'), 
						'subtitle'    => __('default: #cccccc.', 'cleanstart'),
						'default'     => '#cccccc',
						'transparent' => false,
						'validate'    => 'color',
						),

					//
					array(
						'id'          =>'darksection-link-color',
						'type'        => 'color',
						'title'       => __('Dark Sections Link Color', 'cleanstart'), 
						'subtitle'    => __('default: #428BCA.', 'cleanstart'),
						'default'     => '#428BCA',
						'transparent' => false,
						'validate'    => 'color',
						),

					/*** SETTINGS > GENERAL > FAVICON & SPECIAL ICONS ***/

					array(
							'id'    =>'general-favicons',
							'type'  => 'info',
							'title' => '<center>'. __('General > Favicon & Special Icons', 'cleanstart') .'</center>'
				        ),

					array(
						'id'       =>'favicon',
						'type'     => 'media', 
						'title'    => __('Favicon', 'cleanstart'),
						'url'      => true,
						'subtitle' => __('Upload a 16px X 16px .png or .gif image', 'cleanstart'),
						'default'  =>array('url'=> ''. THEME_ASSETS_URI .'/images/icons/favicon.png'),
						),

					array(
						'id'       =>'icon-retina57',
						'type'     => 'media', 
						'title'    => __('iPad/iPhone Retina Icon', 'cleanstart'),
						'url'      => true,
						'subtitle' => __('Upload a 57px X 57px .png or .gif image', 'cleanstart'),
						'default'  =>array('url'=> ''. THEME_ASSETS_URI .'/images/icons/apple-touch-icon-57x57-precomposed.png'),
						),

					array(
						'id'       =>'icon-retina72',
						'type'     => 'media', 
						'title'    => __('iPad/iPhone Retina Icon', 'cleanstart'),
						'url'      => true,
						'subtitle' => __('Upload a 72px x 72px .png or .gif image', 'cleanstart'),
						'default'  =>array('url'=> ''. THEME_ASSETS_URI .'/images/icons/apple-touch-icon-72x72-precomposed.png'),
						),

					array(
						'id'       =>'icon-retina114',
						'type'     => 'media', 
						'title'    => __('iPad/iPhone Retina Icon', 'cleanstart'),
						'subtitle' => __('Upload a 114px x 114px .png or .gif image', 'cleanstart'),
						'url'      => true,
						'default'  =>array('url'=> ''. THEME_ASSETS_URI .'/images/icons/apple-touch-icon-114x114-precomposed.png'),
						),

					/*** SETTINGS > GENERAL > MISCELLANEOUS ***/

					array(
							'id'    =>'general-misc',
							'type'  => 'info',
							'title' => '<center>'. __('General > Miscellaneous', 'cleanstart') .'</center>'
				        ),

					array(
						'id'      =>'customizevc-status',
						'type'    => 'switch', 
						'title'   => __('Visual Composer Customization', 'cleanstart'),
						'desc'    => __('Cleanstart is affecting the way Visual Composer elaborates with rows & columns. You may want to disable this, but have in mind that this will affect many theme features\' displays', 'cleanstart'),
						"default" => 1,
						'on'      => 'On',
						'off'     => 'Off',
						),	

					array(
						'id'      =>'backtotop-status',
						'type'    => 'switch', 
						'title'   => __('Back to top ', 'cleanstart'),
						"default" => 1,
						'on'      => 'On',
						'off'     => 'Off',
						),	

					array(
						'id'      => 'font-text-rotator-speed',
						'type'    => 'spinner', 
						'title'   => __('TextRotator Animation Speed', 'cleanstart'),
						'desc'    => __('Set the speed for the TextRotator effect, in MILLIseconds', 'cleanstart'),
						"default" => "6000",
						"min"     => "100",
						"step"    => "100",
						"max"     => "100000",
						),	

					/*** TEXT SHADOWS ON CAPTIONS, NEWSLETTER & CALL TO ACTION [v1.3] ***/

					array(
						'id'      =>'text-shadows',
						'type'    => 'switch', 
						'title'   => __('Text Shadows', 'cleanstart'),
						'desc'    => __('Affects text shadows on: head panel | call to action shortcode | newsletter form shortcode', 'cleanstart'),
						"default" => 0,
						'on'      => 'On',
						'off'     => 'Off',
						),	

					)

				);
			return $return;

	    }

	    function section_header() { 

	    	$return = array(
				'title'      => __('Header', 'cleanstart'),
				'icon'       => 'el-icon-circle-arrow-up',
				'icon_class' => 'icon-large',
				'fields'     => array(
					array(
							'id'    =>'section-header-color',
							'type'  => 'info',
							'title' => '<center>'. __('Header // Colors & Typography', 'cleanstart') .'</center>'
				        ),

					array(
						'id'          =>'header-background',
						'type'        => 'color',
						'title'       => __('Header Background Color', 'cleanstart'), 
						'subtitle'    => __('default: #EFEFEF.', 'cleanstart'),
						'default'     => '#EFEFEF',
						'transparent' => false,
						'validate'    => 'color',
						),

					array(
						'id'          =>'header-background-transparency',
						'type'        => 'slider',
						'title'       => __('Header Background Transparency', 'cleanstart'), 
						'subtitle'    => __('default: 100', 'cleanstart'),
					    "default" => 100,
					    "min" => 0,
					    "step" => 1,
					    "max" => 100,
					    'display_value' => 'text'
						),
					// // Just for trials...should be removed in not used
					// array(
					// 	'id'          =>'header-text-color',
					// 	'type'        => 'color',
					// 	'title'       => __('Header Text Color', 'cleanstart'), 
					// 	'subtitle'    => __('default: #555555.', 'cleanstart'),
					// 	'default'     => '#555555',
					// 	'transparent' => false,
					// 	'validate'    => 'color',
					// 	),
					array(
						'id'          =>'header-link-color',
						'type'        => 'link_color',
						'title'       => __('Header Link Color', 'cleanstart'), 
						'subtitle'    => __('default: #555555 / #428BCA.', 'cleanstart'),
						'visited'	=> false,
						'active'	=> false,
						'default'  => array(
									        'regular'  => '#555555',
									        'hover'    => '#428BCA',
									    ),
						'validate'    => 'color',
						),

					array(
							'id'    =>'section-featured',
							'type'  => 'info',
							'title' => '<center>'. __('Header // Layout & Display', 'cleanstart') .'</center>'
				        ),
					array(
						'id'       => PLETHORA_META_PREFIX .'header-layout',
						'type'     => 'select',
						'title'    => __('Header layout', 'cleanstart'), 
						'subtitle' => __('Can be overriden on page/post settings', 'cleanstart'),
						'options'  => array('classic' => __('Classic ( logo on the left / menu on the right )', 'cleanstart'), 'centered' => __('Centered ( logo & menu centered )', 'cleanstart')),//Must provide key => value pairs for radio options
						'default'  => 'classic'
						),
					array(
						'id'      => PLETHORA_META_PREFIX .'header-sticky',
						'type'    => 'switch', 
						'title'   => __('Sticky Header', 'cleanstart'),
						"default" => 1,
					),	
					array(
						'id'       => PLETHORA_META_PREFIX .'header-triangles',
						'type'     => 'button_set', 
						'title'    => __('Side Corners', 'cleanstart'),
						'subtitle' => __('Can be overriden on page/post settings', 'cleanstart'),
						'default'  => 'display',
						'options'  => array(
								'display' => __('Display', 'cleanstart'),
								'hide'    => __('Hide', 'cleanstart'),
								),
						),	
					array(
							'id'    =>'section-header-general',
							'type'  => 'info',
							'title' => '<center>'. __('Header // Logo', 'cleanstart') .'</center>'
				        ),
					array(
						'id'      => PLETHORA_META_PREFIX .'header-logo-type',
						'type'    => 'select',
						'title'   => __('Logo layout', 'cleanstart'), 
						'options' => array('1' => __('Image only', 'cleanstart'), '2' => __('Image + Title', 'cleanstart'), '5' => __('Title only', 'cleanstart')), 
						'default' => '2'
						),
					array(
						'id'       =>'header-logo-img',
						'type'     => 'media', 
						'required' => array( PLETHORA_META_PREFIX .'header-logo-type','=',array('1', '2')),	
						'url'      => true,			
						'title'    => __('Image', 'cleanstart'),
						'default'  =>array('url'=> ''. THEME_ASSETS_URI .'/images/cleanstart_logo.png'),
						),
					array(
						'id'       =>'header-logo-title',
						'type'     => 'text',
						'required' => array( PLETHORA_META_PREFIX .'header-logo-type','=', array('2', '5')),						
						'title'    => __('Title', 'cleanstart'),
						'default'  => 'Cleanstart'
						),
					array(
						'id'       =>'header-logo-container-size',
						'type'     => 'dimensions',
						'output'   =>array('.logo'),  // ???
						'units'    => array('px','em','%'),
						'title'    => __('Container size',  'cleanstart'),
						'subtitle' => __('default: 290 x 30 px', 'cleanstart'),
						'default'  => array('width' => '290', 'height'=>'30', 'units'=>'px')
						),												
					array(
						'id'       =>'header-logo-container-padding',
						'type'     => 'spacing',
						'output'   => array('.logo'),
						'mode'     =>'padding', 
						'title'    => __('Container padding', 'cleanstart'),
						'subtitle' => __('Top | Right | Bottom | Left', 'cleanstart'),
						'units'    => array('px','em','%'),
						'default'  => array('padding-top' => 0, 'padding-bottom' => 0, 'padding-left'=>0, 'padding-right'=>0, 'units'=>'px')
						),	
					array(
						'id'       =>'header-logo-container-margin',
						'type'     => 'spacing',
						'output'   => array('.logo'),
						'mode'     =>'margin', 
						'title'    => __('Container margin', 'cleanstart'),
						'subtitle' => __('Top | Right | Bottom | Left', 'cleanstart'),
						'units'    => array('px','em','%'),
						'default'  => array('margin-top' => 33, 'margin-bottom' => 0, 'margin-left'=>0, 'margin-right'=>0, 'units'=>'px')
						),	
					array(
						'id'       =>'header-logo-img-size',
						'type'     => 'dimensions', 
						'required' => array( PLETHORA_META_PREFIX .'header-logo-type','=',array('1', '2', '3')),						
						'output'   =>array('.logo a.brand img'), 
						'units'    => array('px','em','%'),
						'title'    => __('Image size', 'cleanstart'),
						'subtitle' => __('default: 38 x 26 px', 'cleanstart'),
						'default'  => array('width' => '38', 'height'=>'26', 'units'=>'px')
						),
					array(
						'id'       =>'header-logo-img-margin',
						'type'     => 'spacing', 
						'mode'           => 'margin',
						'required' => array( PLETHORA_META_PREFIX .'header-logo-type','=',array('1', '2', '3')),						
						'output'   =>array('.logo a.brand img'), 
						'units'    => array('px','em','%'),
						'title'    => __('Image margin', 'cleanstart'),
						'subtitle' => __('default: 2|8|2|0', 'cleanstart'),
					    'default'            => array(
					        'margin-top'     => '2px',
					        'margin-right'   => '4px',
					        'margin-bottom'  => '2px',
					        'margin-left'    => '0',
					        'units'          => 'px',
					    	)
						),
					array(
						'id'        =>'header-logo-title-size',
						'type'      => 'dimensions', 
						'required'  => array( PLETHORA_META_PREFIX .'header-logo-type','=', array('2', '5')),						
						'title'     => __('Title container size', 'cleanstart'),
						'output' =>array('.logo a.brand span.logo_title'), 
						'subtitle'  => __('default: auto / auto', 'cleanstart'),
						'units'     => array('px','em','%'),
						'default'   => array('width' => 'auto', 'height'=>'auto', 'units'=>'px')
						),
					array(
						'id'       =>'header-logo-title-padding',
						'type'     => 'spacing', 
						'mode'	   => 'padding',
						'required' => array( PLETHORA_META_PREFIX .'header-logo-type','=', array('2', '5')),						
						'output'   =>array('.logo a.brand span.logo_title'), 
						'units'    => array('px','em','%'),
						'title'    => __('Title container padding', 'cleanstart'),
						'subtitle' => __('default: 0|0|0|0', 'cleanstart'),
					    'default'            => array(
					        'padding-top'     => '0',
					        'padding-right'   => '0',
					        'padding-bottom'  => '0',
					        'padding-left'    => '0',
					        'padding'          => 'px',
					    	)
						),

					array(
							'id'    =>'section-header-toolbar',
							'type'  => 'info',
							'title' => '<center>'. __('Header // Top Toolbar', 'cleanstart') .'</center>'
				        ),
					array(
						'id'       => PLETHORA_META_PREFIX .'header-toolbar',
						'type'     => 'switch', 
						'title'    => __('Top toolbar', 'cleanstart'),
						'subtitle' => __('Can be overriden on page/post settings', 'cleanstart'),
						"default"  => 0,
						'on'       => __('Display', 'cleanstart') ,
						'off'      => __('Hide', 'cleanstart'),
						),
					array(
						'id'       => PLETHORA_META_PREFIX .'header-toolbar-layout',
						'type'     => 'select',
						'required' => array( PLETHORA_META_PREFIX .'header-toolbar','=','1'),						
						'title'    => __('Top toolbar layout', 'cleanstart'), 
						'subtitle' => __('Can be overriden on page/post settings', 'cleanstart'),
						'default'  => '1',
						'options'  => array(
							'1' => __('Menu | Custom Text', 'cleanstart'), 
							'2' => __('Custom Text | Menu', 'cleanstart'), 
							'3' => __('Custom Text Only', 'cleanstart'), 
							)
						),
					array(
						'id'           => PLETHORA_META_PREFIX .'header-toolbar-html',
						'type'         => 'textarea',
						'required'     => array( PLETHORA_META_PREFIX .'header-toolbar','=','1'),						
						'title'        => __('Top toolbar custom text', 'cleanstart'), 
						'subtitle'     => __('Can be overriden on page/post settings', 'cleanstart'),
						'desc'         => __('HTML tags allowed', 'cleanstart'),
						'default'      => __('Call Us Toll Free! +555 959595959', 'cleanstart'),
						),
					array( 
						'id'          => PLETHORA_META_PREFIX .'header-toolbar-langswitcher',
						'type'        => 'switch', 
						'required'    => array( PLETHORA_META_PREFIX .'header-toolbar','=','1'),						
						'title'       => __('Language switcher', 'cleanstart'),
						'subtitle'    => __('Can be overriden on page/post settings', 'cleanstart'),
						'description' => __('Displayed on the right side ( WPML must be installed & activated ).', 'cleanstart') ,
						"default"     => 1,
						'on'          => __('Display', 'cleanstart'),
						'off'         => __('Hide', 'cleanstart'),
						),

					array(
						'id'          => PLETHORA_META_PREFIX .'header-toolbar-bgcolor',
						'type'        => 'color',
						'required' => array( PLETHORA_META_PREFIX .'header-toolbar','=','1'),						
						'title'       => __('Toolbar Background Color', 'cleanstart'), 
						'subtitle'    => __('default: #EFEFEF', 'cleanstart'),
						'default'     => '#EFEFEF',
						'transparent' => false,
						'validate'    => 'color',
						),

					//
					array(
						'id'          => PLETHORA_META_PREFIX .'header-toolbar-text-color',
						'type'        => 'color',
						'required' => array( PLETHORA_META_PREFIX .'header-toolbar','=','1'),						
						'title'       => __('Toolbar Text Color', 'cleanstart'), 
						'subtitle'    => __('default: #555555.', 'cleanstart'),
						'default'     => '#555555',
						'transparent' => false,
						'validate'    => 'color',
						),

					//
					array(
						'id'          => PLETHORA_META_PREFIX .'header-toolbar-link-color',
						'type'        => 'color',
						'required' => array( PLETHORA_META_PREFIX .'header-toolbar','=','1'),						
						'title'       => __('Toolbar Link Color', 'cleanstart'), 
						'subtitle'    => __('default: #555555.', 'cleanstart'),
						'default'     => '#555555',
						'transparent' => false,
						'validate'    => 'color',
						),



					)
				);
			return $return;
	    }

	    function section_headpanel() { 

			$return = array(
				'title'      => __('Head Panel', 'cleanstart'),
				'icon_class' => 'icon-large',
				'icon'       => 'el-icon-website',
				'fields'     => array(
					array(
							'id'       =>'section-headpanel-general',
							'type'     => 'info',
							'title'    => '<center>'. __('Head Panel // General', 'cleanstart') .'</center>',
							'subtitle' => '<center><small>'.__('Default behavior options. Affects head panel displays on ALL pages/posts etc.', 'cleanstart') .'</small></center>',
				        ),
					array(
						'id'            => PLETHORA_META_PREFIX .'header-media',
						'type'          => 'button_set',
						'title'         => __('Background Type', 'cleanstart'),
						'default'       => 'nomedia',
						'options'       => array(
							'nomedia'       => __('Skin Color', 'cleanstart'),
							'featuredimage' => __('Featured Image', 'cleanstart'),
							'otherimage'    => __('Other Image', 'cleanstart'),
							'slider'        => __('Slider', 'cleanstart'),
							'localvideo'    => __('Local video', 'cleanstart'),
							'googlemap'     => __('Map', 'cleanstart'),
							)
						),

					array(
						'id'       => PLETHORA_META_PREFIX .'header-media-dimensions',
						'type'     => 'dimensions',
						'required' => array( PLETHORA_META_PREFIX .'header-media','equals', array('featuredimage', 'otherimage', 'localvideo', 'googlemap')),						
						'width'    => false,
						'title'    => __('Panel Height', 'cleanstart'),
						'desc' 	   => __('Applied only on image, video and map backgrounds. Suggested height: 480px.', 'cleanstart'),
						'default'  => array('height' => 480 )
						),			
					array(
						'id'      => PLETHORA_META_PREFIX .'header-media-nomediadimensions',
						'type'    => 'dimensions',
						'required' => array( PLETHORA_META_PREFIX .'header-media','equals', array('nomedia')),						
						'width'   => false,
						'title'   => __('Panel Height / Skin Color', 'cleanstart'),
						'desc' 	   => __('Applied only on skincolored background. Suggested height: 265px.', 'cleanstart'),
						'default' => array('height' => 265 )
						),			

					array(
						'id'      => PLETHORA_META_PREFIX .'header-slider-dimensions',
						'type'    => 'dimensions',
						'width'   => false,
						'title'   => __('Panel Height ( Slider only )', 'cleanstart'),
						'desc' 	   => __('NOTICE: this is a global setting, cannot be overriden on post/page/portfolio settings. Suggested height: 580px.', 'cleanstart'),
						'default' => array('height' => '580px', 'units' => 'px' )
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
						'default'        => array(
								'text-align' => 'left',
							)
						),	

					array(
							'id'       =>'section-headpanel-pages',
							'type'     => 'info',
							'title'    => '<center>'. __('Head Panel // Pages', 'cleanstart') .'</center>',
							'subtitle' => '<center><small>'. __('Default options for single pages. Can be overriden on page settings', 'cleanstart') .'</small></center>',
				        ),
					array(
						'id'       => PLETHORA_META_PREFIX .'header-title-type-page',
						'type'     => 'button_set', 
						'title'    => __('Title / Subtitle Behaviour', 'cleanstart'),
						'default'  => 'posttitle',
						'options'  => array(
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
						'default'  => 'This is the default page custom title',
						),
					array(
						'id'       => PLETHORA_META_PREFIX .'header-customsubtitle-page',
						'required' => array( PLETHORA_META_PREFIX .'header-title-type-page','=', array('posttitle','customtitle' )),
						'type'     => 'text', 
						'title'    => __('Subtitle Text // Custom', 'cleanstart'),
						'default'  => 'This is the default page custom subtitle',
						),
					array(
							'id'       =>'section-headpanel-posts',
							'type'     => 'info',
							'title'    => '<center>'. __('Head Panel // Posts', 'cleanstart') .'</center>',
							'subtitle' => '<center><small>'.__('Default options for single posts. Can be overriden on post settings', 'cleanstart') .'</small></center>',
				        ),
					array(
						'id'       => PLETHORA_META_PREFIX .'header-title-type-post',
						'type'     => 'button_set', 
						'title'    => __('Title / Subtitle Behaviour', 'cleanstart'),
						'default'  => 'blogtitle',
						'options'  => array(
								'blogtitle'   => __('Blog Title / Subtitle', 'cleanstart'),
								'posttitle'   => __('Post Title / Custom Subtitle', 'cleanstart'),
								'customtitle' => __('Custom Title / Subtitle', 'cleanstart'),
								'notitle'     => __('No Title / Subtitle', 'cleanstart')
							),
						),
					array(
						'id'       => PLETHORA_META_PREFIX .'header-customtitle-post',
						'type'     => 'text', 
						'required' => array( PLETHORA_META_PREFIX .'header-title-type-post','=', array('customtitle')),
						'title'    => __('Title Text // Custom', 'cleanstart'),
						'default'  => __('This is the default single post custom title', 'cleanstart'),
						),
					array(
						'id'       => PLETHORA_META_PREFIX .'header-customsubtitle-post',
						'required' => array( PLETHORA_META_PREFIX .'header-title-type-post','=', array('posttitle','customtitle' )),
						'type'     => 'text', 
						'title'    => __('Subtitle Text // Custom', 'cleanstart'),
						'default'  => __('This is the default single post custom subtitle', 'cleanstart'),
						),
					array(
							'id'       =>'section-headpanel-portfolio',
							'type'     => 'info',
							'title'    => '<center>'. __('Head Panel // Portfolio Posts', 'cleanstart') .'</center>',
							'subtitle' => '<center><small>'. __('Default options for single portfolio posts. Can be overriden on portfolio post settings', 'cleanstart') .'</small></center>',
				        ),
					array(
						'id'       => PLETHORA_META_PREFIX .'header-title-type-portfolio',
						'type'     => 'button_set', 
						'title'    => __('Title / Subtitle Behaviour', 'cleanstart'),
						'default'  => 'customtitle',
						'options'  => array(
								'posttitle'   => __('Portfolio Title/ Custom Subtitle', 'cleanstart'),
								'customtitle' => __('Custom Title / Subtitle', 'cleanstart'),
								'notitle'     => __('No Title / Subtitle', 'cleanstart')
							),
						),
					array(
						'id'       => PLETHORA_META_PREFIX .'header-customtitle-portfolio',
						'type'     => 'text', 
						'required' => array( PLETHORA_META_PREFIX .'header-title-type-portfolio','=', array('customtitle')),
						'title'    => __('Title Text // Custom', 'cleanstart'),
						'default'  => __('This is the default portfolio custom title', 'cleanstart'),
						),
					array(
						'id'       => PLETHORA_META_PREFIX .'header-customsubtitle-portfolio',
						'required' => array( PLETHORA_META_PREFIX .'header-title-type-portfolio','=', array('posttitle','customtitle' )),
						'type'     => 'text', 
						'title'    => __('Subtitle Text // Custom', 'cleanstart'),
						'default'  => __('This is the default portfolio custom subtitle', 'cleanstart'),
						),
					array(
							'id'       =>'section-headpanel-blog',
							'type'     => 'info',
							'title'    => '<center>'. __('Head Panel // Blog Pages', 'cleanstart') .'</center>',
							'subtitle' => '<center><small>'. __('Default options for blog pages  ( posts list | search | categories | tags | dates | authors )', 'cleanstart') .'</small></center>'
				        ),
					array(
						'id'      =>'blog-header-title',
						'type'    => 'text', 
						'title'   => __('Title Text', 'cleanstart'),
						"default" => __('This is the default blog title', 'cleanstart'),
					),	
					array(
						'id'      =>'blog-header-subtitle',
						'type'    => 'text', 
						'title'   => __('Subtitle Text', 'cleanstart'),
						"default" => __('This is the default blog subtitle.', 'cleanstart'),
						'desc'	  => __('Title & subititle can be different for categories, tags, dates, authors, etc!', 'cleanstart')
					),	
					array(
						'id'      =>'blog-header-title-cat',
						'type'    => 'text', 
						'title'   => __('Title Text Prefix // Category', 'cleanstart'),
						'desc'    => __('Will be displayed on the <strong>head panel title</strong>, right before the selected category name', 'cleanstart'),
						"default" => __('Category: ', 'cleanstart'),
					),	
					array(
						'id'      =>'blog-header-subtitle-cat',
						'type'    => 'button_set', 
						'title'   => __('Subtitle Text Source // Category', 'cleanstart'),
						'desc'    => __('Select the <strong>head panel subtitle</strong> behavior when a category is selected.<br/><small>Descriptions for each category can be set on <a href="'.  admin_url( 'edit-tags.php?taxonomy=category' ) .'"><strong>Posts > Categories</strong></a> menu</small>', 'cleanstart'),
						"default" => 'usedefault',
						'options' => array(
								'nosubtitle'     => __('No Subtitle', 'cleanstart'),
								'usedefault'     => __('Use Blog Subtitle', 'cleanstart'),
								'usedescription' => __('Use Selected Category Description', 'cleanstart'),
								'usecustom'      => __('Use Custom Subtitle', 'cleanstart'),
						)
					),	
					array(
						'id'       =>'blog-header-subtitle-cat-custom',
						'type'     => 'text', 
						'required' => array('blog-header-subtitle-cat','equals','usecustom'),						
						'title'    => __('Custom Subtitle // Category', 'cleanstart'),
						'desc'     => __('Will be displayed when any <strong>category</strong> is selected', 'cleanstart'),
						"default"  => __('This is the custom head panel subtitle text, displayed when any category is selected.', 'cleanstart'),
					),	
					array(
						'id'      =>'blog-header-title-tag',
						'type'    => 'text', 
						'title'   => __('Title Text Prefix // Tag', 'cleanstart'),
						'desc'    => __('Will be displayed right before the selected <strong>tag</strong> name', 'cleanstart'),
						"default" => 'Tag: ',
					),	
					array(
						'id'      =>'blog-header-subtitle-tag',
						'type'    => 'button_set', 
						'title'   => __('Subtitle Text Source // Tag', 'cleanstart'),
						'desc'    => __('Select the <strong>head panel subtitle</strong> behavior when a <strong>tag</strong> is selected.<br/><small>Descriptions for each tag can be set on <a href="'.  admin_url( 'edit-tags.php?taxonomy=post_tag' ) .'"><strong>Posts > Tags</strong></a> menu</small>', 'cleanstart'),
						"default" => 'usedefault',
						'options' => array(
								'nosubtitle'     => __('No Subtitle', 'cleanstart'),
								'usedefault'     => __('Use Blog Subtitle', 'cleanstart'),
								'usedescription' => __('Use Selected Tag Description', 'cleanstart'),
								'usecustom'      => __('Use Custom Subtitle', 'cleanstart'),
						)
					),	
					array(
						'id'       =>'blog-header-subtitle-tag-custom',
						'type'     => 'text', 
						'required' => array('blog-header-subtitle-tag','equals','usecustom'),						
						'title'    => __('Custom Subtitle // Tag', 'cleanstart'),
						'desc'     => __('Will be displayed  when a <strong>tag</strong> is selected', 'cleanstart'),
						"default"  => __('Will be displayed when a tag is selected', 'cleanstart'),
					),	
					array(
						'id'      =>'blog-header-title-date',
						'type'    => 'text', 
						'title'   => __('Title Prefix // Date', 'cleanstart'),
						'desc'    => __('This text will be displayed on the <strong>head panel title</strong>, right before the selected <strong>date range</strong>', 'cleanstart'),
						"default" => __('Date: ', 'cleanstart'),
					),	
					array(
						'id'      =>'blog-header-subtitle-date',
						'type'    => 'button_set', 
						'title'   => __('Subtitle Text // Date', 'cleanstart'),
						'desc'    => __('Select the head panel subtitle behavior when a' , 'cleanstart') .' <strong>'. __('date range', 'cleanstart') .'</strong> '. __('is selected', 'cleanstart'),
						"default" => 'usedefault',
						'options' => array(
								'nosubtitle' => __('No Subtitle', 'cleanstart'),
								'usedefault' => __('Use Blog Subtitle', 'cleanstart'),
								'usecustom'  => __('Use Custom Subtitle', 'cleanstart'),
						)
					),	
					array(
						'id'       =>'blog-header-subtitle-date-custom',
						'type'     => 'text', 
						'required' => array('blog-header-subtitle-date','equals','usecustom'),						
						'title'    => __('Custom Subtitle Text // Date', 'cleanstart'),
						'desc'     => __('Will be displayed when a <strong>date range</strong> is selected', 'cleanstart'),
						"default"  => __('This is the custom head panel subtitle text, displayed when a date range is selected', 'cleanstart'),
					),	
					array(
						'id'      =>'blog-header-title-author',
						'type'    => 'text', 
						'title'   => __('Title Text Prefix // Author', 'cleanstart'),
						'desc'    => __('Will be displayed right before the <strong>author\'s name</strong>', 'cleanstart'),
						"default" => __('Author: ', 'cleanstart'),
					),	
					array(
						'id'      =>'blog-header-subtitle-author',
						'type'    => 'button_set', 
						'title'   => __('Subtitle Text // Author', 'cleanstart'),
						'desc'    => __('Select the head panel subtitle behavior when an' , 'cleanstart') .' <strong>'. __('author', 'cleanstart') .'</strong> '. __('is selected', 'cleanstart') .'<br/><small>' .__('Biographical info for each user can be set on', 'cleanstart') . '<a href="'.  admin_url( 'users.php' ) .'"><strong>'. __('Users menu','cleanstart') .'</strong></a></small>',
						"default" => 'usedefault',
						'options' => array(
								'nosubtitle' => __('No Subtitle', 'cleanstart'),
								'usedefault' => __('Use Blog Subtitle', 'cleanstart'),
								'usebio'     => __('Use Selected Author\'s Biographical Info', 'cleanstart'),
								'usecustom'  => __('Use Custom Subtitle', 'cleanstart'),
						)
					),	
					array(
						'id'       =>'blog-header-subtitle-author-custom',
						'type'     => 'text', 
						'required' => array('blog-header-subtitle-author','equals','usecustom'),						
						'title'    => __('Custom Subtitle Text // Author', 'cleanstart'),
						'desc'     => __('Will be displayed when an <strong>author</strong> is selected', 'cleanstart'),
						"default"  => __('This is the custom head panel subtitle text, displayed when an author is selected', 'cleanstart'),
					),	
					array(
						'id'      =>'blog-header-title-search',
						'type'    => 'text', 
						'title'   => __('Title Text Prefix // Search', 'cleanstart'),
						'desc'    => __('Will be displayed right before the user <strong>search term</strong>', 'cleanstart'),
						"default" => __('Search for: ', 'cleanstart'),
					),	
					array(
						'id'      =>'blog-header-subtitle-search',
						'type'    => 'button_set', 
						'title'   => __('Subtitle Text // Search', 'cleanstart'),
						'desc'    => __('Select the <strong>head panel subtitle</strong> behavior when a <strong>search</strong> is done', 'cleanstart'),
						"default" => 'usedefault',
						'options' => array(
								'nosubtitle' => __('No Subtitle', 'cleanstart'),
								'usedefault' => __('Use Blog Subtitle', 'cleanstart'),
								'usecustom'  => __('Use Custom Subtitle', 'cleanstart'),
						)
					),	
					array(
						'id'       =>'blog-header-subtitle-search-custom',
						'type'     => 'text', 
						'required' => array('blog-header-subtitle-search','equals','usecustom'),						
						'title'    => __('Custom Subtitle Text // Search', 'cleanstart'),
						'desc'     => __('Will be displayed when a <strong>search</strong> is done', 'cleanstart'),
						"default"  => __('This is the custom header subtitle text, displayed when when a <strong>search</strong> is done', 'cleanstart'),
					),	

					// GOOGLE MAPS SNAZZY OPTIONS
					array(
							'id'       =>'section-headpanel-map-snazzy',
							'type'     => 'info',
							'title'    => '<center>'. __('Head Panel // Google Maps', 'cleanstart') .'</center>',
							'subtitle' => '<center><small>'. __('Customize Google Maps', 'cleanstart') .'</small></center>',
				        ),
					array(
						'id'       => PLETHORA_META_PREFIX .'header-google-maps-snazzy',
						'type' => 'textarea',
						'title' => __('Customize Google Maps', 'cleanstart'),
						'subtitle' => __('Paste your Snazzy JS array code here. For more custom map styles check out <a target="_blank" href="http://snazzymaps.com/">Snazzy Maps</a> website.', 'cleanstart'),
						'default'     => '',
					),

	 			)
				);
			return $return;
	    }

	    function section_posts() {

			$return = array(
				'title'      => __('Posts', 'cleanstart'),
				'icon'       => 'el-icon-file-edit-alt',
				'desc'       => '<span style="color:red">'. __('All options can be overriden on a single post', 'cleanstart') .'</span>',
				'icon_class' => 'icon-large',
				'fields'     => array(
		            array(
		                'id'        =>  PLETHORA_META_PREFIX .'post-layout',
		                'title'     => __( 'Single Post Layout', 'cleanstart' ),
		                'desc'      => __( 'Select main content and sidebar arrangement on single post view', 'cleanstart' ),
		                'default'   => 'right_sidebar',
		                'type'      => 'image_select',
		                'customizer'=> array(),
		                'options'   => array( 
					                'right_sidebar'	=> ReduxFramework::$_url . 'assets/img/2cr.png',
					                'left_sidebar'	=> ReduxFramework::$_url . 'assets/img/2cl.png',
		                )
		            ),
					array(
						'id'=> PLETHORA_META_PREFIX .'post-sidebar',
						'type' => 'select',
						'data' => 'sidebars',
						'multi' => false,
						'title' => __('Single Post Sidebar', 'cleanstart'), 
						'desc' => __('If empty, the default sidebar will be used. Create as many sidebars you need on <strong>Advanced > Sidebars</strong>', 'cleanstart'),
						'default'  => 'sidebar-default',
						),
					array(
						'id'      => PLETHORA_META_PREFIX .'post-title-oncontent',
						'type'    => 'button_set', 
						'title'   => __('Display Title On Content', 'cleanstart'),
						'desc'    => __('Might want to hide this if you have chosen to display the title on head panel ', 'cleanstart'),
						'default' => 'display',
						'options' => array(
								'display' => __('Display', 'cleanstart'),
								'hide'    => __('Hide', 'cleanstart'),
								),
						),	
					array(
						'id'      => PLETHORA_META_PREFIX .'post-media-oncontent',
						'type'    => 'button_set', 
						'title'   => __('Display Featured Media On Content', 'cleanstart'),
						'desc'    => __('Might want to hide this if you have chosen to display media on head panel ', 'cleanstart'),
						'default' => 'display',
						'options' => array(
								'display' => __('Display', 'cleanstart'),
								'hide'    => __('Hide', 'cleanstart'),
								),
						),	
					array(
						'id'      => PLETHORA_META_PREFIX .'post-listview',
						'type'    => 'button_set', 
						'title'   => __('List View Media', 'cleanstart'),
						'desc' => '<strong>'. __('According To Post Format', 'cleanstart') .'</strong> '. __('will display the featured video/audio in posts list (according on its post format).', 'cleanstart'),
						'default' => 'inherit',
						'options' => array(
								'inherit'       => __('According To Post Format', 'cleanstart'),
								'featuredimage' => __('Force Featured Image Display', 'cleanstart'),
								'hide'          => __('Do Not Display', 'cleanstart'),
								),
						),	
					array(
						'id'      => PLETHORA_META_PREFIX .'post-info-category',
						'type'    => 'switch', 
						'title'   => __('Show Categories Info', 'cleanstart'),
						"default" => 1,
						),	
					array(
						'id'      => PLETHORA_META_PREFIX .'post-info-tags',
						'type'    => 'switch', 
						'title'   => __('Show Tags Info', 'cleanstart'),
						"default" => 1,
						),	
					array(
						'id'      => PLETHORA_META_PREFIX .'post-info-author',
						'type'    => 'switch', 
						'title'   => __('Show Author Info', 'cleanstart'),
						"default" => 1,
						),	
					array(
						'id'      => PLETHORA_META_PREFIX .'post-info-date',
						'type'    => 'switch', 
						'title'   => __('Show Date Info', 'cleanstart'),
						"default" => 1,
						),	
					array(
						'id'      => PLETHORA_META_PREFIX .'post-info-comments',
						'type'    => 'switch', 
						'title'   => __('Show Comments Count Info', 'cleanstart'),
						"default" => 1,
						),	
				)

			);
			return $return;
	    }

	    function section_pages() {

			$return = array(
				'title'      => __('Pages', 'cleanstart'),
				'desc'       => '<span style="color:red">'. __('All options can be overriden on a single page', 'cleanstart') .'</span>',
				'icon'       => 'el-icon-file-edit-alt',
				'icon_class' => 'icon-large',
				'fields'     => array(
		            array(
						'id'      =>  PLETHORA_META_PREFIX .'page-layout',
						'title'   => __( 'Select Layout', 'cleanstart' ),
						'type'    => 'image_select',
						'default' => '0',
						'options' => array( 
								0         => ReduxFramework::$_url . 'assets/img/1c.png',
								1         => ReduxFramework::$_url . 'assets/img/2cr.png',
								2         => ReduxFramework::$_url . 'assets/img/2cl.png',
			                )
		                ),
	                array(
						'id'       => PLETHORA_META_PREFIX .'page-sidebar',
						'type'     => 'select',
						'required' => array(PLETHORA_META_PREFIX .'page-layout','equals',array('1','2')),  
						'data'     => 'sidebars',
						'multi'    => false,
						'default'  => 'sidebar-pages',
						'title'    => __('Select Sidebar', 'cleanstart'), 
	                    ),
					array(
						'id'      => PLETHORA_META_PREFIX .'page-title-oncontent',
						'type'    => 'button_set', 
						'title'   => __('Display Title', 'cleanstart'),
						'desc'    => __('Depending on your head panel settings, you might need to display title on content ', 'cleanstart'),
						'default' => 'hide',
						'options' => array(
								'display' => __('Display', 'cleanstart'),
								'hide'    => __('Hide', 'cleanstart'),
								),
						),	
				)
			);
			return $return;
	    }

	    function section_portfolio() {

			$return = array(
				'title'      => __('Portfolio', 'cleanstart'),
				'desc'       => '<span style="color:red">'. __('All options can be overriden on a portfolio post', 'cleanstart') .'</span>',
				'icon'       => 'el-icon-file-edit-alt',
				'icon_class' => 'icon-large',
				'fields'     => array(
		            array(
		                'title'     => __( 'Single Portfolio Layout', 'cleanstart' ),
		                'id'        =>  PLETHORA_META_PREFIX .'portfolio-layout',
		                'default'   => 'side',
		                'type'      => 'image_select',
		                'options'   => array( 
					                'side'	=> ReduxFramework::$_url . 'assets/img/2cr.png',
					                'full'	=> ReduxFramework::$_url . 'assets/img/1c.png',
		                )
		            ),

					array(
						'id'      => PLETHORA_META_PREFIX .'portfolio-title-oncontent',
						'type'    => 'button_set', 
						'title'   => __('Show Title On Content ( single view only )', 'cleanstart'),
						'desc'    => __('Might want to hide this if you have chosen to display the title on head panel', 'cleanstart'),
						'default' => 'display',
						'options' => array(
								'display' => __('Display', 'cleanstart'),
								'hide'    => __('Hide', 'cleanstart'),
								),
						),	

					array(
						'id'      => PLETHORA_META_PREFIX .'portfolio-infofields-box',
						'type'    => 'button_set', 
						'title'   => __('Show Info Fields Box', 'cleanstart'),
						'default' => 'display',
						'options' => array(
								'display' => 'Display',
								'hide'    => 'Hide',
								),
						),	

					array(
						'id'       => PLETHORA_META_PREFIX .'portfolio-infofields',
						'type'     => 'textarea',
						'required' => array(PLETHORA_META_PREFIX .'portfolio-infofields-box','equals',array('display')),  
						'title'    => __('Info Fields Mask', 'cleanstart'), 
						'desc'     => __('Define your info fields mask. Place anything here, but we would advise you to keep the default HTML structure!', 'cleanstart'),
						'default'  => '<p><strong>'.__('Date', 'cleanstart').': </strong>YOUR_TEXT</p>&#13;&#10;<p><strong>'.__('Client', 'cleanstart').': </strong>YOUR_TEXT</p>&#13;&#10;<p><strong>'.__('Place', 'cleanstart').': </strong>YOUR_TEXT</p>',
						),

					array(
						'id'      => PLETHORA_META_PREFIX .'portfolio-navbuttons',
						'type'    => 'button_set',
						'title'   => __('Navigation Buttons', 'cleanstart'), 
						'default' => 'display',
						'options' => array(
								'display' => __('Display', 'cleanstart'),
								'hide'    => __('Hide', 'cleanstart'),
								),
						),

					array(
						'id'       => PLETHORA_META_PREFIX .'portfolio-navbuttons-prev',
						'type'     => 'text',
						'required' => array(PLETHORA_META_PREFIX .'portfolio-navbuttons','=','display'),						
						'title'    => __('Buttons Text: Previous', 'cleanstart'),
						'default'  => __('Previous', 'cleanstart'),
						),	

					array(
						'id'       => PLETHORA_META_PREFIX .'portfolio-navbuttons-next',
						'type'     => 'text',
						'required' => array(PLETHORA_META_PREFIX .'portfolio-navbuttons','=','display'),						
						'title'    => __('Buttons Text: Next', 'cleanstart'),
						'default'  => __('Next', 'cleanstart'),
						),	

					/*** PORTFOLIO SLIDER ANIMATION TYPE [v1.3] ***/

					array(
						'id'      => PLETHORA_META_PREFIX .'portfolio-related',
						'type'    => 'button_set',
						'title'   => __('Related Portfolio Items', 'cleanstart'), 
						'default' => 'display',
						'options' => array(
								'display' => __('Display', 'cleanstart'),
								'hide'    => __('Hide', 'cleanstart'),
								),
						),

					array(
						'id'       => PLETHORA_META_PREFIX .'portfolio-related-results',
						'required' => array(PLETHORA_META_PREFIX .'portfolio-related','=','display'),						
						'type'     => 'spinner', 
						'title'    => __('Related Portfolio Items Results', 'cleanstart'),
						'desc'     => __('Max: 18 items', 'cleanstart'),
						"default"  => "3",
						"min"      => "1",
						"step"     => "1",
						"max"      => "18",
						),


					array(
						'id'       => PLETHORA_META_PREFIX .'portfolio-related-header',
						'type'     => 'text',
						'required' => array(PLETHORA_META_PREFIX .'portfolio-related','=','display'),						
						'title'    => __('Related Portfolio Items Header', 'cleanstart'),
						'default'  => __('Related Projects', 'cleanstart'),
						),	
					)
				);

			return $return;
	    }

	    function section_404() {

			$return = array(
				'title'      => __('404 Page', 'cleanstart'),
				'icon'       => 'el-icon-file-edit-alt',
				'icon_class' => 'icon-large',
				'fields'     => array(
	    				array(
						'id'    =>'header-custom404',
						'type'  => 'info',
						'title' => '<center>'. __('404 Page', 'cleanstart') .'</center>'
					),
					array(
						'id'      =>'404-header-title',
						'type'    => 'text',
						'title'   => __('Head panel title', 'cleanstart'),
						'default' => __('OMG! <strong>error 404</strong>', 'cleanstart'),
					),
					array(
						'id'      =>'404-header-subtitle',
						'type'    => 'text',
						'title'   => __('Head panel subtitle', 'cleanstart'),
						'default' => __('we are really sorry but the page you requested cannot be found.', 'cleanstart'),
					),
					array(
						'id'          =>'404-header-img',
						'type'        => 'media', 
						'title'       => __('Head Panel background image', 'cleanstart'),
						'subtitle'    => __('Upload your image', 'cleanstart'),
						'description' => __('If empty, a skin colored background will be used instead', 'cleanstart'),
						'default'     =>array('url'=> ''. THEME_ASSETS_URI .'/images/404.jpg'),
					),
					array(
						'id'      =>'404-title',
						'type'    => 'text',
						'title'   => __('Content Title', 'cleanstart'),
						'default' => __('Error 404 is nothing to really worry about...', 'cleanstart')
					),
					array(
						'id'      =>'404-subtitle',
						'type'    => 'text',
						'title'   => __('Content Subtitle', 'cleanstart'), 
						'default' => __('you may have mis-typed the URL, please check your spelling and try again.', 'cleanstart'), 
					),
				)
			);
			return $return;
	    }

	    function section_footer() {

	    	$return = array(
				'icon'       => 'el-icon-circle-arrow-down',
				'icon_class' => 'icon-large',
				'title'      => __('Footer', 'cleanstart'),
				'fields'     => array(
					array(
							'id'    =>'section-footer-general',
							'type'  => 'info',
							'title' => '<center>'. __('Footer // Main Section', 'cleanstart') .'</center>'
				        ),

					array(
						'id'       =>'footer-mainsection',
						'type'     => 'switch', 
						'title'    => __('Main Footer Section', 'cleanstart'),
						'subtitle' => __('Display/hide main footer section', 'cleanstart'),
						"default"  => 1,
						'on'       => __('Display', 'cleanstart'),
						'off'      => __('Hide', 'cleanstart'),
						),

					array(
						'id'       =>'footer-layout',
						'type'     => 'image_select',
						'required'     => array('footer-mainsection','=','1'),						
						'compiler' =>true,
						'title'    => __('Footer area layout', 'cleanstart'), 
						'subtitle' => __('Click to the icon according to the desired footer layout. ', 'cleanstart'),
						'desc'     => __('Edit content on <strong>Appearence > Widgets</strong> section as <i>Footer column #1</i>, <i>Footer column #2</i>, etc.', 'cleanstart'),
						'options'  => array(
								'1' => array('alt' => '1 Column', 'img' => THEME_CORE_ASSETS_URI.'/redux/col_1.png'),
								'2' => array('alt' => '2 Column', 'img' => THEME_CORE_ASSETS_URI.'/redux/col_2.png'),
								'3' => array('alt' => '2 Column (2/3 + 1/3)', 'img' => THEME_CORE_ASSETS_URI.'/redux/col_2_8-4.png'),
								'4' => array('alt' => '3 Column (1/3 + 2/3)', 'img' => THEME_CORE_ASSETS_URI.'/redux/col_2_4-8.png'),
								'5' => array('alt' => '3 Column', 'img' => THEME_CORE_ASSETS_URI.'/redux/col_3.png'),
								'6' => array('alt' => '3 Column (1/4 + 1/4 + 2/4)', 'img' => THEME_CORE_ASSETS_URI.'/redux/col_3_3-3-6.png'),
								'7' => array('alt' => '3 Column (2/4 + 1/4 + 1/4)', 'img' => THEME_CORE_ASSETS_URI.'/redux/col_3_6-3-3.png'),
								'8' => array('alt' => '4 Column', 'img' => THEME_CORE_ASSETS_URI.'/redux/col_4.png'),
							),
						'default' => '5'
						),
					array(
						'id'       => PLETHORA_META_PREFIX .'footer-triangles',
						'type'     => 'button_set', 
						'required'     => array('footer-mainsection','=','1'),						
						'title'    => __('Side Corners', 'cleanstart'),
						'subtitle' => __('Can be overriden on page/post settings', 'cleanstart'),
						'default'  => 'display',
						'options'  => array(
								'display' => __('Display', 'cleanstart'),
								'hide'    => __('Hide', 'cleanstart'),
								),
						),
					array(
						'id'          => PLETHORA_META_PREFIX .'footer-bgcolor',
						'type'        => 'color',
						'required'     => array('footer-mainsection','=','1'),						
						'title'       => __('Footer Background Color', 'cleanstart'), 
						'subtitle'    => __('default: #222222.', 'cleanstart'),
						'default'     => '#222222',
						'transparent' => false,
						'validate'    => 'color',
						),
					array(
						'id'          => PLETHORA_META_PREFIX .'footer-text-color',
						'type'        => 'color',
						'required'     => array('footer-mainsection','=','1'),						
						'title'       => __('Footer Text Color', 'cleanstart'), 
						'subtitle'    => __('default: #cccccc.', 'cleanstart'),
						'default'     => '#cccccc',
						'transparent' => false,
						'validate'    => 'color',
						),
					array(
						'id'          => PLETHORA_META_PREFIX .'footer-link-color',
						'type'        => 'color',
						'required'     => array('footer-mainsection','=','1'),						
						'title'       => __('Footer Link Color', 'cleanstart'), 
						'subtitle'    => __('default: #428BCA.', 'cleanstart'),
						'default'     => '#428BCA',
						'transparent' => false,
						'validate'    => 'color',
						),
					array(
							'id'    =>'section-footer-infobar',
							'type'  => 'info',
							'title' => '<center>'. __('Footer // Info Bar', 'cleanstart') .'</center>'
				        ),
					array(
						'id'       =>'footer-infobar',
						'type'     => 'switch', 
						'title'    => __('Footer info bar', 'cleanstart'),
						'subtitle' => __('Display/hide bottom info bar', 'cleanstart'),
						"default"  => 1,
						'on'       => __('Display', 'cleanstart'),
						'off'      => __('Hide', 'cleanstart'),
						),

					array(
						'id'             =>'footer-infobar-height',
						'type'           => 'dimensions',
						'required'       => array('footer-infobar','=','1'),						
						'output'         => array('.copyright'), 
						'units'          => 'px', // You can specify a unit value. Possible: px, em, %
						'units_extended' => 'true', // Allow users to select any type of unit
						'width'          => false,
						'title'          => __('Bottom info bar container height', 'cleanstart'),
						'subtitle'       => __('default: 50px', 'cleanstart'),
						'default'        => array('height'=>'50', )
						),												

					array(
						'id'           =>'footer-infobar-copyright',
						'type'         => 'textarea',
						'required'     => array('footer-infobar','=','1'),						
						'title'        => __('Copyright text', 'cleanstart'), 
						'desc'         => __('HTML tags allowed', 'cleanstart'),
						'default'      => __('Copyright &copy;2014 all rights reserved', 'cleanstart'),
						),
					array(
						'id'           =>'footer-infobar-credits',
						'type'         => 'textarea',
						'required'     => array('footer-infobar','=','1'),						
						'title'        => __('Credits text', 'cleanstart'), 
						'desc'         => __('HTML tags allowed', 'cleanstart'),
						'default'      => __('Designed by <a href="http://plethorathemes.com" target="_blank">Plethora Themes</a>', 'cleanstart'),
						),

					array(
							'id'    =>'section-footer-misc',
							'type'  => 'info',
							'title' => '<center>'. __('Footer // Miscellaneous', 'cleanstart') .'</center>'
				        ),

					array( 
						'id'       => PLETHORA_META_PREFIX .'footer-twitterfeed',
						'type'     => 'button_set', 
						'title'    => __('Enable/disable Twitter feed section', 'cleanstart'),
						'subtitle' => __('Can be overriden on page/post settings', 'cleanstart'),
						'desc'     => __('For further Twitter feed options, please check', 'cleanstart') .'<strong>'. __('Theme Settings > Social & APIs tab', 'cleanstart') .'</strong>',
						'default'  => 1,
						'options'  => array(
								1 => __('Display', 'cleanstart'),
								0 => __('Hide', 'cleanstart'),
								),
						),	


					)
				);
			return $return;
	    }

	    function section_slider() {

	     	$return = array(
				'icon'       => 'el-icon-photo',
				'icon_class' => 'icon-large',
				'title'      => __('Sliders', 'cleanstart'),
				'desc'       => '<p class="description">'. __('Set slider default settings', 'cleanstart') .'</p>',
				'fields'     => array(
					array(
						'id'      => PLETHORA_META_PREFIX .'slider-slideshow',
						'type'    => 'switch', 
						'title'   => __('Auto Slideshow', 'cleanstart'),
						"default" => true,
						'on'      => __('Yes', 'cleanstart'),
						'off'     => __('No', 'cleanstart'),
						),	

					/*** ADDING SLIDER ANIMATION TYPE [v1.3] ***/

					array(
						'id'      => PLETHORA_META_PREFIX .'slider-animationtype',
						'type'    => 'button_set',
						'title'   => __('Animation Type', 'cleanstart'),
						"default" => 'slide',
						'options' => array(
								'slide' => __('Slide', 'cleanstart'),
								'fade'  => __('Fade', 'cleanstart'),
								),
						),	

					array(
						'id'      => PLETHORA_META_PREFIX .'slider-direction',
						'type'    => 'button_set',
						'title'   => __('Slideshow Direction', 'cleanstart'),
						'required'=> array( PLETHORA_META_PREFIX .'slider-animationtype','=', array('slide')),						
						"default" => 'horizontal',
						'options' => array(
								'horizontal' => __('Horizontal', 'cleanstart'),
								'vertical'   => __('Vertical', 'cleanstart'),
								),
						),	
					array(
						'id'      => PLETHORA_META_PREFIX .'slider-animationloop',
						'type'    => 'switch', 
						'title'   => __('Slideshow Loop', 'cleanstart'),
						"default" => true,
						'on'      => __('Yes', 'cleanstart'),
						'off'     => __('No', 'cleanstart'),
						),
					array(
						'id'      => PLETHORA_META_PREFIX .'slider-slideshowspeed',
						'type'    => 'spinner', 
						'title'   => __('Slideshow Speed', 'cleanstart'),
						'desc'    => __('Set the speed of the slideshow cycling, in seconds', 'cleanstart'),
						"default" => 10,
						"min"     => 1,
						"step"    => 1,
						"max"     => 60,
						),	
					array(
						'id'      => PLETHORA_META_PREFIX .'slider-animationspeed',
						'type'    => 'spinner', 
						'title'   => __('Animation Speed', 'cleanstart'),
						'desc'    => __('Set the speed of the animations, in MILLIseconds', 'cleanstart'),
						"default" => 600,
						"min"     => 100,
						"step"    => 100,
						"max"     => 3000,
						),	
					array(
						'id'      => PLETHORA_META_PREFIX .'slider-showarrows',
						'type'    => 'switch', 
						'title'   => __('Show navigation arrows', 'cleanstart'),
						"default" => true,
						'on'  => __('Yes', 'cleanstart'),
						'off' => __('No', 'cleanstart'),
						),
					array(
						'id'      => PLETHORA_META_PREFIX .'slider-showbullets',
						'type'    => 'switch', 
						'title'   => __('Show navigation bullets', 'cleanstart'),
						"default" => true,
						'on'      => __('Yes', 'cleanstart'),
						'off'     => __('No', 'cleanstart'),
						),
					array(
						'id'      => PLETHORA_META_PREFIX .'slider-randomize',
						'type'    => 'switch', 
						'title'   => __('Randomize', 'cleanstart'),
						'desc'    => __('Random slide order everytime the slider starts', 'cleanstart'),
						"default" => false,
						'on'      => __('Yes', 'cleanstart'),
						'off'     => __('No', 'cleanstart'),
					),
					array(
						'id'      => PLETHORA_META_PREFIX .'slider-pauseonaction',
						'type'    => 'switch', 
						'title'   => __('Pause On Action', 'cleanstart'),
						'desc'    => __('Pause the slideshow when interacting with control elements, highly recommended', 'cleanstart'),
						"default" => true,
						'on'      => __('Yes', 'cleanstart'),
						'off'     => __('No', 'cleanstart'),
					),
					array(
						'id'      => PLETHORA_META_PREFIX .'slider-pauseonhover',
						'type'    => 'switch', 
						'title'   => __('Pause On Hover', 'cleanstart'),
						'desc'    => __('Pause the slideshow when hovering over slider, then resume when no longer hovering', 'cleanstart'),
						"default" => true,
						'on'      => __('Yes', 'cleanstart'),
						'off'     => __('No', 'cleanstart'),
						),
					array(
						'id'       => PLETHORA_META_PREFIX .'slider-urltarget',
						'type'     => 'button_set', 
						'title'    => __('Linked Slides Behavior', 'cleanstart'),
						'desc' => __('Set browser window behavior for linked slides', 'cleanstart'),
						'default'  => '_self',
						'options'  => array(
								'_self' => __('Open in same window', 'cleanstart'),
								'_blank'    => __('Open in new window', 'cleanstart'),
								),
						),	

				)
			);			
			return $return;
	    }


	    function section_social() {

	    	$return = array(
				'icon'       => 'el-icon-group',
				'icon_class' => 'icon-large',
				'title'      => __('Social & APIs', 'cleanstart'),
				'fields'     => array(

					array(
						'id'    =>'header-twitterfeed',
						'type'  => 'info',
						'title' => '<center>'. __('Twitter Feed Options', 'cleanstart') .'</center>'
				        ),

					array(
						'id'       =>'twitter_profilelink',
						'type'     => 'text',
						'title'    => __('Twitter Profile Link', 'cleanstart'),
						'validate' => 'url',
						'default'  => ''
						),

					array(
						'id'       =>'twitter_screen_name',
						'type'     => 'text',
						'title'    => __('Twitter Screen Name', 'cleanstart'),
						'desc'     => __('Enter Twitter ID or Screen Name (without @)', 'cleanstart'),
						'validate' => 'no_special_chars',
						'default'  => ''
						),

					array(
						'id'       =>'twitter_count',
						'type'     => 'spinner', 
						'title'    => __('Number of Tweets', 'cleanstart'),
						"default"  => "1",
						"min"      => "1",
						"step"     => "1",
						"max"      => "20",
						),

					array(
						'id'       =>'twitter_replies_switch',
						'type'     => 'switch', 
						'title'    => __('Enable Replies', 'cleanstart'),
						"default"  => 0,
						1          => __('Enabled', 'cleanstart'),
						0          => __('Disabled', 'cleanstart'),
						),	

					array(
						'id'      => 'twitter_enable_date',
						'type'    => 'button_set', 
						'title'   => __('Show Tweet Date', 'cleanstart'),
						'desc'    => __('Display the tweet\'s date, either on top or bottom of the tweet text.', 'cleanstart'),
						'default' => 'disable',
						'options' => array(
								'disable' => __('Disable', 'cleanstart'),
								'top'     => __('Top', 'cleanstart'),
								'bottom'  => __('Bottom', 'cleanstart'),
								),
						),

					array(
						'id'       =>'twitter_date_format',
						'type'     => 'text',
						'title'    => __('Twitter Date Format', 'cleanstart'),
						'desc'	   => __('For more formatting options see: <a href="http://php.net/manual/en/function.date.php" target="_blank">PHP Date Format</a>','cleanstart'),
						'validate' => 'no_html',
						'default'  => 'M j'
						),

					array(
						'id'       =>'twitter_consumer_key',
						'type'     => 'text',
						'title'    => __('Twitter Consumer Key', 'cleanstart'),
						'validate' => 'no_special_chars',
						'default'  => ''
						),

					array(
						'id'       =>'twitter_consumer_secret',
						'type'     => 'text',
						'title'    => __('Twitter Consumer Secret', 'cleanstart'),
						'validate' => 'no_special_chars',
						'default'  => ''
						),

					// MAILCHIMP API SETTINGS

					array(
						'id'    =>'header-newsletter_form',
						'type'  => 'info',
						'title' => '<center>'. __('MailChimp API', 'cleanstart') .'</center>'
				        ),

					array(
						'id'       =>'mailchimp_apikey',
						'type'     => 'text',
						'title'    => __('MailChimp API Key', 'cleanstart'),
						'validate' => 'no_special_chars',
						'default'  => ''
						),

					array(
						'id'       =>'mailchimp_listid',
						'type'     => 'text',
						'title'    => __('MailChimp List ID', 'cleanstart'),
						'validate' => 'no_special_chars',
						'default'  => ''
						),

 					// GOOGLE MAPS API SETTINGS
					array(
						'id'    =>'header-googlemaps',
						'type'  => 'info',
						'title' => '<center>'. __('Google Maps API', 'cleanstart') .'</center>'
				        ),
			           array(
			              'id'       => 'googlemaps_apikey',
			              'type'     => 'text',
			              'title'    => esc_html__('Google Maps API Key', 'plethora-framework'),
			              'description' => '<a href="'. esc_url( 'https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key' ) .'" target="_blank"><strong>'. esc_html__( 'Get a Google Maps API key', 'healthflex' ) .'</strong></a>',
			              'validate' => 'no_special_chars',
			              'default'  => ''
			              ),

					)


				);

			return $return;
	    }

	    function section_advanced() {


			$adv_settings = array();

		    $adv_settings[] = array(
				'id'    =>'header-dev-tips',
				'type'  => 'info',
				'title' => '<center>'. __('Dev / Design HTML Comments', 'cleanstart') .'<br/><small>'. __('Developer comments in HTML source. Should be used during development time only. Disable when website is ready for launch!', 'cleanstart') .'</small></center>'
			);
			$adv_settings[] = array(
				'id'      => 'dev-comments-page',
				'type'    => 'button_set', 
				'title'   => __('Current Page Info', 'cleanstart'),
				'desc'    => __('Enable current page information ( visible first thing in html source ) for each page & post.', 'cleanstart'),
				'default' => 'disable',
				'options' => array(
						'enable'  => __('Enable', 'cleanstart'),
						'disable' => __('Disable', 'cleanstart'),
						),
				);
			$adv_settings[] = array(
				'id'      => 'dev-comments-templateparts',
				'type'    => 'button_set', 
				'title'   => __('Template Parts', 'cleanstart'),
				'desc'    => __('Enable template part loading information. This will help you understand how the template system works.', 'cleanstart'),
				'default' => 'disable',
				'options' => array(
						'enable'  => __('Enable', 'cleanstart'),
						'disable' => __('Disable', 'cleanstart'),
						),
				);
			$adv_settings[] = array(
				'id'      => 'dev-comments-options',
				'type'    => 'button_set', 
				'title'   => __('Theme/Metaboxes Options', 'cleanstart'),
				'desc'    => __('Enable options information comments. This will help you understand how options applied and how affect several components display.', 'cleanstart'),
				'default' => 'disable',
				'options' => array(
						'enable'  => __('Enable', 'cleanstart'),
						'disable' => __('Disable', 'cleanstart'),
						),
				);
			$adv_settings[] = array(
				'id'      => 'dev-comments-layout',
				'type'    => 'button_set', 
				'title'   => __('Layout Checkpoints', 'cleanstart'),
				'desc'    => __('Enable start/end layout checkpoints information. This will help you separate easily the most important parts of the page on the html source view!', 'cleanstart'),
				'default' => 'disable',
				'options' => array(
						'enable'  => __('Enable', 'cleanstart'),
						'disable' => __('Disable', 'cleanstart'),
						),
				);
		    $adv_settings[] = array(
				'id'    =>'section-sidebars',
				'type'  => 'info',
				'title' => '<center>'. __('Custom Sidebars', 'cleanstart') .'</center>'
			);
		    $adv_settings[] = array(
				'id'      =>'sidebars-number',
				'type'    => 'spinner', 
				'title'   => __('Sidebars number', 'cleanstart'),
				'desc'    => __('Set the number of additional sidebars you need', 'cleanstart'),
				"default" => "0",
				"min"     => "0",
				"step"    => "1",
				"max"     => "20",
			);
		    $adv_settings[] = array(
					'id'    =>'header-features-posttype',
					'type'  => 'info',
					'title' => '<center>'. __('Activate / Deactivate Theme Custom Post Types', 'cleanstart') .'</center>'
			);

		    $adv_settings_features = class_exists('Plethora_Data') ? Plethora_Data::features_settings(array('posttype')) : Plethora_Helper::features_settings(array('posttype'));

		    foreach ($adv_settings_features as $key=> $adv_settings_feature) { 

		     $adv_settings[] = $adv_settings_feature;

		    }

		    $adv_settings[] = array(
		          'id'=>'header-features-shortcode',
		          'type' => 'info',
		          'title' => '<center>'. __('Activate / Deactivate Theme Shortcodes', 'cleanstart') .'</center>'
			);

		    $adv_settings_features = class_exists('Plethora_Data') ? Plethora_Data::features_settings(array('shortcode')) : Plethora_Helper::features_settings(array('shortcode'));

		    foreach ($adv_settings_features as $key=> $adv_settings_feature) { 

		     $adv_settings[] = $adv_settings_feature;

		    }

		    $adv_settings[] = array(
				'id'    =>'header-googleanalytics',
				'type'  => 'info',
				'title' => '<center>'. __('Google Analytics Options</center>', 'cleanstart') .'</center>'
			);
		    $adv_settings[] = array(
					'id'       =>'analytics-code',
					'type'     => 'textarea',
					'title'    => __('Analytics tracking code', 'cleanstart'),
					'subtitle' => __('Paste your Google Analytics or other code here.', 'cleanstart'),
					'description' => __('NOTICE: <strong style="color:red">Do not use &lt;script&gt; tags.</strong>', 'cleanstart'),
					'default'     => '',
			);
		    $adv_settings[] = array(
					'id'          =>'analytics-code-placement',
					'type'        => 'button_set',
					'title'       => __('Analytics tracking code placement', 'cleanstart'),
					'options'     => array('header' => __('Head', 'cleanstart'),'footer' => __('Footer', 'cleanstart')),//Must provide key => value pairs for radio options
					'default'     => 'footer'
			);
		    $adv_settings[] = array(
					'id'    =>'header-customjs',
					'type'  => 'info',
					'title' => '<center>'. __('Custom Javascript Options', 'cleanstart') .'</center>'
			);
		    $adv_settings[] = array(
					'id'          =>'custom-js',
					'type'        => 'textarea',
					'title'       => __('Custom JS (added on footer)', 'cleanstart'),
					'subtitle'    => __('Paste your JS code here.', 'cleanstart'),
					'description' => __('NOTICE: <strong style="color:red">Do not use &lt;script&gt; tags.</strong>', 'cleanstart'),
					'default'     => '',
			);
		    $adv_settings[] = array(
					'id'    =>'header-customcss',
					'type'  => 'info',
					'title' => '<center>'. __('Custom Style Options (custom CSS)', 'cleanstart') .'</center>'
			);
		    $adv_settings[] = array(
					'id'          =>'custom-css',
					'type'        => 'textarea',
					'title'       => __('Custom CSS', 'cleanstart'), 
					'subtitle'    => __('Paste your CSS code here.', 'cleanstart'),
					'description' => __('NOTICE: <strong style="color:red">Do not use &lt;style&gt; tags.</strong>', 'cleanstart'),
					'default'     => '',

			);

			/*** DEVELOPMENT OPTIONS ***/

		    $adv_settings[] = array(
					'id'    =>'header-development',
					'type'  => 'info',
					'title' => '<center>'. __('DEVELOPMENT OPTIONS', 'cleanstart') .'</center>'
			);
		    $adv_settings[] = array(
					'id'          => PLETHORA_META_PREFIX . 'development',
					'type'        => 'button_set',
					'title'       => __('Switch between Production and Development Mode', 'cleanstart'),
					'options'     => array( 'production' => __('Production', 'cleanstart'),'development' => __('Development', 'cleanstart')),
					'default'     => 'production'
			);

		    /*** EXPERIMENTAL FEATURES ***/

	  		// $adv_settings[] = array(
			// 		'id'    =>'header-experimental',
			// 		'type'  => 'info',
			// 		'title' => '<center>'. __('Experimental Features', 'cleanstart') .'</center>'
			// );

			// $adv_settings[] = array(
			// 	'id'      => 'experimental-features',
			// 	'type'    => 'button_set', 
			// 	'title'   => __('Experimental Features', 'cleanstart'),
			// 	'desc'    => __('Enable experimental features. These are features that are not thoroughly tested and will probably be implemented in next versions.', 'cleanstart'),
			// 	'default' => 'disable',
			// 	'options' => array(
			// 			'enable'  => __('Enable', 'cleanstart'),
			// 			'disable' => __('Disable', 'cleanstart'),
			// 			),
			// );

			$return = array(
				'icon'       => 'el-icon-wrench-alt',
				'icon_class' => 'icon-large',
				'title'      => __('Advanced', 'cleanstart'),
				'desc'       => '<p class="description">'. __('Advanced options', 'cleanstart') .'</p>',
				'fields'     => $adv_settings
				);

			return $return;

	    }

	}

	global $reduxConfig;
	$reduxConfig = new Plethora_Cleanstart_Options;

endif;