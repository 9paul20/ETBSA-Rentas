<?php

Route::resource('Admin/VariablesExpenses', 'Admin\Equipments\Expenses\VariablesExpensesController')->names([
    'index' => 'Dashboard.Admin.VariablesExpenses.Index',
    'create' => 'Dashboard.Admin.VariablesExpenses.Create',
    'store' => 'Dashboard.Admin.VariablesExpenses.Store',
    'show' => 'Dashboard.Admin.VariablesExpenses.Show',
    'edit' => 'Dashboard.Admin.VariablesExpenses.Edit',
    'update' => 'Dashboard.Admin.VariablesExpenses.Update',
    'destroy' => 'Dashboard.Admin.VariablesExpenses.Destroy',
]);