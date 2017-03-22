<?php

namespace Theme\Controllers;

use \Timber\Timber;
use \Timber\Post;
use \Timber\Image;

class FAQPage {
  function __construct() {
    $context = Timber::get_context();
    $context['page'] = new Post();
    $context['faqs'] = Timber::get_posts([
      'post_type' => 'post',
      'category' => 'faqs',
      'order' => 'ASC',
      'orderby' => 'date'
    ]);

    if($context['page']->header_background_image) {
      $context['page']->header_background_image = new Image($context['page']->header_background_image);
    }

    Timber::render('faq-page.twig', $context);
  }
}
