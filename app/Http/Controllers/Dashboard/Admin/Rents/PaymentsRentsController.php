<?php

namespace App\Http\Controllers\Dashboard\Admin\Rents;

use App\Http\Controllers\Controller;
use App\Models\Rents\PaymentRent;
use Illuminate\Http\Request;
use Validator;

class PaymentsRentsController extends Controller
{
    public function indexAPI()
    {
        $paymentsRents = PaymentRent::all();
        return $paymentsRents;
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, PaymentRent::getRules());
        if ($validator->fails()) {
            return redirect()->route('Dashboard.Admin.Rents.Panel', ['#createModalPaymentsRents'])->withErrors($validator)->withInput();
        }
        $paymentRent = PaymentRent::create($data);
        $paymentRent->save();
        return redirect()->route('Dashboard.Admin.Rents.Panel')->with('success', 'Pago De Renta ' . $paymentRent->pagoRenta . ' agregado correctamente.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $validator = Validator::make($data, PaymentRent::getRules($id));
        if ($validator->fails()) {
            return redirect()->to(url()->previous())
                ->withErrors($validator)
                ->withInput()
                ->withFragment('#editModalPaymentsRents_' . $id);
        }
        $paymentRent = PaymentRent::findOrFail($id);
        $paymentRent->update($data);
        return back()->with('update', 'Pago De Renta ' . $paymentRent->pagoRenta . ' actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $paymentRent = PaymentRent::findOrFail($id);
        $paymentRent->delete();
        return redirect()->route('Dashboard.Admin.Rents.Panel')->with('danger', 'Pago De Renta ' . $paymentRent->pagoRenta . ' eliminado correctamente.');
    }
}