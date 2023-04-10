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

// Personas
Route::get('/PersonsListAPI', [App\Http\Controllers\Dashboard\Admin\PersonsController::class, 'indexAPI']);
Route::post('/PersonsListAPI', [App\Http\Controllers\Dashboard\Admin\PersonsController::class, 'store']);
Route::get('/PersonsListAPI/{id}', [App\Http\Controllers\Dashboard\Admin\PersonsController::class, 'showApi']);
Route::put('/PersonsListAPI/{id}', [App\Http\Controllers\Dashboard\Admin\PersonsController::class, 'update']);
Route::delete('/PersonsListAPI/{id}', [App\Http\Controllers\Dashboard\Admin\PersonsController::class, 'destroy']);

// Equipos
Route::get('/EquipmentsListAPI', [App\Http\Controllers\Dashboard\Admin\EquipmentsController::class, 'indexAPI']);
Route::post('/EquipmentsListAPI', [App\Http\Controllers\Dashboard\Admin\EquipmentsController::class, 'store']);
Route::get('/EquipmentsListAPI/{id}', [App\Http\Controllers\Dashboard\Admin\EquipmentsController::class, 'showApi']);
Route::put('/EquipmentsListAPI/{id}', [App\Http\Controllers\Dashboard\Admin\EquipmentsController::class, 'update']);
Route::delete('/EquipmentsListAPI/{id}', [App\Http\Controllers\Dashboard\Admin\EquipmentsController::class, 'destroy']);

// Personas
Route::get('/RentsListAPI', [App\Http\Controllers\Dashboard\Admin\RentsController::class, 'indexAPI']);
Route::post('/RentsListAPI', [App\Http\Controllers\Dashboard\Admin\RentsController::class, 'store']);
Route::get('/RentsListAPI/{id}', [App\Http\Controllers\Dashboard\Admin\RentsController::class, 'showApi']);
Route::put('/RentsListAPI/{id}', [App\Http\Controllers\Dashboard\Admin\RentsController::class, 'update']);
Route::delete('/RentsListAPI/{id}', [App\Http\Controllers\Dashboard\Admin\RentsController::class, 'destroy']);