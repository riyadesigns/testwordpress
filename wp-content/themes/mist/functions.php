<?php
/**
 * Zozothemes functions and definitions
 *
 * @package Zozothemes
 */

// Set path to theme specific functions
$library_path = get_template_directory() . '/lib/';
$includes_path = get_template_directory() . '/includes/';
$admin_path = get_template_directory() . '/framework/admin/';

// Define path to theme specific functions
define( 'ZOZOLIBRARY', $library_path );
define( 'ZOZOINCLUDES', $includes_path );
define( 'ZOZO_FRAMEWORK_PATH', get_template_directory() . '/framework' );
define( 'ZOZOADMIN', $admin_path );
define( 'ZOZO_ADMIN_ASSETS', get_template_directory_uri() . '/framework/admin/assets/' );
define( 'ZOZO_ADMIN_ASSETS_DIR', get_template_directory() . '/framework/admin/assets/' );
define( 'ZOZOTHEME_URL', get_template_directory_uri() );
define( 'ZOZOTHEME_DIR', get_template_directory() );
define( 'ZOZOTHEME_COLOR_SCHEMES', get_template_directory() . '/color-schemes/' );
define( 'ZOZO_VC_ACTIVE', class_exists( 'Vc_Manager' ) );
define( 'ZOZO_WOOCOMMERCE_ACTIVE', class_exists( 'WooCommerce' ) );
define( 'ZOZO_REVSLIDER_ACTIVE', class_exists( 'RevSlider' ) );
define( 'ZOZO_EPL_ACTIVE', class_exists( 'Easy_Property_Listings' ) );
define( 'ZOZO_BBPRESS_ACTIVE', class_exists( 'bbPress' ) );
define( 'ZOZO_BUDDYPRESS_ACTIVE', class_exists( 'BuddyPress' ) );

function zozo_check_registered_post_types() {
    // types will be a list of the post type names
    $types = get_post_types( array('_builtin' => false) );
	
	if( in_array( 'zozo_portfolio', $types ) ) {
		define( 'ZOZO_PORTFOLIO_ACTIVE', true );
	} else {
		define( 'ZOZO_PORTFOLIO_ACTIVE', false );
	}
	
	if( in_array( 'zozo_testimonial', $types ) ) {
		define( 'ZOZO_TESTIMONIAL_ACTIVE', true );
	} else {
		define( 'ZOZO_TESTIMONIAL_ACTIVE', false );
	}
	
	if( in_array( 'zozo_team_member', $types ) ) {
		define( 'ZOZO_TEAM_ACTIVE', true );
	} else {
		define( 'ZOZO_TEAM_ACTIVE', false );
	}
	
} 

add_action( 'init', 'zozo_check_registered_post_types' );
 
//Theme Config
if( class_exists( 'Redux' ) ){
	require ZOZOADMIN . 'theme-config/config.php';
}

/**
 * Welcome Admin Page
 */
require ZOZOADMIN . 'theme-admin/index.php';

/**
 * Register Sidebar
 */
require ZOZOINCLUDES . 'sidebar-register.php';

/**
 * Theme Actions and Filters
 */
require ZOZOINCLUDES . 'theme-filters.php';

/**
 * Theme Functions
 */
require ZOZOINCLUDES . 'theme-functions.php';

/**
 * Admin Custom Meta Boxes
 */
require ZOZOINCLUDES . 'metaboxes.php';

/**
 * Admin Custom Meta Box Fields
 */
require ZOZOINCLUDES . 'register-metabox-types.php';

/**
 * Bootstrap Library Files
 */
require ZOZOLIBRARY . 'wp_bootstrap_navwalker.php';
require ZOZOLIBRARY . 'wp_bootstrap_mobile_navwalker.php';

/**
 * Sidebar Generator
 */
require ZOZOINCLUDES . 'plugins/sidebar-generator/sidebar_generator.php';

/**
 * Woocommerce Config
 */
if( class_exists('Woocommerce') ) {
	include_once( ZOZOINCLUDES . 'woo-functions.php' );
}

/**
 * Mega Menu Framework
 */
require ZOZOINCLUDES . 'class-megamenu-framework.php';

/**
 * Breadcrumbs
 */
require ZOZOINCLUDES . 'class-breadcrumbs.php';

/**
 * TGM Plugin Activation
 */
require_once ZOZO_FRAMEWORK_PATH . '/plugins-activation/init.php';

/**
 * Ratings Plugin
 */
require_once ZOZOINCLUDES . 'class-zozo-item-ratings.php';

zozo_item_ratings_init();
function zozo_item_ratings_init() {
	
	//Init vars
	$config_options = array();
								
	//Set post types option
	$_post_types = array();
	$_post_types = array('zozo_testimonial', 'zozo_portfolio');
	
	$_min_level = 0;
	$_max_level = 5;
	
	$config_options[] = array(
		'meta_key'			=>	'zozo_author_rating',
		'name'				=>	'Rating',
		'disable_on_update'	=>	FALSE,
		'max_rating_size'	=> 	(int) $_max_level,
		'min_rating_size'	=> 	(int) $_min_level,
		'active_post_types'	=>	$_post_types
	);
	
	//Instatiate plugin class and pass config options array
	new ZozoItemRatings( $config_options );
}

/**
 * Visual Composer
 */
include ZOZOINCLUDES . 'visual-composer/visual-composer.php';

/* Demo Import AJAX */
if( ! function_exists('mist_demo_content_importer') ) {
    function mist_demo_content_importer() {
		
		if( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'mist_demo_import_@#$%^&*(' ) ) {
			echo "!security issue";
			wp_die(); 
		}
		
		include ZOZOINCLUDES . 'plugins/importer/zozo-importer.php';
		
		echo "imported";
		
		wp_die();
		
    }
    add_action('wp_ajax_zozo_import_demo_data', 'mist_demo_content_importer');
}

/**
 * EPL Custom Functions
 */
if( class_exists('Easy_Property_Listings') ) {
	include_once( ZOZOTHEME_DIR . '/easypropertylistings/epl-custom-functions.php' );
}

/*Theme Option Default Values*/
if( !class_exists( 'Redux' ) ){
	get_template_part( 'includes/theme', 'default' );
}

/* Custom Notice */
if( is_admin() ){
	function mist_theme_option_save_notice() {
		?>
		<div class="notice notice-warning is-dismissible">
			<p><?php _e( 'Did you know? After theme option save, make hard refresh to get better result!', 'mist' ); ?></p>
		</div>
		<?php
	}
	if( isset( $_GET['page'] ) && $_GET['page'] == 'zozo_options' && isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] == true ){
		add_action( 'admin_notices', 'mist_theme_option_save_notice', 10 );
	}
}