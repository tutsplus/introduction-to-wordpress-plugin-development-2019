<?php
/*
Plugin Name:	Tutsplus Post Type Archive Widget Plugin
Plugin URI:		Creates a new post type and outputs a widget displaying latest posts from that post type.
Description:	Plugin to accompany tutsplus course on Learning Plugin Development.
Version:		1.0
Author:			Rachel McCollin
Author URI:		https://rachelmccollin.com 
TextDomain:		tutsplus
License:		GPLv2
*/

/***************************************************************************
	Register the post type
***************************************************************************/
function tutsplus_register_moon_post_type() {
	
	$labels = array(
		'name' => __( 'Moons', 'tutsplus' ),
		'singular_name' => __( 'Moon', 'tutsplus' ),
		'add_new' => __( 'Add New Moon', 'tutsplus' ),
		'add_new_item' => __( 'Add New Moon', 'tutsplus' ),
		'edit_item' => __( 'Edit Moon', 'tutsplus' ),
		'new_item' => __( 'New Moon', 'tutsplus' ),
		'view_item' => __( 'View Moon', 'tutsplus' ),
		'search_items' => __( 'Search Moons', 'tutsplus' ),
		'not_found' => __( 'No Moons Found', 'tutsplus' ),
		'not_found_in_trash' => __( 'No Moons Found in Trash', 'tutsplus' ),
	);
	
	$args = array(
		'labels' => $labels,
		'has_archive' =>true,
		'public' => true,
		'hierarchical' => false,
		'rewrite' => array( 'slug' => 'moons' ),
		'supports' => array(
			'title',
			'editor',
			'excerpt',
			'custom-fields',
			'thumbnail',
			'page-attributes'
		),
		'taxonomies' => array( 'post_tag', 'category' )
	);
	
	register_post_type( 'tutsplus_moon', $args );
	
	
}
add_action( 'init', 'tutsplus_register_moon_post_type' );


/*************************************************************
Register taxonomies
*************************************************************/
function tutsplus_register_planet_taxonomy() {

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
		'labels' => $labels,
		'show_in_rest' => true	
	);
	register_taxonomy( 'tutsplus_planet', 'tutsplus_moon', $args );

}
add_action( 'init', 'tutsplus_register_planet_taxonomy' );



/***************************************************************************
	Query the Moons post type
***************************************************************************/
function tutsplus_list_moons() {
	
	//query arguments
	$args = array (
		'post_type' => 'tutsplus_moon',
		'posts_per_page' => 5
	);
	
	// run query
	$query = new WP_Query( $args );
	if ( $query->have_posts() ) { ?>
		
		<ul class="moons">
			
			<?php while ( $query->have_posts() ) : $query->the_post(); ?>
			
			<li id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
				<a href="<?php the_permalink(); ?>">
					<?php the_title(); ?>
				</a>
			</li>
			
			<?php endwhile; ?>
			
		</ul>
		
	<?php }
		
	wp_reset_postdata();
	
}



/***************************************************************************
	Create the widget
***************************************************************************/
class tutsplus_Moons_Widget extends WP_Widget {
	
	//widget constructor function
	function __construct() {
		$widget_options = array (
			'classname' => 'tutsplus_moon_widget',
			'description' => 'Display a list of moons, starting with the latest added to the site.'
		);
		parent::__construct( 'tutsplus_moon_widget', 'Moons List', $widget_options );
	}
	
	//function to output the widget form
	function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
	?>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'title'); ?>">Title:</label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
	</p>
	
<?php }
	
	//function to define the data saved by the widget
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		return $instance;
		
	}
	
	//function to display the widget in the site
	function widget( $args, $instance ) {
		
		//define variables
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		
		//output code
		echo $args['before_widget'];
		
		?>
		
		<div class="moons-list">
			
			<?php if ( ! empty( $title ) ) {
				echo $before_title . '<h4 class="widget-title">' . $title . '</h4>' . $after_title;
			}
			else {
				echo $before_title . '<h4 class="widget-title">Moons</h4>' . $after_title;
			};
			
			tutsplus_list_moons();
			
			?>
			
		</div>
		
		<?php 
		echo $args['after_widget'];
		
	}
			
}

//function to register the widget
function tutsplus_register_moons_widget() {
	
	register_widget( 'tutsplus_Moons_Widget' );
	
}
add_action( 'widgets_init', 'tutsplus_register_moons_widget' );


