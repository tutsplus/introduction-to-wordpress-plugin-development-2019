<?php
/**
* Plugin Name:   Call to Action Plugin - Hooked to Theme
* Plugin URI:    https://tutsplus.com/
* Description:   Adds a call to action box
* Version:       1.0
* Author:        Rachel McCollin
* Author URI:    http://rachelmccollin.com
*
*
*/

/*********************************************************************************
Enqueue stylesheet
*********************************************************************************/
function tutsplus_hook_plugin_enqueue_styles() {
	
	wp_register_style( 'hook_cta_css', plugins_url( 'css/style.css', __FILE__ ) );
	wp_enqueue_style( 'hook_cta_css' );
	
}
add_action( 'wp_enqueue_scripts', 'tutsplus_hook_plugin_enqueue_styles' );
 
/*********************************************************************************
CTA box
*********************************************************************************/
function tutsplus_cta_below_posts() {
	
	if( is_singular( 'post' )) { ?>
		
		<div class="cta-in-post">
			<a href="#">For more posts like this in your inbox every week, join our mailing list.</a>
		</div>
		
	<?php }
	
}
add_action( 'tutsplus_after_content', 'tutsplus_cta_below_posts' );