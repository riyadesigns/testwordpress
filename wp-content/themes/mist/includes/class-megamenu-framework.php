<?php
/**
 * ZozoThemes Mega Menu Framework
 *
 * This file holds Mega Menu Core Framework. 
 *
 * @version: 1.0.0
 * @package  Zozothemes
 * @author   Zozothemes
 * @link     http://zozothemes.com
 */

// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ) { exit; }

if( ! class_exists( 'Zozo_Mega_Menu_Core' ) ) {

    /**
     * Zozo_Mega_Menu_Core Class Init
	 * @package Zozothemes
     */
    class Zozo_Mega_Menu_Core {
	
		/**
		 * Zozo_Mega_Menu_Core constructor		
		 * @package Zozothemes
		 */
        function __construct() {
			
			// Adds Stylesheets and Scripts
			add_action( 'admin_menu', array( $this, 'zozo_menu_enqueue_scripts' ) );
			
			// Add Custom Nav fields to menu
			add_filter( 'wp_setup_nav_menu_item', array( $this, 'zozo_add_custom_fields' ) );
			
			// Update Custom Nav fields to menu
			add_action( 'wp_update_nav_menu_item', array( $this, 'zozo_update_custom_fields' ), 10, 3 );
			
			// Edit Custom Nav fields to menu
            add_filter( 'wp_edit_nav_menu_walker', array( $this, 'zozo_edit_custom_fields' ), 10, 2 );

        }


		/**
		 * Register Megamenu stylesheets and scripts		
		 */
		function zozo_menu_enqueue_scripts() {

			// scripts
			wp_register_script( 'zozo-megamenu', get_template_directory_uri() . '/framework/admin/assets/js/zozo-megamenu.js', array( 'jquery' ), false, true );
			wp_enqueue_script( 'zozo-megamenu' );
			
			wp_register_style( 'zozo_megamenu_admin', get_template_directory_uri() . '/framework/admin/assets/css/zozo-megamenu.css' );
			wp_enqueue_style( 'zozo_megamenu_admin' );
			
		}
		
		/**
		 * Add custom fields to menu		
		 *		
		 * @return object custom fields menu object
		*/
		function zozo_add_custom_fields( $menu_item ) {
		
			$menu_item->zozo_megamenu_menutype = get_post_meta( $menu_item->ID, '_menu_item_zozo_megamenu_menutype', true );
			$menu_item->zozo_megamenu_status = get_post_meta( $menu_item->ID, '_menu_item_zozo_megamenu_status', true );
			$menu_item->zozo_megamenu_fullwidth = get_post_meta( $menu_item->ID, '_menu_item_zozo_megamenu_fullwidth', true );
			$menu_item->zozo_megamenu_columns = get_post_meta( $menu_item->ID, '_menu_item_zozo_megamenu_columns', true );
            $menu_item->zozo_megamenu_title = get_post_meta( $menu_item->ID, '_menu_item_zozo_megamenu_title', true );
			$menu_item->zozo_megamenu_link = get_post_meta( $menu_item->ID, '_menu_item_zozo_megamenu_link', true );
			$menu_item->zozo_megamenu_widgetarea = get_post_meta( $menu_item->ID, '_menu_item_zozo_megamenu_widgetarea', true );
            $menu_item->zozo_megamenu_content = get_post_meta( $menu_item->ID, '_menu_item_zozo_megamenu_content', true );
			$menu_item->zozo_megamenu_icon = get_post_meta( $menu_item->ID, '_menu_item_zozo_megamenu_icon', true );
			
			return $menu_item;	    
		}
		
		/**
         * Save the custom fields menu item data
         *
         * @return void
         */
        function zozo_update_custom_fields( $menu_id, $menu_item_db_id, $args ) {

			$cf_name_suffix = array( 'menutype', 'status', 'fullwidth', 'columns', 'title', 'link', 'widgetarea', 'content', 'icon' );

			foreach ( $cf_name_suffix as $key ) {
				if( !isset( $_REQUEST['menu-item-zozo-megamenu-'.$key][$menu_item_db_id] ) ) {
					$_REQUEST['menu-item-zozo-megamenu-'.$key][$menu_item_db_id] = '';
				}

				$value = $_REQUEST['menu-item-zozo-megamenu-'.$key][$menu_item_db_id];
				update_post_meta( $menu_item_db_id, '_menu_item_zozo_megamenu_'.$key, $value );
			}
        }
		
		/**
         * New Walker for Menu
         *
         * @return string Class name of new navwalker
         */
        function zozo_edit_custom_fields() {

            return 'Zozo_Backend_Walker_Nav_Menu';

        }

	}

	$zozo_mega_menu = new Zozo_Mega_Menu_Core();

}

