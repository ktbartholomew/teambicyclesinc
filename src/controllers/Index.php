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
    $this->context['page']->blocks = get_field('blocks', $this->context['page']->id);

    Timber::render('templates/index.twig', $this->context);
  }
}
