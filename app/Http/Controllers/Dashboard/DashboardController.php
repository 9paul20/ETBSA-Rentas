<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $roles = Cache::remember('roles_user_' . $user->id, 60, function () use ($user) {
            return $user->roles()->get();
        });
        $permissions = Cache::remember('permissions_user_' . $user->id, 60, function () use ($user) {
            return $user->getAllPermissions();
        });
        $userPermissions = Cache::remember('user_permissions_' . $user->id, 60, function () use ($user) {
            return $user->permissions;
        });
        $rowDatas = [];
        $columnNames = [];
        return view('Dashboard/Index/Index', compact('columnNames', 'rowDatas'));
    }

    public function registerContinue()
    {
        return view('Dashboard/Index/UpdateProfile');
    }
}
