<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M 				   (c) 2013

File Description: Portfolio Post Type Feature Class

*/

if ( ! defined( 'ABSPATH' ) ) exit; // NO DIRECT ACCESS 

if ( class_exists('Plethora_Posttype') && !class_exists('Plethora_Posttype_Portfolio') ) {  
 
	/**
	 * @package Plethora Base
	 */

	class Plethora_Posttype_Portfolio {

		public function __construct() {

	/////// Basic post type configuration

			// Names
			$names = array(

				'post_type_name' =>	 'portfolio', // Carefull...this must be filled with custom post type's slug
				'slug' 			 =>	 'portfolio', 
				'menu_item_name' =>	 __('Portfolio', 'cleanstart'),
			    'singular' 		 =>  __('Portfolio Item', 'cleanstart'),
			    'plural' 		 =>  __('Portfolio Items', 'cleanstart'),

			);

			// Options
			$options = array(

	            'enter_title_here' 		=> 'Portfolio title', // Title prompt text 
				'description'			=> '',	// A short descriptive summary of what the post type is. 
				'public'				=> true,		// Whether a post type is intended to be used publicly either via the admin interface or by front-end users (default: false)
				'exclude_from_search'	=> true,		// Whether to exclude posts with this post type from front end search results ( default: value of the opposite of the public argument)
				'publicly_queryable'	=> true,		// Whether queries can be performed on the front end as part of parse_request() ( default: value of public argument)
				'show_ui' 			  	=> true,		// Whether to generate a default UI for managing this post type in the admin ( default: value of public argument )
				'show_in_nav_menus'		=> true,		// Whether post_type is available for selection in navigation menus ( default: value of public argument )
				'show_in_menu'			=> true,		// Where to show the post type in the admin menu. show_ui must be true ( default: value of show_ui argument )
				'show_in_admin_bar'		=> true,		// Whether to make this post type available in the WordPress admin bar ( default: value of the show_in_menu argument )
				'menu_position'			=> 5, 			// The position in the menu order the post type should appear. show_in_menu must be true ( default: null )
				'menu_icon' 			=> 'dashicons-portfolio', // The url to the icon to be used for this menu or the name of the icon from the iconfont ( default: null - defaults to the posts icon ) Check http://melchoyce.github.io/dashicons/ for icon info
				'hierarchical' 		  	=> false, 		// Whether the post type is hierarchical (e.g. page). Allows Parent to be specified. The 'supports' parameter should contain 'page-attributes' to show the parent select box on the editor page. ( default: false )
				// 'taxonomies' 		  	=> array(),		// An array of registered taxonomies like category or post_tag that will be used with this post type. This can be used in lieu of calling register_taxonomy_for_object_type() directly. Custom taxonomies still need to be registered with register_taxonomy(). 
	 			// 'has_archive' 		  	=> false,		// Enables post type archives. Will use $post_type as archive slug by default (default: false)
				// 'query_var' 		  	=> true,		// Sets the query_var key for this post type.  (Default: true - set to $post_type )
	 			// 'can_export' 		  	=> true 		// Can this post_type be exported. ( Default: true )
		    	'supports' 				=> array( 
						    					'title', 
						    					'editor', 
						    					// 'author', 	
						    					'thumbnail', 	
						    					'excerpt', 	
						    					// 'trackbacks', 	
						    					// 'custom-fields', 	
						    					'comments', 	
						    					// 'revisions', 	
						    					// 'page-attributes', 	
						    					// 'post-formats' 	
						    				 ), // An alias for calling add_post_type_support() directly. Boolean false can be passed as value instead of an array to prevent default (title and editor) behavior. 
			    'rewrite' 			  	=> array( 
			    								'slug'		=> _x('portfolio', 'URL slug','cleanstart') , // string: Customize the permalink structure slug. Defaults to the $post_type value. Should be translatable, that's why we use _x
			    								'with_front'=> true, 		// bool: Should the permalink structure be prepended with the front base. (example: if your permalink structure is /blog/, then your links will be: false->/news/, true->/blog/news/). Defaults to true
			    								// 'feeds'		=> true, 	// bool: Should a feed permalink structure be built for this post type. Defaults to has_archive value.
			    								// 'pages'		=> true, 	// bool: Should the permalink structure provide for pagination. Defaults to true 
			    							 ), // Triggers the handling of rewrites for this post type. To prevent rewrites, set to false. (Default: true and use $post_type as slug )

				// 'capability_type'		=> array('portfolio', 'portfolios'),	// The string to use to build the read, edit, and delete capabilities. May be passed as an array to allow for alternative plurals when using this argument as a base to construct the capabilities, e.g. array('story', 'stories') (default: "post")
				// 'capabilities'			=> array(			// An array of the capabilities for this post type. ( default: capability_type is used to construct )
				// 								'publish_posts' => 'publish_portfolios',
				// 								'edit_posts' => 'edit_portfolios',
				// 								'edit_others_posts' => 'edit_others_portfolios',
				// 								'delete_posts' => 'delete_portfolios',
				// 								'delete_others_posts' => 'delete_others_portfolios',
				// 								'read_private_posts' => 'read_private_portfolios',
				// 								'edit_post' => 'edit_portfolio',
				// 								'delete_post' => 'delete_portfolio',
				// 								'read_post' => 'read_portfolio',
				// 							), 				

			);

			// Create the post type
			$portfolio = new Plethora_Posttype( $names, $options );

	/////// Add Project Type taxonomy

			// Taxonomy labels
			$labels = array(

		        'name'                       => __( 'Project Types', 'cleanstart' ),
		        'singular_name'              => __( 'Project Type', 'cleanstart' ),
		        'menu_name'                  => __( 'Project Types', 'cleanstart' ),
		        'all_items'                  => __( 'All Project Types', 'cleanstart' ),
		        'edit_item'                  => __( 'Edit Project Type', 'cleanstart' ),
		        'view_item'                  => __( 'View Project Type', 'cleanstart' ),
		        'update_item'                => __( 'Update Project Type', 'cleanstart' ),
		        'add_new_item'               => __( 'Add New Project Type', 'cleanstart' ),
		        'new_item_name'              => __( 'New Project Type Name', 'cleanstart' ),
		        'parent_item'                => __( 'Parent Project Type', 'cleanstart' ),
		        'parent_item_colon'          => __( 'Parent Project Type:', 'cleanstart' ),
		        'search_items'               => __( 'Search Project Types', 'cleanstart' ),     
		        'popular_items'              => __( 'Popular Project Types', 'cleanstart' ),
		        'separate_items_with_commas' => __( 'Seperate Project Types with commas', 'cleanstart' ),
		        'add_or_remove_items'        => __( 'Add or remove Project Types', 'cleanstart' ),
		        'choose_from_most_used'      => __( 'Choose from most used Project Types', 'cleanstart' ),
		        'not_found'                  => __( 'No Project Types found', 'cleanstart' ),

			);

			// Taxonomy options
	        $options = array(
	 
	            'labels' => $labels,
	            'public' 			=> true, 	// (boolean) (optional) If the taxonomy should be publicly queryable. ( default: true )
	            'show_ui' 			=> true, 	// (boolean) (optional) Whether to generate a default UI for managing this taxonomy. (Default: if not set, defaults to value of public argument.)
	            'show_in_nav_menus' => true, 	// (boolean) (optional) true makes this taxonomy available for selection in navigation menus. ( Default: if not set, defaults to value of public argument )
	            'show_tagcloud' 	=> false, 	// (boolean) (optional) Whether to allow the Tag Cloud widget to use this taxonomy. (Default: if not set, defaults to value of show_ui argument )
	            'show_admin_column' => true, 	// (boolean) (optional) Whether to allow automatic creation of taxonomy columns on associated post-types table ( Default: false )
	            'hierarchical' 		=> false, 	// (boolean) (optional) Is this taxonomy hierarchical (have descendants) like categories or not hierarchical like tags. ( Default: false )
	            'query_var' 		=> true, 	// (boolean or string) (optional) False to disable the query_var, set as string to use custom query_var instead of default which is $taxonomy, the taxonomy's "name". ( Default: $taxonomy )
	            // 'sort' 				=> true,	// (boolean) (optional) Whether this taxonomy should remember the order in which terms are added to objects. ( default: None )
				'rewrite'			=> array( 
								  		'slug'			=> _x('project-type', 'URL slug','cleanstart') , // Used as pretty permalink text (i.e. /tag/) - defaults to $taxonomy (taxonomy's name slug) 
				                  		'with_front'	=> true,    // allowing permalinks to be prepended with front base - defaults to true 
				                  		'hierarchical'	=> true,  	// true or false allow hierarchical urls (implemented in Version 3.1) - defaults to false 
				                  	   ), 		// (boolean/array) (optional) Set to false to prevent automatic URL rewriting a.k.a. "pretty permalinks". Pass an $args array to override default URL settings for permalinks as outlined above (Default: true )

	            // 'capabilities' 		=> array( 
	     							// 	'manage_terms' 	=> 'manage_projecttypes',
	     							// 	'edit_terms' 	=> 'manage_projecttypes',
	     							// 	'delete_terms' 	=> 'manage_projecttypes',
	     							// 	'assign_terms' 	=> 'edit_portfolios',
	     							//    ), 		// (array) (optional) An array of the capabilities for this taxonomy. ( Default: None )
	        );

			// Register Taxonomy
			$portfolio->register_taxonomy('project-type', $options );

	/////// Other configuration

			// Make client and type columns sortable
			$portfolio->sortable(array(

			    'project-type' => array('project_type', true),

			));


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
	          'switchable' 			=> true,
	          'options_title' 		=> __('Portfolio post type', 'cleanstart' ),
	          'options_subtitle'	=> __('Activate/deactivate portfolio custom post pype', 'cleanstart' ),
	          'options_desc' 		=> __('On deactivation, all settings related to this feature will be removed. However, they will not be deleted permanently.', 'cleanstart' ),
	          'version' 			=> '1.0',
	        );
	      
	      return $feature_options;
	   }

	}
}	
