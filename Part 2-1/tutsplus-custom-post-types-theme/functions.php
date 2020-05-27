<?php
	
/************************************************************
function enqueue_parent_stylesheet() - enqueues the stylesheet from the parent theme
************************************************************/
function tutsplus_enqueue_parent_stylesheet() {
	
	wp_enqueue_style( 'parent', get_template_directory_uri().'/style.css' );
}
add_action( 'wp_enqueue_scripts', 'tutsplus_enqueue_parent_stylesheet' );


/************************************************************
function tutsplus_projects_on_home_page() - adds custom post type to main blog page
************************************************************/
function tutsplus_projects_on_home_page( $query ) {
	
	if ( is_home() && $query->is_main_query() ) {
		
		$query->set( 'post_type', array( 'post', 'tutsplus_project' ) );
		return $query;
		
	}
	
}
add_action( 'pre_get_posts', 'tutsplus_projects_on_home_page' );