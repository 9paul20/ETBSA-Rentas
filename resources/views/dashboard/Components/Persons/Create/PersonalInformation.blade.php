@push('styles')
    {{-- <link rel="stylesheet" href="{{ url('/css/components.css') }}"> --}}
@endpush

<div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Personal Information</h3>
                <p class="mt-1 text-sm text-gray-600">Use a permanent address where you can receive mail.</p>
            </div>
        </div>
        <div class="mt-5 md:col-span-2 md:mt-0">
            @if (getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Persons' &&
                    getDashboardNameFromUrlSecond(request()->fullUrl()) == 'create')
                <form action="{{ route('Dashboard.Admin.Persons.Store') }}" method="POST">
                @elseif(getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Persons' &&
                        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'edit')
                    <form action="{{ route('Dashboard.Admin.Persons.Update', $person->clvPersona) }}" method="POST">
                        @method('PUT')
            @endif
            @csrf
            <div class="overflow-hidden shadow sm:rounded-md">
                <div class="bg-white px-4 py-5 sm:p-6">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-6">
                            <label for="nombrePersona" class="block text-sm font-medium text-gray-700">Nombre</label>
                            <input type="text" name="nombrePersona" id="nombrePersona"
                                autocomplete="given-nombrePersona"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('nombrePersona') border-red-400 @enderror"
                                value="{{ old('nombrePersona', $person->nombrePersona) }}" required autofocus>
                            @error('nombrePersona')
                                <div class="flex
                                    items-center mt-1 text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="apePaternoPersona" class="block text-sm font-medium text-gray-700">Apellido
                                Paterno</label>
                            <input type="text" name="apePaternoPersona" id="apePaternoPersona"
                                autocomplete="given-apePaternoPersona"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('apePaternoPersona') border-red-400 @enderror"
                                value="{{ old('apePaternoPersona', $person->apePaternoPersona) }}" required>
                            @error('apePaternoPersona')
                                <div class="flex
                                    items-center mt-1 text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="apeMaternoPersona" class="block text-sm font-medium text-gray-700">Apellido
                                Materno</label>
                            <input type="text" name="apeMaternoPersona" id="apeMaternoPersona"
                                autocomplete="given-apeMaternoPersona"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('apeMaternoPersona') border-red-400 @enderror"
                                value="{{ old('apeMaternoPersona', $person->apeMaternoPersona) }}" required>
                            @error('apeMaternoPersona')
                                <div class="flex
                                    items-center mt-1 text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="nacimiento" class="block text-sm font-medium text-gray-700">Nacimiento</label>
                            <input type="date" name="nacimiento" id="nacimiento" autocomplete="given-nacimiento"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('nacimiento') border-red-400 @enderror"
                                value="{{ old('nacimiento', $person->nacimiento) }}" required>
                            @error('nacimiento')
                                <div class="flex
                                    items-center mt-1 text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="clvNacionalidad"
                                class="block text-sm font-medium text-gray-700">Nacionalidad</label>
                            <select id="clvNacionalidad" name="clvNacionalidad"
                                class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm @error('clvNacionalidad') border-red-400 @enderror"
                                required>
                                @if (count($nacionalidades) > 0)
                                    <option value="" disabled selected>
                                        Seleccione Una Nacionalidad</option>
                                    @foreach ($nacionalidades as $nacionalidad)
                                        <option value="{{ $nacionalidad->clvNacionalidad }}"
                                            @if ($nacionalidad->clvNacionalidad == $person->clvNacionalidad) selected @endif>
                                            {{ $nacionalidad->nacionalidad }}
                                        </option>
                                    @endforeach
                                @else
                                    <option value="" disabled selected>
                                        No Hay Opciones De Nacionalidad Disponibles</option>
                                @endif
                            </select>
                            @error('clvNacionalidad')
                                <div class="flex
                                    items-center mt-1 text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="telefono" class="block text-sm font-medium text-gray-700">Telefono</label>
                            <input type="tel" pattern="[0-9]{10}" name="telefono" id="telefono"
                                autocomplete="given-telefono"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('telefono') border-red-400 @enderror"
                                value="{{ old('telefono', $person->telefono) }}" required>
                            @error('telefono')
                                <div class="flex items-center mt-1 text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="celular" class="block text-sm font-medium text-gray-700">Celular</label>
                            <input type="tel" pattern="[0-9]{10}" name="celular" id="celular"
                                autocomplete="given-celular"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('celular') border-red-400 @enderror"
                                value="{{ old('celular', $person->celular) }}" required>
                            @error('celular')
                                <div class="flex items-center mt-1 text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="clvComTel" class="block text-sm font-medium text-gray-700">Compañia
                                Telefónica</label>
                            <select id="clvComTel" name="clvComTel"
                                class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm @error('clvComTel') border-red-400 @enderror"
                                required>
                                @if (count($comtels) > 0)
                                    <option value="" disabled selected>
                                        Seleccione Una Compañia Telefónica</option>
                                    @foreach ($comtels as $comtel)
                                        <option value="{{ $comtel->clvComTel }}"
                                            @if ($comtel->clvComTel == $person->clvComTel) selected @endif>
                                            {{ $comtel->companiaTelefonica }}
                                        </option>
                                    @endforeach
                                @else
                                    <option value="" disabled selected>
                                        No Hay Opciones De Compañias Telefónicas Disponible</option>
                                @endif
                            </select>
                            @error('clvComTel')
                                <div class="flex
                                    items-center mt-1 text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="ocupacion" class="block text-sm font-medium text-gray-700">Ocupación</label>
                            <input type="text" name="ocupacion" id="ocupacion" autocomplete="given-ocupacion"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('ocupacion') border-red-400 @enderror"
                                value="{{ old('ocupacion', $person->ocupacion) }}" required>
                            @error('ocupacion')
                                <div class="flex
                                    items-center mt-1 text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="informacion"
                                class="block text-sm font-medium text-gray-700">Información</label>
                            <input type="text" name="informacion" id="informacion"
                                autocomplete="given-informacion"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('informacion') border-red-400 @enderror"
                                value="{{ old('informacion', $person->informacion) }}" required>
                            @error('informacion')
                                <div class="flex
                                    items-center mt-1 text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <x-Dashboard.Save-Button name="Guardar Persona" />
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Eliminar mensaje de error cuando se hace clic en el campo de entrada correspondiente
            document.querySelectorAll('input').forEach(input => {
                input.addEventListener('click', () => {
                    const errorDiv = input.nextElementSibling;
                    if (errorDiv && errorDiv.classList.contains('text-red-400')) {
                        errorDiv.style.opacity = '0';
                        errorDiv.style.transition =
                            'opacity 0.5s ease-in-out'; // cambiar la duración de la animación según tus necesidades
                        setTimeout(() => {
                                errorDiv.style.display = 'none';
                            },
                            500
                        ); // ajustar el tiempo de espera para que coincida con la duración de la animación
                    }
                });
            });

            window.Components = {
                customSelect(options) {
                    return {
                        init() {
                            this.$refs.listbox.focus()
                            this.optionCount = this.$refs.listbox.children.length
                            this.$watch('selected', value => {
                                if (!this.open) return

                                if (this.selected === null) {
                                    this.activeDescendant = ''
                                    return
                                }

                                this.activeDescendant = this.$refs.listbox.children[this.selected - 1].id
                            })
                        },
                        activeDescendant: null,
                        optionCount: null,
                        open: false,
                        selected: null,
                        value: 1,
                        choose(option) {
                            this.value = option
                            this.open = false
                        },
                        onButtonClick() {
                            if (this.open) return
                            this.selected = this.value
                            this.open = true
                            this.$nextTick(() => {
                                this.$refs.listbox.focus()
                                this.$refs.listbox.children[this.selected - 1].scrollIntoView({
                                    block: 'nearest'
                                })
                            })
                        },
                        onOptionSelect() {
                            if (this.selected !== null) {
                                this.value = this.selected
                            }
                            this.open = false
                            this.$refs.button.focus()
                        },
                        onEscape() {
                            this.open = false
                            this.$refs.button.focus()
                        },
                        onArrowUp() {
                            this.selected = this.selected - 1 < 1 ? this.optionCount : this.selected - 1
                            this.$refs.listbox.children[this.selected - 1].scrollIntoView({
                                block: 'nearest'
                            })
                        },
                        onArrowDown() {
                            this.selected = this.selected + 1 > this.optionCount ? 1 : this.selected + 1
                            this.$refs.listbox.children[this.selected - 1].scrollIntoView({
                                block: 'nearest'
                            })
                        },
                        ...options,
                    }
                },
            }
        </script>
    @endpush
