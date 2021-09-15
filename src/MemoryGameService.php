<?php

namespace Drupal\memory_game_setup;

/**
 * A service for setting a randomized deck of cards and arranging them into rows and columns.
 */
class MemoryGameService {
  private $rows = 0;
  private $columns = 0;
  private $card_count = 0;
  private $unique_card_count = 0;

  public function setupGame(int $r, int $c) {
    $rows = $r;
    $columns = $c;
  }
}
