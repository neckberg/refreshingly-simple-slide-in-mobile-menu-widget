<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://nathaneckberg.com/perfectly-simple-mobile-menu-widget
 * @since             1.0.0
 * @package           RSSMMW
 *
 * @wordpress-plugin
 * Plugin Name:       Refreshingly Simple Slide-in Mobile Menu Widget
 * Plugin URI:        TODO: <link to github repo>
 * Description:       Simple slide-in mobile hamburger menu with widget area
 * Version:           1.0.0
 * Author:            Nathan Eckberg
 * Author URI:        https://nathaneckberg.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       rssmmw
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

require plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';

$setup = RSSMMW\Setup::run( plugin_dir_url( __FILE__ ) );
