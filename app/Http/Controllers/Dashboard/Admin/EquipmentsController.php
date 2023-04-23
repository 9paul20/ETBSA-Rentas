<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\Equipments\Category;
use App\Models\Equipments\Status;
use App\Models\FixedExpenses\Catalog;
use App\Models\VariablesExpenses\VariableExpense;
use DB;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Validator;

class EquipmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $equipments = Equipment::all();
        $equipments = Equipment::select('clvEquipo', 'noSerie', 'modelo', 'clvDisponibilidad', 'clvCategoria', 'descripcion', 'precioEquipo')
            ->with(['disponibilidad' => function ($query) {
                $query->select('clvDisponibilidad', 'disponibilidad');
            }, 'categoria' => function ($query) {
                $query->select('clvCategoria', 'categoria');
            }])
            ->get();
        $perPage = 10;
        $currentPage = request()->get('page') ?? 1;
        $pagedData = $equipments->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $rowDatas = new LengthAwarePaginator($pagedData, count($equipments), $perPage, $currentPage, [
            'path' => route('Dashboard.Admin.Equipments.Index')
        ]);
        $columnNames = ['noSerie', 'Modelo', 'Disponibilidad', 'Categoria', 'Precio', 'Descripción', ''];
        return view('Dashboard.Admin.Index', compact('columnNames', 'rowDatas'));
    }

    public function indexAPI()
    {
        $equipments = Equipment::all();
        return $equipments;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $status = Status::all();
        $categories = Category::all();
        $equipment = new Equipment();
        return view('Dashboard.Admin.Index', compact('equipment', 'status', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, Equipment::getRules());
        if ($validator->fails()) {
            return redirect()->route('Dashboard.Admin.Equipments.Create')
                ->withErrors($validator)
                ->withInput();
        }
        $equipment = Equipment::create($data);
        return redirect()->route('Dashboard.Admin.Equipments.Index')->with('success', 'Equipo ' . $equipment->modelo . ' Con No.Serie: ' . $equipment->noSerie . ' agregado correctamente.');
    }

    public function storeVariablesExpenses(Request $request, string $id)
    {
        $data = $request->all();
        $validator = Validator::make($data, VariableExpense::getRules());
        if ($validator->fails()) {
            return redirect()->to(url()->previous())
                ->withErrors($validator)
                ->withInput()
                ->withFragment('#createModalVariablesExpenses');
        }
        $variableExpense = VariableExpense::create($data);
        $variableExpense->clvEquipo = $id;
        $variableExpense->save();
        $equipment = Equipment::findOrFail($id);
        return back()->with('update', 'Equipo ' . $equipment->noSerie . ' se le agregado su Gasto Variable ' . $variableExpense->gastoVariable . ' correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $equipment = Equipment::findOrFail($id);
        return view('Dashboard.Admin.Index', compact('equipment'));
    }

    public function showApi($id)
    {
        $equipment = Equipment::findOrFail($id);
        return $equipment;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $status = Status::all();
        $categories = Category::all();
        $equipment = Equipment::findOrFail($id);
        $fixedExpensesCatalogs = Catalog::all();
        $sumFixesExpenses = $equipment->fixedExpensesCatalogs()->sum('costoGastoFijo');
        $sumVariablesExpenses = DB::table('t_gastos_variables')
            ->where('clvEquipo', $id)
            ->sum('costoGastoVariable');

        $variablesExpenses = VariableExpense::select('clvGastoVariable', 'gastoVariable', 'descripcion', 'costoGastoVariable', 'clvEquipo')
            ->where('clvEquipo', $id)
            ->with(['equipment' => function ($query) {
                $query->select('clvEquipo', 'noSerie', 'modelo');
            }])->get();
        $perPage = 10;
        $currentPage = request()->get('page') ?? 1;
        $pagedData = $variablesExpenses->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $rowVariablesExpenses = new LengthAwarePaginator($pagedData, count($variablesExpenses), $perPage, $currentPage, [
            'path' => route('Dashboard.Admin.Equipments.Index')
        ]);
        $columnVariablesExpenses = ['Gasto Variable', 'Descripción', 'Costo', ''];
        return view('Dashboard.Admin.Index', compact('equipment', 'status', 'categories', 'fixedExpensesCatalogs', 'rowVariablesExpenses', 'columnVariablesExpenses', 'sumFixesExpenses', 'sumVariablesExpenses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        // return $data;
        $validator = Validator::make($data, Equipment::getRules($id));
        if ($validator->fails()) {
            return redirect()->route('Dashboard.Admin.Equipments.Edit', ['Equipment' => $id])
                ->withErrors($validator)
                ->withInput();
        }
        $equipment = Equipment::findOrFail($id);
        $equipment->update($data);
        return back()->with('update', 'Equipo ' . $equipment->noSerie . ' actualizado correctamente.');
    }

    public function updateFixedExpensesCatalogs(Request $request, string $id)
    {
        // return $request;
        $equipment = Equipment::findOrFail($id);
        $rules = [
            'costoGastoFijo.*' => 'nullable|numeric|between:0,9999999999.99'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $selectedCatalogs = $request->input('fixedExpensesCatalogs', []);
        $fixedExpensesValues = $request->input('costoGastoFijo', []);
        $equipment->fixedExpensesCatalogs()->sync($selectedCatalogs);
        foreach ($selectedCatalogs as $catalogId) {
            $cost = $fixedExpensesValues[$catalogId] ?? null;
            $equipment->fixedExpensesCatalogs()->updateExistingPivot($catalogId, ['costoGastoFijo' => $cost]);
        }
        return back()->with('update', 'Equipo ' . $equipment->noSerie . ' se le han actualizado sus gastos fijos correctamente.');
    }

    public function updateVariablesExpenses(Request $request, string $id)
    {
        $data = $request->all();
        $validator = Validator::make($data, VariableExpense::getRules());
        if ($validator->fails()) {
            return redirect()->to(url()->previous())
                ->withErrors($validator)
                ->withInput()
                ->withFragment('#editModalVariablesExpenses_' . $id);
        }
        $variableExpense = VariableExpense::findOrFail($id);
        $variableExpense->update($data);
        $equipment = Equipment::findOrFail($variableExpense->clvEquipo);
        return back()->with('update', 'Equipo ' . $equipment->noSerie . ' se le actualizo su Gasto Variable ' . $variableExpense->gastoVariable . ' correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $equipment = Equipment::findOrFail($id);
        $equipment->delete();
        return redirect()->route('Dashboard.Admin.Equipments.Index')->with('danger', 'Equipo ' . $equipment->noSerie . ' eliminado correctamente.');
    }

    public function destroyVariablesExpenses(string $id)
    {
        $variableExpense = VariableExpense::findOrFail($id);
        $variableExpense->delete();
        return back()->with('danger', 'Equipo ' . $variableExpense->gastoVariable . ' eliminado correctamente.');
    }
}