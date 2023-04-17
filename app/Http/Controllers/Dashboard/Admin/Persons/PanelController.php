<?php

namespace App\Http\Controllers\Dashboard\Admin\Persons;

use App\Http\Controllers\Controller;
use App\Models\Persons\ComTel;
use App\Models\Persons\Nationality;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PanelController extends Controller
{
    public function Panel()
    {
        //Paginación
        $perPage = 10;

        //Compañias Telefónicas
        $comTels = ComTel::all();
        $columnComTels = ['Compañia Telefónica', 'Descripción', ''];
        $currentPageComTels = request()->get('comtels_page') ?? 1;
        $pagedComTelsData = $comTels->slice(($currentPageComTels - 1) * $perPage, $perPage)->all();
        $rowComTels = new LengthAwarePaginator($pagedComTelsData, count($comTels), $perPage, $currentPageComTels, [
            'path' => route('Dashboard.Admin.Persons.Panel'),
            'pageName' => 'comtels_page', // Agrega 'pageName' y establece un nombre único para el parámetro de paginación
        ]);
        $tableComTels = [
            'columnComTels' => $columnComTels,
            'rowComTels' => $rowComTels,
        ];

        //Nacionalidades
        $nacionalidades = Nationality::all();
        $columnNacionalidades = ['Nacionalidad', 'Descripción', ''];
        $currentPageNacionalidades = request()->get('nacionalidades_page') ?? 1;
        $pagedNacionalidadesData = $nacionalidades->slice(($currentPageNacionalidades - 1) * $perPage, $perPage)->all();
        $rowNacionalidades = new LengthAwarePaginator($pagedNacionalidadesData, count($nacionalidades), $perPage, $currentPageNacionalidades, [
            'path' => route('Dashboard.Admin.Persons.Panel'),
            'pageName' => 'nacionalidades_page',
        ]);
        $tableNacionalidades = [
            'columnNacionalidades' => $columnNacionalidades,
            'rowNacionalidades' => $rowNacionalidades,
        ];

        $Data = [
            'tableComTels' => $tableComTels,
            'tableNacionalidades' => $tableNacionalidades,
        ];
        // return $Data;
        return view('Dashboard.Admin.Index', compact('Data'));
    }
}