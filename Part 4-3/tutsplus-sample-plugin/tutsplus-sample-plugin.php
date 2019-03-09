<?php
/*
	Plugin Name:	Tutsplus Sample Plugin
	Plugin URI:		http://tutsplus.com 
	Description:	Plugin to accompany tutsplus course on Introduction to Plugin Development
	Author:			Rachel McCollin
	Author URI:		http://rachelmccollin.com 
	Version:		4.3
	Text Domain:	tutsplus
	License:		GPLv2
*/

/********************************************************
enqueue scripts and styles
*********************************************************/
function tutsplus_enqueue_scripts_styles() {
	
	wp_register_style( 'tutsplus_style', plugins_url( 'styles/style.css', __FILE__ ));
	wp_enqueue_style( 'tutsplus_style' );
	
	wp_register_script( 'tutsplus_script', plugins_url( 'scripts/my-script.js', __FILE__));
	wp_enqueue_script( 'tutsplus_script' );
	
}
add_action( 'wp_enqueue_scripts', 'tutsplus_enqueue_scripts_styles' );

/********************************************************
include files
*********************************************************/
include( plugin_dir_path( __FILE__ ) . 'includes/register_post_type.php' );

require( plugin_dir_path( __FILE__ ) . 'includes/register_post_type.php' );

include_once( plugin_dir_path( __FILE__ ) . 'includes/register_post_type.php' );

require_once( plugin_dir_path( __FILE__ ) . 'includes/register_post_type.php' );
