<?php
/**
 * Plugin Name: Gut Check
 * Plugin URI:  https://github.com/m-e-h/gut-check
 * Description: CSS debugger
 * Version:     1.1.0
 * Author:      Marty Helmick
 * Author URI:  https://github.com/m-e-h
 * Text Domain: gut-check
 * Domain Path: /languages
 * License:     GPL2
 */


namespace GutCheck;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'GC_INCLUDES', plugin_dir_path( __FILE__ ) . 'includes/' );
define( 'GC_ASSETS', plugin_dir_url( __FILE__ ) . 'dist/' );

require_once GC_INCLUDES . 'functions-scripts.php';
require_once GC_INCLUDES . 'functions-helpers.php';
require_once GC_INCLUDES . 'functions-customize.php';

// add_action( 'after_setup_theme', function() {
// 	\GutCheck\setup();
// });

Customize\bootstrap();
Scripts\bootstrap();
