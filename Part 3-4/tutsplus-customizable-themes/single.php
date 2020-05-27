<?php
/**
 * The Template for displaying all single posts.
 *
 */

/* get the header template file */
get_header();
?>
	
	<?php
	
	/* start the post loop */
	while( have_posts() ) : the_post();
	
	?>
	
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
		<h2 class="entry-title"><?php the_title(); ?></h2>
		
		<section class="entry-meta">
			
			<?php
				
				/* in functions.php, the tutsplus_posted_on function is attached to this hook, which displays the post date */
				do_action ( 'tutsplus_postmeta_before' );
			
			?>
			
		</section><!-- .entry-meta -->

		<section class="entry-content">
			
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'tutsplus' ), 'after' => '</div>' ) ); ?>
		</section><!-- .entry-content -->

			
			<?php
				
				/* in functions.php, the tutsplus_posted_in function is attached to this hook, which displays list of tags, categories etc. */
				do_action ( 'tutsplus_postmeta_after' );
			
			?>
			
		
	</article><!-- #post-## -->
	
	<?php
	
	/* end the loop */
	endwhile;
	
	?>

	<?php tutsplus_page_links(); ?>

	<?php
				
	/* get the sidebar template file */
	get_sidebar();

/* get the footer template file */
get_footer();
?>