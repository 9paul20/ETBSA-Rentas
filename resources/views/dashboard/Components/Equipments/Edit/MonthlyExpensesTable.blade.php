<div class="mx-auto max-w-7xl" id="monthlyExpensesScroll">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-xl font-semibold text-gray-900">Gastos Mensuales</h1>
        </div>
        <x-Dashboard.Equipments.MonthlyExpenses.Button-Create-Modal text="Añadir Gasto Mensual" id="MonthlyExpenses"
            action="{{ route('Dashboard.Admin.Equipments.StoreMonthlyExpenses', $Data['equipment']['clvEquipo']) }}"
            SelectTypeFixedExpense="{{ view('Components.Dashboard.Equipments.FixedExpenses.Selects.SelectCreate-TypeFixedExpense', compact('Data'))->render() }}"
            SelectMonthly="{{ view('Components.Dashboard.Equipments.MonthlyExpenses.Selects.SelectCreate-Monthly', compact('Data'))->render() }}" />
    </div>
    @if (count($Data['tableMonthlyExpenses']['rowMonthlyExpenses']) > 0)
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
                            @foreach ($Data['tableMonthlyExpenses']['columnMonthlyExpenses'] as $columnMonthlyExpense)
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                    {{ $columnMonthlyExpense }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 border-t  bg-white">
                        @foreach ($Data['tableMonthlyExpenses']['rowMonthlyExpenses'] as $rowMonthlyExpense)
                            <tr class="hover:bg-gray-100">
                                <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                                    <div class="text-sm">
                                        <div class="font-medium text-gray-700">
                                            {{ $rowMonthlyExpense['gastoMensual'] }}</div>
                                    </div>
                                </th>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    <div class="text-gray-600">
                                        {{ $rowMonthlyExpense->TypeFixedExpense->tipoGastoFijo }}</div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    <div class="text-gray-600"><span class="font-medium text-green-600">$</span>
                                        {{ number_format($rowMonthlyExpense['costoMensual'], 2) }}</div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    @if (isset($rowMonthlyExpense['descripcion']))
                                        <div class="text-gray-600">{{ $rowMonthlyExpense['descripcion'] }}</div>
                                    @else
                                        <div class="text-orange-600">Sin Descripción</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-end gap-4">
                                        <x-Dashboard.IconButton-Show_SA
                                            id="MonthlyExpenses_{{ $rowMonthlyExpense['clvGastoMensual'] }}"
                                            name="{{ $rowMonthlyExpense['gastoMensual'] }} - Costo Mensual: $ {{ $rowMonthlyExpense['costoMensual'] }}"
                                            description="{{ $rowMonthlyExpense['descripcion'] }}" href="" />
                                        <x-Dashboard.Equipments.MonthlyExpenses.Button-Edit-Modal
                                            id="MonthlyExpenses_{{ $rowMonthlyExpense['clvGastoMensual'] }}"
                                            gastoMensual="{{ $rowMonthlyExpense['gastoMensual'] }}"
                                            precioEquipo="{{ $rowMonthlyExpense['precioEquipo'] }}"
                                            porGastoMensual="{{ $rowMonthlyExpense['porGastoMensual'] }}"
                                            costoMensual="{{ $rowMonthlyExpense['costoMensual'] }}"
                                            descripcion="{{ $rowMonthlyExpense['descripcion'] }}"
                                            SelectTypeFixedExpense="{{ view('Components.Dashboard.Equipments.MonthlyExpenses.Selects.SelectEdit-TypeFixedExpense', [
                                                'Data' => $Data,
                                                'clvTipoGastoFijo' => $rowMonthlyExpense['clvTipoGastoFijo'],
                                            ])->render() }}"
                                            SelectMonthly="{{ view('Components.Dashboard.Equipments.MonthlyExpenses.Selects.SelectEdit-Monthly', [
                                                'id' => 'MonthlyExpenses_' . $rowMonthlyExpense['clvGastoMensual'],
                                                'Data' => $Data,
                                                'precioEquipo' => $rowMonthlyExpense['precioEquipo'],
                                                'indiceValorFijo' => $rowMonthlyExpense['indiceValorFijo'],
                                            ])->render() }}"
                                            href="{{ route('Dashboard.Admin.Equipments.UpdateMonthlyExpenses', $rowMonthlyExpense['clvGastoMensual']) }}" />
                                        <x-Dashboard.IconButton-Delete
                                            id="MonthlyExpenses_{{ $rowMonthlyExpense['clvGastoMensual'] }}"
                                            name="{{ $rowMonthlyExpense['gastoMensual'] }}"
                                            href="{{ route('Dashboard.Admin.Equipments.DestroyMonthlyExpenses', $rowMonthlyExpense['clvGastoMensual']) }}" />
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        <tr class="bg-gray-50" id="total-gastos-variables">
                            <td class="px-6 py-4 font-semibold text-gray-900">Total de Gastos Mensuales:</td>
                            <td></td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 font-semibold"
                                id="total-costo-gastos-variables"><span class="font-medium text-green-600">$</span>
                                {{ number_format($Data['equipment']->sumGastosMensuales, 2) }}</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            {{ $Data['tableMonthlyExpenses']['rowMonthlyExpenses']->links('vendor.pagination.tailwind') }}
        </div>
    @else
        <main class="flex items-center justify-center flex-1 px-4 py-8">
            <!-- Content -->
            <h1 class="text-5xl font-bold text-gray-500">No Hay Datos de Gastos Mensuales</h1>
        </main>
    @endif
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            if (window.location.hash === '#monthlyExpensesScroll') {
                $('html, body').animate({
                    scrollTop: $('#monthlyExpensesScroll').offset().top
                }, 500);
            }
        });
    </script>
@endpush
