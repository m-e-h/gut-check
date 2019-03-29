<?php
/**
 * Plugin Name: Gut Check
 * Plugin URI:  https://github.com/m-e-h/gut-check
 * Description: CSS debugger
 * Version:     0.1.0
 * Author:      Marty Helmick
 * Author URI:  https://github.com/m-e-h
 * Text Domain: gut-check
 * Domain Path: /languages
 * License:     GPL2
 */


// namespace GutCheck;

defined( 'ABSPATH' ) || exit;

if ( ! defined( 'GC_INCLUDES' ) ) {
	define( 'GC_INCLUDES', plugin_dir_path( __FILE__ ) . 'includes/');
}

if ( ! defined( 'GC_ASSETS' ) ) {
	define( 'GC_ASSETS', plugin_dir_url( __FILE__ ) . 'assets/' );
}

$path = trailingslashit( plugin_dir_path( __FILE__ ) );

require_once( GC_INCLUDES . 'functions-debug.php' );

add_action( 'after_setup_theme', function() {
	\GutCheck\setup();
});

