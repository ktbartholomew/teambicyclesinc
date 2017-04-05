<?php

namespace Theme\Helpers;

use \stdClass;

class Request {
  /**
   * Assembles an object with the different pieces of a URL split out to various
   * properties, like `host`, `path`, `query`, etc.
   *
   * @return object
   */
  public static function getRequestUrl() {
    $url = new stdClass;
    $url->protocol = (! array_key_exists('HTTPS', $_SERVER)) ? 'http:' : 'https:';
    $url->auth = (array_key_exists('PHP_AUTH_USER', $_SERVER)) ? $_SERVER['PHP_AUTH_USER'] : '';
    $url->auth .= (array_key_exists('PHP_AUTH_PW', $_SERVER)) ? ':' . $_SERVER['PHP_AUTH_PW'] : '';
    $url->host = $_SERVER['SERVER_NAME'];
    $url->port = $_SERVER['SERVER_PORT'];
    $url->nonstandard_port = (($url->protocol === 'http:' && $url->port !== '80') || ($url->protocol === 'https:' && $url->port !== '443'));
    $url->path = $_SERVER['REQUEST_URI'];
    $url->pathname = (strpos($url->path, '?')) ? strstr($url->path, '?', true) : $url->path;
    $url->search = strstr($url->path, '?');
    $url->query = substr(strstr($url->path, '?'), 1);

    $url->href = $url->protocol . '//' . $url->auth . (($url->auth) ? '@' : '') . $url->host;
      if ($url->nonstandard_port) {
        $url->href .= ':' . $url->port;
      }

    $url->href .= $url->path;

    return $url;
  }

  /**
   * Returns the HTTP method for the current request
   *
   * @return string
   */
  public static function getRequestMethod() {
    return $_SERVER['REQUEST_METHOD'];
  }
}
