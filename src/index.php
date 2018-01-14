<?php

namespace Theme;

use Theme\Helpers\Request;
use Theme\Controllers;
use Timber\Timber;

header('cache-control: public, max-age=1200');

// This file will be loaded for a number of edge case scenarios for which other
// template files don't exist. Below we try to identify the edge case and render
// a page, but default to showing the 404 page.

$requestUrl = Request::getRequestUrl();

if (is_front_page()) {
  new Controllers\Index();
  exit();
}

if (is_page() && get_post()->post_name === 'faqs') {
  new Controllers\FAQPage();
  exit();
}

if (is_page() && get_post()->post_name === 'events') {
  new Controllers\EventsPage();
  exit();
}

if (is_single() && get_post_type() === 'tbi_event') {
  new Controllers\EventSingle();
  exit();
}

if (is_page() && get_post()->post_name === 'calendar') {
  new Controllers\CalendarPage();
  exit();
}

if (is_page()) {
  new Controllers\Page();
  exit();
}

// If none of the conditions above were met, use the NotFound controller
new Controllers\NotFound();
