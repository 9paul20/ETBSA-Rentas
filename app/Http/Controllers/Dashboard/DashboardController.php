<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $rowDatas = [];
        $columnNames = [];
        return view('Dashboard/Index/Index', compact('columnNames', 'rowDatas'));
    }
    public function users()
    {
        return view('Dashboard/Admin/Users/Index');
    }
    public function registerContinue()
    {
        return view('Dashboard/UpdateProfile');
    }
}
