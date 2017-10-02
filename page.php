<?php

remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

add_action( 'genesis_after_header', 'ta_page_banner' );
/**
 * Full Width Banner Image on Posts page
 *
 * @author Tony Armadillo
 *    
 */
function ta_page_banner() {
	 ?>

	<div class="blog-banner">
        <div class="blog-heading">
            <h1 class="page-title"><?php echo get_the_title( );?></h1>
        </div>
	</div>

	<?php
}

genesis();