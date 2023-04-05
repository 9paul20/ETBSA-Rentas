@if (session('success'))
    <div aria-live="assertive" class="pointer-events-none fixed inset-0 flex items-end px-4 py-6 sm:items-start sm:p-6">
        <div class="flex w-full flex-col items-center space-y-4 sm:items-end ">
            <div
                class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg bg-green-100 shadow-lg ring-1 ring-black ring-opacity-5 opacity-0 transition-opacity duration-300 ">
                <div class="p-4">
                    <div class="flex items-start ">
                        <div class="flex-shrink-0">
                            <!-- Heroicon name: outline/check-circle -->
                            <svg class="h-6 w-6 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-3 w-0 flex-1 pt-0.5">
                            <p class="text-sm font-medium text-gray-900">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Obtiene el elemento de notificación
            const notificationElement = document.querySelector('.pointer-events-auto');

            // Agrega la clase 'opacity-100' después de un momento
            setTimeout(() => {
                notificationElement.classList.add('opacity-100');
            }, 250);

            // Elimina el elemento después de 5 segundos
            setTimeout(() => {
                notificationElement.remove();
            }, 5000);
        </script>
    @endpush
@endif

@if (session('update'))
    <div aria-live="assertive" class="pointer-events-none fixed inset-0 flex items-end px-4 py-6 sm:items-start sm:p-6">
        <div class="flex w-full flex-col items-center space-y-4 sm:items-end">
            <div
                class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg bg-indigo-100 shadow-lg ring-1 ring-black ring-opacity-5 opacity-0 transition-opacity duration-300">
                <div class="p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <!-- Heroicon name: outline/check-circle -->
                            <svg class="h-6 w-6 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-3 w-0 flex-1 pt-0.5">
                            <p class="text-sm font-medium text-gray-900">{{ session('update') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Obtiene el elemento de notificación
            const notificationElement = document.querySelector('.pointer-events-auto');

            // Agrega la clase 'opacity-100' después de un momento
            setTimeout(() => {
                notificationElement.classList.add('opacity-100');
            }, 250);

            // Elimina el elemento después de 5 segundos
            setTimeout(() => {
                notificationElement.remove();
            }, 5000);
        </script>
    @endpush
@endif

@if (session('danger'))
    <div aria-live="assertive" class="pointer-events-none fixed inset-0 flex items-end px-4 py-6 sm:items-start sm:p-6">
        <div class="flex w-full flex-col items-center space-y-4 sm:items-end">
            <div
                class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg bg-yellow-100 shadow-lg ring-1 ring-black ring-opacity-5 opacity-0 transition-opacity duration-300">
                <div class="p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <!-- Heroicon name: outline/check-circle -->
                            <svg class="h-6 w-6 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-3 w-0 flex-1 pt-0.5">
                            <p class="text-sm font-medium text-gray-900">{{ session('danger') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Obtiene el elemento de notificación
            const notificationElement = document.querySelector('.pointer-events-auto');

            // Agrega la clase 'opacity-100' después de un momento
            setTimeout(() => {
                notificationElement.classList.add('opacity-100');
            }, 250);

            // Elimina el elemento después de 5 segundos
            setTimeout(() => {
                notificationElement.remove();
            }, 5000);
        </script>
    @endpush
@endif
