<div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Rent Information</h3>
                <p class="mt-1 text-sm text-gray-600">Use a permanent address where you can receive mail.</p>
            </div>
        </div>
        <div class="mt-5 md:col-span-2 md:mt-0">
            @if (getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Rents' &&
                    getDashboardNameFromUrlSecond(request()->fullUrl()) == 'create')
                <form action="{{ route('Dashboard.Admin.Rents.Store') }}" method="POST">
                @elseif(getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Rents' &&
                        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'edit')
                    <form action="{{ route('Dashboard.Admin.Rents.Update', $rent->clvRenta) }}" method="POST">
                        @method('PUT')
            @endif
            @csrf
            <div class="overflow-hidden shadow sm:rounded-md">
                <div class="bg-white px-4 py-5 sm:p-6">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-6">
                            <label for="clvEquipo" class="block text-sm font-medium text-gray-700">Clave Equipo</label>
                            <input type="text" name="clvEquipo" id="clvEquipo" autocomplete="given-clvEquipo"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('clvEquipo') border-red-400 @enderror"
                                value="{{ old('clvEquipo', $rent->clvEquipo) }}" required autofocus>
                            @error('clvEquipo')
                                <div class="flex
                                    items-center mt-1 text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="clvCliente" class="block text-sm font-medium text-gray-700">Clave
                                Cliente</label>
                            <input type="text" name="clvCliente" id="clvCliente" autocomplete="given-clvCliente"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('clvCliente') border-red-400 @enderror"
                                value="{{ old('clvCliente', $rent->clvCliente) }}" required autofocus>
                            @error('clvCliente')
                                <div class="flex
                                    items-center mt-1 text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                            <input type="text" name="descripcion" id="descripcion" autocomplete="given-descripcion"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('descripcion') border-red-400 @enderror"
                                value="{{ old('descripcion', $rent->descripcion) }}" required autofocus>
                            @error('descripcion')
                                <div class="flex
                                    items-center mt-1 text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="fecha_inicio" class="block text-sm font-medium text-gray-700">Fecha
                                Inicio</label>
                            <input type="text" name="fecha_inicio" id="fecha_inicio"
                                autocomplete="given-fecha_inicio"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('fecha_inicio') border-red-400 @enderror"
                                value="{{ old('fecha_inicio', $rent->fecha_inicio) }}" required autofocus>
                            @error('fecha_inicio')
                                <div class="flex
                                    items-center mt-1 text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="fecha_fin" class="block text-sm font-medium text-gray-700">Fecha Fin</label>
                            <input type="text" name="fecha_fin" id="fecha_fin" autocomplete="given-fecha_fin"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('fecha_fin') border-red-400 @enderror"
                                value="{{ old('fecha_fin', $rent->fecha_fin) }}" required autofocus>
                            @error('fecha_fin')
                                <div class="flex
                                    items-center mt-1 text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="clvPagoRenta" class="block text-sm font-medium text-gray-700">Clave Pago</label>
                            <input type="text" name="clvPagoRenta" id="clvPagoRenta"
                                autocomplete="given-clvPagoRenta"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('clvPagoRenta') border-red-400 @enderror"
                                value="{{ old('clvPagoRenta', $rent->clvPagoRenta) }}" required autofocus>
                            @error('clvPagoRenta')
                                <div class="flex
                                    items-center mt-1 text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="clvEstadoRenta" class="block text-sm font-medium text-gray-700">Clave Estado
                                Renta</label>
                            <input type="text" name="clvEstadoRenta" id="clvEstadoRenta"
                                autocomplete="given-clvEstadoRenta"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('clvEstadoRenta') border-red-400 @enderror"
                                value="{{ old('clvEstadoRenta', $rent->clvEstadoRenta) }}" required autofocus>
                            @error('clvEstadoRenta')
                                <div class="flex
                                    items-center mt-1 text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        {{-- <div class="col-span-6 sm:col-span-3">
                                <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                                <select id="country" name="country" autocomplete="country-name"
                                    class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                    <option>United States</option>
                                    <option>Canada</option>
                                    <option>Mexico</option>
                                </select>
                            </div>

                            <div class="col-span-6">
                                <label for="street-address" class="block text-sm font-medium text-gray-700">Street
                                    address</label>
                                <input type="text" name="street-address" id="street-address"
                                    autocomplete="street-address"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                                <input type="text" name="city" id="city" autocomplete="address-level2"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                <label for="region" class="block text-sm font-medium text-gray-700">State /
                                    Province</label>
                                <input type="text" name="region" id="region" autocomplete="address-level1"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                <label for="postal-code" class="block text-sm font-medium text-gray-700">ZIP / Postal
                                    code</label>
                                <input type="text" name="postal-code" id="postal-code" autocomplete="postal-code"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div> --}}
                    </div>
                </div>
                <x-Dashboard.Save-Button name="Guardar Renta" />
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Eliminar mensaje de error cuando se hace clic en el campo de entrada correspondiente
            document.querySelectorAll('input').forEach(input => {
                input.addEventListener('click', () => {
                    const errorDiv = input.nextElementSibling;
                    if (errorDiv && errorDiv.classList.contains('text-red-400')) {
                        errorDiv.style.opacity = '0';
                        errorDiv.style.transition =
                            'opacity 0.5s ease-in-out'; // cambiar la duración de la animación según tus necesidades
                        setTimeout(() => {
                                errorDiv.style.display = 'none';
                            },
                            500
                        ); // ajustar el tiempo de espera para que coincida con la duración de la animación
                    }
                });
            });
        </script>
    @endpush
