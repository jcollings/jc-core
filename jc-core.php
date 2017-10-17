<?php
/**
 * @author James Collings <james@jclabs.co.uk>
 * @version 0.1
 */

/**
 * Load files
 */
add_action( 'init', 'jcc_init');

function jcc_init(){
	require_once 'functions.php';
	//require_once 'shortcodes/shortcodes.php';
}

/**
 * Load template file from within theme folder
 *
 * Load required template and pass through variables
 * 
 * @param  string $template 
 * @param  array  $vars     
 * @return boolean
 */
function jcc_get_template_part($template = '', $vars = array()){

	global $posts, $post, $wp_did_header, $wp_query, $wp_rewrite, $wpdb, $wp_version, $wp, $id, $comment, $user_ID;

	$vars = apply_filters('jcc/get_template_part', $vars, $template);

	// check child theme
	$template_file = get_stylesheet_directory() . '/templates/'.$template.'.php';
	if(is_file($template_file)){

		if ( is_array( $wp_query->query_vars ) )
			extract( $wp_query->query_vars, EXTR_SKIP );

		if(is_array($vars))
			extract($vars);

		require $template_file;
		return true;
	}

	// check parent theme
	$template_file = get_template_directory() . '/templates/'.$template.'.php';
	if(is_file($template_file)){

		if ( is_array( $wp_query->query_vars ) )
			extract( $wp_query->query_vars, EXTR_SKIP );

		if(is_array($vars))
			extract($vars);

		require $template_file;
		return true;
	}

	return false;	
}

function jcc_display_content(){
	get_template_part( 'content', apply_filters( 'jcc_override_content', get_post_format() ) );
}
add_action('jcc_content', 'jcc_display_content');

function jc_core() {

	global $jcc_loop_counter;
	$jcc_loop_counter = 0;

	do_action( 'jcc_theme_init' );
	get_header();

	do_action( 'jcc_before_theme_output' ); ?>

	<?php if ( have_posts() ) : ?>

		<?php do_action( 'jcc_before_loop' ); ?>

		<?php while ( have_posts() ): the_post(); $jcc_loop_counter++; ?>

			<?php do_action( 'jcc_before_theme_content' ); ?>

			<?php
			do_action('jcc_content');
			?>

			<?php do_action( 'jcc_after_theme_content' ); ?>

		<?php endwhile; ?>

		<?php do_action( 'jcc_after_loop' ); ?>

	<?php else: ?>
		<?php get_template_part( 'content', apply_filters( 'jcc_override_content_empty', 'none' ) ); ?>

	<?php endif; ?>

	<?php do_action( 'jcc_after_theme_output' ); ?>

	<?php
	get_footer();
}