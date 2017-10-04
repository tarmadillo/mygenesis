<?php
/**
 * Armadillo Web Design.
 *
 * This file adds functions to the Genesis Sample Theme.
 *
 * @package Armadillo Web Design
 * @author  Tony Armadillo
 * @license GPL-2.0+
 * @link    http://www.armadillowebdesign.com/
 */
namespace TonyArmadillo\Armadillo;

/**
 * Initialize the theme's constants.
 *
 * @since 1.0
 *
 * @return void
 */
function init_constants() {
	$child_theme = wp_get_theme();
	define( 'CHILD_THEME_NAME', $child_theme->get( 'Name' ) );
	define( 'CHILD_THEME_URL', $child_theme->get( 'ThemeURI' ) );
	define( 'CHILD_THEME_VERSION', $child_theme->get( 'Version' ) );
	define( 'CHILD_TEXT_DOMAIN', $child_theme->get( 'TextDomain' ) );
	define( 'CHILD_THEME_DIR', get_stylesheet_directory() );
	define( 'CHILD_CONFIG_DIR', CHILD_THEME_DIR . '/config/' );
}
init_constants();


// Start the engine.
include_once( get_template_directory() . '/lib/init.php' );

// Setup Theme.
include_once( CHILD_THEME_DIR . '/lib/theme-defaults.php' );

add_action( 'after_setup_theme', __NAMESPACE__ . '\localization_setup' );
/**
 * Set Localization (do not remove).
 *
 * @since 1.0
 *
 * @return void
 */
function localization_setup(){
	load_child_theme_textdomain( CHILD_TEXT_DOMAIN, get_stylesheet_directory() . '/languages' );
}

// Add the helper functions.
include_once( CHILD_THEME_DIR . '/lib/helper-functions.php' );

// Add Image upload and Color select to WordPress Theme Customizer.
require_once( CHILD_THEME_DIR . '/lib/customize.php' );

// Include Customizer CSS.
include_once( CHILD_THEME_DIR . '/lib/output.php' );

// Add WooCommerce support.
include_once( CHILD_THEME_DIR . '/lib/woocommerce/woocommerce-setup.php' );

// Add the required WooCommerce styles and Customizer CSS.
include_once( CHILD_THEME_DIR . '/lib/woocommerce/woocommerce-output.php' );

// Add the Genesis Connect WooCommerce notice.
include_once( CHILD_THEME_DIR . '/lib/woocommerce/woocommerce-notice.php' );

include_once( CHILD_THEME_DIR . '/lib/masonry.php' );
include_once( CHILD_THEME_DIR . '/lib/hero.php' );
include_once( CHILD_THEME_DIR . '/lib/theme-defaults.php' );


add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\enqueue_scripts_styles' );
/**
 * Enqueue Scripts and Styles.
 *
 * @since 1.0
 *
 * @return void
 */
function enqueue_scripts_styles() {
    
    wp_enqueue_script( 'global', get_stylesheet_directory_uri() . '/js/global.js', array( 'jquery' ), '1.0.0' );
    
	wp_enqueue_style( CHILD_TEXT_DOMAIN . '-fonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro|Ek+Mukta|Patua+One|Lora:200,400,600,700', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'dashicons' );

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script( CHILD_TEXT_DOMAIN . '-responsive-menu', get_stylesheet_directory_uri() . "/js/responsive-menus{$suffix}.js", array( 'jquery' ), CHILD_THEME_VERSION, true );
	wp_localize_script(
		CHILD_TEXT_DOMAIN . '-responsive-menu',
		'genesis_responsive_menu',
		ta_responsive_menu_settings()
	);

}

/**
 * Define our responsive menu settings.
 *
 * @since 1.0
 *
 * @return void
 */
function ta_responsive_menu_settings() {

	$settings = array(
		'mainMenu'          => __( 'Menu', CHILD_TEXT_DOMAIN ),
		'menuIconClass'     => 'dashicons-before dashicons-menu',
		'subMenu'           => __( 'Submenu', CHILD_TEXT_DOMAIN ),
		'subMenuIconsClass' => 'dashicons-before dashicons-arrow-down-alt2',
		'menuClasses'       => array(
			'combine' => array(
				'.nav-header',
                '.nav-header',
				'.nav-secondary',
			),
			'others'  => array(),
		),
	);

	return $settings;

}

// Add HTML5 markup structure.
add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

// Add Accessibility support.
add_theme_support( 'genesis-accessibility', array( 
    '404-page', 
    'drop-down-menu', 
    'headings', 
    'rems', 
    'search-form', 
    'skip-links' 
) );

// Add viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );

