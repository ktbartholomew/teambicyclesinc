<?php

namespace Theme;

use \add_filter;
use \stdClass;

function assembleUrl ($serverInfo) {
  $url = new stdClass;
  $url->protocol = (! array_key_exists('HTTPS', $_SERVER)) ? 'http:' : 'https:';
  $url->auth = (array_key_exists('PHP_AUTH_USER', $_SERVER)) ? $_SERVER['PHP_AUTH_USER'] : '';
  $url->auth .= (array_key_exists('PHP_AUTH_PW', $_SERVER)) ? ':' . $_SERVER['PHP_AUTH_PW'] : '';
  $url->host = $_SERVER['SERVER_NAME'];
  $url->port = $_SERVER['SERVER_PORT'];
  $url->path = $serverInfo['REQUEST_URI'];
  $url->pathname = (strpos($url->path, '?')) ? strstr($url->path, '?', true) : $url->path;
  $url->search = strstr($url->path, '?');
  $url->query = substr(strstr($url->path, '?'), 1);

  $url->href = $url->protocol . '//' . $url->auth . (($url->auth) ? '@' : '') . $url->host;
    if ($url->protocol === 'http:' && $url->port !== '80') {
      $url->href .= ':' . $url->port;
    }

    if ($url->protocol === 'https:' && $url->port !== '443') {
      $url->href .= ':' . $url->port;
    }

  $url->href .= $url->path;

  return $url;
}

add_filter('timber_context', function ($context) {
  $context['request'] = ['url' => assembleUrl($_SERVER)];

  return $context;
});
