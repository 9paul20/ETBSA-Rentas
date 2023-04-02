<?php

use App\Http\Controllers\Dashboard\Admin\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::apiResource('usersListAPI', 'Dashboard\Admin\UsersController@index');
// Route::get('UsersListAPI', 'Dashboard\Admin\UsersController@index');

// Route::prefix('admin')->group(function () {
//     // Route::apiResource('UsersListAPI', UsersController::class);
//     Route::apiResource('UsersListAPI', 'UsersController@index');
// });

Route::get('/GroupsListAPI', [App\Http\Controllers\Dashboard\Admin\GroupsController::class, 'indexAPI']);
Route::get('/PermissionsListAPI', [App\Http\Controllers\Dashboard\Admin\PermissionsController::class, 'indexAPI']);
Route::get('/UsersListAPI', [App\Http\Controllers\Dashboard\Admin\UsersController::class, 'indexAPI']);
