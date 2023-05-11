@if (count($Data['columnNames']) > 0)
    <div class="mx-auto max-w-7xl">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900">Rents</h1>
            </div>
            <x-Dashboard.Button-Create text="Add Rent" href="{{ route('Dashboard.Admin.Rents.Create') }}" />
        </div>
        @if (count($Data['rowDatas']) > 0)
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
                                @foreach ($Data['columnNames'] as $columnName)
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                        {{ $columnName }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 border-t bg-white text-center">
                            @foreach ($Data['rowDatas'] as $rowData)
                                <tr class="hover:bg-gray-100">
                                    <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                                        <div class="relative h-16 w-16">
                                            <img class="h-full w-full rounded-full object-cover object-center"
                                                src="{{ url('/images/TractorUE.jpg') }}"
                                                alt="TractorUE_{{ $rowData->equipment->noSerieEquipo }}">
                                        </div>
                                        <div class="text-sm">
                                            <div class="font-medium text-gray-700">No.Serie:
                                                {{ $rowData->equipment->noSerieEquipo }}</div>
                                            <div class="font-medium text-gray-700">Modelo:
                                                {{ $rowData->equipment->modelo }}</div>
                                            <div class="text-gray-400">Categoria:
                                                {{ $rowData->equipment->categoria->categoria }}
                                            </div>
                                        </div>
                                    </th>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <div class="text-gray-500">{{ $rowData->person->nombrePersona }}</div>
                                        <div class="text-gray-500">{{ $rowData->person->apePaternoPersona }}</div>
                                        <div class="text-gray-500">{{ $rowData->person->apeMaternoPersona }}</div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        @if (isset($rowData->descripcion))
                                            <div class="text-gray-600">{{ $rowData->descripcion }}</div>
                                        @else
                                            <div class="text-orange-600">Sin Descripción</div>
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <div class="text-gray-600">{{ $rowData->fecha_inicio }}</div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <div class="text-gray-600">{{ $rowData->fecha_fin }}</div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <span
                                            class="inline-flex items-center gap-1 rounded-full {{ $rowData->statusRent->bgColorPrimary }} px-2 py-1 text-xs font-semibold {{ $rowData->statusRent->textColor }}">
                                            <span
                                                class="h-1.5 w-1.5 rounded-full {{ $rowData->statusRent->bgColorSecondary }}"></span>
                                            {{ $rowData->statusRent->estadoRenta }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-end gap-4">
                                            <x-Dashboard.IconButton-Show
                                                href="{{ route('Dashboard.Admin.Rents.Show', $rowData->clvRenta) }}" />
                                            <x-Dashboard.IconButton-Edit
                                                href="{{ route('Dashboard.Admin.Rents.Edit', $rowData->clvRenta) }}" />
                                            <x-Dashboard.IconButton-Delete id="{{ $rowData->clvRenta }}"
                                                name="Renta con Equipo: {{ $rowData->equipment->noSerieEquipo }}, Cliente: {{ $rowData->person->nombrePersona }} Y Una Renta Total de ${{ number_format($rowData->payments_rents_sum_pago_renta + $rowData->payments_rents_sum_iva_renta, 2) }}"
                                                href="{{ route('Dashboard.Admin.Rents.Destroy', $rowData->clvRenta) }}" />
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $Data['rowDatas']->links('vendor.pagination.tailwind') }}
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
