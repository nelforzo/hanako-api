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
    public function getPackages(Request $request) {
        $packages = DB::table('packages')->where('user_id', $request->input('user_id'));
        if (!empty($request->input('category_id'))) {
            $packages->where('category_id', $request->input('category_id'));
        }
        return response()->json($packages->get());
    }

    public function getPackageByUUID(Request $request, $uuid) {
        $package = DB::table('packages')
        ->where('uuid', $uuid)
        ->where('user_id', $request->input('user_id'))->first();
        return response()->json($package);
    }

    public function createPackage(Request $request) {
        //validation
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'category_id' => 'required',
            'name' => 'required',
            'units_per_package' => 'required'
        ]);
    
        if ($validator->fails()) {
            return $validator->errors();
        }
    
        $package = new Packages();
    
        $package->user_id = $request->input('user_id');
        $package->category_id = $request->input('category_id');
        $package->name = $request->input('name');
        $package->description = $request->input('description');
        $package->brand = $request->input('brand');
        $package->comment = $request->input('comment');
        $package->barcode = $request->input('barcode');
        $package->uuid = $this->gen_uuid();
        $package->units_per_package = $request->input('units_per_package');
        $package->mililiters_per_package = $request->input('mililiters_per_package');
        $package->expiration_date = $request->input('expiration_date');
        $package->opened_date = $request->input('opened_date');
        $package->consume_before_days = $request->input('consume_before_days');
    
        $package->save();
    
        return $package;
    }

    public function updatePackage(Request $request, $uuid) {
        //validation
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'units_per_package' => 'required'
        ]);
    
        if ($validator->fails()) {
            return $validator->errors();
        }
    
        $package = Packages::where('uuid', $uuid)->where('user_id', $request->input('user_id'))->first();
        $package->update($request->all());
    
        return $package;
    }

    public function deletePackage(Request $request, $uuid) {
        $package = Packages::where('uuid', $uuid)->where('user_id', $request->input('user_id'))->first();
        $package->delete();
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
