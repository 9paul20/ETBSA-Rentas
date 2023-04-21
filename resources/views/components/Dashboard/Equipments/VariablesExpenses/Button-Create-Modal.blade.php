@props(['text', 'action'])

<div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
    <button id="btn-create-modal-variablesExpenses" type="button"
        class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto show-modal"
        onclick="modalHandler(true)" data-target="scroll-target">
        {{ $text }}
    </button>
</div>

<div id="scroll-target"></div>

<div id="create-modal-variablesExpenses" name="create-modal-variablesExpenses" class="hidden">
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
                            <input type="text" name="gastoVariable" id="gastoVariable"
                                autocomplete="given-gastoVariable"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('gastoVariable') border-red-400 @enderror"
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
                            <label for="costoGastoVariable" class="block text-sm font-medium text-gray-700">Costo Del
                                Gasto
                                Variable</label>
                            <input type="number" name="costoGastoVariable" id="costoGastoVariable"
                                pattern="[0-9]+(\.[0-9]+)?" autocomplete="given-costoGastoVariable"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('costoGastoVariable') border-red-400 @enderror"
                                min=0 max="99999999.99" value="{{ old('costoGastoVariable') }}" required step="0.01">
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
                            <button type="button" id="btn-create-modal-variablesExpenses-close"
                                class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-orange-500 hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 rounded-md"
                                onclick="modalHandler()">Cancelar</button>
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
            var showModalButtonCreateVariablesExpenses = document.getElementById('btn-create-modal-variablesExpenses');
            var createModalVariablesExpenses = document.getElementById('create-modal-variablesExpenses');
            var nombreGastoVariableInput = document.getElementById('gastoVariable');

            if (window.location.hash === "#createModalVariablesExpenses") {
                fadeIn(createModalVariablesExpenses);
                nombreGastoVariableInput.focus();
            }

            function modalHandler(val) {
                if (val) {
                    fadeIn(createModalVariablesExpenses);
                    window.location.hash = "createModalVariablesExpenses";
                    nombreGastoVariableInput.focus();
                } else {
                    fadeOut(createModalVariablesExpenses);
                    window.location.hash = "";
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

            function modalHandler(val) {
                var scrollTarget = document.getElementById(showModalButtonCreateVariablesExpenses.getAttribute('data-target'));
                if (val) {
                    fadeIn(createModalVariablesExpenses);
                    window.location.hash = "createModalVariablesExpenses";
                    nombreGastoVariableInput.focus();
                } else {
                    fadeOut(createModalVariablesExpenses);
                    window.location.hash = "";
                    if (scrollTarget) {
                        scrollTarget.scrollIntoView();
                    }
                }
            }
        </script>
    @endif
@endpush
