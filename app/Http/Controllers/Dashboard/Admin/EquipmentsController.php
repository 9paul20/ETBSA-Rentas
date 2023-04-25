<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\Equipments\Category;
use App\Models\Equipments\Status;
use App\Models\Equipments\VariablesExpenses;
use App\Models\FixedExpenses\Catalog;
use App\Models\FixedExpenses\FixedExpense;
use App\Models\FixedExpenses\TypeFixedExpense;
use App\Models\VariablesExpenses\VariableExpense;
use Carbon\Carbon;
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
        $equipments = Equipment::select('clvEquipo', 'noSerieEquipo', 'noSerieMotor', 'noEconomico', 'modelo', 'clvDisponibilidad', 'clvCategoria', 'descripcion', 'precioEquipo', 'fechaAdquisicion')
            ->with(['disponibilidad' => function ($query) {
                $query->select('clvDisponibilidad', 'disponibilidad', 'textColor', 'bgColorPrimary', 'bgColorSecondary');
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
        $columnNames = ['No. Serie Equipo', 'Modelo', 'Disponibilidad', 'Categoria', 'Precio', 'Descripción', ''];
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
        return redirect()->route('Dashboard.Admin.Equipments.Edit', $equipment->clvEquipo)->with('success', 'Equipo ' . $equipment->modelo . ' Con No.Serie: ' . $equipment->noSerieEquipo . ' agregado correctamente.');
    }

    public function storeFixedExpenses(Request $request, string $id)
    {
        // return $request;
        $data = $request->all();
        $validator = Validator::make($data, FixedExpense::getRules());
        if ($validator->fails()) {
            return redirect()->to(url()->previous())
                ->withErrors($validator)
                ->withInput()
                ->withFragment('#createModalFixedExpenses');
        }
        $fixedExpense = FixedExpense::create($data);
        $fixedExpense->clvEquipo = $id;
        $fixedExpense->save();
        $equipment = Equipment::findOrFail($id);
        return back()->with('update', 'Equipo ' . $equipment->noSerieEquipo . ' se le agregado su Gasto Fijo ' . $fixedExpense->gastoFijo . ' correctamente.');
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
        return back()->with('update', 'Equipo ' . $equipment->noSerieEquipo . ' se le agregado su Gasto Variable ' . $variableExpense->gastoVariable . ' correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $equipment = Equipment::findOrFail($id);
        $sumFixedExpenses = DB::table('t_gastos_fijos')
            ->where('clvEquipo', $id)
            ->sum('costoGastoFijo');
        $sumVariablesExpenses = DB::table('t_gastos_variables')
            ->where('clvEquipo', $id)
            ->sum('costoGastoVariable');

        //Datos por pagina
        $perPage = 10;

        //Gastos Fijos del equipo
        $fixedExpenses = FixedExpense::select('gastoFijo', 'clvTipoGastoFijo', 'fechaGastoFijo', 'costoGastoFijo', 'folioFactura')
            ->where('clvEquipo', $id)->get();
        $columnFixedExpenses = ['Gasto Fijo', 'Tipo De Gasto Fijo', 'Fecha Del Gasto Fijo', 'Costo Del Gasto Fijo', 'Folio'];
        $currentPageFixedExpenses = request()->get('fixedExpenses_page') ?? 1;
        $pagedFixedExpensesData = $fixedExpenses->slice(($currentPageFixedExpenses - 1) * $perPage, $perPage)->all();
        $rowFixedExpenses = new LengthAwarePaginator($pagedFixedExpensesData, count($fixedExpenses), $perPage, $currentPageFixedExpenses, [
            'path' => route('Dashboard.Admin.Equipments.Show', $id),
            'pageName' => 'fixedExpenses_page',
        ]);
        $tableFixedExpenses = [
            'columnFixedExpenses' => $columnFixedExpenses,
            'rowFixedExpenses' => $rowFixedExpenses,
        ];

        //Gastos Variables del equipo
        $variablesExpenses = VariableExpense::select('gastoVariable', 'fechaGastoVariable', 'costoGastoVariable', 'descripcion')
            ->where('clvEquipo', $id)->get();
        $columnVariablesExpenses = ['Gasto Variable', 'Fecha Del Gasto Variable', 'Costo Del Gasto Variable'];
        $currentPageVariablesExpenses = request()->get('variablesExpenses_page') ?? 1;
        $pagedVariablesExpensesData = $variablesExpenses->slice(($currentPageVariablesExpenses - 1) * $perPage, $perPage)->all();
        $rowVariablesExpenses = new LengthAwarePaginator($pagedVariablesExpensesData, count($variablesExpenses), $perPage, $currentPageVariablesExpenses, [
            'path' => route('Dashboard.Admin.Equipments.Show', $id),
            'pageName' => 'variablesExpenses_page',
        ]);
        $tableVariablesExpenses = [
            'columnVariablesExpenses' => $columnVariablesExpenses,
            'rowVariablesExpenses' => $rowVariablesExpenses,
        ];

        //Arreglo de todos los datos
        $Data = [
            'equipment' => $equipment,
            'sumFixedExpenses' => $sumFixedExpenses,
            'sumVariablesExpenses' => $sumVariablesExpenses,
            'tableFixedExpenses' => $tableFixedExpenses,
            'tableVariablesExpenses' => $tableVariablesExpenses,
        ];
        return view('Dashboard.Admin.Index', compact('Data'));
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
        //Rows o Filas Por Pagina
        $perPage = 10;

        $variablesExpenses = VariableExpense::all();
        $categories = Category::all();
        $status = Status::all();
        $equipment = Equipment::findOrFail($id);
        $today = Carbon::today()->format('Y-m-d');
        $allTypeFixedExpense = TypeFixedExpense::all();
        $sumFixedExpenses = DB::table('t_gastos_fijos')
            ->where('clvEquipo', $id)
            ->sum('costoGastoFijo');
        $sumVariablesExpenses = DB::table('t_gastos_variables')
            ->where('clvEquipo', $id)
            ->sum('costoGastoVariable');

        //Tabla de Gastos Fijos
        $fixedExpenses = FixedExpense::select(
            'clvGastoFijo',
            'gastoFijo',
            'costoGastoFijo',
            'folioFactura',
            'fechaGastoFijo',
            'clvTipoGastoFijo',
            'clvEquipo'
        )
            ->where('clvEquipo', $id)
            ->with(['equipment' => function ($query) {
                $query->select('clvEquipo', 'noSerieEquipo', 'modelo');
            }])->get();
        $currentPage = request()->get('fixedExpenses_page') ?? 1;
        $pagedData = $fixedExpenses->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $rowFixedExpenses = new LengthAwarePaginator($pagedData, count($fixedExpenses), $perPage, $currentPage, [
            'path' => route('Dashboard.Admin.Equipments.Edit', $id),
            'pageName' => 'fixedExpenses_page',
        ]);
        $columnFixedExpenses = ['Gasto Fijo', 'Tipo De Gasto Fijo', 'Fecha Del Gasto Fijo', 'Costo', 'Folio', ''];
        $tableFixedExpenses = [
            'columnFixedExpenses' => $columnFixedExpenses,
            'rowFixedExpenses' => $rowFixedExpenses,
        ];

        //Tabla de Gastos Variables
        $variablesExpenses = VariableExpense::select(
            'clvGastoVariable',
            'gastoVariable',
            'descripcion',
            'fechaGastoVariable',
            'costoGastoVariable'
        )
            ->where('clvEquipo', $id)
            ->with(['equipment' => function ($query) {
                $query->select('clvEquipo', 'noSerieEquipo', 'modelo');
            }])->get();
        $currentPage = request()->get('variablesExpenses_page') ?? 1;
        $pagedData = $variablesExpenses->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $rowVariablesExpenses = new LengthAwarePaginator($pagedData, count($variablesExpenses), $perPage, $currentPage, [
            'path' => route('Dashboard.Admin.Equipments.Edit', $id),
            'pageName' => 'variablesExpenses_page',
        ]);
        $columnVariablesExpenses = ['Gasto Variable', 'Fecha Del Gasto Variable', 'Costo', 'Descripción', ''];
        $tableVariablesExpenses = [
            'columnVariablesExpenses' => $columnVariablesExpenses,
            'rowVariablesExpenses' => $rowVariablesExpenses,
        ];

        $Data = [
            'variablesExpenses' => $variablesExpenses,
            'categories' => $categories,
            'status' => $status,
            'equipment' => $equipment,
            'today' => $today,
            'allTypeFixedExpense' => $allTypeFixedExpense,
            'sumFixedExpenses' => $sumFixedExpenses,
            'sumVariablesExpenses' => $sumVariablesExpenses,
            'tableFixedExpenses' => $tableFixedExpenses,
            'tableVariablesExpenses' => $tableVariablesExpenses,
        ];
        return view('Dashboard.Admin.Index', compact('Data'));
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
        return back()->with('update', 'Equipo ' . $equipment->noSerieEquipo . ' actualizado correctamente.');
    }

    public function updateFixedExpenses(Request $request, string $id)
    {
        $data = $request->all();
        $validator = Validator::make($data, FixedExpense::getRules());
        if ($validator->fails()) {
            return redirect()->to(url()->previous())
                ->withErrors($validator)
                ->withInput()
                ->withFragment('#editModalFixedExpenses_' . $id);
        }
        $variableExpense = FixedExpense::findOrFail($id);
        $variableExpense->update($data);
        $equipment = Equipment::findOrFail($variableExpense->clvEquipo);
        return back()->with('update', 'Equipo ' . $equipment->noSerieEquipo . ' se le actualizo su Gasto Variable ' . $variableExpense->gastoVariable . ' correctamente.');
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
        return back()->with('update', 'Equipo ' . $equipment->noSerieEquipo . ' se le actualizo su Gasto Variable ' . $variableExpense->gastoVariable . ' correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $equipment = Equipment::findOrFail($id);
        $equipment->delete();
        return redirect()->route('Dashboard.Admin.Equipments.Index')->with('danger', 'Equipo ' . $equipment->noSerieEquipo . ' eliminado correctamente.');
    }

    public function destroyFixedExpenses(string $id)
    {
        $fixedExpense = FixedExpense::findOrFail($id);
        $fixedExpense->delete();
        return back()->with('danger', 'Gasto Fijo ' . $fixedExpense->gastoFijo . ' eliminado correctamente.');
    }

    public function destroyVariablesExpenses(string $id)
    {
        $variableExpense = VariableExpense::findOrFail($id);
        $variableExpense->delete();
        return back()->with('danger', 'Gasto Variable ' . $variableExpense->gastoVariable . ' eliminado correctamente.');
    }
}