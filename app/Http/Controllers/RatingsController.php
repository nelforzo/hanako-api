<?php

namespace App\Http\Controllers;

use App\Models\Ratings;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RatingsController extends Controller
{
    // TODO this controller is not used yet
    public function createRating(Request $request) {
        //validation
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'stuff_id' => 'required',
            'rating' => 'required',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $rating = new Ratings();

        $rating->user_id = $request->input('user_id');
        $rating->stuff_id = $request->input('stuff_id');
        $rating->rating = $request->input('rating');
        $rating->save();

        return $rating->id;
    }

    public function updateRating(Request $request) {
        //validation
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'user_id' => 'required',
            'stuff_id' => 'required',
            'rating' => 'required',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $rating = Ratings::find($request->input('id'));

        $rating->user_id = $request->input('user_id');
        $rating->stuff_id = $request->input('stuff_id');
        $rating->rating = $request->input('rating');
        $rating->save();

        return $rating->id;
    }

    public function deleteRating($id) {
        $rating = Ratings::find($id);
        return $rating->delete();
    }
}
