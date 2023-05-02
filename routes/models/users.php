<?php
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