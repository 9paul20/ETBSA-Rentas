<?php

namespace App\Http\Controllers\Dashboard\Admin\Equipments;

use App\Http\Controllers\Controller;
use App\Models\Rents\CupRent;
use Illuminate\Http\Request;
use Validator;

class CupsRentsController extends Controller
{
    public function indexAPI()
    {
        $cupsRents = CupRent::all();
        return $cupsRents;
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, CupRent::getRules());
        if ($validator->fails()) {
            return redirect()->route('Dashboard.Admin.Equipments.Panel', ['#createModalCupsRents'])->withErrors($validator)->withInput();
        }
        $cupRent = CupRent::create($data);
        $cupRent->save();
        return redirect()->route('Dashboard.Admin.Equipments.Panel')->with('success', 'Tasa Renta ' . $cupRent->tazaRenta . ' agregado correctamente.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $validator = Validator::make($data, CupRent::getRules($id));
        if ($validator->fails()) {
            return redirect()->to(url()->previous())
                ->withErrors($validator)
                ->withInput()
                ->withFragment('#editModalCupsRents_' . $id);
        }
        $cupRent = CupRent::findOrFail($id);
        $cupRent->update($data);
        return back()->with('update', 'Tasa Renta ' . $cupRent->tazaRenta . ' actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cupRent = CupRent::findOrFail($id);
        $cupRent->delete();
        return redirect()->route('Dashboard.Admin.Equipments.Panel')->with('danger', 'Tasa Renta ' . $cupRent->tazaRenta . ' eliminado correctamente.');
    }
}