# memory_game_setup
A Drupal 8 module that provides an HTTP API endpoint for building a memory game.

## Testing
:warning: Make sure this module is enabled before testing.

I configured the test to use my local dev site was located at `http://localhost:8000`

This can be changed on line 16 of [HelloWorldTest.php](tests/src/Functional/HelloWorldTest.php)

I used the following command: `php vendor/bin/phpunit tests/src/Functional/HelloWorldTest.php`

## Sample Request
`http://localhost:8000/code-challenge/card-grid?rows=3&columns=2`

## Sample Response
```json
{
  "meta": {
    "success": true,
    "cardCount": 6,
    "uniqueCardCount": 3,
    "uniqueCards": ["Iron Man", "Captain America", "Hulk"]
  },
  "data": {
    "cards": [
      ["Iron Man", "Hulk"],
      ["Captain America", "Captain America"],
      ["Hulk", "Iron Man"]
    ]
  }
}
```
