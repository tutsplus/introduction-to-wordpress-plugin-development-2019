	</div><!-- .main -->
	
	<footer>
	
		<div class="fatfooter">
	
			<?php if ( is_active_sidebar( 'first-footer-widget-area' ) ) { ?>
				<div class="one-third left widget-area first">
					<?php dynamic_sidebar( 'first-footer-widget-area' ); ?>
				</div><!-- .first .widget-area -->
			<?php } ?>
		
			<?php if ( is_active_sidebar( 'second-footer-widget-area' ) ) { ?>
				<div class="one-third left widget-area second">
					<?php dynamic_sidebar( 'second-footer-widget-area' ); ?>
				</div><!-- .first .widget-area -->
			<?php } ?>
		
			<?php if ( is_active_sidebar( 'third-footer-widget-area' ) ) { ?>
				<div class="one-third left widget-area third">
					<?php dynamic_sidebar( 'third-footer-widget-area' ); ?>
				</div><!-- .first .widget-area -->
			<?php } ?>
	
		</div>
	
	</footer>
	
	<?php wp_footer(); ?>

</body>
</html>