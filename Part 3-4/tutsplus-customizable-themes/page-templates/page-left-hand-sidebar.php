<?php
/**
 * Template Name: Page with left hand sidebar
 *
 * A custom page template with the sidebar on the left.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * This template includes the opening of the main and content divs so that the correct classes
 * can be applied. It's different in this way from the other static page templates.
 *
 */

/* get the header template file */
get_header();
?>

<div class="main">

	<?php
		
		/* get the sidebar template file */
		get_sidebar(); ?>

	<div id="content two-thirds right">
	
		<?php
		/* action hook for any content placed before the content, including the widget area */
		do_action ( 'tutsplus_before_content' );
		
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

	/* get the header template file */
	get_footer();
	
?>
