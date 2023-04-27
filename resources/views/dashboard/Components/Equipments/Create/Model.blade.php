<div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Equipment Information</h3>
                <p class="mt-1 text-sm text-gray-600">Use a permanent address where you can receive mail.</p>
                @if (getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Equipments' &&
                        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'edit')
                    @include('Dashboard.Components.Divisor')
                    <h3 class="text-lg font-medium leading-6 text-gray-600">Precio Actual del Equipo: <span
                            class="font-medium text-green-600">$</span>
                        {{ number_format($Data['equipment']['precioEquipo'], 2) }}</h3>
                    <h3 class="text-lg font-medium leading-6 text-gray-600">Total de Gastos Fijos del Equipo: <span
                            class="font-medium text-green-600">$</span>
                        {{ number_format($Data['equipment']->sum_gastos_fijos, 2) }}</h3>
                    <h3 class="text-lg font-medium leading-6 text-gray-600">Total de Gastos Variables del Equipo: <span
                            class="font-medium text-green-600">$</span>
                        {{ number_format($Data['equipment']->sum_gastos_variables, 2) }}
                    </h3>
                    @include('Dashboard.Components.Divisor')
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Total: <span
                            class="font-medium text-green-600">$</span>
                        {{ number_format($Data['equipment']->costo_base, 2) }}
                    </h3>
                @endif
            </div>
        </div>
        <div class="mt-5 md:col-span-2 md:mt-0">
            @if (getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Equipments' &&
                    getDashboardNameFromUrlSecond(request()->fullUrl()) == 'create')
                <form action="{{ route('Dashboard.Admin.Equipments.Store') }}" method="POST">
                @elseif(getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Equipments' &&
                        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'edit')
                    <form action="{{ route('Dashboard.Admin.Equipments.Update', $Data['equipment']['clvEquipo']) }}"
                        method="POST">
                        @method('PUT')
            @endif
            @csrf
            <div class="overflow-hidden shadow sm:rounded-md">
                <div class="bg-white px-4 py-5 sm:p-6">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-6">
                            <label for="noSerieEquipo" class="block text-sm font-medium text-gray-700">No. Serie
                                Del
                                Equipo</label>
                            <input type="text" name="noSerieEquipo" id="noSerieEquipo"
                                autocomplete="given-noSerieEquipo"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('noSerieEquipo') border-red-400 @enderror"
                                value="{{ old('noSerieEquipo', $Data['equipment']['noSerieEquipo']) }}" required
                                autofocus>
                            @error('noSerieEquipo')
                                <div class="flex
                                    items-center mt-1 text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="noSerieMotor" class="block text-sm font-medium text-gray-700">No. Serie
                                Del
                                Motor</label>
                            <input type="text" name="noSerieMotor" id="noSerieMotor"
                                autocomplete="given-noSerieMotor"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('noSerieMotor') border-red-400 @enderror"
                                value="{{ old('noSerieMotor', $Data['equipment']['noSerieMotor']) }}" required>
                            @error('noSerieMotor')
                                <div class="flex
                                    items-center mt-1 text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="noEconomico" class="block text-sm font-medium text-gray-700">No.
                                Económico</label>
                            <input type="text" name="noEconomico" id="noEconomico" autocomplete="given-noEconomico"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('noEconomico') border-red-400 @enderror"
                                value="{{ old('noEconomico', $Data['equipment']['noEconomico']) }}" required>
                            @error('noEconomico')
                                <div class="flex
                                    items-center mt-1 text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="modelo" class="block text-sm font-medium text-gray-700">Modelo</label>
                            <input type="text" name="modelo" id="modelo" autocomplete="given-modelo"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('modelo') border-red-400 @enderror"
                                value="{{ old('modelo', $Data['equipment']['modelo']) }}" required>
                            @error('modelo')
                                <div class="flex
                                    items-center mt-1 text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="precioEquipo" class="block text-sm font-medium text-gray-700">Precio de Compra
                                Del Equipo</label>
                            <input type="number" name="precioEquipo" id="precioEquipo" pattern="[0-9]+(\.[0-9]+)?"
                                min="0" max="99999999.99" step="0.01" autocomplete="given-precioEquipo"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('precioEquipo') border-red-400 @enderror"
                                value="{{ old('precioEquipo', $Data['equipment']['precioEquipo']) }}" required>
                            @error('precioEquipo')
                                <div class="flex
                                    items-center mt-1 text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="clvDisponibilidad"
                                class="block text-sm font-medium text-gray-700">Disponibilidad</label>
                            <select id="clvDisponibilidad" name="clvDisponibilidad"
                                class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-green-500 focus:outline-none focus:ring-green-500 sm:text-sm @error('clvDisponibilidad') border-red-400 @enderror"
                                required>
                                @if (count($Data['status']) > 0)
                                    <option value="" disabled selected>
                                        Seleccione Una Disponibilidad</option>
                                    @foreach ($Data['status'] as $disponibilidad)
                                        <option value="{{ $disponibilidad['clvDisponibilidad'] }}"
                                            @if ($disponibilidad['clvDisponibilidad'] == $Data['equipment']['clvDisponibilidad']) selected @endif>
                                            {{ $disponibilidad['disponibilidad'] }}
                                        </option>
                                    @endforeach
                                @else
                                    <option value="" disabled selected>
                                        No Hay Opciones De Disponibilidad</option>
                                @endif
                            </select>
                            @error('clvDisponibilidad')
                                <div class="flex
                                    items-center mt-1 text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="clvCategoria" class="block text-sm font-medium text-gray-700">Categoria</label>
                            <select id="clvCategoria" name="clvCategoria"
                                class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-green-500 focus:outline-none focus:ring-green-500 sm:text-sm @error('clvCategoria') border-red-400 @enderror"
                                required>
                                @if (count($Data['categories']) > 0)
                                    <option value="" disabled selected>
                                        Seleccione Una Categoria</option>
                                    @foreach ($Data['categories'] as $category)
                                        <option value="{{ $category['clvCategoria'] }}"
                                            @if ($category['clvCategoria'] == $Data['equipment']['clvCategoria']) selected @endif>
                                            {{ $category['categoria'] }}
                                        </option>
                                    @endforeach
                                @else
                                    <option value="" disabled selected>
                                        No Hay Opciones De Categoria Disponible</option>
                                @endif
                            </select>
                            @error('clvCategoria')
                                <div class="flex
                                    items-center mt-1 text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="folioEquipo" class="block text-sm font-medium text-gray-700">Folio De
                                Factura</label>
                            <input type="text" name="folioEquipo" id="folioEquipo" min="6" max="20"
                                autocomplete="given-folioEquipo"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('folioEquipo') border-red-400 @enderror"
                                value="{{ old('folioEquipo', $Data['equipment']['folioEquipo']) }}" required>
                            @error('folioEquipo')
                                <div
                                    class="flex
                                                                    items-center mt-1 text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="fechaAdquisicion" class="block text-sm font-medium text-gray-700">Fecha
                                De
                                Adquisición</label>
                            <input type="date" name="fechaAdquisicion" id="fechaAdquisicion"
                                autocomplete="given-fechaAdquisicion"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('fechaAdquisicion') border-red-400 @enderror"
                                value="{{ old('fechaAdquisicion', $Data['equipment']['fechaAdquisicion']) }}" required
                                max='{{ $Data['today'] }}'>
                            @error('fechaAdquisicion')
                                <div class="flex
                                    items-center mt-1 text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="porcentajeDepreciacionAnual"
                                class="block text-sm font-medium text-gray-700">Depreciación Anual Del Equipo
                                (Porcentaje)</label>
                            <input type="number" name="porcentajeDepreciacionAnual" id="porcentajeDepreciacionAnual"
                                pattern="[0-9]+(\.[0-9]+)?" min="0" max="100.00" step="0.01"
                                autocomplete="given-porcentajeDepreciacionAnual"
                                placeholder="Porcentaje actual para cada Equipo es del %25"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('porcentajeDepreciacionAnual') border-red-400 @enderror"
                                value="{{ old('porcentajeDepreciacionAnual', $Data['equipment']['porcentajeDepreciacionAnual']) }}"
                                required>
                            @error('porcentajeDepreciacionAnual')
                                <div class="flex
                                    items-center mt-1 text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="fechaGarantiaExtendida" class="block text-sm font-medium text-gray-700">Fecha
                                De La Garantia Extendida
                                del Equipo</label>
                            <input type="date" name="fechaGarantiaExtendida" id="fechaGarantiaExtendida"
                                autocomplete="given-fechaGarantiaExtendida"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('fechaGarantiaExtendida') border-red-400 @enderror"
                                value="{{ old('fechaGarantiaExtendida', $Data['equipment']['fechaGarantiaExtendida']) }}"
                                required max='{{ $Data['today'] }}'>
                            @error('fechaGarantiaExtendida')
                                <div class="flex items-center mt-1 text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="descripcion"
                                class="block text-sm font-medium text-gray-700">Descripción</label>
                            <textarea rows="3" name="descripcion" id="descripcion" autocomplete="given-descripcion"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('descripcion') border-red-400 @enderror"
                                required>{{ old('descripcion', $Data['equipment']['descripcion']) }}</textarea>
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
                <x-Dashboard.Save-Button name="Guardar Equipo" />
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
