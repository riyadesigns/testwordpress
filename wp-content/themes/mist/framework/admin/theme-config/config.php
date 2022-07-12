<?php
/**
 * Theme Options
 */

if (!class_exists('Redux_Framework_zozo_options')) {

    class Redux_Framework_zozo_options {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }
            
            if ( true == Redux_Helpers::isTheme(__FILE__) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings() {

            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }
			
			add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 3);

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        function compiler_action($options, $css, $changed_values) {
			//echo "<pre>";
			//print_r( $changed_values ); // Values that have changed since the last save
			//echo "</pre>";
			//print_r($css);
        }

        function dynamic_section($sections) {

            return $sections;
        }

        function change_arguments($args) {

            return $args;
        }

        function change_defaults($defaults) {

            return $defaults;
        }

        function remove_demo() {

        }

        public function setSections() {

            // General Settings
            $this->sections[] = array(
                'icon' 			=> 'el-icon-dashboard',
                'icon_class' 	=> 'icon',
                'title' 		=> __('General', 'mist'),
                'fields' 		=> array(
					array(
                        'id'		=> 'zozo_disable_page_loader',
                        'type' 		=> 'switch',
                        'title' 	=> __('Disable Page Loader', 'mist'),
                        'default' 	=> false,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
					array(
                        'id'		=> 'zozo_enable_responsive',
                        'type' 		=> 'switch',
                        'title' 	=> __('Enable Responsive Design', 'mist'),
                        'default' 	=> true,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
					array(
                        'id'		=> 'zozo_enable_rtl_mode',
                        'type' 		=> 'switch',
                        'title' 	=> __('Enable RTL Mode', 'mist'),						
						'subtitle'  => __( "Enable this mode for right-to-left language mode.", "mist" ),
                        'default' 	=> false,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
					array(
                        'id'		=> 'zozo_enable_breadcrumbs',
                        'type' 		=> 'switch',
                        'title' 	=> __('Show Breadcrumbs', 'mist'),
                        'default' 	=> true,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
					array(
                        'id'		=> 'zozo_disable_opengraph',
                        'type' 		=> 'switch',
                        'title' 	=> __('Disable Open Graph Meta Tags', 'mist'),						
						'subtitle'  => __( "Disable open graph meta tags which is mainly used when sharing pages on social networking sites like Facebook.", "mist" ),
                        'default' 	=> false,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
                )
            );
			
			// Logo
			$this->sections[] = array(
                'icon_class' 		=> 'icon',
                'subsection' 		=> true,
                'title' 			=> __('Logo', 'mist'),
                'fields' 			=> array(
                    array(
                        'id'		=> 'zozo_logo',
                        'type' 		=> 'media',
                        'url'		=> false,
                        'readonly' 	=> false,
                        'title' 	=> __('Logo', 'mist'),
						'desc'     	=> __( "Upload an image or insert an image url to use for the website logo.", "mist" ),
                        'default' 	=> array(
                            'url' 		=> ZOZOTHEME_URL . '/images/logo.png',
							'width' 	=> '170',
							'height' 	=> '45'
                        )
                    ),
					array(
						'id'       			=> 'zozo_logo_padding',
						'type'     			=> 'spacing',
						'mode'     			=> 'padding',
						'units'         	=> array( 'px' ),
						'units_extended'	=> 'false',
						'title'    			=> __( 'Logo Padding', 'mist' ),
						'subtitle' 			=> __( 'Choose the spacing for logo.', 'mist' ),
					),
					array(
                        'id'			=> 'zozo_sticky_logo',
                        'type' 			=> 'media',
                        'url'			=> false,
                        'readonly' 		=> false,
                        'title' 		=> __('Sticky Header Logo', 'mist'),
						'desc'     		=> __( "Upload an image or insert an image url to use for the sticky header logo.", "mist" ),
                        'default' 		=> array(
                            'url' 		=> ZOZOTHEME_URL . '/images/sticky-logo.png',
							'width' 	=> '115',
							'height' 	=> '30'
                        )
                    ),
					array(
						'id'       			=> 'zozo_sticky_logo_padding',
						'type'     			=> 'spacing',
						'mode'     			=> 'padding',
						'units'         	=> array( 'px' ),
						'units_extended'	=> 'false',
						'title'    			=> __( 'Sticky Logo Padding', 'mist' ),
						'subtitle' 			=> __( 'Choose the spacing for sticky logo.', 'mist' ),
					),
                )
            );
			
			if ( ! function_exists( 'wp_site_icon' ) ) {
			
				// Icons
				$this->sections[] = array(
					'icon_class' 		=> 'icon',
					'subsection' 		=> true,
					'title' 			=> __('Icons', 'mist'),
					'fields' 			=> array(
						array(
							'id'		=> 'zozo_favicon',
							'type' 		=> 'media',
							'url'		=> true,
							'readonly' 	=> false,
							'title' 	=> __('Favicon', 'mist'),
							'desc'     	=> __( "Upload an icon or insert url for website's favicon.", "mist" ),
							'default' 	=> array(
								'url' 	=> ZOZOTHEME_URL . '/images/favicon.ico'
							)
						),
						array(
							'id'		=> 'zozo_apple_iphone_icon',
							'type' 		=> 'media',
							'url'		=> true,
							'readonly' 	=> false,
							'title' 	=> __('Apple iPhone Icon', 'mist'),
							'desc'     	=> __( "Icon for Apple iPhone (57px X 57px)", "mist" ),
							'default' 	=> array(
								'url' 	=> ZOZOTHEME_URL . '/images/apple-touch-icon.png'
							)
						),
						array(
							'id'		=> 'zozo_apple_iphone_retina_icon',
							'type' 		=> 'media',
							'url'		=> true,
							'readonly' 	=> false,
							'title' 	=> __('Apple iPhone Retina Icon', 'mist'),
							'desc'     	=> __( "Icon for Apple iPhone Retina ( 114px x 114px )", "mist" ),
							'default' 	=> array(
								'url' 	=> ZOZOTHEME_URL . '/images/apple-touch-icon_114x114.png'
							)
						),
						array(
							'id'		=> 'zozo_apple_ipad_icon',
							'type' 		=> 'media',
							'url'		=> true,
							'readonly' 	=> false,
							'title' 	=> __('Apple iPad Icon', 'mist'),
							'desc'     	=> __( "Icon for Apple iPad ( 72px x 72px )", "mist" ),
							'default' 	=> array(
								'url' 	=> ZOZOTHEME_URL . '/images/apple-touch-icon_72x72.png'
							)
						),
						array(
							'id'		=> 'zozo_apple_ipad_retina_icon',
							'type' 		=> 'media',
							'url'		=> true,
							'readonly' 	=> false,
							'title' 	=> __('Apple iPad Retina Icon', 'mist'),
							'desc'     	=> __( "Icon for Apple iPad Retina ( 144px x 144px )", "mist" ),
							'default' 	=> array(
								'url' 	=> ZOZOTHEME_URL . '/images/apple-touch-icon_144x144.png'
							)
						),
					)
				);
			
			} else {
				// Icons
				$this->sections[] = array(
					'icon_class' 		=> 'icon',
					'subsection' 		=> true,
					'title' 			=> __('Icons', 'mist'),
					'fields' 			=> array(
						array(
							'id'		=> 'icons_info',
							'type' 		=> 'info',
							'title' 	=> __('Please use "Site Icon" feature for adding favicon and other apple icons in "Appearance > Customize > Site Identity > Site Icon"', 'mist'),
							'notice' 	=> false
						),
					)
				);
			}
			
			// API Keys
			$this->sections[] = array(
                'icon_class' 		=> 'icon',
                'subsection' 		=> true,
                'title' 			=> __('API Keys', 'mist'),
                'fields' 			=> array(
					array(
                        'id'		=> 'zozo_google_map_api',
                        'type'     	=> 'text',
                        'title' 	=> __('Google Map API Key', 'mist'),
                        'desc' 		=> __('Enter your Google Map API key to use google map with your site. Please follow this <a href="https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key" target="_blank">link</a> to get API key.', 'mist'),
                        'default' 	=> ""
                    ),
                    array(
                        'id'		=> 'zozo_mailchimp_api',
                        'type'     	=> 'text',
                        'title' 	=> __('Mailchimp API Key', 'mist'),
                        'desc' 		=> __('Enter your Mailchimp API key to get subscribers for your lists.', 'mist'),
                        'default' 	=> ""
                    ),
                )
            );
			
			// Custom CSS
			$this->sections[] = array(
                'icon_class' 		=> 'icon',
                'subsection' 		=> true,
                'title' 			=> __('Custom CSS', 'mist'),
                'fields' 			=> array(
                    array(
                        'id'		=> 'zozo_custom_css',
                        'type' 		=> 'ace_editor',
                        'title' 	=> __('Custom CSS Code', 'mist'),
                        'subtitle' 	=> __('Paste your CSS code here.', 'mist'),
                        'mode' 		=> 'css',
                        'theme' 	=> 'monokai',
                        'default' 	=> ""
                    ),
                )
            );
			
			// Maintenance Settings
            $this->sections[] = array(
                'icon' 			=> 'el-icon-eye-close',
                'icon_class' 	=> 'icon',
                'title' 		=> __('Maintenance', 'mist'),
                'fields' 		=> array(
					array(
                        'id'		=> 'zozo_enable_maintenance',
                        'type' 		=> 'button_set',
                        'title' 	=> __('Enable Maintenance Mode', 'mist'),
						'subtitle' 	=> __('Enable the themes maintenance mode.', 'mist'),
                        'options'  	=> array(
							'0' 	=> __('Off', 'mist'),
							'1' 	=> __('On ( Standard )', 'mist'),
							'2' 	=> __('On ( Custom Page )', 'mist'),
						),
						'default'  => '0'
                    ),
					array(
                        'id'		=> 'zozo_maintenance_mode_page',
                        'type' 		=> 'select',
						'data' 		=> 'pages',
                        'title' 	=> __('Custom Maintenance Mode Page', 'mist'),
						'subtitle' 	=> __('Select the page that is your maintenance page, if you would like to show a custom page instead of the standard page from theme. You should use the Maintenance Page template for this page.', 'mist'),
						'required'  => array('zozo_enable_maintenance', '=', '2'),
                        'default' 	=> '',
						'args' 		=> array()
                    ),
					array(
                        'id'		=> 'zozo_enable_coming_soon',
                        'type' 		=> 'button_set',
                        'title' 	=> __('Enable Coming Soon Mode', 'mist'),
						'subtitle' 	=> __('Enable the themes coming soon mode.', 'mist'),
                        'options'  	=> array(
							'0' 	=> __('Off', 'mist'),
							'1' 	=> __('On ( Standard )', 'mist'),
							'2' 	=> __('On ( Custom Page )', 'mist'),
						),
						'default'  => '0'
                    ),
					array(
                        'id'		=> 'zozo_coming_soon_page',
                        'type' 		=> 'select',
						'data' 		=> 'pages',
                        'title' 	=> __('Custom Coming Soon Page', 'mist'),
						'subtitle' 	=> __('Select the page that is your coming soon page, if you would like to show a custom page instead of the standard page from theme. You should use the Maintenance Page template for this page.', 'mist'),
						'required'  => array('zozo_enable_coming_soon', '=', '2'),
                        'default' 	=> '',
						'args' 		=> array()
                    ),
                )
            );
		
			// Layout Options
			$this->sections[] = array(
				'icon' 				=> 'el-icon-view-mode',
                'icon_class' 		=> 'icon',
                'title' 			=> __('Layout', 'mist'),
                'fields' 			=> array(
                  	array(
                        'id'		=> 'zozo_theme_layout',
                        'type' 		=> 'image_select',
                        'title' 	=> __('Theme Layout', 'mist'),
                        'options' 	=> array(
							'fullwidth' => array('alt' => __('Full Width', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/layouts/full-width.jpg'),
							'boxed' 	=> array('alt' => __('Boxed', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/layouts/boxed.jpg'),
							'wide' 		=> array('alt' => __('Wide', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/layouts/wide.jpg'),
						),
                        'default' 	=> 'fullwidth'
                    ),
					array(
                        'id'		=> 'zozo_layout',
                        'type' 		=> 'image_select',
                        'title' 	=> __('Page Layout', 'mist'),
                        'options' 	=> array(
							'one-col' 			=> array('alt' => __('Full width', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/layouts/one-col.png'),
							'two-col-right' 	=> array('alt' => __('Right Sidebar', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/layouts/two-col-right.png'),
							'two-col-left' 		=> array('alt' => __('Left Sidebar', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/layouts/two-col-left.png'),
							'three-col-middle' 	=> array('alt' => __('Left and Right Sidebar', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/layouts/three-col-middle.png'),
							'three-col-right' 	=> array('alt' => __('Two Right Sidebars', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/layouts/three-col-right.png'),
							'three-col-left' 	=> array('alt' => __('Two Left Sidebars', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/layouts/three-col-left.png'),
						),
                        'default' 	=> 'one-col'
                    ),
					array(
						'id'            => 'zozo_fullwidth_site_width',
						'type'          => 'slider',
						'title'         => __( 'Container Max Width', 'mist' ),
						'subtitle'      => __( 'Please choose container maximum width for fullwidth layout', 'mist' ),
						'default'       => 1200,
						'min'           => 1100,
						'step'          => 5,
						'max'           => 1600,
						'required' 		=> array('zozo_theme_layout', 'equals', 'fullwidth'),
						'display_value' => 'text'
					),
					array(
						'id'            => 'zozo_boxed_site_width',
						'type'          => 'slider',
						'title'         => __( 'Container Max Width', 'mist' ),
						'subtitle'      => __( 'Please choose container maximum width for boxed layout', 'mist' ),
						'default'       => 1200,
						'min'           => 1100,
						'step'          => 5,
						'max'           => 1600,
						'required' 		=> array('zozo_theme_layout', 'equals', 'boxed'),
						'display_value' => 'text'
					),
                )
            );
			
			// Header Settings
			$this->sections[] = array(
                'icon' 				=> 'el-icon-website',
                'icon_class' 		=> 'icon',
                'title' 			=> __('Header', 'mist'),
                'fields' 			=> array(
					array(
                        'id'		=> 'zozo_header_layout',
                        'type'     	=> 'select',
                        'title' 	=> __('Header Layout', 'mist'),
                        'options'  	=> array(
							'fullwidth'	=> __( 'Full Width', 'mist' ),
							'boxed'		=> __( 'Boxed', 'mist' ),
						),
						'default' 	=> 'fullwidth'
                    ),
					array(
                        'id'		=> 'zozo_sticky_header',
                        'type' 		=> 'switch',
                        'title' 	=> __('Enable Sticky Header', 'mist'),
                        'default' 	=> true,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
					array(
                        'id'		=> 'zozo_enable_search_in_header',
                        'type' 		=> 'switch',
                        'title' 	=> __('Show Search Form', 'mist'),
                        'default' 	=> true,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
					array(
                        'id'		=> 'zozo_search_placeholder',
                        'type'     	=> 'text',
                        'title' 	=> __('Search Placeholder', 'mist'),
                        'desc' 		=> __('Enter placeholder text for search box', 'mist'),
                        'default' 	=> __('Search..', 'mist'),
						'required' 		=> array('zozo_enable_search_in_header', 'equals', '1')
                    ),
					array(
                        'id'		=> 'zozo_show_socials_header',
                        'type' 		=> 'switch',
                        'title' 	=> __('Show Social Links', 'mist'),
                        'default' 	=> false,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
					array(
                        'id'		=> 'zozo_show_cart_header',
                        'type' 		=> 'switch',
                        'title' 	=> __('Show Mini Cart', 'mist'),
                        'default' 	=> true,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
                )
            );
			
			// Header Type
			$this->sections[] = array(
                'icon_class' 		=> 'icon',
                'subsection' 		=> true,
                'title' 			=> __('Header Type', 'mist'),
                'fields' 			=> array(
					array(
                        'id'		=> 'zozo_header_skin',
                        'type'     	=> 'select',
                        'title' 	=> __('Header Skin', 'mist'),
                        'options'  	=> array(
							'light'		=> __( 'Light', 'mist' ),
							'dark'		=> __( 'Dark', 'mist' ),
						),
						'default' 	=> 'light'
                    ),
					array(
                        'id'		=> 'zozo_header_transparency',
                        'type'     	=> 'select',
                        'title' 	=> __('Header Transparency', 'mist'),
                        'options'  	=> array(
							'no-transparent'	=> __( 'No Transparency', 'mist' ),
							'transparent'		=> __( 'Transparent', 'mist' ),
							'semi-transparent'	=> __( 'Semi Transparent', 'mist' ),
						),
						'default' 	=> 'no-transparent'
                    ),
                    array(
                        'id'		=> 'zozo_header_type',
                        'type' 		=> 'image_select',
						'full_width'=> true,
                        'title' 	=> __('Header Type', 'mist'),
                        'options' 	=> array(
							'header-1' 			=> array('alt' => __('Default Header', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/headers/header-01.jpg'),
							'header-2' 			=> array('alt' => __('Header Right Logo', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/headers/header-02.jpg'),
							'header-3' 			=> array('alt' => __('Header Center Logo', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/headers/header-03.jpg'),
							'header-4' 			=> array('alt' => __('Header Fullwidth Menu', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/headers/header-04.jpg'),
							'header-5' 			=> array('alt' => __('Header Fullwidth Menu 2', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/headers/header-05.jpg'),
							'header-6' 			=> array('alt' => __('Header Fullwidth Menu 3', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/headers/header-06.jpg'),							
							'header-7' 			=> array('alt' => __('Header Centered Logo', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/headers/header-07.jpg'),
							'header-8' 			=> array('alt' => __('Header Centered Logo 2', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/headers/header-08.jpg'),
							'header-11' 		=> array('alt' => __('Header 11', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/headers/header-11.jpg'),
							'header-12' 		=> array('alt' => __('Header 12', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/headers/header-12.jpg'),
							'header-9' 			=> array('alt' => __('Toggle Header', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/headers/header-09.jpg'),
							'header-10' 		=> array('alt' => __('Vertical Header', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/headers/header-10.jpg'),
						),
                        'default' 	=> 'header-1'
                    ),
					array(
                        'id'		=> 'zozo_slider_position',
                        'type'     	=> 'select',
                        'title' 	=> __('Slider Position', 'mist'),
						'required' 	=> array('zozo_header_type', 'equals', array( 'header-1','header-2','header-3','header-4','header-5','header-6','header-7','header-8' )),
                        'options'  	=> array(
							'below'		=> __( 'Below Header', 'mist' ),
							'above'		=> __( 'Above Header', 'mist' ),
						),
						'default' 	=> 'below'
                    ),
					array(
                        'id'		=> 'zozo_header_toggle_position',
                        'type'     	=> 'select',
                        'title' 	=> __('Header Position', 'mist'),
						'required' 	=> array('zozo_header_type', 'equals', array( 'header-9', 'header-10' )),
                        'options'  	=> array(
							'left'		=> __( 'Left', 'mist' ),
							'right'		=> __( 'Right', 'mist' ),
						),
						'default' 	=> 'left'
                    ),
					array(
                        'id'		=> 'zozo_header_side_width',
                        'type'     	=> 'text',
                        'title' 	=> __('Header Width For Left/Right Position', 'mist'),
                        'desc' 		=> __('Enter width for the left or right side header. In pixels, ex: 280px.', 'mist'),
						'required' 	=> array('zozo_header_type', 'equals', 'header-10'),
                        'default' 	=> "280px"
                    ),
                )
            );
			
			// Header Top Bar
			$this->sections[] = array(
                'icon_class' 		=> 'icon',
                'subsection' 		=> true,
                'title' 			=> __('Header Top Bar', 'mist'),
                'fields' 			=> array(
                    array(
                        'id'		=> 'zozo_enable_header_top_bar',
                        'type' 		=> 'switch',
                        'title' 	=> __('Enable Header Top Bar', 'mist'),
                        'default' 	=> true,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
					array(
                        'id'		=> 'zozo_welcome_msg',
                        'type'     	=> 'text',
                        'title' 	=> __('Welcome Message', 'mist'),
                        'desc' 		=> '',
                        'default' 	=> "Welcome to Mist"
                    ),
					array(
                        'id'		=> 'zozo_header_phone',
                        'type'     	=> 'text',
                        'title' 	=> __('Header Phone Number', 'mist'),
                        'desc' 		=> __('Phone number will display in the contact info section.', 'mist'),
                        'default' 	=> "+12 123 456 789"
                    ),
					array(
                        'id'		=> 'zozo_header_email',
                        'type'     	=> 'text',
                        'title' 	=> __('Header Email Address', 'mist'),
                        'desc' 		=> __('Email address will display in the contact info section.', 'mist'),
                        'default' 	=> "info@yoursite.com"
                    ),
					array(
						'id'       => 'zozo_header_address',
						'type'     => 'textarea',
						'title'    => __( 'Address', 'mist' ),
						'default'  => '<strong>No. 12, Ribon Building, </strong><span>Walse street, Australia.</span>'
					),
					array(
						'id'       => 'zozo_header_business_hours',
						'type'     => 'textarea',
						'title'    => __( 'Business Hours', 'mist' ),
						'default'  => '<strong>Monday-Friday: 9am to 5pm </strong><span>Saturday / Sunday: Closed</span>'
					),
                )
            );
			
			// Header Sliding Bar
			$this->sections[] = array(
                'icon_class' 		=> 'icon',
                'subsection' 		=> true,
                'title' 			=> __('Sliding Bar', 'mist'),
                'fields' 			=> array(
                    array(
                        'id'		=> 'zozo_enable_sliding_bar',
                        'type' 		=> 'switch',
                        'title' 	=> __('Enable Sliding Bar', 'mist'),
                        'default' 	=> false,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
					array(
                        'id'		=> 'zozo_disable_sliding_bar',
                        'type' 		=> 'switch',
                        'title' 	=> __('Disable Sliding Bar on Mobile', 'mist'),
                        'default' 	=> true,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
					array(
						'id'       	=> 'zozo_sliding_bar_columns',
						'type'     	=> 'select',
						'title'    	=> __( 'Sliding Bar Columns', 'mist' ),
						'subtitle' 	=> __( 'Select the number of columns to display in the Sliding Bar.', 'mist' ),
						'options'  	=> array(
							'1'		=> '1',
							'2'		=> '2',
							'3'		=> '3',
							'4'		=> '4',
						),
						'default'  	=> '3'
					),
                )
            );
			
			// Header Styling Options
			$this->sections[] = array(
                'icon_class' 		=> 'icon',
                'subsection' 		=> true,
                'title' 			=> __('Styling', 'mist'),
                'fields' 			=> array(
                    array(
						'id'       			=> 'zozo_header_spacing',
						'type'     			=> 'spacing',
						'mode'     			=> 'padding',
						'units'         	=> array( 'em', 'px', '%' ),
						'units_extended'	=> 'true',
						'title'    			=> __( 'Header Padding', 'mist' ),
						'subtitle' 			=> __( 'Choose the spacing for header.', 'mist' ),
					),
                )
            );
			
			// Header Menu Options
			$this->sections[] = array(
                'icon_class' 		=> 'icon',
                'subsection' 		=> true,
                'title' 			=> __('Main Menu', 'mist'),
                'fields' 			=> array(
                    array(
						'id'       	=> 'zozo_menu_type',
						'type'     	=> 'select',
						'title'    	=> __( 'Menu Type', 'mist' ),
						'subtitle' 	=> __( 'Please select menu type.', 'mist' ),
						'options'  	=> array(
							'standard'		=> __( 'Standard Menu', 'mist' ),
							'megamenu'		=> __( 'Mega Menu', 'mist' ),
						),
						'default'  	=> 'megamenu'
					),
					array(
						'id'             => 'zozo_dropdown_menu_width',
						'type'           => 'dimensions',
						'units'          => array( 'em', 'px', '%' ),
						'units_extended' => 'true',
						'title'          => __( 'Dropdown Menu Width ( Only Standard Mode )', 'mist' ),
						'subtitle'       => __( 'Enter dropdown menu width for standard mode.', 'mist' ),
						'height'         => false,
						'default'        => array(
							'width'  => 200,
							'units'  => 'px',
						)
					),
					array(
						'id'             => 'zozo_menu_height',
						'type'           => 'dimensions',
						'units'          => 'px',
						'units_extended' => 'false',
						'title'          => __( 'Main Menu Height', 'mist' ),
						'subtitle'       => __( 'Enter main menu height.', 'mist' ),
						'width'         => false,
						'default'        => array(
							'height'  => 76,
							'units'   => 'px',
						)
					),
					array(
						'id'             => 'zozo_sticky_menu_height',
						'type'           => 'dimensions',
						'units'          => 'px',
						'units_extended' => 'false',
						'title'          => __( 'Sticky Main Menu Height', 'mist' ),
						'subtitle'       => __( 'Enter main menu height in sticky.', 'mist' ),
						'width'         => false,
						'default'        => array(
							'height'  => 60,
							'units'   => 'px',
						)
					),
					array(
                        'id'		=> 'menu_height',
                        'type' 		=> 'info',
                        'title' 	=> __('If Header Type 4, 5, 6, 11', 'mist'),
                        'notice' 	=> false
                    ),
					array(
						'id'             => 'zozo_logo_bar_height',
						'type'           => 'dimensions',
						'units'          => 'px',
						'units_extended' => 'false',
						'title'          => __( 'Logo Bar Height', 'mist' ),
						'subtitle'       => __( 'Enter logo bar height.', 'mist' ),
						'width'         => false,
						'default'        => array(
							'height'  => 76,
							'units'   => 'px',
						)
					),
					array(
						'id'             => 'zozo_menu_height_alt',
						'type'           => 'dimensions',
						'units'          => 'px',
						'units_extended' => 'false',
						'title'          => __( 'Main Menu Height', 'mist' ),
						'subtitle'       => __( 'Enter main menu height.', 'mist' ),
						'width'         => false,
						'default'        => array(
							'height'  => 60,
							'units'   => 'px',
						)
					),
					array(
						'id'             => 'zozo_sticky_menu_height_alt',
						'type'           => 'dimensions',
						'units'          => 'px',
						'units_extended' => 'false',
						'title'          => __( 'Sticky Main Menu Height', 'mist' ),
						'subtitle'       => __( 'Enter main menu height in sticky.', 'mist' ),
						'width'         => false,
						'default'        => array(
							'height'  => 60,
							'units'   => 'px',
						)
					),
                )
            );
			
			// Header Secondary Menu Options
			$this->sections[] = array(
                'icon_class' 		=> 'icon',
                'subsection' 		=> true,
                'title' 			=> __('Secondary Menu', 'mist'),
                'fields' 			=> array(
                    array(
                        'id'		=> 'zozo_enable_secondary_menu',
                        'type' 		=> 'switch',
                        'title' 	=> __('Enable Secondary Menu', 'mist'),
                        'default' 	=> false,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
					array(
						'id'       	=> 'zozo_secondary_menu_position',
						'type'     	=> 'select',
						'title'    	=> __( 'Secondary Menu Position', 'mist' ),
						'subtitle' 	=> __( 'Choose secondary menu position.', 'mist' ),
						'required' 	=> array('zozo_enable_secondary_menu', 'equals', true),
						'options'  	=> array(
							'left'		=> __( 'Left', 'mist' ),
							'right'		=> __( 'Right', 'mist' ),
						),
						'default'  	=> 'right'
					),
                )
            );
			
			// Mobile Header Settings
			$this->sections[] = array(
                'icon' 				=> 'el-icon-iphone-home',
                'icon_class' 		=> 'icon',
                'title' 			=> __('Mobile Header', 'mist'),
                'fields' 			=> array(
					array(
                        'id'		=> 'zozo_mobile_logo',
                        'type' 		=> 'media',
                        'url'		=> true,
                        'readonly' 	=> false,
                        'title' 	=> __('Mobile Logo', 'mist'),
						'desc'     	=> __( "Upload an image or insert an image url to use for the mobile logo.", "mist" ),
                        'default' 	=> array(
                            'url' 		=> '',
							'width' 	=> '',
							'height' 	=> ''
                        )
                    ),
					array(
                        'id'		=> 'zozo_sticky_mobile_header',
                        'type' 		=> 'switch',
                        'title' 	=> __('Enable Mobile Sticky Header', 'mist'),
                        'default' 	=> true,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
                )
            );
			
			// Footer Options
			$this->sections[] = array(
				'icon' 				=> 'el-icon-website',
                'icon_class' 		=> 'icon',
                'title' 			=> __('Footer', 'mist'),
                'fields' 			=> array(
                	array(
						'id'       => 'zozo_copyright_text',
						'type'     => 'textarea',
						'title'    => __( 'Copyright Text', 'mist' ),
						'desc'     => __( 'Enter an copyright text to show on footer. Use [year] shortcode to display current year.', 'mist' ),
						'default'  => __('&copy; Copyright [year]. All Rights Reserved.', 'mist')
					),
					array(
                        'id'		=> 'zozo_footer_widgets_enable',
                        'type' 		=> 'switch',
                        'title' 	=> __('Enable Footer Widgets', 'mist'),
                        'default' 	=> true,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
					array(
                        'id'		=> 'zozo_enable_back_to_top',
                        'type' 		=> 'switch',
                        'title' 	=> __('Show Back To Top', 'mist'),
                        'default' 	=> true,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
					array(
                        'id'		=> 'zozo_enable_footer_menu',
                        'type' 		=> 'switch',
                        'title' 	=> __('Show Footer Menu', 'mist'),
                        'default' 	=> false,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
                )
            );
			
			// Footer Widgets
			$this->sections[] = array(
                'icon_class' 		=> 'icon',
                'subsection' 		=> true,
                'title' 			=> __('Footer Type', 'mist'),
                'fields' 			=> array(
					array(
                        'id'		=> 'zozo_footer_skin',
                        'type'     	=> 'select',
                        'title' 	=> __('Footer Skin', 'mist'),
                        'options'  	=> array(
							'light'		=> __( 'Light', 'mist' ),
							'dark'		=> __( 'Dark', 'mist' ),
						),
						'default' 	=> 'light'
                    ),
					array(
                        'id'		=> 'zozo_footer_style',
                        'type'     	=> 'select',
                        'title' 	=> __('Footer Style', 'mist'),
                        'options'  	=> array(
							'default'	=> __( 'Normal', 'mist' ),
							'sticky'	=> __( 'Sticky', 'mist' ),
							'hidden'	=> __( 'Hidden', 'mist' ),
						),
						'default' 	=> 'default'
                    ),
                    array(
                        'id'		=> 'zozo_footer_type',
                        'type' 		=> 'image_select',
                        'title' 	=> __('Footer Type', 'mist'),
                        'options' 	=> array(
							'footer-1' 			=> array('alt' => __('Default Footer', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/footers/footer-01.jpg'),
							'footer-2' 			=> array('alt' => __('Footer 3 Column', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/footers/footer-02.jpg'),
							'footer-3' 			=> array('alt' => __('Footer 3 Column Centered', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/footers/footer-03.jpg'),
							'footer-4' 			=> array('alt' => __('Footer 2 Column', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/footers/footer-04.jpg'),
							'footer-5' 			=> array('alt' => __('Footer 2 Column Large', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/footers/footer-05.jpg'),
							'footer-6' 			=> array('alt' => __('Footer 2 Column Large', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/footers/footer-06.jpg'),							
							'footer-7' 			=> array('alt' => __('Footer One Column', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/footers/footer-07.jpg'),
						),
                        'default' 	=> 'footer-1'
                    ),
                )
            );
			
			// Footer Styling Options
			$this->sections[] = array(
                'icon_class' 		=> 'icon',
                'subsection' 		=> true,
                'title' 			=> __('Styling', 'mist'),
                'fields' 			=> array(
                    array(
						'id'       			=> 'zozo_footer_spacing',
						'type'     			=> 'spacing',
						'mode'     			=> 'padding',
						'units'         	=> array( 'em', 'px', '%' ),
						'units_extended'	=> 'true',
						'title'    			=> __( 'Footer Widgets Padding', 'mist' ),
						'subtitle' 			=> __( 'Choose the spacing for footer widgets section.', 'mist' ),
					),
					array(
						'id'       			=> 'zozo_footer_copyright_spacing',
						'type'     			=> 'spacing',
						'mode'     			=> 'padding',
						'units'         	=> array( 'em', 'px', '%' ),
						'units_extended'	=> 'true',
						'title'    			=> __( 'Footer Copyright Bar Padding', 'mist' ),
						'subtitle' 			=> __( 'Choose the spacing for footer copyright bar.', 'mist' ),
					),
                )
            );
			
			// Typography Options
			$this->sections[] = array(
				'icon' 				=> 'el-icon-text-height',
                'icon_class' 		=> 'icon',
                'title' 			=> __('Typography', 'mist'),
                'fields' 			=> array(
                  	 array(
						'id'       		=> 'zozo_body_font',
						'type'     		=> 'typography',
						'title'    		=> __( 'Body Font', 'mist' ),
						'subtitle' 		=> __( 'Specify the body font properties.', 'mist' ),
						'google'   		=> true,
						'subsets'  		=> true,
						'all_styles'  	=> true,
						'custom_fonts'  => true,
						'text-align'	=> false,
						'default'  		=> array(
							'color'       => '#333333',
							'font-size'   => '14px',
							'font-family' => 'Arimo',
							'google'      => true,
							'font-weight' => '400',
							'font-style'  => 'normal',
							'line-height' => '25px',
						),
					),
					array(
						'id'       		=> 'zozo_h1_font_styles',
						'type'     		=> 'typography',
						'title'    		=> __( 'H1 Font Style', 'mist' ),
						'subtitle' 		=> __( 'Specify the H1 font properties.', 'mist' ),
						'google'   		=> true,
						'subsets'  		=> true,
						'all_styles'  	=> true,
						'text-align'	=> false,
						'default'  		=> array(
							'color'       => '',
							'font-size'   => '48px',
							'font-family' => 'Oswald',
							'google'      => true,
							'font-weight' => '400',
							'font-style'  => 'normal',
							'line-height' => '62px',
						),
					),
					array(
						'id'       		=> 'zozo_h2_font_styles',
						'type'     		=> 'typography',
						'title'    		=> __( 'H2 Font Style', 'mist' ),
						'subtitle' 		=> __( 'Specify the H2 font properties.', 'mist' ),
						'google'   		=> true,
						'subsets'  		=> true,
						'all_styles'  	=> true,
						'text-align'	=> false,
						'default'  		=> array(
							'color'       => '',
							'font-size'   => '40px',
							'font-family' => 'Oswald',
							'google'      => true,
							'font-weight' => '400',
							'font-style'  => 'normal',
							'line-height' => '52px',
						),
					),
					array(
						'id'       		=> 'zozo_h3_font_styles',
						'type'     		=> 'typography',
						'title'    		=> __( 'H3 Font Style', 'mist' ),
						'subtitle' 		=> __( 'Specify the H3 font properties.', 'mist' ),
						'google'   		=> true,
						'subsets'  		=> true,
						'all_styles'  	=> true,
						'text-align'	=> false,
						'default'  		=> array(
							'color'       => '',
							'font-size'   => '32px',
							'font-family' => 'Oswald',
							'google'      => true,
							'font-weight' => '400',
							'font-style'  => 'normal',
							'line-height' => '42px',
						),
					),
					array(
						'id'       		=> 'zozo_h4_font_styles',
						'type'     		=> 'typography',
						'title'    		=> __( 'H4 Font Style', 'mist' ),
						'subtitle' 		=> __( 'Specify the H4 font properties.', 'mist' ),
						'google'   		=> true,
						'subsets'  		=> true,
						'all_styles'  	=> true,
						'text-align'	=> false,
						'default'  		=> array(
							'color'       => '',
							'font-size'   => '24px',
							'font-family' => 'Oswald',
							'google'      => true,
							'font-weight' => '400',
							'font-style'  => 'normal',
							'line-height' => '31px',
						),
					),
					array(
						'id'       		=> 'zozo_h5_font_styles',
						'type'     		=> 'typography',
						'title'    		=> __( 'H5 Font Style', 'mist' ),
						'subtitle' 		=> __( 'Specify the H5 font properties.', 'mist' ),
						'google'   		=> true,
						'subsets'  		=> true,
						'all_styles'  	=> true,
						'text-align'	=> false,
						'default'  		=> array(
							'color'       => '',
							'font-size'   => '18px',
							'font-family' => 'Oswald',
							'google'      => true,
							'font-weight' => '400',
							'font-style'  => 'normal',
							'line-height' => '23px',
						),
					),
					array(
						'id'       		=> 'zozo_h6_font_styles',
						'type'     		=> 'typography',
						'title'    		=> __( 'H6 Font Style', 'mist' ),
						'subtitle' 		=> __( 'Specify the H6 font properties.', 'mist' ),
						'google'   		=> true,
						'subsets'  		=> true,
						'all_styles'  	=> true,
						'text-align'	=> false,
						'default'  		=> array(
							'color'       => '',
							'font-size'   => '16px',
							'font-family' => 'Oswald',
							'google'      => true,
							'font-weight' => '400',
							'font-style'  => 'normal',
							'line-height' => '21px',
						),
					),
                )
            );
			
			// Menu Typography
			$this->sections[] = array(
                'icon_class' 		=> 'icon',
                'subsection' 		=> true,
                'title' 			=> __('Menu', 'mist'),
                'fields' 			=> array(
                    array(
						'id'       		=> 'zozo_top_menu_font_styles',
						'type'     		=> 'typography',
						'title'    		=> __( 'Top Menu Font Style', 'mist' ),
						'subtitle' 		=> __( 'Specify the Top menu font properties.', 'mist' ),
						'google'   		=> true,
						'subsets'  		=> true,
						'all_styles'  	=> true,
						'text-align'	=> false,
						'default'  		=> array(
							'color'       => '',
							'font-size'   => '12px',
							'font-family' => 'Arimo',
							'google'      => true,
							'font-weight' => '700',
							'font-style'  => 'normal',
							'line-height' => '12px',
						),
					),
					array(
						'id'       		=> 'zozo_menu_font_styles',
						'type'     		=> 'typography',
						'title'    		=> __( 'Main Menu Font Style', 'mist' ),
						'subtitle' 		=> __( 'Specify the Main menu font properties.', 'mist' ),
						'google'   		=> true,
						'subsets'  		=> true,
						'all_styles'  	=> true,
						'text-align'	=> false,
						'line-height'	=> false,
						'default'  		=> array(
							'color'       => '',
							'font-size'   => '14px',
							'font-family' => 'Arimo',
							'google'      => true,
							'font-weight' => '400',
							'font-style'  => 'normal',
						),
					),
					array(
						'id'       		=> 'zozo_submenu_font_styles',
						'type'     		=> 'typography',
						'title'    		=> __( 'Sub Menu Font Style', 'mist' ),
						'subtitle' 		=> __( 'Specify the Sub menu font properties.', 'mist' ),
						'google'   		=> true,
						'subsets'  		=> true,
						'all_styles'  	=> true,
						'text-align'	=> false,
						'default'  		=> array(
							'color'       => '',
							'font-size'   => '14px',
							'font-family' => 'Arimo',
							'google'      => true,
							'font-weight' => '400',
							'font-style'  => 'normal',
							'line-height' => '20px',
						),
					),
                )
            );
			
			// Title Typography
			$this->sections[] = array(
                'icon_class' 		=> 'icon',
                'subsection' 		=> true,
                'title' 			=> __('Page/Post', 'mist'),
                'fields' 			=> array(
                    array(
						'id'       		=> 'zozo_single_post_title_fonts',
						'type'     		=> 'typography',
						'title'    		=> __( 'Page/Post Title Font Style', 'mist' ),
						'subtitle' 		=> __( 'Specify the Page/Post font properties.', 'mist' ),
						'google'   		=> true,
						'subsets'  		=> true,
						'all_styles'  	=> true,
						'text-align'	=> false,
						'default'  		=> array(
							'color'       => '',
							'font-size'   => '36px',
							'font-family' => 'Oswald',
							'google'      => true,
							'font-weight' => '400',
							'font-style'  => 'normal',
							'line-height' => '50px',
						),
					),
					array(
						'id'       		=> 'zozo_post_title_font_styles',
						'type'     		=> 'typography',
						'title'    		=> __( 'Blog Archive Title Font Style', 'mist' ),
						'subtitle' 		=> __( 'Specify the Blog Archive Title font properties.', 'mist' ),
						'google'   		=> true,
						'subsets'  		=> true,
						'all_styles'  	=> true,
						'text-align'	=> false,
						'default'  		=> array(
							'color'       => '',
							'font-size'   => '26px',
							'font-family' => 'Oswald',
							'google'      => true,
							'font-weight' => '400',
							'font-style'  => 'normal',
							'line-height' => '41px',
						),
					),
                )
            );
			
			// Widgets Typography
			$this->sections[] = array(
                'icon_class' 		=> 'icon',
                'subsection' 		=> true,
                'title' 			=> __('Widgets', 'mist'),
                'fields' 			=> array(
                    array(
						'id'       		=> 'zozo_widget_title_fonts',
						'type'     		=> 'typography',
						'title'    		=> __( 'Widget Title Font Style', 'mist' ),
						'subtitle' 		=> __( 'Specify the Widget Title font properties.', 'mist' ),
						'google'   		=> true,
						'subsets'  		=> true,
						'all_styles'  	=> true,
						'text-align'	=> false,
						'default'  		=> array(
							'color'       => '',
							'font-size'   => '16px',
							'line-height' => '42px',
							'font-family' => 'Oswald',
							'google'      => true,
							'font-weight' => '400',
							'font-style'  => 'normal',
						),
					),
					array(
						'id'       		=> 'zozo_widget_text_fonts',
						'type'     		=> 'typography',
						'title'    		=> __( 'Widget Text Font Style', 'mist' ),
						'subtitle' 		=> __( 'Specify the Widget Text font properties.', 'mist' ),
						'google'   		=> true,
						'subsets'  		=> true,
						'all_styles'  	=> true,
						'text-align'	=> false,
						'default'  		=> array(
							'color'       => '',
							'font-size'   => '13px',
							'line-height' => '25px',
							'font-family' => 'Arimo',
							'google'      => true,
							'font-weight' => '400',
							'font-style'  => 'normal',
						),
					),
					array(
						'id'       		=> 'zozo_footer_widget_title_fonts',
						'type'     		=> 'typography',
						'title'    		=> __( 'Footer Widget Title Font Style', 'mist' ),
						'subtitle' 		=> __( 'Specify the Footer Widget Title font properties.', 'mist' ),
						'google'   		=> true,
						'subsets'  		=> true,
						'all_styles'  	=> true,
						'text-align'	=> false,
						'default'  		=> array(
							'color'       => '',
							'font-size'   => '16px',
							'line-height' => '42px',
							'font-family' => 'Oswald',
							'google'      => true,
							'font-weight' => '400',
							'font-style'  => 'normal',
						),
					),
					array(
						'id'       		=> 'zozo_footer_widget_text_fonts',
						'type'     		=> 'typography',
						'title'    		=> __( 'Footer Widget Text Font Style', 'mist' ),
						'subtitle' 		=> __( 'Specify the Footer Widget Text font properties.', 'mist' ),
						'google'   		=> true,
						'subsets'  		=> true,
						'all_styles'  	=> true,
						'text-align'	=> false,
						'default'  		=> array(
							'color'       => '',
							'font-size'   => '13px',
							'line-height' => '25px',
							'font-family' => 'Arimo',
							'google'      => true,
							'font-weight' => '400',
							'font-style'  => 'normal',
						),
					),
                )
            );
			
			// Skin Options
			$this->sections[] = array(
				'icon' 				=> 'el-icon-broom',
                'icon_class' 		=> 'icon',
                'title' 			=> __('Skin', 'mist'),
                'fields' 			=> array(
					array(
                        'id'		=> 'zozo_color_scheme',
                        'type' 		=> 'image_select',
                        'title' 	=> __('Default Color Scheme', 'mist'),
                        'options' 	=> array(
							'yellow.css' 		=> array('alt' => __('Yellow', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/skins/yellow.jpg'),
							'blue.css' 			=> array('alt' => __('Blue', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/skins/blue.jpg'),
							'green.css' 		=> array('alt' => __('Green', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/skins/green.jpg'),
							'pink.css' 			=> array('alt' => __('Pink', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/skins/pink.jpg'),
							'light-blue.css' 	=> array('alt' => __('Light Blue', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/skins/light-blue.jpg'),
							'light-green.css' 	=> array('alt' => __('Light Green', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/skins/light-green.jpg'),
							'light-yellow.css' 	=> array('alt' => __('Light Yellow', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/skins/light-yellow.jpg'),
							'orange.css' 		=> array('alt' => __('Orange', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/skins/orange.jpg'),
							'red.css' 			=> array('alt' => __('Red', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/skins/red.jpg'),
							'brown.css' 		=> array('alt' => __('Brown', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/skins/brown.jpg'),
							'violet.css' 		=> array('alt' => __('Violet', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/skins/violet.jpg'),
						),
                        'default' 	=> 'yellow.css'
                    ),
					array(
                        'id'		=> 'zozo_theme_skin',
                        'type'     	=> 'select',
                        'title' 	=> __('Theme Skin', 'mist'),
                        'options'  	=> array(
							'light'		=> __( 'Light', 'mist' ),
							'dark'		=> __( 'Dark', 'mist' ),
						),
						'default' 	=> 'light'
                    ),
					array(
						'id'       		=> 'zozo_custom_scheme_color',
						'type'     		=> 'color',
						'title'    		=> __( 'Custom Color Scheme', 'mist' ),
						'validate' 		=> 'color',
						'transparent' 	=> false
					),
					array(
						'id'       		=> 'zozo_custom_color_skin',
						'type'     		=> 'link_color',
						'title'    		=> __( 'Custom Color Skin', 'mist' ),
						'subtitle' 		=> __( 'Specify the Color when Custom Color Scheme works as background color.', 'mist' ),
						'active'   		=> false,
						'default'  		=> array(
							'regular' 	=> '',
							'hover'   	=> '',							
						)
					),
					array(
						'id'       => 'zozo_link_color',
						'type'     => 'link_color',
						'title'    => __( 'Link Color', 'mist' ),
						'subtitle' => __( 'Choose link color.', 'mist' ),
						'active'   => false,
						'default'  => array(
							'regular' => '',
							'hover'   => '',							
						)
					),
                )
            );
			
			// Body/Page Background
			$this->sections[] = array(
                'icon_class' 		=> 'icon',
                'subsection' 		=> true,
                'title' 			=> __('Body/Page', 'mist'),
                'fields' 			=> array(
                   array(
						'id'       	=> 'zozo_body_bg_image',
						'type'     	=> 'background',
						'title'    	=> __( 'Body Background', 'mist' ),
						'subtitle' 	=> __( 'Body background with image, color, etc.', 'mist' ),
					),
					array(
						'id'       	=> 'zozo_page_bg_image',
						'type'     	=> 'background',
						'title'    	=> __( 'Page Background', 'mist' ),
						'subtitle' 	=> __( 'Page background with image, color, etc.', 'mist' ),
					),
                )
            );
			
			// Header Background
			$this->sections[] = array(
                'icon_class' 		=> 'icon',
                'subsection' 		=> true,
                'title' 			=> __('Header', 'mist'),
                'fields' 			=> array(
                    array(
						'id'       	=> 'zozo_header_bg_image',
						'type'     	=> 'background',
						'title'    	=> __( 'Header Background', 'mist' ),
						'subtitle' 	=> __( 'Header background with image, color, etc.', 'mist' ),
						'default' 	=> ''
					),
					array(
						'id'       	=> 'zozo_sticky_bg_image',
						'type'     	=> 'background',
						'title'    	=> __( 'Sticky Background', 'mist' ),
						'subtitle' 	=> __( 'Sticky background with image, color, etc.', 'mist' ),
						'default' 	=> ''
					),
					array(
						'id'       => 'zozo_header_top_background_color',
						'type'     => 'color',
						'title'    => __( 'Header Top Background Color', 'mist' ),
						'default'  => '',
						'validate' => 'color',
					),
					array(
						'id'       => 'zozo_sliding_background_color',
						'type'     => 'color',
						'title'    => __( 'Sliding Bar Background Color', 'mist' ),
						'default'  => '',
						'validate' => 'color',
					),
                )
            );
			
			// Menu Background
			$this->sections[] = array(
                'icon_class' 		=> 'icon',
                'subsection' 		=> true,
                'title' 			=> __('Menu', 'mist'),
                'fields' 			=> array(
                   array(
                        'id'		=> 'menu_hover',
                        'type' 		=> 'info',
                        'title' 	=> __('Menu Hover Colors', 'mist'),
                        'notice' 	=> false
                    ),
					array(
						'id'       => 'zozo_top_menu_hcolor',
						'type'     => 'link_color',
						'title'    => __( 'Top Menu Link Color', 'mist' ),
						'subtitle' => __( 'Choose Top Menu link hover color.', 'mist' ),
						'regular'   => false,
						'active'   => false,
						'default'  => array(
							'hover'   => '',							
						)
					),
					array(
						'id'       => 'zozo_main_menu_hcolor',
						'type'     => 'link_color',
						'title'    => __( 'Main Menu Link Color', 'mist' ),
						'subtitle' => __( 'Choose Main Menu link hover color.', 'mist' ),
						'regular'   => false,
						'active'   => false,
						'default'  => array(
							'hover'   => '',							
						)
					),
					array(
                        'id'		=> 'submenu_hover',
                        'type' 		=> 'info',
                        'title' 	=> __('Menu Dropdown', 'mist'),
                        'notice' 	=> false
                    ),
					array(
                        'id'		=> 'zozo_submenu_show_border',
                        'type' 		=> 'switch',
                        'title' 	=> __('Show Border', 'mist'),
                        'default' 	=> true,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
					array(
						'id' 		=> 'zozo_main_submenu_border',
						'type' 		=> 'border',
						'all' 		=> false,
						'title' 	=> __( 'Dropdown Menu Border', 'mist' ),
						'subtitle' 	=> __( 'Enter border for menu dropdown.', 'mist' ),
						'required' 	=> array('zozo_submenu_show_border', 'equals', true),
						'default' 	=> array(
							'border-color'  => '',
							'border-style'  => 'solid',
							'border-top'    => '3px',
							'border-right'  => '0px',
							'border-bottom' => '0px',
							'border-left'   => '0px'
						)
					),
					array(
						'id'       => 'zozo_submenu_bg_color',
						'type'     => 'color',
						'title'    => __( 'Background Color', 'mist' ),
						'default'  => '#ffffff',
						'validate' => 'color',
					),
					array(
						'id'       => 'zozo_sub_menu_hcolor',
						'type'     => 'link_color',
						'title'    => __( 'Sub Menu Link Color', 'mist' ),
						'subtitle' => __( 'Choose Sub Menu link hover color.', 'mist' ),
						'regular'   => false,
						'active'   => false,
						'default'  => array(
							'hover'   => '',							
						)
					),
					array(
						'id'       => 'zozo_submenu_hbg_color',
						'type'     => 'color',
						'title'    => __( 'Link Hover Background Color', 'mist' ),
						'default'  => '',
						'validate' => 'color',
					),
                )
            );
			
			// Footer Background
			$this->sections[] = array(
                'icon_class' 		=> 'icon',
                'subsection' 		=> true,
                'title' 			=> __('Footer', 'mist'),
                'fields' 			=> array(
                    array(
						'id'       	=> 'zozo_footer_bg_image',
						'type'     	=> 'background',
						'title'    	=> __( 'Footer Background', 'mist' ),
						'subtitle' 	=> __( 'Footer background with image, color, etc.', 'mist' ),
					),
					array(
						'id'       	=> 'zozo_footer_copy_bg_image',
						'type'     	=> 'background',
						'title'    	=> __( 'Footer Copyright Background', 'mist' ),
						'subtitle' 	=> __( 'Footer copyright bar background with image, color, etc.', 'mist' ),
					),
                )
            );
			
			// Social Icons
			$this->sections[] = array(
				'icon' 				=> 'el-icon-link',
                'icon_class' 		=> 'icon',
                'title' 			=> __('Social', 'mist'),
                'fields' 			=> array(
					array(
						'id'       	=> 'zozo_social_icon_window',
						'type'     	=> 'select',
						'title'    	=> __( 'Target Window', 'mist' ),
						'subtitle' 	=> __( 'Select the target window open into same window or blank window.', 'mist' ),
						'options'  	=> array(
							'_self'		=> __('Self', 'mist'),
							'_blank'	=> __('Blank', 'mist'),
							'_parent'	=> __('Parent', 'mist')
						),
						'default'  	=> '_self'
					),
                	array(
                        'id'		=> 'zozo_social_icon_type',
                        'type' 		=> 'image_select',
                        'title' 	=> __('Icon Type', 'mist'),
                        'options' 	=> array(
							'circle' 		=> array('alt' => __('Circle', 'mist'), 'img' => ZOZO_ADMIN_ASSETS . 'images/layouts/circle-icon.jpg'),
							'flat' 			=> array('alt' => __('Square', 'mist'), 'img' => ZOZO_ADMIN_ASSETS . 'images/layouts/flat-icon.jpg'),
							'rounded' 		=> array('alt' => __('Rounded', 'mist'), 'img' => ZOZO_ADMIN_ASSETS . 'images/layouts/rounded-icon.jpg'),
							'transparent' 	=> array('alt' => __('Transparent', 'mist'), 'img' => ZOZO_ADMIN_ASSETS . 'images/layouts/transparent-icon.jpg'),
						),
                        'default' 	=> 'transparent'
                    ),
					array(
                        'id'		=> 'zozo_facebook_link',
                        'type'     	=> 'text',
                        'title' 	=> __('Facebook', 'mist'),
                        'desc' 		=> __('Enter the link for Facebook icon to appear. To remove it, just leave it blank.', 'mist'),
                        'default' 	=> ""
                    ),
					array(
                        'id'		=> 'zozo_twitter_link',
                        'type'     	=> 'text',
                        'title' 	=> __('Twitter', 'mist'),
                        'desc' 		=> __('Enter the link for Twitter icon to appear. To remove it, just leave it blank.', 'mist'),
                        'default' 	=> ""
                    ),
					array(
                        'id'		=> 'zozo_linkedin_link',
                        'type'     	=> 'text',
                        'title' 	=> __('LinkedIn', 'mist'),
                        'desc' 		=> __('Enter the link for LinkedIn icon to appear. To remove it, just leave it blank.', 'mist'),
                        'default' 	=> ""
                    ),
					array(
                        'id'		=> 'zozo_pinterest_link',
                        'type'     	=> 'text',
                        'title' 	=> __('Pinterest', 'mist'),
                        'desc' 		=> __('Enter the link for Pinterest icon to appear. To remove it, just leave it blank.', 'mist'),
                        'default' 	=> ""
                    ),
					array(
                        'id'		=> 'zozo_youtube_link',
                        'type'     	=> 'text',
                        'title' 	=> __('Youtube', 'mist'),
                        'desc' 		=> __('Enter the link for Youtube icon to appear. To remove it, just leave it blank.', 'mist'),
                        'default' 	=> ""
                    ),
					array(
                        'id'		=> 'zozo_rss_link',
                        'type'     	=> 'text',
                        'title' 	=> __('RSS', 'mist'),
                        'desc' 		=> __('Enter the link for RSS icon to appear. To remove it, just leave it blank.', 'mist'),
                        'default' 	=> ""
                    ),
					array(
                        'id'		=> 'zozo_tumblr_link',
                        'type'     	=> 'text',
                        'title' 	=> __('Tumblr', 'mist'),
                        'desc' 		=> __('Enter the link for Tumblr icon to appear. To remove it, just leave it blank.', 'mist'),
                        'default' 	=> ""
                    ),
					array(
                        'id'		=> 'zozo_reddit_link',
                        'type'     	=> 'text',
                        'title' 	=> __('Reddit', 'mist'),
                        'desc' 		=> __('Enter the link for Reddit icon to appear. To remove it, just leave it blank.', 'mist'),
                        'default' 	=> ""
                    ),
					array(
                        'id'		=> 'zozo_dribbble_link',
                        'type'     	=> 'text',
                        'title' 	=> __('Dribbble', 'mist'),
                        'desc' 		=> __('Enter the link for Dribbble icon to appear. To remove it, just leave it blank.', 'mist'),
                        'default' 	=> ""
                    ),
					array(
                        'id'		=> 'zozo_digg_link',
                        'type'     	=> 'text',
                        'title' 	=> __('Digg', 'mist'),
                        'desc' 		=> __('Enter the link for Digg icon to appear. To remove it, just leave it blank.', 'mist'),
                        'default' 	=> ""
                    ),
					array(
                        'id'		=> 'zozo_flickr_link',
                        'type'     	=> 'text',
                        'title' 	=> __('Flickr', 'mist'),
                        'desc' 		=> __('Enter the link for Flickr icon to appear. To remove it, just leave it blank.', 'mist'),
                        'default' 	=> ""
                    ),
					array(
                        'id'		=> 'zozo_instagram_link',
                        'type'     	=> 'text',
                        'title' 	=> __('Instagram', 'mist'),
                        'desc' 		=> __('Enter the link for Instagram icon to appear. To remove it, just leave it blank.', 'mist'),
                        'default' 	=> ""
                    ),
					array(
                        'id'		=> 'zozo_vimeo_link',
                        'type'     	=> 'text',
                        'title' 	=> __('Vimeo', 'mist'),
                        'desc' 		=> __('Enter the link for Vimeo icon to appear. To remove it, just leave it blank.', 'mist'),
                        'default' 	=> ""
                    ),
					array(
                        'id'		=> 'zozo_skype_link',
                        'type'     	=> 'text',
                        'title' 	=> __('Skype', 'mist'),
                        'desc' 		=> __('Enter the link for Skype icon to appear. To remove it, just leave it blank.', 'mist'),
                        'default' 	=> ""
                    ),
					array(
                        'id'		=> 'zozo_blogger_link',
                        'type'     	=> 'text',
                        'title' 	=> __('Blogger', 'mist'),
                        'desc' 		=> __('Enter the link for Blogger icon to appear. To remove it, just leave it blank.', 'mist'),
                        'default' 	=> ""
                    ),
					array(
                        'id'		=> 'zozo_yahoo_link',
                        'type'     	=> 'text',
                        'title' 	=> __('Yahoo', 'mist'),
                        'desc' 		=> __('Enter the link for Yahoo icon to appear. To remove it, just leave it blank.', 'mist'),
                        'default' 	=> ""
                    ),
                )
            );
			
			// Portfolio
			$this->sections[] = array(
				'icon' 				=> 'el-icon-picture',
                'icon_class' 		=> 'icon',
                'title' 			=> __('Portfolio', 'mist'),
                'fields' 			=> array(
					array(
                        'id'		=> 'zozo_portfolio_archive_count',
                        'type'     	=> 'text',
                        'title' 	=> __('Number of Portfolio Items Per Page', 'mist'),
						'desc' 		=> __('Enter the number of posts to display per page in archive/category.', 'mist'),
                        'default' 	=> "10"
                    ),
					array(
                        'id'		=> 'zozo_portfolio_archive_layout',
                        'type'     	=> 'select',
                        'title' 	=> __('Portfolio Archive/Category Layout', 'mist'),
                        'options'  	=> array(
							'grid'		=> __( 'Grid', 'mist' ),
							'classic'	=> __( 'Classic', 'mist' ),
						),
						'default' 	=> 'grid'
                    ),
					array(
                        'id'		=> 'zozo_portfolio_archive_columns',
                        'type'     	=> 'select',
                        'title' 	=> __('Portfolio Columns', 'mist'),
                        'options'  	=> array(
							'2' 		=> __('2 Columns', 'mist'),
							'3' 		=> __('3 Columns', 'mist'),
							'4' 		=> __('4 Columns', 'mist')
						),
						'default' 	=> '4'
                    ),
					array(
                        'id'		=> 'zozo_portfolio_archive_gutter',
                        'type'     	=> 'text',
                        'title' 	=> __('Portfolio Items Spacing', 'mist'),
						'desc' 		=> __('Enter gap size between portfolio items. Only enter number Ex: 10', 'mist'),
                        'default' 	=> "30"
                    ),
					array(
                        'id'		=> 'zozo_portfolio_prev_next',
                        'type' 		=> 'switch',
                        'title' 	=> __('Show Post Navigation', 'mist'),
                        'default' 	=> true,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
					array(
                        'id'		=> 'zozo_portfolio_related_slider',
                        'type' 		=> 'switch',
                        'title' 	=> __('Show Related Works Slider', 'mist'),
                        'default' 	=> true,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
					array(
                        'id'		=> 'zozo_portfolio_related_title',
                        'type'     	=> 'text',
                        'title' 	=> __('Related Works Slider Title', 'mist'),
						'required' 	=> array('zozo_portfolio_related_slider', 'equals', true),
                        'default' 	=> ""
                    ),
					array(
                        'id'		=> 'zozo_portfolio_citems',
                        'type'     	=> 'text',
                        'title' 	=> __('Items to Display', 'mist'),
						'required' 	=> array('zozo_portfolio_related_slider', 'equals', true),
                        'default' 	=> ""
                    ),
					array(
                        'id'		=> 'zozo_portfolio_citems_scroll',
                        'type'     	=> 'text',
                        'title' 	=> __('Items to Scrollby', 'mist'),
						'required' 	=> array('zozo_portfolio_related_slider', 'equals', true),
                        'default' 	=> ""
                    ),
					array(
                        'id'		=> 'zozo_portfolio_ctablet',
                        'type'     	=> 'text',
                        'title' 	=> __('Items To Display in Tablet', 'mist'),
						'required' 	=> array('zozo_portfolio_related_slider', 'equals', true),
                        'default' 	=> ""
                    ),
					array(
                        'id'		=> 'zozo_portfolio_cmobile_land',
                        'type'     	=> 'text',
                        'title' 	=> __('Items To Display in Mobile Landscape', 'mist'),
						'required' 	=> array('zozo_portfolio_related_slider', 'equals', true),
                        'default' 	=> ""
                    ),
					array(
                        'id'		=> 'zozo_portfolio_cmobile',
                        'type'     	=> 'text',
                        'title' 	=> __('Items To Display in Mobile Portrait', 'mist'),
						'required' 	=> array('zozo_portfolio_related_slider', 'equals', true),
                        'default' 	=> ""
                    ),
					array(
                        'id'		=> 'zozo_portfolio_cmargin',
                        'type'     	=> 'text',
                        'title' 	=> __('Margin ( Items Spacing )', 'mist'),
						'required' 	=> array('zozo_portfolio_related_slider', 'equals', true),
                        'default' 	=> "20"
                    ),
					array(
                        'id'		=> 'zozo_portfolio_cautoplay',
                        'type' 		=> 'switch',
                        'title' 	=> __('Autoplay', 'mist'),
                        'default' 	=> true,
						'required' 	=> array('zozo_portfolio_related_slider', 'equals', true),
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
					array(
                        'id'		=> 'zozo_portfolio_ctimeout',
                        'type'     	=> 'text',
                        'title' 	=> __('Timeout Duration (in milliseconds)', 'mist'),
						'required' 	=> array('zozo_portfolio_cautoplay', 'equals', true),
                        'default' 	=> "5000"
                    ),
					array(
                        'id'		=> 'zozo_portfolio_cloop',
                        'type' 		=> 'switch',
                        'title' 	=> __('Infinite Loop', 'mist'),
						'required' 	=> array('zozo_portfolio_related_slider', 'equals', true),
                        'default' 	=> false,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
					array(
                        'id'		=> 'zozo_portfolio_cpagination',
                        'type' 		=> 'switch',
                        'title' 	=> __('Pagination', 'mist'),
						'required' 	=> array('zozo_portfolio_related_slider', 'equals', true),
                        'default' 	=> true,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
					array(
                        'id'		=> 'zozo_portfolio_cnavigation',
                        'type' 		=> 'switch',
                        'title' 	=> __('Navigation', 'mist'),
						'required' 	=> array('zozo_portfolio_related_slider', 'equals', true),
                        'default' 	=> false,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
				)
            );
			
			// Post
			$this->sections[] = array(
				'icon' 				=> 'el-icon-file',
                'icon_class' 		=> 'icon',
                'title' 			=> __('Post', 'mist'),
                'fields' 			=> array(
					array(
                        'id'		=> 'zozo_disable_blog_pagination',
                        'type' 		=> 'switch',
                        'title' 	=> __('Enable Infinite Scroll', 'mist'),
                        'default' 	=> false,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
					array(
                        'id'		=> 'zozo_blog_read_more_text',
                        'type'     	=> 'text',
                        'title' 	=> __('Read More Button Text', 'mist'),
                        'desc' 		=> __('Enter the custom read more button text.', 'mist'),
                        'default' 	=> ""
                    ),
					array(
                        'id'		=> 'zozo_blog_excerpt_length_large',
                        'type'     	=> 'text',
                        'title' 	=> __('Excerpt Length for Large Layout', 'mist'),
                        'default' 	=> "80"
                    ),
					array(
                        'id'		=> 'zozo_blog_excerpt_length_grid',
                        'type'     	=> 'text',
                        'title' 	=> __('Excerpt Length for Grid Layout', 'mist'),
                        'default' 	=> "40"
                    ),
					array(
                        'id'		=> 'gallery_slider',
                        'type' 		=> 'info',
                        'title' 	=> __('Blog Gallery Slider', 'mist'),
                        'notice' 	=> false
                    ),
					array(
                        'id'		=> 'zozo_blog_slideshow_autoplay',
                        'type' 		=> 'switch',
                        'title' 	=> __('Enable Autoplay for Gallery Slider', 'mist'),
                        'default' 	=> true,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
					array(
                        'id'		=> 'zozo_blog_slideshow_timeout',
                        'type'     	=> 'text',
                        'title' 	=> __('Timeout Duration (in milliseconds)', 'mist'),
						'required' 	=> array('zozo_blog_slideshow_autoplay', 'equals', true),
                        'default' 	=> "5000"
                    ),
					array(
                        'id'		=> 'post_meta',
                        'type' 		=> 'info',
                        'title' 	=> __('Blog Post Meta', 'mist'),
                        'notice' 	=> false
                    ),
					array(
                        'id'		=> 'zozo_blog_date_format',
                        'type'     	=> 'text',
                        'title' 	=> __('Post Meta Date Format', 'mist'),
						"desc" 		=> "Enter post meta date format. Refer formats from <a href='http://codex.wordpress.org/Formatting_Date_and_Time'>Formatting Date and Time</a>",
                        'default' 	=> "d.m.Y"
                    ),
					array(
                        'id'		=> 'zozo_blog_post_meta_author',
                        'type' 		=> 'switch',
                        'title' 	=> __('Disable Post Meta Author', 'mist'),
                        'default' 	=> false,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
					array(
                        'id'		=> 'zozo_blog_post_meta_date',
                        'type' 		=> 'switch',
                        'title' 	=> __('Disable Post Meta Date', 'mist'),
                        'default' 	=> false,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
					array(
                        'id'		=> 'zozo_blog_post_meta_categories',
                        'type' 		=> 'switch',
                        'title' 	=> __('Disable Post Meta Categories', 'mist'),
                        'default' 	=> false,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
					array(
                        'id'		=> 'zozo_blog_post_meta_comments',
                        'type' 		=> 'switch',
                        'title' 	=> __('Disable Post Meta Comments', 'mist'),
                        'default' 	=> false,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
					array(
                        'id'		=> 'zozo_blog_read_more',
                        'type' 		=> 'switch',
                        'title' 	=> __('Disable Read More Link', 'mist'),
                        'default' 	=> false,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
				)
            );
			
			// Blog Archive
			$this->sections[] = array(
                'icon_class' 		=> 'icon',
                'subsection' 		=> true,
                'title' 			=> __('Blog Archive', 'mist'),
                'fields' 			=> array(
                    array(
                        'id'		=> 'zozo_blog_archive_layout',
                        'type' 		=> 'image_select',
                        'title' 	=> __('Archive Layout', 'mist'),
                        'options' 	=> array(
							'one-col' 			=> array('alt' => __('Full width', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/layouts/one-col.png'),
							'two-col-right' 	=> array('alt' => __('Right Sidebar', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/layouts/two-col-right.png'),
							'two-col-left' 		=> array('alt' => __('Left Sidebar', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/layouts/two-col-left.png'),
							'three-col-middle' 	=> array('alt' => __('Left and Right Sidebar', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/layouts/three-col-middle.png'),
							'three-col-right' 	=> array('alt' => __('Two Right Sidebars', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/layouts/three-col-right.png'),
							'three-col-left' 	=> array('alt' => __('Two Left Sidebars', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/layouts/three-col-left.png'),
						),
                        'default' 	=> 'one-col'
                    ),
					array(
                        'id'		=> 'zozo_archive_blog_type',
                        'type' 		=> 'image_select',
                        'title' 	=> __('Post Layout', 'mist'),
                        'options' 	=> array(
							'large' 	=> array('alt' => __('Large Layout', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/layouts/blog-large.jpg'),
							'list' 		=> array('alt' => __('List Layout', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/layouts/blog-list.jpg'),
							'grid' 		=> array('alt' => __('Grid Layout', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/layouts/blog-grid.jpg'),
						),
                        'default' 	=> 'large'
                    ),
					array(
                        'id'		=> 'zozo_archive_blog_grid_columns',
                        'type'     	=> 'select',
                        'title' 	=> __('Grid Columns', 'mist'),
						'required' 	=> array('zozo_archive_blog_type', 'equals', 'grid'),
                        'options'  	=> array(
							'two' 		=> __('2 Columns', 'mist'),
							'three' 	=> __('3 Columns', 'mist'),
							'four' 		=> __('4 Columns', 'mist')
						),
						'default' 	=> 'two'
                    ),
					array(
                        'id'		=> 'zozo_show_archive_featured_slider',
                        'type' 		=> 'switch',
                        'title' 	=> __('Show Featured Post Slider', 'mist'),
                        'default' 	=> false,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),					
                )
            );
			
			// Blog
			$this->sections[] = array(
                'icon_class' 		=> 'icon',
                'subsection' 		=> true,
                'title' 			=> __('Blog', 'mist'),
                'fields' 			=> array(
					array(
                        'id'		=> 'zozo_blog_page_title_bar',
                        'type' 		=> 'switch',
                        'title' 	=> __('Show Page title bar for Blog', 'mist'),
                        'default' 	=> true,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
					array(
                        'id'		=> 'zozo_blog_title',
                        'type'     	=> 'text',
                        'title' 	=> __('Blog Page Title', 'mist'),	
						'desc' 		=> __('Blog Page Title for the main blog page.', 'mist'),
                        'default' 	=> ""
                    ),
					array(
                        'id'		=> 'zozo_blog_slogan',
                        'type'     	=> 'text',
                        'title' 	=> __('Blog Page Slogan', 'mist'),	
						'desc' 		=> __('Blog Page Slogan for the main blog page.', 'mist'),
                        'default' 	=> ""
                    ),
                    array(
                        'id'		=> 'zozo_blog_layout',
                        'type' 		=> 'image_select',
                        'title' 	=> __('Blog Layout', 'mist'),
                        'options' 	=> array(
							'one-col' 			=> array('alt' => __('Full width', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/layouts/one-col.png'),
							'two-col-right' 	=> array('alt' => __('Right Sidebar', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/layouts/two-col-right.png'),
							'two-col-left' 		=> array('alt' => __('Left Sidebar', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/layouts/two-col-left.png'),
							'three-col-middle' 	=> array('alt' => __('Left and Right Sidebar', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/layouts/three-col-middle.png'),
							'three-col-right' 	=> array('alt' => __('Two Right Sidebars', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/layouts/three-col-right.png'),
							'three-col-left' 	=> array('alt' => __('Two Left Sidebars', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/layouts/three-col-left.png'),
						),
                        'default' 	=> 'one-col'
                    ),
					array(
                        'id'		=> 'zozo_blog_type',
                        'type' 		=> 'image_select',
                        'title' 	=> __('Post Layout', 'mist'),
                        'options' 	=> array(
							'large' 	=> array('alt' => __('Large Layout', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/layouts/blog-large.jpg'),
							'list' 		=> array('alt' => __('List Layout', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/layouts/blog-list.jpg'),
							'grid' 		=> array('alt' => __('Grid Layout', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/layouts/blog-grid.jpg'),
						),
                        'default' 	=> 'large'
                    ),
					array(
                        'id'		=> 'zozo_blog_grid_columns',
                        'type'     	=> 'select',
                        'title' 	=> __('Grid Columns', 'mist'),
						'required' 	=> array('zozo_blog_type', 'equals', 'grid'),
                        'options'  	=> array(
							'two' 		=> __('2 Columns', 'mist'),
							'three' 	=> __('3 Columns', 'mist'),
							'four' 		=> __('4 Columns', 'mist')
						),
						'default' 	=> 'two'
                    ),
					array(
                        'id'		=> 'zozo_show_blog_featured_slider',
                        'type' 		=> 'switch',
                        'title' 	=> __('Show Featured Post Slider', 'mist'),
                        'default' 	=> false,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
				)
            );
			
			// Single Post Layout
			$this->sections[] = array(
                'icon_class' 		=> 'icon',
                'subsection' 		=> true,
                'title' 			=> __('Single Post', 'mist'),
                'fields' 			=> array(
                    array(
                        'id'		=> 'zozo_single_post_layout',
                        'type' 		=> 'image_select',
                        'title' 	=> __('Single Post Layout', 'mist'),
                        'options' 	=> array(
							'one-col' 			=> array('alt' => __('Full width', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/layouts/one-col.png'),
							'two-col-right' 	=> array('alt' => __('Right Sidebar', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/layouts/two-col-right.png'),
							'two-col-left' 		=> array('alt' => __('Left Sidebar', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/layouts/two-col-left.png'),
							'three-col-middle' 	=> array('alt' => __('Left and Right Sidebar', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/layouts/three-col-middle.png'),
							'three-col-right' 	=> array('alt' => __('Two Right Sidebars', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/layouts/three-col-right.png'),
							'three-col-left' 	=> array('alt' => __('Two Left Sidebars', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/layouts/three-col-left.png'),
						),
                        'default' 	=> 'one-col'
                    ),
					array(
                        'id'		=> 'zozo_blog_social_sharing',
                        'type' 		=> 'switch',
                        'title' 	=> __('Show Social Sharing', 'mist'),
                        'default' 	=> true,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
					array(
                        'id'		=> 'zozo_blog_author_info',
                        'type' 		=> 'switch',
                        'title' 	=> __('Show Author Info', 'mist'),
                        'default' 	=> true,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
					array(
                        'id'		=> 'zozo_blog_comments',
                        'type' 		=> 'switch',
                        'title' 	=> __('Show Comments', 'mist'),
                        'default' 	=> true,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
					array(
                        'id'		=> 'related_post_slider',
                        'type' 		=> 'info',
                        'title' 	=> __('Related Posts Slider', 'mist'),
                        'notice' 	=> false
                    ),
					array(
                        'id'		=> 'zozo_show_related_posts',
                        'type' 		=> 'switch',
                        'title' 	=> __('Show Related Posts', 'mist'),
                        'default' 	=> true,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
					array(
                        'id'		=> 'zozo_related_blog_items',
                        'type'     	=> 'text',
                        'title' 	=> __('Items to Display', 'mist'),
						'required' 	=> array('zozo_show_related_posts', 'equals', true),
                        'default' 	=> "3"
                    ),
					array(
                        'id'		=> 'zozo_related_blog_items_scroll',
                        'type'     	=> 'text',
                        'title' 	=> __('Items to Scrollby', 'mist'),
						'required' 	=> array('zozo_show_related_posts', 'equals', true),
                        'default' 	=> "1"
                    ),
					array(
                        'id'		=> 'zozo_related_blog_autoplay',
                        'type' 		=> 'switch',
                        'title' 	=> __('Enable Auto Play', 'mist'),
                        'default' 	=> true,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
						'required' 	=> array('zozo_show_related_posts', 'equals', true),
                    ),
					array(
                        'id'		=> 'zozo_related_blog_timeout',
                        'type'     	=> 'text',
                        'title' 	=> __('Timeout Duration (in milliseconds)', 'mist'),
						'required' 	=> array('zozo_show_related_posts', 'equals', true),
                        'default' 	=> "5000"
                    ),
					array(
                        'id'		=> 'zozo_related_blog_loop',
                        'type' 		=> 'switch',
                        'title' 	=> __('Enable Infinite Loop', 'mist'),
                        'default' 	=> false,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
						'required' 	=> array('zozo_show_related_posts', 'equals', true),
                    ),
					array(
                        'id'		=> 'zozo_related_blog_margin',
                        'type'     	=> 'text',
                        'title' 	=> __('Margin ( Items Spacing )', 'mist'),
						'required' 	=> array('zozo_show_related_posts', 'equals', true),
                        'default' 	=> "30"
                    ),
					array(
                        'id'		=> 'zozo_related_blog_tablet',
                        'type'     	=> 'text',
                        'title' 	=> __('Items To Display in Tablet', 'mist'),
						'required' 	=> array('zozo_show_related_posts', 'equals', true),
                        'default' 	=> "3"
                    ),
					array(
                        'id'		=> 'zozo_related_blog_landscape',
                        'type'     	=> 'text',
                        'title' 	=> __('Items To Display in Mobile Landscape', 'mist'),
						'required' 	=> array('zozo_show_related_posts', 'equals', true),
                        'default' 	=> "2"
                    ),
					array(
                        'id'		=> 'zozo_related_blog_portrait',
                        'type'     	=> 'text',
                        'title' 	=> __('Items To Display in Mobile Portrait', 'mist'),
						'required' 	=> array('zozo_show_related_posts', 'equals', true),
                        'default' 	=> "1"
                    ),
					array(
                        'id'		=> 'zozo_related_blog_dots',
                        'type' 		=> 'switch',
                        'title' 	=> __('Enable Pagination', 'mist'),
                        'default' 	=> false,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
						'required' 	=> array('zozo_show_related_posts', 'equals', true),
                    ),
					array(
                        'id'		=> 'zozo_related_blog_nav',
                        'type' 		=> 'switch',
                        'title' 	=> __('Enable Navigation', 'mist'),
                        'default' 	=> true,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
						'required' 	=> array('zozo_show_related_posts', 'equals', true),
                    ),
					array(
                        'id'		=> 'zozo_blog_prev_next',
                        'type' 		=> 'switch',
                        'title' 	=> __('Show Post Navigation', 'mist'),
                        'default' 	=> true,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
					array(
                        'id'		=> 'gallery_slider',
                        'type' 		=> 'info',
                        'title' 	=> __('Blog Gallery Slider', 'mist'),
                        'notice' 	=> false
                    ),
					array(
                        'id'		=> 'zozo_single_blog_carousel',
                        'type' 		=> 'switch',
                        'title' 	=> __('Enable Gallery Slider as Carousel globally ?', 'mist'),
                        'default' 	=> false,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
					array(
                        'id'		=> 'zozo_single_blog_citems',
                        'type'     	=> 'text',
                        'title' 	=> __('Items to Display', 'mist'),
                        'default' 	=> "3"
                    ),
					array(
                        'id'		=> 'zozo_single_blog_citems_scroll',
                        'type'     	=> 'text',
                        'title' 	=> __('Items to Scrollby', 'mist'),
                        'default' 	=> "1"
                    ),
					array(
                        'id'		=> 'zozo_single_blog_cautoplay',
                        'type' 		=> 'switch',
                        'title' 	=> __('Enable Auto Play', 'mist'),
                        'default' 	=> true,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
					array(
                        'id'		=> 'zozo_single_blog_ctimeout',
                        'type'     	=> 'text',
                        'title' 	=> __('Timeout Duration (in milliseconds)', 'mist'),
                        'default' 	=> "5000"
                    ),
					array(
                        'id'		=> 'zozo_single_blog_cloop',
                        'type' 		=> 'switch',
                        'title' 	=> __('Enable Infinite Loop', 'mist'),
                        'default' 	=> false,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
					array(
                        'id'		=> 'zozo_single_blog_cmargin',
                        'type'     	=> 'text',
                        'title' 	=> __('Margin ( Items Spacing )', 'mist'),
                        'default' 	=> ""
                    ),
					array(
                        'id'		=> 'zozo_single_blog_ctablet',
                        'type'     	=> 'text',
                        'title' 	=> __('Items To Display in Tablet', 'mist'),
                        'default' 	=> "3"
                    ),
					array(
                        'id'		=> 'zozo_single_blog_cmlandscape',
                        'type'     	=> 'text',
                        'title' 	=> __('Items To Display in Mobile Landscape', 'mist'),
                        'default' 	=> "2"
                    ),
					array(
                        'id'		=> 'zozo_single_blog_cmportrait',
                        'type'     	=> 'text',
                        'title' 	=> __('Items To Display in Mobile Portrait', 'mist'),
                        'default' 	=> "1"
                    ),
					array(
                        'id'		=> 'zozo_single_blog_cdots',
                        'type' 		=> 'switch',
                        'title' 	=> __('Enable Pagination', 'mist'),
                        'default' 	=> false,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
					array(
                        'id'		=> 'zozo_single_blog_cnav',
                        'type' 		=> 'switch',
                        'title' 	=> __('Enable Navigation', 'mist'),
                        'default' 	=> true,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
                )
            );
			
			// Featured Post Slider
			$this->sections[] = array(
                'icon_class' 		=> 'icon',
                'subsection' 		=> true,
                'title' 			=> __('Featured Post Slider', 'mist'),
                'fields' 			=> array(
					array(
                        'id'		=> 'zozo_featured_slider_type',
                        'type'     	=> 'select',
                        'title' 	=> __('Featured Post Slider Display', 'mist'),
                        'options'  	=> array(
							'below_header' 		=> __('Below Header', 'mist'),
							'above_content' 	=> __('Above Content', 'mist'),
							'above_footer' 		=> __('Above Footer', 'mist')
						),
						'default' 	=> 'below_header'
                    ),
					array(
                        'id'		=> 'zozo_featured_posts_limit',
                        'type'     	=> 'text',
                        'title' 	=> __('Featured Posts Limit', 'mist'),						
                        'default' 	=> "6"
                    ),
					array(
                        'id'		=> 'zozo_featured_slider_citems',
                        'type'     	=> 'text',
                        'title' 	=> __('Items to Display', 'mist'),						
                        'default' 	=> "3"
                    ),
					array(
                        'id'		=> 'zozo_featured_slider_citems_scroll',
                        'type'     	=> 'text',
                        'title' 	=> __('Items to Scrollby', 'mist'),						
                        'default' 	=> "1"
                    ),
					array(
                        'id'		=> 'zozo_featured_slider_cautoplay',
                        'type' 		=> 'switch',
                        'title' 	=> __('Enable Auto Play', 'mist'),
                        'default' 	=> true,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
					array(
                        'id'		=> 'zozo_featured_slider_ctimeout',
                        'type'     	=> 'text',
                        'title' 	=> __('Timeout Duration (in milliseconds)', 'mist'),
                        'default' 	=> "5000"
                    ),
					array(
                        'id'		=> 'zozo_featured_slider_cloop',
                        'type' 		=> 'switch',
                        'title' 	=> __('Enable Infinite Loop', 'mist'),
                        'default' 	=> false,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
					array(
                        'id'		=> 'zozo_featured_slider_cmargin',
                        'type'     	=> 'text',
                        'title' 	=> __('Margin ( Items Spacing )', 'mist'),
                        'default' 	=> ""
                    ),
					array(
                        'id'		=> 'zozo_featured_slider_ctablet',
                        'type'     	=> 'text',
                        'title' 	=> __('Items To Display in Tablet', 'mist'),
                        'default' 	=> "3"
                    ),
					array(
                        'id'		=> 'zozo_featured_slider_cmlandscape',
                        'type'     	=> 'text',
                        'title' 	=> __('Items To Display in Mobile Landscape', 'mist'),
                        'default' 	=> "2"
                    ),
					array(
                        'id'		=> 'zozo_featured_slider_cmportrait',
                        'type'     	=> 'text',
                        'title' 	=> __('Items To Display in Mobile Portrait', 'mist'),
                        'default' 	=> "1"
                    ),
					array(
                        'id'		=> 'zozo_featured_slider_cdots',
                        'type' 		=> 'switch',
                        'title' 	=> __('Enable Pagination', 'mist'),
                        'default' 	=> false,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
					array(
                        'id'		=> 'zozo_featured_slider_cnav',
                        'type' 		=> 'switch',
                        'title' 	=> __('Enable Navigation', 'mist'),
                        'default' 	=> true,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
				)
            );
			
			// Search Page
			$this->sections[] = array(
				'icon' 				=> 'el-icon-search',
                'icon_class' 		=> 'icon',
                'title' 			=> __('Search Page', 'mist'),
                'fields' 			=> array(
					array(
                        'id'		=> 'zozo_search_page_type',
                        'type' 		=> 'image_select',
                        'title' 	=> __('Search Results Layout', 'mist'),
                        'options' 	=> array(
							'large' 	=> array('alt' => __('Large Layout', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/layouts/blog-large.jpg'),
							'list' 		=> array('alt' => __('List Layout', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/layouts/blog-list.jpg'),
							'grid' 		=> array('alt' => __('Grid Layout', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/layouts/blog-grid.jpg'),
						),
                        'default' 	=> 'grid'
                    ),
					array(
                        'id'		=> 'zozo_search_grid_columns',
                        'type'     	=> 'select',
                        'title' 	=> __('Grid Columns', 'mist'),
						'required' 	=> array('zozo_search_page_type', 'equals', 'grid'),
                        'options'  	=> array(
							'two' 		=> __('2 Columns', 'mist'),
							'three' 	=> __('3 Columns', 'mist'),
							'four' 		=> __('4 Columns', 'mist')
						),
						'default' 	=> 'two'
                    ),
					array(
                        'id'		=> 'zozo_search_results_content',
                        'type'     	=> 'select',
                        'title' 	=> __('Search Results Content', 'mist'),
                        'options'  	=> array(
							'both' 			=> __('Posts and Pages', 'mist'),
							'only_posts' 	=> __('Only Posts', 'mist'),
							'only_pages' 	=> __('Only Pages', 'mist'),
						),
						'default' 	=> 'both'
                    ),
				)
            );
			
			// Social Sharing Options
			$this->sections[] = array(
				'icon' 				=> 'el-icon-share-alt',
                'icon_class' 		=> 'icon',
                'title' 			=> __('Social Share', 'mist'),
                'fields' 			=> array(
					array(
                        'id'		=> 'zozo_sharing_facebook',
                        'type' 		=> 'switch',
                        'title' 	=> __('Enable Facebook Share', 'mist'),
                        'default' 	=> true,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
					array(
                        'id'		=> 'zozo_sharing_twitter',
                        'type' 		=> 'switch',
                        'title' 	=> __('Enable Twitter Share', 'mist'),
                        'default' 	=> true,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
					array(
                        'id'		=> 'zozo_sharing_linkedin',
                        'type' 		=> 'switch',
                        'title' 	=> __('Enable LinkedIn Share', 'mist'),
                        'default' 	=> true,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
					array(
                        'id'		=> 'zozo_sharing_pinterest',
                        'type' 		=> 'switch',
                        'title' 	=> __('Enable Pinterest Share', 'mist'),
                        'default' 	=> false,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
					array(
                        'id'		=> 'zozo_sharing_tumblr',
                        'type' 		=> 'switch',
                        'title' 	=> __('Enable Tumblr Share', 'mist'),
                        'default' 	=> false,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
					array(
                        'id'		=> 'zozo_sharing_reddit',
                        'type' 		=> 'switch',
                        'title' 	=> __('Enable Reddit Share', 'mist'),
                        'default' 	=> false,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
					array(
                        'id'		=> 'zozo_sharing_digg',
                        'type' 		=> 'switch',
                        'title' 	=> __('Enable Digg Share', 'mist'),
                        'default' 	=> false,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
					array(
                        'id'		=> 'zozo_sharing_email',
                        'type' 		=> 'switch',
                        'title' 	=> __('Enable Email Share', 'mist'),
                        'default' 	=> true,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
                )
            );
			
			// Contact Options
			$this->sections[] = array(
				'icon' 				=> 'el-icon-envelope',
                'icon_class' 		=> 'icon',
                'title' 			=> __('Contact', 'mist'),
                'fields' 			=> array(
					array(
                        'id'		=> 'zozo_contact_form_success',
                        'type'     	=> 'textarea',
                        'title' 	=> __('Contact Form Success Message', 'mist'),
                        'default' 	=> __("Thank you {name}. Your Email was successfully sent!", 'mist'),
						'desc' 		=> __('Enter Contact form success message. {name} it will be name of user who submits form. You need this text to show submitted user name in message.', 'mist'),
                    ),
					array(
                        'id'		=> 'zozo_contact_form_error',
                        'type'     	=> 'textarea',
                        'title' 	=> __('Contact Form Error Message', 'mist'),
                        'default' 	=> __("Sorry {name}. Your Email was not sent. Resubmit form again Please..", 'mist'),
						'desc' 		=> __('Enter Contact form error message. {name} it will be name of user who submits form. You need this text to show submitted user name in message.', 'mist'),
                    ),
                )
            );
			
			// Woocommerce Options
			$this->sections[] = array(
				'icon' 				=> 'el-icon-shopping-cart',
                'icon_class' 		=> 'icon',
                'title' 			=> __('Woocommerce', 'mist'),
                'fields' 			=> array(
					array(
                        'id'		=> 'zozo_woo_enable_catalog_mode',
                        'type' 		=> 'switch',
                        'title' 	=> __('Catalog Mode', 'mist'),
                        'default' 	=> false,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
						'desc' 		=> __('Enable this setting to set the products into catalog mode, with no cart or checkout process.', 'mist'),
                    ),
					array(
                        'id'		=> 'zozo_woo_archive_layout',
                        'type' 		=> 'image_select',
                        'title' 	=> __('Product Archive Layout', 'mist'),
                        'options' 	=> array(
							'one-col' 			=> array('alt' => __('Full width', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/layouts/one-col.png'),
							'two-col-right' 	=> array('alt' => __('Right Sidebar', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/layouts/two-col-right.png'),
							'two-col-left' 		=> array('alt' => __('Left Sidebar', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/layouts/two-col-left.png'),
							'three-col-middle' 	=> array('alt' => __('Left and Right Sidebar', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/layouts/three-col-middle.png'),
							'three-col-right' 	=> array('alt' => __('Two Right Sidebars', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/layouts/three-col-right.png'),
							'three-col-left' 	=> array('alt' => __('Two Left Sidebars', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/layouts/three-col-left.png'),
						),
                        'default' 	=> 'one-col'
                    ),
					array(
                        'id'		=> 'zozo_woo_single_layout',
                        'type' 		=> 'image_select',
                        'title' 	=> __('Single Product Layout', 'mist'),
                        'options' 	=> array(
							'one-col' 			=> array('alt' => __('Full width', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/layouts/one-col.png'),
							'two-col-right' 	=> array('alt' => __('Right Sidebar', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/layouts/two-col-right.png'),
							'two-col-left' 		=> array('alt' => __('Left Sidebar', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/layouts/two-col-left.png'),
							'three-col-middle' 	=> array('alt' => __('Left and Right Sidebar', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/layouts/three-col-middle.png'),
							'three-col-right' 	=> array('alt' => __('Two Right Sidebars', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/layouts/three-col-right.png'),
							'three-col-left' 	=> array('alt' => __('Two Left Sidebars', 'mist'), 'img' => ZOZO_ADMIN_ASSETS.'images/layouts/three-col-left.png'),
						),
                        'default' 	=> 'two-col-right'
                    ),
					array(
                        'id'		=> 'zozo_loop_products_per_page',
                        'type'     	=> 'text',
                        'title' 	=> __('Products Per Page', 'mist'),
                        'default' 	=> "12"
                    ),
					array(
                        'id'		=> 'zozo_loop_shop_columns',
                        'type'     	=> 'select',
                        'title' 	=> __('Product Columns', 'mist'),
                        'options'  	=> array(
							'2' 		=> __('2 Columns', 'mist'),
							'3' 		=> __('3 Columns', 'mist'),
							'4' 		=> __('4 Columns', 'mist'),
							'5' 		=> __('5 Columns', 'mist')
						),
						'default' 	=> '4'
                    ),
					array(
                        'id'		=> 'zozo_related_products_count',
                        'type'     	=> 'select',
                        'title' 	=> __('Related Products Count', 'mist'),
                        'options'  	=> array(
							'2' 		=> __('2 Products', 'mist'),
							'3' 		=> __('3 Products', 'mist'),
							'4' 		=> __('4 Products', 'mist'),
							'5' 		=> __('5 Products', 'mist')
						),
						'default' 	=> '3'
                    ),
					array(
                        'id'		=> 'zozo_woo_shop_ordering',
                        'type' 		=> 'switch',
                        'title' 	=> __('Enable Shop Page Ordering', 'mist'),
                        'default' 	=> true,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
					array(
                        'id'		=> 'zozo_woo_social_sharing',
                        'type' 		=> 'switch',
                        'title' 	=> __('Show Woocommerce Social Sharing', 'mist'),
                        'default' 	=> true,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
                    ),
                )
            );
			
			// Miscellaneous Options
			$this->sections[] = array(
				'icon' 				=> 'el-icon-wrench',
                'icon_class' 		=> 'icon',
                'title' 			=> __('Miscellaneous', 'mist'),
                'fields' 			=> array(
					array(
                        'id'		=> 'zozo_enable_ultimate_icomoon1',
                        'type' 		=> 'switch',
                        'title' 	=> __('Enable Icomoon Pack 1 for Ultimate Addon', 'mist'),
                        'default' 	=> false,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
						'subtitle' 	=> __('Enable this setting to use icomoon pack 1 icons for Ultimate Addon.', 'mist'),
                    ),
					array(
                        'id'		=> 'zozo_enable_ultimate_icomoon2',
                        'type' 		=> 'switch',
                        'title' 	=> __('Enable Icomoon Pack 2 for Ultimate Addon', 'mist'),
                        'default' 	=> false,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
						'subtitle' 	=> __('Enable this setting to use icomoon pack 2 icons for Ultimate Addon.', 'mist'),
                    ),
					array(
                        'id'		=> 'zozo_enable_ultimate_icomoon3',
                        'type' 		=> 'switch',
                        'title' 	=> __('Enable Icomoon Pack 3 for Ultimate Addon', 'mist'),
                        'default' 	=> false,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
						'subtitle' 	=> __('Enable this setting to use icomoon pack 3 icons for Ultimate Addon.', 'mist'),
                    ),
					array(
                        'id'		=> 'zozo_remove_scripts_version',
                        'type' 		=> 'switch',
                        'title' 	=> __('Remove Version Parameter From JS & CSS Files', 'mist'),
                        'default' 	=> true,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
						'subtitle' 	=> __('Most scripts and style-sheets includes query string to identifying the version. This can cause issues with caching and such, which will result in less than optimal load times. You can enable this setting on to remove the query string from such strings.', 'mist'),
                    ),
					array(
                        'id'		=> 'zozo_minify_css',
                        'type' 		=> 'switch',
                        'title' 	=> __('Minify CSS', 'mist'),
                        'default' 	=> true,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
						'subtitle' 	=> __('This theme makes use of a lot of css styles, use this function to load a single minified file with all the required styles. Disable for testing purposes.', 'mist'),
                    ),
					array(
                        'id'		=> 'zozo_minify_js',
                        'type' 		=> 'switch',
                        'title' 	=> __('Minify JS', 'mist'),
                        'default' 	=> true,
                        'on' 		=> __('Yes', 'mist'),
                        'off' 		=> __('No', 'mist'),
						'subtitle' 	=> __('This theme makes use of a lot of js scripts, use this function to load a single minified file with all the required code. Disable for testing purposes.', 'mist'),
                    ),
                )
            );
			
        }

        public function setHelpTabs() {

        }

        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                'opt_name'          	=> 'zozo_options',
                'display_name'      	=> $theme->get('Name') . ' ' . __('Options', 'mist'),
                'display_version'   	=> $theme->get('Version'),
                'menu_type'         	=> 'menu',
                'allow_sub_menu'    	=> true,
                'menu_title'        	=> __('Theme Options', 'mist'),
                'page_title'        	=> __('Theme Options', 'mist'),
                'footer_credit'     	=> __('Theme Options', 'mist'),

                'google_api_key' 			=> 'AIzaSyAsd03TE8ZfcIrp1Lsr-GDGOk6284M4itY',
				'google_update_weekly' 		=> true,
                'disable_google_fonts_link' => false,

                'async_typography'  		=> false,
                'admin_bar'         		=> true,
                'admin_bar_icon'       		=> 'dashicons-admin-generic',
                'admin_bar_priority'   		=> 50,
                'global_variable'   		=> '',
                'dev_mode'          		=> false,
				'forced_dev_mode_off' 		=> true,
                'customizer'        		=> true,

                'page_priority'     		=> 62,
                'page_parent'       		=> 'themes.php',
                'page_permissions'  		=> 'manage_options',
                'menu_icon'         		=> '',
                'last_tab'          		=> '',
                'page_icon'         		=> 'icon-themes',
                'page_slug'         		=> 'zozo_options',
                'save_defaults'     		=> true,
                'default_show'      		=> false,
                'default_mark'      		=> '',
                'show_import_export' 		=> true,
				'show_options_object'       => false,

                'transient_time'    		=> 60 * MINUTE_IN_SECONDS,
                'output'            		=> true,
                'output_tag'        		=> true,

                'database'              	=> '',
                'system_info'           	=> false,

                'hints' 					=> array(
												'icon'          => 'el el-question-sign',
												'icon_position' => 'right',
												'icon_color'    => 'lightgray',
												'icon_size'     => 'normal',
												'tip_style'     => array(
													'color'         => 'light',
													'shadow'        => true,
													'rounded'       => false,
													'style'         => '',
												),
												'tip_position'  => array(
													'my' => 'top left',
													'at' => 'bottom right',
												),
												'tip_effect'    => array(
													'show'          => array(
														'effect'        => 'slide',
														'duration'      => '500',
														'event'         => 'mouseover',
													),
													'hide'      => array(
														'effect'    => 'slide',
														'duration'  => '500',
														'event'     => 'click mouseleave',
													),
												),
											),
				'ajax_save'                 => false,
            );


            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
			
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace('-', '_', $this->args['opt_name']);
                }
				
                $this->args['intro_text'] = sprintf('<p>'.__('Did you know that Mist Theme sets a global variable for you? To access any of your saved options from within your code you can use your global variable: ', 'mist').'<strong>$%1$s</strong></p>', $v);
				
            } else {
                $this->args['intro_text'] = '<p>'.__('This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.', 'mist').'</p>';
            }
        }

    }

    global $reduxZozoOptions;
    $reduxZozoOptions = new Redux_Framework_zozo_options();
}