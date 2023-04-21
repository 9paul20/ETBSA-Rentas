@if (isset($fixedExpensesCatalogs))
    @foreach ($fixedExpensesCatalogs as $fixedExpenseCatalog)
        <div class="relative flex items-start">
            <div class="flex h-5 items-center">
                <input id="fixedExpensesCatalogs{{ $fixedExpenseCatalog->gastoFijo }}"
                    aria-describedby="{{ $fixedExpenseCatalog->gastoFijo }}-description" name="fixedExpensesCatalogs[]"
                    value="{{ $fixedExpenseCatalog->clvGastoFijo }}" type="checkbox"
                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                    {{ $equipment->fixedExpensesCatalogs->contains($fixedExpenseCatalog->clvGastoFijo) ? 'checked' : '' }}>
            </div>
            <div class="ml-3 text-sm">
                <label for="fixedExpensesCatalogs{{ $fixedExpenseCatalog->gastoFijo }}"
                    class="font-medium text-gray-700">{{ $fixedExpenseCatalog->gastoFijo }}</label>
                <p id="{{ $fixedExpenseCatalog->gastoFijo }}-description" class="text-gray-500">
                    {{ $fixedExpenseCatalog->descripcion }}</p>
                <div class="mt-1">
                    <input type="number" name="costoGastoFijo[]"
                        id="costoGastoFijo{{ $fixedExpenseCatalog->gastoFijo }}"
                        class=" rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm disabled:bg-gray-200"
                        {{-- pattern="[0-9]+(\.[0-9]+)?" step="0.01" min=0 max="99999999.99" --}} {{-- value="{{ old('costoGastoFijo.' . $loop->index, $equipment->costoGastoFijo[$loop->index] ?? '') }}" --}} {{-- value="{{ old('costoGastoFijo.' . $loop->index) }}" --}}
                        {{ $equipment->fixedExpensesCatalogs->contains($fixedExpenseCatalog->clvGastoFijo) ? '' : 'disabled' }}
                        {{ $equipment->fixedExpensesCatalogs->contains($fixedExpenseCatalog->clvGastoFijo) ? 'required' : '' }}
                        value="{{ old('costoGastoFijo.' . $loop->index) }}">
                    @if ($errors->has('costoGastoFijo.' . $loop->index))
                        <div class="flex
                                    items-center mt-1 text-red-400">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            <span>{{ $errors->first('costoGastoFijo.' . $loop->index) }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
@else
    <label class="font-medium text-gray-700">Aún no existen Gastos Fijos</label>
@endif

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const checkboxes = document.querySelectorAll("input[type=checkbox][name='fixedExpensesCatalogs[]']");
            const inputs = document.querySelectorAll("input[type=number][name='costoGastoVariable[]']");

            for (let i = 0; i < checkboxes.length; i++) {
                checkboxes[i].addEventListener('change', function() {
                    inputs[i].disabled = !this.checked;
                    inputs[i].required = this.checked;
                });
            }
        });
    </script>
@endpush
