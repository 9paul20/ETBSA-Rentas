<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\Person;
use App\Models\Persons\ComTel;
use App\Models\Persons\Nacionalidad;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Validator;

class PersonsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $persons = Person::select('clvPersona', 'nombrePersona', 'apePaternoPersona', 'apeMaternoPersona', 'nacimiento', 'clvNacionalidad', 'telefono', 'celular', 'clvComTel', 'ocupacion')
            ->with(['nacionalidad' => function ($query) {
                $query->select('clvNacionalidad', 'nacionalidad');
            }, 'companiaTelefonica' => function ($query) {
                $query->select('clvComTel', 'companiaTelefonica');
            }])
            ->get();
        $perPage = 10;
        $currentPage = request()->get('page') ?? 1;
        $pagedData = $persons->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $rowDatas = new LengthAwarePaginator($pagedData, count($persons), $perPage, $currentPage, [
            'path' => route('Dashboard.Admin.Persons.Index')
        ]);
        $columnNames = ['Nombre', 'Nacimiento', 'Nacionalidad', 'Telefono', 'Celular', 'Compañia Telefónica', 'Ocupación', ''];
        return view('Dashboard.Admin.Index', compact('columnNames', 'rowDatas'));
    }

    public function indexAPI()
    {
        $persons = Person::all();
        return $persons;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $comtels = ComTel::all();
        $nacionalidades = Nacionalidad::all();
        $person = new Person();
        return view('Dashboard.Admin.Index', compact('person', 'comtels', 'nacionalidades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // return $data;
        $validator = Validator::make($data, Person::getRules());
        if ($validator->fails()) {
            return redirect()->route('Dashboard.Admin.Persons.Create')
                ->withErrors($validator)
                ->withInput();
        }
        $person = Person::create($data);
        return redirect()->route('Dashboard.Admin.Persons.Index')->with('success', 'Persona ' . $person->nombrePersona . ' ' . $person->apePaternoPersona . ' ' . $person->apeMaternoPersona . ' agregado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $person = Person::findOrFail($id);
        return view('Dashboard.Admin.Index', compact('person'));
    }

    public function showApi($id)
    {
        $person = Person::findOrFail($id);
        return $person;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $comtels = ComTel::all();
        $nacionalidades = Nacionalidad::all();
        $person = Person::findOrFail($id);
        return view('Dashboard.Admin.Index', compact('person', 'comtels', 'nacionalidades'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $validator = Validator::make($data, Person::getRules($id));
        if ($validator->fails()) {
            return redirect()->route('Dashboard.Admin.Persons.Edit', ['Person' => $id])
                ->withErrors($validator)
                ->withInput();
        }
        $person = Person::findOrFail($id);
        $person->update($data);
        return back()->with('update', 'Persona ' . $person->nombrePersona . ' ' . $person->apePaternoPersona . ' ' . $person->apeMaternoPersona . ' actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $person = Person::findOrFail($id);
        $person->delete();
        return redirect()->route('Dashboard.Admin.Persons.Index')->with('danger', 'Persona ' . $person->nombrePersona . ' ' . $person->apePaternoPersona . ' ' . $person->apeMaternoPersona . ' eliminado correctamente.');
    }
}