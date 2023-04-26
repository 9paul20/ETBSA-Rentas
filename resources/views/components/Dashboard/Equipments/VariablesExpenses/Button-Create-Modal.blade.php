@props(['text', 'action', 'id', 'today'])

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
                        <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">Agregar Gasto Variable
                        </h3>
                        <p class="mt-2 text-sm text-gray-500">Por favor, completa los siguientes campos:</p>
                    </div>
                    <form action="{{ $action }}" class="mt-4 space-y-4" method="POST">
                        @csrf
                        <div class="col-span-6 sm:col-span-6">
                            <label for="gastoVariable" class="block text-sm font-medium text-gray-700">Gasto
                                Variable</label>
                            <input type="text" name="gastoVariable" id="input_{{ $id }}"
                                autocomplete="given-gastoVariable" min="4" max="255"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('gastoVariable') border-red-400 @enderror"
                                pattern=".{4,255}" title="El campo debe contener entre 4 y 255 caracteres"
                                value="{{ old('gastoVariable') }}" required autofocus>
                            @error('gastoVariable')
                            <div class="flex
                                    items-center mt-1 text-red-400">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="fechaGastoVariable" class="block text-sm font-medium text-gray-700">Fecha Del
                                Gasto
                                Variable</label>
                            <input type="date" name="fechaGastoVariable" id="fechaGastoVariable"
                                autocomplete="given-fechaGastoVariable"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('fechaGastoVariable') border-red-400 @enderror"
                                value="{{ old('fechaGastoVariable') }}" required max='{{ $today }}'>
                            @error('fechaGastoVariable')
                            <div class="flex items-center mt-1 text-red-400">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="costoGastoVariable" class="block text-sm font-medium text-gray-700">Costo Del
                                Gasto
                                Variable</label>
                            <input type="number" name="costoGastoVariable" id="costoGastoVariable"
                                pattern="[0-9]+(\.[0-9]+)?" step="0.01" autocomplete="given-costoGastoVariable"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('costoGastoVariable') border-red-400 @enderror"
                                min="0" max="99999999.99" value="{{ old('costoGastoVariable') }}" required step="0.01">
                            @error('costoGastoVariable')
                            <div class="flex
                                    items-center mt-1 text-red-400">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                            <textarea rows="3" name="descripcion" id="create-descripcion"
                                autocomplete="given-descripcion"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('descripcion') border-red-400 @enderror"
                                minlength="4" maxlength="255" required>{{ old('descripcion') }}</textarea>
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
                document.getElementById("costoGastoVariable").value = "";
                document.getElementById("create-descripcion").value = "";
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