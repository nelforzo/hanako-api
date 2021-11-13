<?php

namespace App\Services;

use App\Models\Packages;
use App\Models\Ratings;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RatingService {
  //create or update rating
  public function createRating(Request $request) {

    //validation
    $validator = Validator::make($request->all(), [
      'package_id' => 'required',
      'rating' => 'required|between:0,10',
    ]);

    if ($validator->fails()) {
      return $validator->errors();
    }

    $rating = Ratings::updateOrCreate(
      ['package_id' => $request->input('package_id')],
      ['rating' => $request->input('rating'), 'comment' => $request->input('comment')]
    );
    return $rating;
  }

  //delete stuff rating
  public function deleteRating(Request $request) {

    //validation
    $validator = Validator::make($request->all(), [
      'package_id' => 'required',
    ]);

    if ($validator->fails()) {
      return $validator->errors();
    }

    return Ratings::where('package_id', $request->input('package_id'))->delete();
  }

  // public function getCategoryRating(Request $request) {
  //   //validation
  //   $validator = Validator::make($request->all(), [
  //     'category_id' => 'required',
  //   ]);
  //   if ($validator->fails()) {
  //     return $validator->errors();
  //   }
  //   //get packages in category
  //   $packages = Packages::where('category_id', $request->input('category_id'))->get('id');
  //   return Ratings::whereIn('package_id', $packages)->avg('rating');
  // }

  public function getRatingByPackageId(Request $request) {
    
    //validation
    $validator = Validator::make($request->all(), [
      'package_id' => 'required',
    ]);

    if ($validator->fails()) {
      return $validator->errors();
    }

    Return Ratings::where('package_id', $request->input('package_id'))->get('rating');
  }
}