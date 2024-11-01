<?php
/**
 * Plugin Name: Zelish Recipe Shopper
 * Plugin URI: https://zelish.in/zelish-recipe-shopper
 * Description: Zelish Shop Recipe plugin for recipe ingredients.
 * Version: 1.0.0
 * Author: rakeshzelish
 * Author URI: https://zelish.in/
 * Text Domain: skullzlsh
 * Domain Path: /languages
 * Requires at least: 3.7
 * Tested up to: 5.7.1
 * Requires PHP: 5.0
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 * @package zelish-recipe-shopper
 */

defined( 'ABSPATH' ) || exit;

if ( ! defined( 'SKULLZISH_ZELISH_PLUGIN_FILE' ) ) {
	define( 'SKULLZISH_ZELISH_PLUGIN_FILE', __FILE__ );
}


// Include the main ZELISHMAIN class.
if ( ! class_exists( 'SKULLZISH_ZELISH\ZELISHMAIN', false ) ) {
	include_once dirname( SKULLZISH_ZELISH_PLUGIN_FILE ) . '/includes/class-skullzlsh-zelish.php';
}

add_action( 'plugins_loaded', 'skullzlsh_load_plugin_textdomain' );

if ( ! function_exists( 'skullzlsh_load_plugin_textdomain') ) { 
function skullzlsh_load_plugin_textdomain() {

		load_plugin_textdomain(
			'skullzlsh',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}
}

/**
 * Returns the main instance of ZELISHMAIN.
 *
 *
 * @return ZELISHtech
 */
function skullzlsh_zelish() { 
	return new SKULLZISH_ZELISH\ZELISHMAIN();
}

// Global for backwards compatibility.
$GLOBALS['skullzlsh_zelish'] = skullzlsh_zelish();
