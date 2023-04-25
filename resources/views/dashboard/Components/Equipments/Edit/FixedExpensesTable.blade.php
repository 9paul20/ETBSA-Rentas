<div class="mx-auto max-w-7xl">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-xl font-semibold text-gray-900">Gastos Fijos</h1>
        </div>
        <x-Dashboard.Equipments.FixedExpenses.Button-Create-Modal text="Añadir Gasto Fijo" id="FixedExpenses"
            today="{{ $Data['today'] }}"
            action="{{ route('Dashboard.Admin.Equipments.StoreFixedExpenses', $Data['equipment']['clvEquipo']) }}"
            SelectTypeFixedExpense="{{ view('Components.Dashboard.Equipments.FixedExpenses.Selects.SelectCreate-TypeFixedExpense', compact('Data'))->render() }}" />
    </div>
    @if (count($Data['tableFixedExpenses']['rowFixedExpenses']) > 0)
    <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
        <div class="relative text-gray-600 py-1">
            <input type="search" name="serch" placeholder="Realizar Busqueda"
                class="bg-white h-10 px-5 pr-4 rounded-full text-sm focus:outline-none">
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse bg-white text-left text-sm text-gray-500 divide-y divide-gray-300">
                <thead class="bg-gray-50">
                    <tr>
                        @foreach ($Data['tableFixedExpenses']['columnFixedExpenses'] as $columnFixedExpense)
                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                            {{ $columnFixedExpense }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 border-t  bg-white">
                    @foreach ($Data['tableFixedExpenses']['rowFixedExpenses'] as $rowFixedExpense)
                    <tr class="hover:bg-gray-100">
                        <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                            <div class="text-sm">
                                <div class="font-medium text-gray-700">
                                    {{ $rowFixedExpense['gastoFijo'] }}</div>
                            </div>
                        </th>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                            <div class="text-gray-600">
                                {{ $rowFixedExpense->TypeFixedExpense->tipoGastoFijo }}</div>
                        </td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                            <div class="text-gray-600">
                                {{ $rowFixedExpense['fechaGastoFijo'] }}</div>
                        </td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                            <div class="text-gray-600"><span class="font-medium text-green-600">$</span>
                                {{ $rowFixedExpense['costoGastoFijo'] }}</div>
                        </td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                            <div class="text-gray-600">{{ $rowFixedExpense['folioFactura'] }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-4">
                                <x-Dashboard.IconButton-Show_SA id="{{ $rowFixedExpense['clvGastoFijo'] }}"
                                    name="{{ $rowFixedExpense['gastoFijo'] }}"
                                    description="Tipo de Gasto Fijo {{ $rowFixedExpense->TypeFixedExpense->tipoGastoFijo }} Con Día {{ $rowFixedExpense['fechaGastoFijo'] }} Del Folio {{ $rowFixedExpense['folioFactura'] }}"
                                    href="" />
                                <x-Dashboard.Equipments.FixedExpenses.Button-Edit-Modal
                                    id="FixedExpenses_{{ $rowFixedExpense['clvGastoFijo'] }}"
                                    gastoFijo="{{ $rowFixedExpense['gastoFijo'] }}"
                                    fechaGastoFijo="{{ $rowFixedExpense['fechaGastoFijo'] }}"
                                    costoGastoFijo="{{ $rowFixedExpense['costoGastoFijo'] }}"
                                    today="{{ $Data['today'] }}"
                                    SelectTypeFixedExpense="{{ view('Components.Dashboard.Equipments.FixedExpenses.Selects.SelectEdit-TypeFixedExpense', compact('Data','rowFixedExpense'))->render() }}"
                                    folioFactura="{{ $rowFixedExpense['folioFactura'] }}"
                                    href="{{ route('Dashboard.Admin.Equipments.UpdateFixedExpenses', $rowFixedExpense['clvGastoFijo']) }}" />
                                <x-Dashboard.IconButton-Delete id="{{ $rowFixedExpense['clvGastoFijo'] }}"
                                    name="{{ $rowFixedExpense['gastoFijo'] }}"
                                    href="{{ route('Dashboard.Admin.Equipments.DestroyFixedExpenses', $rowFixedExpense['clvGastoFijo']) }}" />
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    <tr class="bg-gray-50" id="total-gastos-variables">
                        <td class="px-6 py-4 font-semibold text-gray-900">Total de Gastos Fijos:</td>
                        <td></td>
                        <td></td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 font-semibold"
                            id="total-costo-gastos-variables"><span class="font-medium text-green-600">$</span>
                            {{ $Data['sumFixedExpenses'] }}</td>
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