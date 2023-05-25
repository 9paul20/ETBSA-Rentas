<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Rents\StoreRent;
use App\Http\Requests\Rents\UpdateRent;
use App\Models\Equipment;
use App\Models\Equipments\Category;
use App\Models\Equipments\Status;
use App\Models\Person;
use App\Models\Rent;
use App\Models\Rents\PaymentRent;
use App\Models\Rents\StatusPaymentRent;
use App\Models\Rents\StatusRent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /* $rowDatas = Rent::with([
            'equipment:clvEquipo,noSerieEquipo,modelo,precioEquipo,clvDisponibilidad,clvCategoria',
            'equipment.disponibilidad:clvDisponibilidad,disponibilidad,textColor,bgColorPrimary,bgColorSecondary',
            'equipment.categoria:clvCategoria,categoria',
            'equipment.fixedExpenses:clvGastoFijo',
            'equipment.variablesExpenses:clvGastoVariable',
            'equipment.monthlyExpenses:clvGastoMensual',
            'person:clvPersona,nombrePersona,apePaternoPersona,apeMaternoPersona',
            'statusRent:clvEstadoRenta,estadoRenta,textColor,bgColorPrimary,bgColorSecondary',
        ])
            ->withSum('PaymentsRents', 'pagoRenta')
            ->withSum('PaymentsRents', 'ivaRenta')
            ->paginate(10, [
                'clvRenta',
                'clvEquipo',
                'clvCliente',
                'descripcion',
                'fecha_inicio',
                'fecha_fin',
                'clvEstadoRenta',
            ]);
        $rowDatas->map(function ($rowData) {
            $fecha_inicio = strtotime($rowData->fecha_inicio);
            $rowData->fecha_inicio = date('j M Y', $fecha_inicio);
            $fecha_fin = strtotime($rowData->fecha_fin);
            $rowData->fecha_fin = date('j M Y', $fecha_fin);
            return $rowData;
        });
        $columnNames = [
            'Equipo',
            'Cliente',
            'Descripción',
            'Fecha Inicio',
            'Fecha Fin',
            'Estado De Renta',
            ''
        ];
        $Data = [
            'rowDatas' => $rowDatas,
            'columnNames' => $columnNames,
        ];
        return view('Dashboard.Admin.Index', compact('Data')); */
        return view('Dashboard.Admin.Index');
    }

    public function indexAPI()
    {
        $rowDatas = Rent::with([
            'equipment:clvEquipo,noSerieEquipo,modelo,precioEquipo,clvDisponibilidad,clvCategoria',
            'equipment.disponibilidad:clvDisponibilidad,disponibilidad,textColor,bgColorPrimary,bgColorSecondary',
            'equipment.categoria:clvCategoria,categoria',
            'equipment.fixedExpenses:clvGastoFijo',
            'equipment.variablesExpenses:clvGastoVariable',
            'equipment.monthlyExpenses:clvGastoMensual',
            'person:clvPersona,nombrePersona,apePaternoPersona,apeMaternoPersona',
            'statusRent:clvEstadoRenta,estadoRenta,textColor,bgColorPrimary,bgColorSecondary',
        ])
            ->withSum('PaymentsRents', 'pagoRenta')
            ->withSum('PaymentsRents', 'ivaRenta')
            ->paginate(10, [
                'clvRenta',
                'clvEquipo',
                'clvCliente',
                'descripcion',
                'fecha_inicio',
                'fecha_fin',
                'clvEstadoRenta',
            ]);
        // ->get([
        //     'clvRenta',
        //     'clvEquipo',
        //     'clvCliente',
        //     'descripcion',
        //     'fecha_inicio',
        //     'fecha_fin',
        //     'clvEstadoRenta',
        // ]);
        $rowDatas->map(function ($rowData) {
            $fecha_inicio = strtotime($rowData->fecha_inicio);
            $rowData->fecha_inicio = date('j M Y', $fecha_inicio);
            $fecha_fin = strtotime($rowData->fecha_fin);
            $rowData->fecha_fin = date('j M Y', $fecha_fin);
            $rowData->routeShowRent = route('Dashboard.Admin.Rents.Show', $rowData->clvRenta);
            $rowData->routeUpdateRent = route('Dashboard.Admin.Rents.Edit', $rowData->clvRenta);
            $rowData->routeDeleteRent = route('Dashboard.Admin.Rents.Destroy', $rowData->clvRenta);
            return $rowData;
        });
        $columnNames = [
            'Equipo',
            'Cliente',
            'Descripción',
            'Fecha Inicio',
            'Fecha Fin',
            'Estado De Renta',
            ''
        ];
        //Contador y relación de categorias de equipos existentes en rentas
        $categoryCounts = $rowDatas->pluck('equipment.categoria')->countBy('clvCategoria');
        $categories = Category::whereIn('clvCategoria', $categoryCounts->keys())
            ->get([
                'clvCategoria',
                'categoria'
            ])
            ->map(function ($category) use ($categoryCounts) {
                $category->count = $categoryCounts[$category->clvCategoria];
                return $category;
            });
        //Contador y relación de estados de renta existentes en rentas
        $statusRentsCounts = $rowDatas->pluck('statusRent')->countBy('clvEstadoRenta');
        $statusRents = StatusRent::whereIn('clvEstadoRenta', $statusRentsCounts->keys())
            ->get([
                'clvEstadoRenta',
                'estadoRenta'
            ])
            ->map(function ($statusRent) use ($statusRentsCounts) {
                $statusRent->count = $statusRentsCounts[$statusRent->clvEstadoRenta];
                return $statusRent;
            });
        $Data = [
            'rowDatas' => $rowDatas,
            'columnNames' => $columnNames,
            'categories' => $categories,
            'statusRents' => $statusRents,
        ];
        return $Data;
        // return response()->json(
        //     $Data
        // );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rent = new Rent();
        $equipments = Equipment::query()
            ->with([
                'fixedExpenses:clvGastoFijo',
                'variablesExpenses:clvGastoVariable',
                'monthlyExpenses:clvGastoMensual,costoMensual,clvEquipo',
                'disponibilidad:clvDisponibilidad,disponibilidad',
            ])
            ->whereHas('disponibilidad', function ($query) {
                $query->where('disponibilidad', 'Disponible');
            })
            ->get([
                'clvEquipo',
                'noSerieEquipo',
                'modelo',
                'descripcion',
                'clvDisponibilidad',
            ]);
        $clients = Person::get([
            'clvPersona',
            'nombrePersona',
            'apePaternoPersona',
            'apeMaternoPersona'
        ]);
        $statusRents = StatusRent::get([
            'clvEstadoRenta',
            'estadoRenta'
        ]);
        $Data = [
            'rent' => $rent,
            'equipments' => $equipments,
            'clients' => $clients,
            'statusRents' => $statusRents,
        ];
        return view('Dashboard.Admin.Index', compact('Data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRent $request)
    {
        return DB::transaction(function () use ($request) {
            $clvStatusRent_enRenta = StatusRent::where('estadoRenta', 'En Renta')->firstOrFail();
            $clvStatusPaymentRent_pendienteDePagar = StatusPaymentRent::where('estadoPagoRenta', 'Pendiente de pago')->firstOrFail();
            $clvStatus_enRenta = Status::where('disponibilidad', 'Ocupado')->firstOrFail();

            $data = $request->all();
            $rent = Rent::create($data);
            $rent->statusRent()->associate($clvStatusRent_enRenta);

            $preciosMensuales = $data['preciosMensuales'];
            $mesesARentar = $data['mesesARentar'];
            $costoPeriodo = round($preciosMensuales - $preciosMensuales * 0.16, 2);
            $costoIVA = round($preciosMensuales * 0.16, 2);

            $fechaInicio = Carbon::createFromFormat('Y-m-d', $rent->fecha_inicio);
            $fechaInicioPagoRenta = $fechaInicio->copy();
            $fechaFinPagoRenta = $fechaInicio->copy()->addMonth();

            // Creamos los pagos de renta necesarios
            for ($i = 1; $i <= $mesesARentar; $i++) {
                $paymentRent = $rent->PaymentsRents()->create([
                    'pagoRenta' => $costoPeriodo,
                    'ivaRenta' => $costoIVA,
                    'fecha_inicio' => $fechaInicioPagoRenta,
                    'fecha_fin' => $fechaFinPagoRenta,
                ]);
                $fechaInicioPagoRenta = $fechaFinPagoRenta->copy();
                $fechaFinPagoRenta->addMonth();
                $paymentRent->estadoPagoRenta()->associate($clvStatusPaymentRent_pendienteDePagar);
                $paymentRent->save();
            }

            $equipment = $rent->equipment;
            $equipment->disponibilidad()->associate($clvStatus_enRenta);
            $equipment->save();
            $rent->save();

            return redirect()->route('Dashboard.Admin.Rents.Index')->with('success', 'Renta agregado correctamente.');
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rent = Rent::findOrFail($id);
        return view('Dashboard.Admin.Index', compact('rent'));
    }

    public function showApi($id)
    {
        $rent = Rent::findOrFail($id);
        return $rent;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rent = Rent::query()
            ->with([
                'equipment:clvEquipo,noSerieEquipo,modelo',
                'equipment.fixedExpenses:clvGastoFijo',
                'equipment.variablesExpenses:clvGastoVariable',
                'equipment.monthlyExpenses:clvGastoMensual,costoMensual,clvEquipo',
                'person:clvPersona,nombrePersona,apePaternoPersona,apeMaternoPersona',
                'statusRent:clvEstadoRenta,estadoRenta',
            ])
            ->select([
                'clvRenta',
                'clvEquipo',
                'clvCliente',
                'descripcion',
                'fecha_inicio',
                'fecha_fin',
                'clvEstadoRenta',
            ])
            ->withCount([
                'PaymentsRents',
                'PaymentsRents as pagados' => function ($query) {
                    $query->whereHas('estadoPagoRenta', function ($query) {
                        $query->where('estadoPagoRenta', 'Pagado');
                    });
                },
                'PaymentsRents as pendientes' => function ($query) {
                    $query->whereHas('estadoPagoRenta', function ($query) {
                        $query->where('estadoPagoRenta', 'Pendiente de pago');
                    });
                },
                'PaymentsRents as mora' => function ($query) {
                    $query->whereHas('estadoPagoRenta', function ($query) {
                        $query->where('estadoPagoRenta', 'En mora');
                    });
                },
            ])
            ->withSum('PaymentsRents', 'pagoRenta')
            ->withSum('PaymentsRents', 'ivaRenta')
            ->findOrFail($id);
        $fecha_inicio = Carbon::parse($rent['fecha_inicio'])->format('j M Y');
        $fecha_fin = Carbon::parse($rent['fecha_fin'])->format('j M Y');
        $fecha = "Del " . $fecha_inicio . " Á " . $fecha_fin;

        $columnPaymentsRents = [
            'Pago No.',
            'Estado Del Pago',
            'Fecha Limite De Pago',
            'Pago',
            '',
        ];
        $rowPaymentsRents = $rent
            ->PaymentsRents()
            ->with('estadoPagoRenta:clvEstadoPagoRenta,estadoPagoRenta,textColor,bgColorPrimary,bgColorSecondary')
            ->get([
                'clvPagoRenta',
                'pagoRenta',
                'ivaRenta',
                'fecha_inicio',
                'fecha_fin',
                'clvEstadoPagoRenta',
                'descripcion',
            ]);
        $rowPaymentsRents->map(function ($rowPaymentsRents) {
            $fecha_inicio = strtotime($rowPaymentsRents->fecha_inicio);
            $rowPaymentsRents->fecha_inicio = date('j M Y', $fecha_inicio);
            $fecha_fin = strtotime($rowPaymentsRents->fecha_fin);
            $rowPaymentsRents->fecha_fin = date('j M Y', $fecha_fin);
            return $rowPaymentsRents;
        });
        // $rowPaymentsRents->put('text', 'hola');
        // $rowPaymentsRents->put('otroDato', 'valor');
        // $nuevoDato = ['texto' => 'Hola', 'numero' => 123];
        // $rowPaymentsRents->push($nuevoDato);
        // $sumPaymentsRents = $rent
        //     ->PaymentsRents()
        //     ->with('estadoPagoRenta')
        //     ->selectRaw('SUM(pagoRenta) as sumPagosRenta, SUM(ivaRenta) as sumIVARenta, SUM(pagoRenta + ivaRenta) as total')
        //     ->first();
        $tablePaymentsRents = [
            'columnPaymentsRents' => $columnPaymentsRents,
            'rowPaymentsRents' => $rowPaymentsRents,
        ];

        $statusRents = StatusRent::get([
            'clvEstadoRenta',
            'estadoRenta',
            'descripcion'
        ]);

        $arrayStatusPayments = StatusPaymentRent::whereIn(
            'estadoPagoRenta',
            [
                'Pendiente de pago',
                'Pagado',
                'En Mora',
            ]
        )
            ->get([
                'estadoPagoRenta',
            ])
            ->map(function ($statusPayment) {
                if ($statusPayment['estadoPagoRenta'] == 'Pendiente de pago') {
                    $statusPayment['cambio'] = 'a Pagado';
                } elseif ($statusPayment['estadoPagoRenta'] == 'En Mora') {
                    $statusPayment['cambio'] = 'a Pagado';
                } elseif ($statusPayment['estadoPagoRenta'] == 'Pagado') {
                    $statusPayment['cambio'] = 'a Pendiente de pago/En Mora';
                }
                return $statusPayment;
            })
            ->toArray();

        $Data = [
            'rent' => $rent,
            'fecha' => $fecha,
            'tablePaymentsRents' => $tablePaymentsRents,
            'statusRents' => $statusRents,
            'arrayStatusPayments' => $arrayStatusPayments,
        ];
        return view('Dashboard.Admin.Index', compact('Data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRent $request, Rent $Rent)
    {
        $columnValidator = [
            'descripcion',
            'clvEstadoRenta',
        ];
        $Rent->update($request->only($columnValidator));
        return back()->with('update', 'Renta actualizado correctamente.');
    }

    public function changeStatusPaymentRent(Request $request, PaymentRent $PaymentRent)
    {
        $columnValidator = [
            'clvEstadoPagoRenta',
        ];
        $PaymentRent->update($request->only($columnValidator));
        $clvRenta = $PaymentRent->clvRenta;
        return redirect()->route('Dashboard.Admin.Rents.Edit', $clvRenta)->with('update', 'Estado del Pago de Renta actualizado correctamente.')->withFragment('#PaymentsRentsScroll');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (request()->wantsJson()) {
            try {
                $rent = Rent::findOrFail($id);
                $rent->delete();
                return response()->json([
                    'message' => 'La renta ha sido eliminado correctamente',
                    'danger' => 'Renta eliminado correctamente.'
                ], 200);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Error al eliminar la renta'], 500);
            }
        } else {
            $rent = Rent::findOrFail($id);
            $rent->delete();
            return redirect()->route('Dashboard.Admin.Rents.Index')->with('danger', 'Renta eliminado correctamente.');
        }
    }
}
