<?php
namespace RSSMMW;

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
   <div aria-hidden="true" class="rssmmw-hamburger-bar">
     <span class="rssmmw-icon dashicons dashicons-menu"></span>
   </div>
   <?php
   return ob_get_clean();
  }
  private static function backdrop() {
   ob_start();
   ?><div aria-hidden="true" class="rssmmw-backdrop"></div><?php
   return ob_get_clean();
  }
  private static function mobile_drawer() {
   // if ( !is_active_sidebar('rssmmw-mobile-drawer') ) return;
   ob_start();
   ?>
   <aside aria-hidden="true" class="rssmmw-mobile-drawer">
     <span class="rssmmw-drawer-close rssmmw-icon dashicons dashicons-no"></span>
       <div class="widgets">
       <?php
       dynamic_sidebar('rssmmw-mobile-drawer');
       ?>
     </div>
   </aside>
   <?php
   return ob_get_clean();
  }
}
