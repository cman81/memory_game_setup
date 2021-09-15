<?php

namespace Drupal\memory_game_setup\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Memory HTTP API Controller Class
 */
class MemoryApiController {
  /**
   * Controller for route: /code-challenge/card-grid
   */
  public function render(Request $request) {
    // sanitize and validate parameters
    $rows = $request->query->get('rows');
    if ($rows < 1 || $rows > 6) {
      return $this::get_error_response();
    }
    $columns = $request->query->get('columns');
    if ($columns < 1 || $columns > 6) {
      return $this::get_error_response();
    }

    $cardCount = $rows * $columns;
    if ($cardCount % 2 == 1) {
      return $this::get_error_response(); 
    }
    
    // return a valid response
    return new JsonResponse([
      'meta' => [
        'success' => TRUE,
        'cardCount' => $cardCount,
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

  /**
   * Make sure we follow these requirements:
   * - The endpoint takes 2 query parameters: rows and columns.
   * - Both parameters are required, should be greater than zero but no greater than 6
   * - At least one of them needs to be an even number.
   * 
   * Otherwise, return this error response.
   */
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
