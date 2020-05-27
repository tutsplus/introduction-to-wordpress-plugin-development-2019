<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query. 
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 */

get_header();
	
	
	/* if there are no posts to display, such as an empty archive page */
	if ( ! have_posts() ) {
		
		?>
		
		<article id="post-0" class="post error404 not-found">
			<h2 class="entry-title"><?php _e( 'Not Found', 'tutsplus' ); ?></h2>
			<section class="entry-content">
				<p><?php _e( 'Sorry, but no results were found for the requested archive. Maybe a search will help you find what you&lsaquo;re looking for?', 'tutsplus' ); ?></p>
				<?php get_search_form(); ?>
			</section><!-- .entry-content -->
		</article><!-- #post-0 -->
		
		<?php
	
	} // end if there are no posts
	
	/* start the post loop */
	while( have_posts() ) : the_post();
	
		/* Run the standard loop to output the posts.
		 * If you want to override this in a child theme then include a file
		 * called loop.php and that will be used instead.
		 */
		 get_template_part( 'loops/content' );
	
	/* end the post loop */
	endwhile;
	
	/* Display navigation to next/previous pages when applicable */
	tutsplus_page_links();

	
	/* get the sidebar template file */
	get_sidebar();

/* get the footer template file */
get_footer();

?>