<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExamplesController extends Controller
{
    public function Modal()
    {
        return view('Examples.Modal');
    }
}
