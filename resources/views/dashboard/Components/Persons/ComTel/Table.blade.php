@if (count($columnNames) > 0)
    <div class="mx-auto max-w-7xl">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900">Persons</h1>
            </div>
            <x-Dashboard.Button-Create text="Add Persons" href="#" />
            <x-Dashboard.Button-Create text="Admin" href="#" />
        </div>
        @if (count($rowDatas) > 0)
            <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
                <div class="relative text-gray-600 py-1">
                    <input type="search" name="serch" placeholder="Realizar Busqueda"
                        class="bg-white h-10 px-5 pr-4 rounded-full text-sm focus:outline-none">
                </div>
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
                                        <div class="font-medium text-gray-700">{{ $rowData->companiaTelefonica }}</div>
                                    </div>
                                </th>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    <div class="text-gray-600">{{ $rowData->descripcion }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-end gap-4">
                                        <x-Dashboard.IconButton-Show_SA
                                            href="{{ route('Dashboard.Admin.Persons.Show', $rowData->clvComTel) }}" />
                                        <x-Dashboard.IconButton-Edit_SA
                                            href="{{ route('Dashboard.Admin.Persons.Edit', $rowData->clvComTel) }}" />
                                        <x-Dashboard.IconButton-Delete id="{{ $rowData->clvPersona }}"
                                            name="{{ $rowData->companiaTelefonica }}"
                                            href="{{ route('Dashboard.Admin.Persons.Destroy', $rowData->clvComTel) }}" />
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
