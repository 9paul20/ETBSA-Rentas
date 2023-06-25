<?php

namespace App\Http\Controllers\Dashboard\Admin\FixedExpenses;

use App\Http\Controllers\Controller;
use App\Models\FixedExpenses\TypeFixedExpense;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PanelController extends Controller
{
    public function panel()
    {
        //Paginación
        $perPage = 20;

        //Estados Pagos de Renta
        $TypeFixedExpenses = TypeFixedExpense::query()
            ->get([
                'clvTipoGastoFijo',
                'tipoGastoFijo',
                'opcionUnica',
                'descripcion',
            ]);
        $columnTypeFixedExpenses = ['Tipo de Gasto Fijo', 'Opción Única', 'Descripción', ''];
        $currentPageFixedExpenses = request()->get('typeFixedExpensesCatalogs_page') ?? 1;
        $pagedTypeFixedExpensesData = $TypeFixedExpenses->slice(($currentPageFixedExpenses - 1) * $perPage, $perPage)->all();
        $rowTypeFixedExpenses = new LengthAwarePaginator($pagedTypeFixedExpensesData, count($TypeFixedExpenses), $perPage, $currentPageFixedExpenses, [
            'path' => route('Dashboard.Admin.FixedExpenses.Panel'),
            'pageName' => 'typeFixedExpensesCatalogs_page',
        ]);
        $tableTypeFixedExpensesCatalogs = [
            'columnTypeFixedExpenses' => $columnTypeFixedExpenses,
            'rowTypeFixedExpenses' => $rowTypeFixedExpenses,
        ];

        //Arreglo de todos los datos
        $Data = [
            'tableTypeFixedExpensesCatalogs' => $tableTypeFixedExpensesCatalogs,
        ];
        // return $Data;
        return view('Dashboard.Admin.Index', compact('Data'));
    }
}