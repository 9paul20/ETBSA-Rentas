<!-- Pagos De Renta -->
<div class="transition hover:bg-green-50 overflow-hidden rounded-lg p-2 mb-2">
    <!-- header -->
    <div class="accordion-header cursor-pointer transition flex space-x-5 px-5 items-center h-16">
        <i class="fas fa-angle-down"></i>
        <h3>Pagos De Renta</h3>
    </div>
    <!-- Content -->
    <div class="accordion-content px-2 pt-0 overflow-hidden max-h-0 mb-2">
        <div class="bg-white rounded-lg border px-4 sm:px-6 lg:px-8 py-6">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-xl font-semibold text-gray-900">Pagos De Renta</h1>
                </div>
                <x-Dashboard.Rents.PaymentsRents.Button-Create-Modal text="Añadir Pago De Renta"
                    action="{{ route('Dashboard.Admin.Panel.Rents.PaymentRent.Store') }}"
                    SelectStatusPaymentRent="{{ view('Components.Dashboard.Rents.PaymentsRents.Selects.SelectCreate-StatusPaymentsRents', compact('Data'))->render() }}" />
            </div>
            @if (count($Data['tablePaymentsRents']['rowPaymentsRents']) > 0)
            <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
                <div class="relative text-gray-600 py-1">
                    <input type="search" name="serch" placeholder="Realizar Busqueda"
                        class="bg-white h-10 px-5 pr-4 rounded-full text-sm focus:outline-none">
                </div>
                <div class="overflow-x-auto">
                    <table
                        class="min-w-full border-collapse bg-white text-left text-sm text-gray-500 divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                @foreach ($Data['tablePaymentsRents']['columnPaymentsRents'] as $columnPaymentRent)
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                    {{ $columnPaymentRent }}
                                </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 border-t  bg-white">
                            @foreach ($Data['tablePaymentsRents']['rowPaymentsRents'] as $rowPaymentRent)
                            <tr class="hover:bg-gray-100">
                                <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                                    <div class="text-sm">
                                        <div class="font-medium text-gray-700">
                                            <span class="font-medium text-green-600">$</span>
                                            {{ $rowPaymentRent->pagoRenta }}
                                        </div>
                                    </div>
                                </th>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    <div class="text-sm">
                                        <div class="font-medium text-gray-700">
                                            <span class="font-medium text-green-600">$</span>
                                            {{ $rowPaymentRent->ivaRenta }}
                                        </div>
                                    </div>
                                </td>
                                <td class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                                    <div class="text-sm">
                                        <div class="font-medium text-gray-700">
                                            <span class="font-medium text-green-600">$</span>
                                            {{ $rowPaymentRent->pagoRenta + $rowPaymentRent->ivaRenta }}
                                        </div>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    @if (!empty($rowPaymentRent->estadoPagoRenta->estadoPagoRenta))
                                    <span
                                        class="inline-flex items-center gap-1 rounded-full {{ $rowPaymentRent->estadoPagoRenta->bgColorPrimary }} px-2 py-1 text-sm font-semibold {{ $rowPaymentRent->estadoPagoRenta->textColor }}">
                                        <span
                                            class="h-1.5 w-1.5 rounded-full {{ $rowPaymentRent->estadoPagoRenta->bgColorSecondary }}"></span>
                                        {{ $rowPaymentRent->estadoPagoRenta->estadoPagoRenta }}
                                    </span>
                                    @else
                                    <div class="font-medium text-orange-700">Sin Estados Pagos De Renta</div>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    @if (!empty($rowPaymentRent->descripcion))
                                    <div class="text-gray-700 truncate break-words max-w-sm">
                                        {{ $rowPaymentRent->descripcion }}</div>
                                    @else
                                    <div class="font-medium text-orange-700">Sin Descripción</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-end gap-4">
                                        <x-Dashboard.IconButton-Show_SA
                                            id="PaymentRent_{{ $rowPaymentRent->clvPagoRenta }}"
                                            name="Pago De Renta: ${{ $rowPaymentRent->pagoRenta }}, IVA De Renta: ${{ $rowPaymentRent->ivaRenta }}, Total: ${{ $rowPaymentRent->pagoRenta + $rowPaymentRent->ivaRenta }}"
                                            description="{{ $rowPaymentRent->descripcion }}" href="" />
                                        <x-Dashboard.Rents.PaymentsRents.Button-Edit-Modal
                                            id="PaymentRent_{{ $rowPaymentRent->clvPagoRenta }}"
                                            pagoRenta="{{ $rowPaymentRent->pagoRenta }}"
                                            ivaRenta="{{ $rowPaymentRent->ivaRenta }}"
                                            SelectStatusPaymentRent="{{ view('Components.Dashboard.Rents.PaymentsRents.Selects.SelectEdit-StatusPaymentsRents', ['Data' => $Data, 'clvEstadoPagoRenta' => $rowPaymentRent->clvEstadoPagoRenta])->render() }}"
                                            descripcion="{{ $rowPaymentRent->descripcion }}"
                                            href="{{ route('Dashboard.Admin.Panel.Rents.PaymentRent.Update', $rowPaymentRent->clvPagoRenta) }}" />
                                        <x-Dashboard.IconButton-Delete
                                            id="PaymentRent_{{ $rowPaymentRent->clvPagoRenta }}"
                                            name="{{ $rowPaymentRent->pagoRenta }}"
                                            href="{{ route('Dashboard.Admin.Panel.Rents.PaymentRent.Destroy', $rowPaymentRent->clvPagoRenta) }}" />
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $Data['tablePaymentsRents']['rowPaymentsRents']->appends(['paymentsRents_page' =>
                $Data['tablePaymentsRents']['rowPaymentsRents']->currentPage()])->links('vendor.pagination.tailwind') }}
            </div>
            @else
            <main class="flex items-center justify-center flex-1 px-4 py-8">
                <!-- Content -->
                <h1 class="text-5xl font-bold text-gray-500">No hay datos en Pagos De Renta</h1>
            </main>
            @endif
        </div>
    </div>
</div>