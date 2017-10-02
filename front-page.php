<?php
/**
 * Altitude Pro.
 *
 * This file adds the front page to the Altitude Pro Theme.
 *
 * @package Altitude
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://my.studiopress.com/themes/altitude/
 */

add_action( 'genesis_meta', 'altitude_front_page_genesis_meta' );
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 * @since 1.0.0
 */
function altitude_front_page_genesis_meta() {

	if ( is_active_sidebar( 'front-page-1' ) || is_active_sidebar( 'front-page-2' ) || is_active_sidebar( 'front-page-3' ) || is_active_sidebar( 'front-page-4' ) || is_active_sidebar( 'front-page-5' ) || is_active_sidebar( 'front-page-6' ) || is_active_sidebar( 'front-page-7' ) ) {

		// Enqueue scripts.
		//add_action( 'wp_enqueue_scripts', 'ta_enqueue_front_script' );

		// Add front-page body class.
		add_filter( 'body_class', 'ta_body_class' );

		// Force full width content layout.
		add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

		// Remove breadcrumbs.
		remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

		// Remove the default Genesis loop.
		remove_action( 'genesis_loop', 'genesis_do_loop' );

		// Add homepage widgets.
		add_action( 'genesis_loop', 'ta_front_page_widgets' );

		// Add featured-section body class.
		if ( is_active_sidebar( 'front-page-1' ) ) {

			// Add image-section-start body class.
			add_filter( 'body_class', 'ta_featured_body_class' );

		}

	}

}



/**
 * // Define front-page body class.
 *
 * @since 1.0.0
 *
 * @return void
 */
function ta_body_class( $classes ) {

	$classes[] = 'front-page';

	return $classes;

}


/**
 * // Define featured-section body class.
 *
 * @since 1.0.0
 *
 * @return void
 */
function ta_featured_body_class( $classes ) {

	$classes[] = 'featured-section';

	return $classes;

}


/**
 * // Add markup for front page widgets.
 *
 * @since 1.0.0
 *
 * @return void
 */
function ta_front_page_widgets() {

	echo '<h2 class="screen-reader-text">' . __( 'Main Content', CHILD_TEXT_DOMAIN ) . '</h2>';

	genesis_widget_area( 'front-page-1', array(
		'before' => '<div id="front-page-1" class="front-page-1" tabindex="-1"><div class="widget-area"><div class="wrap">',
		'after'  => '</div></div></div>',
	) );

	genesis_widget_area( 'front-page-2', array(
		'before' => '<div id="front-page-2" class="front-page-2" tabindex="-1"><div class="white-section"><div class=" widget-area"><div class="wrap">',
		'after'  => '</div></div></div></div>',
	) );

	genesis_widget_area( 'front-page-3', array(
		'before' => '<div id="front-page-3" class="front-page-3" tabindex="-1"><div class="blue-section"><div class="widget-area"><div class="wrap">',
		'after'  => '</div></div></div></div>',
	) );

	genesis_widget_area( 'front-page-4', array(
		'before' => '<div id="front-page-4" class="front-page-4" tabindex="-1"><div class="white-section"><div class="widget-area"><div class="wrap">',
		'after'  => '</div></div></div></div>',
	) );

	genesis_widget_area( 'front-page-5', array(
		'before' => '<div id="front-page-5" class="front-page-5" tabindex="-1"><div class="blue-section"><div class="widget-area"><div class="wrap">',
		'after'  => '</div></div></div></div>',
	) );
    
    genesis_widget_area( 'front-page-6', array(
		'before' => '<div id="front-page-6" class="front-page-6" tabindex="-1"><div class="white-section"><div class="widget-area"><div class="wrap">',
		'after'  => '</div></div></div></div>',
	) );
    
	genesis_widget_area( 'front-page-7', array(
		'before' => '<div id="front-page-7" class="front-page-7" tabindex="-1"><div class="image-section"><div class="widget-area"><div class="wrap">',
		'after'  => '</div></div></div></div>',
	) );

	

}

// Run the Genesis loop.
genesis();
