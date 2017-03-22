<?php

namespace Theme;

use \Timber\Timber;

// This file will be loaded for a number of edge case scenarios for which other
// template files don't exist. Below we try to identify the edge case and render
// a page, but default to showing the 404 page.

if (is_front_page()) {
  new Controllers\Index();
  exit();
}

if (is_page() && get_post()->post_name === 'faqs') {
  new Controllers\FAQPage();
  exit();
}

if (is_page()) {
  new Controllers\Page();
  exit();
}

// If none of the conditions above were met, use the NotFound controller
new Controllers\NotFound();
