<?php
/*
The include for displaying the loop in static pages.
This is used in the following template files:
 - page.php
 - page-full-width.php
 - page-left-hand-sidebar.php
To override it, create your own loop-page.php in your child theme
*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php if ( is_front_page() ) { ?>
	<?php } else { ?>
		<h2 class="entry-title"><?php the_title(); ?></h2>
	<?php } ?>

	<section class="entry-content">
		<?php
			
			/* output the page content */
			the_content();
			
			/* do after content action - contact settings hooked here for that page */
			do_action( 'tutsplus_after_page_content' );
		
			/* outut any link pages */
			wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'tutsplus' ), 'after' => '</div>' ) );
		
		?>
	</section><!-- .entry-content -->
</article><!-- #post-## -->