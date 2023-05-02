@if (count($columnNames) > 0)
    <div class="mx-auto max-w-7xl">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900">Rents</h1>
            </div>
            <x-Dashboard.Button-Create text="Add Rent" href="{{ route('Dashboard.Admin.Rents.Create') }}" />
        </div>
        @if (count($rowDatas) > 0)
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
                                @foreach ($columnNames as $columnName)
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                        {{ $columnName }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 border-t  bg-white">
                            @foreach ($rowDatas as $rowData)
                                <tr class="hover:bg-gray-100">
                                    <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                                        <div class="text-sm">
                                            <div class="font-medium text-gray-700">{{ $rowData->equipo->noSerie }}</div>
                                        </div>
                                    </th>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <div class="text-gray-600">{{ $rowData->cliente->nombrePersona }}</div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <div class="text-gray-600">{{ $rowData->descripcion }}</div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <div class="text-gray-600">{{ $rowData->fecha_inicio }}</div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <div class="text-gray-600">{{ $rowData->fecha_fin }}</div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <div class="text-gray-600">
                                            <span class="font-medium text-green-600">$</span>
                                            {{ $rowData->pagoRenta->pagoRenta + $rowData->pagoRenta->ivaRenta }}
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <span
                                            class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-green-600">
                                            <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
                                            {{ $rowData->estadoRenta->estadoRenta }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-end gap-4">
                                            <x-Dashboard.IconButton-Show
                                                href="{{ route('Dashboard.Admin.Rents.Show', $rowData->clvRenta) }}" />
                                            <x-Dashboard.IconButton-Edit
                                                href="{{ route('Dashboard.Admin.Rents.Edit', $rowData->clvRenta) }}" />
                                            <x-Dashboard.IconButton-Delete id="{{ $rowData->clvRenta }}"
                                                name="Renta con Equipo: {{ $rowData->equipo->noSerie }} El Cliente: {{ $rowData->cliente->nombrePersona }} Y Un Pago Total de ${{ $rowData->pagoRenta->pagoRenta + $rowData->pagoRenta->ivaRenta }}"
                                                href="{{ route('Dashboard.Admin.Rents.Destroy', $rowData->clvRenta) }}" />
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $rowDatas->links('vendor.pagination.tailwind') }}
            </div>
        @else
            <main class="flex items-center justify-center flex-1 px-4 py-8">
                <!-- Content -->
                <h1 class="text-5xl font-bold text-gray-500">No hay datos de
                    {{ getDashboardNameFromUrlSecond(request()->fullUrl()) }}</h1>
            </main>
        @endif
    @else
        <main class="flex items-center justify-center flex-1 px-4 py-8">
            <!-- Content -->
            <h1 class="text-5xl font-bold text-gray-500">@yield('meta-title', config('app.name'))</h1>
        </main>
    </div>
@endif
