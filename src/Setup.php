<?php
namespace PSMMW;

class Setup {
  public static $plugin_root_url;
  private function __construct() {}
  public static function run($plugin_root_url) {
    self::$plugin_root_url = $plugin_root_url;
    add_action('wp_enqueue_scripts', 'PSMMW\Setup::psmmw_load_scripts_and_styles');

    wp_enqueue_style( 'dashicons' );  // Add Dashicons in WordPress Front-end

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
        'callback' => 'PSMMW\Show::run',
      ) );
    } );
  }
  public static function psmmw_load_scripts_and_styles() {
    wp_enqueue_script('psmmw', self::$plugin_root_url . '/scripts/dist/psmmw.js', ['jquery']);
    wp_localize_script('psmmw', 'psmmw_script_vars', array(
      'ajax_url' => site_url( 'wp-json/psmmw/v1/html' ),
      )
    );
    wp_enqueue_style('psmmw', self::$plugin_root_url . '/styles/dist/psmmw.css');
  }
}
