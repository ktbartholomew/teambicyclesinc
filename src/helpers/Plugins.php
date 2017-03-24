<?php

namespace Theme\Helpers;

use GuzzleHttp\Client;
use \ZipArchive;
use \activate_plugin;

class Plugins {
  public static function ensurePlugins() {
    require_once(ABSPATH . 'wp-admin/includes/plugin.php');

    self::ensureACF();
  }

  protected static function ensureACF() {
    $plugin_file = 'advanced-custom-fields-pro/acf.php';
    $tmp_file = '/tmp/acf-pro.zip';

    // If the plugin has already been downloaded, just be sure it's activated
    // and bail out
    if (is_file(WP_PLUGIN_DIR . '/' . $plugin_file)) {
      activate_plugin($plugin_file);
      return;
    }

    // Download the ACF Pro plugin with our license key
    $client = new Client();
    $client->request('GET', 'https://connect.advancedcustomfields.com/index.php', [
      'query' => [
        'p' => 'pro',
        'a' => 'download',
        'k' => getenv('ACF_KEY')
      ],
      'sink' => $tmp_file
    ]);

    // Unzip and delete the .zip file
    $zip_archive = new ZipArchive();
    $zip_file = $zip_archive->open($tmp_file);
    $zip_archive->extractTo(WP_PLUGIN_DIR);
    $zip_archive->close();
    unlink($tmp_file);

    activate_plugin($plugin_file);
  }
}
