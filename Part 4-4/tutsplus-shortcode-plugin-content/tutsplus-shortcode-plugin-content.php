<?php
/**
* Plugin Name:   Call to Action Shortcode (with editable content)
* Plugin URI:    https://tutsplus.com/
* Description:   Adds a shortcode for a call to action box, with editable content
* Version:       1.0
* Author:        Rachel McCollin
* Author URI:    http://rachelmccollin.com
*
*
*/

/*********************************************************************************
Enqueue stylesheet
*********************************************************************************/
function tutsplus_shortcode_enqueue_styles() {
	
	wp_register_style( 'shortcode_cta_css', plugins_url( 'css/style.css', __FILE__ ) );
    wp_enqueue_style( 'shortcode_cta_css' );
 
}
add_action( 'wp_enqueue_scripts', 'tutsplus_shortcode_enqueue_styles' );
 

/*********************************************************************************
Shortcode with opening and closing tags
*********************************************************************************/
function tutsplus_cta_tags( $atts, $content = null ) {
	
	ob_start();
	?>
	
	<div class="cta">
		<?php echo $content; ?>
	</div>
	
	<?php
	return ob_get_clean();
	
}
add_shortcode( 'cta', 'tutsplus_cta_tags' );