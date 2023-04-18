<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('view', Role::class);
        $roles = Role::with('permissions')->get();
        $perPage = 10;
        $currentPage = request()->get('page') ?? 1;
        $pagedData = $roles->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $rowDatas = new LengthAwarePaginator($pagedData, count($roles), $perPage, $currentPage, [
            'path' => route('Dashboard.Admin.Roles.Index')
        ]);
        $columnNames = ['Name', 'Display Name', 'Description', 'Guard Name', 'Permissions', ''];
        return view('Dashboard.Admin.Index', compact('columnNames', 'rowDatas'));
    }

    public function indexAPI()
    {
        $roles = Role::all();
        return $roles;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Role::class);
        $role = new Role();
        return view('Dashboard.Admin.Index', compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Role::class);
        $data = $request->validate(
            [
                'name' => 'required|string|min:4|max:255|unique:roles',
                'display_name' => 'required|string|min:4|max:255|unique:roles',
                'description' => 'required|string|min:4',
                'guard_name' => 'required|string|min:3|max:255',
            ],
        );
        $role = Role::create($data);
        return redirect()->route('Dashboard.Admin.Roles.Index')->with('success', 'Rol ' . $role->name . ' agregado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->authorize('viewAny', Role::class);
        $role = Role::findOrFail($id);
    }

    public function showApi($id)
    {
        $group = Role::findOrFail($id);
        return $group;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $this->authorize('update', Role::class);
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('Dashboard.Admin.Index', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize('update', Role::class);
        $data = $request->all();
        $role = Role::findOrFail($id);
        $data = $request->validate(
            [
                'name' => 'required|string|min:4|max:255|unique:roles,name,' . $id,
                'display_name' => 'required|string|min:4|max:255|unique:roles,display_name,' . $id,
                'description' => 'required|string|min:4',
                'guard_name' => 'required|string|min:3|max:255',
            ],
        );
        $role->update($data);
        return back()->with('update', 'Rol ' . $role->name . ' actualizado correctamente.');
    }

    public function updatePermissions(Request $request, string $id)
    {
        $this->authorize('update', Role::class);
        $role = Role::findOrFail($id);
        $permissions = $request->input('permissions', []);
        $role->permissions()->sync($permissions);
        return back()->with('update', 'Permisos de Rol ' . $role->name . ' actualizados correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('delete', Role::class);
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->route('Dashboard.Admin.Roles.Index')->with('danger', 'Rol ' . $role->name . ' eliminado correctamente.');
    }
}