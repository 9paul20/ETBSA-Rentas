@extends('layout')

@push('styles')
    <style>
        .text-red-400 {
            transition: opacity 0.3s ease-in-out;
            opacity: 1;
        }

        .text-red-400.hide {
            opacity: 0;
        }
    </style>
@endpush

@section('content')
    <div class="flex items-center min-h-screen bg-gray-50"
        style="background-image: linear-gradient(115deg, #9F7AEA, #FEE2FE)">
        <div class="container mx-auto flex-1 h-full mx-auto bg-white rounded-lg shadow-xl w-screen">
            <div class="flex flex-col lg:flex-row rounded-xl mx-auto shadow-lg ">
                <div class="w-full lg:w-1/2 flex flex-col items-center justify-center p-12 bg-no-repeat bg-cover bg-center"
                    style="background-image: url('images/Register-Background.png');">
                </div>
                <div class="w-full lg:w-1/2 py-16 px-12 text-center">
                    <div class="flex justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20 text-purple-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M12 14l9-5-9-5-9 5 9 5z" />
                            <path
                                d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                        </svg>
                    </div>
                    <h1 class="mb-4 text-2xl font-bold text-gray-700">
                        Register Name Your Account
                    </h1>
                    <p class="mb-4">
                        Create your account. It’s free and only take a minute
                    </p>
                    <form method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        {{-- <div class="mt-5">
                            <input type="text" placeholder="Nombre Completo"
                                class="w-full px-4 py-2 text-sm border rounded-md focus:border-purple-400 focus:outline-none focus:ring-1 focus:ring-purple-600">
                        </div>
                        <div class="grid grid-cols-2 gap-5 mt-5">
                            <input type="text" placeholder="Apellido Paterno"
                                class="w-full px-4 py-2 text-sm border rounded-md focus:border-purple-400 focus:outline-none focus:ring-1 focus:ring-purple-600">
                            <input type="text" placeholder="Apellido Materno"
                                class="w-full px-4 py-2 text-sm border rounded-md focus:border-purple-400 focus:outline-none focus:ring-1 focus:ring-purple-600">
                        </div> --}}
                        <div class="mt-5">
                            <input type="text" name="name" id="name" placeholder="Nombre de Usuario"
                                class="w-full px-4 py-2 text-sm border rounded-md focus:border-purple-400 focus:outline-none focus:ring-1 focus:ring-purple-600 @error('name') border-red-400 @enderror"
                                value="{{ old('name') }}" required autofocus>
                            @error('name')
                                <div class="text-red-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                                    </svg>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mt-5">
                            <input type="email" name="email" id="email" placeholder="Correo Electrónico"
                                class="w-full px-4 py-2 text-sm border rounded-md focus:border-purple-400 focus:outline-none focus:ring-1 focus:ring-purple-600 @error('email') border-red-400 @enderror"
                                value="{{ old('email') }}" required>
                            @error('email')
                                <div class="text-red-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                                    </svg>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mt-5">
                            <input type="password" name="password" id="password" placeholder="Contraseña"
                                class="w-full px-4 py-2 text-sm border rounded-md focus:border-purple-400 focus:outline-none focus:ring-1 focus:ring-purple-600 @error('password') border-red-400 @enderror"
                                required>
                            @error('password')
                                <div class="text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mt-5">
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                placeholder="Confirmar Contraseña"
                                class="w-full px-4 py-2 text-sm border rounded-md focus:border-purple-400 focus:outline-none focus:ring-1 focus:ring-purple-600 @error('password-confirm') border-red-400 @enderror"
                                required>
                            @error('password-confirm')
                                <div class="flex items-center mt-1 text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="mt-5">
                            <label class="inline-flex items-center">
                                <input name="terms" id="terms" type="checkbox"
                                    class="border border-purple-400 rounded-sm text-purple-400 focus:ring-purple-400 checked:bg-purple-400"
                                    required>
                                <span class="ml-2">
                                    Acepto los <a href="#" class="text-purple-500 font-semibold">Terminos de Uso</a> Y
                                    <a href="#" class="text-purple-500 font-semibold">Politicas de Privacidad</a>
                                </span>
                            </label>
                            @error('terms')
                                <div class="text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-5">
                            <button type="submit"
                                class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-500 border border-transparent rounded-lg active:bg-purple-500 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Registrarse</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

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
