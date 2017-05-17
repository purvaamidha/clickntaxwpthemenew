<?php
/*
Plugin Name: Plethora Themes Framework
Plugin URI: http://plethorathemes.com/
Description: Contains all the core functionality of Plethora WP themes
Author: Plethora Themes
Author URI: http://plethorathemes.com/
Text Domain: plethora-framework
Version: 1.2.5
*/


if ( ! defined( 'ABSPATH' ) ) exit; // NO DIRECT ACCESS 


/**
 * Plethora class manipulates every theme item module. Contains methods for indexing and loading classes files.
 * 
 * @package Plethora Framework
 * @version 1.0
 * @author Plethora Dev Team
 * @copyright Plethora Themes (c) 2014
 *
 */

class Plethora {

  // Plethora Classes Option
  private $plethora_classes;

  /**
   * Class construct method. It initiates all necessary methods for loading and initiating the theme.
   *
   * @param 
   * @return 
   * @since 1.0
   *
   */
	public function __construct() {

    // Load Theme Constants ( always first please! )
    self::load_themeconstants();

    // Set Plethora Framework constants
    self::load_constants();

   // Load textdomain
    add_action('init', array( $this, 'load_textdomain'));

    // Load helper classes
    self::load_helpers();

    // Load framework related assets
    self::load_assets();

    // Check installation for new controllers/features
    self::check_index();
    self::save_index();

    // Load Options Framework
    self::load_optionsframework();

    // Load Controllers
    self::load_controllers();

    // Load Features
    self::load_features();

     // Loads Theme Options  
    self::load_theme_options();

     // Loads Theme Functions  
    self::load_theme_functions();
 
  }
  
  /**
   * Theme constants definition  
   *
   * @param 
   * @return 
   * @since 1.0
   *
   */
  public function load_themeconstants() {

    // Load theme related constants file
    if (file_exists( get_template_directory() . '/includes/theme-constants.php' )) { 
 
      require_once( get_template_directory() . '/includes/theme-constants.php' );

    }
  }
  /**
   * Constants definition  
   *
   * @param 
   * @return 
   * @since 1.0
   *
   */
  public function load_constants() {

    //***** BASIC CONSTANTS *****//

    define( 'PLETHORA_VERSION',       '1.2.3' );

    # PREFIXES
    define( 'PLETHORA_PREFIX',        'plethora' );
    define( 'PLETHORA_META_PREFIX',        'ple-' );

    # OPTION RELATED NAMES
    define( 'PLETHORA_CLASSES_OPTNAME',   PLETHORA_PREFIX .'_classes' );  // used only here

    //***** FRAMEWORK RELATED CONSTANTS *****//

    # URIs
    define( 'THEME_CORE_URI',             plugins_url('plethora-framework/') );                // Plethora framework folder
    define( 'THEME_CORE_ASSETS_URI',      THEME_CORE_URI . '/assets' );         // Plethora framework assets (scripts, styles & images)
    define( 'THEME_CORE_HELPERS_URI',     THEME_CORE_URI . '/helpers' );        // Plethora framework helpers folder
    define( 'THEME_CORE_LIBS_URI',        THEME_CORE_URI . '/libs' );           // Plethora framework library folder

    # DIRs
    define( 'THEME_CORE_DIR',             plugin_dir_path(__FILE__)  );                // Plethora framework folder
    define( 'THEME_CORE_ASSETS_DIR',      THEME_CORE_DIR . '/assets' );         // Plethora framework assets (scripts, styles & images)
    define( 'THEME_CORE_HELPERS_DIR',     THEME_CORE_DIR . '/helpers' );         // Plethora framework library
    define( 'THEME_CORE_LIBS_DIR',        THEME_CORE_DIR . '/libs' );           // Plethora framework library folder
    

    //***** THEME RELATED CONSTANTS *****//
    
    # URIs
    define( 'THEME_URI',                  get_template_directory_uri() );       // Theme folder
    define( 'THEME_INCLUDES_URI',         THEME_URI . '/includes' );            // Theme features folder
    define( 'THEME_PARTIALS_URI',         THEME_INCLUDES_URI . '/partials' );   // Theme template parts folder 
    define( 'THEME_ASSETS_URI',           THEME_URI . '/assets' );              // Theme assets folder

    # DIRs
    define( 'THEME_DIR',                  get_template_directory() );           // Theme folder
    define( 'THEME_INCLUDES_DIR',         THEME_DIR . '/includes' );            // Theme features folder
    define( 'THEME_PARTIALS_DIR',         THEME_INCLUDES_DIR . '/partials' );   // Theme template parts folder 
    define( 'THEME_ASSETS_DIR',           THEME_DIR . '/assets' );              // Theme assets folder

    //***** CHECK IF INCLUDES OR EXTENSION FOLDER EXISTS IN CHILD *****//
    define( 'CHILD_INCLUDES_URI',         get_stylesheet_directory_uri() . '/includes' ); // Child theme includes folder
    define( 'CHILD_INCLUDES_DIR',         get_stylesheet_directory() . '/includes' ); // Child theme includes folder

  }


