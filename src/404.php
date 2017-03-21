<?php

namespace Theme;

use \Timber\Timber;
use \Timber\Post;

$context = Timber::get_context();
$context['page'] = new Post();

Timber::render('templates/404.twig', $context);
