@props(['id', 'gastoVariable', 'fechaGastoVariable', 'costoGastoVariable', 'descripcion', 'href', 'today'])

<a href="" x-data="{ tooltip: 'Edit' }" @click="modalHandler{{ $id }}(true)" id="link-edit-{{ $id }}"
    data-target="scroll-target-{{ $id }}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
        class="h-6 w-6 text-blue-500" x-tooltip="tooltip">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125">
        </path>
    </svg>
</a>

<div id="scroll-target-{{ $id }}"></div>

<div id="edit-modal-{{ $id }}" name="edit-modal-{{ $id }}" class="hidden">
    <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!-- Background backdrop, show/hide based on modal state -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-50 transition-opacity" id="background"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <!-- Modal panel, show/hide based on modal state -->
                <div
                    class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full max-w-2xl p-8 text-xl leading-7">
                    <div>
                        <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">Editar Gasto Variable
                        </h3>
                        <p class="mt-2 text-sm text-gray-500">Por favor, completa los siguientes campos:</p>
                    </div>
                    <form action="{{ $href }}" class="mt-4 space-y-4" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="col-span-6 sm:col-span-6">
                            <label for="gastoVariable" class="block text-sm font-medium text-gray-700">Gasto
                                Variable</label>
                            <input type="text" name="gastoVariable" id="input_{{ $id }}"
                                autocomplete="given-gastoVariable"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('gastoVariable') border-red-400 @enderror"
                                pattern=".{4,255}" title="El campo debe contener entre 4 y 255 caracteres"
                                value="{{ old('gastoVariable', $gastoVariable) }}" required autofocus>
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
                                value="{{ old('fechaGastoVariable', $fechaGastoVariable) }}" required
                                max='{{ $today }}'>
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
                                pattern="[0-9]+(\.[0-9]+)?" min="0" max="99999999.99" step="0.01"
                                autocomplete="given-costoGastoVariable"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('costoGastoVariable') border-red-400 @enderror"
                                value="{{ old('costoGastoVariable', $costoGastoVariable) }}" required>
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
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('descripcion') border-red-400 @enderror"
                                minlength="4" maxlength="255" required>{{ old('descripcion', $descripcion) }}</textarea>
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
                            <button type="button" id="btn-edit-modal-{{ $id }}-close"
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
    var showModalButtonEdit{{ $id }} = document.getElementById('link-edit-{{ $id }}');
            var editModal{{ $id }} = document.getElementById('edit-modal-{{ $id }}');
            var input{{ $id }} = document.getElementById('input_{{ $id }}');

            document.getElementById('link-edit-{{ $id }}').addEventListener('click', function(event) {
                // Prevenir el comportamiento predeterminado del enlace
                event.preventDefault();
            });

            if (window.location.hash === "#editModal{{ $id }}") {
                fadeIn(editModal{{ $id }});
                input{{ $id }}.focus();
            }

            function modalHandler{{ $id }}(val) {
                var scrollTarget = document.getElementById(showModalButtonEdit{{ $id }}.getAttribute('data-target'));
                if (val) {
                    fadeIn(editModal{{ $id }});
                    window.location.hash = "editModal{{ $id }}";
                    input{{ $id }}.focus();
                } else {
                    fadeOut(editModal{{ $id }});
                    window.location.hash = "";
                    if (scrollTarget) {
                        scrollTarget.scrollIntoView();
                    }
                }
            }

            // Debe existir los metodos de FadeIn y FadeOut ya sea en el botón de agregar o de editar para que salgan los modales
</script>
@endif
@endpush