<?php

namespace Drupal\memory_game_setup\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Memory HTTP API Controller Class
 */
class MemoryApiController {
  public function render() {
    return new JsonResponse([
      'meta' => [
        'success' => TRUE,
        'cardCount' => 4,
        'uniqueCardCount' => 2,
        'uniqueCards' => ['D', 'G']
      ],
      'data' => [
        'cards' => [
          ['D', 'G'],
          ['G', 'D'],
        ]
      ],
    ]);
  }
}
