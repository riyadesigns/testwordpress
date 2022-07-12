<?php global $post, $zozo_options; ?>

<div id="slidingbar-section" class="zozo-sliding-bar-wrapper sliding-bar-section">
	<div class="slidingbar-inner">
		<div class="container">
			<div class="row">
				<div class="sliding-bar-columns slidingbar-columns-<?php echo esc_attr( $zozo_options['zozo_sliding_bar_columns'] ); ?>">
					<?php 
					$column_width = 12 / $zozo_options['zozo_sliding_bar_columns']; 
									
					for ( $i = 1; $i < 5; $i++ ) {
						if ( $zozo_options['zozo_sliding_bar_columns'] >= $i ) {
							echo sprintf( '<div id="sliding-widget-%s" class="sliding-bar-widgets col-md-%s col-sm-6 col-xs-12">', $i, $column_width, $column_width );
								dynamic_sidebar( 'sliding-bar-' . esc_attr( $i ) );							
							echo '</div>';
						}
					}
					?>
				</div>
			</div>
		</div>
	</div>
	<div class="slidingbar-toggle-wrapper">
		<a href="#" class="slidingbar-nav"></a>
	</div>
</div>