<!-- Gastos Variables del Equipo -->
<div class="transition hover:bg-orange-50 overflow-hidden rounded-lg p-2 mb-2">
    <!-- header -->
    <div class="accordion-header cursor-pointer transition flex space-x-5 px-5 items-center h-16">
        <i class="fas fa-angle-down text-black"></i>
        <h3 class="font-medium text-black">Gastos Variables</h3>
    </div>
    <!-- Content -->
    <div class="accordion-content px-2 pt-0 overflow-hidden max-h-0 mb-2">
        <div class="mx-auto max-w-7xl">
            @if (count($Data['tableVariablesExpenses']['rowVariablesExpenses']) > 0)
                <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5 bg-white">
                    <div class="relative text-gray-600 py-1">
                        <input type="search" name="serch" placeholder="Realizar Busqueda"
                            class="bg-white h-10 px-5 pr-4 rounded-full text-sm focus:outline-none">
                    </div>
                    <div class="overflow-x-auto">
                        <table
                            class="min-w-full border-collapse bg-white text-left text-sm text-gray-500 divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    {{-- <p>{{ dd($Data['tableVariablesExpenses']['columnVariablesExpenses']) }}</p> --}}
                                    {{-- @foreach ($Data['tableVariablesExpenses']['columnVariablesExpenses'] as $columnVariableExpense) --}}
                                    @foreach ($Data['tableVariablesExpenses']['columnVariablesExpenses'] as $columnVariableExpense)
                                        <th scope="col"
                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                            {{ $columnVariableExpense }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 border-t  bg-white">
                                @foreach ($Data['tableVariablesExpenses']['rowVariablesExpenses'] as $rowVariableExpense)
                                    <tr class="hover:bg-gray-100">
                                        <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                                            <div class="text-sm">
                                                <div class="font-medium text-gray-700">
                                                    {{ $rowVariableExpense['gastoVariable'] }}</div>
                                            </div>
                                        </th>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            <div class="text-gray-600">
                                                {{ $rowVariableExpense['fechaGastoVariable'] }}</div>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            <div class="text-gray-600"><span class="font-medium text-green-600">$</span>
                                                {{ number_format($rowVariableExpense['costoGastoVariable'], 2) }}</div>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr class="bg-gray-50" id="total-gastos-variables">
                                    <td class="px-6 py-4 font-semibold text-gray-900">Total de Gastos Variables:</td>
                                    <td></td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 font-semibold"
                                        id="total-costo-gastos-variables"><span
                                            class="font-medium text-green-600">$</span>
                                        {{ number_format($Data['equipment']->sum_gastos_variables, 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    {{ $Data['tableVariablesExpenses']['rowVariablesExpenses']->appends(['variablesExpenses_page' => $Data['tableVariablesExpenses']['rowVariablesExpenses']->currentPage()])->links('vendor.pagination.tailwind') }}
                </div>
            @else
                <main class="flex items-center justify-center flex-1 px-4 py-8">
                    <!-- Content -->
                    <h1 class="text-5xl font-bold text-gray-500">No Hay Datos de Gastos Variables Del Equipo</h1>
                </main>
            @endif
        </div>
    </div>
</div>
