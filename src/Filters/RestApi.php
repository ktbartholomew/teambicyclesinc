<?php

namespace Theme\Filters;

use Theme\Helpers\GoogleCalendar;
use Exception;
use WP_REST_Response;

class RestApi {
  function __construct() {
    add_action('rest_api_init', function () {
      $this->addRoutes();
    });
  }

  protected function addRoutes() {
    register_rest_route('theme', '/calendar', [
      'methods' => 'GET',
      'callback' => [
        $this,
        'getCalendarEvents'
      ]
    ]);
  }

  public function getCalendarEvents() {
    try {
      $calendar = new GoogleCalendar();
    } catch (Exception $e) {
      return new WP_REST_Response([
        'error' => 'Unable to fetch upcoming events'
      ], 500);
    }

    return new WP_REST_Response($calendar->getEvents());
  }
}
