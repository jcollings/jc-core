<?php
add_shortcode( 'jcc_simple_testimonial', 'jcc_simple_testimonial' );
function jcc_simple_testimonial($atts){

	extract(shortcode_atts( array(
        'testimonial' => false,
        'client' => false
    ), $atts ));

	// public vars for view
    $vars = array(
		'testimonial' => $testimonial,
        'client' => $client
    );

    ob_start();
    
    $content = '';
    
    $before = jcc_get_template_part('simple_testimonial/before', $vars);

    $template = jcc_get_template_part('simple_testimonial/content', $vars);
	if($template === false){
		?>
		<blockquote>
			<p><?php echo $testimonial; ?><span><?php echo $client; ?></span></p>
		</blockquote>
		<?php
	}

	$after = jcc_get_template_part('simple_testimonial/after', $vars);

    return ob_get_clean();
}