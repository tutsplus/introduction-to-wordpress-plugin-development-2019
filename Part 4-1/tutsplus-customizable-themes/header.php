<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 */

?><!DOCTYPE html>
<!--[if lt IE 7]><html <?php language_attributes(); ?> class="ie6"><![endif]-->
<!--[if IE 7]><html <?php language_attributes(); ?> class="ie7"><![endif]-->
<!--[if IE 8]><html <?php language_attributes(); ?> class="ie8"><![endif]-->
<!--[if IE 9]><html <?php language_attributes(); ?> class="ie9"><![endif]-->
<!--[if gt IE 9]><html <?php language_attributes(); ?>><![endif]-->
<!--[if !IE]><html <?php language_attributes(); ?>><![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title>
	<?php
		/*
		 * print the <title> tag based on what is being viewed.
		 */
		global $page, $paged;
		wp_title( '|', true, 'right' );
	
		/* add the blog name */
		bloginfo( 'name' );
	
		/* add the blog description for the home/front page */
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			echo " | $site_description";
	
		/* add a page number if necessary */
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );
	
	?>
</title>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<!-- html5 shiv -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<script src="<?php bloginfo( 'stylesheet_directory' ); ?>/scripts/PIE.htc"></script>
<![endif]-->

<?php
	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head>

<body <?php body_class(); ?>>
	
	<!-- header - enclosed in a wrapper div to allow for full width background -->
	
	<div class="header-wrapper">
		<header role="banner">	
			
			<?php do_action( 'tutsplus_header_logo' ); ?>
				
			<div class="half right">
				<!-- This area is by default in the top right of the header. It contains contact details and is also where you might add social media or RSS links -->
	
				<?php
				
					/* action hook for any content placed inside the right hand header, including the widget area. */
					do_action ( 'tutsplus_in_header' );
				
				?>
			
			</div> <!-- .one-half right -->
	
		</header><!-- header -->
	</div><!-- .header-wrapper -->
	
	
	<!-- full width navigation menu -->
	<nav class="menu main">

		<?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff */ ?>
		<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'compass' ); ?>"><?php _e( 'Skip to content', 'twentyten' ); ?></a></div>
	
		<?php
	
			/*
			* our navigation menu - if one isn't filled out, wp_nav_menu falls back to wp_page_menu.
			* the menu assiged to the primary position is the one used.
			* if none is assigned, the menu with the lowest ID is used.
			*/
			
			/* a tappable area to display the menu on small screens */
			?>
			
			<a class="mobile" href="#mainnav">
				Menu
			</a>
			
			<div id="mainnav">
				<?php
				/* output the menu */
				wp_nav_menu(
					array(
						'container_class' => 'main-nav',
						'theme_location' => 'primary'
					)
				);
		
				?>
			</div><!-- #mainnav -->
	
	</nav><!-- .main -->


	<?php
			
		/* check we are not using the left hand sidebar page template */
		if ( ! is_page_template( 'page-templates/page-left-hand-sidebar.php' ) ) {
	
			echo '<div class="main">';
			
			/* now check if we are on the full width page template of the home page */
			if ( is_page_template( 'page-template/page-full-width.php' ) ) {
				
				/* output markup for the full width template */
				echo '<div id ="content" class="full-width">';
				
			} else {
				
				/* output markup for the full width template */
				echo '<div id="content" class="two-thirds left">';
				
			} // end of full page template check
			
			/* action hook for any content placed before the content, including the widget area */
			do_action ( 'tutsplus_before_content' );
			
		} // end of content not included in the left hand sidebar page
		
	?>