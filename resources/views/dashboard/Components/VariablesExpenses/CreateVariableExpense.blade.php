<div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Variables Expense</h3>
                <p class="mt-1 text-sm text-gray-600">Use a labels for complete the information.</p>
            </div>
        </div>
        <div class="mt-5 md:col-span-2 md:mt-0">
            @if (getDashboardNameFromUrlFirst(request()->fullUrl()) == 'VariablesExpenses' &&
                    getDashboardNameFromUrlSecond(request()->fullUrl()) == 'create')
                <form action="{{ route('Dashboard.Admin.VariablesExpenses.Store') }}" method="POST">
                @elseif(getDashboardNameFromUrlFirst(request()->fullUrl()) == 'VariablesExpenses' &&
                        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'edit')
                    <form
                        action="{{ route('Dashboard.Admin.VariablesExpenses.Update', $Data['variableExpense']->clvGastoVariable) }}"
                        method="POST">
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
                                    <option value="" disabled {{ old('clvEquipo') ? '' : 'selected' }}>Seleccione
                                        un Equipo</option>
                                    @foreach ($Data['equipments'] as $equipment)
                                        <option value="{{ $equipment->clvEquipo }}"
                                            {{ old('clvEquipo') == $equipment->clvEquipo || $equipment->clvEquipo == $Data['variableExpense']->clvEquipo ? 'selected' : '' }}>
                                            {{ $equipment->modelo }} - {{ $equipment->noSerieEquipo }}
                                        </option>
                                    @endforeach
                                @else
                                    <option value="" disabled selected>No hay opciones de equipo disponible
                                    </option>
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
                            <label for="gastoVariable" class="block text-sm font-medium text-gray-700">Gasto
                                Variable</label>
                            <input type="text" name="gastoVariable" id="gastoVariable"
                                autocomplete="given-gastoVariable"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('gastoVariable') border-red-400 @enderror"
                                value="{{ old('gastoVariable', $Data['variableExpense']['gastoVariable']) }}" required>
                            @error('gastoVariable')
                                <div class="flex
                                    items-center mt-1 text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción Del
                                Gasto
                                Variable</label>
                            <textarea rows="3" name="descripcion" id="descripcion" autocomplete="given-descripcion"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('descripcion') border-red-400 @enderror"
                                minlength="4" maxlength="255" required>{{ old('descripcion', $Data['variableExpense']->descripcion) }}</textarea>
                            @error('descripcion')
                                <div class="flex
                                    items-center mt-1 text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="fechaGastoVariable" class="block text-sm font-medium text-gray-700">Fecha
                                Del Gasto Fijo</label>
                            <input type="date" name="fechaGastoVariable" id="fechaGastoVariable"
                                autocomplete="given-fechaGastoVariable"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('fechaGastoVariable') border-red-400 @enderror"
                                value="{{ old('fechaGastoVariable', $Data['variableExpense']->fechaGastoVariable) }}"
                                required max='{{ $Data['today'] }}'>
                            @error('fechaGastoVariable')
                                <div class="flex
                                    items-center mt-1 text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="costoGastoVariable" class="block text-sm font-medium text-gray-700">Costo del
                                Gasto
                                Variable</label>
                            <input type="number" name="costoGastoVariable" id="costoGastoVariable"
                                pattern="[0-9]+(\.[0-9]+)?" min="0" max="99999999.99" step="0.01"
                                autocomplete="given-costoGastoVariable"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('costoGastoVariable') border-red-400 @enderror"
                                value="{{ old('costoGastoVariable', $Data['variableExpense']->costoGastoVariable) }}"
                                required>
                            @error('costoGastoVariable')
                                <div class="flex
                                    items-center mt-1 text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <x-Dashboard.Save-Button name="Guardar Gasto Fijo" />
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
