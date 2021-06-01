<?php

namespace App\Services;

use App\Models\Stuff;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class StuffService {
  public function createStuff(Request $request) {

    //validation
    $validated = $request->validate([
      'user_id' => 'required',
      'name' => 'required',
      'units_per_package' => 'required'
    ]);

    $stuff = new Stuff();

    $stuff->user_id = $request->input('user_id');
    $stuff->name = $request->input('name');
    $stuff->description = $request->input('description');
    $stuff->brand = $request->input('brand');
    $stuff->comment = $request->input('comment');
    $stuff->barcode = $request->input('barcode');
    $stuff->uuid = $this->gen_uuid();
    $stuff->units_per_package = $request->input('units_per_package');
    $stuff->mililiters_per_package = $request->input('mililiters_per_package');
    $stuff->expiration_date = $request->input('expiration_date');
    $stuff->opened_date = $request->input('opened_date');
    $stuff->consume_before_days = $request->input('consume_before_days');

    $stuff->save();

    return $stuff->id;
  }

  public function updateStuff(Request $request, $id) {

    //validation
    $validated = $request->validate([
      'name' => 'required',
      'units_per_package' => 'required'
    ]);

    $stuff = Stuff::findOrFail($id);

    return $stuff->update($request->all());
  }

  public function deleteStuff($id) {
    return DB::table('stuff')->where('id', $id)->delete();
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