<!-- Catalogo -->
<div class="transition hover:bg-green-50 overflow-hidden rounded-lg p-2 mb-2">
    <!-- header -->
    <div class="accordion-header cursor-pointer transition flex space-x-5 px-5 items-center h-16">
        <i class="fas fa-angle-down"></i>
        <h3>Tipos De Gastos Fijos</h3>
    </div>
    <!-- Content -->
    <div class="accordion-content px-2 pt-0 overflow-hidden max-h-0 mb-2">
        <div class="bg-white rounded-lg border px-4 sm:px-6 lg:px-8 py-6">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-xl font-semibold text-gray-900">Tipos De Gastos Fijos</h1>
                </div>
                <x-Dashboard.Equipments.FixedExpenses.Catalogs.Button-Create-Modal text="Añadir Gasto Fijo"
                    action="{{ route('Dashboard.Admin.Panel.TypeFixedExpenses.Store') }}" />
            </div>
            @if (count($Data['tableTypeFixedExpensesCatalogs']['rowTypeFixedExpenses']) > 0)
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
                                    @foreach ($Data['tableTypeFixedExpensesCatalogs']['columnTypeFixedExpenses'] as $columnTypeFixedExpense)
                                        <th scope="col"
                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                            {{ $columnTypeFixedExpense }}
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 border-t  bg-white">
                                @foreach ($Data['tableTypeFixedExpensesCatalogs']['rowTypeFixedExpenses'] as $rowFixedExpenseCatalog)
                                    <tr class="hover:bg-gray-100">
                                        <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                                            <div class="text-sm">
                                                <div class="font-medium text-gray-700">
                                                    {{ $rowFixedExpenseCatalog->tipoGastoFijo }}
                                                </div>
                                            </div>
                                        </th>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            <div
                                                class="truncate break-words max-w-sm text-center font-semibold {{ $rowFixedExpenseCatalog->opcionUnica ? 'text-yellow-600' : 'text-gray-700' }}">
                                                {{ $rowFixedExpenseCatalog->opcionUnica ? 'Si' : 'No' }}</div>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            @if (!empty($rowFixedExpenseCatalog->descripcion))
                                                <div class="text-gray-700 truncate break-words max-w-sm">
                                                    {{ $rowFixedExpenseCatalog->descripcion }}</div>
                                            @else
                                                <div class="font-medium text-orange-700">Sin Descripción</div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex justify-end gap-4">
                                                <x-Dashboard.IconButton-Show_SA
                                                    id="TypeFixedExpenses_{{ $rowFixedExpenseCatalog->clvTipoGastoFijo }}"
                                                    name="{{ $rowFixedExpenseCatalog->tipoGastoFijo }}"
                                                    description="{{ $rowFixedExpenseCatalog->descripcion }}"
                                                    href="" />
                                                <x-Dashboard.Equipments.FixedExpenses.Catalogs.Button-Edit-Modal
                                                    id="TypeFixedExpenses_{{ $rowFixedExpenseCatalog->clvTipoGastoFijo }}"
                                                    tipoGastoFijo="{{ $rowFixedExpenseCatalog->tipoGastoFijo }}"
                                                    opcionUnica="{{ $rowFixedExpenseCatalog->opcionUnica }}"
                                                    descripcion="{{ $rowFixedExpenseCatalog->descripcion }}"
                                                    href="{{ route('Dashboard.Admin.Panel.TypeFixedExpenses.Update', $rowFixedExpenseCatalog->clvTipoGastoFijo) }}" />
                                                <x-Dashboard.IconButton-Delete
                                                    id="TypeFixedExpenses_{{ $rowFixedExpenseCatalog->clvTipoGastoFijo }}"
                                                    name="{{ $rowFixedExpenseCatalog->tipoGastoFijo }}"
                                                    href="{{ route('Dashboard.Admin.Panel.TypeFixedExpenses.Destroy', $rowFixedExpenseCatalog->clvTipoGastoFijo) }}" />
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $Data['tableTypeFixedExpensesCatalogs']['rowTypeFixedExpenses']->appends([
                            'statusPaymentsRents_page' => $Data['tableTypeFixedExpensesCatalogs']['rowTypeFixedExpenses']->currentPage(),
                        ])->links('vendor.pagination.tailwind') }}
                </div>
            @else
                <main class="flex items-center justify-center flex-1 px-4 py-8">
                    <!-- Content -->
                    <h1 class="text-5xl font-bold text-gray-500">No hay datos de Gastos Fijos</h1>
                </main>
            @endif
        </div>
    </div>
</div>
