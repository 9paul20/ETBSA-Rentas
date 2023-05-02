<?php

namespace App\Http\Controllers\Dashboard\Admin\Equipments\Expenses;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\FixedExpenses\FixedExpense;
use App\Models\FixedExpenses\TypeFixedExpense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FixedExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->all();
        $rowDatas = FixedExpense::filter($search)->with([
            'equipment:clvEquipo,noSerieEquipo,modelo',
            'TypeFixedExpense:clvTipoGastoFijo,tipoGastoFijo',
        ])->orderByDesc('fechaGastoFijo')
            ->paginate(15, [
                'clvGastoFijo',
                'gastoFijo',
                'costoGastoFijo',
                'folioFactura',
                'fechaGastoFijo',
                'clvTipoGastoFijo',
                'clvEquipo',
            ]);
        $columnNames = [
            'Equipo',
            'Gasto Fijo',
            'Descripción del Gasto Fijo',
            'Fecha del Gasto Fijo',
            'Costo',
            'Folio',
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
        $fixedExpense = new FixedExpense();
        $equipments = Equipment::select([
            'clvEquipo',
            'noSerieEquipo',
            'modelo',
        ])->get();
        $typeFixedExpenses = TypeFixedExpense::select([
            'clvTipoGastoFijo',
            'tipoGastoFijo',
        ])->get();
        $today = Carbon::today()->format('Y-m-d');
        $Data = [
            'fixedExpense' => $fixedExpense,
            'equipments' => $equipments,
            'typeFixedExpenses' => $typeFixedExpenses,
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
        $validator = Validator::make($data, FixedExpense::getRulesFixedExpense());
        if ($validator->fails()) {
            return redirect()->route('Dashboard.Admin.FixedExpenses.Create')
                ->withErrors($validator)
                ->withInput();
        }
        $fixedExpense = FixedExpense::create($data);
        return redirect()->route('Dashboard.Admin.FixedExpenses.Index')->with('success', 'Gasto Fijo ' . $fixedExpense->TypeFixedExpense->tipoGastoFijo . ' Del Equipo ' . $fixedExpense->equipment->modelo . ' - ' . $fixedExpense->equipment->noSerieEquipo . 'agregado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $fixedExpense = FixedExpense::findOrFail($id);
        return view('Dashboard.Admin.Index', compact('fixedExpense'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $fixedExpense = FixedExpense::findOrFail($id);
        $equipments = Equipment::select([
            'clvEquipo',
            'noSerieEquipo',
            'modelo',
        ])->get();
        $typeFixedExpenses = TypeFixedExpense::select([
            'clvTipoGastoFijo',
            'tipoGastoFijo',
        ])->get();
        $today = Carbon::today()->format('Y-m-d');
        $Data = [
            'fixedExpense' => $fixedExpense,
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
        $validator = Validator::make($data, FixedExpense::getRulesFixedExpense($id));
        if ($validator->fails()) {
            return redirect()->route('Dashboard.Admin.FixedExpenses.Edit', ['FixedExpense' => $id])
                ->withErrors($validator)
                ->withInput();
        }
        $fixedExpense = FixedExpense::findOrFail($id);
        $fixedExpense->update($data);
        return redirect()->route('Dashboard.Admin.FixedExpenses.Index')->with('success', 'Gasto Fijo ' . $fixedExpense->TypeFixedExpense->tipoGastoFijo . ' Del Equipo ' . $fixedExpense->equipment->modelo . ' - ' . $fixedExpense->equipment->noSerieEquipo . 'actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $fixedExpense = FixedExpense::with([
            'equipment:clvEquipo,noSerieEquipo,modelo',
        ])->select(
            'clvGastoFijo',
            'gastoFijo',
            'clvEquipo',
        )->findOrFail($id);
        $fixedExpense->delete();
        return redirect()->route('Dashboard.Admin.FixedExpenses.Index')->with('danger', 'Gasto Fijo ' . $fixedExpense->gastoFijo . ' del equipo ' . $fixedExpense->equipment->modelo . ' - ' . $fixedExpense->equipment->noSerieEquipo . ' eliminado correctamente.');
    }
}