  public function load_textdomain() {

        load_theme_textdomain( 'cleanstart', THEME_DIR . '/languages' );
        load_plugin_textdomain( 'plethora-framework', false, THEME_DIR . '/languages' ); 
  }
  /**
   * Constants definition  
   *
   * @param 
   * @return 
   * @since 1.2
   *
   */
  public function load_helpers() {

    require_once( THEME_CORE_HELPERS_DIR .'/plethora-cms.php' );
    require_once( THEME_CORE_HELPERS_DIR .'/plethora-data.php' );
    require_once( THEME_CORE_HELPERS_DIR .'/plethora-snippet.php' );
    require_once( THEME_CORE_HELPERS_DIR .'/plethora-system.php' );
    require_once( THEME_CORE_HELPERS_DIR .'/plethora-helper.php' ); // Only for backward compatibilty purposes. Should be removed on 1.3

  }

  /**
   * Load framework realeted assets 
   *
   * @param 
   * @return 
   * @since 1.2
   *
   */
  public function load_assets() {

    // Enqueue Admin Scripts and Styles
    Plethora_CMS::add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue' ));


  }

  /**
   * Enqueue Admin Scripts and Styles
   *
   * @param 
   * @return 
   * @since 1.0
   *
   */
   static function admin_enqueue() {

        Plethora_CMS::wp_register_style( 'plethora_admin', THEME_CORE_ASSETS_URI . '/admin.css' );
        Plethora_CMS::wp_enqueue_style( 'plethora_admin' );

        Plethora_CMS::wp_register_script( 'admin', THEME_CORE_ASSETS_URI . '/admin.js' );
        Plethora_CMS::wp_enqueue_script('admin');
 
   }

    /**
   * Scan Plethora Controller Classes files and updates classes index
   *
   * @param $type, $class
   * @return array 
   * @since 1.1.1
   * 
   */
  private function check_index() {

      //get controller files
      $controllers_folder = THEME_CORE_DIR;
      $controllers_files = Plethora_Data::class_files( $controllers_folder, PLETHORA_PREFIX );
      ksort($controllers_files);

      //Scan controller files FIRST!!!
      foreach ($controllers_files as $key => $controller_file) {

        $this->add_to_index( $controller_file );
    
      }

      //Scan feature files of PARENT THEME 
      foreach ($controllers_files as $key => $controller_file) {

        $controller_slug  = $this->get_indexinfo_from_file( $controller_file, 'slug' );

        //Controller => features (all the features included under this controller)
        $features_files = Plethora_Data::class_files( THEME_INCLUDES_DIR .'/'. $controller_slug, $controller_slug );
        if ( is_array($features_files) ) {

          // Scan and load feature class files
          foreach ($features_files as $feature_file) {

            $this->add_to_index( $feature_file, 'parent' );

         }
        }
      }         

      //Scan feature files of CHILD THEME ( if this is active )
      foreach ($controllers_files as $key => $controller_file) {

        $controller_slug  = $this->get_indexinfo_from_file( $controller_file, 'slug' );

        //Controller => features (all the features included under this controller)
        $features_files = Plethora_Data::class_files( CHILD_INCLUDES_DIR .'/'. $controller_slug, $controller_slug );
        if ( is_array($features_files) ) {

          // Scan and load feature class files
          foreach ($features_files as $feature_file) {

            $this->add_to_index( $feature_file, 'child' );

          }
        }
      }
  }


  /**
   * Loads Redux Options framework. Any customizations must be placed here.
   *
   * @since 1.1.1
   *
   */
  private function load_optionsframework() {

    if ( !class_exists( 'ReduxFramework' ) && file_exists( THEME_CORE_LIBS_DIR . '/ReduxFramework/ReduxCore/framework.php' ) ) {
      
      require_once( THEME_CORE_LIBS_DIR . '/ReduxFramework/ReduxCore/framework.php' );

    }    


  }

