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

  /**
   * Factory for making a new game.
   * 
   * @see https://stackoverflow.com/a/2175213/5257902
   */
  public static function makeNewWithRowsAndCols(int $r, int $c): MemoryGameService {
      $obj = new MemoryGameService();
      $obj->setupGame($r, $c);

      return $obj;
  }

  /**
   * Accept parameters for setting up a new game.
   */
  public function setupGame(int $r, int $c) {
    $this->rows = $r;
    $this->columns = $c;
    $this->card_count = $r * $c;
    $this->unique_card_count = $this->card_count / 2;
  }

  /**
   * Make sure we follow these requirements:
   * - The endpoint takes 2 query parameters: rows and columns.
   * - Both parameters are required, should be greater than zero but no greater than 6
   * - At least one of them needs to be an even number.
   */
  public function validate(): bool {
    if ($this->rows < 1 || $this->rows > 6) {
      return FALSE;
    }
    if ($this->columns < 1 || $this->columns > 6) {
      return FALSE;
    }
    if ($this->card_count % 2 == 1) {
      // This only occurs when rows and columns are odd
      return FALSE;
    }

    return TRUE;
  }

  /**
   * Get the value of card_count
   */ 
  public function getCardCount(): int {
    return $this->card_count;
  }

  /**
   * Get the value of unique_card_count
   */ 
  public function getUniqueCardCount(): int {
    return $this->unique_card_count;
  }
}
