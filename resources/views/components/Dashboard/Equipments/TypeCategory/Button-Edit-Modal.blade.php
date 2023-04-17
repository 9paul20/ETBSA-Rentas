@props(['id', 'tipoCategoria', 'descripcion', 'href'])

<a href="" x-data="{ tooltip: 'Edit' }" @click="openModal{{ $id }}()" id="link-edit-{{ $id }}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
        class="h-6 w-6 text-blue-500" x-tooltip="tooltip">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125">
        </path>
    </svg>
</a>

<div id="edit-modal-{{ $id }}" name="edit-modal-{{ $id }}" class="hidden">
    <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!-- Background backdrop, show/hide based on modal state -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-50 transition-opacity" id="background"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <!-- Modal panel, show/hide based on modal state -->
                <div
                    class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6">
                    <div>
                        <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">Editar TipoCategoria
                        </h3>
                        <p class="mt-2 text-sm text-gray-500">Por favor, completa los siguientes campos:</p>
                    </div>
                    <form action="{{ $href }}" class="mt-4 space-y-4" method="POST"
                        id="edit-form-{{ $id }}">
                        @method('PUT')
                        @csrf
                        <div class="col-span-6 sm:col-span-6">
                            <label for="tipoCategoria" class="block text-sm font-medium text-gray-700">Tipo De
                                Categoria</label>
                            <input type="text" name="tipoCategoria" id="tipoCategoria-{{ $id }}"
                                autocomplete="given-tipoCategoria"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('tipoCategoria') border-red-400 @enderror"
                                value="{{ $tipoCategoria }}" required autofocus>
                            @error('tipoCategoria')
                                <div class="flex
                                    items-center mt-1 text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                            <textarea rows="3" name="descripcion" id="descripcion-{{ $id }}" autocomplete="given-descripcion"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('descripcion') border-red-400 @enderror"
                                required>{{ $descripcion }}</textarea>
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
                            <button type="button" id="btn-edit-modal-close-{{ $id }}"
                                class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-orange-500 hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 rounded-md">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    @if (request()->is('Dashboard/Panel/Equipments'))
        <script>
            var editModal{{ $id }} = document.getElementById('edit-modal-{{ $id }}');
            var nombreTipoCategoriaInput{{ $id }} = document.getElementById(
                'tipoCategoria-{{ $id }}');

            document.getElementById('link-edit-{{ $id }}').addEventListener('click', function(event) {
                // Prevenir el comportamiento predeterminado del enlace
                event.preventDefault();
            });

            function openModal{{ $id }}() {
                editModal{{ $id }}.classList.remove('hidden');
                window.location.hash = "editModal{{ $id }}";
                nombreTipoCategoriaInput{{ $id }}.focus();
            }

            document.getElementById('background').addEventListener('click', function() {
                editModal{{ $id }}.classList.add('hidden');
                window.location.hash = "";
            });

            document.getElementById('btn-edit-modal-close-{{ $id }}').addEventListener('click', function() {
                editModal{{ $id }}.classList.add('hidden');
                window.location.hash = "";
            });

            if (window.location.hash === "#editModal{{ $id }}") {
                editModal{{ $id }}.classList.remove("hidden");
                nombreTipoCategoriaInput{{ $id }}.focus();
            }
        </script>
    @endif
@endpush
