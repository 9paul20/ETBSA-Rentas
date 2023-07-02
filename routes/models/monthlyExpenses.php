<?php

Route::resource('Admin/MonthlyExpenses', 'Admin\Equipments\Expenses\MonthlyExpensesController')->names([
    'index' => 'Dashboard.Admin.MonthlyExpenses.Index',
    'create' => 'Dashboard.Admin.MonthlyExpenses.Create',
    'store' => 'Dashboard.Admin.MonthlyExpenses.Store',
    'show' => 'Dashboard.Admin.MonthlyExpenses.Show',
    // 'edit' => 'Dashboard.Admin.MonthlyExpenses.Edit',
    // 'update' => 'Dashboard.Admin.MonthlyExpenses.Update',
    'destroy' => 'Dashboard.Admin.MonthlyExpenses.Destroy',
]);