  /**
   * Loads controller classes. Every controller class manages a different Plethora objects group.
   *
   * @since 1.0
   *
   */
  private function load_controllers() {

    //load plethora classes index and check if is array
    $index = $this->get_index();

    // Load controller files
    foreach ( $index as $controller=>$controller_options ) { 

      $controller_slug  = $controller;
      $controller_class = $controller_options['class'];
      $controller_filepath  = $controller_options['filepath'];

      if ( isset( $controller_slug ) && isset( $controller_class ) && isset( $controller_filepath )) {

        if ( !class_exists( $controller_class ) && file_exists($controller_filepath) ) {

          // include controller class file
          require_once( $controller_filepath );

        }
      } 
    }
  }

  /** 
   * Loads and initiates object groups classes (i.e. post types / taxonomy classes) of the given controller.
   *
   * @param $controller_slug (string)
   * @return bool
   * @since 1.0
   *
   */
  private function load_features( ) {

    //load plethora classes index and check if is array
    $index = $this->get_index();

    // ATTENTION...we need unset metaboxes, as they are already loaded by controller itself
    if ( array_key_exists('metabox', $index)) {

        $metabox_index = $index['metabox'];
        unset($index['metabox']);
    }         
    // Get controllers
    foreach ( $index as $controller=>$options ) { 

      $controller_slug  = $controller;
      $controller_class = $options['class'];
      $controller_filepath  = $options['filepath'];
      $controller_features  = $options['features'];

      if ( class_exists( $controller_class ) && file_exists($controller_filepath) ) {

         // Load controller files
        foreach ( $controller_features as $feature=>$feature_info ) { 
          $feature_slug  = $feature;
          $feature_theme = $feature_info['theme'];
          $feature_class = $feature_info['class'];
          $feature_file  = $feature_info['file'];
          $feature_filepath  = $feature_info['filepath'];

          if ( file_exists($feature_filepath) && $this->feature_status( $feature_file )  ) {

            // include controller class file
            require_once( $feature_filepath );

            // If class and 'get_feature_options' method exist...get them!
            if ( class_exists($feature_class) && method_exists( $feature_class, 'get_feature_options' )) { 

              // Instantiate the class
              $class_instance = new $feature_class;

              // Get feature information array, using the classic 'get_feature_options'
              $feature_options = $class_instance->get_feature_options();

              // Add theme info ( parent / child )
              if ( $feature_theme == 'child' && isset( $feature_options['options_title'] )) { $feature_options['options_title'] = $feature_options['options_title'] .' ( child )'; }

              $index[$controller_slug]['features'][$feature_slug]['feature_options'] = $feature_options;

           } 
          }
        }
      }
    }

  // put back metabox
  array_unshift( $index, $metabox_index );
   // Save changes
  $this->update_index($index);

  }

  /** 
   * Set up all theme options
   * Also, theme-functions.php will replace the functions.php for devs who want to extend Plethora core
   *
   * @return bool
   * @since 1.0
   *
   */
  private function load_theme_options() { 
    // Load theme options class
    if (file_exists( get_template_directory() . '/includes/theme-options.php' )) { 
 
      require_once( get_template_directory() . '/includes/theme-options.php' );

    }
  }

  /** 
   * Set up all theme functions. This
   *
   * @since 1.0
   *
   */
  private function load_theme_functions() { 
    // Load theme used only functions class
    if (file_exists( get_template_directory() . '/includes/theme-functions.php' )) { 
 
      require_once( get_template_directory() . '/includes/theme-functions.php' );

    }
    // Load theme html returning functions class
    if (file_exists( get_template_directory() . '/includes/theme-html.php' )) { 
 
      require_once( get_template_directory() . '/includes/theme-html.php' );

    }    

  }

  // HELPER FUNCTIONS | PLETHORA INDEX ------->>>>>> START

  /**
   * INDEX | Returns plethora_classes index
   *
   * @return array 
   * @since 1.1.1
   *
   */
  private function get_index() {

    // VERY IMPORTANT FOR UPDATES: Compare plugin saved version with this one. If first time after update, empty saved index to force rescanning the installation
    $plethora_version_installed = get_option( 'plethora_version_installed' );
    if (  $plethora_version_installed != PLETHORA_VERSION ) { 

      Plethora_CMS::update_option('plethora_version_installed', PLETHORA_VERSION );
      Plethora_CMS::update_option( PLETHORA_CLASSES_OPTNAME , array() );

    }

    $index = !empty( $this->plethora_classes ) ? $this->plethora_classes : array();
    return $index;

  }

