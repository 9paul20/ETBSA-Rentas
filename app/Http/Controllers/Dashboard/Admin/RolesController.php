<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Validator;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
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
        $role = new Role();
        return view('Dashboard.Admin.Index', compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, Permission::getRules());

        if ($validator->fails()) {
            return redirect()->route('Dashboard.Admin.Roles.Create')
                ->withErrors($validator)
                ->withInput();
        }

        $role = new Role;
        $role->name = $data['name'];
        $role->display_name = $data['display_name'];
        $role->description = $data['description'];
        $role->guard_name = $data['guard_name'];

        // Guardar el usuario en la base de datos
        $role->save();

        // $group = Group::findOrFail($group->id);
        // dd($group);
        return redirect()->route('Dashboard.Admin.Roles.Edit', $role)->with('success', 'Elemento agregado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
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
    public function edit(string $id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('Dashboard.Admin.Index', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $role = Role::findOrFail($id);
        $validator = Validator::make($data, Role::getRules($id));

        if ($validator->fails()) {
            return redirect()->route('Dashboard.Admin.Roles.Edit', ['Permission' => $id])
                ->withErrors($validator)
                ->withInput();
        }
        $role->name = $request->input('name');
        $role->display_name = $request->input('display_name');
        $role->description = $request->input('description');
        $role->guard_name = $request->input('guard_name');
        $role->save();

        return back()->with('update', 'Elemento actualizado correctamente.');
    }

    public function updatePermissions(Request $request, string $id)
    {
        $role = Role::findOrFail($id);
        $role->name = $request->input('name');
        $role->save();
        return back()->with('update', 'Elemento actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $group = Role::findOrFail($id);
        $group->delete();
        return redirect()->route('Dashboard.Admin.Roles.Index')->with('danger', 'Elemento eliminado correctamente.');
    }
}
