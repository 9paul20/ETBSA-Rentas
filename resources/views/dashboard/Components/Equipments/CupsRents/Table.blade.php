<!-- Taza De Rentas -->
<div class="transition hover:bg-indigo-50 overflow-hidden rounded-lg p-2 mb-2">
    <!-- header -->
    <div class="accordion-header cursor-pointer transition flex space-x-5 px-5 items-center h-16">
        <i class="fas fa-angle-down"></i>
        <h3>Tazas De Renta</h3>
    </div>
    <!-- Content -->
    <div class="accordion-content px-2 pt-0 overflow-hidden max-h-0 mb-2">
        <div class="bg-white rounded-lg border px-4 sm:px-6 lg:px-8 py-6">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-xl font-semibold text-gray-900">Tazas De Renta</h1>
                </div>
                <x-Dashboard.Equipments.CupsRents.Button-Create-Modal text="Añadir Taza De Renta"
                    action="{{ route('Dashboard.Admin.Panel.Equipments.CupRent.Store') }}" />
            </div>
            @if (count($Data['tableCupsRents']['rowCupsRents']) > 0)
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
                                    @foreach ($Data['tableCupsRents']['columnCupsRents'] as $columnCupRent)
                                        <th scope="col"
                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                            {{ $columnCupRent }}
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 border-t  bg-white">
                                @foreach ($Data['tableCupsRents']['rowCupsRents'] as $rowCupRent)
                                    <tr class="hover:bg-gray-100">
                                        <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                                            <div class="text-sm">
                                                <div class="font-medium text-gray-700">
                                                    {{ $rowCupRent->tazaRenta }}
                                                </div>
                                            </div>
                                        </th>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            <div class="text-gray-700 truncate break-words max-w-sm">
                                                <span class="font-medium text-green-600">$</span>
                                                {{ $rowCupRent->rentaUnMes }}
                                            </div>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            <div class="text-gray-700 truncate break-words max-w-sm">
                                                <span class="font-medium text-green-600">$</span>
                                                {{ $rowCupRent->rentaDosMeses }}
                                            </div>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            <div class="text-gray-700 truncate break-words max-w-sm">
                                                <span class="font-medium text-green-600">$</span>
                                                {{ $rowCupRent->rentaTresMeses }}
                                            </div>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            <div class="text-gray-700 truncate break-words max-w-sm">
                                                <span class="font-medium text-green-600">$</span>
                                                {{ $rowCupRent->ivaUnMes }}
                                            </div>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            <div class="text-gray-700 truncate break-words max-w-sm">
                                                <span class="font-medium text-green-600">$</span>
                                                {{ $rowCupRent->ivaDosMeses }}
                                            </div>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            <div class="text-gray-700 truncate break-words max-w-sm">
                                                <span class="font-medium text-green-600">$</span>
                                                {{ $rowCupRent->ivaTresMeses }}
                                            </div>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            @if (!empty($rowCupRent->descripcion))
                                                <div class="text-gray-700 truncate break-words max-w-sm">
                                                    {{ $rowCupRent->descripcion }}</div>
                                            @else
                                                <div class="font-medium text-orange-700">Sin Descripción</div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex justify-end gap-4">
                                                <x-Dashboard.IconButton-Show_SA
                                                    id="CupsRents_{{ $rowCupRent->clvTazaRenta }}"
                                                    name="{{ $rowCupRent->tazaRenta }}"
                                                    description="{{ $rowCupRent->descripcion }}" href="" />
                                                <x-Dashboard.Equipments.CupsRents.Button-Edit-Modal
                                                    id="CupsRents_{{ $rowCupRent->clvTazaRenta }}"
                                                    tazaRenta="{{ $rowCupRent->tazaRenta }}"
                                                    rentaUnMes="{{ $rowCupRent->rentaUnMes }}"
                                                    rentaDosMeses="{{ $rowCupRent->rentaDosMeses }}"
                                                    rentaTresMeses="{{ $rowCupRent->rentaTresMeses }}"
                                                    ivaUnMes="{{ $rowCupRent->ivaUnMes }}"
                                                    ivaDosMeses="{{ $rowCupRent->ivaDosMeses }}"
                                                    ivaTresMeses="{{ $rowCupRent->ivaTresMeses }}"
                                                    descripcion="{{ $rowCupRent->descripcion }}"
                                                    href="{{ route('Dashboard.Admin.Panel.Equipments.CupRent.Update', $rowCupRent->clvTazaRenta) }}" />
                                                <x-Dashboard.IconButton-Delete
                                                    id="CupsRents_{{ $rowCupRent->clvTazaRenta }}"
                                                    name="{{ $rowCupRent->tazaRenta }}"
                                                    href="{{ route('Dashboard.Admin.Panel.Equipments.CupRent.Destroy', $rowCupRent->clvTazaRenta) }}" />
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $Data['tableCupsRents']['rowCupsRents']->appends(['cupsRents_page' => $Data['tableCupsRents']['rowCupsRents']->currentPage()])->links('vendor.pagination.tailwind') }}
                </div>
            @else
                <main class="flex items-center justify-center flex-1 px-4 py-8">
                    <!-- Content -->
                    <h1 class="text-5xl font-bold text-gray-500">No hay datos de Taza De Renta</h1>
                </main>
            @endif
        </div>
    </div>
</div>
