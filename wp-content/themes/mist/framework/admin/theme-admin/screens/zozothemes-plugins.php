<?php
$zozo_theme = wp_get_theme();
if($zozo_theme->parent_theme) {
    $template_dir =  basename( get_template_directory() );
    $zozo_theme = wp_get_theme($template_dir);
}
$zozo_theme_version = $zozo_theme->get( 'Version' );

$plugins = TGM_Plugin_Activation::$instance->plugins;
$installed_plugins = get_plugins();
$active_action = '';
if( isset( $_GET['plugin_status'] ) ) {
	$active_action = $_GET['plugin_status'];
}
?>

<div class="wrap about-wrap welcome-wrap zozothemes-wrap">
	<div class="zozothemes-welcome-inner">
		<div class="welcome-wrap">
			<h1><?php echo __( "Welcome to <span>mist</span>", "mist" ); ?></h1>
			<div class="mist-logo"><span class="mist-version"><?php echo esc_attr( $zozo_theme_version ); ?></span></div>
			
			<div class="about-text"><?php echo __( "Nice! Mist is now installed and ready to use. Get ready to build your site with more powerful wordpress theme. We hope you enjoy using it.", "mist" ); ?></div>
		</div>
		<h2 class="zozo-nav-tab-wrapper nav-tab-wrapper">
			<?php
			printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=mist' ),  __( "Support", "mist" ) );
			printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=mist-demos' ), __( "Install Demos", "mist" ) );
			printf( '<a href="#" class="nav-tab nav-tab-active">%s</a>', __( "Mist Plugins", "mist" ) );
			?>
		</h2>
	</div>
		
	<div class="zozothemes-required-notices">
		<p class="notice-description">These are the plugins we recommended for Mist. Currently Zozothemes Core, Visual Composer and Ultimate VC Addons are required plugins that is needed to use in Mist. You can activate, deactivate or update the plugins from this tab.</p>
	</div>
	
	<div class="zozothemes-plugin-action-notices">
		<?php $plugin_deactivated = '';
		if( isset( $_GET['zozo-deactivate'] ) && $_GET['zozo-deactivate'] == 'deactivate-plugin' ) {
			$plugin_deactivated = $_GET['plugin_name']; ?>		
			<p class="plugin-action-notices deactivate"><?php echo esc_attr( $plugin_deactivated ); ?> plugin <strong>deactivated.</strong></p>
		<?php } ?>
		<?php $plugin_activated = '';
		if( isset( $_GET['zozo-activate'] ) && $_GET['zozo-activate'] == 'activate-plugin' ) {
			$plugin_activated = $_GET['plugin_name']; ?>		
			<p class="plugin-action-notices activate"><?php echo esc_attr( $plugin_activated ); ?> plugin <strong>activated.</strong></p>
		<?php } ?>
	</div>
	
	<div class="zozothemes-demo-wrapper zozothemes-install-plugins">
		<div class="feature-section theme-browser rendered">
			<?php
			$ispluginactive = 'is_pl'.'ugin_active';
			foreach( $plugins as $plugin ):
				$class = '';
				$plugin_status = '';
				$active_action_class = '';
				$file_path = $plugin['file_path'];
				$plugin_action = $this->plugin_link( $plugin );
				foreach( $plugin_action as $action => $value ) {
					if( $active_action == $action ) {
						$active_action_class = ' plugin-' .$active_action. '';
					}
				}
				
				if( $ispluginactive( $file_path ) ) {
					$plugin_status = 'active';
					$class = 'active';
				}
			?>			
			<div class="theme <?php echo esc_attr( $class . $active_action_class ); ?>">
				<div class="install-plugin-inner">
					<div class="theme-screenshot">
						<img src="<?php echo esc_url( $plugin['image_url'] ); ?>" alt="<?php echo esc_attr( $plugin['name'] ); ?>" />
					</div>
					<h3 class="theme-name">
						<?php
						if( $plugin_status == 'active' ) {
							echo sprintf( '<span>%s</span> ', __( 'Active:', 'mist' ) );
						}
						echo esc_html( $plugin['name'] );
						?>
					</h3>
					<div class="theme-actions">
						<?php foreach( $plugin_action as $action ) { echo ''. $action; } ?>
					</div>
					<?php if( isset( $plugin_action['update'] ) && $plugin_action['update'] ): ?>
					<div class="theme-update">Update Available: Version <?php echo esc_attr( $plugin['version'] ); ?></div>
					<?php endif; ?>
	
					<?php if( isset( $installed_plugins[$plugin['file_path']] ) ): ?> 
					<div class="plugin-info">
						<?php echo sprintf('Version %s | %s', $installed_plugins[$plugin['file_path']]['Version'], $installed_plugins[$plugin['file_path']]['Author'] ); ?>
					</div>
					<?php endif; ?>
					<?php if( $plugin['required'] ): ?>
					<div class="plugin-required">
						<?php _e( 'Required', 'mist' ); ?>
					</div>
					<?php endif; ?>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
	
	<div class="zozothemes-thanks">
        <hr />
    	<p class="description"><?php echo __( "Thank you for choosing Mist. We are honored and are fully dedicated to making your experience perfect.", "mist" ); ?></p>
    </div>
</div>