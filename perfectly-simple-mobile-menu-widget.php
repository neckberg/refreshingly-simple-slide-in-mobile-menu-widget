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
 * @package           PSMMW
 *
 * @wordpress-plugin
 * Plugin Name:       Perfectly Simple Mobile Menu Widget
 * Plugin URI:        TODO: <link to github repo>
 * Description:       Simple slide-in mobile hamburger menu with widget area
 * Version:           1.0.0
 * Author:            Nathan Eckberg
 * Author URI:        https://nathaneckberg.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       psmmw
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

require plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';

// wp_enqueue_script('slick', get_stylesheet_directory_uri() . '/resources/js/slick.js', array(), true );

add_action('wp_enqueue_scripts', 'psmmw_load_scripts_and_styles');
function psmmw_load_scripts_and_styles() {
  wp_enqueue_script('psmmw', plugin_dir_url( __FILE__ ) . '/scripts/dist/psmmw.js');
	wp_localize_script('psmmw', 'pw_script_vars', array(
			// 'alert' => __('Hey! You have clicked the buttons!', 'psmmw'),
      'ajax_url' => site_url( 'wp-json/psmmw/v1/html' ),
		)
	);
  wp_enqueue_style('psmmw', plugin_dir_url( __FILE__ ) . '/styles/dist/psmmw.css');
}

register_sidebar([
  'name'          => 'PSMMW Mobile Drawer',
  'id'            => 'psmmw-mobile-drawer',
  'before_widget' => '<div class="widget">',
  'after_widget'  => '</div>',
  'before_title'  => '<h3>',
  'after_title'   => '</h3>',
]);


add_action( 'rest_api_init', function () {
  register_rest_route( 'psmmw/v1', '/html', array(
    'methods' => 'GET',
    'callback' => 'psmmw_html',
  ) );
} );
function psmmw_html($parameters) {
  return [
    // 'html' => psmmw_html_container(),
    'hamburger' => psmmw_html_hamburger(),
    'backdrop' => psmmw_html_backdrop(),
    'drawer' => psmmw_html_mobile_drawer(),
  ];
}
function psmmw_html_container() {
  ob_start();
  ?>
  <div aria-hidden="true" class="psmmw-container">
    <?php
    echo psmmw_html_hamburger();
    echo psmmw_html_backdrop();
    echo psmmw_html_mobile_drawer();
    ?>
  </div>
  <?php
  return ob_get_clean();
}
function psmmw_html_hamburger() {
  ob_start();
  ?>
  <div aria-hidden="true" class="psmmw-hamburger-bar">
    <span class="psmmw-icon dashicons dashicons-menu"></span>
  </div>
  <?php
  return ob_get_clean();
}
function psmmw_html_backdrop() {
  ob_start();
  ?><div aria-hidden="true" class="psmmw-backdrop"></div><?php
  return ob_get_clean();
}
function psmmw_html_mobile_drawer() {
  if ( !is_active_sidebar('psmmw-mobile-drawer') ) return;
  ob_start();
  ?>
  <aside aria-hidden="true" class="psmmw-mobile-drawer">
    <span class="psmmw-drawer-close psmmw-icon dashicons dashicons-no"></span>
      <div class="widgets">
      <?php
      dynamic_sidebar('psmmw-mobile-drawer');
      ?>
    </div>
  </aside>
  <?php
  return ob_get_clean();
}
