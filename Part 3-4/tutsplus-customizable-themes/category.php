<?php
/*
* The template for displaying Category Archive pages.
*/

get_header(); ?>

<h2 class="page-title"><?php printf( __( '%s', 'compass' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h2>

<?php
	
	/* get the category description for the current category */
	$category_description = category_description();
	
	/* check that the category description is not entry i.e. something has been added */
	if ( ! empty( $category_description ) ) {
		
		/* outout the category description with some markup */
		echo '<div class="archive-meta">' . $category_description . '</div>';	
		
	} // end if category description not emptu
	
	/* start the loop */
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
