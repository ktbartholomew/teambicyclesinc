<?php

namespace Theme;

use Timber\Timber;

// Use the composer autoload file for PSR-4 autoloading
require_once(__DIR__ . '/vendor/autoload.php');

// Don't let users edit theme files from the admin portal
define('DISALLOW_FILE_EDIT', true);
define('DISALLOW_FILE_MODS', true);

new Filters\TimberContext();

new Timber();
Timber::$dirname = 'templates';
