<?php
/**
* Plugin Name:   Tuts+ custom field metabox
* Plugin URI:    https://code.tutsplus.com/courses
* Description:   Adds a metabox for post meta to the post editing screen
* Version:       1.0
* Author:        Rachel McCollin
* Author URI:    http://rachelmccollin.co.uk
* License: GPLv2
*
*/

 
/*********************************************************************************
Add metabox
*********************************************************************************/
// create the metabox
function tutsplus_add_post_metabox() {
	add_meta_box( 'tutsplus_metabox', 'Extra Information', 'tutsplus_metabox_callback', 'post', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'tutsplus_add_post_metabox' );

// the callback function for the metabox contents 
function tutsplus_metabox_callback( $post ) { ?>
	
	<form action="" method="post">
		
		<?php // add nonce for security
		wp_nonce_field( 'tutsplus_metabox_nonce', 'tutsplus_nonce' );
		
		//retrieve metadata value if it exists
		$weather = get_post_meta( $post->ID, 'tutsplus_weather', true ); ?>

		<label for "tutsplus_metadata_weather">Today's Weather</label>
		<input type="text" name="tutsplus_metadata_weather" value=<?php echo esc_attr( $weather ); ?>>
	
	</form>
	
<?php }

// the function to save data from the metabox
function tutsplus_save_my_meta( $post_id ) {

	//check for nonce
	if( ! isset( $_POST['tutsplus_nonce'] ) ||
	!wp_verify_nonce( $_POST['tutsplus_nonce'], 'tutsplus_metabox_nonce' ) ) {
	  return;
	}
	
	// Check if the current user has permission to edit the post.
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
	  return;
	 }
	
	if ( isset( $_POST['tutsplus_metadata_weather'] ) ) {		
		$new_value = ( $_POST['tutsplus_metadata_weather'] );
		update_post_meta( $post_id, 'tutsplus_weather', $new_value );		
	}
	
}
add_action( 'save_post', 'tutsplus_save_my_meta' );
