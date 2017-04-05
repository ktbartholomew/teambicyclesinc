<?php

namespace Theme;

use Timber\Timber;

// Use the composer autoload file for PSR-4 autoloading
require_once(__DIR__ . '/vendor/autoload.php');

// Set the site URL to whatever is currently being requested
$request_url = Helpers\Request::getRequestUrl();
$site_url = $request_url->protocol . '//' . $request_url->host;

define('WP_SITEURL', $site_url);
define('WP_HOME', $site_url);

// We depend on the advanced-custom-fields-pro plugin, so let’s make sure it's
// installed before moving on.
Helpers\Plugins::ensurePlugins();

// Don't let users edit theme files from the admin portal
define('DISALLOW_FILE_EDIT', true);
define('DISALLOW_FILE_MODS', true);

// Central time, all the time
date_default_timezone_set('America/Chicago');

new Filters\TwigExtensions();
new Filters\TimberContext();
new Filters\RestApi();

new Timber();
Timber::$dirname = 'templates';
