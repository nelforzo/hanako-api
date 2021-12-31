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
    
        return $stuff->id;
      }
    
      public function updateStuff(Request $request) {
        //validation
        $validator = Validator::make($request->all(), [
          'name' => 'required',
          'description' => 'required',
        ]);
    
        if ($validator->fails()) {
          return $validator->errors();
        }
    
        $stuff = Stuff::findOrFail($request->input('id'));
    
        $stuff->name = $request->input('name');
        $stuff->description = $request->input('description');
        $stuff->save();
    
        return $stuff->id;
      }
    
      public function getStuff(Request $request, $user_id) {
        $stuff = Stuff::where('user_id', $user_id)->get();
        return $stuff;
      }
    
      public function deleteStuff($id) {
        $stuff = Stuff::findOrFail($id);
        $stuff->delete();
      }
}
