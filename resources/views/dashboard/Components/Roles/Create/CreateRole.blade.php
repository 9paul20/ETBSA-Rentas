<div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Groups Information</h3>
                <p class="mt-1 text-sm text-gray-600">Use a text for formulate the permission.</p>
            </div>
        </div>
        <div class="mt-5 md:col-span-2 md:mt-0">
            @if (getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Roles' &&
            getDashboardNameFromUrlSecond(request()->fullUrl()) == 'create')
            <form action="{{ route('Dashboard.Admin.Roles.Store') }}" method="POST">
                @elseif(getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Roles' &&
                getDashboardNameFromUrlSecond(request()->fullUrl()) == 'edit')
                <form action="{{ route('Dashboard.Admin.Roles.Update', $role->id) }}" method="POST">
                    @method('PUT')
                    @endif
                    @csrf
                    <div class="overflow-hidden shadow sm:rounded-md">
                        <div class="bg-white px-4 py-5 sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-6">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                    <input type="text" name="name" id="name" autocomplete="given-name"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('name') border-red-400 @enderror"
                                        value="{{ old('name', $role->name) }}" required autofocus>
                                    @error('name')
                                    <div class="flex
                                    items-center mt-1 text-red-400">
                                        <i class="fas fa-exclamation-triangle mr-2"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-span-6 sm:col-span-6">
                                    <label for="display_name" class="block text-sm font-medium text-gray-700">Display
                                        Name</label>
                                    <input type="text" name="display_name" id="display_name" autocomplete="display_name"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('display_name') border-red-400 @enderror"
                                        value="{{ old('display_name', $role->display_name) }}" required>
                                    @error('display_name')
                                    <div class="flex
                            items-center mt-1 text-red-400">
                                        <i class="fas fa-exclamation-triangle mr-2"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-span-6 sm:col-span-6">
                                    <label for="description"
                                        class="block text-sm font-medium text-gray-700">Description</label>
                                    <div class="mt-1">
                                        <textarea rows="3" name="description" id="description"
                                            autocomplete="description"
                                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('description') border-red-400 @enderror"
                                            required>{{ old('description', $role->description) }}</textarea>
                                    </div>
                                    @error('description')
                                    <div class="flex
                            items-center mt-1 text-red-400">
                                        <i class="fas fa-exclamation-triangle mr-2"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-span-6 sm:col-span-6">
                                    <label for="guard_name" class="block text-sm font-medium text-gray-700">Guard
                                        Name</label>
                                    <input type="text" name="guard_name" id="guard_name" autocomplete="guard_name"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('guard_name') border-red-400 @enderror"
                                        value="{{ old('guard_name', $role->guard_name) }}" required>
                                    @error('guard_name')
                                    <div class="flex
                            items-center mt-1 text-red-400">
                                        <i class="fas fa-exclamation-triangle mr-2"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <x-Dashboard.Save-Button name="Guardar Rol" />
                    </div>
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
</script>
@endpush