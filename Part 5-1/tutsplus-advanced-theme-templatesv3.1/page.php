<?php
/* The template file for dispalying static pages */
?>

<?php get_header(); ?>
		
	<div class="main">
		
		<div id="content" class="two-thirds left">

			<?php get_template_part( 'includes/loop', 'page' ); ?>

		</div><!-- #content -->

		
<?php get_sidebar(); ?>

<?php get_footer(); ?>

