<div class="col-span-6 sm:col-span-6">
    <label for="clvEstadoPagoRenta" class="block text-sm font-medium text-gray-700">Estado Pago De Renta</label>
    <select id="clvEstadoPagoRenta" name="clvEstadoPagoRenta"
        class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-green-500 focus:outline-none focus:ring-green-500 sm:text-sm @error('clvEstadoPagoRenta') border-red-400 @enderror"
        required>
        @if (count($Data['allStatusPaymentsRents']) > 0)
        <option value="" disabled selected>
            Seleccione Un Estado Pago De Renta</option>
        @foreach ($Data['allStatusPaymentsRents'] as $rowStatusPaymentRent)
        <option value="{{ $rowStatusPaymentRent->clvEstadoPagoRenta }}" @if($clvEstadoPagoRenta==$rowStatusPaymentRent->
            clvEstadoPagoRenta)
            selected
            @endif>
            {{ $rowStatusPaymentRent->estadoPagoRenta }}
        </option>
        @endforeach
        @else
        <option value="" disabled selected>
            No Hay Opciones Estado Pago De Renta Disponible</option>
        @endif
    </select>
    @error('clvEstadoPagoRenta')
    <div class="flex
                                    items-center mt-1 text-red-400">
        <i class="fas fa-exclamation-triangle mr-2"></i>
        <span>{{ $message }}</span>
    </div>
    @enderror
</div>