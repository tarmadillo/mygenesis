/**
 * This script adds the jquery effects to the theme.
 *
 * @package My Genesis\JS
 * @author Tony Armadillo
 * @license GPL-2.0+
 */

jQuery(function( $ ){
    
    preLoader($);
	headerColor($);

});

function preLoader( $ ){
    $(window).load(function(){
        $('.preloader').fadeOut('slow', function() {
         
        });
    });
}

function headerColor( $ ){
    // Add opacity class to site header.
	$( document ).on('scroll', function(){

		if ( $( document ).scrollTop() > 0 ){
			$( '.site-header' ).addClass( 'dark' );

		} else {
			$( '.site-header' ).removeClass( 'dark' );
		}

	});
}