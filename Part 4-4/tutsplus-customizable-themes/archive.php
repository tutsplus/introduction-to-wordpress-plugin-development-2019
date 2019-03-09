<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 */

get_header(); ?>

<?php

	/* Queue the first post, that way we know
	* what date we're dealing with (if that is the case).
	* We reset this later so we can run the loop
	* properly with a call to rewind_posts().
	*/
	if ( have_posts() ) {
		
		/* give access to post functions used below */
		the_post();
		
		/* open up a head tag for our title */
		echo '<h2 class="page-title">';
		
		/* if this is a date based archive */
		if ( is_day() ) {
			
			/* use the full date as the title */
			printf( __( 'Archive for <span>%s</span>', 'tutsplus' ), get_the_date() );
		
		/* if this is a month based archive */
		} elseif( is_month() ) {
			
			/* use the date in year month format for title */
			printf( __( 'Archive for <span>%s</span>', 'tutsplus' ), get_the_date('F Y') );
		
		/* if this is a year based date archive */
		} elseif( is_year() ) {
			
			/* use the date in year format for title */
			printf( __( 'Archive for <span>%s</span>', 'tutsplus' ), get_the_date('Y') );
		
		/* if not any of the above */
		} else {
			
			/* output a post type archive based title */
			post_type_archive_title();
			
		} // end if archive type
		
		/* close our head tag */
		echo '</h2>';
		
	}

	/* Since we called the_post() above, we need to
	* rewind the loop back to the beginning that way
	* we can run the loop properly, in full.
	*/
	rewind_posts();
	
	/* start the loop for displaying each post */
	while ( have_posts() ) : the_post();
	
	?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
			<h3 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'compass' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
		
			<section class="entry-meta">
				
				<?php
					
					/* output the date the article was posted */
					tutsplus_posted_on();
				
				?>
				
			</section><!-- .entry-meta -->
		
			<section class="entry-summary">
				<?php the_excerpt(); ?>
			</section><!-- .entry-content -->
			
		</article>

	<?php
	
	/* end the loop*/
	endwhile;
	
	/* display navigation to next/previous pages when applicable */
	tutsplus_page_links();

/* get the sidebar template */
get_sidebar();

/* get the footer template */
get_footer();

?>
