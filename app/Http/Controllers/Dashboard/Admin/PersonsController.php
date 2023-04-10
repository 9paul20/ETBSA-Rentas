<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\Person;
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
        $persons = Person::all();
        $perPage = 10;
        $currentPage = request()->get('page') ?? 1;
        $pagedData = $persons->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $rowDatas = new LengthAwarePaginator($pagedData, count($persons), $perPage, $currentPage, [
            'path' => route('Dashboard.Admin.Persons.Index')
        ]);
        $columnNames = ['Nombre', 'Apaterno', 'AMaterno', 'Nacimiento', 'Telefono', 'Celular', 'Ocupación', 'Información', ''];
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
        $person = new Person();
        return view('Dashboard.Admin.Index', compact('person'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, Person::getRules());
        if ($validator->fails()) {
            return redirect()->route('Dashboard.Admin.Persons.Create')
                ->withErrors($validator)
                ->withInput();
        }
        $person = Person::create($data);
        return redirect()->route('Dashboard.Admin.Persons.Edit', $person->clvPersona)->with('success', 'Persona ' . $person->nombrePersona . ' ' . $person->apePaternoPersona . ' ' . $person->apeMaternoPersona . ' agregado correctamente.');
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
        $person = Person::findOrFail($id);
        return view('Dashboard.Admin.Index', compact('person'));
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
        return redirect()->route('Dashboard.Admin.Users.Index')->with('danger', 'Persona ' . $person->nombrePersona . ' ' . $person->apePaternoPersona . ' ' . $person->apeMaternoPersona . ' eliminado correctamente.');
    }
}