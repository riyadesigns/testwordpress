<?php
	global $zozo_options;
	$search_text = isset( $zozo_options['zozo_search_placeholder'] ) ? $zozo_options['zozo_search_placeholder'] : ''; 
?>
<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="search-form">
    <div class="input-group">
        <input type="text" value="" name="s" class="form-control" placeholder="<?php echo esc_attr( $search_text ); ?>" />
        <span class="input-group-btn">
            <button class="btn btn-search" type="submit"><?php esc_html_e('Go', 'mist'); ?></button>
        </span>
    </div>
</form>