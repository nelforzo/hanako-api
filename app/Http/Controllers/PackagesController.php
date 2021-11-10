<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PackageService;

class PackagesController extends Controller
{
    
    protected $packageService;

    public function __construct() {
        $this->packageService = new PackageService();
    }

    public function addPackage(Request $request) {
        return $this->packageService->addPackage($request);
    }

    public function updatePackage(Request $request, $id) {
        return $this->packageService->updatePackage($request, $id);
    }

    public function deletePackage($id) {
        return $this->packageService->deletePackage($id);
    }
}
