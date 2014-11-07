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