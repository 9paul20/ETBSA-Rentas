<div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Fixed Expense</h3>
                <p class="mt-1 text-sm text-gray-600">Use a labels for complete the information.</p>
            </div>
        </div>
        <div class="mt-5 md:col-span-2 md:mt-0">
            @if (getDashboardNameFromUrlFirst(request()->fullUrl()) == 'MonthlyExpenses' &&
                    getDashboardNameFromUrlSecond(request()->fullUrl()) == 'create')
                <form action="{{ route('Dashboard.Admin.MonthlyExpenses.Store') }}" method="POST">
                @elseif(getDashboardNameFromUrlFirst(request()->fullUrl()) == 'MonthlyExpenses' &&
                        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'edit')
                    <form
                        action="{{ route('Dashboard.Admin.MonthlyExpenses.Update', $Data['monthlyExpense']->clvGastoMensual) }}"
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
                                            {{ old('clvEquipo') == $equipment->clvEquipo || $equipment->clvEquipo == $Data['monthlyExpense']->clvEquipo ? 'selected' : '' }}
                                            data-precioequipo="{{ $equipment->precioEquipo }}"
                                            data-precioequipogastosfijos="{{ $equipment->precioEquipo + $equipment->sumGastosFijos }}">
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
                            <label for="gastoMensual" class="block text-sm font-medium text-gray-700">Gasto
                                Mensual</label>
                            <input type="text" name="gastoMensual" id="gastoMensual"
                                autocomplete="given-gastoMensual" min="4" max="255"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('gastoMensual') border-red-400 @enderror"
                                pattern=".{4,255}" title="El campo debe contener entre 4 y 255 caracteres"
                                value="{{ old('gastoMensual', $Data['monthlyExpense']['gastoMensual']) }}" required
                                autofocus>
                            @error('gastoMensual')
                                <div class="flex
                                    items-center mt-1 text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="clvTipoGastoFijo" class="block text-sm font-medium text-gray-700">Gasto
                                Fijo</label>
                            <select id="clvTipoGastoFijo" name="clvTipoGastoFijo"
                                class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-green-500 focus:outline-none focus:ring-green-500 sm:text-sm @error('clvTipoGastoFijo') border-red-400 @enderror"
                                required>
                                @if (count($Data['typeFixedExpenses']) > 0)
                                    <option value="" disabled selected>
                                        Seleccione Un Gasto Fijo</option>
                                    @foreach ($Data['typeFixedExpenses'] as $typeFixedExpense)
                                        <option value="{{ $typeFixedExpense->clvTipoGastoFijo }}"
                                            {{ old('clvTipoGastoFijo') == $typeFixedExpense->clvTipoGastoFijo || $typeFixedExpense->clvTipoGastoFijo == $Data['monthlyExpense']->clvTipoGastoFijo ? 'selected' : '' }}>
                                            {{ $typeFixedExpense->tipoGastoFijo }}
                                        </option>
                                    @endforeach
                                @else
                                    <option value="" disabled selected>
                                        No Hay Opciones De Gasto Fijo Disponible</option>
                                @endif
                            </select>
                            @error('clvTipoGastoFijo')
                                <div class="flex
                                    items-center mt-1 text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="precioEquipo" class="block text-sm font-medium text-gray-700">Valor Fijo</label>
                            <select id="precioEquipoSelect" name="precioEquipo"
                                class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-green-500 focus:outline-none focus:ring-green-500 sm:text-sm @error('precioEquipo') border-red-400 @enderror"
                                required>
                                <option value="" disabled selected>
                                    Seleccione un Equipo Primero</option>
                            </select>
                            @error('precioEquipo')
                                <div class="flex items-center mt-1 text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                            <input type="hidden" name="indiceValorFijo" id="indiceValorFijo"
                                value="{{ old('indiceValorFijo', $Data['monthlyExpense']['indiceValorFijo']) }}">
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="porGastoMensual" class="block text-sm font-medium text-gray-700">Porcentaje Del
                                Gasto Mensual</label>
                            <input type="number" name="porGastoMensual" id="porGastoMensual"
                                pattern="[0-9]+(\.[0-9]+)?" step="0.01" autocomplete="given-porGastoMensual"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm 
                                @if (!isset($Data['monthlyExpense']['porGastoMensual']) || $Data['monthlyExpense']['porGastoMensual'] <= 0) opacity-100 cursor-not-allowed @endif @error('porGastoMensual') border-red-400 @enderror"
                                min="0" max="100.00"
                                value="{{ old('porGastoMensual', $Data['monthlyExpense']['porGastoMensual']) }}"
                                step="0.01" @if (!isset($Data['monthlyExpense']['porGastoMensual']) || $Data['monthlyExpense']['porGastoMensual'] <= 0) disabled @endif>
                            @error('porGastoMensual')
                                <div class="flex
                                    items-center mt-1 text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="costoMensual" class="block text-sm font-medium text-gray-700">Costo del
                                Gasto
                                Mensual</label>
                            <input type="number" name="costoMensual" id="costoMensual" pattern="[0-9]+(\.[0-9]+)?"
                                min="0" max="99999999.99" step="0.01" autocomplete="given-costoMensual"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('costoMensual') border-red-400 @enderror"
                                value="{{ old('costoMensual', $Data['monthlyExpense']['costoMensual']) }}" required>
                            @error('costoMensual')
                                <div class="flex
                                    items-center mt-1 text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción del
                                Gasto Mensual</label>
                            <textarea rows="3" name="descripcion" id="descripcion" autocomplete="given-descripcion"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('descripcion') border-red-400 @enderror"
                                minlength="4" maxlength="255">{{ old('descripcion', $Data['monthlyExpense']['descripcion']) }}</textarea>
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

            $('#precioEquipoSelect').on('change', function() {
                var indiceSeleccionado = $('option:selected', this).data('indice');
                $('#indiceValorFijo').val(indiceSeleccionado);
            });

            $(document).ready(function() {
                function actualizarPrecioEquipo() {
                    var precioEquipo = $('option:selected', this).data('precioequipo');
                    var precioEquipoGastosFijos = $('option:selected', this).data('precioequipogastosfijos');

                    var precioEquipoSelect = $('#precioEquipoSelect');
                    precioEquipoSelect.empty();

                    if (precioEquipo && precioEquipoGastosFijos) {
                        var option1 = $('<option value="0" data-indice="1">Agregar Costo Personalmente</option>');
                        var option2 = $('<option value="' + precioEquipo + '" data-indice="2">Precio Del Equipo - $' +
                            precioEquipo + '</option>');
                        var option3 = $('<option value="' + precioEquipoGastosFijos +
                            '" data-indice="3">Precio Del Equipo Más Gastos Fijos - $' + precioEquipoGastosFijos +
                            '</option>');
                        precioEquipoSelect.append(option1, option2, option3);
                    } else {
                        var option1 = $(
                            '<option value="" disabled selected>No existen valores fijos para el equipo</option>');
                        var option2 = $('<option value="0" data-indice="1">Agregar Costo Personalmente</option>');
                        precioEquipoSelect.append(option1, option2);
                    }

                    // Método para seleccionar el option correspondiente según el índice del valor fijo
                    var indiceValorFijo = "{{ $Data['monthlyExpense']['indiceValorFijo'] }}";
                    console.log(indiceValorFijo);
                    $('#precioEquipoSelect option[data-indice="' + indiceValorFijo + '"]').prop('selected', true);
                }

                $('#clvEquipo').on('change', actualizarPrecioEquipo);

                $(document).ready(function() {
                    // Disparar el evento change del elemento #clvEquipo para ejecutar la lógica
                    $('#clvEquipo').trigger('change');
                });


                $('#precioEquipoSelect').on('change', function() {
                    if ($(this).val() > 0) {
                        $('#porGastoMensual').removeClass('opacity-100 cursor-not-allowed').prop('disabled',
                            false);
                    } else {
                        $('#porGastoMensual').addClass('opacity-100 cursor-not-allowed').prop('disabled', true);
                        $('#porGastoMensual').val('');
                    }
                });

                $('#porGastoMensual').on('input', function() {
                    var precioEquipoSelect = $('#precioEquipoSelect').val();
                    var porGastoMensual = parseFloat($(this).val());
                    var costoMensual = (precioEquipoSelect * porGastoMensual / 100).toFixed(2);
                    (costoMensual > 0) ? $('#costoMensual').val(costoMensual): $('#costoMensual').val(
                        {{ $Data['monthlyExpense']['costoMensual'] }});
                }).trigger('input');
            });
        </script>
    @endpush
