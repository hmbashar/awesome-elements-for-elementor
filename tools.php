<?php
/*
 * Plugin Name: Awesome Elements For Elementor
 * Description: This plugin for elements widget for elementor
 * Version: 1.3
 * Author: Md Abul Bashar
 * Author URI: https://www.facebook.com/hmbashar/
 * Text Domain: aefe
 * Elementor tested up to:     3.6.8
 * Elementor Pro tested up to: 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Plugin constants
define( 'AEFE_VERSION',    '1.3' );
define( 'AEFE_URL',        plugin_dir_url( __FILE__ ) );
define( 'AEFE_PATH',       plugin_dir_path( __FILE__ ) );
define( 'AEFE_TEXTDOMAIN', 'aefe' );


function aefe_plugin_general_init() {

	// Load plugin files
	require_once( AEFE_PATH . '/elementor-addon/includes/elementor-configuration.php' );
	require_once( AEFE_PATH . '/inc/hooks.php' );

	// Run the plugin
	\AEFE_ELEMENTOR\Plugin::instance();

}
add_action( 'plugins_loaded', 'aefe_plugin_general_init' );


/**
 * Register (but do NOT globally enqueue) plugin assets.
 *
 * Individual widgets declare what they need via get_style_depends() /
 * get_script_depends(), so assets are only loaded on pages that actually
 * use the widgets.
 */
function aefe_register_assets() {
	wp_register_style( 'aefe-owlcarousel', AEFE_URL . 'assets/css/owl.carousel.min.css', [],              AEFE_VERSION );
	wp_register_style( 'aefe-barfilter',   AEFE_URL . 'assets/css/barfilter.css',         [],              AEFE_VERSION );
	wp_register_style( 'aefe-main',        AEFE_URL . 'assets/css/style.css',             [],              AEFE_VERSION );
	wp_register_style( 'aefe-responsive',  AEFE_URL . 'assets/css/responsive.css',        [ 'aefe-main' ], AEFE_VERSION );

	wp_register_script( 'aefe-owlcarousel', AEFE_URL . 'assets/js/owl.carousel.min.js', [ 'jquery' ],                     AEFE_VERSION, true );
	wp_register_script( 'aefe-main',        AEFE_URL . 'assets/js/main.js',             [ 'jquery', 'aefe-owlcarousel' ], AEFE_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'aefe_register_assets' );


// Add custom Elementor widget category
function aefe_add_elementor_widget_categories( $elements_manager ) {

	$elements_manager->add_category(
		'aefe-category',
		[
			'title' => esc_html__( 'Awesome Elements', 'aefe' ),
			'icon'  => 'fa fa-plug',
		]
	);

}
add_action( 'elementor/elements/categories_registered', 'aefe_add_elementor_widget_categories' );
