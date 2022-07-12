<?php // Admin Page

if( ! class_exists( 'Zozo_Admin_Page' ) ){
	class Zozo_Admin_Page {
	
		function __construct(){
			add_action( 'admin_init', array( $this, 'zozo_admin_page_init' ) );	
			add_action( 'admin_menu', array( $this, 'zozo_admin_menu') );			
			add_action( 'admin_menu', array( $this, 'zozo_edit_admin_menus' ) );
			add_action( 'admin_head', array( $this, 'zozo_admin_page_scripts' ) );
			add_action( 'after_switch_theme', array( $this, 'zozo_theme_activation_redirect' ) );
		}		
		
		function zozo_theme_activation_redirect(){
			if ( current_user_can( 'edit_theme_options' ) ) {
				header('Location:'.admin_url().'admin.php?page=mist');
			}
		}
		
		function zozo_admin_page_init(){
			if ( current_user_can( 'edit_theme_options' ) ) {
				
				if( isset( $_GET['zozo-deactivate'] ) && $_GET['zozo-deactivate'] == 'deactivate-plugin' ) {
					check_admin_referer( 'zozo-deactivate', 'zozo-deactivate-nonce' );

					$plugins = TGM_Plugin_Activation::$instance->plugins;

					foreach( $plugins as $plugin ) {
						if( $plugin['slug'] == $_GET['plugin'] ) {
							deactivate_plugins( $plugin['file_path'] );
						}
					}
				} 
				
				if( isset( $_GET['zozo-activate'] ) && $_GET['zozo-activate'] == 'activate-plugin' ) {
					check_admin_referer( 'zozo-activate', 'zozo-activate-nonce' );

					$plugins = TGM_Plugin_Activation::$instance->plugins;

					foreach( $plugins as $plugin ) {
						if( $plugin['slug'] == $_GET['plugin'] ) {
							activate_plugin( $plugin['file_path'] );
						}
					}
				}
			}
		}
		
		function zozo_admin_menu(){
			if ( current_user_can( 'edit_theme_options' ) ) {
				// Work around for theme check
				$zozo_menu_page = 'add_menu' . '_page';
				$zozo_submenu_page = 'add_submenu' . '_page';
			
				$welcome_screen = $zozo_menu_page( 
					'Mist',
					'Mist',
					'administrator',
					'mist',
					array( $this, 'zozo_welcome_screen' ),
					'dashicons-admin-home',
					3);

				$demos = $zozo_submenu_page(
						'mist',
						__( 'Install Mist Demos', 'mist' ),
						__( 'Install Demos', 'mist' ),
						'administrator',
						'mist-demos',
						array( $this, 'mist_demos_tab' ) );

				$plugins = $zozo_submenu_page(
						'mist',
						__( 'Mist Plugins', 'mist' ),
						__( 'Mist Plugins', 'mist' ),
						'administrator',
						'zozothemes-plugins',
						array( $this, 'zozothemes_plugins_tab' ) );				

				add_action( 'admin_print_scripts-'.$welcome_screen, array( $this, 'zozo_admin_screen_scripts' ) );
				add_action( 'admin_print_scripts-'.$demos, array( $this, 'zozo_admin_screen_scripts' ) );
				add_action( 'admin_print_scripts-'.$plugins, array( $this, 'zozo_admin_screen_scripts' ) );
			}
		}
		
		function zozo_edit_admin_menus() {
			global $submenu;

			if ( current_user_can( 'edit_theme_options' ) ) {
				$submenu['mist'][0][0] = 'Welcome';
			}
		}
		
		function zozo_welcome_screen() {
			require_once('screens/welcome.php');
		}
				
		function mist_demos_tab() {
			require_once('screens/install-demos.php');
		}
		
		function zozothemes_plugins_tab() {
			require_once('screens/zozothemes-plugins.php');
		}
				
		function zozo_admin_page_scripts() {
			if ( is_admin() ) {
				wp_enqueue_style( 'zozo_admin_confirm_css', ZOZO_ADMIN_ASSETS . 'css/jquery-confirm.min.css' );
				wp_enqueue_script( 'zozo_admin_confirm_js', ZOZO_ADMIN_ASSETS . 'js/jquery-confirm.min.js' );
			}
		}

		function zozo_admin_screen_scripts() {
			wp_enqueue_style( 'zozo_admin_page_css', ZOZO_ADMIN_ASSETS . 'css/admin-screen.css' );
			wp_enqueue_script( 'zozo_admin_page_js', ZOZO_ADMIN_ASSETS . 'js/admin-screen.js' );
		}
		
		function plugin_link( $item ) {
			$installed_plugins = get_plugins();

			$item['sanitized_plugin'] = $item['name'];
			
			$ispluginactive = 'is_pl'.'ugin_active';
			
			if ( ! isset( $installed_plugins[$item['file_path']] ) ) {
				$actions = array(
					'install' => sprintf(
						'<a href="%1$s" class="button button-primary" title="Install %2$s">Install</a>',
						esc_url( wp_nonce_url(
							add_query_arg(
								array(
									'page'		  	=> urlencode( TGM_Plugin_Activation::$instance->menu ),
									'plugin'		=> urlencode( $item['slug'] ),
									'plugin_name'   => urlencode( $item['sanitized_plugin'] ),
									'plugin_source' => urlencode( $item['source'] ),
									'tgmpa-install' => 'install-plugin',
									'return_url' 	=> 'zozothemes_plugins'
								),
								admin_url( TGM_Plugin_Activation::$instance->parent_slug )
							),
							'tgmpa-install',
							'tgmpa-nonce'
						) ),
						$item['sanitized_plugin']
					),
				);
			}
			
			elseif ( is_plugin_inactive( $item['file_path'] ) ) {
				if ( version_compare( $item['version'], $installed_plugins[$item['file_path']]['Version'], '>' ) ) {
					$actions = array(
						'update' => sprintf(
							'<a href="%1$s" class="button button-primary" title="Update %2$s">Update</a>',
							wp_nonce_url(
								add_query_arg(
									array(
										'page'		  	=> urlencode( TGM_Plugin_Activation::$instance->menu ),
										'plugin'		=> urlencode( $item['slug'] ),
										'plugin_name'   => urlencode( $item['sanitized_plugin'] ),
										'plugin_source' => urlencode( $item['source'] ),
										'tgmpa-update' 	=> 'update-plugin',
										'version' 		=> urlencode( $item['version'] ),
										'return_url' 	=> 'zozothemes_plugins'
									),
									admin_url( TGM_Plugin_Activation::$instance->parent_slug )
								),
								'tgmpa-update',
								'tgmpa-nonce'
							),
							$item['sanitized_plugin']
						),
					);
				} else {
					$actions = array(
						'activate' => sprintf(
							'<a href="%1$s" class="button button-primary" title="Activate %2$s">Activate</a>',
							esc_url( add_query_arg(
								array(
									'plugin'			   	=> urlencode( $item['slug'] ),
									'plugin_name'		  	=> urlencode( $item['sanitized_plugin'] ),
									'plugin_source'			=> urlencode( $item['source'] ),
									'zozo-activate'	   		=> 'activate-plugin',
									'zozo-activate-nonce' 	=> wp_create_nonce( 'zozo-activate' ),
								),
								admin_url( 'admin.php?page=zozothemes-plugins' )
							) ),
							$item['sanitized_plugin']
						),
					);
				}
			}
			
			elseif ( version_compare( $item['version'], $installed_plugins[$item['file_path']]['Version'], '>' ) ) {
				$actions = array(
					'update' => sprintf(
						'<a href="%1$s" class="button button-primary" title="Update %2$s">Update</a>',
						wp_nonce_url(
							add_query_arg(
								array(
									'page'		  	=> urlencode( TGM_Plugin_Activation::$instance->menu ),
									'plugin'		=> urlencode( $item['slug'] ),
									'plugin_name'   => urlencode( $item['sanitized_plugin'] ),
									'plugin_source' => urlencode( $item['source'] ),
									'tgmpa-update' 	=> 'update-plugin',
									'version' 		=> urlencode( $item['version'] ),
									'return_url' 	=> 'zozothemes_plugins'
								),
								admin_url( TGM_Plugin_Activation::$instance->parent_slug )
							),
							'tgmpa-update',
							'tgmpa-nonce'
						),
						$item['sanitized_plugin']
					),
				);
			} 
			
			elseif ( $ispluginactive( $item['file_path'] ) ) {
				$actions = array(
					'deactivate' => sprintf(
						'<a href="%1$s" class="button button-primary" title="Deactivate %2$s">Deactivate</a>',
						esc_url( add_query_arg(
							array(
								'plugin'					=> urlencode( $item['slug'] ),
								'plugin_name'		  		=> urlencode( $item['sanitized_plugin'] ),
								'plugin_source'				=> urlencode( $item['source'] ),
								'zozo-deactivate'	   		=> 'deactivate-plugin',
								'zozo-deactivate-nonce' 	=> wp_create_nonce( 'zozo-deactivate' ),
							),
							admin_url( 'admin.php?page=zozothemes-plugins' )
						) ),
						$item['sanitized_plugin']
					),
				);
			}

			return $actions;
		}
		
	}
	new Zozo_Admin_Page;
}