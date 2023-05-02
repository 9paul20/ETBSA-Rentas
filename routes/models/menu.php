<?php
Route::get('Menu', 'DashboardController@index')->name('Dashboard.Menu.Index');
Route::get('Register/Continue', 'DashboardController@registerContinue')->name('Dashboard.Next.RegisterContinue');