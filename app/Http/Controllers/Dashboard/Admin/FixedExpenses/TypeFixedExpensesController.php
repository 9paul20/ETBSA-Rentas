<?php

namespace App\Http\Controllers\Dashboard\Admin\FixedExpenses;

use App\Http\Controllers\Controller;
use App\Models\FixedExpenses\TypeFixedExpense;
use Illuminate\Http\Request;
use Validator;

use function PHPUnit\Framework\isEmpty;

class TypeFixedExpensesController extends Controller
{
    public function indexAPI()
    {
        $fixedExpensesTypeFixedExpenses = TypeFixedExpense::all();
        return $fixedExpensesTypeFixedExpenses;
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, TypeFixedExpense::getRules());
        if ($validator->fails()) {
            return redirect()->route('Dashboard.Admin.FixedExpenses.Panel', ['#createModalTypeFixedExpenses'])->withErrors($validator)->withInput();
        }
        $fixedExpenseTypeFixedExpense = TypeFixedExpense::create($data);
        $fixedExpenseTypeFixedExpense->save();
        return redirect()->route('Dashboard.Admin.FixedExpenses.Panel')->with('success', 'Tipo De Gasto Fijo ' . $fixedExpenseTypeFixedExpense->gastoFijo . ' agregado correctamente.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        if (array_key_exists('opcionUnica', $data)) {
            // Verificar el valor de "opcionUnica"
            if ($data['opcionUnica'] == "on") {
                $data['opcionUnica'] = true;
            }
        } else {
            $data['opcionUnica'] = false;
        }
        $validator = Validator::make($data, TypeFixedExpense::getRules($id));
        if ($validator->fails()) {
            return redirect()->to(url()->previous())
                ->withErrors($validator)
                ->withInput()
                ->withFragment('#editModalTypeFixedExpenses_' . $id);
        }
        $fixedExpenseTypeFixedExpense = TypeFixedExpense::findOrFail($id);
        $fixedExpenseTypeFixedExpense->update($data);
        return back()->with('update', 'Tipo De Gasto Fijo ' . $fixedExpenseTypeFixedExpense->gastoFijo . ' actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $fixedExpenseTypeFixedExpense = TypeFixedExpense::findOrFail($id);
        $fixedExpenseTypeFixedExpense->delete();
        return redirect()->route('Dashboard.Admin.FixedExpenses.Panel')->with('danger', 'Tipo De Gasto Fijo ' . $fixedExpenseTypeFixedExpense->gastoFijo . ' eliminado correctamente.');
    }
}