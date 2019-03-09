<?php
	
/************************************************************
function enqueue_parent_stylesheet() - enqueues the stylesheet from the parent theme
************************************************************/
function enqueue_parent_stylesheet() {
	
	wp_enqueue_style( 'parent', get_template_directory_uri().'/style.css' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_parent_stylesheet' );
