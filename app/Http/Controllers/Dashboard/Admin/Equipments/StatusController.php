<?php

namespace App\Http\Controllers\Dashboard\Admin\Equipments;

use App\Http\Controllers\Controller;
use App\Models\Equipments\Status;
use Illuminate\Http\Request;
use Validator;

class StatusController extends Controller
{
    public function indexAPI()
    {
        $status = Status::all();
        return $status;
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, Status::getRules());
        if ($validator->fails()) {
            return redirect()->route('Dashboard.Admin.Equipments.Panel', ['#createModalStatus'])->withErrors($validator)->withInput();
        }
        $status = Status::create($data);
        $status->save();
        return redirect()->route('Dashboard.Admin.Equipments.Panel')->with('success', 'Disponibilidad ' . $status->status . ' agregado correctamente.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $validator = Validator::make($data, Status::getRules($id));
        if ($validator->fails()) {
            return redirect()->to(url()->previous())
                ->withErrors($validator)
                ->withInput()
                ->withFragment('#editModalStatus_' . $id);
        }
        $status = Status::findOrFail($id);
        $status->update($data);
        return back()->with('update', 'Disponibilidad ' . $status->status . ' actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $status = Status::findOrFail($id);
        $status->delete();
        return redirect()->route('Dashboard.Admin.Equipments.Panel')->with('danger', 'Disponibilidad ' . $status->status . ' eliminado correctamente.');
    }
}