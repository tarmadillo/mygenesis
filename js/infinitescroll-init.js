jQuery(document).ready( function($) {

	var $container = $( '.content' );

	// fire up my scroll
	$container.infinitescroll({
		navSelector  : '.archive-pagination', // selector for the paged navigation
		nextSelector : '.archive-pagination .pagination-next a', // selector for the NEXT link (to page 2)
		itemSelector : '.content .entry', // selector for all items you'll retrieve
		loading: {
			finishedMsg: "<em>No more posts to load.</em>",
			//img: 'http://websitesetuppro.com/demos/genesis-masonry/wp-content/themes/genesis-sample/js/images/loader.gif',
			msgText: "<em>Loading the next set of posts...</em>",
			speed: 'fast'
		},
	}, function( newElements ) { // trigger Masonry as a callback

		// hide new items while they are loading
		var $newElems = $( newElements ).css({ opacity: 0 });

		// just do layout on imagesLoaded
		$container.imagesLoaded( function() {
			$newElems.animate({ opacity: 1 });
			$container.append( $newElems ).masonry( 'appended', $newElems, true );
		});
	});

});