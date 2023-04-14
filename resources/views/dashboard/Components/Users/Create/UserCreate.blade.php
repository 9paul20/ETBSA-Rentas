<div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Personal Information</h3>
                <p class="mt-1 text-sm text-gray-600">Use a permanent address where you can receive mail.</p>
            </div>
        </div>
        <div class="mt-5 md:col-span-2 md:mt-0">
            <form action="{{ route('Dashboard.Admin.Users.Store') }}" method="POST">
                @csrf
                <div class="overflow-hidden shadow sm:rounded-md">
                    <div class="bg-white px-4 py-5 sm:p-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-6">
                                <label for="name" class="block text-sm font-medium text-gray-700">Username</label>
                                <input type="text" name="name" id="name" autocomplete="given-name"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('name') border-red-400 @enderror"
                                    value="{{ old('name') }}" required autofocus>
                                @error('name')
                                    <div class="flex
                                    items-center mt-1 text-red-400">
                                        <i class="fas fa-exclamation-triangle mr-2"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="col-span-6 sm:col-span-6">
                                <label for="email" class="block text-sm font-medium text-gray-700">Email
                                    address</label>
                                <input type="email" name="email" id="email" autocomplete="email"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('email') border-red-400 @enderror"
                                    value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="flex
                            items-center mt-1 text-red-400">
                                        <i class="fas fa-exclamation-triangle mr-2"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                <input type="password" name="password" id="password"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('password') border-red-400 @enderror"
                                    required>
                                @error('password')
                                    <div class="flex items-center mt-1 text-red-400">
                                        <i class="fas fa-exclamation-triangle mr-2"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="password_confirmation"
                                    class="block text-sm font-medium text-gray-700">Confirm
                                    Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('password-confirm') border-red-400 @enderror"
                                    required>
                                @error('password-confirm')
                                    <div class="flex items-center mt-1 text-red-400">
                                        <i class="fas fa-exclamation-triangle mr-2"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <x-Dashboard.Save-Button name="Guardar Usuario" />
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
