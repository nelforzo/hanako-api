<?php

namespace App\Services;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CategoriesService {
  public function createCategory(Request $request) {

    //validation
    $validator = Validator::make($request->all(), [
      'first_name' => 'required',
      'last_name' => 'required',
      'first_name_kana' => 'required',
      'last_name_kana' => 'required',
      'mail_address' => 'required|email:rfc,dns|unique:users',
      'password' => 'required|same:password_confirmation',
      'password_confirmation' => 'required'
    ]);

    if ($validator->fails()) {
      return $validator->errors();
    }

    $user = new Users();
    
    $user->first_name = $request->input('first_name');
    $user->last_name = $request->input('last_name');
    $user->first_name_kana = $request->input('first_name_kana');
    $user->last_name_kana = $request->input('last_name_kana');
    $user->mail_address = $request->input('mail_address');
    if($request->input('password') == $request->input('password_confirmation')) {
      $user->password_hash = Hash::make($request->input('password'));
    }
    $user->save();
    
    return $user->id;
  }

  public function updateCategory(Request $request, $id) {

    //validation
    $validator = Validator::make($request->all(), [
      'first_name' => 'required',
      'last_name' => 'required',
      'first_name_kana' => 'required',
      'last_name_kana' => 'required',
      'mail_address' => 'required|email:rfc,dns|unique:users',
    ]);

    if ($validator->fails()) {
      return $validator->errors();
    }

    $user = Users::findOrFail($id);

    return $user->update($request->all());
  }

  public function deleteCategory($id) {
    return DB::table('users')->where('id', $id)->delete();
  }
}