  /**
   * INDEX | Updates index attribute
   *
   * @return array 
   * @since 1.1.1
   * 
   */
  private function update_index( $index ) {
 
        //$update = Plethora_CMS::update_option(PLETHORA_CLASSES_OPTNAME, $index );
        $this->plethora_classes = $index; 
 
  }

  /**
   * INDEX | Saves index on DB
   *
   * @return array 
   * @since 1.1.1
   * 
   */
  private function save_index() {
 
       $index = $this->plethora_classes; 
       $update = Plethora_CMS::update_option(PLETHORA_CLASSES_OPTNAME, $index );
  }

  /**
   * INDEX | Returns information from file. The array returns the following: type, slug, file, filepath, class, $parent_slug
   *
   * @param $file, $returnval, $theme
   * @return array
   * @since 1.1.1
   * 
   */
  private function get_indexinfo_from_file( $file, $returnval = '', $theme = 'parent' ) {
    
        $return = array();
        $return['file'] = $file;
        $return['filepath'] = $file;
        $return['type'] = 'uknown';
        $return['slug'] = '';
        $return['class'] = '';
        $return['parent_slug'] = '';

        if ( empty($file) ) { return $return; }

        // Check if filename is composed out of two parts divided by dash. If not, return uknwown info
        $file_name = str_replace( '.php', '', $file );
        $file_name = explode('-', $file_name);

        // If this name contained hust out of two parts, then this is a feature class format
        if ( isset( $file_name[1] ) && !isset( $file_name[2] ) ) { 

            // If file name starts with the Plethora prefix, then this is a controller
            if ( substr($file, 0, strlen(PLETHORA_PREFIX)) == PLETHORA_PREFIX ) { 

                // fix the slug name
                $slug = str_replace( PLETHORA_PREFIX .'-', '', $file );
                $slug = str_replace( '.php', '', $slug );
                $slug = strtolower( $slug );

                // fix the class name
                $class = ucfirst( PLETHORA_PREFIX ) .'_'. ucfirst( $slug );

                // Set the returned values
                $return['file'] = $file;
                $return['filepath'] = THEME_CORE_DIR . '/'. $file;
                $return['type'] = 'controller';
                $return['slug'] = $slug;
                $return['class'] = $class;
                $return['parent_slug'] = '';

            // else, this is feature class      
            } else { 

                // fix slugs
                $parent_slug    = $file_name[0];
                $slug           = strtolower( $file_name[1] );
                $slug           = strtolower( $slug );
 
                // fix the class name
                $class = ucfirst( PLETHORA_PREFIX ) .'_'. ucfirst( $file_name[0] ) .'_'. ucfirst( $slug );

                 // Set the returned values
                $return['file'] = $file;
                $return['filepath'] = $theme == 'child' ? CHILD_INCLUDES_DIR . '/'. $parent_slug .'/'. $file : THEME_INCLUDES_DIR . '/'. $parent_slug .'/'. $file;
                $return['type'] = 'feature';
                $return['slug'] = $slug;
                $return['class'] = $class;
                $return['parent_slug'] = $parent_slug;
            }
        } 

        // Return values according to $returnval
        switch ($returnval) {
          case 'file':
            return $return['file'];
            break;
          case 'filepath':
            return $return['filepath'];
            break;
          case 'type':
            return $return['type'];
            break;
          case 'slug':
            return $return['slug'];
            break;
          case 'class':
            return $return['class'];
            break;
          case 'parent_slug':
            return $return['parent_slug'];
            break;
          default:
            return $return;
            break;
        }

  }

  /**
   * INDEX | Returns true if the file is a controller false if it is not 
   *
   * @param $file
   * @return bool 
   * @since 1.1.1
   * 
   */
  private function is_controller( $file ) {
 
    $type = $this->get_indexinfo_from_file( $file, 'type' );
    if ( $type == 'controller' ) { 

      return true;

    } else { 

      return false;

    }

  }

   /**
   * INDEX | Returns true if the file is a feature false if it is not 
   *
   * @param $file
   * @return bool 
   * @since 1.1.1
   * 
   */
  private function is_feature( $file ) {
 
    $type = $this->get_indexinfo_from_file( $file, 'type' );
    if ( $type == 'feature' ) { 

      return true;

    } else { 

      return false;

    }
 
  } 

