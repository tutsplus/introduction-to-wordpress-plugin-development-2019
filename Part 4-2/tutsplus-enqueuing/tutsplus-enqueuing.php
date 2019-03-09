<?php
/**
* Plugin Name:	Tuts+ Enqueuing Styles and Scripts in WordPress
* Plugin URI:	http://rachelmccollin.co.uk/
* Description:	Plugin to support tuts+ course on correctly enqueuing styles and scripts in WordPress.
* Version:		1.0
* Author:		Rachel McCollin
* Author URI:	http://rachelmccollin.co.uk
* Text Domain:	tutsplus
* Licence:		GNU General Public License v2
*
*/

/**********************************************************************
tutsplus_enqueue_latest_posts_styles - enqueu styles for latest posts list
**********************************************************************/
function tutsplus_enqueue_latest_posts_styles() {
	
	wp_register_style( 'latest_posts', plugins_url( '/css/style.css', __FILE__ ) );
	wp_enqueue_style( 'latest_posts' );
	
}
add_action( 'wp_enqueue_scripts', 'tutsplus_enqueue_latest_posts_styles' );


/**********************************************************************
tutsplus_display_latest_posts - displays a list of the latest posts
**********************************************************************/
function tutsplus_display_latest_posts() {	
	
	if ( is_page() && ! is_front_page() ) {
		
		global $post;

		$args = array( 
			'posts_per_page' => 5
		);
	
		$my_posts = get_posts( $args );
		
		if ( ! empty ( $my_posts ) ) {
			
			echo '<aside class="latest-posts">';
			
				_e ('<h3>Latest Posts</h3>', 'tutsplus' );
				echo '<ul>';
			
					foreach ( $my_posts as $my_post ) {
									
						echo '<li>';
							echo '<a href="' . get_the_permalink( $my_post ) . '">' . get_the_title( $my_post ) . '</a>';
						echo '</li>';
				
					}
					
				echo '</ul>';
					
			echo '</aside>';
		}
	
		wp_reset_postdata();
		
	}	
	
}
add_action ( 'tutsplus_after_content', 'tutsplus_display_latest_posts' );


