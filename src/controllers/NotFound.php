<?php

namespace Theme\Controllers;

use \Timber\Timber;
use \Timber\Post;

class NotFound {
  function __construct() {
    http_response_code(404);
    $context = Timber::get_context();

    Timber::render('404.twig', $context);
  }
}
