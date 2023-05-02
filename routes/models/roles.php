<?php
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