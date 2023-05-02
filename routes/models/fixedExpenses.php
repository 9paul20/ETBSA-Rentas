<?php

Route::resource('Admin/FixedExpenses', 'Admin\Equipments\Expenses\FixedExpensesController')->names([
    'index' => 'Dashboard.Admin.FixedExpenses.Index',
    'create' => 'Dashboard.Admin.FixedExpenses.Create',
    'store' => 'Dashboard.Admin.FixedExpenses.Store',
    'show' => 'Dashboard.Admin.FixedExpenses.Show',
    'edit' => 'Dashboard.Admin.FixedExpenses.Edit',
    'update' => 'Dashboard.Admin.FixedExpenses.Update',
    'destroy' => 'Dashboard.Admin.FixedExpenses.Destroy',
]);