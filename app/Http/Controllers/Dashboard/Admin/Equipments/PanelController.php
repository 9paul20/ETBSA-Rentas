<?php

namespace App\Http\Controllers\Dashboard\Admin\Equipments;

use App\Http\Controllers\Controller;
use App\Models\Equipments\Category;
use App\Models\Equipments\Status;
use App\Models\Equipments\TypeCategory;
use App\Models\Rents\CupRent;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PanelController extends Controller
{
    public function Panel()
    {
        // Todos los Tipos De Categorias
        $allTypeCategories = TypeCategory::get(['clvTipoCategoria', 'tipoCategoria']);

        //Paginación
        $perPage = 10;

        //Disponibilidades
        $status = Status::all();
        $columnStatus = ['Disponibilidad', 'Descripción', ''];
        $currentPageStatus = request()->get('status_page') ?? 1;
        $pagedStatusData = $status->slice(($currentPageStatus - 1) * $perPage, $perPage)->all();
        $rowStatus = new LengthAwarePaginator($pagedStatusData, count($status), $perPage, $currentPageStatus, [
            'path' => route('Dashboard.Admin.Equipments.Panel'),
            'pageName' => 'status_page', // Agrega 'pageName' y establece un nombre único para el parámetro de paginación
        ]);
        $tableStatus = [
            'columnStatus' => $columnStatus,
            'rowStatus' => $rowStatus,
        ];

        //TipoCategorias
        $typeCategories = TypeCategory::all();
        $columnTypeCategories = ['Tipo De Categorias', 'Descripción', ''];
        $currentPageTypeCategories = request()->get('typeCategories_page') ?? 1;
        $pagedTypeCategoriesData = $typeCategories->slice(($currentPageTypeCategories - 1) * $perPage, $perPage)->all();
        $rowTypeCategories = new LengthAwarePaginator($pagedTypeCategoriesData, count($typeCategories), $perPage, $currentPageTypeCategories, [
            'path' => route('Dashboard.Admin.Equipments.Panel'),
            'pageName' => 'typeCategories_page',
        ]);
        $tableTypeCategories = [
            'columnTypeCategories' => $columnTypeCategories,
            'rowTypeCategories' => $rowTypeCategories,
        ];

        //Categorias
        // $categories = Category::all();
        $categories = Category::select('clvCategoria', 'categoria', 'clvTipoCategoria', 'descripcion')
            ->with(['tipoCategoria' => function ($query) {
                $query->select('clvTipoCategoria', 'tipoCategoria');
            }])
            ->get();
        $columnCategories = ['Categorias', 'Tipo De Categoria', 'Descripción', ''];
        $currentPageCategories = request()->get('categories_page') ?? 1;
        $pagedCategoriesData = $categories->slice(($currentPageCategories - 1) * $perPage, $perPage)->all();
        $rowCategories = new LengthAwarePaginator($pagedCategoriesData, count($categories), $perPage, $currentPageCategories, [
            'path' => route('Dashboard.Admin.Equipments.Panel'),
            'pageName' => 'categories_page',
        ]);
        $tableCategories = [
            'columnCategories' => $columnCategories,
            'rowCategories' => $rowCategories,
        ];

        //Tazas de renta
        $cupsRents = CupRent::all();
        $columnCupsRents = ['Taza de Renta', 'Precio Renta Un Mes', 'Precio Renta Dos Meses', 'Precio Renta Tres Mes', 'IVA Un Mes', 'IVA Dos Meses', 'IVA Tres Meses', 'Descripción', ''];
        $currentPageCupsRents = request()->get('cupsRents_page') ?? 1;
        $pagedCupsRentsData = $cupsRents->slice(($currentPageCupsRents - 1) * $perPage, $perPage)->all();
        $rowCupsRents = new LengthAwarePaginator($pagedCupsRentsData, count($cupsRents), $perPage, $currentPageCupsRents, [
            'path' => route('Dashboard.Admin.Equipments.Panel'),
            'pageName' => 'cupsRents_page', // Agrega 'pageName' y establece un nombre único para el parámetro de paginación
        ]);
        $tableCupsRents = [
            'columnCupsRents' => $columnCupsRents,
            'rowCupsRents' => $rowCupsRents,
        ];

        //Arreglo de todos los datos
        $Data = [
            'allTypeCategories' => $allTypeCategories,
            'tableStatus' => $tableStatus,
            'tableTypeCategories' => $tableTypeCategories,
            'tableCategories' => $tableCategories,
            'tableCupsRents' => $tableCupsRents,
        ];
        // return $Data;
        return view('Dashboard.Admin.Index', compact('Data'));
    }
}