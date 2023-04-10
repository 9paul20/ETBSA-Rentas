@push('styles')
    <style>
        .swal2-container.swal2-center>.swal2-popup {
            background-color: #FFFCF2;
            /* Cambiar a tu color deseado */
        }
    </style>
@endpush

@if (count($columnNames) > 0)
    <div class="mx-auto max-w-7xl">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900">Users</h1>
            </div>
            @can('Create Users')
                <x-Dashboard.Button-Create text="Add User" href="{{ route('Dashboard.Admin.Users.Create') }}" />
            @endcan
        </div>
        @if (count($rowDatas) > 0)
            <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
                <div class="relative text-gray-600 py-1">
                    <input type="search" name="serch" placeholder="Realizar Busqueda"
                        class="bg-white h-10 px-5 pr-4 rounded-full text-sm focus:outline-none">
                    {{-- <button type="submit" class="absolute right-0 top-0 mt-3 mr-4">
                <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                    viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve"
                    width="512px" height="512px">
                    <path
                        d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                </svg>
            </button> --}}
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
                                    <div class="relative h-10 w-10">
                                        <img class="h-full w-full rounded-full object-cover object-center"
                                            src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2&amp;w=256&amp;h=256&amp;q=80"
                                            alt="">
                                        <span
                                            class="absolute right-0 bottom-0 h-2 w-2 rounded-full bg-green-400 ring ring-white"></span>
                                    </div>
                                    <div class="text-sm">
                                        <div class="font-medium text-gray-700">{{ $rowData->name }}</div>
                                        <div class="text-gray-400">{{ $rowData->email }}</div>
                                    </div>
                                </th>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    @if ($rowData->active !== null)
                                        <span
                                            class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-green-600">
                                            <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
                                            {{ $rowData->active }}
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1 rounded-full bg-red-50 px-2 py-1 text-xs font-semibold text-red-600">
                                            <span class="h-1.5 w-1.5 rounded-full bg-red-600"></span>
                                            Sin State
                                        </span>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    <div class="font-medium text-gray-700">
                                        @if ($rowData->roles->count() > 0)
                                            <div class="font-medium text-gray-700">{{ $rowData->roles->first()->name }}
                                            </div>
                                            @if ($rowData->roles->count() > 1)
                                                <div class="text-gray-400">+{{ $rowData->roles->count() - 1 }}</div>
                                            @endif
                                        @else
                                            <div class="font-medium text-orange-700">Sin Rol</div>
                                        @endif
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    <div class="flex gap-2">
                                        @if (count($rowData->permissions) > 0)
                                            @foreach ($rowData->permissions->take(3) as $permissionsTo)
                                                <span
                                                    class="inline-flex items-center gap-1 rounded-full bg-indigo-50 px-2 py-1 text-xs font-semibold text-indigo-600">
                                                    {{ $permissionsTo->name }}
                                                </span>
                                            @endforeach
                                            @if ($rowData->permissions->count() - $rowData->permissions->take(3)->count() > 0)
                                                <span
                                                    class="inline-flex items-center gap-1 rounded-full bg-gray-200 px-2 py-1 text-xs font-medium text-gray-500">
                                                    +{{ $rowData->permissions->count() - $rowData->permissions->take(3)->count() }}
                                                </span>
                                            @endif
                                        @else
                                            <span
                                                class="inline-flex items-center gap-1 rounded-full bg-orange-100 px-2 py-1 text-xs font-medium text-orange-700">
                                                Sin Permisos
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-end gap-4">
                                        @can('View Users')
                                            <x-Dashboard.IconButton-Show
                                                href="{{ route('Dashboard.Admin.Users.Show', $rowData->id) }}" />
                                        @endcan
                                        @can('Update Users')
                                            <x-Dashboard.IconButton-Edit
                                                href="{{ route('Dashboard.Admin.Users.Edit', $rowData->id) }}" />
                                        @endcan
                                        @can('Delete Users')
                                            <x-Dashboard.IconButton-Delete id="{{ $rowData->id }}"
                                                name="{{ $rowData->name }}"
                                                href="{{ route('Dashboard.Admin.Users.Destroy', $rowData->id) }}" />
                                        @endcan
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

@can('Delete Users')
    @push('scripts')
        <script>
            function confirmDelete(id, name) {
                Swal.fire({
                    title: `¿Estás seguro de eliminar el dato ${name}?`,
                    text: "Esta acción no se puede deshacer.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Se envía la petición de eliminación al servidor
                        document.getElementById(`delete-form-${id}`).submit();
                    }
                })
            }
        </script>
    @endpush
@endcan
