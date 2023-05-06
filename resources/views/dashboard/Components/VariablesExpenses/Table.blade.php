@if (count($Table['columnNames']) > 0)
    <div class="mx-auto max-w-7xl">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900">Todos Los Gastos Variables</h1>
            </div>
            <x-Dashboard.Button-Create text="Add Variable Expense"
                href="{{ route('Dashboard.Admin.VariablesExpenses.Create') }}" />
        </div>
        @if (count($Table['rowDatas']) > 0)
            <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
                <div class="relative text-gray-600 py-1">
                    <input id="searchInput" type="search" name="search" placeholder="Realizar Busqueda"
                        class="bg-white h-10 px-5 pr-4 rounded-full text-sm focus:outline-none">
                </div>
                <div class="overflow-x-auto">
                    <table
                        class="min-w-full border-collapse bg-white text-center text-sm text-gray-500 divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                @foreach ($Table['columnNames'] as $columnName)
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                        {{ $columnName }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 border-t  bg-white">
                            @foreach ($Table['rowDatas'] as $rowData)
                                <tr class="hover:bg-gray-100 text-left">
                                    <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                                        <div class="relative h-16 w-16">
                                            <img class="h-full w-full rounded-full object-cover object-center"
                                                src="{{ url('/images/TractorUE.jpg') }}"
                                                alt="TractorUE_{{ $rowData->equipment->noSerieEquipo }}">
                                        </div>
                                        <div class="text-sm">
                                            <div class="font-medium text-gray-700">
                                                {{ $rowData->equipment->noSerieEquipo }}</div>
                                            <div class="font-medium text-gray-700">
                                                {{ $rowData->equipment->modelo }}</div>
                                            <div class="text-gray-400">
                                                {{ $rowData->equipment->categoria->categoria }}
                                            </div>
                                        </div>
                                    </th>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <div class="font-medium text-gray-700 truncate break-words max-w-sm">
                                            {{ $rowData['gastoVariable'] }}</div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <div class="text-gray-600">{{ $rowData['fechaGastoVariable'] }}</div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <div class="text-gray-600"><span
                                                class="font-medium text-green-600">$</span>{{ number_format($rowData['costoGastoVariable'], 2) }}
                                        </div>
                                    </td>
                                    {{-- <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        @if (isset($rowData['folioFactura']))
                                            <div class="text-gray-600">{{ $rowData['folioFactura'] }}</div>
                                        @else
                                            <div class="text-orange-600">Sin Folio</div>
                                        @endif
                                    </td> --}}
                                    <td class="px-6 py-4">
                                        <div class="flex justify-end gap-4">
                                            <x-Dashboard.IconButton-Show
                                                href="{{ route('Dashboard.Admin.VariablesExpenses.Show', $rowData['clvGastoVariable']) }}" />
                                            <x-Dashboard.IconButton-Edit
                                                href="{{ route('Dashboard.Admin.VariablesExpenses.Edit', $rowData['clvGastoVariable']) }}" />
                                            <x-Dashboard.IconButton-Delete id="{{ $rowData['clvGastoVariable'] }}"
                                                name="Gasto Fijo del Equipo: {{ $rowData['equipment']['noSerieEquipo'] }} - {{ $rowData['equipment']['modelo'] }} Con Costo de ${{ number_format($rowData['costoGastoVariable'], 2) }}"
                                                href="{{ route('Dashboard.Admin.VariablesExpenses.Destroy', $rowData['clvGastoVariable']) }}" />
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $Table['rowDatas']->links('vendor.pagination.tailwind') }}
            </div>
        @else
            <main class="flex items-center justify-center flex-1 px-4 py-8">
                <!-- Content -->
                <h1 class="text-5xl font-bold text-gray-500">No hay datos de
                    {{ getDashboardNameFromUrlSecond(request()->fullUrl()) }}</h1>
                @include('Dashboard.Components.Divisor')
                <x-Dashboard.Button-Create text="Regresar a Variables Expenses"
                    href="{{ route('Dashboard.Admin.VariablesExpenses.Index') }}" />
            </main>
        @endif
    @else
        <main class="flex items-center justify-center flex-1 px-4 py-8">
            <!-- Content -->
            <h1 class="text-5xl font-bold text-gray-500">@yield('meta-title', config('app.name'))</h1>
        </main>
    </div>
@endif

@push('scripts')
    <script>
        const input = document.getElementById("searchInput");
        const urlParams = new URLSearchParams(window.location.search);
        const searchParam = urlParams.get('search');
        const searchInput = document.querySelector('input[name="search"]');
        input.addEventListener("keydown", function(event) {
            if (event.key === "Enter") {
                const value = input.value;
                const url = new URL(window.location.href);
                url.searchParams.set("search", value);
                window.location.href = url.toString();
            }
        });
        searchInput.value = searchParam;
    </script>
@endpush
