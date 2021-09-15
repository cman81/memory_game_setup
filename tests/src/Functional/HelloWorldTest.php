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

    // check for cardCount: 2 rows x 2 columns = 4 cards (2 unique)
    $response = $client->get('/code-challenge/card-grid?rows=2&columns=2');    
    $json = json_decode($response->getBody(TRUE), TRUE);
    $this->assertEquals(4, $json['meta']['cardCount']);
    $this->assertEquals(2, $json['meta']['uniqueCardCount']);
    $this->assertCount(2, $json['meta']['uniqueCards']);

    // 4 rows x 6 columns = 24 cards (12 unique)
    $response = $client->get('/code-challenge/card-grid?rows=4&columns=6');    
    $json = json_decode($response->getBody(TRUE), TRUE);
    $this->assertEquals(24, $json['meta']['cardCount']);
    $this->assertEquals(12, $json['meta']['uniqueCardCount']);
    $this->assertCount(12, $json['meta']['uniqueCards']);

    // handle nonsense input
    $response = $client->get('/code-challenge/card-grid');    
    $json = json_decode($response->getBody(TRUE), TRUE);
    $this->assertFalse($json['meta']['success']);

    // 3 rows x 5 columns = 15 cards. We should not allow this
    $response = $client->get('/code-challenge/card-grid?rows=3&columns=5');    
    $json = json_decode($response->getBody(TRUE), TRUE);
    $this->assertFalse($json['meta']['success']);

    // can't have more than 6 rows or 6 columns
    $response = $client->get('/code-challenge/card-grid?rows=2&columns=7');    
    $json = json_decode($response->getBody(TRUE), TRUE);
    $this->assertFalse($json['meta']['success']);
    $response = $client->get('/code-challenge/card-grid?rows=7&columns=2');    
    $json = json_decode($response->getBody(TRUE), TRUE);
    $this->assertFalse($json['meta']['success']);
  }
}
