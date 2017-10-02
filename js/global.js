/**
 * This script adds the jquery effects to the theme header.
 *
 * @package My Genesis\JS
 * @author Tony Armadillo
 * @license GPL-2.0+
 */


jQuery(function( $ ){

	// Add opacity class to site header.
	$( document ).on('scroll', function(){

		if ( $( document ).scrollTop() > 0 ){
			$( '.site-header' ).addClass( 'dark' );

		} else {
			$( '.site-header' ).removeClass( 'dark' );
		}

	});

});