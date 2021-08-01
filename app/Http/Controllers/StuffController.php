<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StuffService;

class StuffController extends Controller
{
    
    protected $stuffService;

    public function __construct() {
        $this->stuffService = new StuffService();
    }

    public function createStuff(Request $request) {
        return $this->stuffService->createStuff($request);
    }

    public function updateStuff(Request $request, $id) {
        return $this->stuffService->updateStuff($request, $id);
    }

    public function deleteStuff($id) {
        return $this->stuffService->deleteStuff($id);
    }
}
