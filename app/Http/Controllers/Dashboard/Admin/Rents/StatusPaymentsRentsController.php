<?php

namespace App\Http\Controllers\Dashboard\Admin\Rents;

use App\Http\Controllers\Controller;
use App\Models\Rents\StatusPaymentRent;
use Illuminate\Http\Request;
use Validator;

class StatusPaymentsRentsController extends Controller
{
    public function indexAPI()
    {
        $statusPaymentsRents = StatusPaymentRent::all();
        return $statusPaymentsRents;
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, StatusPaymentRent::getRules());
        if ($validator->fails()) {
            return redirect()->route('Dashboard.Admin.Rents.Panel', ['#createModalStatusPaymentsRents'])->withErrors($validator)->withInput();
        }
        $statusPaymentRent = StatusPaymentRent::create($data);
        $statusPaymentRent->save();
        return redirect()->route('Dashboard.Admin.Rents.Panel')->with('success', 'Estado Pago de Renta ' . $statusPaymentRent->estadoPagoRenta . ' agregado correctamente.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $validator = Validator::make($data, StatusPaymentRent::getRules($id));
        if ($validator->fails()) {
            return redirect()->to(url()->previous())
                ->withErrors($validator)
                ->withInput()
                ->withFragment('#editModalStatusPaymentsRents_' . $id);
        }
        $statusPaymentRent = StatusPaymentRent::findOrFail($id);
        $statusPaymentRent->update($data);
        return back()->with('update', 'Estado Pago de Renta ' . $statusPaymentRent->estadoPagoRenta . ' actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $statusPaymentRent = StatusPaymentRent::findOrFail($id);
        $statusPaymentRent->delete();
        return redirect()->route('Dashboard.Admin.Rents.Panel')->with('danger', 'Estado Pago de Renta ' . $statusPaymentRent->estadoPagoRenta . ' eliminado correctamente.');
    }
}