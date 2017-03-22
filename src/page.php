<?php

namespace Theme;

use \Timber\Timber;
use \Timber\Post;
use \Timber\Image;

$context = Timber::get_context();
$context['page'] = new Post();

if (is_front_page()) {
  // Convert image IDs into image objects
  if ($context['page']->block_1_image) {
    $context['page']->block_1_image = new Image($context['page']->block_1_image);
  }
  Timber::render('templates/index.twig', $context);
} else {

  if($context['page']->header_background_image) {
    $context['page']->header_background_image = new Image($context['page']->header_background_image);
  }

  Timber::render('templates/page.twig', $context);
}
