<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Validator;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::all();
        $perPage = 10;
        $currentPage = request()->get('page') ?? 1;
        $pagedData = $permissions->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $rowDatas = new LengthAwarePaginator($pagedData, count($permissions), $perPage, $currentPage, [
            'path' => route('Dashboard.Admin.Permissions.Index')
        ]);
        $columnNames = ['Name', 'Display Name', 'Description', 'guard_name', ''];
        return view('Dashboard.Admin.Index', compact('columnNames', 'rowDatas'));
    }

    public function indexAPI()
    {
        $permissions = Permission::all();
        return $permissions;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permission = new Permission();
        return view('Dashboard.Admin.Index', compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, Permission::getRules());

        if ($validator->fails()) {
            return redirect()->route('Dashboard.Admin.Permissions.Create')
                ->withErrors($validator)
                ->withInput();
        }

        $permission = new Permission;
        $permission->name = $data['name'];
        $permission->display_name = $data['display_name'];
        $permission->description = $data['description'];
        $permission->guard_name = $data['guard_name'];

        // Guardar el usuario en la base de datos
        $permission->save();
        return redirect()->route('Dashboard.Admin.Permissions.Index')->with('success', 'Elemento agregado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function showApi($id)
    {
        $permission = Permission::findOrFail($id);
        return $permission;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $permission = Permission::findOrFail($id);
        return view('Dashboard.Admin.Index', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $permission = Permission::findOrFail($id);
        $validator = Validator::make($data, Permission::getRules($id));

        if ($validator->fails()) {
            return redirect()->route('Dashboard.Admin.Permissions.Edit', ['Permission' => $id])
                ->withErrors($validator)
                ->withInput();
        }
        $permission->name = $request->input('name');
        $permission->display_name = $request->input('display_name');
        $permission->description = $request->input('description');
        $permission->guard_name = $request->input('guard_name');
        $permission->save();

        return back()->with('update', 'Elemento actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        return redirect()->route('Dashboard.Admin.Permissions.Index')->with('danger', 'Elemento eliminado correctamente.');
    }
}
