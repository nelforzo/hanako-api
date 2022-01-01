<?php

namespace App\Http\Controllers;

use App\Models\Stuff;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class StuffController extends Controller
{
    public function createStuff(Request $request) {
        //validation
        $validator = Validator::make($request->all(), [
          'user_id' => 'required|integer',
          'name' => 'required',
          'description' => 'required',
        ]);
    
        if ($validator->fails()) {
          return $validator->errors();
        }
    
        $stuff = new Stuff();
    
        $stuff->user_id = $request->input('user_id');
        $stuff->name = $request->input('name');
        $stuff->description = $request->input('description');
        $stuff->save();
    
        return $stuff;
      }
    
      public function updateStuff(Request $request, $stuff_id) {
        //validation
        $validator = Validator::make($request->all(), [
          'name' => 'required',
          'description' => 'required',
        ]);
    
        if ($validator->fails()) {
          return $validator->errors();
        }
    
        $stuff = Stuff::findOrFail($stuff_id);
        $stuff->update($request->all());
        
        return $stuff;
      }
    
      public function getStuff($user_id) {
        $stuff = Stuff::where('user_id', $user_id)->get();
        return $stuff;
      }
    
      public function deleteStuff($stuff_id) {
        $stuff = Stuff::findOrFail($stuff_id);
        return $stuff->delete();
      }
}
