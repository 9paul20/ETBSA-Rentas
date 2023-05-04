<?php

namespace App\Http\Controllers\Dashboard\Admin\Equipments\Expenses;

use App\Http\Controllers\Controller;
use App\Models\MonthlyExpenses\MonthlyExpense;
use Illuminate\Http\Request;

class MonthlyExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->all();
        $rowDatas = MonthlyExpense::filter($search)->with([
            'equipment:clvEquipo,noSerieEquipo,modelo',
            'TypeFixedExpense:clvTipoGastoFijo,tipoGastoFijo',
        ])->paginate(15, [
            'clvGastoMensual',
            'gastoMensual',
            'precioEquipo',
            'porGastoMensual',
            'costoMensual',
            'descripcion',
            'clvEquipo',
            'clvTipoGastoFijo',
        ]);
        $columnNames = [
            'Equipo',
            'Gasto Fijo',
            'Descripción del Gasto Fijo',
            'Costo',
            ''
        ];
        $Table = [
            'rowDatas' => $rowDatas,
            'columnNames' => $columnNames,
        ];
        return view('Dashboard.Admin.Index', compact('Table'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}