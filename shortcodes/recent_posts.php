<?php
add_shortcode( 'jcc_recent_posts', 'jcc_recent_posts' );
function jcc_recent_posts($atts){

	extract(shortcode_atts( array(
        'limit' => 5,
        'title' => false,
    ), $atts ));

    $posts = new WP_Query(array(
    	'post_type' => 'post',
    	'posts_per_page' => $limit,
    ));

    ob_start();
    
    $content = '';
    
    $before = jcc_get_template_part('recent_posts/before');
    if($before === false){
    	echo '<ul class="recent_posts">';
    }

	while($posts->have_posts()): $posts->the_post(); 

		$template = jcc_get_template_part('recent_posts/content');
		if($template === false){
			?>
			<li>
				<p class="title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</p>
				<div class="excerpt">
					<?php the_excerpt(); ?>
					<a href="<?php the_permalink(); ?>" class="read-more">Read More</a>
				</div>
			</li>
			<?php
		}
		
	endwhile;

	$after = jcc_get_template_part('recent_posts/after');
	if($after === false){
    	echo '</ul>';
    }

    wp_reset_postdata();

    return ob_get_clean();
}