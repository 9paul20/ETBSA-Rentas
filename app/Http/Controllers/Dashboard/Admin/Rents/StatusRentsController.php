<?php

namespace App\Http\Controllers\Dashboard\Admin\Rents;

use App\Http\Controllers\Controller;
use App\Models\Rents\StatusRent;
use Illuminate\Http\Request;
use Validator;

class StatusRentsController extends Controller
{
    public function indexAPI()
    {
        $statusRents = StatusRent::all();
        return $statusRents;
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, StatusRent::getRules());
        if ($validator->fails()) {
            return redirect()->route('Dashboard.Admin.Rents.Panel', ['#createModalStatusRents'])->withErrors($validator)->withInput();
        }
        $statusRent = StatusRent::create($data);
        $statusRent->save();
        return redirect()->route('Dashboard.Admin.Rents.Panel')->with('success', 'Estado De Renta ' . $statusRent->estadoRenta . ' agregado correctamente.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $validator = Validator::make($data, StatusRent::getRules($id));
        if ($validator->fails()) {
            return redirect()->to(url()->previous())
                ->withErrors($validator)
                ->withInput()
                ->withFragment('#editModalStatusRents_' . $id);
        }
        $statusRent = StatusRent::findOrFail($id);
        $statusRent->update($data);
        return back()->with('update', 'Estado De Renta ' . $statusRent->estadoRenta . ' actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $statusRent = StatusRent::findOrFail($id);
        $statusRent->delete();
        return redirect()->route('Dashboard.Admin.Rents.Panel')->with('danger', 'Estado De Renta ' . $statusRent->estadoRenta . ' eliminado correctamente.');
    }
}