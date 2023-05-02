<?php

namespace App\Http\Controllers\Dashboard\Admin\Equipments\Expenses;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\VariablesExpenses\VariableExpense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VariablesExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->all();
        $rowDatas = VariableExpense::filter($search)->with([
            'equipment:clvEquipo,noSerieEquipo,modelo',
        ])->orderByDesc('fechaGastoVariable')
            ->paginate(15, [
                'clvGastoVariable',
                'gastoVariable',
                'descripcion',
                'fechaGastoVariable',
                'costoGastoVariable',
                'clvEquipo',
            ]);
        $columnNames = [
            'Gasto Variable',
            'Descripción del Gasto Variable',
            'Fecha del Gasto Variable',
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
        $variableExpense = new VariableExpense();
        $equipments = Equipment::select([
            'clvEquipo',
            'noSerieEquipo',
            'modelo',
        ])->get();
        $today = Carbon::today()->format('Y-m-d');
        $Data = [
            'variableExpense' => $variableExpense,
            'equipments' => $equipments,
            'today' => $today,
        ];
        // return $Data;
        return view('Dashboard.Admin.Index', compact('Data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, VariableExpense::getRulesVariableExpense());
        if ($validator->fails()) {
            return redirect()->route('Dashboard.Admin.VariablesExpenses.Create')
                ->withErrors($validator)
                ->withInput();
        }
        $VariableExpense = VariableExpense::create($data);
        return redirect()->route('Dashboard.Admin.VariablesExpenses.Index')->with('success', 'Gasto Variable ' . $VariableExpense->gastoVariable . ' Del Equipo ' . $VariableExpense->equipment->modelo . ' - ' . $VariableExpense->equipment->noSerieEquipo . 'agregado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $variableExpense = VariableExpense::findOrFail($id);
        return view('Dashboard.Admin.Index', compact('variableExpense'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $variableExpense = VariableExpense::findOrFail($id);
        $equipments = Equipment::select([
            'clvEquipo',
            'noSerieEquipo',
            'modelo',
        ])->get();
        $today = Carbon::today()->format('Y-m-d');
        $Data = [
            'variableExpense' => $variableExpense,
            'equipments' => $equipments,
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
        $validator = Validator::make($data, VariableExpense::getRulesVariableExpense($id));
        if ($validator->fails()) {
            return redirect()->route('Dashboard.Admin.VariablesExpenses.Edit', ['VariableExpense' => $id])
                ->withErrors($validator)
                ->withInput();
        }
        $VariableExpense = VariableExpense::findOrFail($id);
        $VariableExpense->update($data);
        return redirect()->route('Dashboard.Admin.VariablesExpenses.Index')->with('success', 'Gasto Variable ' . $VariableExpense->gastoVariable . ' Del Equipo ' . $VariableExpense->equipment->modelo . ' - ' . $VariableExpense->equipment->noSerieEquipo . 'actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $VariableExpense = VariableExpense::with([
            'equipment:clvEquipo,noSerieEquipo,modelo',
        ])->select(
            'clvGastoVariable',
            'gastoVariable',
            'clvEquipo',
        )->findOrFail($id);
        $VariableExpense->delete();
        return redirect()->route('Dashboard.Admin.VariablesExpenses.Index')->with('danger', 'Gasto Fijo ' . $VariableExpense->gastoVariable . ' del equipo ' . $VariableExpense->equipment->modelo . ' - ' . $VariableExpense->equipment->noSerieEquipo . ' eliminado correctamente.');
    }
}
