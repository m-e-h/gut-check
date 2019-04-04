<?php
/**
 * Gut Check functions and definitions
 *
 * @package Gut_Check
 */

namespace GutCheck;

/**
 * Converts a hex color to RGB.  Returns the RGB values as an array.
 *
 * @param string    hex
 * @return array    rgb value
 */
function hex_to_rgb( $hex ) {

	$color = trim( $hex, '#' );

	if ( strlen( $color ) == 3 ) {

		$r = hexdec( $color[0] . $color[0] );
		$g = hexdec( $color[1] . $color[1] );
		$b = hexdec( $color[2] . $color[2] );

	} elseif ( strlen( $color ) == 6 ) {

		$r = hexdec( $color[0] . $color[1] );
		$g = hexdec( $color[2] . $color[3] );
		$b = hexdec( $color[4] . $color[5] );

	} elseif ( strlen( $color ) == 8 ) {

		$r = hexdec( $color[0] . $color[1] );
		$g = hexdec( $color[2] . $color[3] );
		$b = hexdec( $color[4] . $color[5] );
		$a = hexdec( $color[6] . $color[7] );

		return [ $r, $g, $b, $a ];

	} else {

		return [];

	}

	return [ $r, $g, $b ];
}



