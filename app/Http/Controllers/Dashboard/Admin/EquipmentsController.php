<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
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
        $equipments = Equipment::all();
        $perPage = 10;
        $currentPage = request()->get('page') ?? 1;
        $pagedData = $equipments->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $rowDatas = new LengthAwarePaginator($pagedData, count($equipments), $perPage, $currentPage, [
            'path' => route('Dashboard.Admin.Equipments.Index')
        ]);
        $columnNames = ['noSerie', 'Modelo', 'Descripción', ''];
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
        $equiEquipment = new Equipment();
        return view('Dashboard.Admin.Index', compact('equiEquipment'));
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
        return redirect()->route('Dashboard.Admin.Equipments.Edit', $equipment->id)->with('success', 'Equipo ' . $equipment->noSerie . ' agregado correctamente.');
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
        $equipment = Equipment::findOrFail($id);
        return view('Dashboard.Admin.Index', compact('equipment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $equipment = Equipment::findOrFail($id);
        $equipment->delete();
        return redirect()->route('Dashboard.Admin.Users.Index')->with('danger', 'Equipo ' . $equipment->noSerie . ' eliminado correctamente.');
    }
}