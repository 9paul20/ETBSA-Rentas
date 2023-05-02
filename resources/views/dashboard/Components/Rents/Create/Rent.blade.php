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
                        <div class="col-span-6 sm:col-span-6">
                            <label for="clvEquipo" class="block text-sm font-medium text-gray-700">Equipo</label>
                            <select id="clvEquipo" name="clvEquipo"
                                class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-green-500 focus:outline-none focus:ring-green-500 sm:text-sm @error('clvEquipo') border-red-400 @enderror"
                                required>
                                @if (count($Data['equipments']) > 0)
                                    <option value="" disabled selected>
                                        Seleccione Un Equipo</option>
                                    @foreach ($Data['equipments'] as $equipment)
                                        <option value="{{ $equipment->clvEquipo }}"
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
                        <div class="col-span-6 sm:col-span-6">
                            <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                            <textarea rows="3" name="descripcion" id="descripcion" autocomplete="given-descripcion"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('descripcion') border-red-400 @enderror"
                                required autofocus>{{ old('descripcion', $Data['rent']->descripcion) }}</textarea>
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
                        <div class="col-span-6 sm:col-span-6">
                            <label for="clvPagoRenta" class="block text-sm font-medium text-gray-700">Pago
                                Renta</label>
                            <select id="clvPagoRenta" name="clvPagoRenta"
                                class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-green-500 focus:outline-none focus:ring-green-500 sm:text-sm @error('clvPagoRenta') border-red-400 @enderror"
                                required>
                                @if (count($Data['paymentsRents']) > 0)
                                    <option value="" disabled selected>
                                        Seleccione Una Compañia Telefónica</option>
                                    @foreach ($Data['paymentsRents'] as $paymentRent)
                                        <option value="{{ $paymentRent->clvPagoRenta }}"
                                            @if ($paymentRent->clvPagoRenta == $Data['rent']->clvPagoRenta) selected @endif>
                                            Pago: ${{ $paymentRent->pagoRenta }} + IVA: ${{ $paymentRent->ivaRenta }}
                                            =
                                            ${{ $paymentRent->pagoRenta + $paymentRent->ivaRenta }}
                                        </option>
                                    @endforeach
                                @else
                                    <option value="" disabled selected>
                                        No Hay Opciones De Pago Renta Disponible</option>
                                @endif
                            </select>
                            @error('clvPagoRenta')
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
                                        Seleccione Una Compañia Telefónica</option>
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
