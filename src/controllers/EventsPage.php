<?php

namespace Theme\Controllers;

use Timber\Timber;
use Timber\Post;
use Timber\Image;

class EventsPage {
  function __construct() {
    $context = Timber::get_context();
    $context['page'] = new Post();

    if($context['page']->header_background_image) {
      $context['page']->header_background_image = new Image($context['page']->header_background_image);
    }

    $context['events'] = Timber::get_posts([
      'post_type' => 'tbi_event',
      'order' => 'DESC',
      'orderby' => 'event_date'
    ]);

    Timber::render('events/index.twig', $context);
  }
}
