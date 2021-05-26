<?php

namespace App\Services;

use App\Models\Stuff;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class StuffService {
  public function addStuff($userId, $name, $description, $brand, $comment, $barcode, $unitsPerPackage, $mililitersPerPackage, $expirationDate, $openedDate, $consumeBeforeDays) {
    $stuff = new Stuff();

    $stuff->user_id = $userId;
    $stuff->name = $name;
    $stuff->description = $description;
    $stuff->brand = $brand;
    $stuff->comment = $comment;
    $stuff->$barcode;
    $stuff->uuid = $this->gen_uuid();
    $stuff->units_per_package = $unitsPerPackage;
    $stuff->mililiters_per_package = $mililitersPerPackage;
    $stuff->expiration_date = $expirationDate;
    $stuff->opened_date = $openedDate;
    $stuff->consume_before_days = $consumeBeforeDays;

    $stuff->save();

    return $stuff->id;
  }

  public function updateStuff($id, $name, $description, $brand, $comment, $unitsPerPackage, $mililitersPerPackage, $expirationDate, $openedDate, $consumeBeforeDays) {
    $stuff = Stuff::find($id);

    $stuff->name = $name;
    $stuff->description = $description;
    $stuff->brand = $brand;
    $stuff->comment = $comment;
    $stuff->units_per_package = $unitsPerPackage;
    $stuff->mililiters_per_package = $mililitersPerPackage;
    $stuff->expiration_date = $expirationDate;
    $stuff->opened_date = $openedDate;
    $stuff->consume_before_days = $consumeBeforeDays;

    return $stuff->save();
  }

  public function deleteStuff($id) {
    return Stuff::find($id)->delete();
  }

  public function gen_uuid() {
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // 32 bits for "time_low"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

        // 16 bits for "time_mid"
        mt_rand( 0, 0xffff ),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand( 0, 0x0fff ) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand( 0, 0x3fff ) | 0x8000,

        // 48 bits for "node"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
  }
}