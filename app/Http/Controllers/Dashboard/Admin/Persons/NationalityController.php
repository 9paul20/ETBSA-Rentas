<?php

namespace App\Http\Controllers\Dashboard\Admin\Persons;

use App\Http\Controllers\Controller;
use App\Models\Persons\Nationality;
use Illuminate\Http\Request;
use Validator;

class NationalityController extends Controller
{
    public function indexAPI()
    {
        $nacionalidades = Nationality::all();
        return $nacionalidades;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, Nationality::getRules());
        if ($validator->fails()) {
            return redirect()->route('Dashboard.Admin.Persons.Panel', ['#createModalNacionalidad'])->withErrors($validator)->withInput();
        }
        $nacionalidad = Nationality::create($data);
        $nacionalidad->save();
        return redirect()->route('Dashboard.Admin.Persons.Panel')->with('success', 'Nacionalidad ' . $nacionalidad->nacionalidad . ' agregado correctamente.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $validator = Validator::make($data, Nationality::getRules($id));
        if ($validator->fails()) {
            return redirect()->to(url()->previous())
                ->withErrors($validator)
                ->withInput()
                ->withFragment('#editModalNacionalidad_' . $id);
        }
        $nacionalidad = Nationality::findOrFail($id);
        $nacionalidad->update($data);
        return back()->with('update', 'Nacionalidad ' . $nacionalidad->nacionalidad . ' actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $nacionalidad = Nationality::findOrFail($id);
        $nacionalidad->delete();
        return redirect()->route('Dashboard.Admin.Persons.Panel')->with('danger', 'Nacionalidad ' . $nacionalidad->nacionalidad . ' eliminado correctamente.');
    }
}