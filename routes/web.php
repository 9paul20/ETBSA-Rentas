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
        Route::get('/', 'HomeController@index')->name('Front.Home');
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
        //Menu
        Route::get('Menu', 'DashboardController@index')->name('Dashboard.Menu.Index');
        Route::get('Register/Continue', 'DashboardController@registerContinue')->name('Dashboard.Next.RegisterContinue');

        //Permisos
        Route::resource('Admin/Permissions', 'Admin\PermissionsController')->names([
            'index' => 'Dashboard.Admin.Permissions.Index',
            'create' => 'Dashboard.Admin.Permissions.Create',
            'store' => 'Dashboard.Admin.Permissions.Store',
            'show' => 'Dashboard.Admin.Permissions.Show',
            'edit' => 'Dashboard.Admin.Permissions.Edit',
            'update' => 'Dashboard.Admin.Permissions.Update',
            'destroy' => 'Dashboard.Admin.Permissions.Destroy',
        ]);

        //Roles
        Route::resource('Admin/Roles', 'Admin\RolesController')->names([
            'index' => 'Dashboard.Admin.Roles.Index',
            'create' => 'Dashboard.Admin.Roles.Create',
            'store' => 'Dashboard.Admin.Roles.Store',
            'show' => 'Dashboard.Admin.Roles.Show',
            'edit' => 'Dashboard.Admin.Roles.Edit',
            'update' => 'Dashboard.Admin.Roles.Update',
            'destroy' => 'Dashboard.Admin.Roles.Destroy',
        ]);
        Route::put('Admin/Roles/{id}/updatePermissions', 'Admin\RolesController@updatePermissions')->name('Dashboard.Admin.Roles.UpdatePermissions');

        //Usuarios
        Route::resource('Admin/Users', 'Admin\UsersController')->names([
            'index' => 'Dashboard.Admin.Users.Index',
            'create' => 'Dashboard.Admin.Users.Create',
            'store' => 'Dashboard.Admin.Users.Store',
            'show' => 'Dashboard.Admin.Users.Show',
            'edit' => 'Dashboard.Admin.Users.Edit',
            'update' => 'Dashboard.Admin.Users.Update',
            'destroy' => 'Dashboard.Admin.Users.Destroy',
        ]);
        Route::put('Admin/Users/{id}/updatePassword', 'Admin\UsersController@updatePassword')->name('Dashboard.Admin.Users.UpdatePassword');
        Route::put('Admin/Users/{id}/updateRoles', 'Admin\UsersController@updateRoles')->name('Dashboard.Admin.Users.UpdateRoles');
        Route::put('Admin/Users/{id}/updatePermissions', 'Admin\UsersController@updatePermissions')->name('Dashboard.Admin.Users.UpdatePermissions');

        //Personas
        Route::get('Admin/Persons/Panel/ComTel/store', 'Admin\Persons\ComTelController@store')->name('Dashboard.Admin.Persons.ComTel.Store');
        Route::put('Admin/Persons/Panel/ComTel/update/{clvCompaniaTelefonica}', 'Admin\Persons\ComTelController@update')->name('Dashboard.Admin.Persons.ComTel.Update');
        Route::delete('Admin/Persons/Panel/ComTel/destroy/{clvCompaniaTelefonica}', 'Admin\Persons\ComTelController@destroy')->name('Dashboard.Admin.Persons.ComTel.Destroy');

        Route::get('Admin/Persons/Panel/Nacionalidad/store', 'Admin\Persons\NacionalidadController@store')->name('Dashboard.Admin.Persons.Nacionalidad.Store');
        Route::put('Admin/Persons/Panel/Nacionalidad/update/{clvNacionalidad}', 'Admin\Persons\NacionalidadController@update')->name('Dashboard.Admin.Persons.Nacionalidad.Update');
        Route::delete('Admin/Persons/Panel/Nacionalidad/destroy/{clvNacionalidad}', 'Admin\Persons\NacionalidadController@destroy')->name('Dashboard.Admin.Persons.Nacionalidad.Destroy');
        // Route::resource('Admin/Persons/Panel', 'Admin\Persons\ComTelController')->names([
        //     'update' => 'Dashboard.Admin.Persons.ComTel.Update',
        //     'destroy' => 'Dashboard.Admin.Persons.ComTel.Destroy',
        // ]);

        // Route::resource('Admin/Persons', 'Admin\Persons\NacionalidadController')->names([
        //     'update' => 'Dashboard.Admin.Persons.Nacionalidad.Update',
        //     'destroy' => 'Dashboard.Admin.Persons.Nacionalidad.Destroy',
        // ]);

        Route::get('Admin/Persons/Panel', 'Admin\Persons\PanelController@Panel')->name('Dashboard.Admin.Persons.Panel');

        Route::resource('Admin/Persons', 'Admin\PersonsController')->names([
            'index' => 'Dashboard.Admin.Persons.Index',
            'create' => 'Dashboard.Admin.Persons.Create',
            'store' => 'Dashboard.Admin.Persons.Store',
            'show' => 'Dashboard.Admin.Persons.Show',
            'edit' => 'Dashboard.Admin.Persons.Edit',
            'update' => 'Dashboard.Admin.Persons.Update',
            'destroy' => 'Dashboard.Admin.Persons.Destroy',
        ]);

        //Equipos
        Route::resource('Admin/Equipments', 'Admin\EquipmentsController')->names([
            'index' => 'Dashboard.Admin.Equipments.Index',
            'create' => 'Dashboard.Admin.Equipments.Create',
            'store' => 'Dashboard.Admin.Equipments.Store',
            'show' => 'Dashboard.Admin.Equipments.Show',
            'edit' => 'Dashboard.Admin.Equipments.Edit',
            'update' => 'Dashboard.Admin.Equipments.Update',
            'destroy' => 'Dashboard.Admin.Equipments.Destroy',
        ]);

        //Rentas
        Route::resource('Admin/Rents', 'Admin\RentsController')->names([
            'index' => 'Dashboard.Admin.Rents.Index',
            'create' => 'Dashboard.Admin.Rents.Create',
            'store' => 'Dashboard.Admin.Rents.Store',
            'show' => 'Dashboard.Admin.Rents.Show',
            'edit' => 'Dashboard.Admin.Rents.Edit',
            'update' => 'Dashboard.Admin.Rents.Update',
            'destroy' => 'Dashboard.Admin.Rents.Destroy',
        ]);
    }
);
