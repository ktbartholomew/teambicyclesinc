<?php

define('DB_NAME', 'wordpress');
define('DB_USER', 'root');
define('DB_PASSWORD', 'password');
define('DB_HOST', 'db');
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', '');

define('AUTH_KEY',         'insecure');
define('SECURE_AUTH_KEY',  'insecure');
define('LOGGED_IN_KEY',    'insecure');
define('NONCE_KEY',        'insecure');
define('AUTH_SALT',        'insecure');
define('SECURE_AUTH_SALT', 'insecure');
define('LOGGED_IN_SALT',   'insecure');
define('NONCE_SALT',       'insecure');

$table_prefix  = 'wp_';
define('WP_DEBUG', true);

if ( !defined('ABSPATH') )
  define('ABSPATH', dirname(__FILE__) . '/');
require_once(ABSPATH . 'wp-settings.php');

// This is slightly broken because the previous theme's templates will still
// be used for the first request after this command is applied. After that it's
// business as usual.
switch_theme('theme');
