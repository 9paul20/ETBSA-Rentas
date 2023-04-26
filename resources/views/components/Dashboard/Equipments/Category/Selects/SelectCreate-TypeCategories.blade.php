<div class="col-span-6 sm:col-span-6">
    <label for="clvTipoCategoria" class="block text-sm font-medium text-gray-700">Tipo De
        Categoria</label>
    <select id="clvTipoCategoria" name="clvTipoCategoria"
        class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-green-500 focus:outline-none focus:ring-green-500 sm:text-sm @error('clvTipoCategoria') border-red-400 @enderror"
        required>
        @if (count($Data['allTypeCategories']) > 0)
        <option value="" disabled selected>
            Seleccione Un Tipo De Categoria</option>
        @foreach ($Data['allTypeCategories'] as $rowTypeCategory)
        <option value="{{ $rowTypeCategory->clvTipoCategoria }}">
            {{ $rowTypeCategory->tipoCategoria }}
        </option>
        @endforeach
        @else
        <option value="" disabled selected>
            No Hay Opciones De Tipo De Categoria Disponible</option>
        @endif
    </select>
    @error('clvTipoCategoria')
    <div class="flex
                                    items-center mt-1 text-red-400">
        <i class="fas fa-exclamation-triangle mr-2"></i>
        <span>{{ $message }}</span>
    </div>
    @enderror
</div>