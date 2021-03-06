<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function createUser(Request $request) {
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

    public function updateUser(Request $request, $user_id) {
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
    
        $user = Users::findOrFail($user_id);
    
        return $user->update($request->all());
    }

    public function changePassword(Request $request, $user_id) {
        //validation
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|same:new_password_confirmation',
            'new_password_confirmation' => 'required'
        ]);
    
        if ($validator->fails()) {
            return $validator->errors();
        }
    
        $user = Users::find($user_id);
    
        if ($user != null) {
            if (Hash::check($request->input('old_password'), $user->password_hash)) {
            if ($request->input('new_password') == $request->input('new_password_confirmation')) {
                $user->password_hash = Hash::make($request->input('new_password'));
                
                return $user->save();
            }
            else return config('user_service.new_password_mismatch');
            }
            else return config('user_service.old_password_mismatch');
        }
        else return config('user_service.invalid_user');
    }

    public function delete($user_id) {
        return DB::table('users')->where('id', $user_id)->delete();
    }
}
