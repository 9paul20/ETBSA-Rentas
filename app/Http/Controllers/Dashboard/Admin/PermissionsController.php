<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('view', Permission::class);
        $permissions = Permission::all();
        $permission = Permission::class;
        $perPage = 10;
        $currentPage = request()->get('page') ?? 1;
        $pagedData = $permissions->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $rowDatas = new LengthAwarePaginator($pagedData, count($permissions), $perPage, $currentPage, [
            'path' => route('Dashboard.Admin.Permissions.Index')
        ]);
        $columnNames = ['Name', 'Display Name', 'Description', 'Guard Name', ''];
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
        $this->authorize('create', Permission::class);
        $permission = new Permission();
        return view('Dashboard.Admin.Index', compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Permission::class);
        $data = $request->validate(
            [
                'name' => 'required|string|min:4|max:255|unique:permissions',
                'display_name' => 'required|string|min:4|max:255|unique:permissions',
                'description' => 'required|string|min:4',
                'guard_name' => 'required|string|min:3|max:255',
            ],
        );
        $permission = Permission::create($data);
        return redirect()->route('Dashboard.Admin.Permissions.Index')->with('success', 'Permiso ' . $permission->name . ' agregado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->authorize('viewAny', Permission::class);
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
        $this->authorize('update', Permission::class);
        $permission = Permission::findOrFail($id);
        return view('Dashboard.Admin.Index', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize('update', Permission::class);
        $data = $request->all();
        $permission = Permission::findOrFail($id);
        $data = $request->validate(
            [
                'name' => 'required|string|min:4|max:255|unique:permissions,name,' . $id,
                'display_name' => 'required|string|min:4|max:255|unique:permissions,display_name,' . $id,
                'description' => 'required|string|min:4',
                'guard_name' => 'required|string|min:3|max:255',
            ],
        );
        $permission->update($data);
        return back()->with('update', 'Permiso ' . $permission->name . ' actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('delete', Permission::class);
        $permission = Permission::findOrFail($id);
        $permission->delete();
        return redirect()->route('Dashboard.Admin.Permissions.Index')->with('danger', 'Permiso ' . $permission->name . ' eliminado correctamente.');
    }
}