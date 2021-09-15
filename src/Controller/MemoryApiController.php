<?php

namespace Drupal\memory_game_setup\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Memory HTTP API Controller Class
 */
class MemoryApiController {
  public function render() {
    return new JsonResponse([
      'data' => 'hello world',
    ]);
  }
}
