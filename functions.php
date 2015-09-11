<?php

/**
 * Split string at end of word on or below specified length
 *
 * @param  string  $str
 * @param  integer $length
 * @param  string  $after
 * @return string
 */
function jcc_split_string($str = '', $length = 10, $after = null){

	// escape if string doesnt need shortening
	if(strlen($str) <= $length){
		return $str;
	}

	$temp = substr($str,0, $length);
	$count = strrpos($temp, " ");

	// if cut of point at the end of a word
	if(substr($str, $length, 1) === ' '){
		return substr($str, 0, $length);
	}

	return substr($str, 0, $count) . $after;
}

function jcc_output_wrapper($id = '', $close = false){

	if($close){
		echo '</div><!-- /'. esc_attr( $id ) .' -->';
	}else{
		echo '<div class="' . esc_attr( $id ) .'">';
	}
}

/**
 * Pagination
 */
if(!function_exists('jcc_pagination')){
	function jcc_pagination($pages = '', $range = 2)
	{
		$showitems = ($range * 2)+1;

		global $paged;
		if(empty($paged)) $paged = 1;

		if($pages == '')
		{
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			if(!$pages)
			{
				$pages = 1;
			}
		}

		if(1 != $pages)
		{
			echo "<div class=\"pagination\" role=\"navigation\">\n";
			echo "<p class=\"visuallyhidden\">".__('Pagination', 'native').":</p><div aria-labelledby=\"paginglabel\" >";
			if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
			if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

			for ($i=1; $i <= $pages; $i++)
			{
				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
				{
					echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
				}
			}

			if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";
			if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
			echo "</div>\n</div>\n";
		}
	}
}