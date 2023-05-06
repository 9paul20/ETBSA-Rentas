<?php

namespace App\Http\Controllers\Dashboard\Admin\Equipments\Expenses;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\FixedExpenses\TypeFixedExpense;
use App\Models\MonthlyExpenses\MonthlyExpense;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class MonthlyExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->all();
        $rowDatas = MonthlyExpense::filter($search)->with([
            'equipment:clvEquipo,noSerieEquipo,modelo,clvCategoria',
            'equipment.categoria:clvCategoria,categoria',
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
            'Gasto Mensual',
            'Descripción del Gasto Mensual',
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
        $monthlyExpense = new MonthlyExpense();
        $equipments = Equipment::select([
            'clvEquipo',
            'noSerieEquipo',
            'modelo',
            'precioEquipo',
        ])->get();
        $typeFixedExpenses = TypeFixedExpense::select([
            'clvTipoGastoFijo',
            'tipoGastoFijo',
        ])->get();
        $valoresFijos = [];
        $Data = [
            'monthlyExpense' => $monthlyExpense,
            'equipments' => $equipments,
            'typeFixedExpenses' => $typeFixedExpenses,
            'valoresFijos' => $valoresFijos,
        ];
        return view('Dashboard.Admin.Index', compact('Data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, MonthlyExpense::getRulesMontlyExpenses());
        if ($validator->fails()) {
            return redirect()->route('Dashboard.Admin.MonthlyExpenses.Create')
                ->withErrors($validator)
                ->withInput();
        }
        $monthlyExpense = MonthlyExpense::create($data);
        return redirect()->route('Dashboard.Admin.MonthlyExpenses.Index')->with('success', 'Gasto Mensual ' . $monthlyExpense->TypeFixedExpense->tipoGastoFijo . ' Del Equipo ' . $monthlyExpense->equipment->modelo . ' - ' . $monthlyExpense->equipment->noSerieEquipo . 'agregado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $monthlyExpense = MonthlyExpense::findOrFail($id);
        return view('Dashboard.Admin.Index', compact('monthlyExpense'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $monthlyExpense = MonthlyExpense::findOrFail($id);
        $equipments = Equipment::select([
            'clvEquipo',
            'noSerieEquipo',
            'modelo',
            'precioEquipo',
        ])->get();
        $typeFixedExpenses = TypeFixedExpense::select([
            'clvTipoGastoFijo',
            'tipoGastoFijo',
        ])->get();
        $today = Carbon::today()->format('Y-m-d');
        $Data = [
            'monthlyExpense' => $monthlyExpense,
            'equipments' => $equipments,
            'typeFixedExpenses' => $typeFixedExpenses,
            'today' => $today,
        ];
        return view('Dashboard.Admin.Index', compact('Data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $validator = Validator::make($data, MonthlyExpense::getRulesMontlyExpenses($id));
        if ($validator->fails()) {
            return redirect()->route('Dashboard.Admin.MonthlyExpenses.Edit', ['MonthlyExpense' => $id])
                ->withErrors($validator)
                ->withInput();
        }
        $monthlyExpense = MonthlyExpense::findOrFail($id);
        $monthlyExpense->update($data);
        return redirect()->route('Dashboard.Admin.MonthlyExpenses.Index')->with('success', 'Gasto Mensual ' . $monthlyExpense->TypeFixedExpense->tipoGastoFijo . ' Del Equipo ' . $monthlyExpense->equipment->modelo . ' - ' . $monthlyExpense->equipment->noSerieEquipo . 'actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $fixedExpense = MonthlyExpense::with([
            'equipment:clvEquipo,noSerieEquipo,modelo',
        ])->select(
            'clvGastoFijo',
            'gastoFijo',
            'clvEquipo',
        )->findOrFail($id);
        $fixedExpense->delete();
        return redirect()->route('Dashboard.Admin.MonthlyExpenses.Index')->with('danger', 'Gasto Fijo ' . $fixedExpense->gastoFijo . ' del equipo ' . $fixedExpense->equipment->modelo . ' - ' . $fixedExpense->equipment->noSerieEquipo . ' eliminado correctamente.');
    }
}