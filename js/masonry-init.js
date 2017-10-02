jQuery(document).ready( function($) {

	//set the container that Masonry will be inside of in a var
	var $container = $( '.content' );

	// initialize Masonry after all images have loaded
	$container.imagesLoaded( function() {
		$container.masonry({
			itemSelector: '.entry',
			isAnimated: true,
			gutterWidth: 0,
		});
	});

});