<?php
/* Template Name: Contact Page */
?>

<?php get_header(); ?>
		
	<div class="main">
		
		<div id="content" class="two-thirds left">
			
			<div class="button">
				Please <a href="mailto:mail@mail.com">contact us</a> if you have any questions or would like to chat.
			</div>	

			<?php get_template_part( 'includes/loop', 'page' ); ?>

		</div><!-- #content -->

		
<?php get_sidebar(); ?>

<?php get_footer(); ?>

