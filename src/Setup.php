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
        'callback' => 'PSMMW\Setup::psmmw_html',
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
  public static function psmmw_html() {
   return [
     // 'html' => psmmw_html_container(),
     'hamburger' => self::psmmw_html_hamburger(),
     'backdrop' => self::psmmw_html_backdrop(),
     'drawer' => self::psmmw_html_mobile_drawer(),
   ];
  }
  private static function psmmw_html_container() {
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
  private static function psmmw_html_hamburger() {
   ob_start();
   ?>
   <div aria-hidden="true" class="psmmw-hamburger-bar">
     <span class="psmmw-icon dashicons dashicons-menu"></span>
   </div>
   <?php
   return ob_get_clean();
  }
  private static function psmmw_html_backdrop() {
   ob_start();
   ?><div aria-hidden="true" class="psmmw-backdrop"></div><?php
   return ob_get_clean();
  }
  private static function psmmw_html_mobile_drawer() {
   // if ( !is_active_sidebar('psmmw-mobile-drawer') ) return;
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
}
