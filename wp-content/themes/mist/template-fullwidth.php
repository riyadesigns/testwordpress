<?php 
/**
 * Template Name: Fullwidth Template
 *
 * The fullwidth page template to display fullwidth section
 *
 * @package Zozothemes 
 */

global $zozo_options;
get_header(); ?>

<div id="fullwidth" class="main-fullwidth main-col-full">
	<?php if ( have_posts() ): 
		while ( have_posts() ): the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile;
	endif; ?>
</div><!-- #fullwidth -->

<?php get_footer(); ?>