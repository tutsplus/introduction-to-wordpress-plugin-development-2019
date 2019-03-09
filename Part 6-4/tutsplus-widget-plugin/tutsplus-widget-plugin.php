<?php
/**
* Plugin Name:   Call to Action Widget
* Plugin URI:    https://tutsplus.com/
* Description:   Adds a widget for a call to action box
* Version:       1.0
* Author:        Rachel McCollin
* Author URI:    http://rachelmccollin.com
*
*
*/

/*********************************************************************************
Enqueue stylesheet
*********************************************************************************/
function tutsplus_widget_enqueue_styles() {
	
	wp_register_style( 'widget_cta_css', plugins_url( 'css/style.css', __FILE__ ) );
    wp_enqueue_style( 'widget_cta_css' );
 
}
add_action( 'wp_enqueue_scripts', 'tutsplus_widget_enqueue_styles' );
 
/*********************************************************************************
Widget
*********************************************************************************/
class tutsplus_Cta_Widget extends WP_Widget {
	
	//widget constructor function
	function __construct() {
		$widget_options = array (
			'classname' => 'tutsplus_cta_widget',
			'description' => 'Add a call to action box with your own text and link.'
		);
		parent::__construct( 'tutsplus_cta_widget', 'Call to Action', $widget_options );
	}
	
	//function to output the widget form
	function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$link = ! empty( $instance['link'] ) ? $instance['link'] : 'Your link here';
		$text = ! empty( $instance['text'] ) ? $instance['text'] : 'Your text here';
	?>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'title'); ?>">Title:</label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'text'); ?>">Text in the call to action box:</label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>" value="<?php echo esc_attr( $text ); ?>" />
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'link'); ?>">Your link:</label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" value="<?php echo esc_attr( $link ); ?>" />
	</p>
	
<?php }
	
	//function to define the data saved by the widget
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['text'] = strip_tags( $new_instance['text'] );
		$instance['link'] = strip_tags( $new_instance['link'] );
		return $instance;
		
	}
	
	//function to display the widget in the site
	function widget( $args, $instance ) {
		
		//define variables
		$title = apply_filters( 'widget_title', $instance['title'] );
		$text = $instance['text'];
		$link = $instance['link'];
		
		
		//output code
		echo $args['before_widget'];
		
		?>
		
		<div class="cta">
			
			<?php if ( ! empty( $title ) ) {
				echo $before_title . $title . $after_title;
			};
			
			echo '<a href="' . $link . '">' . $text . '</a>';
			?>
			
		</div>
		
		<?php 
		echo $args['after_widget'];
		
	}
			
}

//function to register the widget
function tutsplus_register_cta_widget() {
	
	register_widget( 'tutsplus_Cta_Widget' );
	
}
add_action( 'widgets_init', 'tutsplus_register_cta_widget' );