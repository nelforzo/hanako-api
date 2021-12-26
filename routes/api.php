<?php

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

//user controller routes
Route::post('/users', [UsersController::class, 'createUser']);
Route::put('/users/{id}', [UsersController::class, 'updateUser']);
Route::put('/users/{id}/change_password', [UsersController::class, 'changeUserPassword']);
Route::delete('/users/{id}', [UsersController::class, 'deleteUser']);

//packages controller routes
Route::get('/packages', [PackagesController::class, 'getPackages']);
Route::post('/packages/{uuid}', [PackagesController::class, 'getPackageByUUID']);
Route::post('/packages', [PackagesController::class, 'createPackage']);
Route::put('/packages/{id}', [PackagesController::class, 'updatePackage']);
Route::delete('/packages/{id}', [PackagesController::class, 'deletePackage']);
