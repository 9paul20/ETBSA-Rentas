<?php
//*Panel Equipment
Route::get('Panel/Equipments', 'Admin\Equipments\PanelController@Panel')->name('Dashboard.Admin.Equipments.Panel');

Route::get('Panel/Equipments/Status/store', 'Admin\Equipments\StatusController@store')->name('Dashboard.Admin.Panel.Equipments.Status.Store');
Route::put('Panel/Equipments/Status/update/{clvDisponibilidad}', 'Admin\Equipments\StatusController@update')->name('Dashboard.Admin.Panel.Equipments.Status.Update');
Route::delete('Panel/Equipments/Status/destroy/{clvDisponibilidad}', 'Admin\Equipments\StatusController@destroy')->name('Dashboard.Admin.Panel.Equipments.Status.Destroy');

Route::get('Panel/Equipments/TypeCategory/store', 'Admin\Equipments\TypeCategoriesController@store')->name('Dashboard.Admin.Panel.Equipments.TypeCategory.Store');
Route::put('Panel/Equipments/TypeCategory/update/{clvTipoCategoria}', 'Admin\Equipments\TypeCategoriesController@update')->name('Dashboard.Admin.Panel.Equipments.TypeCategory.Update');
Route::delete('Panel/Equipments/TypeCategory/destroy/{clvTipoCategoria}', 'Admin\Equipments\TypeCategoriesController@destroy')->name('Dashboard.Admin.Panel.Equipments.TypeCategory.Destroy');

Route::get('Panel/Equipments/Category/store', 'Admin\Equipments\CategoriesController@store')->name('Dashboard.Admin.Panel.Equipments.Category.Store');
Route::put('Panel/Equipments/Category/update/{clvCategoria}', 'Admin\Equipments\CategoriesController@update')->name('Dashboard.Admin.Panel.Equipments.Category.Update');
Route::delete('Panel/Equipments/Category/destroy/{clvCategoria}', 'Admin\Equipments\CategoriesController@destroy')->name('Dashboard.Admin.Panel.Equipments.Category.Destroy');

Route::get('Panel/Equipments/CupRent/store', 'Admin\Equipments\CupsRentsController@store')->name('Dashboard.Admin.Panel.Equipments.CupRent.Store');
Route::put('Panel/Equipments/CupRent/update/{clvTazaRenta}', 'Admin\Equipments\CupsRentsController@update')->name('Dashboard.Admin.Panel.Equipments.CupRent.Update');
Route::delete('Panel/Equipments/CupRent/destroy/{clvTazaRenta}', 'Admin\Equipments\CupsRentsController@destroy')->name('Dashboard.Admin.Panel.Equipments.CupRent.Destroy');

//*Panel Fixed Expenses
Route::get('Panel/FixedExpenses', 'Admin\FixedExpenses\PanelController@Panel')->name('Dashboard.Admin.FixedExpenses.Panel');

Route::get('Panel/FixedExpenses/Catalogs/store', 'Admin\FixedExpenses\TypeFixedExpensesController@store')->name('Dashboard.Admin.Panel.TypeFixedExpenses.Store');
Route::put('Panel/FixedExpenses/Catalogs/update/{clvGastoFijo}', 'Admin\FixedExpenses\TypeFixedExpensesController@update')->name('Dashboard.Admin.Panel.TypeFixedExpenses.Update');
Route::delete('Panel/FixedExpenses/Catalogs/destroy/{clvGastoFijo}', 'Admin\FixedExpenses\TypeFixedExpensesController@destroy')->name('Dashboard.Admin.Panel.TypeFixedExpenses.Destroy');

//*Dashboard
Route::resource('Admin/Equipments', 'Admin\EquipmentsController')->names([
    'index' => 'Dashboard.Admin.Equipments.Index',
    'create' => 'Dashboard.Admin.Equipments.Create',
    'store' => 'Dashboard.Admin.Equipments.Store',
    'show' => 'Dashboard.Admin.Equipments.Show',
    'edit' => 'Dashboard.Admin.Equipments.Edit',
    'update' => 'Dashboard.Admin.Equipments.Update',
    'destroy' => 'Dashboard.Admin.Equipments.Destroy',
]);

//*Edit
Route::put('Admin/Equipments/{clvEquipo}/updateFixedExpensionsCatalogs', 'Admin\EquipmentsController@updateFixedExpensesCatalogs')->name('Dashboard.Admin.Equipments.UpdateFixedExpensesCatalogs');

Route::post('Admin/Equipments/{clvEquipo}/storeFixedExpenses', 'Admin\EquipmentsController@storeFixedExpenses')->name('Dashboard.Admin.Equipments.StoreFixedExpenses');
Route::put('Admin/Equipments/{clvGastoFijo}/updateFixedExpenses', 'Admin\EquipmentsController@updateFixedExpenses')->name('Dashboard.Admin.Equipments.UpdateFixedExpenses');
Route::delete('Admin/Equipments/{clvGastoFijo}/destroyFixedExpenses', 'Admin\EquipmentsController@destroyFixedExpenses')->name('Dashboard.Admin.Equipments.DestroyFixedExpenses');

Route::post('Admin/Equipments/{clvEquipo}/storeVariablesExpenses', 'Admin\EquipmentsController@storeVariablesExpenses')->name('Dashboard.Admin.Equipments.StoreVariablesExpenses');
Route::put('Admin/Equipments/{clvGastoVariable}/updateVariablesExpenses', 'Admin\EquipmentsController@updateVariablesExpenses')->name('Dashboard.Admin.Equipments.UpdateVariablesExpenses');
Route::delete('Admin/Equipments/{clvGastoVariable}/destroyVariablesExpenses', 'Admin\EquipmentsController@destroyVariablesExpenses')->name('Dashboard.Admin.Equipments.DestroyVariablesExpenses');

Route::post('Admin/Equipments/{clvEquipo}/storeMonthlyExpenses', 'Admin\EquipmentsController@storeMonthlyExpenses')->name('Dashboard.Admin.Equipments.StoreMonthlyExpenses');
Route::put('Admin/Equipments/{clvGastoMensual}/updateMonthlyExpenses', 'Admin\EquipmentsController@updateMonthlyExpenses')->name('Dashboard.Admin.Equipments.UpdateMonthlyExpenses');
Route::delete('Admin/Equipments/{clvGastoMensual}/destroyMonthlyExpenses', 'Admin\EquipmentsController@destroyMonthlyExpenses')->name('Dashboard.Admin.Equipments.DestroyMonthlyExpenses');