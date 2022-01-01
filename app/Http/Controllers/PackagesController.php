<?php

namespace App\Http\Controllers;

use App\Models\Packages;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PackagesController extends Controller
{
    public function getPackages($user_id, $stuff_id) {
        $packages = DB::table('packages')->where('user_id', $user_id)->where('stuff_id', $stuff_id)->get();
        return $packages;
    }

    public function getPackageByUUID($user_id, $uuid) {
        $package = DB::table('packages')->where('user_id', $user_id)->where('uuid', $uuid)->first();
        return $package;
    }

    public function createPackage(Request $request, $user_id) {
        //add user_id to request
        $request->merge(['user_id' => $user_id]);
        
        //validate request
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'stuff_id' => 'required',
            'name' => 'required',
            'units_per_package' => 'required_without_all:grams_per_package,mililiters_per_package',
            'grams_per_package' => 'required_without_all:units_per_package,mililiters_per_package',
            'mililiters_per_package' => 'required_without_all:units_per_package,grams_per_package',
        ]);
    
        if ($validator->fails()) {
            return $validator->errors();
        }
    
        $package = new Packages();
    
        $package->user_id = $user_id;
        $package->stuff_id = $request->input('stuff_id');
        $package->name = $request->input('name');
        $package->description = $request->input('description');
        $package->brand = $request->input('brand');
        $package->comment = $request->input('comment');
        $package->barcode = $request->input('barcode');
        $package->uuid = $this->gen_uuid();
        $package->units_per_package = $request->input('units_per_package');
        $package->grams_per_package = $request->input('grams_per_package');
        $package->mililiters_per_package = $request->input('mililiters_per_package');
        $package->expiration_date = $request->input('expiration_date');
        $package->opened_date = $request->input('opened_date');
        $package->consume_before_days = $request->input('consume_before_days');
    
        $package->save();
    
        return $package;
    }

    public function updatePackage(Request $request, $user_id, $uuid) {
        //validation
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);
    
        if ($validator->fails()) {
            return $validator->errors();
        }
    
        $package = Packages::where('user_id', $user_id)->where('uuid', $uuid)->first();
        $package->update($request->all());
    
        return $package;
    }

    public function deletePackage($user_id, $uuid) {
        $package = Packages::where('user_id', $user_id)->where('uuid', $uuid)->first();
        return $package->delete();
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
