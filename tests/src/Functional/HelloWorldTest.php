<?php

namespace Drupal\memory_game_setup\Tests;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

/**
 * Test case for API request
 * @see https://symfonycasts.com/screencast/rest/testing-phpunit
 */
class HelloWorldTest extends TestCase {
  public function testGET() {
    // create our http client (Guzzle)
    $client = new Client([
      'base_uri' => 'http://localhost:8000',
    ]);

    // check for cardCount: 2 rows x 2 columns = 4 cards
    $response = $client->get('/code-challenge/card-grid?rows=2&columns=2');    
    $json = json_decode($response->getBody(TRUE), TRUE);
    $this->assertEquals(4, $json['meta']['cardCount']);

    // 4 rows x 6 columns = 24 cards
    $response = $client->get('/code-challenge/card-grid?rows=4&columns=6');    
    $json = json_decode($response->getBody(TRUE), TRUE);
    $this->assertEquals(24, $json['meta']['cardCount']);
  }
}
