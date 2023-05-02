<?php
Route::get('/', 'HomeController@index')->name('Front.Home');
Route::get('/Examples/Modal', 'ExamplesController@Modal')->name('Examples.Modal');