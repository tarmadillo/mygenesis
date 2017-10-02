<?php
/**
 * Art Castle.
 *
 * This file adds the masonry effect to the Genesis Theme Blog.
 *
 * 
 *
 * @package 
 * @author  Tony Armadillo
 * @license GPL-2.0+
 * @link    
 */

add_action( 'wp_enqueue_scripts', 'ta_masonry_script' );
/**
 * Enqueue and initialize jQuery Masonry script
 *
 * @since 1.0.0
 *
 * @return void
 */
function ta_masonry_script() {
	if (is_home() || is_archive()) {
	
	    //* Initiate Masonry
	    wp_enqueue_script( 'masonry-init', get_stylesheet_directory_uri().'/js/masonry-init.js' , array( 'jquery-masonry' ), '1.0', true );
			
    	    //* Infinite Scroll
    	    wp_enqueue_script( 'infinite-scroll', get_stylesheet_directory_uri().'/js/jquery.infinitescroll.min.js' , array('jquery'), '1.0', true );
    	    wp_enqueue_script( 'infinite-scroll-init', get_stylesheet_directory_uri().'/js/infinitescroll-init.js' , array('jquery'), '1.0', true );
			
	}
		
}

add_filter( 'body_class', 'ta_blog_body_class' );
/**
 * Add custom body class
 *
 * @since 1.0.0
 *
 * @return void
 */
function ta_blog_body_class( $classes ) {
  if (is_home() || is_archive())
	$classes[] = 'masonry-page';
	return $classes;
		
}

add_action('genesis_meta','ta_masonry_layout');
/**
 * Do masonry actions
 *
 * @since 1.0.0
 *
 * @return void
 */
function ta_masonry_layout() {
	if (is_home() || is_archive()) {
	
	      //* Force full width content layout
	      add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );
				
	      //* Remove archive description
              remove_action( 'genesis_before_loop', 'genesis_do_taxonomy_title_description', 15 );
              //add_action( 'genesis_before_content', 'genesis_do_taxonomy_title_description', 15 );
		
	      //* Reposition author description
              remove_action( 'genesis_before_loop', 'genesis_do_author_title_description', 15 );
              add_action( 'genesis_before_content', 'genesis_do_author_title_description', 15 );
	
	      //* Add featured image
	      remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
	      add_action( 'genesis_entry_header', 'ta_masonry_block_post_image', 2 ) ;
	      function ta_masonry_block_post_image() {
		  $img = genesis_get_image( array( 'format' => 'html', 'size' => 'masonry-image', 'attr' => array( 'class' => 'masonry-image aligncenter' ) ) );
		  printf( '<a href="%s" title="%s">%s</a>', get_permalink(), the_title_attribute( 'echo=0' ), $img );
              }
						
	      //* Reposition post nav
	      remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );
	      add_action( 'genesis_after_content', 'genesis_posts_nav' );
						
	      //* Force content limit
	      add_action( 'genesis_before_loop', 'ta_force_specific_content_archives' );
              function ta_force_specific_content_archives() {
                  add_filter( 'genesis_pre_get_option_content_archive_limit', 'force_content_limit' );
              }
              // Set content limit
              function force_content_limit() {
	               return '320';
              }
						
            add_filter( 'genesis_post_info', 'ta_post_info_filter' );
              function ta_post_info_filter( $post_info ) {
                  $post_info = '[post_date format="d M Y"]';
                  return $post_info;
              }
					
	      // Edit the read more link text
             add_filter('get_the_content_more_link', 'ta_custom_read_more_link');
             add_filter('the_content_more_link', 'ta_custom_read_more_link');
             function ta_custom_read_more_link() {
                  return '<a class="more-link" href="' . get_permalink() . '" rel="nofollow">[Continue Reading...]</a>';
             }
						
	     //* Remove post meta
	     remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
	     remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
	     remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );
						
	}
	
}

add_filter( 'get_the_archive_title', function ($title) {
    if ( is_category() ) {
            $title = single_cat_title( '', false );
        } elseif ( is_tag() ) {
            $title = single_tag_title( '', false );
        } elseif ( is_author() ) {
            $title = '<span class="vcard">' . get_the_author() . '</span>' ;
        } elseif ( is_home() ) {
            $title = 'Blog';
        }

    return $title;

});

add_action( 'genesis_after_header', 'ta_blog_banner' );
/**
 * Full Width Banner Image on Posts page
 *
 * @author Tony Armadillo
 *    
 */
function ta_blog_banner() {
    if (is_home() || is_archive()) {
	 ?>

	<div class="blog-banner">
        <div class="blog-heading">
            <?php the_archive_title( '<h1 class="page-title">', '</h1>' );?>
        </div>
	</div>

	<?php
    }
}

add_action( 'genesis_before_content', 'ta_blog_search', 15 );
/**
 * Add Search Widget to Blog And Archives
 *
 * @author Tony Armadillo
 *    
 */
function ta_blog_search() {
    if (is_home() || is_archive()) {
       
        genesis_widget_area( 'blog-search', array(
            'before' => '<div id="blog-search" class="blog-search clearfix" tabindex="-1">',
            'after'  => '</div>',
        ) );
    }
}