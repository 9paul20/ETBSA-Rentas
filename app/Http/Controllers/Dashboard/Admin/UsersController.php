<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Models\Role;
use Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('view', User::class);

        $rowDatas = User::with([
            'persona:clvPersona,nombrePersona,apePaternoPersona,apeMaternoPersona',
            'roles.permissions',
        ])->paginate(10, [
            'id',
            'clvPersona',
            'name',
            'email',
            'active',
        ]);
        $columnNames = [
            'Name',
            'State',
            'Role',
            'Team',
            ''
        ];
        $rowDatas->appends(request()->query());
        return view('Dashboard.Admin.Index', compact('columnNames', 'rowDatas'));
    }

    public function indexAPI()
    {
        $users = User::all();
        return $users;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', User::class);
        $user = new User();
        return view('Dashboard.Admin.Index', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', User::class);
        $data = $request->all();

        $validator = Validator::make($data, User::getRules());
        if ($validator->fails()) {
            return redirect()->route('Dashboard.Admin.Users.Create')
                ->withErrors($validator)
                ->withInput();
        }
        $user = User::create($data);

        // Obtener el ID del usuario recién creado
        $id = $user->id;

        // Establecer el valor de clvPersona en el ID del usuario
        $user->clvPersona = $id;

        // Guardar el modelo de usuario actualizado en la base de datos
        $user->save();

        return redirect()->route('Dashboard.Admin.Users.Index')->with('success', 'Usuario ' . $user->name . ' agregado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $this->authorize('viewAny', User::class);
        $user = User::findOrFail($id);
        return view('Dashboard.Admin.Index', compact('user'));
    }

    public function showApi($id)
    {
        $user = User::findOrFail($id);
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->authorize('update', User::class);
        $user = User::findOrFail($id);
        $roles = Role::all();
        $permissions = Permission::all();
        return view('Dashboard.Admin.Index', compact('user', 'roles', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize('update', User::class);
        $data = $request->all();
        $validator = Validator::make($data, User::getRulesUser($id));
        if ($validator->fails()) {
            return redirect()->route('Dashboard.Admin.Users.Edit', ['User' => $id])
                ->withErrors($validator)
                ->withInput();
        }
        $user = User::findOrFail($id);
        $user->update($data);
        return back()->with('update', 'Datos del Usuario ' . $user->name . ' actualizados correctamente.');
    }

    public function updatePassword(Request $request, string $id)
    {
        $this->authorize('update', User::class);
        $data = $request->all();
        $validator = Validator::make($data, User::getRulesPassword($id));
        if ($validator->fails()) {
            return redirect()->route('Dashboard.Admin.Users.Edit', ['User' => $id])
                ->withErrors($validator)
                ->withInput();
        }
        $user = User::findOrFail($id);
        $user->update($data);
        return back()->with('update', 'Contraseña del Usuario ' . $user->name . ' actualizados correctamente.');
    }

    public function updateRoles(Request $request, string $id)
    {
        $this->authorize('update', User::class);
        $user = User::findOrFail($id);
        $roles = $request->input('roles', []);
        $user->roles()->sync($roles);
        return back()->with('update', 'Roles del Usuario ' . $user->name . ' actualizados correctamente.');
    }

    public function updatePermissions(Request $request, string $id)
    {
        $this->authorize('update', User::class);
        $user = User::findOrFail($id);
        $permissions = $request->input('permissions', []);
        $user->permissions()->sync($permissions);
        return back()->with('update', 'Permisos del Usuario ' . $user->name . ' actualizados correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->authorize('delete', User::class);
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('Dashboard.Admin.Users.Index')->with('danger', 'Usuario ' . $user->name . ' eliminado correctamente.');
    }
}