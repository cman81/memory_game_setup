<?php

namespace Drupal\memory_game_setup\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Memory HTTP API Controller Class
 */
class MemoryApiController {
  public function render(Request $request) {
    // sanitize and validate parameters
    $rows = $request->query->get('rows');
    if ($rows < 1 || $rows > 6) {
      return $this::get_error_response();
    }
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

  static function get_error_response() {
    return new JsonResponse([
      'meta' => [
        'success' => FALSE,
        'message' => 'Either "rows" or "columns" needs to be an even number.'
      ],
      'data' => [],
    ]);
  }
}
