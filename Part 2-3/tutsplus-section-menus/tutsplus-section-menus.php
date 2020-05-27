<?php
/*
Plugin Name:	Tutsplus Section Menus
Plugin URI:		https://github.com/rachelmccollin/tutsplus-plugin-development
Description:	Plugin to accompany tutsplus course on plugin development. Adds a section menu to the sidebar.
Version:		2.3
Author:			Rachel McCollin
Author URI:		https://rachelmccollin.com 
TextDomain:		tutsplus
License:		GPLv2
*/

/***************************************************************************
	Check if the current page is the top level page
***************************************************************************/
function tutsplus_check_top_level_page(){
	
	// check if we're on a page
	if ( is_page() ) {
		
		global $post;
		
		//check if the page has parents
		if ( $post->post_parent ) {
			
			//fetch higher level posts
			$parents = array_reverse( get_post_ancestors( $post->ID ));
			
			// get the top level ancestor
			return $parents[0];
			
		}
		
		return $post->ID;
		
	}
	
}

/***************************************************************************
Output the section menu
***************************************************************************/
function tutsplus_section_menu() {
	
	//don't run on the main blog page
	if ( is_page() && ! is_home() ) {
		
		$ancestor = tutsplus_check_top_level_page();
		
		//set the arguments for the children of the ancestor
		$args = array (
			'child_of' 	=> 	$ancestor,
			'depth' 	=> 	'-1',
			'title_li'	=> 	''
		);
		
		//save output of get pages
		$list_pages = get_pages( $args );
		
		if ( $list_pages ) { ?>
			
			<section class="section-menu sidebar widget">
				
				<h2 class="widget-title">
					<a href="<?php echo get_permalink( $ancestor ); ?>"><?php echo get_the_title( $ancestor ); ?></a>
				</h2>
				
				<ul class="subpages">
					<?php wp_list_pages( $args ); ?>
				</ul>	
				
			</section>
			
		<?php }
		
	}
	
}
add_action( 'tutsplus_sidebar', 'tutsplus_section_menu' );