<?php
namespace PSMMW;

class Show {
  public static $plugin_root_url;
  private function __construct() {}
  public static function run() {
   return [
     'hamburger' => self::hamburger(),
     'backdrop' => self::backdrop(),
     'drawer' => self::mobile_drawer(),
   ];
  }
  private static function hamburger() {
   ob_start();
   ?>
   <div aria-hidden="true" class="psmmw-hamburger-bar">
     <span class="psmmw-icon dashicons dashicons-menu"></span>
   </div>
   <?php
   return ob_get_clean();
  }
  private static function backdrop() {
   ob_start();
   ?><div aria-hidden="true" class="psmmw-backdrop"></div><?php
   return ob_get_clean();
  }
  private static function mobile_drawer() {
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
