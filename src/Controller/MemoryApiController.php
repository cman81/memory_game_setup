<?php

namespace Drupal\memory_game_setup\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Memory HTTP API Controller Class
 */
class MemoryApiController {
  public function render(Request $request) {
    $rows = $request->query->get('rows');
    $columns = $request->query->get('columns');

    return new JsonResponse([
      'meta' => [
        'success' => TRUE,
        'cardCount' => $rows * $columns,
        'uniqueCardCount' => 2,
        'uniqueCards' => ['D', 'G'],
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
