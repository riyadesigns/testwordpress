<?php 
/**
 * Template Name: Maintenance Template
 *
 * The Maintenance page template to display under construction or coming soon pages
 *
 * @package Zozothemes 
 */

global $zozo_options;
get_header('alt'); ?>

<div id="zozo-maintenance" class="main-fullwidth main-col-full">
	<?php if ( have_posts() ): 
		while ( have_posts() ): the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile;
	endif; ?>
</div><!-- #zozo-maintenance -->

<?php get_footer('alt'); ?>