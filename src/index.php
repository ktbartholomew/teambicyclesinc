<?php

namespace Theme;

use \Timber\Timber;

$context = Timber::get_context();
$context['posts'] = Timber::get_posts();

Timber::render('templates/index.twig', $context);
