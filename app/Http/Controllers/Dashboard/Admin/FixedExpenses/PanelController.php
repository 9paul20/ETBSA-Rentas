<?php

namespace App\Http\Controllers\Dashboard\Admin\FixedExpenses;

use App\Http\Controllers\Controller;
use App\Models\FixedExpenses\Catalog;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PanelController extends Controller
{
    public function panel()
    {
        //Paginación
        $perPage = 10;

        //Estados Pagos de Renta
        $FixedExpensesCatalogs = Catalog::all();
        $columnFixedExpensesCatalogs = ['Gasto Fijo', 'Descripción', ''];
        $currentPageFixedExpensesCatalogs = request()->get('fixedExpensesCatalogs_page') ?? 1;
        $pagedFixedExpensesCatalogsData = $FixedExpensesCatalogs->slice(($currentPageFixedExpensesCatalogs - 1) * $perPage, $perPage)->all();
        $rowFixedExpensesCatalogs = new LengthAwarePaginator($pagedFixedExpensesCatalogsData, count($FixedExpensesCatalogs), $perPage, $currentPageFixedExpensesCatalogs, [
            'path' => route('Dashboard.Admin.FixedExpenses.Panel'),
            'pageName' => 'fixedExpensesCatalogs_page',
        ]);
        $tableFixedExpensesCatalogs = [
            'columnFixedExpensesCatalogs' => $columnFixedExpensesCatalogs,
            'rowFixedExpensesCatalogs' => $rowFixedExpensesCatalogs,
        ];

        //Arreglo de todos los datos
        $Data = [
            'tableFixedExpensesCatalogs' => $tableFixedExpensesCatalogs,
        ];
        // return $Data;
        return view('Dashboard.Admin.Index', compact('Data'));
    }
}
