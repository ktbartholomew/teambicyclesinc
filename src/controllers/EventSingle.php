<?php

namespace Theme\Controllers;

use Timber\Timber;
use Timber\Post;
use Timber\Image;

class EventSingle {
  function __construct() {
    $context = Timber::get_context();
    $context['page'] = new Post();

    if($context['page']->header_background_image) {
      $context['page']->header_background_image = new Image($context['page']->header_background_image);
    }

    Timber::render('events/single.twig', $context);
  }
}
