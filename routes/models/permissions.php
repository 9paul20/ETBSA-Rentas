<?php
Route::resource('Admin/Permissions', 'Admin\PermissionsController')->names([
    'index' => 'Dashboard.Admin.Permissions.Index',
    'create' => 'Dashboard.Admin.Permissions.Create',
    'store' => 'Dashboard.Admin.Permissions.Store',
    'show' => 'Dashboard.Admin.Permissions.Show',
    'edit' => 'Dashboard.Admin.Permissions.Edit',
    'update' => 'Dashboard.Admin.Permissions.Update',
    'destroy' => 'Dashboard.Admin.Permissions.Destroy',
]);