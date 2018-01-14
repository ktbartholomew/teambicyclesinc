<?php

namespace Theme\Filters;

use Theme\Helpers\Request;
use Twig_SimpleFilter;
use Misd\Linkify\Linkify;

class TwigExtensions {
  function __construct() {
    add_filter('get_twig', function ($twig) {

      $twig->addFilter(new Twig_SimpleFilter('linkify', [$this, 'linkifyFilter']));
      return $twig;
    });
  }

  public function linkifyFilter ($input) {
    $linkify = new Linkify();
    return $linkify->process($input);
  }
}
