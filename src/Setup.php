<?php
namespace RSSMMW;

class Setup {
  public static $plugin_root_url;
  private function __construct() {}
  public static function run($plugin_root_url) {
    self::$plugin_root_url = $plugin_root_url;
    add_action('wp_enqueue_scripts', 'RSSMMW\Setup::rssmmw_load_scripts_and_styles');

    wp_enqueue_style( 'dashicons' );  // Add Dashicons in WordPress Front-end

    register_sidebar([
      'name'          => 'RSSMMW Mobile Drawer',
      'id'            => 'rssmmw-mobile-drawer',
      'before_widget' => '<div class="widget">',
      'after_widget'  => '</div>',
      'before_title'  => '<h3>',
      'after_title'   => '</h3>',
    ]);

    add_action( 'rest_api_init', function () {
      register_rest_route( 'rssmmw/v1', '/html', array(
        'methods' => 'GET',
        'callback' => 'RSSMMW\Show::run',
      ) );
    } );
  }
  public static function rssmmw_load_scripts_and_styles() {
    wp_enqueue_script('rssmmw', self::$plugin_root_url . '/scripts/dist/rssmmw.js', ['jquery']);
    wp_localize_script('rssmmw', 'rssmmw_script_vars', array(
      'ajax_url' => site_url( 'wp-json/rssmmw/v1/html' ),
      )
    );
    wp_enqueue_style('rssmmw', self::$plugin_root_url . '/styles/dist/rssmmw.css');
  }
}
