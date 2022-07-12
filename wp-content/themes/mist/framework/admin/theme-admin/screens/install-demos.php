<?php
$zozo_theme = wp_get_theme();
if($zozo_theme->parent_theme) {
    $template_dir =  basename( get_template_directory() );
    $zozo_theme = wp_get_theme($template_dir);
}
$zozo_theme_version = $zozo_theme->get( 'Version' );

$zozothemes_url = 'http://zozothemes.com/';
?>
<div class="wrap about-wrap welcome-wrap zozothemes-wrap">
	<div class="zozothemes-welcome-inner">
		<div class="welcome-wrap">
			<h1><?php echo __( "Welcome to <span>mist</span>", "mist" ); ?>
			<p class="mist-logo"><span class="mist-version"><?php echo ''. $zozo_theme_version; ?></span></p></h1>
			<div class="updated error zozo-importer-notice importer-notice-error">
				<p><strong><?php echo __( "We're sorry but the demo data could not import. It is most likely due to low PHP configurations on your server. Please do necessary configurations noticed in Warning message of imported demo.", 'mist' ); ?></strong></p>
			</div>
			
			<div class="updated zozo-importer-notice importer-notice-success"><p><strong><?php echo __( "Demo data successfully imported.", "mist" ); ?></strong></p></div>
			
			<div class="about-text"><?php echo __( "Nice! Mist is now installed and ready to use. Get ready to build your site with more powerful wordpress theme. We hope you enjoy using it.", "mist" ); ?></div>
		</div>
		<h2 class="zozo-nav-tab-wrapper nav-tab-wrapper">
			<?php
			printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=mist' ),  __( "Support", "mist" ) );
			printf( '<a href="#" class="nav-tab nav-tab-active">%s</a>', __( "Install Demos", "mist" ) );
			printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=zozothemes-plugins' ), __( "Mist Plugins", "mist" ) );
			?>
		</h2>
	</div>
		
	 <div class="zozothemes-required-notices">
		<p class="notice-description"><?php echo __( "Installing a demo provides pages, posts, images, theme options, widgets and more. IMPORTANT: The required plugins need to be installed and activated before you install a demo.", "mist" ); ?></p>
	</div>
	
	<div class="zozothemes-demo-title">
	<h3 class="one-page">Multi Page Demo</h3>
	</div>
	
	<div class="zozothemes-demo-wrapper">
		<div class="features-section theme-demos theme-browser rendered">
		
			<?php wp_nonce_field( 'mist_demo_import_@#$%^&*(', 'mist_demo_import_nonce' ); ?>
		
			<!-- Demo Multi Page - Agency New -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-demo-new"><?php echo esc_html__( "New", "mist" ); ?></div>
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/multi-agency-new.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-agency-new"><?php echo esc_html__( "Multi Page - Agency", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-multi-agency-new" data-demo-woo="no" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/agency-new/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-agency-new"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo Multi Page - Pet Shop -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-demo-new"><?php echo esc_html__( "New", "mist" ); ?></div>
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/multi-pet.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-pet"><?php echo esc_html__( "Multi Page - Pet Shop", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-multi-pet" data-demo-woo="yes" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/pet4u/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li><li>Woocommerce Plugin must be activated for the shop data to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-multi-pet"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo Multi Page - Shop New -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/multi-shop2.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-shop2"><?php echo esc_html__( "Multi Page - Shop New", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-multi-shop2" data-demo-woo="yes" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/demo-shop/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li><li>Woocommerce Plugin must be activated for the shop data to import.</li><li>YITH WooCommerce Popup Plugin must be activated for the popup data to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-multi-shop2"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo Multi Page - Medical -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/multi-medical.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-medical"><?php echo esc_html__( "Multi Page - Medical", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-multi-medical" data-demo-woo="no" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/medical/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Contact Form 7 Plugin must be activated for the forms to import.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-multi-medical"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo Multi Page - Salon -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/multi-salon.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-salon"><?php echo esc_html__( "Multi Page - Salon", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-multi-salon" data-demo-woo="yes" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/salon/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li><li>Woocommerce Plugin must be activated for the shop data to import.</li><li>Contact Form 7 Plugin must be activated for the forms to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-multi-salon"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo Multi Page - Law -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/multi-law.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-law"><?php echo esc_html__( "Multi Page - Law", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-multi-law" data-demo-woo="no" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/law/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li><li>WP Store Locator Plugin must be activated for the store data to import.</li><li>Contact Form 7 Plugin must be activated for the forms to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-multi-law"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo Multi Page - Sports -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/multi-sports.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-sports"><?php echo esc_html__( "Multi Page - Sports", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-multi-sports" data-demo-woo="yes" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/sports/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li><li>SportsPress Plugin must be activated for the sports data to import.</li><li>Woocommerce Plugin must be activated for the shop data to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-multi-sports"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo Multi Page - Architect -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/multi-architect.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-architect"><?php echo esc_html__( "Multi Page - Architect", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-multi-architect" data-demo-woo="yes" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/architect/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li><li>Woocommerce Plugin must be activated for the shop data to import.</li><li>Contact Form 7 Plugin must be activated for the forms to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-multi-architect"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo Multi Page - Bakery -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/multi-bakery.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-bakery"><?php echo esc_html__( "Multi Page - Bakery", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-multi-bakery" data-demo-woo="yes" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/bakery/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li><li>Woocommerce Plugin must be activated for the shop data to import.</li><li>WP Store Locator Plugin must be activated for the store data to import.</li><li>Contact Form 7 Plugin must be activated for the forms to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-multi-bakery"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo Multi Page - Car -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/multi-carservice.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-carservice"><?php echo esc_html__( "Multi Page - Car Service", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-multi-carservice" data-demo-woo="yes" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/car/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li><li>Woocommerce Plugin must be activated for the shop data to import.</li><li>Contact Form 7 Plugin must be activated for the forms to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-multi-carservice"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo Multi Page - Real Estate -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/multi-realestate.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-realestate"><?php echo esc_html__( "Multi Page - Real Estate", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-multi-realestate" data-demo-woo="no" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/realestate/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li><li>Easy Property Listings Plugin must be activated and must <strong>configure listing types in 'Settings'</strong> for property data to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-multi-realestate"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo Multi Page - Classic -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/multi-classic.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-classic"><?php echo esc_html__( "Multi Page - Classic", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-multi-classic" data-demo-woo="yes" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/classic/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li><li>Woocommerce Plugin must be activated for the shop data to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-multi-classic"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo Multi Page - Creative -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/multi-creative.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-creative"><?php echo esc_html__( "Multi Page - Creative", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-multi-creative" data-demo-woo="no" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/creative/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-multi-creative"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo Multi Page - Creative 2 -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/multi-creative2.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-creative2"><?php echo esc_html__( "Multi Page - Creative 2", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-multi-creative2" data-demo-woo="no" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/creative-2/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-multi-creative2"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo Multi Page - Corporate -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/multi-corporate.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-corporate"><?php echo esc_html__( "Multi Page - Corporate", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-multi-corporate" data-demo-woo="no" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/corporate/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-multi-corporate"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo Multi Page - Adventure -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/multi-adventure.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-adventure"><?php echo esc_html__( "Multi Page - Adventure", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-multi-adventure" data-demo-woo="no" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/adventure/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-multi-adventure"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo Multi Page - Agency -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/multi-agency.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-agency"><?php echo esc_html__( "Multi Page - Agency", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-multi-agency" data-demo-woo="no" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/agency/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-multi-agency"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo Multi Page - Business -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/multi-business.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-business"><?php echo esc_html__( "Multi Page - Business", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-multi-business" data-demo-woo="no" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/business/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-multi-business"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo Multi Page - Consultant -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/multi-consultant.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-consultant"><?php echo esc_html__( "Multi Page - Consultant", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-multi-consultant" data-demo-woo="no" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/consultant/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-multi-consultant"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
						
			<!-- Demo Multi Page - Hosting -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/multi-hosting.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-hosting"><?php echo esc_html__( "Multi Page - Hosting", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-multi-hosting" data-demo-woo="no" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/hosting/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-multi-hosting"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo Multi Page - App -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/multi-app.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-app"><?php echo esc_html__( "Multi Page - App", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-multi-app" data-demo-woo="no" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/app/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-multi-app"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo Multi Page - University -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/multi-university.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-university"><?php echo esc_html__( "Multi Page - University", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-multi-university" data-demo-woo="no" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/university/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li><li>Easy Digital Downloads Plugin must be activated for the download products data to import.</li><li>The Events Calendar Plugin must be activated for the events data to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-multi-university"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>			
			
			<!-- Demo Multi Page - Charity -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/multi-charity.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-charity"><?php echo esc_html__( "Multi Page - Charity", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-multi-charity" data-demo-woo="no" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/charity/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li><li>The Events Calendar Plugin must be activated for the events data to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-multi-charity"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo Multi Page - Restaurant -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/multi-restaurant.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-restaurant"><?php echo esc_html__( "Multi Page - Restaurant", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-multi-restaurant" data-demo-woo="no" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/restaurant/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li><li>Contact Form 7 Plugin must be activated for the forms to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-multi-restaurant"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo Multi Page - Spa -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/multi-spa.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-spa"><?php echo esc_html__( "Multi Page - Spa", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-multi-spa" data-demo-woo="no" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/spa/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-multi-spa"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo Multi Page - Fashion -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/multi-fashion.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-fashion"><?php echo esc_html__( "Multi Page - Fashion", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-multi-fashion" data-demo-woo="yes" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/fashion/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li><li>Woocommerce Plugin must be activated for the shop data to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-multi-fashion"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo Multi Page - Wedding -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/multi-wedding.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-wedding"><?php echo esc_html__( "Multi Page - Wedding", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-multi-wedding" data-demo-woo="no" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/wedding/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li><li>Contact Form 7 Plugin must be activated for the forms to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-multi-wedding"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo Multi Page - Travel -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/multi-travel.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-travel"><?php echo esc_html__( "Multi Page - Travel", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-multi-travel" data-demo-woo="no" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/travel/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-multi-travel"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo Multi Page - Band -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/multi-band.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-band"><?php echo esc_html__( "Multi Page - Band", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-multi-band" data-demo-woo="no" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/band/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li><li>The Events Calendar Plugin must be activated for the events data to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-multi-band"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo Multi Page - Studio -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/multi-studio.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-studio"><?php echo esc_html__( "Multi Page - Studio", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-multi-studio" data-demo-woo="no" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/studio/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-multi-studio"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo Multi Page - Insurance -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/multi-insurance.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-insurance"><?php echo esc_html__( "Multi Page - Insurance", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-multi-insurance" data-demo-woo="no" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/insurance/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li><li>Contact Form 7 Plugin must be activated for the forms to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-multi-insurance"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo Multi Page - Freelancer -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/multi-freelancer.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-freelancer"><?php echo esc_html__( "Multi Page - Freelancer", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-multi-freelancer" data-demo-woo="no" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/freelancer/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-multi-freelancer"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo Multi Page - Simple -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/multi-simple.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-simple"><?php echo esc_html__( "Multi Page - Simple", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-multi-simple" data-demo-woo="no" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/home-simple/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-multi-simple"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo Multi Page - Flat -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/multi-flat.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-flat"><?php echo esc_html__( "Multi Page - Flat", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-multi-flat" data-demo-woo="no" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/multi-color/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-multi-flat"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo Multi Page - Nonprofit -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/multi-nonprofit.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-nonprofit"><?php echo esc_html__( "Multi Page - Nonprofit", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-multi-nonprofit" data-demo-woo="no" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/nonprofit/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-multi-nonprofit"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo Multi Page - Shop -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/multi-shop.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-shop"><?php echo esc_html__( "Multi Page - Shop", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-multi-shop" data-demo-woo="yes" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/home-shop/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li><li>Woocommerce Plugin must be activated for the shop data to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-multi-shop"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo Multi Page - Creative Blog -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/multi-blog.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-blog"><?php echo esc_html__( "Multi Page - Blog", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-multi-blog" data-demo-woo="no" data-demo-revslider="no" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/home-blog/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-multi-blog"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo Multi Page - Magazine -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/multi-magazine.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-magazine"><?php echo esc_html__( "Multi Page - Magazine", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-multi-magazine" data-demo-woo="no" data-demo-revslider="no" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/magazine/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-multi-magazine"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo Multi Page - Game -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/multi-game.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-game"><?php echo esc_html__( "Multi Page - Game", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-multi-game" data-demo-woo="no" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/game/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-multi-game"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo Multi Page - Flowershop -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/multi-flowershop.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-flowershop"><?php echo esc_html__( "Multi Page - Flowershop", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-multi-flowershop" data-demo-woo="yes" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/flowershop/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li><li>Woocommerce Plugin must be activated for the shop data to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-multi-flowershop"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo Multi Page - Taxation -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/multi-taxation.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-taxation"><?php echo esc_html__( "Multi Page - Taxation", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-multi-taxation" data-demo-woo="no" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/taxation/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-multi-taxation"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="zozothemes-demo-title">
	<h3 class="one-page">One Page Demos</h3>
	</div>
	<div class="zozothemes-demo-wrapper">
		<div class="features-section theme-demos theme-browser rendered">
			<!-- Demo One Page - Creative -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/one-creative.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-creative"><?php echo esc_html__( "One Page - Creative", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-one-creative" data-demo-woo="no" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/one-page/creative/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-one-creative"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo One Page - App -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/one-app.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-app"><?php echo esc_html__( "One Page - App", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-one-app" data-demo-woo="no" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/one-page/app/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-one-app"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo One Page - Events -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/one-events.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-events"><?php echo esc_html__( "One Page - Events", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-one-events" data-demo-woo="no" data-demo-revslider="no" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/one-page/home-events/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>The Events Calendar Plugin must be activated for the events data to import.</li><li>Contact Form 7 Plugin must be activated for the forms to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-one-events"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo One Page - Law -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/one-law.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-law"><?php echo esc_html__( "One Page - Law", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-one-law" data-demo-woo="no" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/one-page/law/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li><li>Contact Form 7 Plugin must be activated for the forms to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-one-law"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo One Page - Book -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/one-book.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-book"><?php echo esc_html__( "One Page - Book", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-one-book" data-demo-woo="no" data-demo-revslider="no" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/one-page/book/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Contact Form 7 Plugin must be activated for the forms to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-one-book"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo One Page - Gym -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/one-gym.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-gym"><?php echo esc_html__( "One Page - Gym", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-one-gym" data-demo-woo="no" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/one-page/gym/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-one-gym"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo One Page - Charity -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/one-charity.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-charity"><?php echo esc_html__( "One Page - Charity", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-one-charity" data-demo-woo="no" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/one-page/charity/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li><li>The Events Calendar Plugin must be activated for the events data to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-one-charity"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo One Page - Bakery -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/one-bakery.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-bakery"><?php echo esc_html__( "One Page - Bakery", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-one-bakery" data-demo-woo="yes" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/one-page/bakery/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Woocommerce Plugin must be activated for the shop data to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-one-bakery"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo One Page - Wedding -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/one-wedding.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-wedding"><?php echo esc_html__( "One Page - Wedding", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-one-wedding" data-demo-woo="no" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/one-page/wedding/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li><li>Contact Form 7 Plugin must be activated for the forms to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-one-wedding"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo One Page - Spa -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/one-spa.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-spa"><?php echo esc_html__( "One Page - Spa", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-one-spa" data-demo-woo="no" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/one-page/spa/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-one-spa"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo One Page - Multi Color -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/one-flat.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-flat"><?php echo esc_html__( "One Page - Flat", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-one-flat" data-demo-woo="no" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/one-page/multi-color/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-one-flat"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo One Page - Web Services -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/one-webservices.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-webservices"><?php echo esc_html__( "One Page - Web Services", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-one-webservices" data-demo-woo="no" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/one-page/web-services/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-one-webservices"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
			
			<!-- Demo One Page - Promotions -->
			<div class="theme zozothemes-demo-item">
				<div class="demo-inner">
					<div class="theme-screenshot zozotheme-screenshot">
						<img src="<?php echo ZOZO_ADMIN_ASSETS . 'images/demo/one-promotions.jpg'; ?>" />
					</div>
					<h3 class="theme-name" id="demo-promotions"><?php echo esc_html__( "One Page - Promotions", "mist" ); ?></h3>
					<div class="theme-actions theme-buttons">
						<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="demo-one-promotions" data-demo-woo="no" data-demo-revslider="yes" href="#">%1s</a>', esc_html__( "Install", "mist" ) ); ?>
						<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', 'http://themes.zozothemes.com/mist/one-page/promotion/', esc_html__( "Preview", "mist" ) ); ?>
					</div>
					<div class="theme-requirements" data-requirements="<h2>WARNING:</h2>Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.<h3>DEMO REQUIREMENTS:</h3><ol><li>Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.</li><li>Revolution Slider Plugin must be activated for the sliders data to import.</li></ol>">
					</div>
					<div class="zozo-demo-import-loader zozo-preview-demo-one-promotions"><i class="dashicons dashicons-admin-generic"></i></div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="zozothemes-thanks">
        <hr />
    	<p class="description"><?php echo esc_html__( "Thank you for choosing Mist.", "mist" ); ?></p>
    </div>
</div>