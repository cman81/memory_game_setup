<?php

namespace Drupal\memory_game_setup;

/**
 * A service for setting a randomized deck of cards and arranging them into rows and columns.
 * 
 * To build the response you’ll need to come up with a list of at least 18 items of your choice,
 * such as numbers, letters, fruit names, etc (the sample responses below use MCU characters).
 * 
 * The response should contain meta data and a 2-dimensional array with as many rows and columns as
 * the query parameter values.
 * 
 * The array will have a total of ((rows * columns) / 2) unique items repeated twice.
 * 
 * Each item will be placed in a random location every time a request is made.
 */
class MemoryGameService {
  private $rows = 0; // max 6
  private $columns = 0; // max 6
  private $card_count = 0; // max 36
  private $unique_card_count = 0; // max 18 
  private $unique_cards = [
    'Iron Man',
    'Captain America',
    'Hulk',
    'Thor',
    'Black Widow',
    'Hawkeye',
    'Spider Man',
    'Black Panther',
    'Falcon',
    'Vision',
    'Scarlet Witch',
    'Winter Soldier',
    'War Machine',
    'Ant-Man',
    'Star-Lord',
    'Groot',
    'Gamora',
    'Drax',
    'Rocket Raccoon',
  ];
  private $board_state = [];

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
    if (!$this->validate()) {
      return;
    }

    $this->unique_card_count = $this->card_count / 2;
    $this->unique_cards = array_slice($this->unique_cards, 0, $this->unique_card_count);
    $this->buildRandomBoard();
  }

  /**
   * Build the board of cards laid out as specified in rows and columns.
   */
  function buildRandomBoard() {
    $deck = $this->buildAndShuffleDeck();

    for ($row_index = 0; $row_index < $this->rows; $row_index++) {
      for ($column_index = 0; $column_index < $this->columns; $column_index++) {
        $this->board_state[$row_index][$column_index] = array_pop($deck);
      }
    }
  }

  /**
   * Build and shuffle a deck of cards.
   * 
   * Note: The array will have a total of ((rows * columns) / 2) unique items repeated twice.
   * 
   * "As it turns out, the easiest way to implement a shuffle is by sorting... We'll just sort by a
   * random number-- in this case, a GUID."
   * 
   * @see https://blog.codinghorror.com/shuffling/
   */
  function buildAndShuffleDeck(): array {
    $unshuffled_deck = array_merge($this->unique_cards, $this->unique_cards); // repeated twice!
    
    $shuffled_deck = [];
    $uuid_service = \Drupal::service('uuid');
    foreach ($unshuffled_deck as $this_card) {
      $key = $uuid_service->generate();
      $shuffled_deck[$key] = $this_card;
    }

    ksort($shuffled_deck);

    return $shuffled_deck;
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
      // This only occurs when neither rows nor columns are an even number
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

  /**
   * Get the value of unique_cards
   */ 
  public function getUniqueCards(): array {
    return $this->unique_cards;
  }

  /**
   * Get the value of board_state
   */ 
  public function getBoardState(): array {
    return $this->board_state;
  }
}
