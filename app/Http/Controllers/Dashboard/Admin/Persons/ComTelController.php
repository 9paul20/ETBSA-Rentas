<?php

namespace App\Http\Controllers\Dashboard\Admin\Persons;

use App\Http\Controllers\Controller;
use App\Models\Persons\ComTel;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Validator;

class ComTelController extends Controller
{
    public function indexAPI()
    {
        $comtels = ComTel::all();
        return $comtels;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, ComTel::getRules());
        if ($validator->fails()) {
            return redirect()->route('Dashboard.Admin.Persons.Panel', ['#createModalComTel'])->withErrors($validator)->withInput();
        }
        $comtel = ComTel::create($data);
        $comtel->save();
        return redirect()->route('Dashboard.Admin.Persons.Panel')->with('success', 'Compañia Telefónica ' . $comtel->companiaTelefonica . ' agregado correctamente.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $validator = Validator::make($data, ComTel::getRules($id));
        if ($validator->fails()) {
            return redirect()->to(url()->previous())
                ->withErrors($validator)
                ->withInput()
                ->withFragment('#editModalComTel_' . $id);
        }
        $comtel = ComTel::findOrFail($id);
        $comtel->update($data);
        return back()->with('update', 'Compañia Telefónica ' . $comtel->companiaTelefonica . ' actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comTel = ComTel::findOrFail($id);
        $comTel->delete();
        return redirect()->route('Dashboard.Admin.Persons.Panel')->with('danger', 'Compañia Telefónica ' . $comTel->companiaTelefonica . ' eliminado correctamente.');
    }
}