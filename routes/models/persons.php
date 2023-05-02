<?php
Route::get('Panel/Persons', 'Admin\Persons\PanelController@Panel')->name('Dashboard.Admin.Persons.Panel');

Route::get('Panel/Persons/ComTel/store', 'Admin\Persons\ComTelController@store')->name('Dashboard.Admin.Panel.Persons.ComTel.Store');
Route::put('Panel/Persons/ComTel/update/{clvCompaniaTelefonica}', 'Admin\Persons\ComTelController@update')->name('Dashboard.Admin.Panel.Persons.ComTel.Update');
Route::delete('Panel/Persons/ComTel/destroy/{clvCompaniaTelefonica}', 'Admin\Persons\ComTelController@destroy')->name('Dashboard.Admin.Panel.Persons.ComTel.Destroy');

Route::get('Panel/Persons/Nationality/store', 'Admin\Persons\NationalityController@store')->name('Dashboard.Admin.Panel.Persons.Nacionalidad.Store');
Route::put('Panel/Persons/Nationality/update/{clvNacionalidad}', 'Admin\Persons\NationalityController@update')->name('Dashboard.Admin.Panel.Persons.Nacionalidad.Update');
Route::delete('Panel/Persons/Nationality/destroy/{clvNacionalidad}', 'Admin\Persons\NationalityController@destroy')->name('Dashboard.Admin.Panel.Persons.Nacionalidad.Destroy');

Route::resource('Admin/Persons', 'Admin\PersonsController')->names([
    'index' => 'Dashboard.Admin.Persons.Index',
    'create' => 'Dashboard.Admin.Persons.Create',
    'store' => 'Dashboard.Admin.Persons.Store',
    'show' => 'Dashboard.Admin.Persons.Show',
    'edit' => 'Dashboard.Admin.Persons.Edit',
    'update' => 'Dashboard.Admin.Persons.Update',
    'destroy' => 'Dashboard.Admin.Persons.Destroy',
]);