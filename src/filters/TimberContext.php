<?php

namespace Theme\Filters;

use Timber\Menu;
use \add_filter;
use \stdClass;

class TimberContext {
  function __construct() {
    add_filter('timber_context', function ($context) {
      $context['request'] = ['url' => $this->assembleUrl($_SERVER)];
      return $context;
    });

    add_filter('timber_context', function ($context) {
      $context['nav'] = $this->getMenu();
      return $context;
    });
  }

  protected function assembleUrl ($serverInfo) {
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

  protected function getMenu () {
    return new Menu();
  }
}
