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
        // Route::get('/403', 'HomeController@403')->name('front.403');
        // Route::get('/404', 'HomeController@404')->name('front.404');
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
        Route::get('Menu', 'DashboardController@index')->name('Dashboard.Menu.Index');
        Route::get('Next', 'DashboardController@registerContinue')->name('Dashboard.Next.registerContinue');
        Route::resource('Admin/Permissions', 'Admin\PermissionsController')->names([
            'index' => 'Dashboard.Admin.Permissions.Index',
            'create' => 'Dashboard.Admin.Permissions.Create',
            'store' => 'Dashboard.Admin.Permissions.Store',
            'edit' => 'Dashboard.Admin.Permissions.Edit',
            'update' => 'Dashboard.Admin.Permissions.Update',
            'destroy' => 'Dashboard.Admin.Permissions.Destroy',
        ]);
        Route::resource('Admin/Roles', 'Admin\RolesController')->names([
            'index' => 'Dashboard.Admin.Roles.Index',
            'create' => 'Dashboard.Admin.Roles.Create',
            'store' => 'Dashboard.Admin.Roles.Store',
            'show' => 'Dashboard.Admin.Roles.Show',
            'edit' => 'Dashboard.Admin.Roles.Edit',
            'update' => 'Dashboard.Admin.Roles.Update',
            'updatePermissions' => 'Dashboard.Admin.Roles.UpdatePermissions',
            'destroy' => 'Dashboard.Admin.Roles.Destroy',
        ]);
        Route::resource('Admin/Users', 'Admin\UsersController')->names([
            'index' => 'Dashboard.Admin.Users.Index',
            'create' => 'Dashboard.Admin.Users.Create',
            'store' => 'Dashboard.Admin.Users.Store',
            'show' => 'Dashboard.Admin.Users.Show',
            'edit' => 'Dashboard.Admin.Users.Edit',
            'update' => 'Dashboard.Admin.Users.Update',
            'destroy' => 'Dashboard.Admin.Users.Destroy',
        ]);
    }
);

// Route::get('/table', function () {
//     return view('Examples/table');
// });
// Route::get('/table_two', function () {
//     return view('Examples/table_two');
// });
// Route::get('/table_three', function () {
//     return view('Examples/table_three');
// });
// Route::get('/daterange', function () {
//     return view('Examples/daterange');
// });
// Route::get('/UpdateProfile', function () {
//     return view('Examples/UpdateProfile');
// });