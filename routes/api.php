<?php

use App\Http\Controllers\StuffController;
use App\Http\Controllers\PackagesController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/users', [UsersController::class, 'createUser']);
Route::put('/users/{user_id}', [UsersController::class, 'updateUser']);
Route::put('/users/{user_id}/change_password', [UsersController::class, 'changeUserPassword']);
Route::delete('/users/{user_id}', [UsersController::class, 'deleteUser']);

Route::get('/users/{user_id}/stuff', [StuffController::class, 'getStuff']);
Route::get('/users/{user_id}/stuff/{stuff_id}', [PackagesController::class, 'getPackages']);

Route::post('/users/{user_id}/packages', [PackagesController::class, 'createPackage']);
Route::get('/users/{user_id}/packages/{uuid}', [PackagesController::class, 'getPackageByUUID']);
Route::put('/users/{user_id}/packages/{uuid}', [PackagesController::class, 'updatePackage']);
Route::delete('/users/{user_id}/packages/{uuid}', [PackagesController::class, 'deletePackage']);

Route::post('/stuff', [StuffController::class, 'createStuff']);
Route::put('/stuff/{stuff_id}', [StuffController::class, 'updateStuff']);
Route::delete('/stuff/{stuff_id}', [StuffController::class, 'deleteStuff']);
