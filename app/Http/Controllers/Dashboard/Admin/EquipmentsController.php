<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Equipment\StoreEquipment;
use App\Models\Equipment;
use App\Models\Equipments\Category;
use App\Models\Equipments\Status;
use App\Models\FixedExpenses\FixedExpense;
use App\Models\FixedExpenses\TypeFixedExpense;
use App\Models\MonthlyExpenses\MonthlyExpense;
use App\Models\VariablesExpenses\VariableExpense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Validator;

class EquipmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->all();
        $rowDatas = Equipment::filter($search)->with([
            'disponibilidad:clvDisponibilidad,disponibilidad,textColor,bgColorPrimary,bgColorSecondary',
            'categoria:clvCategoria,categoria',
            'fixedExpenses:clvEquipo,costoGastoFijo',
            'variablesExpenses:clvEquipo,costoGastoVariable',
        ])->paginate(10, [
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
    public function store(StoreEquipment $request)
    {
        $validatedData = $request->validated();
        $equipment = Equipment::create($validatedData);
        if ($equipment) {
            return redirect()
                ->route('Dashboard.Admin.Equipments.Edit', $equipment->clvEquipo)
                ->with('success', 'Equipo ' . $equipment->modelo . ' con No.Serie: ' . $equipment->noSerieEquipo . ' agregado correctamente.');
        } else {
            return redirect()
                ->route('Dashboard.Admin.Equipments.Create')
                ->withErrors($validatedData)
                ->withInput();
        }
    }

    public function storeFixedExpenses(Request $request, string $id)
    {
        // return $request;
        $data = $request->all();
        $validator = Validator::make($data, FixedExpense::getRulesEquipment());
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
        return back()->with('update', 'Equipo ' . $equipment->noSerieEquipo . ' se le agregado su Gasto Fijo ' . $fixedExpense->gastoFijo . ' correctamente.')->withFragment('#fixedExpensesScroll');
    }

    public function storeVariablesExpenses(Request $request, string $id)
    {
        $data = $request->all();
        $validator = Validator::make($data, VariableExpense::getRulesEquipment());
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
        return back()->with('update', 'Equipo ' . $equipment->noSerieEquipo . ' se le agregado su Gasto Variable ' . $variableExpense->gastoVariable . ' correctamente.')->withFragment('#variablesExpensesScroll');
    }

    public function storeMonthlyExpenses(Request $request, string $id)
    {
        $data = $request->all();
        $validator = Validator::make($data, MonthlyExpense::getRulesEquipment());
        if ($validator->fails()) {
            return redirect()->to(url()->previous())
                ->withErrors($validator)
                ->withInput()
                ->withFragment('#createModalMonthlyExpenses');
        }
        $monthlyExpense = MonthlyExpense::create($data);
        $monthlyExpense->clvEquipo = $id;
        $monthlyExpense->save();
        $equipment = Equipment::findOrFail($id);
        return back()->with('update', 'Equipo ' . $equipment->noSerieEquipo . ' se le agregado su Gasto Mensual ' . $monthlyExpense->gastoMensual . ' correctamente.')->withFragment('#monthlyExpensesScroll');
    }

    /**
     * Display the specified resource.
     */

    public function show(string $id)
    {
        //Rows o Filas Por Pagina
        $perPage = 10;

        //Dia de hoy
        $today = Carbon::today()->format('Y-m-d');

        $equipment = Equipment::query()
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
            ->findOrFail($id);

        //Tabla de Gastos Fijos Al Equipo
        $rowFixedExpenses = $equipment->fixedExpenses()
            ->with('TypeFixedExpense:clvTipoGastoFijo,tipoGastoFijo')
            ->orderByDesc('fechaGastoFijo')
            ->paginate(10, [
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
        $rowVariablesExpenses = $equipment->variablesExpenses()
            ->orderByDesc('fechaGastoVariable')
            ->paginate(
                10,
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
        $rowMonthlyExpenses = $equipment->monthlyExpenses()
            ->with('TypeFixedExpense:clvTipoGastoFijo,tipoGastoFijo')
            ->orderByDesc('clvGastoMensual')
            ->paginate(10, [
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
            'equipment' => $equipment,
            'tableFixedExpenses' => $tableFixedExpenses,
            'tableVariablesExpenses' => $tableVariablesExpenses,
            'tableMonthlyExpenses' => $tableMonthlyExpenses,
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
            'folioEquipo',
            'fechaAdquisicion',
            'fechaGarantiaExtendida',
            'porDeprAnual',
        )->findOrFail($id);

        $allTypeFixedExpense = TypeFixedExpense::select(
            'clvTipoGastoFijo',
            'tipoGastoFijo',
        )->get();
        $categories = Category::all();
        $status = Status::all();
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
                10,
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
                10,
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
            'TypeFixedExpense:clvTipoGastoFijo,tipoGastoFijo',
        ])->where('clvEquipo', $id)
            ->paginate(
                10,
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
        $validator = Validator::make($data, FixedExpense::getRulesEquipment());
        if ($validator->fails()) {
            return redirect()->to(url()->previous())
                ->withErrors($validator)
                ->withInput()
                ->withFragment('#editModalFixedExpenses_' . $id);
        }
        $fixedExpense = FixedExpense::findOrFail($id);
        $fixedExpense->update($data);
        $equipment = Equipment::findOrFail($fixedExpense->clvEquipo);
        return redirect()->to(url()->previous() . '#fixedExpensesScroll')
            ->withFragment('#fixedExpensesScroll')
            ->with('update', 'Equipo ' . $equipment->noSerieEquipo . ' se le actualizo su Gasto Fijo ' . $fixedExpense->gastoFijo . ' correctamente.')->withFragment('#fixedExpensesScroll');
    }

    public function updateVariablesExpenses(Request $request, string $id)
    {
        $data = $request->all();
        $validator = Validator::make($data, VariableExpense::getRulesEquipment());
        if ($validator->fails()) {
            return redirect()->to(url()->previous() . '#variablesExpensesScroll')
                ->withErrors($validator)
                ->withInput()
                ->withFragment('#editModalVariablesExpenses_' . $id);
        }
        $variableExpense = VariableExpense::findOrFail($id);
        $variableExpense->update($data);
        $equipment = Equipment::findOrFail($variableExpense->clvEquipo);
        return back()->with('update', 'Equipo ' . $equipment->noSerieEquipo . ' se le actualizo su Gasto Variable ' . $variableExpense->gastoVariable . ' correctamente.')->withFragment('#variablesExpensesScroll');
    }

    public function updateMonthlyExpenses(Request $request, string $id)
    {
        $data = $request->all();
        $validator = Validator::make($data, MonthlyExpense::getRulesEquipment());
        if ($validator->fails()) {
            return redirect()->to(url()->previous() . '#monthlyExpensesScroll')
                ->withErrors($validator)
                ->withInput()
                ->withFragment('#editModalMonthlyExpenses_' . $id);
        }
        $monthlyExpense = MonthlyExpense::findOrFail($id);
        $monthlyExpense->update($data);
        $equipment = Equipment::findOrFail($monthlyExpense->clvEquipo);
        return back()->with('update', 'Equipo ' . $equipment->noSerieEquipo . ' se le actualizo su Gasto Mensual ' . $monthlyExpense->gastoMensual . ' correctamente.')->withFragment('#monthlyExpensesScroll');
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
        $monthlyExpense = MonthlyExpense::findOrFail($id);
        $monthlyExpense->delete();
        return back()->with('danger', 'Gasto Mensual ' . $monthlyExpense->gastoMensual . ' eliminado correctamente.')->withFragment('#monthlyExpensesScroll');
    }
}