// Enable Logo option in Customizer > Site Identity.
add_theme_support( 'custom-logo', array(
	'height'      => 60,
	'width'       => 200,
	'flex-height' => true,
	'flex-width'  => true,
	'header-text' => array( '.site-title', '.site-description' ),
) );

// Display custom logo.
add_action( 'genesis_site_title', 'the_custom_logo', 0 );

// Add support for custom header.
add_theme_support( 'custom-header', array(
	'header-selector'  => '.hero',
	'header_image'     => get_stylesheet_directory_uri() . '/images/hero.jpg',
	'header-text'      => false,
	'width'            => 1920,
	'height'           => 1080,
	'flex-height'      => true,
	'flex-width'       => true,
	'video'            => true,
	'wp-head-callback' => __NAMESPACE__ . '\custom_header',
) );

// Register default custom header image.
register_default_headers( array(
	'child' => array(
		'url'           => '%2$s/images/hero.jpg',
		'thumbnail_url' => '%2$s/images/hero.jpg',
		'description'   => __( 'Hero Image', CHILD_TEXT_DOMAIN ),
	),
) );

// Add support for custom background.
add_theme_support( 'custom-background' );

// Add support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );

// Add support for 3-column footer widgets.
add_theme_support( 'genesis-footer-widgets', 3 );

// Remove automatic <p> tags
remove_filter( 'the_content', 'wpautop' );
remove_filter('the_excerpt', 'wpautop');
remove_filter('widget_text_content', 'wpautop');

// Rename primary and secondary navigation menus.
add_theme_support( 'genesis-menus', array( 
    'primary'   => __( 'After Header Menu', CHILD_TEXT_DOMAIN ), 
    'secondary' => __( 'Footer Menu', CHILD_TEXT_DOMAIN ) ) );

// Add Image Sizes.
add_image_size( 'featured-image', 720, 400, TRUE );

// Reposition the secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 5 );

add_filter( 'wp_nav_menu_args', __NAMESPACE__ . '\secondary_menu_args' );
/**
 * Reduce the secondary navigation menu to one level depth.
 *
 * @since 1.0
 *
 * @return void
 */
function secondary_menu_args( $args ) {

	if ( 'secondary' != $args['theme_location'] ) {
		return $args;
	}

	$args['depth'] = 1;

	return $args;

}

add_filter( 'genesis_author_box_gravatar_size', __NAMESPACE__ . '\author_box_gravatar' );
/**
 * Modify size of the Gravatar in the author box.
 *
 * @since 1.0
 *
 * @return void
 */
function author_box_gravatar( $size ) {
	return 90;
}

add_filter( 'genesis_comment_list_args', __NAMESPACE__ . '\comments_gravatar' );
/**
 * Modify size of the Gravatar in the entry comments.
 *
 * @since 1.0
 *
 * @return void
 */
function comments_gravatar( $args ) {

	$args['avatar_size'] = 60;

	return $args;

}

add_action( 'genesis_before_entry', __NAMESPACE__ . '\featured_post_image', 8 );
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

// Register widget areas.
genesis_register_sidebar( array(
	'id'          => 'front-page-1',
	'name'        => __( 'Revolution Slider', CHILD_TEXT_DOMAIN ),
	'description' => __( 'This is the front page 1 section.', CHILD_TEXT_DOMAIN ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-2',
	'name'        => __( 'Services', CHILD_TEXT_DOMAIN ),
	'description' => __( 'This is the front page 2 section.', CHILD_TEXT_DOMAIN ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-3',
	'name'        => __( 'Benefits', CHILD_TEXT_DOMAIN ),
	'description' => __( 'This is the front page 3 section.', CHILD_TEXT_DOMAIN ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-4',
	'name'        => __( 'Features', CHILD_TEXT_DOMAIN ),
	'description' => __( 'This is the front page 4 section.', CHILD_TEXT_DOMAIN ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-5',
	'name'        => __( 'Portfolio CTA', CHILD_TEXT_DOMAIN ),
	'description' => __( 'This is the front page 5 section.', CHILD_TEXT_DOMAIN ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-6',
	'name'        => __( 'Blog', CHILD_TEXT_DOMAIN ),
	'description' => __( 'This is the front page 6 section.', CHILD_TEXT_DOMAIN ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-7',
	'name'        => __( 'Contact CTA', CHILD_TEXT_DOMAIN ),
	'description' => __( 'This is the front page 7 section.', CHILD_TEXT_DOMAIN ),
) );


add_action( 'genesis_before', __NAMESPACE__ . '\preloader');
function preloader () {
    echo '<div class="preloader"></div>';
}

