<?php
/**
 * @author James Collings <james@jclabs.co.uk>
 * @version 0.1
 */

/**
 * Load files
 */
require_once 'functions.php';
require_once 'shortcodes/shortcodes.php';

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

	$template_file = get_stylesheet_directory() . '/templates/'.$template.'.php';
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