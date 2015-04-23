<?php

require_once '../vendor/autoload.php';

use Illuminate\Support\Collection;

$events = new Collection(json_decode(file_get_contents('events.json'), true));

$scores = new Collection([
  'PushEvent' => 5,
  'CreateEvent' => 4,
  'IssuesEvent' => 3,
  'CommitCommentEvent' => 2,
]);

$user_score = $events->map(function ($event) use ($scores) {
  return $scores->get($event['type'], 1);
})->sum(function ($score) {
  return $score;
});

echo "User has a score of {$user_score}\n";
