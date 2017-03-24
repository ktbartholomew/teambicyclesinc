<?php

namespace Theme;

use Timber\Timber;

// Use the composer autoload file for PSR-4 autoloading
require_once(__DIR__ . '/vendor/autoload.php');

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