if( ! class_exists( 'ZozoMegaMenuFrontendWalker' ) ) {
	class ZozoMegaMenuFrontendWalker extends Walker_Nav_Menu {

		/**
		 * @var string $zozo_megamenu_status holds information about we currently rendering a mega menu or not
		 */
		private $zozo_megamenu_status = "";		
		
		/**
		 * @var string $zozo_megamenu_fullwidth use full width mega menu?
		 */
		private $zozo_megamenu_fullwidth = "";

		/**
		 * @var int $columns_count holds number of columns in mega menu 
		 */
		private $columns_count = 0;

		/**
		 * @var int $max_columns maximum number of columns within mega menu 
		 */
		private $max_columns = 4;
		
		/**
		 * @var int $total_columns total number of columns within a mega menu
		 */
		private $total_columns = 0;
		
		/**
		 * @var int $total_rows number of rows in the mega menu
		 */
		private $total_rows = 1;

		/**
		 * @var array $rows_counter holds number of columns per row
		 */
		private $rows_counter = array();

		/**
		 * @var string $zozo_megamenu_title holds to display column title
		 */
		private $zozo_megamenu_title = '';
		
		/**
		 * @var string $zozo_megamenu_link holds to have link for column title
		 */
		private $zozo_megamenu_link = '';
		
		/**
		 * @var string $zozo_megamenu_widgetarea holds widget area
		 */
		private $zozo_megamenu_widget_area = '';

		/**
		 * @var string $zozo_megamenu_content holds menu content
		 */
		private $zozo_megamenu_content = '';

		/**
		 * @var string $zozo_megamenu_icon holds menu item icon
		 */
		private $zozo_megamenu_icon = '';

		/**
		 * @see Walker::start_lvl()		
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param int $depth Depth of page. Used for padding.
		 */
		public function start_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat( "\t", $depth );

			if( $depth === 0 && $this->zozo_megamenu_status == "enabled" ) {
				$output .= "\n{first_level}\n";
				$output .= "\n$indent<div class=\"row zozo-megamenu-container\" >\n<ul class='zozo-megamenu col-md-12'>\n";
			} elseif( $depth === 0 ) {
				$output .= "\n$indent<ul role=\"menu\" class=\" dropdown-menu sub-nav\">\n";
			} elseif( $depth >= 2 && $this->zozo_megamenu_status == "enabled" ) {
				$output .= "\n$indent<ul role=\"menu\" class=\"sub-menu sub-menu-2 sub-nav depth-level\">\n";
			} elseif( $depth >= 2 ) {
				$output .= "\n$indent<ul role=\"menu\" class=\"sub-menu sub-menu-2 sub-nav depth-level\">\n";
			} else {
				$output .= "\n$indent<ul role=\"menu\" class=\"sub-menu sub-nav\">\n";
			}		
			
		}

		/**
		 * @see Walker::end_lvl()		 
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param int $depth Depth of page. Used for padding.
		 */
		public function end_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat( "\t", $depth );
			$row_width = '';

			if( $depth === 0  && $this->zozo_megamenu_status == "enabled" ) {

				$output .= "\n</ul>\n</div>\n</div>\n";
				
				if( $this->total_columns < $this->max_columns ) {
					$col_width = 12 / $this->total_columns;
					$col_classes = " col-md-" . $col_width;
				} else {					
					$col_classes = " max-col-" . $this->max_columns;
				}
				
				if ( $this->zozo_megamenu_fullwidth == "enabled" ) {
					$col_classes .= " megamenu-fullwidth";
				} else {
					$col_classes .= " container";
				}
				
				$output = str_replace( "{first_level}", "<div class='zozo-megamenu-wrapper columns-".$this->total_columns. $col_classes . "'>", $output );
				
				$responsive_class = '';
				foreach($this->rows_counter as $row => $columns) {
				
					$columns_width = 12 / $columns;					
					
					if ( $this->total_columns > $this->max_columns ) {
						$columns_width = 12 / $this->max_columns;
					}
					
					if( $columns >= 2 ) {
						$responsive_class = " col-sm-6";
					} else {
						$responsive_class = " col-sm-12";
					}
										
					$output = str_replace( "{row_number_".$row."}", "col-sm-12 zozo-megamenu-row-columns-" . $columns, $output);
										
					$output = str_replace( "{current_row_".$row."}", "zozo-megamenu-columns-".$columns." col-md-" . $columns_width . " ". $responsive_class ." ", $output );
				}
			} else {
				$output .= "$indent</ul>\n";
			}
		}

		/**
		 * @see Walker::start_el()		 
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param object $item Menu item data object.
		 * @param int $depth Depth of menu item. Used for padding.
		 * @param int $current_page Menu item ID.
		 * @param object $args
		 */
		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		
			$item_output = $column_classes = '';
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
			
			/* Get Stored vars */
			if( $depth === 0 ) {

				$this->zozo_megamenu_status = get_post_meta( $item->ID, '_menu_item_zozo_megamenu_status', true );
				$this->zozo_megamenu_fullwidth = get_post_meta( $item->ID, '_menu_item_zozo_megamenu_fullwidth', true );
				$menu_columns_count = get_post_meta( $item->ID, '_menu_item_zozo_megamenu_columns', true );
				if( $menu_columns_count != "auto" ) {
					$this->max_columns = $menu_columns_count;
				}			
				$this->columns_count = $this->total_columns = 0;
			}

			$this->zozo_megamenu_title = get_post_meta( $item->ID, '_menu_item_zozo_megamenu_title', true);
			$this->zozo_megamenu_link = get_post_meta( $item->ID, '_menu_item_zozo_megamenu_link', true);
			$this->zozo_megamenu_widget_area = get_post_meta( $item->ID, '_menu_item_zozo_megamenu_widgetarea', true);
			$this->zozo_megamenu_content = get_post_meta( $item->ID, '_menu_item_zozo_megamenu_content', true);
			$this->zozo_megamenu_icon = get_post_meta( $item->ID, '_menu_item_zozo_megamenu_icon', true);			

			/* Inside Megamenu */
			if( $depth === 1 && $this->zozo_megamenu_status == "enabled" ) {

				$this->columns_count++;
				$this->total_columns++;
				
				/* Check columns count with maximum columns allowed to start new row */
				if( $this->columns_count > $this->max_columns ) {
					$this->columns_count = 1;
					$this->total_rows++;
					$output .= "\n</ul>\n<ul class=\"zozo-megamenu row-".$this->total_rows." {row_number_".$this->total_rows."}\">\n";
				}

				$this->rows_counter[$this->total_rows] = $this->columns_count;

				if( $this->max_columns < $this->columns_count ) { $this->max_columns = $this->columns_count; }

				$title = apply_filters( 'the_title', $item->title, $item->ID );

				if( $title != "-" && $title != '"-"' ) {
					$heading_title = do_shortcode($title);
					$link = '';
					$link_url = '';
					$link_end = '';

					if( ! empty($item->url) && $item->url != "#" && $item->url != 'http://' && ! $this->zozo_megamenu_link ) {
					
						$link_url = zozo_get_parallax_link( $item );
						
						$link = '<a href="' . $link_url . '">';
						$link_end = '</a>';
					}

					/* Check to set icon or bullet */
					$title_extras = '';
					if( ! empty( $this->zozo_megamenu_icon ) ) {
						if( strpos($this->zozo_megamenu_icon, 'fa-') !== false ) {
							$icon_class = "fa";
						}
						
						if( strpos($this->zozo_megamenu_icon, 'glyphicon-') !== false ) {
							$icon_class = "glyphicon";
						}
						$title_extras = '<span class="zozo-megamenu-icon"><i class="' . $icon_class .' ' . $this->zozo_megamenu_icon. '"></i></span>';
					} elseif($this->zozo_megamenu_title == 'disabled') {
						$title_extras = '<span class="zozo-megamenu-bullet"><i class="fa fa-angle-right"></i></span>';
					}

					$heading_title = sprintf( '%s%s%s%s', $link, $title_extras, $title, $link_end );

					if( $this->zozo_megamenu_title != 'disabled' ) {
						$item_output .= "<h6 class='zozo-megamenu-title'>" . $heading_title . "</h6>";
					} else {
						$item_output .= "";
					}
					
				}
				
				if( $this->zozo_megamenu_widget_area && is_active_sidebar( $this->zozo_megamenu_widget_area ) ) {
					$item_output .= '<div class="zozo-megamenu-widgets-container second-level-widget">';
					ob_start();
						dynamic_sidebar( $this->zozo_megamenu_widget_area );

					$item_output .= ob_get_clean() . '</div>';
				} else {

					if( $this->zozo_megamenu_content ) {
						$item_output .= '<div class="zozo-megamenu-content-container second-level-content">';
						ob_start();
							echo do_shortcode( $this->zozo_megamenu_content );
	
						$item_output .= ob_get_clean() . '</div>';
					}
					
				}

				$column_classes = ' {current_row_'.$this->total_rows.'}';
				
				if($this->columns_count == 1)
				{
					$column_classes .= " zozo_megamenu_columns_first";
				}

			} else if( $depth === 2 && ( $this->zozo_megamenu_widget_area || $this->zozo_megamenu_content )&& $this->zozo_megamenu_status == "enabled" ) {
			
				$title = apply_filters( 'the_title', $item->title, $item->ID );

				if( $title != "-" && $title != '"-"' ) {
					$heading = do_shortcode($title);
					$link = '';
					$link_url = '';
					$link_end = '';

					if( ! empty($item->url) && $item->url != "#" && $item->url != 'http://' && ! $this->zozo_megamenu_link ) {
					
						$link_url = zozo_get_parallax_link( $item );
						
						$link = '<a href="' . $link_url . '">';
						$link_end = '</a>';
					
					}

					/* Check to set icon or bullet */
					$title_extras = '';
					if( ! empty( $this->zozo_megamenu_icon ) ) {
						if( strpos($this->zozo_megamenu_icon, 'fa-') !== false ) {
							$icon_class = "fa";
						}
						
						if( strpos($this->zozo_megamenu_icon, 'glyphicon-') !== false ) {
							$icon_class = "glyphicon";
						}
						$title_extras = '<span class="zozo-megamenu-icon"><i class="' . $icon_class .' ' . $this->zozo_megamenu_icon. '"></i></span>';
					} elseif($this->zozo_megamenu_title == 'disabled') {
						$title_extras = '<span class="zozo-megamenu-bullet"><i class="fa fa-angle-right"></i></span>';
					}

					$heading_title = sprintf( '%s%s%s%s', $link, $title_extras, $title, $link_end );

					if( $this->zozo_megamenu_title != 'disabled' ) {
						$item_output .= "<h6 class='zozo-megamenu-title'>" . $heading_title . "</h6>";
					} else {
						$item_output .= "";
					}
					
				}
				
				if( $this->zozo_megamenu_widget_area && is_active_sidebar( $this->zozo_megamenu_widget_area ) ) {
					$item_output .= '<div class="zozo-megamenu-widgets-container third-level-widget">';
					ob_start();
						dynamic_sidebar( $this->zozo_megamenu_widget_area );

					$item_output .= ob_get_clean() . '</div>';
				} else {

					if( $this->zozo_megamenu_content ) {
						$item_output .= '<div class="zozo-megamenu-content-container third-level-content">';
						ob_start();
							echo do_shortcode( $this->zozo_megamenu_content );
	
						$item_output .= ob_get_clean() . '</div>';
					}
					
				}
				
			} else {			
				
				$atts = array();
				$atts['title']  = ! empty( $item->title )		? esc_attr( $item->title ) : '';
				$atts['target'] = ! empty( $item->target )	    ? esc_attr( $item->target ) : '';
				$atts['rel']    = ! empty( $item->xfn )		    ? esc_attr( $item->xfn ) : '';
				
				$link_url = '';
				
				$link_url = zozo_get_parallax_link( $item );
				
				// If item has_children add atts to a.
				if ( $args->has_children && $depth === 0 ) {
					$atts['href']   		= $link_url;
					$atts['data-toggle']	= '';
					$atts['class']			= 'dropdown-toggle';
				} else {
					$atts['href'] = ! empty( $link_url ) ? $link_url : '';
				}
	
				$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );				
	
				$attributes = '';
				foreach ( $atts as $attr => $value ) {
					if ( ! empty( $value ) ) {

						$value = ( 'href' === $attr ) ? esc_attr( $value ) : esc_attr( $value );
						$attributes .= ' ' . $attr . '="' . $value . '"';
						
					}
				}

				$item_output .= $args->before;
				/* Check to set icon or bullet */
				if( ! empty( $this->zozo_megamenu_icon ) && $this->zozo_megamenu_status == "enabled" ) {
					if( strpos($this->zozo_megamenu_icon, 'fa-') !== false ) {
						$icon_class = "fa";
					}
					
					if( strpos($this->zozo_megamenu_icon, 'glyphicon-') !== false ) {
						$icon_class = "glyphicon";
					}
					
					$item_output .= '<a ' . $attributes . '><span class="zozo-megamenu-icon title-menu"><i class="' . $icon_class .' ' . $this->zozo_megamenu_icon . '"></i></span>';
				} elseif ( $depth !== 0 && $this->zozo_megamenu_status == "enabled") {
					$item_output .= '<a ' . $attributes . '><span class="zozo-megamenu-bullet"><i class="fa fa-angle-right"></i></span>';
				} else {
					$item_output .= '<a '. $attributes .'>';
				}

				if( ! empty( $this->zozo_megamenu_icon ) && $this->zozo_megamenu_status == "enabled" ) {
					$item_output .=  '<span class="menu-title">';
				}

				$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

				if( ! empty( $this->zozo_megamenu_icon ) && $this->zozo_megamenu_status == "enabled" ) {
					$item_output .=  '</span>';
				}

				if( $depth === 0 && $args->has_children ) {
					$item_output .= ' <span class="caret"></span></a>';
				} else {
					$item_output .= '</a>';
				}
				$item_output .= $args->after;

			}

			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
			$class_names = $value = '';
			
			$classes = empty( $item->classes ) ? array() : ( array ) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;

			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

			if ( $args->has_children ) {
				if( $depth === 0 && $this->zozo_megamenu_status == "enabled" ) {
					$class_names .= ' zozo-megamenu-menu dropdown';
				} elseif( $depth === 1 && $this->zozo_megamenu_status == "enabled" ) {
					$class_names .= ' zozo-megamenu-submenu';
				} else {
					$class_names .= ' dropdown';
				}
			}
						
            if ( in_array( 'current-menu-item', $classes ) ) {
                $class_names .= ' active';
			}
						
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ). $column_classes . '"' : '';
			
			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $value . $class_names .'>';

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );			
			
		}

		/**
		 * @see Walker::end_el()
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param object $item Page data object. Not used.
		 * @param int $depth Depth of page. Not Used.
		 */
		function end_el( &$output, $item, $depth = 0, $args = array() ) {
			$output .= "</li>\n";
		}		
		
		/**
		 * Traverse elements to create list from elements.		
		 * This method shouldn't be called directly, use the walk() method instead.
		 *
		 * @see Walker::start_el()		 
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
				$fb_output .= '<li><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">Add a menu</a></li>';
				$fb_output .= '</ul>';
	
				if ( $container )
					$fb_output .= '</' . $container . '>';
	
				return $fb_output;
			}
		}
	}  // end ZozoMegaMenuFrontendWalker() class
}


if( ! class_exists( 'Zozo_Backend_Walker_Nav_Menu' ) ) {

    class Zozo_Backend_Walker_Nav_Menu extends Walker_Nav_Menu {

		/**		
		 * @see Walker_Nav_Menu::start_lvl()		
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference.
		 * @param int $depth Depth of menu item.
		 * @param array $args Not used.
		 */
		function start_lvl( &$output, $depth = 0, $args = array() ) {}

		/**		
		 * @see Walker_Nav_Menu::end_lvl()		
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference.
		 * @param int $depth Depth of menu item.
		 * @param array $args Not used.
		 */
		function end_lvl( &$output, $depth = 0, $args = array() ) {}

		/**		
		 * @see Walker_Nav_Menu::start_el()
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param object $item Menu item data object.
		 * @param int $depth Depth of menu item. Used for padding.
		 * @param array $args Not used.
		 * @param int $id Not used.
		 */
		function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			global $_wp_nav_menu_max_depth;
			$_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

			ob_start();
			$item_id = esc_attr( $item->ID );
			$removed_args = array(
				'action',
				'customlink-tab',
				'edit-menu-item',
				'menu-item',
				'page-tab',
				'_wpnonce',
			);

			$original_title = '';
			if ( 'taxonomy' == $item->type ) {
				$original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
				if ( is_wp_error( $original_title ) )
					$original_title = false;
			} elseif ( 'post_type' == $item->type ) {
				$original_object = get_post( $item->object_id );
				$original_title = get_the_title( $original_object->ID );
			}

			$classes = array(
				'menu-item menu-item-depth-' . $depth,
				'menu-item-' . esc_attr( $item->object ),
				'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
			);

			$title = $item->title;

			if ( ! empty( $item->_invalid ) ) {
				$classes[] = 'menu-item-invalid';
				/* translators: %s: title of menu item which is invalid */
				$title = sprintf( __( '%s (Invalid)', 'mist'), $item->title );
			} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
				$classes[] = 'pending';
				/* translators: %s: title of menu item in draft status */
				$title = sprintf( __('%s (Pending)', 'mist'), $item->title );
			}

			$title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;

			$submenu_text = '';
			if ( 0 == $depth )
				$submenu_text = 'style="display: none;"';

			?>
			<li id="menu-item-<?php echo esc_attr( $item_id ); ?>" class="<?php echo implode(' ', $classes ); ?>">
				<dl class="menu-item-bar">
					<dt class="menu-item-handle">
						<span class="item-title"><span class="menu-item-title"><?php echo esc_html( $title ); ?></span> <span class="is-submenu" <?php echo esc_attr( $submenu_text ); ?>><?php _e( 'sub item', 'mist' ); ?></span></span>
						<span class="item-controls">
							<span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
							<span class="item-order hide-if-js">
								<a href="<?php
									echo wp_nonce_url(
										add_query_arg(
											array(
												'action' => 'move-up-menu-item',
												'menu-item' => $item_id,
											),
											remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
										),
										'move-menu_item'
									);
								?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up', 'mist'); ?>">&#8593;</abbr></a>
								|
								<a href="<?php
									echo wp_nonce_url(
										add_query_arg(
											array(
												'action' => 'move-down-menu-item',
												'menu-item' => $item_id,
											),
											remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
										),
										'move-menu_item'
									);
								?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down', 'mist'); ?>">&#8595;</abbr></a>
							</span>
							<a class="item-edit" id="edit-<?php echo esc_attr( $item_id ); ?>" title="<?php esc_attr_e('Edit Menu Item', 'mist'); ?>" href="<?php
								echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
							?>"><?php _e( 'Edit Menu Item', 'mist' ); ?></a>
						</span>
					</dt>
				</dl>

				<div class="menu-item-settings" id="menu-item-settings-<?php echo esc_attr( $item_id ); ?>">
					<?php if( 'custom' == $item->type ) : ?>
						<p class="field-url description description-wide">
							<label for="edit-menu-item-url-<?php echo esc_attr( $item_id ); ?>">
								<?php _e( 'URL', 'mist' ); ?><br />
								<input type="text" id="edit-menu-item-url-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_url( $item->url ); ?>" />
							</label>
						</p>
					<?php endif; ?>
					<p class="description description-thin">
						<label for="edit-menu-item-title-<?php echo esc_attr( $item_id ); ?>">
							<?php _e( 'Navigation Label', 'mist' ); ?><br />
							<input type="text" id="edit-menu-item-title-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
						</label>
					</p>
					<p class="description description-thin">
						<label for="edit-menu-item-attr-title-<?php echo esc_attr( $item_id ); ?>">
							<?php _e( 'Title Attribute', 'mist' ); ?><br />
							<input type="text" id="edit-menu-item-attr-title-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
						</label>
					</p>
					<p class="field-link-target description">
						<label for="edit-menu-item-target-<?php echo esc_attr( $item_id ); ?>">
							<input type="checkbox" id="edit-menu-item-target-<?php echo esc_attr( $item_id ); ?>" value="_blank" name="menu-item-target[<?php echo esc_attr( $item_id ); ?>]"<?php checked( $item->target, '_blank' ); ?> />
							<?php _e( 'Open link in a new window/tab', 'mist' ); ?>
						</label>
					</p>
					<p class="field-css-classes description description-thin">
						<label for="edit-menu-item-classes-<?php echo esc_attr( $item_id ); ?>">
							<?php _e( 'CSS Classes (optional)', 'mist' ); ?><br />
							<input type="text" id="edit-menu-item-classes-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
						</label>
					</p>
					<p class="field-xfn description description-thin">
						<label for="edit-menu-item-xfn-<?php echo esc_attr( $item_id ); ?>">
							<?php _e( 'Link Relationship (XFN)', 'mist' ); ?><br />
							<input type="text" id="edit-menu-item-xfn-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
						</label>
					</p>
					<p class="field-description description description-wide">
						<label for="edit-menu-item-description-<?php echo esc_attr( $item_id ); ?>">
							<?php _e( 'Description', 'mist' ); ?><br />
							<textarea id="edit-menu-item-description-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo esc_attr( $item_id ); ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
							<span class="description"><?php _e('The description will be displayed in the menu if the current theme supports it.', 'mist'); ?></span>
						</label>
					</p>
					<?php /* New fields insertion */ ?>
					<div class="clear"></div>
					<p class="field-zozo-megamenu-menutype description description-wide">
						<label for="edit-menu-item-zozo-megamenu-menutype-<?php echo esc_attr( $item_id ); ?>">							
							<?php _e( 'Menu Type', 'mist' ); ?>													
							<select id="edit-menu-item-zozo-megamenu-menutype-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-zozo-megamenu-menutype" name="menu-item-zozo-megamenu-menutype[<?php echo esc_attr( $item_id ); ?>]">								
								<option value="page" <?php selected( 'page', esc_attr( $item->zozo_megamenu_menutype ), true ); ?>><?php _e( 'Page', 'mist'); ?></option>
								<option value="section" <?php selected( 'section', esc_attr( $item->zozo_megamenu_menutype ), true  ); ?>><?php _e( 'Section', 'mist'); ?></option>
							</select>							
						</label>
	            	</p>
					<div class="clear"></div>
					<div class="zozo-megamenu-options">
						<?php // Enable Mega Menu ?>
						<p class="field-zozo-megamenu-status description description-wide">
							<label for="edit-menu-item-zozo-megamenu-status-<?php echo esc_attr( $item_id ); ?>">
								<input type="checkbox" id="edit-menu-item-zozo-megamenu-status-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-zozo-megamenu-status" name="menu-item-zozo-megamenu-status[<?php echo esc_attr( $item_id ); ?>]" value="enabled" <?php checked( 'enabled', esc_attr( $item->zozo_megamenu_status ), true ); ?> />
								<strong><?php _e( 'Enable Mega Menu', 'mist' ); ?></strong>
							</label>
						</p>
						<?php // Enable Mega Menu Fullwidth ?>
						<p class="field-zozo-megamenu-fullwidth description description-wide">
							<label for="edit-menu-item-zozo-megamenu-fullwidth-<?php echo esc_attr( $item_id ); ?>">
								<input type="checkbox" id="edit-menu-item-zozo-megamenu-fullwidth-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-zozo-megamenu-fullwidth" name="menu-item-zozo-megamenu-fullwidth[<?php echo esc_attr( $item_id ); ?>]" value="enabled" <?php checked( 'enabled', esc_attr( $item->zozo_megamenu_fullwidth ), true ); ?> />
								<strong><?php _e( 'Enable Fullwidth Mega Menu ( Overrides Container )', 'mist' ); ?></strong>
							</label>
						</p>						
						<?php // Mega Menu Columns ?>
						<p class="field-zozo-megamenu-columns description description-wide">
							<label for="edit-menu-item-zozo-megamenu-columns-<?php echo esc_attr( $item_id ); ?>">
								<?php _e( 'Number of Columns', 'mist' ); ?>
								<select id="edit-menu-item-zozo-megamenu-columns-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-zozo-megamenu-columns" name="menu-item-zozo-megamenu-columns[<?php echo esc_attr( $item_id ); ?>]">
									<option value="auto" <?php selected( esc_attr( $item->zozo_megamenu_columns ), 'auto' ); ?>><?php _e( 'Auto', 'mist' ); ?></option>
									<option value="1" <?php selected( '1', esc_attr( $item->zozo_megamenu_columns ), true ); ?>><?php _e( '1', 'mist' ); ?></option>
									<option value="2" <?php selected( '2', esc_attr( $item->zozo_megamenu_columns ), true ); ?>><?php _e( '2', 'mist' ); ?></option>
									<option value="3" <?php selected( '3', esc_attr( $item->zozo_megamenu_columns ), true ); ?>><?php _e( '3', 'mist' ); ?></option>
									<option value="4" <?php selected( '4', esc_attr( $item->zozo_megamenu_columns ), true ); ?>><?php _e( '4', 'mist' ); ?></option>
								</select>
							</label>
						</p>
						<?php // Disable Mega Menu Column Title ?>						
						<p class="field-zozo-megamenu-title description description-wide">
							<label for="edit-menu-item-zozo-megamenu-title-<?php echo esc_attr( $item_id ); ?>">
								<input type="checkbox" id="edit-menu-item-zozo-megamenu-title-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-zozo-megamenu-title" name="menu-item-zozo-megamenu-title[<?php echo esc_attr( $item_id ); ?>]" value="disabled" <?php checked( 'disabled', esc_attr( $item->zozo_megamenu_title ), true ); ?> />
								<?php _e( 'Disable Title', 'mist' ); ?>
							</label>
						</p>
						<?php // Disable Mega Menu Column Title Link ?>						
						<p class="field-zozo-megamenu-link description description-wide">
							<label for="edit-menu-item-zozo-megamenu-link-<?php echo esc_attr( $item_id ); ?>">
								<input type="checkbox" id="edit-menu-item-zozo-megamenu-link-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-zozo-megamenu-link" name="menu-item-zozo-megamenu-link[<?php echo esc_attr( $item_id ); ?>]" value="disabled" <?php checked( 'disabled', esc_attr( $item->zozo_megamenu_link ), true ); ?> />
								<?php _e( 'Disable Title Link', 'mist' ); ?>
							</label>
						</p>
						<?php // Mega Menu Icon ?>						
						<p class="field-zozo-megamenu-icon description description-wide">
							<label for="edit-menu-item-zozo-megamenu-icon-<?php echo esc_attr( $item_id ); ?>">
								<?php _e( 'Mega Menu Icon (Font Awesome or Glyphicon)', 'mist' ); ?>
								<select id="edit-menu-item-zozo-megamenu-icon-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-zozo-megamenu-icon" name="menu-item-zozo-megamenu-icon[<?php echo esc_attr( $item_id ); ?>]">
									<option value="" <?php selected('', esc_attr( $item->zozo_megamenu_icon ), true); ?>><?php _e( 'Choose Icon', 'mist' ); ?></option>
									<?php
										$fa_icons = zozo_get_fontawesome_icon_array();
										foreach( $fa_icons as $key => $value ) { ?>
											<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $key, esc_attr( $item->zozo_megamenu_icon ), true ); ?>><?php echo esc_attr( $key ); ?></option>
										<?php }
									?>
									<?php
										$glyph_icons = zozo_get_glyphicons_array();
										foreach( $glyph_icons as $key => $value ) { ?>
											<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $key, esc_attr( $item->zozo_megamenu_icon ), true ); ?>><?php echo esc_attr( $key ); ?></option>
										<?php }
									?>	
								</select>								
							</label>
						</p>
						<?php // Mega Menu Widget Area ?>
						<p class="field-zozo-megamenu-widgetarea description description-wide">
							<label for="edit-menu-item-zozo-megamenu-widgetarea-<?php echo esc_attr( $item_id ); ?>">
								<?php _e( 'Mega Menu Widget Area', 'mist' ); ?>
								<select id="edit-menu-item-zozo-megamenu-widgetarea-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-zozo-megamenu-widgetarea" name="menu-item-zozo-megamenu-widgetarea[<?php echo esc_attr( $item_id ); ?>]">
									<option value="0"><?php _e( 'Select Widget Area', 'mist' ); ?></option>
									<?php
									global $wp_registered_sidebars;
									if( ! empty( $wp_registered_sidebars ) && is_array( $wp_registered_sidebars ) ):
									foreach( $wp_registered_sidebars as $sidebar ):
									?>
									<option value="<?php echo esc_attr( $sidebar['id'] ); ?>" <?php selected( esc_attr( $item->zozo_megamenu_widgetarea ), $sidebar['id'] ); ?>><?php echo esc_attr( $sidebar['name'] ); ?></option>
									<?php endforeach; endif; ?>
								</select>
							</label>
						</p>
						<?php // Mega Menu Custom Content ?>	
						<p class="field-zozo-megamenu-content description description-wide">
							<label for="edit-menu-item-zozo-megamenu-content-<?php echo esc_attr( $item_id ); ?>">
								<?php _e( 'Mega Menu Content', 'mist' ); ?>
								<textarea id="edit-menu-item-zozo-megamenu-content-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-zozo-megamenu-content" rows="3" cols="20" name="menu-item-zozo-megamenu-content[<?php echo esc_attr( $item_id ); ?>]"><?php echo esc_html( $item->zozo_megamenu_content ); // textarea_escaped ?></textarea>
								<span class="description"><?php _e('Mega Menu Content area will be any shortcodes or HTML block. Use if not choosed any widget area.', 'mist'); ?></span>
							</label>
						</p>
					</div>
					<?php /* New fields insertion Ends */ ?>
					<div class="clear"></div>
					<p class="field-move hide-if-no-js description description-wide">
						<label>
							<span><?php _e( 'Move', 'mist' ); ?></span>
							<a href="#" class="menus-move-up"><?php _e( 'Up one', 'mist' ); ?></a>
							<a href="#" class="menus-move-down"><?php _e( 'Down one', 'mist' ); ?></a>
							<a href="#" class="menus-move-left"></a>
							<a href="#" class="menus-move-right"></a>
							<a href="#" class="menus-move-top"><?php _e( 'To the top', 'mist' ); ?></a>
						</label>
					</p>
					
					<div class="clear"></div>
					<div class="menu-item-actions description-wide submitbox">
						<?php if( 'custom' != $item->type && $original_title !== false ) : ?>
							<p class="link-to-original">
								<?php printf( __('Original: %s', 'mist'), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
							</p>
						<?php endif; ?>
						<a class="item-delete submitdelete deletion" id="delete-<?php echo esc_attr( $item_id ); ?>" href="<?php
						echo wp_nonce_url(
							add_query_arg(
								array(
									'action' => 'delete-menu-item',
									'menu-item' => $item_id,
								),
								admin_url( 'nav-menus.php' )
							),
							'delete-menu_item_' . $item_id
						); ?>"><?php _e( 'Remove', 'mist' ); ?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo esc_attr( $item_id ); ?>" href="<?php echo esc_url( add_query_arg( array( 'edit-menu-item' => $item_id, 'cancel' => time() ), admin_url( 'nav-menus.php' ) ) );
							?>#menu-item-settings-<?php echo esc_attr( $item_id ); ?>"><?php _e('Cancel', 'mist'); ?></a>
					</div>
					<div class="clear"></div>

					<input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item_id ); ?>" />
					<input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
					<input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
					<input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
					<input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
					<input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
				</div><!-- .menu-item-settings-->
				<ul class="menu-item-transport"></ul>
			<?php $output .= ob_get_clean();
		}

    } // end Zozo_Backend_Walker_Nav_Menu() class

}