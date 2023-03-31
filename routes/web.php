<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::group(
    [
        // 'middleware' => '',
        'name' => 'front',
        'namespace' => 'App\Http\Controllers\Front',
        'prefix' => ''
    ],
    function () {
        Route::get('/', 'HomeController@index')->name('front.home');
        // Route::get('/403', 'error403Controller@index')->name('403');
        // Route::get('/404', 'error404Controller@index')->name('404');
    }
);

Auth::routes();

Route::group(
    [
        'middleware' => 'auth',
        'name' => 'Dashboard',
        'namespace' => 'App\Http\Controllers\Dashboard',
        'prefix' => 'Dashboard'
    ],
    function () {
        Route::get('/', 'DashboardController@index')->name('dashboard.index');
        Route::get('/Next', 'DashboardController@registerContinue')->name('dashboard.register.continue');
        Route::resource('Users', 'UserController');
        Route::get('UsersList', function () {
            return App\Models\User::all();
        })->name('usersList');
        // Route::get('/403', 'error403Controller@index')->name('403');
        // Route::get('/404', 'error404Controller@index')->name('404');
    }
);

// Route::get('/table', function () {
//     return view('Dashboard/table');
// });
// Route::get('/table_two', function () {
//     return view('Dashboard/table_two');
// });
// Route::get('/table_three', function () {
//     return view('Dashboard/table_three');
// });
// Route::get('/daterange', function () {
//     return view('Dashboard/daterange');
// });
// Route::get('/navbar', function () {
//     return view('Dashboard/navbar');
// });
// Route::get('/sidebar', function () {
//     return view('Dashboard/sidebar');
// });
// Route::get('/profile', function () {
//     return view('Dashboard/profile');
// });
