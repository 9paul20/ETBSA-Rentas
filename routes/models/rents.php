<?php

Route::get('Panel/Rents', 'Admin\Rents\PanelController@Panel')->name('Dashboard.Admin.Rents.Panel');

Route::get('Panel/Rents/StatusPaymentRent/store', 'Admin\Rents\StatusPaymentsRentsController@store')->name('Dashboard.Admin.Panel.Rents.StatusPaymentRent.Store');
Route::put('Panel/Rents/StatusPaymentRent/update/{clvEstadoPagoRenta}', 'Admin\Rents\StatusPaymentsRentsController@update')->name('Dashboard.Admin.Panel.Rents.StatusPaymentRent.Update');
Route::delete('Panel/Rents/StatusPaymentRent/destroy/{clvEstadoPagoRenta}', 'Admin\Rents\StatusPaymentsRentsController@destroy')->name('Dashboard.Admin.Panel.Rents.StatusPaymentRent.Destroy');

Route::get('Panel/Rents/PaymentRent/store', 'Admin\Rents\PaymentsRentsController@store')->name('Dashboard.Admin.Panel.Rents.PaymentRent.Store');
Route::put('Panel/Rents/PaymentRent/update/{clvPagoRenta}', 'Admin\Rents\PaymentsRentsController@update')->name('Dashboard.Admin.Panel.Rents.PaymentRent.Update');
Route::delete('Panel/Rents/PaymentRent/destroy/{clvPagoRenta}', 'Admin\Rents\PaymentsRentsController@destroy')->name('Dashboard.Admin.Panel.Rents.PaymentRent.Destroy');

Route::get('Panel/Rents/StatusRent/store', 'Admin\Rents\StatusRentsController@store')->name('Dashboard.Admin.Panel.Rents.StatusRent.Store');
Route::put('Panel/Rents/StatusRent/update/{clvEstadoRenta}', 'Admin\Rents\StatusRentsController@update')->name('Dashboard.Admin.Panel.Rents.StatusRent.Update');
Route::delete('Panel/Rents/StatusRent/destroy/{clvEstadoRenta}', 'Admin\Rents\StatusRentsController@destroy')->name('Dashboard.Admin.Panel.Rents.StatusRent.Destroy');

Route::resource('Admin/Rents', 'Admin\RentsController')->names([
    'index' => 'Dashboard.Admin.Rents.Index',
    'create' => 'Dashboard.Admin.Rents.Create',
    'store' => 'Dashboard.Admin.Rents.Store',
    'show' => 'Dashboard.Admin.Rents.Show',
    'edit' => 'Dashboard.Admin.Rents.Edit',
    'update' => 'Dashboard.Admin.Rents.Update',
    'destroy' => 'Dashboard.Admin.Rents.Destroy',
]);

Route::put('Admin/Rents/{PaymentRent}/ChangeStatusPaymentRent', 'Admin\RentsController@changeStatusPaymentRent')->name('Dashboard.Admin.Rents.ChangeStatusPaymentRent');
