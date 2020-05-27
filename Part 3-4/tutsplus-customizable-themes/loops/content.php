<?php
/**
 * The loop that displays posts.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop.php or
 * loop-template.php, where 'template' is the loop context
 * requested by a template. For example, loop-index.php would
 * be used if it exists and you call the loop with:
 * <?php get_template_part( 'loop', 'index' ); ?>
 *
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
		<h3 class="entry-title">
			<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'tutsplus' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h3>

		<?php
			
			/* in functions.php, the tutsplus_posted_on function is attached to this hook, which displays the post date */
			do_action ( 'tutsplus_postmeta_before' );
		
		?>

		<section class="entry-content">
			<?php the_content(); ?>
		</section><!-- .entry-content -->
		
		<?php 
			
			/* in functions.php, the tutsplus_posted_in function is attached to this hook, which displays list of tags, categories etc. */
			do_action ( 'tutsplus_postmeta_after' );
		
		?>
	
	</article>

<?php
		
?>