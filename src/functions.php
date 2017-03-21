<?php

namespace Theme;

use Timber\Timber;

require_once(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . '/filters/timber_context.php');

new Timber();
Timber::$dirname = 'templates';
