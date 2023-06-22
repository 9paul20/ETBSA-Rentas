<div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">{{-- Titulo e información --}}
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Rent Information</h3>
                <p class="mt-1 text-sm text-gray-600">Use a permanent address where you can receive mail.</p>
            </div>
        </div>
        <div class="mt-5 md:col-span-2 md:mt-0"> {{-- Formulario html --}}
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
                <div class="bg-white px-1 py-1 sm:p-6">
                    <div class="grid grid-cols-6 gap-1">
                        @if (getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Rents' &&
                                getDashboardNameFromUrlSecond(request()->fullUrl()) == 'create')
                            <div class="col-span-3 sm:col-span-3"> {{-- Select del equipo --}}
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
                                                data-fecha-adquisicion="{{ $equipment->fechaAdquisicion }}"
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
                            <div class="col-span-3 sm:col-span-3"> {{-- Select del cliente --}}
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
                        {{-- Form para Editar --}}
                        @if (getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Rents' &&
                                getDashboardNameFromUrlSecond(request()->fullUrl()) == 'edit')
                            <div class="relative col-span-2 sm:col-span-2 pointer-events-none"> {{-- Vista del equipo --}}
                                <label for="equipo" class="block text-sm font-medium text-gray-700">Equipo</label>
                                <input type="text" name="equipo"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm text-base font-semibold border-transparent"
                                    value="{{ $Data['rent']->equipment->noSerieEquipo }} - {{ $Data['rent']->equipment->modelo }}"
                                    required disabled>
                            </div>
                            <div class="relative col-span-2 sm:col-span-2 pointer-events-none">
                                <label for="cliente" class="block text-sm font-medium text-gray-700">Cliente</label>
                                {{-- Vista del cliente --}}
                                <input type="text" name="cliente"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm text-base font-semibold border-transparent"
                                    value="{{ $Data['rent']->person->nombrePersona }} {{ $Data['rent']->person->apePaternoPersona }} {{ $Data['rent']->person->apeMaternoPersona }}"
                                    required disabled>
                            </div>
                            <div class="relative col-span-2 sm:col-span-2 pointer-events-none"> {{-- Vista de la fecha inicio y fin --}}
                                <label for="fechaInicioFin" class="block text-sm font-medium text-gray-700">Fecha De
                                    Inicio y Fin </label>
                                <input type="text" name="fechaInicioFin"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm text-base font-semibold border-transparent"
                                    value="{{ $Data['fecha'] }}" required disabled>
                            </div>
                        @endif
                        {{-- Vista para Crear --}}
                        @if (getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Rents' &&
                                getDashboardNameFromUrlSecond(request()->fullUrl()) == 'create')
                            <div class="col-span-3 sm:col-span-3"> {{-- Fecha de inicio --}}
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
                            <div class="col-span-1 sm:col-span-1"> {{-- Días a rentar --}}
                                <label for="diasARentar" class="block text-sm font-medium text-gray-700">Días A
                                    Rentar</label>
                                <input type="number" name="diasARentar" id="diasARentar"
                                    autocomplete="given-mesesARentar" min="0" step="1" pattern="[0-9]"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm"
                                    value="{{ old('diasARentar') }}">
                            </div>
                            <div class="col-span-2 sm:col-span-2">{{-- Renta por Mes --}}
                                <label for="rentaAlMes" class="block text-sm font-medium text-gray-700">Renta
                                    Por
                                    Mes {{-- <span class="text-gray-400">(Calculo de los gastos mensuales con %25 de
                                        rendimiento
                                        adicional y <span class="text-green-400">Costo Personalizable</span>) --}}
                                    </span></label>
                                <div class="flex flex-row col-span-6 sm:col-span-6">
                                    <span
                                        class="flex items-center bg-grey-lighter text-green-500 rounded rounded-r-none px-1 font-bold text-grey-darker">$</span>
                                    <input type="number" min="0" max="99999999.99" step="0.01"
                                        pattern="[0-9]+(\.[0-9]+)?" name="rentaAlMes" id="rentaAlMes"
                                        autocomplete="given-rentaAlMes"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm"
                                        required>
                                </div>
                            </div>
                            {{-- Periodo de renta --}}
                            {{-- <div class="col-span-2 sm:col-span-2">
                                <label for="periodoRenta" class="block text-sm font-medium text-gray-700">Periodos de
                                    Renta</label>
                                <select id="periodoRenta" name="periodoRenta"
                                    class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-green-500 focus:outline-none focus:ring-green-500 sm:text-sm @error('periodoRenta') border-red-400 @enderror">
                                    <option value="" disabled selected>
                                        Seleccione Un Periodo De Renta</option>
                                    <option value="1" >
                                        Mensual (Cada mes)
                                    </option>
                                    <option value="2">
                                        Bimestral (Cada dos meses)
                                    </option>
                                    <option value="3">
                                        Trimestral (Cada tres meses)
                                    </option>
                                    <option value="6">
                                        Semestral (Cada seis meses)
                                    </option>
                                    <option value="12">
                                        Anual (Cada doce meses)
                                    </option>
                                </select>
                                @error('periodoRenta')
                                    <div class="flex
                                    items-center mt-1 text-red-400">
                                        <i class="fas fa-exclamation-triangle mr-2"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div> --}}
                            <div class="col-span-3 sm:col-span-3"> {{-- Fecha fin --}}
                                <label for="fecha_fin" class="block text-sm font-medium text-gray-700">Fecha
                                    Fin</label>
                                <input type="date" name="fecha_fin" id="fecha_fin" autocomplete="given-fecha_fin"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm text-base font-semibold border-transparent"
                                    value="{{ old('fecha_fin') }}" readonly>
                                @error('fecha_fin')
                                    <div class="flex
                                    items-center mt-1 text-red-400">
                                        <i class="fas fa-exclamation-triangle mr-2"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="col-span-1 sm:col-span-1"> {{-- Dias a Meses(Conversión) --}}
                                <label for="diasAMeses" class="block text-sm font-medium text-gray-700">Días A
                                    Meses</label>
                                <input type="number" name="diasAMeses" id="diasAMeses"
                                    autocomplete="given-diasAMeses" min="0" step="1" pattern="[0-9]"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm text-base font-semibold border-transparent"
                                    value="{{ old('diasAMeses') }}" readonly>
                            </div>
                            {{-- Renta por día --}}
                            {{-- <div
                                class="col-span-2 sm:col-span-2 {{ $Data['rent']['payments_rents_count'] > 0 ? 'pointer-events-none' : '' }}">
                                <label for="preciosDiarios" class="block text-sm font-medium text-gray-700">Costo Por
                                    Día <span class="text-gray-400">(<span class="text-green-400">Costo de renta
                                            diaria</span>)
                                    </span></label>
                                <div class="flex flex-row col-span-6 sm:col-span-6">
                                    <span
                                        class="flex items-center bg-grey-lighter text-green-500 rounded rounded-r-none px-1 font-bold text-grey-darker">$</span>
                                    <input type="text" min="0" max="99999999.99" step="0.01"
                                        pattern="[0-9]+(\.[0-9]+)?" name="preciosDiarios" id="preciosDiarios"
                                        autocomplete="given-preciosDiarios"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm"
                                        value="" required disabled>
                                </div>
                            </div> --}}
                            <div class="col-span-2 sm:col-span-2"> {{-- Total de la renta --}}
                                <label for="totalDeRenta" class="block text-sm font-medium text-gray-700">Total
                                    <span id="redondeoDeMeses" name="redondeoDeMeses"
                                        class="text-green-400"></span></label>
                                <div class="flex flex-row col-span-6 sm:col-span-6">
                                    <span
                                        class="flex items-center bg-grey-lighter text-green-500 rounded rounded-r-none px-1 font-bold text-grey-darker">$</span>
                                    <input type="number" name="totalDeRenta" id="totalDeRenta"
                                        autocomplete="given-totalDeRenta" min="0" step="1"
                                        pattern="[0-9]"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm text-base font-semibold border-transparent"
                                        value="{{ old('total') }}" readonly>
                                </div>
                            </div>
                        @endif
                        @php
                            if ($Data['rent']['payments_rents_count'] > 0) {
                                $preciosMensuales = ($Data['rent']['payments_rents_sum_pago_renta'] + $Data['rent']['payments_rents_sum_iva_renta']) / $Data['rent']['payments_rents_count'];
                                $preciosMensuales = "$" . number_format($preciosMensuales, 2);
                            }
                        @endphp
                        {{-- Vista de Editar --}}
                        @if (getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Rents' &&
                                getDashboardNameFromUrlSecond(request()->fullUrl()) == 'edit')
                            <div class="col-span-6 sm:col-span-6"> {{-- Vista del estado de renta --}}
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
                                                {{ $statusRent->clvEstadoRenta == $Data['rent']->clvEstadoRenta ? 'selected' : '' }}>
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
                        @endif
                        <div class="col-span-6 sm:col-span-6"> {{-- Descripción --}}
                            <label for="descripcion"
                                class="block text-sm font-medium text-gray-700">Descripción</label>
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
        @if (getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Rents' &&
                getDashboardNameFromUrlSecond(request()->fullUrl()) == 'create')

            //Inputs
            const diasARentar = document.getElementById('diasARentar');
            const rentaAlMes = document.getElementById('rentaAlMes');
            const fechaInicio = document.getElementById('fecha_inicio');
            const fechaFin = document.getElementById('fecha_fin');
            const diasAMeses = document.getElementById('diasAMeses');
            const totalDeRenta = document.getElementById('totalDeRenta');
            //Labels o textos planos
            const redondeoDeMeses = document.getElementById('redondeoDeMeses');

            function updatePreciosMensuales() {
                // Obtén el equipoSelect y el campo de entrada
                const equipoSelect = document.getElementById('clvEquipo');
                // Obtén el valor del atributo de datos "precios" de la opción seleccionada
                var selectedOption = equipoSelect.options[equipoSelect.selectedIndex];
                var precios = selectedOption.getAttribute("data-precios");
                // Establece el valor del campo de entrada a precios
                rentaAlMes.value = (precios / 0.8).toFixed(2);
                //
                var fechaAdquisicion = selectedOption.getAttribute('data-fecha-adquisicion');
                fechaInicio.min = fechaAdquisicion;
            }

            diasARentar.addEventListener('input', sumarDias);
            rentaAlMes.addEventListener('input', rentaTotal);

            function sumarDias() {
                const fechaInicioValor = new Date(fechaInicio.value);
                const diasARentarValor = parseInt(diasARentar.value);

                if (!isNaN(fechaInicioValor.getTime()) && !isNaN(diasARentarValor)) {
                    const fechaFinValor = new Date(fechaInicioValor.getTime());
                    fechaFinValor.setDate(fechaFinValor.getDate() + diasARentarValor);

                    const year = fechaFinValor.getFullYear();
                    const month = (fechaFinValor.getMonth() + 1).toString().padStart(2, '0');
                    const day = fechaFinValor.getDate().toString().padStart(2, '0');
                    const formattedFechaFin = `${year}-${month}-${day}`;
                    const diasAMesesOperador = (diasARentarValor / 30).toFixed(2);

                    fechaFin.value = formattedFechaFin;
                    diasAMeses.value = diasAMesesOperador;
                } else {
                    diasAMeses.value = null;
                    totalDeRenta.value = null;
                }
            }

            function rentaTotal() {
                if (!isNaN(rentaAlMes.value) || !isNaN(diasAMeses.value)) {
                    const diasAMesesRounded = Math.ceil(diasAMeses.value);
                    redondeoDeMeses.innerText = `(Se considerarán ${diasAMesesRounded} meses)`;
                    totalDeRenta.value = rentaAlMes.value * diasAMesesRounded;
                } else {
                    redondeoDeMeses.innerText = ``;
                    totalDeRenta.value = null;
                }
            }
        @endif
    </script>
@endpush
