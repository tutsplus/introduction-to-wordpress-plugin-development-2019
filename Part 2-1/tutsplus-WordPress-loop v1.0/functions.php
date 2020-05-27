<?php
	/* The theme functions file */

/****************************************************************************
Theme setup
****************************************************************************/
function tutsplus_theme_setup() {
	
	// title tags
	add_theme_support( 'title-tag' );
	
	// translation
	load_theme_textdomain( 'tutsplus', get_stylesheet_directory() . '/languages' );

	// post formats
	add_theme_support( 'post_formats' );

	// Post thumbnails or featured images
	add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );

	// RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// navigation menu
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'tutsplus' )
	) );

}
add_action( 'after_setup_theme', 'tutsplus_theme_setup' );

/****************************************************************************
Register widgets
****************************************************************************/
function tutsplus_register_widgets() {
		
	// Sidebar widget area, located in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Sidebar Widget Area', 'tutsplus' ),
		'id' => 'sidebar-widget-area',
		'description' => __( 'The sidebar widget area', 'tutsplus' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// First footer widget area, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'tutsplus' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'tutsplus' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Second Footer Widget Area, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'tutsplus' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', 'tutsplus' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Third Footer Widget Area, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'tutsplus' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', 'tutsplus' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
}
add_action( 'widgets_init', 'tutsplus_register_widgets' );
