<?php

namespace Drupal\memory_game_setup\Tests;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class HelloWorldTest extends TestCase {
  public function testGET() {
    // create our http client (Guzzle)
    $client = new Client([
      'base_uri' => 'http://localhost:8000',
    ]);

    $response = $client->get('/code-challenge/card-grid?rows=2&columns=2');

    $this->assertEquals(200, $response->getStatusCode());
  }  
}
