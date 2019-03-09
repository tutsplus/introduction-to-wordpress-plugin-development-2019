<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the class=main div and all content
 * after. 
 *
 */
?>
</div><!-- .main -->

<footer>

	<?php
	
		/* action hook for any content placed in the footer, including the widget areas */
		do_action ( 'tutsplus_footer' );
		
	?>
		
</footer>

<?php

	/* action hook for any content placed below the footer, including the widget areas or a colophon */
	do_action ( 'tutsplus_after_footer' );
	
?>

<?php
	
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>

</body>
</html>
