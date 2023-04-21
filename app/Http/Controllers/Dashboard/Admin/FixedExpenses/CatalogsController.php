<?php

namespace App\Http\Controllers\Dashboard\Admin\FixedExpenses;

use App\Http\Controllers\Controller;
use App\Models\FixedExpenses\Catalog;
use Illuminate\Http\Request;
use Validator;

class CatalogsController extends Controller
{
    public function indexAPI()
    {
        $fixedExpensesCatalogs = Catalog::all();
        return $fixedExpensesCatalogs;
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, Catalog::getRules());
        if ($validator->fails()) {
            return redirect()->route('Dashboard.Admin.FixedExpenses.Panel', ['#createModalFixedExpensesCatalogs'])->withErrors($validator)->withInput();
        }
        $fixedExpenseCatalog = Catalog::create($data);
        $fixedExpenseCatalog->save();
        return redirect()->route('Dashboard.Admin.FixedExpenses.Panel')->with('success', 'Estado Gasto Fijo ' . $fixedExpenseCatalog->gastoFijo . ' agregado correctamente.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $validator = Validator::make($data, Catalog::getRules($id));
        if ($validator->fails()) {
            return redirect()->to(url()->previous())
                ->withErrors($validator)
                ->withInput()
                ->withFragment('#editModalFixedExpensesCatalogs_' . $id);
        }
        $fixedExpenseCatalog = Catalog::findOrFail($id);
        $fixedExpenseCatalog->update($data);
        return back()->with('update', 'Estado Gasto Fijo ' . $fixedExpenseCatalog->gastoFijo . ' actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $fixedExpenseCatalog = Catalog::findOrFail($id);
        $fixedExpenseCatalog->delete();
        return redirect()->route('Dashboard.Admin.FixedExpenses.Panel')->with('danger', 'Estado Gasto Fijo ' . $fixedExpenseCatalog->gastoFijo . ' eliminado correctamente.');
    }
}
