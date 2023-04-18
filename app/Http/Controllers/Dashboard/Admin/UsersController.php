<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
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
        // $response = Http::get('http://etbsa-rentas.test/api/UsersListAPI');
        // $rD = $response->json();
        // $users = collect($rD);
        // $users = User::all();
        $users = User::with(['persona'])->get();
        $perPage = 10;
        $currentPage = request()->get('page') ?? 1;
        $pagedData = $users->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $rowDatas = new LengthAwarePaginator($pagedData, count($users), $perPage, $currentPage, [
            'path' => route('Dashboard.Admin.Users.Index')
        ]);
        $columnNames = ['Name', 'State', 'Role', 'Team', ''];
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

        // return response()->json([
        //     'message' => 'Usuario creado exitosamente',
        //     'user' => $user,
        // ], 201);
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
        // if (!$user) {
        //     return response()->json(['message' => 'Usuario no encontrado'], 404);
        // }
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
        // if (!$user) {
        //     return response()->json(['message' => 'Usuario no encontrado'], 404);
        // }
        return back()->with('update', 'Contraseña del Usuario ' . $user->name . ' actualizados correctamente.');
    }

    public function updateRoles(Request $request, string $id)
    {
        $this->authorize('update', User::class);
        $user = User::findOrFail($id);
        $roles = $request->input('roles', []);
        $user->roles()->sync($roles);
        return back()->with('update', 'Roles del Usuario ' . $user->name . ' actualizados correctamente.');
        // $permissions_data = array_map(function ($id) {
        //     return compact('id');
        // }, $permissions);
        // dd($permissions_data);
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
        // if (!$user) {
        //     return response()->json(['message' => 'Usuario no encontrado'], 404);
        // }

        // $user->delete();

        // return response()->json(['message' => 'Usuario eliminado correctamente']);
        $user->delete();
        return redirect()->route('Dashboard.Admin.Users.Index')->with('danger', 'Usuario ' . $user->name . ' eliminado correctamente.');
    }
}