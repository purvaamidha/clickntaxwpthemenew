<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M 				   (c) 2013

File Description: Team Posttype Feature Class

*/

if ( ! defined( 'ABSPATH' ) ) exit; // NO DIRECT ACCESS 

if ( class_exists('Plethora_Posttype') && !class_exists('Plethora_Posttype_Person') ) {  
 
	/**
	 * @package Plethora Base
	 */

	class Plethora_Posttype_Person {

		public function __construct() {

	/////// Basic post type configuration

			// Names
			$names = array(

				'post_type_name'  =>  'person', // Carefull...this must be filled with custom post type's slug
				'slug'            =>  'person', 
				'menu_item_name'  =>  __('Persons', 'cleanstart'),
				'singular'        =>  __('Person', 'cleanstart'),
				'plural'          =>  __('Persons', 'cleanstart'),

			);

			// Options
			$options = array(

				'enter_title_here' => 'Person\'s Name', // Title prompt text 
				'description'         => '',  // A short descriptive summary of what the post type is. 
				'public'              => true,    		// Whether a post type is intended to be used publicly either via the admin interface or by front-end users (default: false)
				'exclude_from_search' => true,    		// Whether to exclude posts with this post type from front end search results ( default: value of the opposite of the public argument)
				'publicly_queryable'  => true,    		// Whether queries can be performed on the front end as part of parse_request() ( default: value of public argument)
				'show_ui'             => true,    		// Whether to generate a default UI for managing this post type in the admin ( default: value of public argument )
				'show_in_nav_menus'   => false,    		// Whether post_type is available for selection in navigation menus ( default: value of public argument )
				'show_in_menu'        => true,    		// Where to show the post type in the admin menu. show_ui must be true ( default: value of show_ui argument )
				'show_in_admin_bar'   => true,    		// Whether to make this post type available in the WordPress admin bar ( default: value of the show_in_menu argument )
				'menu_position'       => 5,       		// The position in the menu order the post type should appear. show_in_menu must be true ( default: null )
				'menu_icon'           => 'dashicons-id-alt', // The url to the icon to be used for this menu or the name of the icon from the iconfont ( default: null - defaults to the posts icon ) Check http://melchoyce.github.io/dashicons/ for icon info
				'hierarchical'        => false,    		// Whether the post type is hierarchical (e.g. page). Allows Parent to be specified. The 'supports' parameter should contain 'page-attributes' to show the parent select box on the editor page. ( default: false )
				// 'taxonomies'          => array(),   	// An array of registered taxonomies like category or post_tag that will be used with this post type. This can be used in lieu of calling register_taxonomy_for_object_type() directly. Custom taxonomies still need to be registered with register_taxonomy(). 
				// 'has_archive'         => false,    	// Enables post type archives. Will use $post_type as archive slug by default (default: false)
				// 'query_var'           => true,    	// Sets the query_var key for this post type.  (Default: true - set to $post_type )
				// 'can_export'          => true     	// Can this post_type be exported. ( Default: true )
				'supports'			  => array(			// An alias for calling add_post_type_support() directly. Boolean false can be passed as value instead of an array to prevent default (title and editor) behavior. 
											'title', 
											// 'editor', 
											// 'author',  
											// 'thumbnail',  
											// 'excerpt',  
											// 'trackbacks',  
											// 'custom-fields',   
											// 'comments',   
											// 'revisions',   
											'page-attributes',  
											// 'post-formats'   
						                 ), 					
				'rewrite'		  => array( 		// Triggers the handling of rewrites for this post type. To prevent rewrites, set to false. (Default: true and use $post_type as slug )
											'slug'			=> _x('person', 'URL slug','cleanstart'),		// string: Customize the permalink structure slug. Defaults to the $post_type value. Should be translatable, that's why we use _x
											'with_front'	=> true,	// bool: Should the permalink structure be prepended with the front base. (example: if your permalink structure is /blog/, then your links will be: false->/news/, true->/blog/news/). Defaults to true
											'feeds'    	=> false,	// bool: Should a feed permalink structure be built for this post type. Defaults to has_archive value.
											// 'pages'    	=> true,	// bool: Should the permalink structure provide for pagination. Defaults to true 
											), 				

				// 'capability_type'	=> array('person', 'persons'),	// The string to use to build the read, edit, and delete capabilities. May be passed as an array to allow for alternative plurals when using this argument as a base to construct the capabilities, e.g. array('story', 'stories') (default: "post")
				// 'capabilities'		=> array(			// An array of the capabilities for this post type. ( default: capability_type is used to construct )
				// 							'publish_posts' => 'publish_persons',
				// 							'edit_posts' => 'edit_persons',
				// 							'edit_others_posts' => 'edit_others_persons',
				// 							'delete_posts' => 'delete_persons',
				// 							'delete_others_posts' => 'delete_others_persons',
				// 							'read_private_posts' => 'read_private_persons',
				// 							'edit_post' => 'edit_person',
				// 							'delete_post' => 'delete_person',
				// 							'read_post' => 'read_person',
				// 	                  ), 				
			);    


			// Create the post type object
			$person = new Plethora_Posttype( $names, $options );


	/////// Add Sections taxonomy

			// Taxonomy labels
			$labels = array(

		        'name'                       => __( 'Sections', 'cleanstart' ),
		        'singular_name'              => __( 'Section', 'cleanstart' ),
		        'menu_name'                  => __( 'Sections', 'cleanstart' ),
		        'all_items'                  => __( 'All Sections', 'cleanstart' ),
		        'edit_item'                  => __( 'Edit Section', 'cleanstart' ),
		        'view_item'                  => __( 'View Section', 'cleanstart' ),
		        'update_item'                => __( 'Update Section', 'cleanstart' ),
		        'add_new_item'               => __( 'Add New Section', 'cleanstart' ),
		        'new_item_name'              => __( 'New Section Name', 'cleanstart' ),
		        'parent_item'                => __( 'Parent Section', 'cleanstart' ),
		        'parent_item_colon'          => __( 'Parent Section:', 'cleanstart' ),
		        'search_items'               => __( 'Search Sections', 'cleanstart' ),     
		        'popular_items'              => __( 'Popular Sections', 'cleanstart' ),
		        'separate_items_with_commas' => __( 'Separate Sections with commas', 'cleanstart' ),
		        'add_or_remove_items'        => __( 'Add or remove Sections', 'cleanstart' ),
		        'choose_from_most_used'      => __( 'Choose from most used Sections', 'cleanstart' ),
		        'not_found'                  => __( 'No Sections found', 'cleanstart' ),

			);

			// Taxonomy options
	        $options = array(
	 
	            'labels' 			=> $labels,
	            'public' 			=> true, 	// (boolean) (optional) If the taxonomy should be publicly queryable. ( default: true )
	            'show_ui' 			=> true, 	// (boolean) (optional) Whether to generate a default UI for managing this taxonomy. (Default: if not set, defaults to value of public argument.)
	            'show_in_nav_menus' => false, 	// (boolean) (optional) true makes this taxonomy available for selection in navigation menus. ( Default: if not set, defaults to value of public argument )
	            'show_tagcloud' 	=> false, 	// (boolean) (optional) Whether to allow the Tag Cloud widget to use this taxonomy. (Default: if not set, defaults to value of show_ui argument )
	            'show_admin_column' => true, 	// (boolean) (optional) Whether to allow automatic creation of taxonomy columns on associated post-types table ( Default: false )
	            'hierarchical' 		=> true, 	// (boolean) (optional) Is this taxonomy hierarchical (have descendants) like categories or not hierarchical like tags. ( Default: false )
	            'query_var' 		=> true, 	// (boolean or string) (optional) False to disable the query_var, set as string to use custom query_var instead of default which is $taxonomy, the taxonomy's "name". ( Default: $taxonomy )
	            'sort' 				=> true,	// (boolean) (optional) Whether this taxonomy should remember the order in which terms are added to objects. ( default: None )
				'rewrite'			=> array( 
								  		'slug'			=> _x('section', 'URL slug','cleanstart') , // Used as pretty permalink text (i.e. /tag/) - defaults to $taxonomy (taxonomy's name slug) 
				                  		'with_front'	=> true,    // allowing permalinks to be prepended with front base - defaults to true 
				                  		'hierarchical'	=> true,  	// true or false allow hierarchical urls (implemented in Version 3.1) - defaults to false 
				                  	   ), 		// (boolean/array) (optional) Set to false to prevent automatic URL rewriting a.k.a. "pretty permalinks". Pass an $args array to override default URL settings for permalinks as outlined above (Default: true )

	            // 'capabilities' 		=> array( 
	     							// 	'manage_terms' 	=> 'manage_sections',
	     							// 	'edit_terms' 	=> 'manage_sections',
	     							// 	'delete_terms' 	=> 'manage_sections',
	     							// 	'assign_terms' 	=> 'edit_persons',
	     							//    ), 		// (array) (optional) An array of the capabilities for this taxonomy. ( Default: None )

	        );
			
			// Register the taxonomy
			$person->register_taxonomy( 'section', $options );

	/////// Other configuration

			/*** COLUMNS SETTINGS ***/
			// THUMBNAIL COLUMN IN POSTS SCREEN

			add_filter('manage_edit-person_columns', array( $this, 'add_column_image_header'));
			add_action('manage_person_posts_custom_column', array( $this, 'add_column_image_content') , 10, 2 );

	        // Scripts/styles for post/post-new pages
	        add_action('admin_print_styles-post.php'    , array( $this, 'admin_post_print_css')); 
	        add_action('admin_print_styles-post-new.php', array( $this, 'admin_post_print_css')); 


		}

			function add_column_image_header( $columns ) { 

				unset( $columns['date'] );
				$columns['post_thumbs'] = __( 'Image', 'cleanstart' );
				return $columns;
			}

			function add_column_image_content( $column_name, $id ) { 

				if ( $column_name === 'post_thumbs' ){
					$img_normal_id	= get_post_meta( $id, PLETHORA_META_PREFIX .'person-photo', true );	// Team member main image
					$img_normal_arr	= (isset($img_normal_id['id']) && !empty($img_normal_id['id'])) ? wp_get_attachment_image_src( $img_normal_id['id'], 'thumbnail' ) : '';                      
					$img_normal      = (isset( $img_normal_arr[0] ) && !empty($img_normal_arr[0] )) ? $img_normal_arr[0] : $img_normal_arr[0];
					if ( !empty($img_normal)) { 
				    echo "<img width='50px' src='" . $img_normal . "'>";
					}
				}

			}


	       /** 
	       * CSS fixes for slider-related admin pages
	       *
	       * @return array
	       * @since 1.0
	       *
	       */
	        function admin_post_print_css() {

	            global $post_type;

	            if ( $post_type == 'person' ) {

	              echo '<style type="text/css">#edit-slug-box { display: none !important; visibility: hidden; }</style>';
	              echo '<style type="text/css">#post-preview { display: none !important; visibility: hidden; }</style>';
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
	              'options_title' => 'Person post type',
	              'options_subtitle' => 'Activate/deactivate Persons post type',
	              'options_desc' => 'On deactivation, all settings related to this feature will be removed. However, they will not be deleted permanently.',
	              'version' => '1.0',
	            );
	          
	          return $feature_options;
	       }


	}
}