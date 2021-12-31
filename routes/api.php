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

Route::post('/stuff', [StuffController::class, 'createStuff']);
Route::put('/stuff/{id}', [StuffController::class, 'updateStuff']);
Route::delete('/stuff/{id}', [StuffController::class, 'deleteStuff']);

Route::get('/packages', [PackagesController::class, 'getPackages']);
Route::post('/packages/{uuid}', [PackagesController::class, 'getPackageByUUID']);
Route::post('/packages', [PackagesController::class, 'createPackage']);
Route::put('/packages/{uuid}', [PackagesController::class, 'updatePackage']);
Route::delete('/packages/{uuid}', [PackagesController::class, 'deletePackage']);
