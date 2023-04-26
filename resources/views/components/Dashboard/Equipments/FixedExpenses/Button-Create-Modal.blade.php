@props(['text', 'action', 'id', 'SelectTypeFixedExpense', 'today'])

<div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
    <button id="btn-create-modal-{{ $id }}" type="button"
        class="inline-flex items-center justify-center rounded-md border border-transparent bg-green-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 sm:w-auto show-modal"
        onclick="modalHandler{{ $id }}(true)" data-target="scroll-target{{ $id }}">
        {{ $text }}
    </button>
</div>

<div id="scroll-target{{ $id }}"></div>

<div id="create-modal-{{ $id }}" name="create-modal-{{ $id }}" class="hidden">
    <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!-- Background backdrop, show/hide based on modal state -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-50 transition-opacity" id="background"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <!-- Modal panel, show/hide based on modal state -->
                <div
                    class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full max-w-2xl p-8 text-xl leading-7">
                    <div>
                        <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">Agregar Gasto Fijo
                        </h3>
                        <p class="mt-2 text-sm text-gray-500">Por favor, completa los siguientes campos:</p>
                    </div>
                    <form action="{{ $action }}" class="mt-4 space-y-4" method="POST">
                        @csrf
                        <div class="col-span-6 sm:col-span-6">
                            <label for="gastoFijo" class="block text-sm font-medium text-gray-700">Gasto
                                Fijo</label>
                            <input type="text" name="gastoFijo" id="input_{{ $id }}" autocomplete="given-gastoFijo"
                                min="4" max="255"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('gastoFijo') border-red-400 @enderror"
                                pattern=".{4,255}" title="El campo debe contener entre 4 y 255 caracteres"
                                value="{{ old('gastoFijo') }}" required autofocus>
                            @error('gastoFijo')
                            <div class="flex
                                    items-center mt-1 text-red-400">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                        {!! html_entity_decode($SelectTypeFixedExpense) !!}
                        <div class="col-span-6 sm:col-span-6">
                            <label for="fechaGastoFijo" class="block text-sm font-medium text-gray-700">Fecha Del
                                Gasto
                                Fijo</label>
                            <input type="date" name="fechaGastoFijo" id="fechaGastoFijo"
                                autocomplete="given-fechaGastoFijo"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('fechaGastoFijo') border-red-400 @enderror"
                                value="{{ old('fechaGastoFijo') }}" required max='{{ $today }}'>
                            @error('fechaGastoFijo')
                            <div class="flex items-center mt-1 text-red-400">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="costoGastoFijo" class="block text-sm font-medium text-gray-700">Costo Del
                                Gasto
                                Fijo</label>
                            <input type="number" name="costoGastoFijo" id="costoGastoFijo" pattern="[0-9]+(\.[0-9]+)?"
                                min="0" step="0.01" autocomplete="given-costoGastoFijo"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('costoGastoFijo') border-red-400 @enderror"
                                min="0" max="99999999.99" value="{{ old('costoGastoFijo') }}" required step="0.01">
                            @error('costoGastoFijo')
                            <div class="flex
                                    items-center mt-1 text-red-400">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="folioFactura" class="block text-sm font-medium text-gray-700">Folio Del Gasto
                                Fijo</label>
                            <textarea rows="3" name="folioFactura" id="create-folioFactura"
                                autocomplete="given-folioFactura"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('folioFactura') border-red-400 @enderror"
                                minlength="4" maxlength="255" required>{{ old('folioFactura') }}</textarea>
                            @error('folioFactura')
                            <div class="flex
                                    items-center mt-1 text-red-400">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                        <div class="mt-5 sm:mt-6 flex justify-end space-x-2">
                            <button type="submit"
                                class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 rounded-md">Guardar</button>
                            <button type="button" id="btn-create-modal-{{ $id }}-close"
                                class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-orange-500 hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 rounded-md"
                                onclick="modalHandler{{ $id }}()">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
@if (request()->is('Dashboard/Admin/Equipments/*'))
<script>
    var showModalButtonCreate{{ $id }} = document.getElementById('btn-create-modal-{{ $id }}');
            var createModal{{ $id }} = document.getElementById('create-modal-{{ $id }}');
            var input{{ $id }} = document.getElementById('input_{{ $id }}');

            if (window.location.hash === "#createModal{{ $id }}") {
                fadeIn(createModal{{ $id }});
                input{{ $id }}.focus();
            }

            function modalHandler{{ $id }}(val) {
                var scrollTarget = document.getElementById(showModalButtonCreate{{ $id }}.getAttribute(
                    'data-target'));
                document.getElementById("input_{{ $id }}").value = "";
                document.getElementById("costoGastoFijo").value = "";
                document.getElementById("create-folioFactura").value = "";
                if (val) {
                    fadeIn(createModal{{ $id }});
                    window.location.hash = "createModal{{ $id }}";
                    input{{ $id }}.focus();
                } else {
                    fadeOut(createModal{{ $id }});
                    window.location.hash = "";
                    if (scrollTarget) {
                        scrollTarget.scrollIntoView();
                    }
                }
            }

            function fadeOut(el) {
                el.style.opacity = 1;
                (function fade() {
                    if ((el.style.opacity -= 0.1) < 0) {
                        el.style.display = "none";
                    } else {
                        requestAnimationFrame(fade);
                    }
                })();
            }

            function fadeIn(el, display) {
                el.style.opacity = 0;
                el.style.display = display || "flex";
                (function fade() {
                    let val = parseFloat(el.style.opacity);
                    if (!((val += 0.2) > 1)) {
                        el.style.opacity = val;
                        requestAnimationFrame(fade);
                    }
                })();
            }
</script>
@endif
@endpush