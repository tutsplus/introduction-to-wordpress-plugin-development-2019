<?php
/**
* Plugin Name:   Call to Action Shortcode (parameters)
* Plugin URI:    https://tutsplus.com/
* Description:   Adds a shortcode for a call to action box with editable parameters
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
Shortcode with attributes
*********************************************************************************/
function tutsplus_cta_atts( $atts, $content = null ) {
	
	$atts = shortcode_atts( array(
		'text' => 'Join our mailing list',
		'link' => '#'
	), $atts, 'cta' );
	
	ob_start();
	?>
	
	<div class="cta">
		
		<?php echo '<a href="' . $atts['link'] . '">' . $atts['text'] . '</a>'; ?>
		
	</div>
	
	<?php 
	return ob_get_clean();	
	
}
add_shortcode( 'cta', 'tutsplus_cta_atts' );