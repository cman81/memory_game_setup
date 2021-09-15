<?php

namespace Drupal\memory_game_setup\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\memory_game_setup\MemoryGameService;

/**
 * Memory HTTP API Controller Class
 */
class MemoryApiController {
  /**
   * Controller for route: /code-challenge/card-grid
   */
  public function render(Request $request) {
    $game = MemoryGameService::makeNewWithRowsAndCols(
      $request->query->get('rows') ?? 0,
      $request->query->get('columns') ?? 0
    );

    if (!$game->validate()) {
      return $this::get_error_response();
    }
    
    // return a valid response
    return new JsonResponse([
      'meta' => [
        'success' => TRUE,
        'cardCount' => $game->getCardCount(),
        'uniqueCardCount' => $game->getUniqueCardCount(),
        'uniqueCards' => $game->getUniqueCards(),
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
