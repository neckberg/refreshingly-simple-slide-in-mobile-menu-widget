<?php
namespace PSMMW;
// error_log(__FILE__);

class Setup {
   private function __construct() {}
   public static function run() {
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

}
