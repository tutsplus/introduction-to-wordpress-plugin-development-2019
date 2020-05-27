<?php
/*
Plugin Name: 	Tutsplus List Latest Post By Category
Plugin URI: 	https://github.com/rachelmccollin/tutsplus-plugin-development
Description: 	Plugin to accompany tutsplus course on plugin development. Outputs the most recent post in each category with a featured image.
Version: 		4.2
Author: 		Rachel McCollin
Author URI: 	http://rachelmccollin.com
Text Domain: 	tutsplus
License: 		GPLv2
*/

/*********************************************************************************
Enqueue stylesheet
*********************************************************************************/
function tutsplus_category_posts_enqueue_stylesheet() {
	
	wp_register_style( 'category_list_css', plugins_url( 'css/style.css', __FILE__ ));
	wp_enqueue_style( 'category_list_css' );
	
}
add_action( 'wp_enqueue_scripts', 'tutsplus_category_posts_enqueue_stylesheet' );


/***********************************************************************************************
Fetch latest post in up to four catgegories and output them with their featured image
***********************************************************************************************/
function tutsplus_category_post_listing() {
	
	$args = array(
		'orderby' => 'rand',
		'number' => 3
	);
	
	$categories = get_categories( $args );
	
	if ( $categories ) {
	
		$do_not_duplicate[] = 0; ?>
		
		<section class="category-posts">
			
			<?php echo '<h2>' . __( 'Latest Posts', 'tutsplus' ) . '</h2>';
				
			foreach( $categories as $category ) {
				
				$args = array(
					'post_type' => 'post',
					'posts_per_page' => 1,
					'category_name' => $category->name,
					'post__not_in' => $do_not_duplicate
				);
				
				// run query
				$query = new WP_Query( $args );
				if ( $query->have_posts() ) {
					
					while ( $query->have_posts() ) : $query->the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'category-post' ); ?>>
						
						<h3><?php echo $category->name; ?></h3>
						
						<?php if ( has_post_thumbnail() ) { ?>
							
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail( 'medium' ); ?>
							</a>
							
						<?php } ?>
						
						<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
							
						<?php the_excerpt(); ?>
						
					</article>
					
					<?php $do_not_duplicate[] = get_the_ID(); ?>
					
					<?php endwhile; ?>
					
					
				<?php }
					
				wp_reset_postdata();
				
			}
				
			?>
		</section>
		
	<?php }
	
}
add_action( 'tutsplus_after_content', 'tutsplus_category_post_listing' );