<?php
/*
Plugin Name: Tuts+ Custom Content Types
Plugin URI: http://rachelmccollin.co.uk/tutsplus-custom-content-types/
Description: Plugin to support tuts+ course on Getting to Grips with WordPress Custom Content Types.
Version: 3.1
Author: Rachel McCollin
Author URI: http://rachelmccollin.co.uk
Text domain: tutsplus
License: GPLv2
*/

/*************************************************************
Register post types
*************************************************************/
function tutsplus_register_post_types() {
	
	$labels = array(
		'name' => __('Moons', 'tutsplus'),
		'singular_name' => __('Moon', 'tutsplus'),
		'add_new' => __('Add New Moon', 'tutsplus'),
		'edit_item' => __('Edit Moon', 'tutsplus'),
		'new_item' => __('New Moon', 'tutsplus'),
		'view_item' => __('View Moon', 'tutsplus'),
		'search_items' => __('Search All Moons', 'tutsplus'),
		'not_found' => __('No Moons Found', 'tutsplus'),
		'not_found_in_trash' => __('No Moons Found in Trash', 'tutsplus'),

	);
	$args = array(
		'labels' => $labels,
		'has_archive' => true,
		'public' => true,
		'hierarchical' => false,
		'supports' => array(
			'title',
			'editor',
			'excerpt',
			'custom-fields',
			'thumbnail',
			'page-attributes'
		)
	);
	register_post_type( 'moon', $args );
	
}
add_action( 'init', 'tutsplus_register_post_types' );

/*************************************************************
Register taxonomies
*************************************************************/
function tutsplus_register_taxonomies() {

	//planets
	$labels = array(
		'name' => __( 'Planets', 'tutsplus' ),
		'singular_name' => __( 'Planet', 'tutsplus' ),
		'search_items' => __( 'Search Planets', 'tutsplus' ),
		'all_items' => __( 'All Planets', 'tutsplus' ),
		'edit_item' => __( 'Edit Planet', 'tutsplus' ),
		'update_item' => __( 'Update Planet', 'tutsplus' ),
		'add_new_item' => __( 'Add New Planet', 'tutsplus' ),
		'new_item_name' => __( 'New Planet Name', 'tutsplus' ),
		'menu_name' => __( 'Planets', 'tutsplus' ),
	);
	$args = array(
		'hierarchical' => true,
		'rewrite' => array( 'slug' => 'planets'),
		'show_admin_column' => true,
		'labels' => $labels		
	);
	register_taxonomy( 'planet', 'moon', $args );

}
add_action( 'init', 'tutsplus_register_taxonomies' );

?>