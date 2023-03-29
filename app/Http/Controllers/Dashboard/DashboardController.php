<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('Dashboard/sideBar');
    }
    public function registerContinue()
    {
        return view('Dashboard/updateProfile');
    }
}
