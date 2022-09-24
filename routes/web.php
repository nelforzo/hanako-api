<?php

use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return 'this is the web root for hanako-api. the stuff you\'re looking for is under /api. go have fun.';
});

Route::get('/users/new', [UsersController::class, 'showNewUser']);
Route::post('/users/new', [UsersController::class, 'createUser']);