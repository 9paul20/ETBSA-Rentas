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

Auth::routes();

Route::group(
    [
        // 'middleware' => '',
        'name' => 'front',
        'namespace' => 'App\Http\Controllers\Front',
        'prefix' => ''
    ],
    function () {
        Route::get('/', 'HomeController@index')->name('home');
        Route::get('/403', 'error403Controller@index')->name('403');
        Route::get('/404', 'error404Controller@index')->name('404');
        Route::get('/login', 'LoginController@index')->name('login');
        Route::get('/register', 'RegisterController@index')->name('register');
    }
);
Route::get('/table', function () {
    return view('table');
});
Route::get('/table_two', function () {
    return view('table_two');
});
Route::get('/table_three', function () {
    return view('table_three');
});
Route::get('/daterange', function () {
    return view('daterange');
});
Route::get('/navbar', function () {
    return view('navbar');
});
Route::get('/sidebar', function () {
    return view('sidebar');
});
Route::get('/profile', function () {
    return view('profile');
});
