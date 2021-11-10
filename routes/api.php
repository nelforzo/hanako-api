<?php

use App\Http\Controllers\PackagesController;
use App\Http\Controllers\UserController;
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
Route::post('/users', [UserController::class, 'createUser']);
Route::put('/users/{id}', [UserController::class, 'updateUser']);
Route::put('/users/{id}/change_password', [UserController::class, 'changeUserPassword']);
Route::delete('/users/{id}', [UserController::class, 'deleteUser']);

//stuff controller routes
Route::post('/packages', [PackagesController::class, 'addPackage']);
Route::put('/packages/{id}', [PackagesController::class, 'updatePackage']);
Route::delete('/packages/{id}', [PackagesController::class, 'deletePackage']);