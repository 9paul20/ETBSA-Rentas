<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Equipment\FormRequestEquipment;
use App\Http\Requests\Equipment\FormRequestFixedExpense;
use App\Http\Requests\Equipment\FormRequestMonthlyExpense;
use App\Http\Requests\Equipment\FormRequestVariableExpense;
use App\Models\Equipment;
use App\Models\Equipments\Category;
use App\Models\Equipments\Status;
use App\Models\FixedExpenses\FixedExpense;
use App\Models\FixedExpenses\TypeFixedExpense;
use App\Models\MonthlyExpenses\MonthlyExpense;
use App\Models\VariablesExpenses\VariableExpense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class EquipmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->all();
        $columnNames = [
            'Equipo',
            'Disponibilidad',
            'Gasto Mensual',
            'Precio Actual',
            'Gastos Fijos',
            'Gastos Variables',
            'Total Actual',
            ''
        ];
        $perPage = $request->wantsJson() ? 999999999999999999 : 10;
        $rowDatas = Equipment::filter($search)->with([
            'disponibilidad:clvDisponibilidad,disponibilidad,textColor,bgColorPrimary,bgColorSecondary',
            'categoria:clvCategoria,categoria',
            'fixedExpenses:clvEquipo,costoGastoFijo',
            'variablesExpenses:clvEquipo,costoGastoVariable',
        ])->paginate($perPage, [
            'clvEquipo',
            'noSerieEquipo',
            'noSerieMotor',
            'noEconomico',
            'modelo',
            'clvDisponibilidad',
            'clvCategoria',
            'descripcion',
            'precioEquipo',
            'fechaAdquisicion',
            'porDeprAnual',
        ]);
        //Mapeo, para agregar más datos a cada RowData
        $rowDatas->map(function ($rowData) {
            $rowData->sumGastosMensuales = number_format($rowData->sumGastosMensuales, 2);
            $rowData->precioActualPorDepreciacionAnual = number_format($rowData->precioActualPorDepreciacionAnual, 2);
            $rowData->sumGastosFijos = number_format($rowData->sumGastosFijos, 2);
            $rowData->sumGastosVariables = number_format($rowData->sumGastosVariables, 2);
            $rowData->costoNetoAnual = number_format($rowData->costoNetoAnual, 2);
            $rowData->routeShowEquipment = route('Dashboard.Admin.Equipments.Show', $rowData->clvEquipo);
            $rowData->routeUpdateEquipment = route('Dashboard.Admin.Equipments.Edit', $rowData->clvEquipo);
            $rowData->routeDeleteEquipment = route('Dashboard.Admin.Equipments.Destroy', $rowData->clvEquipo);
            return $rowData;
        });
        $Data = [
            'columnNames' => $columnNames,
            'rowDatas' => $rowDatas,
        ];
        if (request()->wantsJson())
            return $Data;
        return view('Dashboard.Admin.Index', compact('columnNames', 'rowDatas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $status = Status::all();
        $categories = Category::all();
        $equipment = new Equipment();
        $today = Carbon::today()->format('Y-m-d');
        $Data = [
            'status' => $status,
            'categories' => $categories,
            'equipment' => $equipment,
            'today' => $today,
        ];
        return view('Dashboard.Admin.Index', compact('Data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FormRequestEquipment $request)
    {
        $validatedData = $request->validated();
        $equipment = Equipment::create($validatedData);
        //Ya agrega por medio de peticiones JSON; solo falta redireccionar de pagina y mandar mensaje de aviso
        if (request()->wantsJson()) {
            return response()->json([
                'message' => 'Equipo agregado correctamente',
                'data' => $equipment,
            ]);
        }
        return redirect()->route('Dashboard.Admin.Equipments.Edit', $equipment->clvEquipo)
            ->with('success', 'Equipo ' . $equipment->modelo . ' con No.Serie: ' . $equipment->noSerieEquipo . ' agregado correctamente.');
    }

    public function storeFixedExpenses(FormRequestFixedExpense $request, string $id)
    {
        $validatedData = $request->validated();
        $fixedExpense = FixedExpense::create($validatedData);
        $fixedExpense->clvEquipo = $id;
        $fixedExpense->save();
        $equipment = Equipment::findOrFail($id);
        return back()
            ->with('update', 'Equipo ' . $equipment->noSerieEquipo . ' se le agregado su Gasto Fijo ' . $fixedExpense->gastoFijo . ' correctamente.')
            ->withFragment('#fixedExpensesScroll');
    }

    public function storeVariablesExpenses(FormRequestVariableExpense $request, string $id)
    {
        $validatedData = $request->validated();
        $variableExpense = VariableExpense::create($validatedData);
        $variableExpense->clvEquipo = $id;
        $variableExpense->save();
        $equipment = Equipment::findOrFail($id);
        return back()
            ->with('update', 'Equipo ' . $equipment->noSerieEquipo . ' se le agregado su Gasto Variable ' . $variableExpense->gastoVariable . ' correctamente.')
            ->withFragment('#variablesExpensesScroll');
    }

    public function storeMonthlyExpenses(FormRequestMonthlyExpense $request, string $id)
    {
        $validatedData = $request->validated();
        $monthlyExpense = MonthlyExpense::create($validatedData);
        $monthlyExpense->clvEquipo = $id;
        $monthlyExpense->save();
        $equipment = Equipment::findOrFail($id);
        return back()
            ->with('update', 'Equipo ' . $equipment->noSerieEquipo . ' se le agregado su Gasto Mensual ' . $monthlyExpense->gastoMensual . ' correctamente.')
            ->withFragment('#monthlyExpensesScroll');
    }

    /**
     * Display the specified resource.
     */

    public function show(String $equipment)
    {
        //Rows o Filas Por Pagina
        $perPage = 10;

        //Dia de hoy
        $today = Carbon::today()->format('Y-m-d');

        $query = Equipment::query()
            ->with([
                'fixedExpenses:' .
                    'clvGastoFijo,gastoFijo,costoGastoFijo,folioFactura,fechaGastoFijo,clvTipoGastoFijo,clvEquipo',
                'fixedExpenses.TypeFixedExpense:' .
                    'clvTipoGastoFijo,tipoGastoFijo',
                'variablesExpenses:' .
                    'clvGastoVariable,gastoVariable,descripcion,fechaGastoVariable,costoGastoVariable,clvEquipo', 'monthlyExpenses:' .
                    'clvGastoMensual,gastoMensual,costoMensual,descripcion,clvEquipo,clvTipoGastoFijo',
                'monthlyExpenses.typeFixedExpense:' .
                    'clvTipoGastoFijo,tipoGastoFijo'
            ])
            ->select(
                'clvEquipo',
                'noSerieEquipo',
                'modelo',
                'noSerieMotor',
                'noEconomico',
                'modelo',
                'clvDisponibilidad',
                'clvCategoria',
                'descripcion',
                'precioEquipo',
                'folioEquipo',
                'fechaAdquisicion',
                'fechaGarantiaExtendida',
                'porDeprAnual',
            )
            ->findOrFail($equipment);

        //Tabla de Gastos Fijos Al Equipo
        $rowFixedExpenses = $query->fixedExpenses()
            ->with('TypeFixedExpense:clvTipoGastoFijo,tipoGastoFijo')
            ->orderByDesc('fechaGastoFijo')
            ->paginate(20, [
                'clvGastoFijo',
                'gastoFijo',
                'costoGastoFijo',
                'folioFactura',
                'fechaGastoFijo',
                'clvTipoGastoFijo',
                'clvEquipo',
            ], 'fixedExpenses_page');
        $columnFixedExpenses = [
            'Gasto Fijo',
            'Descripción Corta Del Gasto Fijo',
            'Fecha Del Gasto Fijo',
            'Costo',
            'Folio',
        ];
        $tableFixedExpenses = [
            'columnFixedExpenses' => $columnFixedExpenses,
            'rowFixedExpenses' => $rowFixedExpenses,
        ];

        //Tabla de Gastos Variables Al Equipo
        $rowVariablesExpenses = $query->variablesExpenses()
            ->orderByDesc('fechaGastoVariable')
            ->paginate(
                20,
                [
                    'clvGastoVariable',
                    'gastoVariable',
                    'descripcion',
                    'fechaGastoVariable',
                    'costoGastoVariable',
                    'clvEquipo'
                ],
                'variablesExpenses_page'
            );
        $columnVariablesExpenses = [
            'Gasto Variable',
            'Fecha Del Gasto Variable',
            'Descripción',
            'Costo',
        ];
        $tableVariablesExpenses = [
            'columnVariablesExpenses' => $columnVariablesExpenses,
            'rowVariablesExpenses' => $rowVariablesExpenses,
        ];

        //Tabla de Gastos Mensuales Al Equipo
        $rowMonthlyExpenses = $query->monthlyExpenses()
            ->with('TypeFixedExpense:clvTipoGastoFijo,tipoGastoFijo')
            ->orderByDesc('clvGastoMensual')
            ->paginate(20, [
                'clvGastoMensual',
                'gastoMensual',
                'costoMensual',
                'descripcion',
                'clvEquipo',
                'clvTipoGastoFijo'
            ], 'monthlyExpenses_page');
        $columnMonthlyExpenses = [
            'Gasto Mensual',
            'Descripción del Gasto Mensual',
            'Gasto Fijo',
            'Costo',
        ];
        $tableMonthlyExpenses = [
            'columnMonthlyExpenses' => $columnMonthlyExpenses,
            'rowMonthlyExpenses' => $rowMonthlyExpenses,
        ];

        $Data = [
            'today' => $today,
            'equipment' => $query,
            'tableFixedExpenses' => $tableFixedExpenses,
            'tableVariablesExpenses' => $tableVariablesExpenses,
            'tableMonthlyExpenses' => $tableMonthlyExpenses,
        ];
        // return $Data;
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
    public function edit(Request $request, String $id)
    {
        $perPage = $request->wantsJson() ? 999999999999999999 : 10;
        $equipment = Equipment::with([
            'fixedExpenses' => function ($query) {
                $query->select([
                    'clvGastoFijo',
                    'costoGastoFijo',
                    'clvEquipo',
                ]);
            },
            'variablesExpenses' => function ($query) {
                $query->select([
                    'clvGastoVariable',
                    'costoGastoVariable',
                    'clvEquipo',
                ]);
            },
            'monthlyExpenses' => function ($query) {
                $query->select([
                    'clvGastoMensual',
                    'costoMensual',
                    'clvEquipo',
                ]);
            },
        ])->select(
            'clvEquipo',
            'noSerieEquipo',
            'modelo',
            'noSerieMotor',
            'noEconomico',
            'modelo',
            'clvDisponibilidad',
            'clvCategoria',
            'descripcion',
            'precioEquipo',
            'precioEquipoActual',
            'precioActualVenta',
            'folioEquipo',
            'fechaAdquisicion',
            'fechaGarantiaExtendida',
            'fechaVenta',
            'porDeprAnual',
        )->findOrFail($id);

        $allTypeFixedExpense = TypeFixedExpense::select(
            'clvTipoGastoFijo',
            'tipoGastoFijo',
            'opcionUnica',
        )->get();
        $categories = Category::query()
            ->orderBy('clvCategoria', 'asc')
            ->get([
                'clvCategoria',
                'categoria',
            ]);
        $status = Status::query()
            ->orderBy('clvDisponibilidad', 'asc')
            ->get([
                'clvDisponibilidad',
                'disponibilidad',
            ]);
        $today = Carbon::today()->format('Y-m-d');
        $valoresFijos = [
            [
                'gastoFijo' => 'Agregar Costo Personalmente',
                'costo' => 0,
                'indiceValorFijo' => 1,
            ],
            [
                'gastoFijo' => 'Precio Del Equipo',
                'costo' => ($equipment->precioEquipo + 0),
                'indiceValorFijo' => 2,
            ],
            [
                'gastoFijo' => 'Precio Del Equipo Más Gastos Fijos',
                'costo' => ($equipment->precioEquipo + $equipment->sumGastosFijos),
                'indiceValorFijo' => 3,
            ],
        ];

        $rowFixedExpenses = FixedExpense::with([
            'TypeFixedExpense:clvTipoGastoFijo,tipoGastoFijo',
        ])->where('clvEquipo', $id)
            ->paginate(
                $perPage,
                [
                    'clvGastoFijo',
                    'gastoFijo',
                    'costoGastoFijo',
                    'folioFactura',
                    'fechaGastoFijo',
                    'clvTipoGastoFijo',
                    'clvEquipo',
                ],
                'fixedExpenses_page'
            );
        $columnFixedExpenses = [
            'Gasto Fijo',
            'Descripción Corta Del Gasto Fijo',
            'Fecha Del Gasto Fijo',
            'Costo',
            'Folio',
            ''
        ];
        $tableFixedExpenses = [
            'columnFixedExpenses' => $columnFixedExpenses,
            'rowFixedExpenses' => $rowFixedExpenses,
        ];

        $rowVariablesExpenses = VariableExpense::where('clvEquipo', $id)
            ->paginate(
                $perPage,
                [
                    'clvGastoVariable',
                    'gastoVariable',
                    'descripcion',
                    'fechaGastoVariable',
                    'costoGastoVariable',
                    'clvEquipo',
                ],
                'variablesExpenses_page'
            );
        $columnVariablesExpenses = [
            'Gasto Variable',
            'Fecha Del Gasto Variable',
            'Costo',
            'Descripción',
            ''
        ];
        $tableVariablesExpenses = [
            'columnVariablesExpenses' => $columnVariablesExpenses,
            'rowVariablesExpenses' => $rowVariablesExpenses,
        ];

        $rowMonthlyExpenses = MonthlyExpense::with([
            'equipment:clvEquipo,noSerieEquipo,modelo',
            'TypeFixedExpense:clvTipoGastoFijo,tipoGastoFijo,opcionUnica',
        ])->where('clvEquipo', $id)
            ->paginate(
                $perPage,
                [
                    'clvGastoMensual',
                    'gastoMensual',
                    'precioEquipo',
                    'indiceValorFijo',
                    'porGastoMensual',
                    'costoMensual',
                    'descripcion',
                    'clvEquipo',
                    'clvTipoGastoFijo',
                ],
                'montlhyExpenses_page'
            );
        $columnMonthlyExpenses = [
            'Gasto Mensual',
            'Gasto Fijo',
            'Costo Mensual',
            'Descripción',
            ''
        ];
        $tableMonthlyExpenses = [
            'columnMonthlyExpenses' => $columnMonthlyExpenses,
            'rowMonthlyExpenses' => $rowMonthlyExpenses,
        ];

        $Data = [
            'categories' => $categories,
            'status' => $status,
            'equipment' => $equipment,
            'today' => $today,
            'valoresFijos' => $valoresFijos,
            'allTypeFixedExpense' => $allTypeFixedExpense,
            'tableFixedExpenses' => $tableFixedExpenses,
            'tableVariablesExpenses' => $tableVariablesExpenses,
            'tableMonthlyExpenses' => $tableMonthlyExpenses,
        ];
        if (request()->wantsJson())
            return $Data;
        return view('Dashboard.Admin.Index', compact('Data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FormRequestEquipment $request, String $id)
    {
        $validatedData = $request->validated();
        return $validatedData;
        $equipment = Equipment::where('clvEquipo', $id)->update($validatedData);
        //Ya actualiza por medio de peticiones JSON; solo falta redireccionar de pagina y mandar mensaje de aviso
        if (request()->wantsJson()) {
            return response()->json([
                'message' => 'Equipo actualizado correctamente',
                'data' => $equipment,
            ]);
        }
        $equipment = Equipment::findOrFail($id);
        return back()
            ->with('update', 'Equipo ' . $equipment->modelo . ' con No.Serie: ' . $equipment->noSerieEquipo . ' actualizado correctamente.');
    }

    public function updateFixedExpenses(FormRequestFixedExpense $request, string $id)
    {
        $validatedData = $request->validated();
        $fixedExpense = FixedExpense::where('clvGastoFijo', $id)->update($validatedData);
        $fixedExpense = FixedExpense::findOrFail($id);
        $equipment = Equipment::findOrFail($fixedExpense->clvEquipo);
        return back()
            ->with('update', 'Equipo ' . $equipment->modelo . ' con No.Serie: ' . $equipment->noSerieEquipo . ' actualizado correctamente.');
    }

    public function updateVariablesExpenses(FormRequestVariableExpense $request, string $id)
    {
        $validatedData = $request->validated();
        $variableExpense = VariableExpense::where('clvGastoVariable', $id)->update($validatedData);
        $variableExpense = VariableExpense::findOrFail($id);
        $equipment = Equipment::findOrFail($variableExpense->clvEquipo);
        return back()
            ->with('update', 'Equipo ' . $equipment->noSerieEquipo . ' se le actualizo su Gasto Variable ' . $variableExpense->gastoVariable . ' correctamente.')->withFragment('#variablesExpensesScroll');
    }

    public function updateMonthlyExpenses(FormRequestMonthlyExpense $request, string $id)
    {
        $validatedData = $request->validated();
        $monthlyExpense = MonthlyExpense::where('clvGastoMensual', $id)->update($validatedData);
        $monthlyExpense = MonthlyExpense::findOrFail($id);
        $equipment = Equipment::findOrFail($monthlyExpense->clvEquipo);
        return back()
            ->with('update', 'Equipo ' . $equipment->noSerieEquipo . ' se le actualizo su Gasto Mensual ' . $monthlyExpense->gastoMensual . ' correctamente.')->withFragment('#monthlyExpensesScroll');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (request()->wantsJson()) {
            try {
                $equipment = Equipment::findOrFail($id);
                $equipment->delete();
                return response()->json([
                    'message' => 'El equipo ha sido eliminado correctamente',
                    'danger' => 'Equipo eliminado correctamente.'
                ], 200);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Error al eliminar el equipo'], 500);
            }
        } else {
            $equipment = Equipment::findOrFail($id);
            $equipment->delete();
            return redirect()->route('Dashboard.Admin.Equipments.Index')->with('danger', 'Equipo ' . $equipment->noSerieEquipo . ' eliminado correctamente.');
        }
    }

    public function destroyFixedExpenses(string $id)
    {
        $fixedExpense = FixedExpense::findOrFail($id);
        $fixedExpense->delete();
        return back()->with('danger', 'Gasto Fijo ' . $fixedExpense->gastoFijo . ' eliminado correctamente.')->withFragment('#fixedExpensesScroll');
    }

    public function destroyVariablesExpenses(string $id)
    {
        $variableExpense = VariableExpense::findOrFail($id);
        $variableExpense->delete();
        return back()->with('danger', 'Gasto Variable ' . $variableExpense->gastoVariable . ' eliminado correctamente.')->withFragment('#variablesExpensesScroll');
    }

    public function destroyMonthlyExpenses(string $id)
    {
        if (request()->wantsJson()) {
            //
        } else {
            $monthlyExpense = MonthlyExpense::findOrFail($id);
            $monthlyExpense->delete();
            return back()->with('danger', 'Gasto Mensual ' . $monthlyExpense->gastoMensual . ' eliminado correctamente.')->withFragment('#monthlyExpensesScroll');
        }
    }
}