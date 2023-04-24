@props(['text', 'action'])

<div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
    <button id="btn-create-modal-statusPaymentsRents" type="button"
        class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto show-modal">
        {{ $text }}
    </button>
</div>

<div id="create-modal-statusPaymentsRents" name="create-modal-statusPaymentsRents" class="hidden">
    <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!-- Background backdrop, show/hide based on modal state -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-50 transition-opacity" id="background"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <!-- Modal panel, show/hide based on modal state -->
                <div
                    class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6">
                    <div>
                        <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">Agregar Estado Pago de
                            Renta
                        </h3>
                        <p class="mt-2 text-sm text-gray-500">Por favor, completa los siguientes campos:</p>
                    </div>
                    <form action="{{ $action }}" class="mt-4 space-y-4" method="PUT">
                        @csrf
                        <div class="col-span-6 sm:col-span-6">
                            <label for="estadoPagoRenta" class="block text-sm font-medium text-gray-700">Estado Pago De
                                Renta</label>
                            <input type="text" name="estadoPagoRenta" id="estadoPagoRenta"
                                autocomplete="given-estadoPagoRenta"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('estadoPagoRenta') border-red-400 @enderror"
                                value="{{ old('estadoPagoRenta') }}" required autofocus>
                            @error('estadoPagoRenta')
                                <div class="flex
                                    items-center mt-1 text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="textColor" class="block text-sm font-medium text-gray-700">Color Del
                                Texto</label>
                            <input type="text" name="textColor" id="textColor" autocomplete="given-textColor"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('textColor') border-red-400 @enderror"
                                value="{{ old('textColor') }}" required>
                            @error('textColor')
                                <div class="flex
                                    items-center mt-1 text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="bgColorPrimary" class="block text-sm font-medium text-gray-700">Color De Fondo
                                Primario</label>
                            <input type="text" name="bgColorPrimary" id="bgColorPrimary"
                                autocomplete="given-bgColorPrimary"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('bgColorPrimary') border-red-400 @enderror"
                                value="{{ old('bgColorPrimary') }}" required>
                            @error('bgColorPrimary')
                                <div class="flex
                                    items-center mt-1 text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="bgColorSecondary" class="block text-sm font-medium text-gray-700">Color De Fondo
                                Secundario</label>
                            <input type="text" name="bgColorSecondary" id="bgColorSecondary"
                                autocomplete="given-bgColorSecondary"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('bgColorSecondary') border-red-400 @enderror"
                                value="{{ old('bgColorSecondary') }}" required>
                            @error('bgColorSecondary')
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
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('descripcion') border-red-400 @enderror"
                                required>{{ old('descripcion') }}</textarea>
                            @error('descripcion')
                                <div class="flex
                                    items-center mt-1 text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="mt-5 sm:mt-6 flex justify-end space-x-2">
                            <button type="submit"
                                class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 rounded-md">Guardar</button>
                            <button type="button" id="btn-create-modal-statusPaymentsRents-close"
                                class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-orange-500 hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 rounded-md">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    @if (request()->is('Dashboard/Panel/Rents'))
        <script>
            var showModalButtonCreateStatusPaymentsRents = document.getElementById('btn-create-modal-statusPaymentsRents');
            var createModalStatusPaymentsRents = document.getElementById('create-modal-statusPaymentsRents');
            var nombreEstadoPagoRentaInput = document.getElementById('estadoPagoRenta');
            // var modalContent = document.querySelector(
            //     '.flex.min-h-full.items-end.justify-center.p-4.text-center.sm\\:items-center.sm\\:p-0');
            document.addEventListener('DOMContentLoadedCreateStatusPaymentsRents', function() {

                showModalButtonCreateStatusPaymentsRents.addEventListener('click', function() {
                    createModalStatusPaymentsRents.classList.remove('hidden');
                    window.location.hash = "createModalStatusPaymentsRents";
                    nombreEstadoPagoRentaInput.focus();
                });

                document.getElementById('background').addEventListener('click', function() {
                    document.getElementById('create-modal-statusPaymentsRents').classList.add('hidden');
                    window.location.hash = "";
                });

                document.getElementById('btn-create-modal-statusPaymentsRents-close').addEventListener('click',
                    function() {
                        document.getElementById('create-modal-statusPaymentsRents').classList.add('hidden');
                        window.location.hash = "";
                    });

                if (window.location.hash === "#createModalStatusPaymentsRents") {
                    document.getElementById("create-modal-statusPaymentsRents").classList.remove("hidden");
                    nombreEstadoPagoRentaInput.focus();
                }
            });
            var DOMContentLoadedCreateStatusPaymentsRents = new Event('DOMContentLoadedCreateStatusPaymentsRents');
            document.dispatchEvent(DOMContentLoadedCreateStatusPaymentsRents);
        </script>
    @endif
@endpush
