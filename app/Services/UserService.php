<?php

namespace App\Services;

use App\Models\Users;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserService {
  public function createUser($firstName, $lastName, $firstNameKana, $lastNameKana, $mailAddress, $password) {
    $user = new Users();
    
    $user->first_name = $firstName;
    $user->last_name = $lastName;
    $user->first_name_kana = $firstNameKana;
    $user->last_name_kana = $lastNameKana;
    $user->mail_address = $mailAddress;
    $user->password_hash = Hash::make($password);
    $user->save();
    
    return $user->id;
  }

  public function updateUser($id, $firstName, $lastName, $firstNameKana, $lastNameKana, $mailAddress) {
    $user = Users::find($id);

    $user->first_name = $firstName;
    $user->last_name = $lastName;
    $user->first_name_kana = $firstNameKana;
    $user->last_name_kana = $lastNameKana;
    $user->mail_address = $mailAddress;

    return $user->save();
  }

  public function changeUserPassword($id, $oldPassword, $newPassword, $newPasswordConfirmation) {
    $user = Users::find($id);

    if ($user != null) {
      if (Hash::check($oldPassword, $user->password_hash)) {
        if ($newPassword == $newPasswordConfirmation) {
          $user->password_hash = Hash::make($newPassword);
          
          return $user->save();
        }
        else return config('user_service.new_password_mismatch');
      }
      else return config('user_service.old_password_mismatch');
    }
    else return config('user_service.invalid_user');
  }

  public function deleteUser($id) {
    return DB::table('users')->where('id', $id)->delete();
  }
}