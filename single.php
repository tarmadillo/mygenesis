<?php

add_filter( 'the_content', 'wpautop' );

remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

add_action( 'genesis_after_header', 'ta_post_banner' );
/**
 * Full Width Banner Image on Posts page
 *
 * @author Tony Armadillo
 *    
 */
function ta_post_banner() {
    if (is_single()) {
	 ?>

	<div class="blog-banner">
        <div class="blog-heading">
            <h1 class="page-title"><?php echo get_the_title( );?></h1>
        </div>
	</div>

	<?php
    }
}

add_action( 'genesis_before_entry', 'featured_post_image', 8 );
/**
 * Code to Display Featured Image on top of the post
 *
 * @author Tony Armadillo
 *    
 */
function featured_post_image() {
  if ( ! is_singular( 'post' ) )  return;
	the_post_thumbnail('featured-image');
}


genesis();