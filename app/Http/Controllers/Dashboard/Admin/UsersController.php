<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $response = Http::get('http://etbsa-rentas.test/api/UsersListAPI');
        // $rD = $response->json();
        // $users = collect($rD);
        $users = User::all();
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
        $user = new User();
        return view('Dashboard.Admin.Index', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, User::getRules());

        if ($validator->fails()) {
            return redirect()->route('Dashboard.Admin.Users.Create')
                ->withErrors($validator)
                ->withInput();
        }

        $user = new User;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];

        // Guardar el usuario en la base de datos
        $user->save();

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
        return redirect()->route('Dashboard.Admin.Users.Index')->with('success', 'Elemento agregado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
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
        $user = User::findOrFail($id);
        return view('Dashboard.Admin.Index', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $user = User::findOrFail($id);
        $validator = Validator::make($data, User::getRules($id));

        if ($validator->fails()) {
            return redirect()->route('Dashboard.Admin.Users.Edit', ['User' => $id])
                ->withErrors($validator)
                ->withInput();
        }
        // if (!$user) {
        //     return response()->json(['message' => 'Usuario no encontrado'], 404);
        // }

        // $user->update($request->all());

        // return response()->json(['message' => 'Usuario actualizado correctamente']);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->save();
        return back()->with('update', 'Elemento actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        // if (!$user) {
        //     return response()->json(['message' => 'Usuario no encontrado'], 404);
        // }

        // $user->delete();

        // return response()->json(['message' => 'Usuario eliminado correctamente']);
        $user->delete();
        return redirect()->route('Dashboard.Admin.Users.Index')->with('danger', 'Elemento eliminado correctamente.');
    }
}
