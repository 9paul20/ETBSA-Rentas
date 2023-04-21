<div class="mx-auto max-w-7xl">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-xl font-semibold text-gray-900">Gastos Variables</h1>
        </div>
        <x-Dashboard.Equipments.VariablesExpenses.Button-Create-Modal text="Añadir Gasto Variable" id="VariablesExpenses"
            action="{{ route('Dashboard.Admin.Equipments.StoreVariablesExpenses', $equipment->clvEquipo) }}" />
    </div>
    @if (count($rowVariablesExpenses) > 0)
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
                            @foreach ($columnVariablesExpenses as $columnVariableExpense)
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                    {{ $columnVariableExpense }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 border-t  bg-white">
                        @foreach ($rowVariablesExpenses as $rowVariableExpense)
                            <tr class="hover:bg-gray-100">
                                <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                                    <div class="text-sm">
                                        <div class="font-medium text-gray-700">
                                            {{ $rowVariableExpense->gastoVariable }}</div>
                                    </div>
                                </th>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    <div class="text-gray-600">{{ $rowVariableExpense->costoGastoVariable }}</div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    <div class="text-gray-600">{{ $rowVariableExpense->descripcion }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-end gap-4">
                                        <x-Dashboard.IconButton-Show_SA id="{{ $rowVariableExpense->clvGastoVariable }}"
                                            name="{{ $rowVariableExpense->gastoVariable }}"
                                            description="{{ $rowVariableExpense->descripcion }}" href="" />
                                        <x-Dashboard.Equipments.VariablesExpenses.Button-Edit-Modal
                                            id="VariablesExpenses_{{ $rowVariableExpense->clvGastoVariable }}"
                                            gastoVariable="{{ $rowVariableExpense->gastoVariable }}"
                                            costoGastoVariable="{{ $rowVariableExpense->costoGastoVariable }}"
                                            descripcion="{{ $rowVariableExpense->descripcion }}"
                                            href="{{ route('Dashboard.Admin.Equipments.UpdateVariablesExpenses', $rowVariableExpense->clvGastoVariable) }}" />
                                        <x-Dashboard.IconButton-Delete id="{{ $rowVariableExpense->clvGastoVariable }}"
                                            name="{{ $rowVariableExpense->gastoVariable }}"
                                            href="{{ route('Dashboard.Admin.Equipments.DestroyVariablesExpenses', $rowVariableExpense->clvGastoVariable) }}" />
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $rowVariablesExpenses->links('vendor.pagination.tailwind') }}
        </div>
    @else
        <main class="flex items-center justify-center flex-1 px-4 py-8">
            <!-- Content -->
            <h1 class="text-5xl font-bold text-gray-500">No Hay Datos de Gastos Variables</h1>
        </main>
    @endif
</div>
