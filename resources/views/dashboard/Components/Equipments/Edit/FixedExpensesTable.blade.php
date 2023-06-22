<div class="mx-auto max-w-7xl" id="fixedExpensesScroll">
    <div class="sm:flex sm:items-center"> {{-- Titulo y botón --}}
        <div class="sm:flex-auto">
            <h1 class="text-xl font-semibold text-gray-900">Gastos Fijos</h1>
        </div>
        <x-Dashboard.Equipments.FixedExpenses.Button-Create-Modal text="Añadir Gasto Fijo" id="FixedExpenses"
            minDay="{{ $Data['equipment']['fechaAdquisicion'] }}" today="{{ $Data['today'] }}"
            action="{{ route('Dashboard.Admin.Equipments.StoreFixedExpenses', $Data['equipment']['clvEquipo']) }}"
            SelectTypeFixedExpense="{{ view('Components.Dashboard.Equipments.FixedExpenses.Selects.SelectCreate-TypeFixedExpense', compact('Data'))->render() }}" />
    </div>
    @if (count($Data['tableFixedExpenses']['rowFixedExpenses']) > 0)
        <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-2"> {{-- CRUD Gastos Fijos --}}
            {{-- <div class="relative text-gray-600 py-1">
                <input type="search" name="serch" placeholder="Realizar Busqueda"
                    class="bg-white h-10 px-5 pr-4 rounded-full text-sm focus:outline-none">
            </div> --}}
            <div class="overflow-x-auto">
                <table
                    class="min-w-full border-collapse bg-white text-left text-sm text-gray-500 divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                        <tr>
                            @foreach ($Data['tableFixedExpenses']['columnFixedExpenses'] as $columnFixedExpense)
                                <th scope="col"
                                    class="py-1 pl-4 pr-1 text-left text-sm font-semibold text-gray-900 sm:pl-3">
                                    {{ $columnFixedExpense }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 border-t bg-white">
                        @foreach ($Data['tableFixedExpenses']['rowFixedExpenses'] as $rowFixedExpense)
                            <tr class="hover:bg-gray-100">
                                <th class="flex gap-1 px-3 py-2 font-normal text-gray-900">
                                    <div class="text-sm">
                                        <div class="font-medium text-gray-700">
                                            {{ $rowFixedExpense->TypeFixedExpense->tipoGastoFijo }}</div>
                                    </div>
                                </th>
                                <td class="whitespace-nowrap px-3 py-2 text-sm text-gray-500">
                                    <div class="text-gray-600">
                                        {{ $rowFixedExpense['gastoFijo'] }}</div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-2 text-sm text-gray-500">
                                    <div class="text-gray-600">
                                        {{ $rowFixedExpense['fechaGastoFijo'] }}</div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-2 text-sm text-gray-500">
                                    <div class="text-gray-600"><span class="font-medium text-green-600">$</span>
                                        {{ number_format($rowFixedExpense['costoGastoFijo'], 2) }}</div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-2 text-sm text-gray-500">
                                    @if (isset($rowFixedExpense['folioFactura']))
                                        <div class="text-gray-600">{{ $rowFixedExpense['folioFactura'] }}</div>
                                    @else
                                        <div class="text-orange-600">Sin Folio</div>
                                    @endif
                                </td>
                                <td class="px-3 py-2">
                                    <div class="flex justify-end gap-1">
                                        <x-Dashboard.IconButton-Show_SA
                                            id="FixedExpenses_{{ $rowFixedExpense['clvGastoFijo'] }}"
                                            name="{{ $rowFixedExpense['gastoFijo'] }}"
                                            description="Tipo de Gasto Fijo {{ $rowFixedExpense->TypeFixedExpense->tipoGastoFijo }} Con Día {{ $rowFixedExpense['fechaGastoFijo'] }} Del Folio {{ $rowFixedExpense['folioFactura'] }}"
                                            href="" />
                                        <x-Dashboard.Equipments.FixedExpenses.Button-Edit-Modal
                                            clv="{{ $rowFixedExpense['clvGastoFijo'] }}"
                                            id="FixedExpenses_{{ $rowFixedExpense['clvGastoFijo'] }}"
                                            gastoFijo="{{ $rowFixedExpense['gastoFijo'] }}"
                                            fechaGastoFijo="{{ $rowFixedExpense['fechaGastoFijo'] }}"
                                            costoGastoFijo="{{ $rowFixedExpense['costoGastoFijo'] }}"
                                            minDay="{{ $Data['equipment']['fechaAdquisicion'] }}"
                                            today="{{ $Data['today'] }}"
                                            SelectTypeFixedExpense="{{ view('Components.Dashboard.Equipments.FixedExpenses.Selects.SelectEdit-TypeFixedExpense', ['Data' => $Data, 'clvTipoGastoFijo' => $rowFixedExpense['clvTipoGastoFijo']])->render() }}"
                                            folioFactura="{{ $rowFixedExpense['folioFactura'] }}"
                                            href="{{ route('Dashboard.Admin.Equipments.UpdateFixedExpenses', $rowFixedExpense['clvGastoFijo']) }}" />
                                        <x-Dashboard.IconButton-Delete
                                            id="FixedExpenses_{{ $rowFixedExpense['clvGastoFijo'] }}"
                                            name="{{ $rowFixedExpense['gastoFijo'] }}"
                                            href="{{ route('Dashboard.Admin.Equipments.DestroyFixedExpenses', $rowFixedExpense['clvGastoFijo']) }}" />
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        <tr class="bg-gray-50" id="total-gastos-variables">
                            <td class="px-3 py-2 font-semibold text-gray-900">Total de Gastos Fijos:</td>
                            <td></td>
                            <td></td>
                            <td class="whitespace-nowrap px-3 py-2 text-sm text-gray-500 font-semibold"
                                id="total-costo-gastos-variables"><span class="font-medium text-green-600">$</span>
                                {{ number_format($Data['equipment']->sum_gastos_fijos, 2) }}</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            {{ $Data['tableFixedExpenses']['rowFixedExpenses']->links('vendor.pagination.tailwind') }}
        </div>
    @else
        <main class="flex items-center justify-center flex-1 px-4 py-8">
            <!-- Content -->
            <h1 class="text-5xl font-bold text-gray-500">No Hay Datos de Gastos Fijos</h1>
        </main>
    @endif
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            if (window.location.hash === '#fixedExpensesScroll') {
                $('html, body').animate({
                    scrollTop: $('#fixedExpensesScroll').offset().top
                }, 500);
            }
        });
    </script>
@endpush
