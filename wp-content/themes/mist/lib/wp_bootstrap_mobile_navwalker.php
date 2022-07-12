<?php

/**
 * Class Name: wp_bootstrap_navwalker
 * GitHub URI: https://github.com/twittem/wp-bootstrap-navwalker
 * Description: A custom WordPress nav walker class to implement the Twitter Bootstrap 2.3.2 navigation style in a custom theme using the WordPress built in menu manager.
 * Version: 2.0.2
 * Author: Edward McIntyre - @twittem
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

class wp_bootstrap_mobile_navwalker extends Walker_Nav_Menu {


    private $current_Item;
	
	/**
	 * @var string $zozo_megamenu_status holds information about we currently rendering a mega menu or not
	 */
	private $zozo_megamenu_status = "";
	
	/**
	 * @var string $zozo_megamenu_fullwidth use full width mega menu?
	 */
	private $zozo_megamenu_fullwidth = "";
	
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
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int $depth Depth of page. Used for padding.
     */
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
		
		if( $depth === 0 && $this->zozo_megamenu_status == "enabled" ) {
			$output .= "\n{first_level}\n";
			$output .= "\n$indent<ul role=\"menu\" class=\"mobile-sub-menu mobile-megamenu collapse collapse-".$this->current_Item->ID." \">\n";
		} elseif( $depth === 0 ) {
			$output .= "\n$indent<ul role=\"menu\" class=\"mobile-sub-menu collapse collapse-".$this->current_Item->ID." \">\n";
		} elseif( $depth === 1 && $this->zozo_megamenu_status == "enabled" ) {
			$output .= "\n$indent<ul role=\"menu\" class=\"mobile-sub-menu mobile-sub-nav\">\n";
		} elseif( $depth === 1 ) {
			$output .= "\n$indent<ul role=\"menu\" class=\"mobile-sub-menu collapse collapse-".$this->current_Item->ID." \">\n";
		} else {
			$output .= "\n$indent<ul role=\"menu\" class=\"mobile-sub-menu mobile-sub-menu-2 collapse collapse-".$this->current_Item->ID." \">\n";
		}
				
    }
	
	/**
	 * @see Walker::end_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$row_width = '';
		
		if( $depth === 0 && $this->zozo_megamenu_status == "enabled" ) {
			$output .= "\n</ul>\n</div>\n";
			
			$output = str_replace( "{first_level}", "<div class='zozo-mobile-megamenu-wrapper zozo-mobile-megamenu'>", $output );
		} else {
			$output .= "$indent</ul>\n";
		}
		
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

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$item_output = '';
		
        $this->current_Item = $item;
		
		/* Get Stored vars */
		if( $depth === 0 ) {
			$this->zozo_megamenu_status = get_post_meta( $item->ID, '_menu_item_zozo_megamenu_status', true );	
			$this->zozo_megamenu_fullwidth = get_post_meta( $item->ID, '_menu_item_zozo_megamenu_fullwidth', true );		
		}
		
		$this->zozo_megamenu_title = get_post_meta( $item->ID, '_menu_item_zozo_megamenu_title', true);
		$this->zozo_megamenu_link = get_post_meta( $item->ID, '_menu_item_zozo_megamenu_link', true);
		$this->zozo_megamenu_widget_area = get_post_meta( $item->ID, '_menu_item_zozo_megamenu_widgetarea', true);
		$this->zozo_megamenu_content = get_post_meta( $item->ID, '_menu_item_zozo_megamenu_content', true);
		$this->zozo_megamenu_icon = get_post_meta( $item->ID, '_menu_item_zozo_megamenu_icon', true);
		
		
		/* Inside Megamenu */
		if( $depth === 1 && $this->zozo_megamenu_status == "enabled" ) {

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
			$atts['title']  = ! empty( $item->title )   ? $item->title  : '';
			$atts['target'] = ! empty( $item->target )  ? $item->target : '';
			$atts['rel']    = ! empty( $item->xfn )     ? $item->xfn    : '';			
			
			$link_url = '';
				
			$link_url = zozo_get_parallax_link( $item );
				
			$atts['href']   = ! empty( $link_url ) ? $link_url : '';
			
			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
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
			} elseif( ! empty( $item->attr_title )) {
				$item_output .= '<a'. $attributes .'><span class="glyphicon ' . esc_attr( $item->attr_title ) . '"></span>&nbsp;';
			} else {
				$item_output .= '<a'. $attributes .'>';
			}
				
			if( ! empty( $this->zozo_megamenu_icon ) && $this->zozo_megamenu_status == "enabled" ) {
				$item_output .=  '<span class="menu-title">';
			}
	
			$caret = ($depth === 0) ? 'down' : 'right';
				
			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
				
			if( ! empty( $this->zozo_megamenu_icon ) && $this->zozo_megamenu_status == "enabled" ) {
				$item_output .=  '</span>';
			}
				
			$item_output .=  '</a>';
			$item_output .= $args->after;
	
			if($args->has_children) {

				$item_output .= '<span class="menu-toggler" data-toggle="collapse" data-target=".collapse-'.$item->ID.'">
				<i class="fa fa-angle-down"></i>
				</span>';
			}
		}
		
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
			
		$class_names = $value = '';
	
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		
		//Start Modification
		if($args->has_children ) $class_names .= ' dropdown '; 

		if( in_array('current-menu-parent', $classes) || in_array('current_page_parent', $classes) || in_array('current-menu-item', $classes) ) { $class_names .= ' active'; }		
		//End modification
	
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

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

    function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( !$element ) {
            return;
        }

        $id_field = $this->db_fields['id'];

        //display this element
        if ( is_object( $args[0] ) ) {
           $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
       }

       parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
   }
}

