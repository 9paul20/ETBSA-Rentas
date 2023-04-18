<?php

namespace App\Http\Controllers\Dashboard\Admin\Rents;

use App\Http\Controllers\Controller;
use App\Models\Rents\CupRent;
use App\Models\Rents\PaymentRent;
use App\Models\Rents\StatusPaymentRent;
use App\Models\Rents\StatusRent;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PanelController extends Controller
{
    public function Panel()
    {
        //Todos -> Estados Pagos de Rentas
        $allStatusPaymentsRents = StatusPaymentRent::get(['clvEstadoPagoRenta', 'estadoPagoRenta', 'descripcion']);

        // // Todos -> Tazas De Renta
        // $allCupsRents = CupRent::get([
        //     'clvTazaRenta',
        //     'tazaRenta',
        //     'rentaUnMes',
        //     'rentaDosMeses',
        //     'rentaTresMeses',
        //     'ivaUnMes',
        //     'ivaDosMeses',
        //     'ivaTresMeses',
        // ]);

        //Paginación
        $perPage = 10;

        //Estados Pagos de Renta
        $statusPaymentsRents = StatusPaymentRent::all();
        $columnStatusPaymentsRents = ['Estados Pagos de Renta', 'Descripción', ''];
        $currentPageStatusPaymentsRents = request()->get('statusPaymentsRents_page') ?? 1;
        $pagedStatusPaymentsRentsData = $statusPaymentsRents->slice(($currentPageStatusPaymentsRents - 1) * $perPage, $perPage)->all();
        $rowStatusPaymentsRents = new LengthAwarePaginator($pagedStatusPaymentsRentsData, count($statusPaymentsRents), $perPage, $currentPageStatusPaymentsRents, [
            'path' => route('Dashboard.Admin.Rents.Panel'),
            'pageName' => 'statusPaymentsRents_page',
        ]);
        $tableStatusPaymentsRents = [
            'columnStatusPaymentsRents' => $columnStatusPaymentsRents,
            'rowStatusPaymentsRents' => $rowStatusPaymentsRents,
        ];

        //Pagos de Renta
        // $paymentsRents = PaymentRent::all();
        $paymentsRents = PaymentRent::select('clvPagoRenta', 'pagoRenta', 'ivaRenta', 'clvEstadoPagoRenta', 'descripcion')
            ->with(['estadoPagoRenta' => function ($query) {
                $query->select('clvEstadoPagoRenta', 'estadoPagoRenta');
            }])
            ->get();
        $columnPaymentsRents = ['Pago de Renta', 'IVA de Renta', 'Total de Renta', 'Estado Del Pago de Renta', 'Descripción', ''];
        $currentPagePaymentsRents = request()->get('paymentsRents_page') ?? 1;
        $pagedPaymentsRentsData = $paymentsRents->slice(($currentPagePaymentsRents - 1) * $perPage, $perPage)->all();
        $rowPaymentsRents = new LengthAwarePaginator($pagedPaymentsRentsData, count($paymentsRents), $perPage, $currentPagePaymentsRents, [
            'path' => route('Dashboard.Admin.Rents.Panel'),
            'pageName' => 'paymentsRents_page',
        ]);
        $tablePaymentsRents = [
            'columnPaymentsRents' => $columnPaymentsRents,
            'rowPaymentsRents' => $rowPaymentsRents,
        ];

        //Estados de Renta
        $statusRents = StatusRent::all();
        $columnStatusRents = ['Estados de Renta', 'Descripción', ''];
        $currentPageStatusRents = request()->get('statusRents_page') ?? 1;
        $pagedStatusRentsData = $statusRents->slice(($currentPageStatusRents - 1) * $perPage, $perPage)->all();
        $rowStatusRents = new LengthAwarePaginator($pagedStatusRentsData, count($statusRents), $perPage, $currentPageStatusRents, [
            'path' => route('Dashboard.Admin.Rents.Panel'),
            'pageName' => 'statusRents_page',
        ]);
        $tableStatusRents = [
            'columnStatusRents' => $columnStatusRents,
            'rowStatusRents' => $rowStatusRents,
        ];

        //Arreglo de todos los datos
        $Data = [
            'allStatusPaymentsRents' => $allStatusPaymentsRents,
            // 'allCupsRents' => $allCupsRents,
            'tableStatusPaymentsRents' => $tableStatusPaymentsRents,
            'tablePaymentsRents' => $tablePaymentsRents,
            'tableStatusRents' => $tableStatusRents,
        ];
        // return $Data;
        return view('Dashboard.Admin.Index', compact('Data'));
    }
}