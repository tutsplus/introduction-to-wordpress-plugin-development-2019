<?php
/**
Register widgetized areas, including:
- a widget above and below the header
- a widget above and below the content (inside the content div)
- a widget in the sidebar
- four widgets in the footer
- a widget below the footer, just in case.

Each of these widgets is added to the theme via an action hook. 
To remove an individual widget area from your child theme, remove it from the relevant action hook.

This file also includes a function to adda  colophon below the footer, using the tutsplus_after_footer hook.
The function to do this is pluggable so you can override it in your child theme.

The tutsplus_widgets_init() function is pluggable - to override it in a child theme, 
code your own tutsplus_widgets_init() function to register your own sidebars.
You will then need to add your own sidebars to your child theme manually 
or by attaching them to the relevant action hook.

*/

if ( ! function_exists( 'tutsplus_widgets_init' ) ) :
function tutsplus_widgets_init() {
		
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

	// Fourth Footer Widget Area, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Fourth Footer Widget Area', 'tutsplus' ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'The fourth footer widget area', 'tutsplus' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
		// After Footer Widget Area, located after the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'After Footer Widget Area', 'tutsplus' ),
		'id' => 'after-footer-widget-area',
		'description' => __( 'Widget area after the main footer. Full width.', 'tutsplus' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
}
endif;
// end of pluggable function

/* register sidebars by running tutsplus_widgets_init() on the widgets_init hook */
add_action( 'widgets_init', 'tutsplus_widgets_init' );


/***************************************************************
* Function tutsplus_sidebar_widget_area()
* sidebar widget area, in the main sidebar
* called directly from sidebar template files
***************************************************************/
function tutsplus_sidebar_widget_area() {
 
	/* start by checking if the sidebar has widgets */
	if ( is_active_sidebar( 'sidebar-widget-area' ) ) {
	
		/* check if we are using the page with left hand sidebar template */
		if( is_page_template( 'page-templates/page-left-hand-sidebar.php' ) ) {
			
			/* output some markup */
			echo '<aside class="sidebar widget-area one-third left" role="complementary">';
			
			/* output the widgets */
			dynamic_sidebar( 'sidebar-widget-area' );
			
			/* close any markup */
			echo '</aside>';
		
		/* if we aren't on the left hand template, style the sidebar accordingly */
		} else {
			
			/* output some markup */
			echo '<aside class="sidebar widget-area one-third right" role="complementary">';
			
			/* output the widgets */
			dynamic_sidebar( 'sidebar-widget-area' );
			
			/* close any markup */
			echo '</aside>';
			
		} // end of page template
		
	} //end of conditional content
	
}
add_action( 'tutsplus_sidebar', 'tutsplus_sidebar_widget_area' );

/***************************************************************
The footer widget areas.
The footer widget areas use is_active_sidebar() to check how many widget areas have widgets within them 
and adjust the layout accordingly.
If there are four widget areas with content, each will take up a quarter of a width in desktop,
if there are three, each will take up a third of the width etc.
For this reason, it is essential to use the widget areas in order when populating them and only keep the later ones empty.
***************************************************************/
function tutsplus_footer_widgets() {
	/* The footer widget area is triggered if any of the areas
	 * have widgets. So let's check that first.
	 *
	 * If none of the sidebars have widgets, then let's bail early.
	 */
	if (   ! is_active_sidebar( 'first-footer-widget-area'  )
		&& ! is_active_sidebar( 'second-footer-widget-area' )
		&& ! is_active_sidebar( 'third-footer-widget-area'  )
		&& ! is_active_sidebar( 'fourth-footer-widget-area' )
	)
		return;
	// If we get this far, we have widgets.
	// The next check is to see if all four widget areas have content, which will affect the CSS classes used.
	if (   is_active_sidebar( 'first-footer-widget-area'  )
		&& is_active_sidebar( 'second-footer-widget-area' )
		&& is_active_sidebar( 'third-footer-widget-area'  )
		&& is_active_sidebar( 'fourth-footer-widget-area' )
	) :	?>
	<aside class="fatfooter" role="complementary">
		<div class="first quarter left widget-area">
			<?php dynamic_sidebar( 'first-footer-widget-area' ); ?>
		</div><!-- .first .widget-area -->
	
		<div class="second quarter widget-area">
			<?php dynamic_sidebar( 'second-footer-widget-area' ); ?>
		</div><!-- .second .widget-area -->
	
		<div class="third quarter widget-area">
			<?php dynamic_sidebar( 'third-footer-widget-area' ); ?>
		</div><!-- .third .widget-area -->
	
		<div class="fourth quarter right widget-area">
			<?php dynamic_sidebar( 'fourth-footer-widget-area' ); ?>
		</div><!-- .fourth .widget-area -->
	</aside><!-- #fatfooter -->
	<?php 
	
	//end of check for all four sidebars. Next we check if there are three sidebars with widgets.
	elseif ( is_active_sidebar( 'first-footer-widget-area'  )
		&& is_active_sidebar( 'second-footer-widget-area' )
		&& is_active_sidebar( 'third-footer-widget-area'  )
		&& ! is_active_sidebar( 'fourth-footer-widget-area' )
	) : ?>
	<aside class="fatfooter" role="complementary">
		<div class="first one-third left widget-area">
			<?php dynamic_sidebar( 'first-footer-widget-area' ); ?>
		</div><!-- .first .widget-area -->
	
		<div class="second one-third widget-area">
			<?php dynamic_sidebar( 'second-footer-widget-area' ); ?>
		</div><!-- .second .widget-area -->
	
		<div class="third one-third right widget-area">
			<?php dynamic_sidebar( 'third-footer-widget-area' ); ?>
		</div><!-- .third .widget-area -->
	
	</aside><!-- #fatfooter -->
	<?php
	
	//end of check for three sidebars. Next we check if there are two sidebars with widgets.
	elseif ( is_active_sidebar( 'first-footer-widget-area'  )
		&& is_active_sidebar( 'second-footer-widget-area' )
		&& ! is_active_sidebar( 'third-footer-widget-area'  )
		&& ! is_active_sidebar( 'fourth-footer-widget-area' )
	) : ?>
	<aside class="fatfooter" role="complementary">
		<div class="first half left widget-area">
			<?php dynamic_sidebar( 'first-footer-widget-area' ); ?>
		</div><!-- .first .widget-area -->
	
		<div class="second half right widget-area">
			<?php dynamic_sidebar( 'second-footer-widget-area' ); ?>
		</div><!-- .second .widget-area -->
	
	</aside><!-- #fatfooter -->
	<?php
	
	//end of check for two sidebars. Finally we check if there is just one sidebar with widgets.
	elseif ( is_active_sidebar( 'first-footer-widget-area'  )
		&& ! is_active_sidebar( 'second-footer-widget-area' )
		&& ! is_active_sidebar( 'third-footer-widget-area'  )
		&& ! is_active_sidebar( 'fourth-footer-widget-area' )
	) :
	?>
	<aside class="fatfooter" role="complementary">
		<div class="first full-width widget-area">
			<?php dynamic_sidebar( 'first-footer-widget-area' ); ?>
		</div><!-- .first .widget-area -->
	
	</aside><!-- #fatfooter -->
	<?php endif;
}
///end of tutsplus_footer_widgets function
add_action( 'tutsplus_footer', 'tutsplus_footer_widgets' );

/***************************************************************
* Function tutsplus_after_footer_widget_area()
* The final widget area - after footer  widget area, between
* the closing footer tag and the closing body tag
***************************************************************/
function tutsplus_after_footer_widget_area() {
	
	/* start by checking if the sidebar has widgets */
	if( is_active_sidebar( 'after-footer-widget-area' ) ) {
		
		/* output some markup */
		echo '<aside class="after-footer full-width widget-area" role="complementary">';
		
		/* output the widgets */
		dynamic_sidebar( 'after-footer-widget-area' );
		
		/* close any markup */
		echo '</aside>';
		
	} // end of have widgets in sidebar
	
}
add_action( 'tutsplus_after_footer', 'tutsplus_after_footer_widget_area' );
?>
