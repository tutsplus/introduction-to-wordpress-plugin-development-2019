<?php
/**
 * The template for displaying Search Results pages.
 *
 */

/* get the header template file */
get_header();
	
	/* if there are not posts returned in the search */
	if ( ! have_posts() ) {

		?>
		
		<h2 class="entry-title">Search Results</h2>
		<article id="post-0" class="post no-results not-found">
			<h3 class="entry-title"><?php _e( 'Nothing Found', 'compass' ); ?></h3>
			<section class="entry-content">
				<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try searching for something slightly different.', 'compass' ); ?></p>
				<?php get_search_form(); ?>
			</section><!-- .entry-content -->
		</article><!-- #post-0 -->
		
		<?php
	
	} // end if no posts returned in search
	
	?>
	
	<h2 class="page-title"><?php printf( __( 'Search Results for: %s', 'tutsplus' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
	
	<?php
		
		/* start the loop through the search results */
		while ( have_posts() ) : the_post();
		
			?>
			
			<h3 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'compass' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
			
			<section class="entry-summary">
				<?php the_excerpt(); ?>
			</section><!-- .entry-summary -->
	
			<?php
		
		/* end the post loop */
		endwhile;
		
	/* get the sidebar template file */
	get_sidebar();
	
/* get the footer template file */
get_footer();

?>