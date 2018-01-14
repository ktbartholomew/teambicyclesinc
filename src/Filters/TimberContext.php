<?php

namespace Theme\Filters;

use Theme\Helpers\Request;
use Timber\Menu;
use \add_filter;

class TimberContext {
  function __construct() {
    add_filter('timber_context', function ($context) {
      $context['request'] = ['url' => Request::getRequestUrl()];
      return $context;
    });

    add_filter('timber_context', function ($context) {
      $context['nav'] = new Menu();
      return $context;
    });
  }

  protected function getMenu () {
    return new Menu();
  }
}
