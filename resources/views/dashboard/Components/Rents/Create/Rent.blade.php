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
                    <form action="{{ route('Dashboard.Admin.Rents.Update', $Data['rent']->clvRenta) }}" method="POST">
                        @method('PUT')
            @endif
            @csrf
            <div class="overflow-hidden shadow sm:rounded-md">
                <div class="bg-white px-4 py-5 sm:p-6">
                    <div class="grid grid-cols-6 gap-6">
                        @if (getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Rents' &&
                                getDashboardNameFromUrlSecond(request()->fullUrl()) == 'create')
                            <div class="col-span-6 sm:col-span-6">
                                <label for="clvEquipo" class="block text-sm font-medium text-gray-700">Equipo</label>
                                <select id="clvEquipo" name="clvEquipo"
                                    class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-green-500 focus:outline-none focus:ring-green-500 sm:text-sm @error('clvEquipo') border-red-400 @enderror"
                                    required onchange="updatePreciosMensuales()">
                                    @if (count($Data['equipments']) > 0)
                                        <option value="" disabled selected>
                                            Seleccione Un Equipo</option>
                                        @foreach ($Data['equipments'] as $equipment)
                                            <option value="{{ $equipment->clvEquipo }}"
                                                data-precios="{{ $equipment->sumGastosMensuales }}"
                                                @if ($equipment->clvEquipo == $Data['rent']->clvEquipo) selected @endif>
                                                {{ $equipment->modelo }} - {{ $equipment->noSerieEquipo }}
                                            </option>
                                        @endforeach
                                    @else
                                        <option value="" disabled selected>
                                            No Hay Opciones De Equipo Disponible</option>
                                    @endif
                                </select>
                                @error('clvEquipo')
                                    <div class="flex
                                    items-center mt-1 text-red-400">
                                        <i class="fas fa-exclamation-triangle mr-2"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="col-span-6 sm:col-span-6">
                                <label for="clvCliente" class="block text-sm font-medium text-gray-700">Cliente</label>
                                <select id="clvCliente" name="clvCliente"
                                    class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-green-500 focus:outline-none focus:ring-green-500 sm:text-sm @error('clvCliente') border-red-400 @enderror"
                                    required>
                                    @if (count($Data['clients']) > 0)
                                        <option value="" disabled selected>
                                            Seleccione Un Cliente</option>
                                        @foreach ($Data['clients'] as $client)
                                            <option value="{{ $client->clvPersona }}"
                                                @if ($client->clvPersona == $Data['rent']->clvCliente) selected @endif>
                                                {{ $client->nombrePersona }} {{ $client->apePaternoPersona }}
                                                {{ $client->apeMaternoPersona }}
                                            </option>
                                        @endforeach
                                    @else
                                        <option value="" disabled selected>
                                            No Hay Opciones De Cliente Disponible</option>
                                    @endif
                                </select>
                                @error('clvCliente')
                                    <div class="flex
                                    items-center mt-1 text-red-400">
                                        <i class="fas fa-exclamation-triangle mr-2"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                        @endif
                        @if (getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Rents' &&
                                getDashboardNameFromUrlSecond(request()->fullUrl()) == 'edit')
                            <div class="relative col-span-6 sm:col-span-6 pointer-events-none">
                                <label for="equipo" class="block text-sm font-medium text-gray-700">Equipo</label>
                                <input type="text" name="equipo" autocomplete="given-preciosMensuales"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm text-base font-semibold border-transparent"
                                    value="{{ $Data['rent']->equipment->noSerieEquipo }} - {{ $Data['rent']->equipment->preciosMensuales }}"
                                    required disabled>
                            </div>
                            <div class="relative col-span-6 sm:col-span-6 pointer-events-none">
                                <label for="cliente" class="block text-sm font-medium text-gray-700">Cliente</label>
                                <input type="text" name="cliente" autocomplete="given-preciosMensuales"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm text-base font-semibold border-transparent"
                                    value="{{ $Data['rent']->person->nombrePersona }} {{ $Data['rent']->person->apePaternoPersona }} {{ $Data['rent']->person->apeMaternoPersona }}"
                                    required disabled>
                            </div>
                            <div class="relative col-span-6 sm:col-span-6 pointer-events-none">
                                <label for="fechaInicioFin" class="block text-sm font-medium text-gray-700">Fecha De
                                    Inicio y Fin </label>
                                <input type="text" name="fechaInicioFin" autocomplete="given-preciosMensuales"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm text-base font-semibold border-transparent"
                                    value="{{ $Data['fecha'] }}" required disabled>
                            </div>
                        @endif
                        <div class="col-span-6 sm:col-span-6">
                            <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                            <textarea rows="3" name="descripcion" id="descripcion" autocomplete="given-descripcion"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('descripcion') border-red-400 @enderror">{{ old('descripcion', $Data['rent']->descripcion) }}</textarea>
                            @error('descripcion')
                                <div class="flex
                                    items-center mt-1 text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        @if (getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Rents' &&
                                getDashboardNameFromUrlSecond(request()->fullUrl()) == 'create')
                            <div class="col-span-6 sm:col-span-6">
                                <label for="fecha_inicio" class="block text-sm font-medium text-gray-700">Fecha
                                    Inicio</label>
                                <input type="date" name="fecha_inicio" id="fecha_inicio"
                                    autocomplete="given-fecha_inicio"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('fecha_inicio') border-red-400 @enderror"
                                    value="{{ old('fecha_inicio', $Data['rent']->fecha_inicio) }}" required>
                                @error('fecha_inicio')
                                    <div class="flex
                                    items-center mt-1 text-red-400">
                                        <i class="fas fa-exclamation-triangle mr-2"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="col-span-6 sm:col-span-6">
                                <label for="fecha_fin" class="block text-sm font-medium text-gray-700">Fecha
                                    Fin</label>
                                <input type="date" name="fecha_fin" id="fecha_fin" autocomplete="given-fecha_fin"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('fecha_fin') border-red-400 @enderror"
                                    value="{{ old('fecha_fin', $Data['rent']->fecha_fin) }}" required>
                                @error('fecha_fin')
                                    <div class="flex
                                    items-center mt-1 text-red-400">
                                        <i class="fas fa-exclamation-triangle mr-2"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                        @endif
                        @php
                            if ($Data['rent']['payments_rents_count'] > 0) {
                                $preciosMensuales = ($Data['rent']['payments_rents_sum_pago_renta'] + $Data['rent']['payments_rents_sum_iva_renta']) / $Data['rent']['payments_rents_count'];
                                $preciosMensuales = "$" . number_format($preciosMensuales, 2);
                            }
                        @endphp
                        <div
                            class="col-span-6 sm:col-span-6 {{ $Data['rent']['payments_rents_count'] > 0 ? 'pointer-events-none' : '' }}">
                            <label for="preciosMensuales" class="block text-sm font-medium text-gray-700">Costo Por
                                Mes <span class="text-gray-400">(Calculo de los gastos mensuales con %25 de rendimiento
                                    adicional y <span class="text-green-400">Costo Personalizable</span>)
                                </span></label>
                            <input type="{{ $Data['rent']['payments_rents_count'] > 0 ? 'text' : 'number' }}"
                                min="0" max="99999999.99" step="0.01" name="preciosMensuales"
                                id="preciosMensuales" autocomplete="given-preciosMensuales"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm 
                                {{ $Data['rent']['payments_rents_count'] > 0 ? 'border-transparent' : '' }}
                                @error('preciosMensuales') border-red-400 @enderror"
                                value="{{ $Data['rent']['payments_rents_count'] > 0 ? $preciosMensuales : '' }}"
                                required {{ $Data['rent']['payments_rents_count'] > 0 ? 'disabled' : '' }}>
                            @error('preciosMensuales')
                                <div class="flex
                                    items-center mt-1 text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="clvEstadoRenta" class="block text-sm font-medium text-gray-700">Estado
                                De
                                Renta</label>
                            <select id="clvEstadoRenta" name="clvEstadoRenta"
                                class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-green-500 focus:outline-none focus:ring-green-500 sm:text-sm @error('clvEstadoRenta') border-red-400 @enderror"
                                required>
                                @if (count($Data['statusRents']) > 0)
                                    <option value="" disabled selected>
                                        Seleccione Un Estado De Renta</option>
                                    @foreach ($Data['statusRents'] as $statusRent)
                                        <option value="{{ $statusRent->clvEstadoRenta }}"
                                            @if ($statusRent->clvEstadoRenta == $Data['rent']->clvEstadoRenta) selected @endif>
                                            {{ $statusRent->estadoRenta }}
                                        </option>
                                    @endforeach
                                @else
                                    <option value="" disabled selected>
                                        No Hay Opciones De Estado De Renta Disponible</option>
                                @endif
                            </select>
                            @error('clvEstadoRenta')
                                <div class="flex
                                    items-center mt-1 text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <x-Dashboard.Save-Button name="Guardar Renta" />
                </form>
            </div>
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

        function updatePreciosMensuales() {
            // Obtén el select y el campo de entrada
            var select = document.getElementById("clvEquipo");
            var preciosMensuales = document.getElementById("preciosMensuales");

            // Obtén el valor del atributo de datos "precios" de la opción seleccionada
            var selectedOption = select.options[select.selectedIndex];
            var precios = selectedOption.getAttribute("data-precios");

            // Establece el valor del campo de entrada a precios
            preciosMensuales.value = (precios / 0.8).toFixed(2);
        }
    </script>
@endpush
