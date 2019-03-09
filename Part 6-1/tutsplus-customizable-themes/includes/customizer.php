<?php
/**************************************************************************
Customizer include file
Includes all functions for the customizer with this theme
**************************************************************************/

/**************************************************************************
Add theme customizer controls, settings etc.
**************************************************************************/
function tutsplus_customize_register( $wp_customize ) {
	
	/********************
	Define generic controls
	*********************/
	
	// create class to define textarea controls in Customizer
	class Tutsplus_Customize_Textarea_Control extends WP_Customize_Control {
		
		public $type = 'textarea';
		public function render_content() {
			
			echo '<label';
				echo '<span class="customize-control-title">' . esc_html( $this-> label ) . '</span>';
				echo '<textarea rows="2" style ="width: 100%;"';
				$this->link();
				echo '>' . esc_textarea( $this->value() ) . '</textarea>';
			echo '</label>';
			
		}
	}	
	
	/*******************************************
	Contact details in header
	********************************************/
	
	// add the section
	$wp_customize->add_section( 'tutsplus_contact' , array(
		'title' => __( 'Contact Details', 'tutsplus')
	) );
	
	//settings
	// address
	$wp_customize->add_setting( 'tutsplus_address_setting', array (
		'default' => __( 'Your address', 'tutsplus' )
	) );
	$wp_customize->add_control( new Tutsplus_Customize_Textarea_Control(
		$wp_customize,
		'tutsplus_address_setting',
		array( 
			'label' => __( 'Address', 'tutsplus' ),
			'section' => 'tutsplus_contact',
			'settings' => 'tutsplus_address_setting'
	)));
	
	// phone number
	$wp_customize->add_setting( 'tutsplus_telephone_setting', array (
		'default' => __( 'Your telephone number', 'tutsplus' )
	) );
	$wp_customize->add_control( new Tutsplus_Customize_Textarea_Control(
		$wp_customize,
		'tutsplus_telephone_setting',
		array( 
			'label' => __( 'Telephone Number', 'tutsplus' ),
			'section' => 'tutsplus_contact',
			'settings' => 'tutsplus_telephone_setting'
	)));
	
	// email
	$wp_customize->add_setting( 'tutsplus_email_setting', array (
		'default' => __( 'Your email address', 'tutsplus' )
	) );
	$wp_customize->add_control( new Tutsplus_Customize_Textarea_Control(
		$wp_customize,
		'tutsplus_email_setting',
		array( 
			'label' => __( 'Email', 'tutsplus' ),
			'section' => 'tutsplus_contact',
			'settings' => 'tutsplus_email_setting'
	)));
	
	/*******************************************
	Image upload
	********************************************/
	// add the section
	$wp_customize->add_section( 'tutsplus_image_upload', array(
		'title' => __( 'Images', 'tutsplus' )
	));
	
	//logo
	$wp_customize->add_setting( 'tutsplus_logo_upload' );
	$wp_customize->add_control( new WP_Customize_Image_Control(
		$wp_customize,
		'tutsplus_logo_upload',
		array( 
			'label' => __( 'Upload your logo', 'tutsplus' ),
			'section' => 'tutsplus_image_upload',
			'settings' => 'tutsplus_logo_upload'
		)
	));
	
	//logo position
	$wp_customize->add_setting( 'tutsplus_logo_position' );
	$wp_customize->add_control( 'tutsplus_logo_position', array (
		'label' => 'Logo position',
		'section' => 'tutsplus_image_upload',
		'settings' => 'tutsplus_logo_position',
		'type' => 'radio',
		'choices' => array(
			'logo-top' => __( 'Above site title', 'tutsplus' ),
			'logo-left' => __( 'To the left of the site title', 'tutsplus' ),
			'logo-right' => __( 'To the right of the site title', 'tutsplus' ),
			'no-title' => __( 'Replace the site title', 'tutsplus' ),
			'logo-alone' => __( 'Replace the site title and description', 'tutsplus' ),
		)
	));
	
	/*******************************************
	Color scheme
	********************************************/
	// section for colors 
	$wp_customize->add_section( 'tutsplus_colors', array(
		'title' => __( 'Color Scheme', 'tutsplus' )
	));
	
	// main color - site title, h1, h2, h4, widget headings, nav links, footer headings
	$textcolors[] = array(
		'slug' => 'tutsplus_color1',
		'default' => '#333',
		'label' => __( 'Main color', 'tutsplus' )
	);
	
	// secondary color - site description, sidebar headings, h3, h5, nav links on hover
	$textcolors[] = array(
		'slug' => 'tutsplus_color2',
		'default' => '#666',
		'label' => __( 'Secondary color', 'tutsplus' )
	);
	
	// link color
	$textcolors[] = array(
		'slug' => 'tutsplus_links_color1',
		'default' => '#008ab7',
		'label' => __( 'Links color', 'tutsplus' )
	);
	
	// link color on hover
	$textcolors[] = array(
		'slug' => 'tutsplus_links_color2',
		'default' => '#9e4059',
		'label' => __( 'Links color (on hover)', 'tutsplus' )
	);
	
	// add settings and controls for each color
	foreach ( $textcolors as $textcolor ) {
		
		// settings
		$wp_customize->add_setting(
			$textcolor[ 'slug' ], array (
				'default' => $textcolor[ 'default' ],
				'type' => 'option'
			)
		);
		// controls
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize,
			$textcolor[ 'slug' ],
			array (
				'label' => $textcolor[ 'label' ],
				'section' => 'tutsplus_colors',
				'settings' => $textcolor[ 'slug' ]
			)
		));
	}
	
}
add_action( 'customize_register', 'tutsplus_customize_register' );

