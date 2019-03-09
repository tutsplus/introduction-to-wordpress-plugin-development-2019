<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.

/* get the header template */
get_header();
	
	/* start the post loop */
	while( have_posts() ) : the_post();
	
		/* Run the standard loop to output the posts.
		 * If you want to override this in a child theme then include a file
		 * called loop.php and that will be used instead.
		 */
		 get_template_part( 'loops/content', 'page' );
	
	/* end the post loop */
	endwhile;

	/* get the sidebar template */
	get_sidebar();

/* get the footer template */
get_footer();

?>