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

    // does this page exist?
    $response = $client->get('/code-challenge/card-grid?rows=2&columns=2');
    $this->assertEquals(200, $response->getStatusCode());
    
    // The endpoint takes 2 query parameters: rows and columns.
    $json = json_decode($response->getBody(TRUE), TRUE);
    $this->assertArrayHasKey('data', $json);
    $this->assertArrayHasKey('meta', $json);
  }
}
