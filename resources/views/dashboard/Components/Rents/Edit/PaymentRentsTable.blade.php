@php
    $i = 1;
@endphp
<div class="mx-auto max-w-7xl" id="PaymentsRentsScroll">
    <div class="sm:flex sm:items-center"> {{-- Titulo --}}
        <div class="sm:flex-auto">
            <h1 class="text-xl font-semibold text-gray-900">Pagos De Renta</h1>
        </div>
    </div>
    @if (count($Data['tablePaymentsRents']['rowPaymentsRents']) > 0)
        <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-2">
            <div class="overflow-x-auto">
                <table
                    class="min-w-full border-collapse bg-white text-left text-sm text-gray-500 divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                        <tr>
                            @foreach ($Data['tablePaymentsRents']['columnPaymentsRents'] as $columnPaymentRent)
                                <th scope="col"
                                    class="py-1 pl-4 pr-1 text-left text-sm font-semibold text-gray-900 sm:pl-3">
                                    {{ $columnPaymentRent }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 border-t bg-white text-left">
                        @foreach ($Data['tablePaymentsRents']['rowPaymentsRents'] as $rowPaymentRent)
                            <tr class="hover:bg-gray-100">
                                <th class="flex gap-1 px-3 py-2 font-normal text-gray-900">
                                    <div class="text-sm">
                                        <div class="font-medium text-gray-700">
                                            {{ $i }}</div>
                                    </div>
                                </th>
                                <td class="whitespace-nowrap px-3 py-2 text-sm text-gray-500">
                                    <span
                                        class="inline-flex items-center gap-1 rounded-full {{ $rowPaymentRent->estadoPagoRenta->bgColorPrimary }} px-2 py-1 text-xs font-semibold {{ $rowPaymentRent->estadoPagoRenta->textColor }}">
                                        <span
                                            class="h-1.5 w-1.5 rounded-full {{ $rowPaymentRent->estadoPagoRenta->bgColorSecondary }}"></span>
                                        {{ $rowPaymentRent->estadoPagoRenta->estadoPagoRenta }}
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-3 py-2 text-sm text-gray-500">
                                    @if (isset($rowPaymentRent['fecha_fin']))
                                        <div class="text-gray-600">{{ $rowPaymentRent['fecha_fin'] }}</div>
                                    @else
                                        <div class="text-orange-600">Sin fecha</div>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-3 py-2 text-sm text-gray-500">
                                    <div class="text-gray-600"><span class="font-medium text-green-600">$</span>
                                        {{ number_format($rowPaymentRent['pagoRenta'] + $rowPaymentRent['ivaRenta'], 2) }}
                                    </div>
                                </td>
                                <td class="px-3 py-2">
                                    <div class="flex justify-end gap-4">
                                        <x-Dashboard.IconButton-Show_SA id="PaymentRentShow_{{ $i }}"
                                            name="Pago De Renta No.{{ $i }}"
                                            description="Pago Mensual: ${{ number_format($rowPaymentRent['pagoRenta'], 2) }}, IVA: ${{ number_format($rowPaymentRent['ivaRenta'], 2) }}, Total: ${{ number_format($rowPaymentRent['pagoRenta'] + $rowPaymentRent['ivaRenta'], 2) }}"
                                            href="" />
                                        @foreach ($Data['arrayStatusPayments'] as $statusPayment)
                                            @if ($rowPaymentRent->estadoPagoRenta->estadoPagoRenta == $statusPayment['estadoPagoRenta'])
                                                <x-Dashboard.Rents.PaymentsRents.ChangeStatusPaymentRent_SA
                                                    id="PaymentRentChangeStatusPaymentRent_{{ $i }}"
                                                    name="Pago De Renta No.{{ $i }}"
                                                    statusPaymentRent="{{ $statusPayment['estadoPagoRenta'] }}"
                                                    description="¿Cambiar estado del pago {{ $statusPayment['cambio'] }}?"
                                                    href="{{ route('Dashboard.Admin.Rents.ChangeStatusPaymentRent', ['PaymentRent' => $rowPaymentRent]) }}" />
                                            @endif
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                        <tr class="bg-gray-50" id="total-gastos-variables">
                            <td class="px-3 py-2 font-semibold text-gray-900">Total:</td>
                            <td>
                                <p class="text-xs text-gray-500 font-normal">Meses Pagados: <span
                                        class="text-green-500">{{ $Data['rent']['pagados'] }}</span></p>
                                <p class="text-xs text-gray-500 font-normal">Meses Pendientes de Pagar: <span
                                        class="text-orange-500">{{ $Data['rent']['pendientes'] }}</span></p>
                                <p class="text-xs text-gray-500 font-normal">Meses En mora: <span
                                        class="text-red-500">{{ $Data['rent']['mora'] }}</span></p>
                            </td>
                            <td></td>
                            <td class="whitespace-nowrap px-3 py-2 text-sm text-gray-500 font-semibold"
                                id="total-costo-gastos-variables"><span class="font-medium text-green-600">$</span>
                                {{ number_format($Data['rent']['payments_rents_sum_pago_renta'] + $Data['rent']['payments_rents_sum_iva_renta'], 2) }}
                            </td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <main class="flex items-center justify-center flex-1 px-4 py-8">
            <!-- Content -->
            <h1 class="text-5xl font-bold text-gray-500">No Hay Datos de Pagos De Renta</h1>
        </main>
    @endif
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            if (window.location.hash === '#PaymentsRentsScroll') {
                $('html, body').animate({
                    scrollTop: $('#PaymentsRentsScroll').offset().top
                }, 500);
            }
        });
    </script>
@endpush
