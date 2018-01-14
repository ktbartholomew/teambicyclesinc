<?php

namespace Theme\Helpers;

use \DateTime;
use \DateTimeZone;
use \Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;


class GoogleCalendar {
  protected $calendar_id = '';

  protected $api_key = '';

  protected static $calendar_base_url = 'https://www.googleapis.com/calendar/v3/calendars';

  function __construct() {
    $this->calendar_id = constant('GOOGLE_CALENDAR_ID');
    $this->api_key = constant('GOOGLE_API_KEY');

    if ($this->calendar_id === false) {
      throw new Exception('Environment variable GOOGLE_CALENDAR_ID not set');
    }

    if ($this->api_key === false) {
      throw new Exception('Environment variable GOOGLE_API_KEY not set');
    }
  }

  public function getEvents() {
    $client = new Client();

    try {
      $res = $client->request(
        'GET',
        self::$calendar_base_url . '/' . $this->calendar_id . '/events',
        [
          'query' => [
            'singleEvents' => 'true',
            'orderBy' => 'startTime',
            'timeMin' => $this->getEventLowerLimitTime(),
            'key' => $this->api_key
          ]
        ]
      );
    } catch (ClientException $e) {
      return [
        'events' => []
      ];
    }


    // Read and decode the response body
    $result = (string) $res->getBody();
    $result = json_decode($result);

    return $result;
  }

  private function getEventLowerLimitTime() {
    $minimum_event_time = new DateTime();
    $minimum_event_time->setTime(0,0,0);
    $minimum_event_time->setTimezone(new DateTimeZone('America/Chicago'));

    return $minimum_event_time->format(DateTime::RFC3339);
  }
}
