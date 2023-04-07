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

// Permisos
Route::get('/PermissionsListAPI', [App\Http\Controllers\Dashboard\Admin\PermissionsController::class, 'indexAPI']);
Route::get('/PermissionsListAPI/{id}', [App\Http\Controllers\Dashboard\Admin\PermissionsController::class, 'showApi']);

// Grupos
Route::get('/RolesListAPI', [App\Http\Controllers\Dashboard\Admin\RolesController::class, 'indexAPI']);
Route::get('/RolesListAPI/{id}', [App\Http\Controllers\Dashboard\Admin\RolesController::class, 'showApi']);

// Usuarios
Route::get('/UsersListAPI', [App\Http\Controllers\Dashboard\Admin\UsersController::class, 'indexAPI']);
Route::post('/UsersListAPI', [App\Http\Controllers\Dashboard\Admin\UsersController::class, 'store']);
Route::get('/UsersListAPI/{id}', [App\Http\Controllers\Dashboard\Admin\UsersController::class, 'showApi']);
Route::put('/UsersListAPI/{id}', [App\Http\Controllers\Dashboard\Admin\UsersController::class, 'update']);
Route::delete('/UsersListAPI/{id}', [App\Http\Controllers\Dashboard\Admin\UsersController::class, 'destroy']);
