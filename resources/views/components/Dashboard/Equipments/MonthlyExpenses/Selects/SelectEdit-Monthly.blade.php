<div class="col-span-6 sm:col-span-6">
    <label for="precioEquipo" class="block text-sm font-medium text-gray-700">Valor Fijo</label>
    <select id="precioEquipoSelectEdit{{ $id }}" name="precioEquipo"
        class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-green-500 focus:outline-none focus:ring-green-500 sm:text-sm @error('precioEquipo') border-red-400 @enderror"
        required>
        @if (count($Data['valoresFijos']) > 0)
            <option value="" disabled selected>
                Seleccione Un Valor Fijo</option>
            @foreach ($Data['valoresFijos'] as $valorFijo)
                <option value="{{ $valorFijo['costo'] }}" data-indice={{ $valorFijo['indiceValorFijo'] }}
                    @if ($valorFijo['indiceValorFijo'] == $indiceValorFijo) selected @endif>
                    {{ $valorFijo['gastoFijo'] }} @if (isset($valorFijo['costo']))
                        - $ {{ $valorFijo['costo'] }}
                    @endif
                </option>
            @endforeach
        @else
            <option value="" disabled selected>
                No Hay Opciones De Valor Fijo</option>
        @endif
    </select>
    @error('precioEquipo')
        <div class="flex items-center mt-1 text-red-400">
            <i class="fas fa-exclamation-triangle mr-2"></i>
            <span>{{ $message }}</span>
        </div>
    @enderror
    <input type="hidden" name="indiceValorFijo" id="indiceValorFijo{{ $id }}"
        value="{{ old('indiceValorFijo', $indiceValorFijo) }}">
</div>

@push('scripts')
    <script>
        $('#precioEquipoSelectEdit{{ $id }}').on('change', function() {
            var indiceValorFijo{{ $id }} = $('option:selected', this).data('indice');
            $('#indiceValorFijo{{ $id }}').val(indiceValorFijo{{ $id }});
        });
    </script>
@endpush
