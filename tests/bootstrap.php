<?php
/**
 * PHPUnit bootstrap for Awesome Elements For Elementor.
 *
 * Uses Brain\Monkey to stub WordPress functions so every test runs
 * without a live WP installation or database.
 */

require_once dirname( __DIR__ ) . '/vendor/autoload.php';

// ─── Minimal WordPress stubs ──────────────────────────────────────────────────
// Brain\Monkey sets up Mockery + WP function mocks; we add the few that our
// plugin uses at define-time or in helpers.

use Brain\Monkey;

// plugin_dir_url / plugin_dir_path are called at define()-time inside tools.php,
// so we must define them as global functions BEFORE requiring the plugin file.
if ( ! function_exists( 'plugin_dir_url' ) ) {
    function plugin_dir_url( $file ) {
        return 'http://example.com/wp-content/plugins/awesome-elements-for-elementor/';
    }
}
if ( ! function_exists( 'plugin_dir_path' ) ) {
    function plugin_dir_path( $file ) {
        return dirname( $file ) . '/';
    }
}
if ( ! function_exists( 'wp_register_style' ) ) {
    function wp_register_style( ...$args ) {}
}
if ( ! function_exists( 'wp_register_script' ) ) {
    function wp_register_script( ...$args ) {}
}
if ( ! function_exists( 'wp_enqueue_style' ) ) {
    function wp_enqueue_style( ...$args ) {}
}
if ( ! function_exists( 'wp_enqueue_script' ) ) {
    function wp_enqueue_script( ...$args ) {}
}
if ( ! function_exists( 'add_action' ) ) {
    function add_action( ...$args ) {}
}
if ( ! function_exists( 'esc_html__' ) ) {
    function esc_html__( $text, $domain = 'default' ) { return htmlspecialchars( $text, ENT_QUOTES ); }
}
if ( ! function_exists( 'esc_html' ) ) {
    function esc_html( $text ) { return htmlspecialchars( $text, ENT_QUOTES ); }
}
if ( ! function_exists( 'esc_html_e' ) ) {
    function esc_html_e( $text, $domain = 'default' ) { echo htmlspecialchars( $text, ENT_QUOTES ); }
}
if ( ! function_exists( 'esc_attr' ) ) {
    function esc_attr( $text ) { return htmlspecialchars( $text, ENT_QUOTES ); }
}
if ( ! function_exists( 'esc_url' ) ) {
    function esc_url( $url ) { return filter_var( $url, FILTER_SANITIZE_URL ) ?: ''; }
}
if ( ! function_exists( 'wp_kses' ) ) {
    function wp_kses( $data, $allowed_html ) { return strip_tags( $data ); }
}
if ( ! function_exists( 'wp_kses_post' ) ) {
    function wp_kses_post( $data ) { return $data; }
}
if ( ! function_exists( 'wp_kses_allowed_html' ) ) {
    function wp_kses_allowed_html( $context ) { return []; }
}
if ( ! function_exists( 'wp_json_encode' ) ) {
    function wp_json_encode( $data, $options = 0 ) { return json_encode( $data, $options ); }
}
if ( ! function_exists( 'current_user_can' ) ) {
    function current_user_can( $capability ) { return true; }
}
if ( ! function_exists( 'did_action' ) ) {
    function did_action( $tag ) { return 0; }
}
if ( ! function_exists( 'ABSPATH' ) && ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', dirname( __DIR__, 4 ) . '/' );
}

// Prevent plugin from immediately loading Elementor classes
define( 'AEFE_TESTING', true );
