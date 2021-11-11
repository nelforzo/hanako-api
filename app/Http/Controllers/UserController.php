<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller
{

    protected $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function createUser(Request $request) {
        return $this->userService->createUser($request);
    }

    public function updateUser(Request $request, $id) {
        return $this->userService->updateUser($request, $id);
    }

    public function changePassword(Request $request, $id) {
        return $this->userService->changeUserPassword($request, $id);
    }

    public function delete($id) {
        return $this->userService->deleteUser($id);
    }
}
