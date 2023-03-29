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
        <div class="container mx-auto flex-1 h-full mx-auto rounded-lg shadow-xl">
            <div class="flex flex-col md:flex-row bg-white rounded-xl mx-auto shadow-lg">
                <div class="w-full lg:w-1/2 flex flex-col items-center justify-center p-12 bg-no-repeat bg-cover bg-center"
                    style="background-image: url('https://source.unsplash.com/user/erondu/1600x900');">
                </div>
                <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                    <form class="w-full text-center" method="POST" action="{{ route('login') }}">
                        @csrf
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
                        <h1 class="mb-4 text-2xl font-bold  text-gray-700">
                            Login to Your Account
                        </h1>
                        <div class="mt-5">
                            <input id="email" name="email" type="email"
                                class="w-full px-4 py-2 text-sm border rounded-md focus:border-purple-400 focus:outline-none focus:ring-1 focus:ring-purple-600"
                                placeholder="Email" required autofocus />
                            @error('email')
                                <div class="text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mt-5">
                            <input id="password" name="password" type="password"
                                class="w-full px-4 py-2 text-sm border rounded-md focus:border-purple-400 focus:outline-none focus:ring-1 focus:ring-purple-600"
                                placeholder="Password" required />
                            @error('password')
                                <div class="text-red-400">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <p class="mt-4">
                            <a class="text-purple-500 font-semibold" href="./forgot-password.html">
                                Forgot your password?
                            </a>
                        </p>
                        <button
                            class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-500 border border-transparent rounded-lg active:bg-purple-500 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                            href="#" type="submit">
                            Log in
                        </button>
                        <hr class="my-8" />
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
