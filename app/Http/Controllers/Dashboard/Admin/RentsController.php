<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\Person;
use App\Models\Rent;
use App\Models\Rents\PaymentRent;
use App\Models\Rents\StatusRent;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Validator;

class RentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rents = Rent::all();
        $perPage = 10;
        $currentPage = request()->get('page') ?? 1;
        $pagedData = $rents->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $rowDatas = new LengthAwarePaginator($pagedData, count($rents), $perPage, $currentPage, [
            'path' => route('Dashboard.Admin.Rents.Index')
        ]);
        $columnNames = ['Equipo', 'Cliente', 'Descripción', 'Fecha Inicio', 'Fecha Fin', 'Pago De Renta', 'Estado De Renta', ''];
        return view('Dashboard.Admin.Index', compact('columnNames', 'rowDatas'));
    }

    public function indexAPI()
    {
        $rents = Rent::all();
        return $rents;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $equipments = Equipment::get(['clvEquipo', 'noSerie', 'modelo', 'descripcion']);
        $clients = Person::get(['clvPersona', 'nombrePersona', 'apePaternoPersona', 'apeMaternoPersona']);
        $statusRents = StatusRent::get(['clvEstadoRenta', 'estadoRenta', 'descripcion', 'clvTazaRenta']);
        $paymentsRents = PaymentRent::get(['clvPagoRenta', 'pagoRenta', 'ivaRenta', 'clvEstadoPagoRenta']);
        $rent = new Rent();
        return view('Dashboard.Admin.Index', compact('rent', 'clients', 'equipments', 'statusRents', 'paymentsRents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, Rent::getRules());
        if ($validator->fails()) {
            return redirect()->route('Dashboard.Admin.Rents.Create')
                ->withErrors($validator)
                ->withInput();
        }
        $rent = Rent::create($data);
        return redirect()->route('Dashboard.Admin.Rents.Index')->with('success', 'Renta agregado correctamente.');
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
        $equipments = Equipment::get(['clvEquipo', 'noSerie', 'modelo', 'descripcion']);
        $clients = Person::get(['clvPersona', 'nombrePersona', 'apePaternoPersona', 'apeMaternoPersona']);
        $statusRents = StatusRent::get(['clvEstadoRenta', 'estadoRenta', 'descripcion', 'clvTazaRenta']);
        $paymentsRents = PaymentRent::get(['clvPagoRenta', 'pagoRenta', 'ivaRenta', 'clvEstadoPagoRenta']);
        $rent = Rent::findOrFail($id);
        return view('Dashboard.Admin.Index', compact('rent', 'clients', 'equipments', 'statusRents', 'paymentsRents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $validator = Validator::make($data, Rent::getRules($id));
        if ($validator->fails()) {
            return redirect()->route('Dashboard.Admin.Rents.Edit', ['Rent' => $id])
                ->withErrors($validator)
                ->withInput();
        }
        $rent = Rent::findOrFail($id);
        $rent->update($data);
        return back()->with('update', 'Renta actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rent = Rent::findOrFail($id);
        $rent->delete();
        return redirect()->route('Dashboard.Admin.Rents.Index')->with('danger', 'Renta eliminado correctamente.');
    }
}