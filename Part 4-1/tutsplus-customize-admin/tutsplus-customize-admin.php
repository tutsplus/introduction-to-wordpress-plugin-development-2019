<?php
/*
Plugin Name: 	Tutsplus Customize Admin
Plugin URI: 	https://github.com/rachelmccollin/tutsplus-plugin-development
Description: 	Plugin to accompany tutsplus course on plugin development. Cusomizes the admin screens by removing some dashboard widgets and adding a note to the post editing screen.
Version: 		3.3
Author: 		Rachel McCollin
Author URI: 	http://rachelmccollin.com
Text Domain: 	tutsplus
License: 		GPLv2
*/


/***********************************************************************************************
Edit dashboard widgets
***********************************************************************************************/
function tutsplus_remove_dashboard_widgets() {
	
	remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side');
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side');
	
}
add_action( 'wp_dashboard_setup', 'tutsplus_remove_dashboard_widgets' );


/***********************************************************************************************
Add a new widget to the dashboard
***********************************************************************************************/
function tutsplus_add_welcome_widget() {
	
	add_meta_box( 'tutsplus_welcome_widget', 'Welcome', 'tutsplus_welcome_widget_callback', 'dashboard', 'side', 'high' );	
	
}
add_action( 'wp_dashboard_setup', 'tutsplus_add_welcome_widget' );

function tutsplus_welcome_widget_callback() {
	
	echo '<p>' . __( 'This content management system lets you edit the pages and posts on your website.', 'tutsplus' ) . '</p>';
	
	echo '<h4>' . __( '<>Editing and adding content', 'tutsplus' ) . '</h4>';
	
	echo '<p>' . __( 'Your site consists of the following content, which you can access via the menu on the left:', 'tutsplus' ) . '</p>';
	
	echo '<ul>';
		echo '<li><strong>' . __( 'Posts' , 'tutpslus' ) . '</strong>' . __( ' - blog posts - you can edit these and add more.', 'tutsplus') . '</li>';
		echo '<li><strong>' . __( 'Media' , 'tutpslus' ) . '</strong>' . __( ' - images and documents which you can upload via the Media menu on the left or within each post or page. Most media is uploaded into a post, page or resource except articles which you upload using the Media page.', 'tutsplus') . '</li>';
		echo '<li><strong>' . __( 'Pages' , 'tutpslus' ) . '</strong>' . __( ' - static pages which you can edit.', 'tutsplus') . '</li>';
		echo '<li><strong>' . __( 'Comments' , 'tutpslus' ) . '</strong>' . __( ' - manage comments posted by your members here or in the post editing screen.', 'tutsplus') . '</li>';		
		echo '<li><strong>' . __( 'Products' , 'tutpslus' ) . '</strong>' . __( ' - everything you sell via this website or via an affiliate link.', 'tutsplus') . '</li>';
	echo '</ul>';
	
	echo '<p>' . __( 'On each editing screen there are instructions to help you add and edit content.', 'tutsplus' ) . '</p>';
	
	echo '<h4>' . __( 'Configuring settings', 'tutsplus' ) . '</h4>';
	
	echo '<p>' . __( '<p>There are also a number of screens which let you configure various options. Ones you may sometimes need to use are:', 'tutsplus' ) . '</p>';
	
	echo '<ul>';
		echo '<li><strong>' . __( 'WooCommerce' , 'tutsplus' ) . '</strong>' . __( ' - here you can amend your shop settings, such as PayPal details, the email notifications sent to customers, shipping, tax and more.', 'tutsplus') . '</li>';
		echo '<li><strong>' . __( 'Appearance' , 'tutsplus' ) . '</strong>' . __( ' - add new pages to the navigation menu or add widgets to the sidebar or footer. It is unlikely you will need to use any of these.', 'tutsplus') . '</li>';
		echo '<li><strong>' . __( 'Settings' , 'tutsplus' ) . '</strong>' . __( ' - here you can change settings for your site such as the way urls are displayed and the size of media. Again it is unlikely you will need to use this.', 'tutsplus' ) . '</li>';	
	echo '</ul>';
	
	echo '<p>' . __( 'At the bottom of the menu to the left, the ' , 'tutsplus' ) . '<strong>' . __( 'Manuals', 'tutsplus') . '</strong>' . __( ' link takes you to a set of video guides which will help you learn how to use WordPress.', 'tutsplus' ) . '</p>';
	
	echo '<p>' . __( 'Below these instructions are some more widgets which give you access to information on purchases made via your e-commerce system, which is called WooCommerce.', 'tutsplus' ) . '</p>';
		
}
	
/***********************************************************************************************
Add a text box to the post editing screen
***********************************************************************************************/
function tutsplus_add_post_editing_metabox() {
	
	add_meta_box( 'tutsplus_post_editing_meta', 'Using this screen', 'tutsplus_post_editing_callback', 'post', 'side', 'high' );
	
}
add_action( 'add_meta_boxes', 'tutsplus_add_post_editing_metabox' );

function tutsplus_post_editing_callback() {
	
	echo '<p>' . __( 'Use this screen to create new blog posts and edit existing ones. Some tips:', 'tutsplus' ) . '</p>';
	echo '<ul>';
		echo '<li>' . __( 'To type your post, just start typing in the main editing pane. You can format your content using the formatting menu above the text', 'tutsplus' ) . '</li>';
		echo '<li>' . __( 'To add an image, click on ', 'tutsplus' ) . '<strong>' . __( 'Add Media', 'tutsplus' ) . '</strong>' .  __( ' to upload images from your PC', 'tutsplus' ) . '</li>';
		echo '<li>' . __( 'After creating your post, you can preview it before saving by clicking the ', 'tutsplus' ) . '<strong>' . __( 'Preview', 'tutpslus' ) . '</strong>' . __( ' button.', 'tutsplus' ) . '</li>';
		echo '<li>' . __( 'Specify topics and applications for your post by clicking the check boxes below.', 'tutsplus' ) . '</li>';
		echo '<li>' . __( 'To save your post, click ', 'tutsplus' ) . '<strong>' . __( 'Publish', 'tutsplus' ) . '</strong>.</li>';
		echo '<li>' . __( 'After editing an existing post, click ', 'tutsplus' ) . '<strong>' . __( 'Update', 'tutsplus' ) . '</strong>' . __( ' to save your changes.', 'tutsplus' ) . '</li>';
 	echo '</ul>';
	
}