/**********************************************************************
Add controls / content to theme
**********************************************************************/
function tutsplus_display_contact_details_in_header() {
	
	echo '<address>';
		
		// address
		echo '<p class="address">';
			echo get_theme_mod( 'tutsplus_address_setting', 'Your address' );
		echo '</p>';
		
		// phone number
		echo '<p class="tel">';
			echo get_theme_mod( 'tutsplus_telephone_setting', 'Your telephone number' );
		echo '</p>';
		
		// email
		$email = get_theme_mod( 'tutsplus_email_setting', 'Your email address' );
		echo '<p class="email">';
			echo '<a href="' . $email . '">';
				echo $email;
			echo '</a>';
		echo '</p>';

	
	
	echo '</address>';
}
add_action( 'tutsplus_in_header', 'tutsplus_display_contact_details_in_header' );

/**********************************************************************
display logo in header - activated on tutsplus_header_logo hook
**********************************************************************/
function tutsplus_display_logo_in_header() { ?>
	
	<hgroup class="<?php echo get_theme_mod( 'tutsplus_logo_position' ); ?> site-name half left">
		<!-- site name and description - site name is inside a div element on all pages execpt the front page and/or main blog page, where it is in a h1 element -->
		<h1 id="site-title">
			<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				<img src="<?php echo get_theme_mod( 'tutsplus_logo_upload', 'logo' ); ?>" alt ="logo" />
			</a>
			<span class="text"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
		</h1>
		<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
	</hgroup>
	
<?php }
add_action( 'tutsplus_header_logo' , 'tutsplus_display_logo_in_header' );

/*******************************************************************************
 add styling to theme - attaches to the wp_head hook
 ********************************************************************************/
function tutsplus_add_color_scheme() {
	
	/****************
	define text colors
	****************/
	$color_scheme1 = get_option( 'tutsplus_color1' );
	$color_scheme2 = get_option( 'tutsplus_color2' );
	$link_color1 = get_option( 'tutsplus_links_color1' );
	$link_color2 = get_option ( 'tutsplus_links_color2' );
	
	/**************
	add classes
	**************/
	?>
	
	<style>
	
		/* main color */
		#site-title a,
		h1,
		h2,
		h2.page-title,
		h2.post-title,
		h2 a:link,
		h2 a:visited,
		.menu.main a:link,
		.menu.main a:visited,
		footer h3 {
			color: <?php echo $color_scheme1; ?>;
		}
		
		/* secondary color */
		.menu.main,
		.fatfooter,
		div.main {
			border-top: 1px solid <?php echo $color_scheme2; ?>;
		}
		.fatfooter {
			border-bottom: 1px solid <?php echo $color_scheme2; ?>;			
		}
		
		/* links color */
		a:link,
		a:visited {
			color: <?php echo $link_color1; ?>;
		}
		
		/* links hover color */
		a:hover,
		a:active {
			color: <?php echo $link_color2; ?>;
		}
	
	</style>
	
<?php }
add_action( 'wp_head', 'tutsplus_add_color_scheme' );
