<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $response = Http::get('http://etbsa-rentas.test/api/UsersListAPI');
        // $rowDatas = $response->json();
        // $columnNames = ['Name', 'State', 'Role', 'Team', 'Actions'];
        // return view('Dashboard.Admin.Users.Index', compact('columnNames','rowDatas'));
        $response = Http::get('http://etbsa-rentas.test/api/UsersListAPI');
        $rD = $response->json();
        $columnNames = ['Name', 'State', 'Role', 'Team', ''];
        $users = collect($rD);
        $perPage = 10;
        $currentPage = request()->get('page') ?? 1;
        $pagedData = $users->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $rowDatas = new LengthAwarePaginator($pagedData, count($users), $perPage, $currentPage, [
            'path' => route('Dashboard.Admin.Users.Index')
        ]);
        return view('Dashboard.Admin.Users.Index', compact('columnNames', 'rowDatas'));
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
        return view('Dashboard.Admin.Users.Index', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->json()->all();

        // Valida los datos enviados
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Los datos enviados son inválidos',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Crea el usuario
        $user = new User;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->save();

        return response()->json([
            'message' => 'Usuario creado exitosamente',
            'user' => $user,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = User::findOnFail($request->id);
        // $request-> = $request->;
        $user->save();
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $user = User::destroy($request->id);
        return $user;
    }
}
