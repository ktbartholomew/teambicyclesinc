<?php

namespace Theme\Controllers;

use \Timber\Timber;
use \Timber\Post;
use \Timber\Image;

class Index {
  protected $context;

  function __construct() {
    $this->context = Timber::get_context();
    $this->context['page'] = new Post();

    // Convert image IDs into image objects
    if ($this->context['page']->block_1_image) {
      $this->context['page']->block_1_image = new Image($this->context['page']->block_1_image);
    }
    Timber::render('templates/index.twig', $this->context);
  }
}
