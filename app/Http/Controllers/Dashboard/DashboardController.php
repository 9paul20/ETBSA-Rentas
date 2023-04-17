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

    public function registerContinue()
    {
        return view('Dashboard/Index/UpdateProfile');
    }
}