<?php
/**
 * Template Name: Full width page
 *
 * A custom page template without sidebar.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 */

/* get the header template */
get_header();
	
	/* begin the post loop */
	while( have_posts() ) : the_post();
	
		/* Run the page loop to output the page content.
		 * If you want to override this in a child theme then include a file
		 * called loop-page.php and that will be used instead.
		 * This version of the loop is used in all templates for static pages in the framework,
		 * so only write a new one if you want to override it for all of them.
		 */
		 get_template_part( 'loops/content', 'page' );
	
	/* end the loop */
	endwhile;

	/*
	* action hook for any content placed after the content and inside the content div, including the widget area
	* most template files don't include this hook or the closing of the content div as these are coded into the sidebar.php file
	* as full width pages don't use the sidebar, it's included here..*/
	do_action ( 'tutsplus_after_content' );
	
	?>

	</div><!-- #content -->
	
<?php

	/* get the footer template */
	get_footer();

?>