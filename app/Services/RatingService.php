<?php

namespace App\Services;

use App\Models\StuffRatings;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class RatingService {
  //create or update rating
  public function rateStuff($stuffId, $rating, $comment) {
    $rating = StuffRatings::updateOrCreate(
      ['stuff_id' => $stuffId],
      ['rating' => $rating, 'comment' => $comment]
    );
    return $rating;
  }

  //delete stuff rating
  public function deleteRating($stuffId) {
    return StuffRatings::where('stuff_id', $stuffId)->delete();
  }
}