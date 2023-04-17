<?php

namespace App\Http\Controllers\Dashboard\Admin\Equipments;

use App\Http\Controllers\Controller;
use App\Models\Equipments\TypeCategory;
use Illuminate\Http\Request;
use Validator;

class TypeCategoriesController extends Controller
{
    public function indexAPI()
    {
        $typeCategories = TypeCategory::all();
        return $typeCategories;
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, TypeCategory::getRules());
        if ($validator->fails()) {
            return redirect()->route('Dashboard.Admin.Equipments.Panel', ['#createModalTypeCategory'])->withErrors($validator)->withInput();
        }
        $typeCategory = TypeCategory::create($data);
        $typeCategory->save();
        return redirect()->route('Dashboard.Admin.Equipments.Panel')->with('success', 'Tipo de Categoria ' . $typeCategory->tipoCategoria . ' agregado correctamente.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $validator = Validator::make($data, TypeCategory::getRules($id));
        if ($validator->fails()) {
            return redirect()->route('Dashboard.Admin.Equipments.Panel', ['#editModalTypeCategory_' . $id, 'TypeCategory' => $id])
                ->withErrors($validator)
                ->withInput();
        }
        $typeCategory = TypeCategory::findOrFail($id);
        $typeCategory->update($data);
        return back()->with('update', 'Tipo de Categoria ' . $typeCategory->tipoCategoria . ' actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $typeCategory = TypeCategory::findOrFail($id);
        $typeCategory->delete();
        return redirect()->route('Dashboard.Admin.Equipments.Panel')->with('danger', 'Tipo de Categoria ' . $typeCategory->tipoCategoria . ' eliminado correctamente.');
    }
}