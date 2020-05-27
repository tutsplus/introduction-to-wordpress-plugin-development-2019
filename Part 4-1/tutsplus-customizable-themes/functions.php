<?php
/**
 * Functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, tutsplus_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain pluggable functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 */

/* load the widgets functions */
load_template( get_template_directory() . '/includes/widgets.php' );
load_template( get_template_directory() . '/includes/customizer.php' );

/** Tell WordPress to run tutsplus_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'tutsplus_setup' );

if ( ! function_exists( 'tutsplus_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which runs
	 * before the init hook. The init hook is too late for some features, such as indicating
	 * support post thumbnails.
	 *
	 * This function is pluggable - to override tutsplus_setup() in a child theme, add your own tutsplus_setup to your child theme's
	 * functions.php file.
	 *
	 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
	 * @uses register_nav_menus() To add support for navigation menus.
	 * @uses load_theme_textdomain() For translation/localization support.
	 *
	 */
	function tutsplus_setup() {
	
		/* This theme uses post thumbnails */
		add_theme_support( 'post-thumbnails' );
	
		/* add default posts and comments RSS feed links to head */
		add_theme_support( 'automatic-feed-links' );
	
		/*
		* make theme available for translation
		* translations can be filed in the /languages/ directory
		*/
		load_theme_textdomain( 'tutsplus', TEMPLATEPATH . '/languages' );
	
		$locale = get_locale();
		$locale_file = TEMPLATEPATH . "/languages/$locale.php";
		if ( is_readable( $locale_file ) )
			require_once( $locale_file );
	
		/* this theme uses wp_nav_menu() in one location */
		register_nav_menus( array(
			'primary' => __( 'Primary Navigation', 'tutsplus' ),
		) );
	
	}
	
} // end if tutsplus_setup does not exist

/***************************************************************
* Function tutsplus_remove_gallery_css()
* remove inline styles printed when the gallery shortcode is used.
* Galleries are styled by the theme in the frameworks' style.css
***************************************************************/
function tutsplus_remove_gallery_css( $css ) {
	
	/* replace any inline styles with nothing */
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
	
}

add_filter( 'gallery_style', 'tutsplus_remove_gallery_css' );


/***************************************************************
* Function tutsplus_page_links()
* previous page / next page links - pluggable so you can
* override it with your own function
* this function is called in the loop files, archive.php
* and category.php
***************************************************************/
if ( ! function_exists( 'tutsplus_page_links' ) ) {

	function tutsplus_page_links() {
	
		global $post, $wp_query;
			
			/* if we have more than 1 page in this archive */
			if ( $wp_query->max_num_pages > 1 ) {
			
			?>
		
			<nav id="paginated-nav" class="navigation">
				<nav class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Earlier articles', 'tutsplus' ) ); ?></nav>
				<nav class="nav-next"><?php previous_posts_link( __( 'Newer articles <span class="meta-nav">&rarr;</span>', 'tutsplus' ) ); ?></nav>
			</nav><!-- #nav-above -->
			
			<?php
			
		} // end if display navigation links
		
		
	} // end function
	
} // end if function does not exist

/***************************************************************
the colophon - added after the footer using the tutsplus_after_footer hook. 
Pluggable - add your own function called tutsplus_colophon to your child theme's functions file to override.
****************************************************************/
if ( ! function_exists( 'tutsplus_colophon' ) ) :
function tutsplus_colophon() { ?>
	<section class="colophon" role="contentinfo">
		<small class="copyright left">
			<?php echo tutsplus_copyright(); ?>
			<a href="<?php echo home_url( '/' ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			<?php bloginfo( 'name' ); ?>
			</a>
		</small><!-- #copyright -->

		<small class="credits right">
				Powered by <a href="http://wordpress.org/">WordPress</a> and designed by <a href="http://rachelmccollin.co.uk">Rachel McCollin</a>.
			</a>
		</small><!-- #credits -->
	</section><!--#colophon-->
<?php }
endif;
// end of pluggable function
add_action( 'tutsplus_after_footer', 'tutsplus_colophon' );

/***************************************************************
* Function tutsplus_colophon()
* dynamic copyright range for colophon
* pluggable
***************************************************************/
if ( ! function_exists( 'tutsplus_copyright' ) ) {

	function tutsplus_copyright() {
	
		global $wpdb;
		$copyright_dates = $wpdb->get_results("
			SELECT
			YEAR(min(post_date_gmt)) AS firstdate,
			YEAR(max(post_date_gmt)) AS lastdate
			FROM
			$wpdb->posts
			WHERE
			post_status = 'publish'
		");
		$output = '';
		if($copyright_dates) {
			$copyright = "&copy; " . $copyright_dates[0]->firstdate;
			if($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {
				$copyright .= '-' . $copyright_dates[0]->lastdate;
			}
			$output = $copyright;
		}
		return $output;
		
	} // end function

} // end if function does not already exist
?>