  /**
   * INDEX | Adding a Plethora class file to index. It returns TRUE if file is indexed and FALSE if file is not indexed.
   *
   * @param $file, $theme
   * @return array 
   * @since 1.1.1
   * 
   */
  private function add_to_index( $file, $theme = 'parent' ) {

    // Check if this is already indexed...otherwise don't bother
    //if ( $this->is_indexed( $file, $theme )) { return true; }

    $index        = $this->get_index();
    $filepath     = $this->get_indexinfo_from_file( $file, 'filepath', $theme );
    $slug         = $this->get_indexinfo_from_file( $file, 'slug', $theme );
    $class        = $this->get_indexinfo_from_file( $file, 'class', $theme );
    $parent_slug  = $this->get_indexinfo_from_file( $file, 'parent_slug', $theme );
 

    if ( $this->is_controller( $file )) { 

      $index[$slug] = array(
                        'file'      => $file,
                        'filepath'  => $filepath,
                        'class'     => $class,
                        'controller_options' => array( 'auto_instantiate' => 0 ),
                        'features'  => array(),
                    );
      $this->update_index($index);
      return true;

    } elseif ( $this->is_feature($file) ) { 

        if ( isset( $index[$parent_slug] ) && isset( $index[$parent_slug]['features'] )) { 

          $index[$parent_slug]['features'][$slug] = array(
                          'theme' => $theme,
                          'file'  => $file,
                          'filepath'  => $filepath,
                          'class' => $class,
                          'auto_instantiate' => 'no',
                          'feature_options' => array( 'switchable' => 1, 'options_title'  => $class, 'options_subtitle'  => $file, 'options_desc' => '')
                      );
          $this->update_index($index);
          return true;

        } else { 

           return false;
        }

    } 
  }

    /**
   * INDEX | Returns theme options for feature activation/deactivation
   *
   * @param $type, $class
   * @return array 
   * @since 1.1.1
   * 
   */
  private function feature_status( $file ) {

    // Get theme options, in order to check activated/deactivated features
    $plethora_settings = Plethora_CMS::get_option( THEME_OPTVAR );

    $slug         = $this->get_indexinfo_from_file( $file, 'slug' );
    $class        = $this->get_indexinfo_from_file( $file, 'class' );
    $parent_slug  = $this->get_indexinfo_from_file( $file, 'parent_slug' );
 
    $feature_status_optionname = ''. $parent_slug .'-'. $slug .'-status';
    $feature_status = isset($plethora_settings[$feature_status_optionname]) ? $plethora_settings[$feature_status_optionname] : true;

    return $feature_status;

  }
  // HELPER FUNCTIONS | PLETHORA INDEX <<<<<<<------ END


  // HELPER FUNCTIONS | PLETHORA THEME ------->>>>>> START

  /**
   * Returns current page's postid, even if it is a blog page...if page is fphp
   *
   * @param 
   * @return number / string ('nonstatic', '404page')
   * @since 1.0
   *
   */

  static function get_the_id() {

    if ( ( is_front_page() && is_home() ))  { // This is not a desired output...users should select static pages for home/blog 

      $id = 'nonstatic';

    } elseif (  is_404() ) { 

      $id = '404page';

    } elseif ( is_home() || is_search() || is_archive() || is_category() || is_tag() || is_author() || is_date() ) { 

      $id = Plethora_CMS::get_option('page_for_posts');
      $id = apply_filters('plethora_page_for_archive', $id); // Hook for special archive pages

    } else { 

      $id = get_queried_object_id();
    
    }           

    return $id;
    

  }    

  /**
   * THEME | This is a method for displaying post/pages override options. Checks post meta, if nothing found uses the default option
   * $postid should be given on call, when we need to get other posts info (e.g. inside posts page loop). Otherwise, is not necessary!
   *
   * @param $option_id, $user_value, $postid
   * @return string/array/bool
   * @since 1.0
   *
   */

