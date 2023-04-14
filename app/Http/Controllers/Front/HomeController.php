<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Front/index');
    }

    public function error403()
    {
        return view('Front/Errors/403');
    }

    public function error404()
    {
        return view('Front/Errors/404');
    }
}
