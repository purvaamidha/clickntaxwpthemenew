<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M 				   (c) 2013

File Description: Controller class for Navwalker

*/

if ( ! defined( 'ABSPATH' ) ) exit; // NO DIRECT ACCESS 


if ( !class_exists('Plethora_Module_Navwalker') ) {

	// NAVWALKER CODE

	/**
	 * Class Name: wp_bootstrap_navwalker
	 * GitHub URI: https://github.com/twittem/wp-bootstrap-navwalker
	 * Description: A custom WordPress nav walker class to implement the Bootstrap 3 navigation style in a custom theme using the WordPress built in menu manager.
	 * Version: 2.0.4
	 * Author: Edward McIntyre - @twittem
	 * License: GPL-2.0+
	 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
	 */


	class Plethora_Module_Navwalker extends Walker_Nav_Menu {


       /** 
       * Returns feature information for several uses by Plethora Core (theme options etc.)
       *
       * @return array
       * @since 1.0
       *
       */
       public static function get_feature_options() {

          $feature_options = array ( 
				'switchable'         => true,
				'options_title'      => 'Navwalker module',
				'options_subtitle'   => 'Activate/deactivate Navwalker module',
				'options_desc'       =>   'On deactivation, all settings related to this feature will be removed. However, they will not be deleted permanently.',
            );
          
          return $feature_options;
       }


		/**
		 * @see Walker::start_lvl()
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param int $depth Depth of page. Used for padding.
		 */
		public function start_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat( "\t", $depth );
			$output .= "\n$indent<ul role=\"menu\" class=\" dropdown-menu\">\n";
		}

		/**
		 * @see Walker::start_el()
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param object $item Menu item data object.
		 * @param int $depth Depth of menu item. Used for padding.
		 * @param int $current_page Menu item ID.
		 * @param object $args
		 */
		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
			// echo mysql_fetch_array($item);

			/**
			 * Dividers, Headers or Disabled
			 * =============================
			 * Determine whether the item is a Divider, Header, Disabled or regular
			 * menu item. To prevent errors we use the strcasecmp() function to so a
			 * comparison that is not case sensitive. The strcasecmp() function returns
			 * a 0 if the strings are equal.
			 */
			if ( strcasecmp( $item->attr_title, 'divider' ) == 0 && $depth === 1 ) {
				$output .= $indent . '<li role="presentation" class="divider">';
			} else if ( strcasecmp( $item->title, 'divider') == 0 && $depth === 1 ) {
				$output .= $indent . '<li role="presentation" class="divider">';
			} else if ( strcasecmp( $item->attr_title, 'dropdown-header') == 0 && $depth === 1 ) {
				$output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );
			} else if ( strcasecmp($item->attr_title, 'disabled' ) == 0 ) {
				$output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';
			} else {
				$class_names = $value = '';
				$classes     = empty( $item->classes ) ? array() : (array) $item->classes;
				$classes[]   = 'menus-item-' . $item->ID;
				$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

				if ( is_object($args) && $args->has_children ) {
					$class_names .= ' cursor';
				} else {
					$class_names .= ' menu_expand';
				}
				if ( in_array( 'current-menu-item', $classes ) )
					$class_names .= ' active';
				
				// $class_names .= ' menuShadow';
				$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

				$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
				$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

				// echo "amrendra: " . $indent;
				$output .= $indent . '<li' . $id . $value . $class_names .'>';

				$atts = array();
				$atts['title']  = ! empty( $item->attr_title )	? $item->attr_title	: $item->title ;
				$atts['target'] = ! empty( $item->target )	? $item->target	: '';
				$atts['rel']    = ! empty( $item->xfn )		? $item->xfn	: '';
				
				/*adding desc 
				$atts['description']  = ! empty( $item->attr_description )	? $item->attr_description	: $item->description;
				*/

				// If item has_children add atts to a.
				if ( is_object($args) && $args->has_children && $depth === 0 ) {
					$atts['href']   		= '#';
				} else {
					$atts['href'] = ! empty( $item->url ) ? $item->url : '';
				}

				$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

				$attributes = '';
				foreach ( $atts as $attr => $value ) {
					if ( ! empty( $value ) ) {
						$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
						$attributes .= ' ' . $attr . '="' . $value . '"';
					}
				}

				if ( is_object($args) ) { $item_output = $args->before; }

				/*
				 * Glyphicons
				 * ===========
				 * Since the the menu item is NOT a Divider or Header we check the see
				 * if there is a value in the attr_title property. If the attr_title
				 * property is NOT null we apply it as the class name for the glyphicon.
				 */
				if ( isset($item_output) ){
					if ( ! empty( $item->attr_title ) )
						$item_output .= '<a'. $attributes .'><span class="glyphicon ' . esc_attr( $item->attr_title ) . '"></span>&nbsp;';
					else
						$item_output .= '<a'. $attributes .'>';

					$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;


					$item_output .= ( $args->has_children && 0 === $depth ) ? ' <span class="caret"></span></a>' : '</a>';
					
					
					//add
					//$item_output .= $item->attr_desc;//adding desc
					//$item_output .= $item->attr_title;// adding title
					$item_output .= $args->after;
					$item_output .= $item->attr_desc;// adding 2 things
					$item_output .= $item->attr_title;

					// $item_output .= '<img src="https://www.hrblock.in/img/Notch.png" style="margin-top: -20px; margin-left: 20px; position: fixed;" class="clsNotchTaxServices">'

					if($item->description) {
						$item_output .= '<div class="navMenuSubtext"> '. $item->description .'</div>';
					}

					$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

				} else {

					$output = '<li><a href="'. admin_url('nav-menus.php') .'">'. __( "Please Create a Menu", 'cleanstart' ) . '</a>';

				}

			}
		}

		/**
		 * Traverse elements to create list from elements.
		 *
		 * Display one element if the element doesn't have any children otherwise,
		 * display the element and its children. Will only traverse up to the max
		 * depth and no ignore elements under that depth.
		 *
		 * This method shouldn't be called directly, use the walk() method instead.
		 *
		 * @see Walker::start_el()
		 * @since 2.5.0
		 *
		 * @param object $element Data object
		 * @param array $children_elements List of elements to continue traversing.
		 * @param int $max_depth Max depth to traverse.
		 * @param int $depth Depth of current element.
		 * @param array $args
		 * @param string $output Passed by reference. Used to append additional content.
		 * @return null Null on failure with no changes to parameters.
		 */
		public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
	        if ( ! $element )
	            return;

	        $id_field = $this->db_fields['id'];

	        // Display this element.
	        if ( is_object( $args[0] ) )
	           $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );

	        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	    }

		/**
		 * Menu Fallback
		 * =============
		 * If this function is assigned to the wp_nav_menu's fallback_cb variable
		 * and a manu has not been assigned to the theme location in the WordPress
		 * menu manager the function with display nothing to a non-logged in user,
		 * and will add a link to the WordPress menu manager if logged in as an admin.
		 *
		 * @param array $args passed from the wp_nav_menu function.
		 *
		 */
		public static function fallback( $args ) {
			if ( current_user_can( 'manage_options' ) ) {

				extract( $args );

				$fb_output = null;

				if ( $container ) {
					$fb_output = '<' . $container;

					if ( $container_id )
						$fb_output .= ' id="' . $container_id . '"';

					if ( $container_class )
						$fb_output .= ' class="' . $container_class . '"';

					$fb_output .= '>';
				}

				$fb_output .= '<ul';

				if ( $menu_id )
					$fb_output .= ' id="' . $menu_id . '"';

				if ( $menu_class )
					$fb_output .= ' class="' . $menu_class . '"';

				$fb_output .= '>';
				$fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">'. __( "Please Create a Menu", 'cleanstart' ) . '</a></li>';
				$fb_output .= '</ul>';

				if ( $container )
					$fb_output .= '</' . $container . '>';

				echo $fb_output;
			}
		}
	}
}