  public static function option( $option_id, $user_value = '', $postid = 0, $comment = true ) {

    // if no postid is given, use get_the_ID(). 
    if ($postid == 0) { 

        $postid = self::get_the_id();

    } 

    // If $postid is a number, then search first if post has saved a value for this option on its metaboxes
    if ( is_numeric( $postid ))  {  

      $post_option_val = get_post_meta( $postid, $option_id, true );
    
    } else { 

      $post_option_val = '';

    }

    // If nothing is found on this post meta, then check theme defaults for this option, otherwise use value that set on option call
    if ( ( is_array($post_option_val) && empty($post_option_val) ) || ( !is_array($post_option_val) && $post_option_val == '' )) { 

        $theme_options = Plethora_CMS::get_option( THEME_OPTVAR ); // Use this please...NOT SAFE TO USE the global option
        $theme_option_val = ( isset( $theme_options[$option_id] )) ? $theme_options[$option_id] : $user_value;
        $source = ( isset( $theme_options[$option_id] )) ? 'Theme options value' : 'Attention...option id was not found, value given on option call';
        $option_val = $theme_option_val;

    } else { 

      $option_val = $post_option_val;
      $source = 'Post meta value';

    }
    
    // Produce a comment
    if ( is_array( $option_val )) { $comment_option_val = json_encode($option_val); } else { $comment_option_val = $option_val; }

    if ( $comment == true ) { 
      self::dev_comment('Option called (postid|option|value|info): '. $postid .' | '. $option_id .' | '. $comment_option_val .' | '. $source .'', 'options');
    }
    // Return the value
    return $option_val;

  }

  /**
   * THEME | Handles developer comments according to theme settings
   *
   * @param $comment, $commentgroup
   * @return string
   * @since 1.0
   *
   */

  public static function dev_comment( $comment = '', $commentgroup = '' ) {

    if ( !is_admin() && !is_feed() && current_user_can('manage_options') ) { 
    
      global $cleanstart_options; // Get theme options

      $commentgroup_status = isset( $cleanstart_options['dev-comments-'. $commentgroup .''] ) ? $cleanstart_options['dev-comments-'. $commentgroup .''] : 'disable';
      $commentgroup_status = isset( $cleanstart_options['dev-comments-'. $commentgroup .''] ) ? $cleanstart_options['dev-comments-'. $commentgroup .''] : 'disable';

      if ( $commentgroup_status == 'enable' && !empty( $comment ) ) { 

          print_r( "\n".'<!-- '. $comment .'  -->'."\n" );

      }
    }

  }

  public static function page_dev_comment() { 

    if ( is_front_page() && is_home() ) {

        return 'This is the default \'Your latest posts\' front page. You should change this, by selecting a static page for Front Page / Posts Page on Reading settings';

    } elseif ( is_front_page() ) {

        return 'This is a Static Front Page you selected on Reading Settings. You may edit this page by clicking \'Edit page\' on your admin bar';

    } elseif ( is_home() ) {

        return 'This is a Static Posts Page ( Blog ) you selected on Reading Settings. You may affect this page look, using the \'Cleanstart Settings > Blog\' options panel.';

    } elseif ( is_search() ) {

        return 'This is a Search Page. You may affect this page look, using the \'Cleanstart Settings > Blog\' options panel';

    } elseif ( is_404() ) {

        return 'This is a 404 Page. You may affect this page look, using the \'Cleanstart Settings > 404 Page\' options panel';

    } else {
     
        if ( is_page() ) { 

        return 'This is a single Page. You may edit this page by clicking \'Edit page\' on your admin bar.';

        } elseif ( is_single() ) {

        return 'This is a single '. ucfirst( get_post_type() ) .' page. You may edit this page by clicking \'Edit '. ucfirst( get_post_type() ) .'\' on your admin bar ' ;

        } elseif ( is_archive() ) {

          if ( is_category() ) {
            return 'This is an archive CATEGORY page for'. ucfirst( get_post_type() ) .'s. You may affect this page look, using the \'Cleanstart Settings > Blog\' options panel.' ;

          } elseif ( is_tag() ) {
            return 'This is an archive TAG page for '. ucfirst( get_post_type() ) .'s. You may affect this page look, using the \'Cleanstart Settings > Blog\' options panel.' ;

          } elseif ( is_tax() ) {
            return 'This is an archive CUSTOM TAXONOMY page for '. ucfirst( get_post_type() ) .'s. You may affect this page look, using the \'Cleanstart Settings > Blog\' options panel.' ;

          } elseif ( is_date() ) {
            return 'This is an archive DATE-BASED page for '. ucfirst( get_post_type() ) .'s. You may affect this page look, using the \'Cleanstart Settings > Blog\' options panel.' ;

          } else { 
            return 'This is an archive page for '. ucfirst( get_post_type() ) .'s. You may affect this page look, using the \'Cleanstart Settings > Blog\' options panel.' ;
          }

        }
    }

  }

  // HELPER FUNCTIONS | PLETHORA THEME <<<<<<<------ END
}