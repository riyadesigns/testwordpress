<?php
$zozo_theme = wp_get_theme();
if($zozo_theme->parent_theme) {
    $template_dir =  basename( get_template_directory() );
    $zozo_theme = wp_get_theme($template_dir);
}
$zozo_theme_version = $zozo_theme->get( 'Version' );

$zozothemes_url = 'http://zozothemes.com/';
$zozo_url = 'http://zozothemes.com';

?>

<div class="wrap about-wrap welcome-wrap zozothemes-wrap">
	<div class="zozothemes-welcome-inner">
		<div class="welcome-wrap">
			<h1><?php echo __( "Welcome to <span>mist</span>", "mist" ); ?></h1>
			<div class="mist-logo"><span class="mist-version"><?php echo ''. $zozo_theme_version; ?></span></div>
			
			<div class="about-text"><?php echo __( "Nice! Mist is now installed and ready to use. Get ready to build your site with more powerful wordpress theme. We hope you enjoy using it.", "mist" ); ?></div>
		</div>
		<h2 class="zozo-nav-tab-wrapper nav-tab-wrapper">
			<?php
			printf( '<a href="#" class="nav-tab nav-tab-active">%s</a>', __( "Support", "mist" ) );
			printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=mist-demos' ), __( "Install Demos", "mist" ) );
			printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=zozothemes-plugins' ), __( "Mist Plugins", "mist" ) );
			?>
		</h2>
	</div>
	
	<div class="zozothemes-support-wrapper clearfix">		
    	<div class="features-section three-col">
        	<div class="feature-item col">
				<h4><span class="dashicons dashicons-admin-generic"></span><?php echo __( "Submit A Ticket", "mist" ); ?></h4>
				<p><?php echo __( "We would happy to help you solve any issues. If you have any questions, ideas or suggestions, please feel free to contact us.", "mist" ); ?></p>
                <?php printf( '<a href="%s" class="button button-large button-primary btn-lg-button" target="_blank">%s</a>', 'https://zozothemes.ticksy.com', __( "Submit A Ticket", "mist" ) ); ?>
            </div>
            <div class="feature-item col">
				<h4><span class="dashicons dashicons-book-alt"></span><?php echo __( "Documentation", "mist" ); ?></h4>
				<p><?php echo __( "Our online documentation helps you to learn how to setup and customize your needs with Mist. We will launch online documentation soon.", "mist" ); ?></p>
                <?php printf( '<a href="%s" class="button button-large button-primary btn-lg-button" target="_blank">%s</a>', $zozothemes_url . 'wp/mist/Documentation/', __( "Documentation", "mist" ) ); ?>
            </div>            
            
            <div class="feature-item col last-item">
				<h4><span class="dashicons dashicons-groups"></span><?php echo __( "Community Forum", "mist" ); ?></h4>
				<p><?php echo __( "We also have a community forum for user to user interactions. Ask another User!", "mist" ); ?></p>
				<?php printf( '<a href="%s" class="button button-large button-primary btn-lg-button" target="_blank">%s</a>', esc_url( $zozo_url ), esc_html__( "Community Forum", "mist" ) ); ?>
            </div>
        </div>
    </div>
	
    <div class="zozothemes-thanks">
        <hr />
    	<p class="description"><?php echo __( "Thank you for choosing Mist.", "mist" ); ?></p>
    </div>
</div>