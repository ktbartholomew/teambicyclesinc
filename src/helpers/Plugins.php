<?php

namespace Theme\Helpers;

use \activate_plugin;

class Plugins {
  public static function ensurePlugins() {
    require_once(ABSPATH . 'wp-admin/includes/plugin.php');

    self::ensureACF();
  }

  protected static function ensureACF() {
    $plugin_file = 'advanced-custom-fields-pro/acf.php';
    activate_plugin($plugin_file);
  }
}
