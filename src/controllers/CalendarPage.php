<?php

namespace Theme\Controllers;

use Timber\Timber;
use Timber\Post;
use Timber\Image;
use Theme\Helpers\GoogleCalendar;

class CalendarPage {
  function __construct() {
    $context = Timber::get_context();
    $context['page'] = new Post();

    $calendar = new GoogleCalendar();
    $context['events'] = $calendar->getEvents()->items;

    if($context['page']->header_background_image) {
      $context['page']->header_background_image = new Image($context['page']->header_background_image);
    }

    Timber::render('calendar-page.twig', $context);
  }
}
