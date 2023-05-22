{{-- Para especificar que este es un documento HTML5. --}}
<!DOCTYPE html>
{{-- Para especificar idioma del documento HTML5. --}}
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @stack('html_style')>

<head>
    {{-- Metadatos --}}
    {{-- La codificación de caracteres. --}}
    <meta charset="UTF-8">
    {{-- La declaración de la ventana gráfica. --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    {{-- La compatibilidad con Internet Explorer. --}}
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- El nombre del autor del documento. --}}
    <meta name="description" content="@yield('meta-description', 'Descripción del documento')">
    {{-- El nombre del autor del documento. --}}
    <meta name="author" content="@yield('meta-author', 'Nombre del autor')">
    {{-- Las palabras clave que describen el contenido del documento. --}}
    <meta name="keywords" content="@yield('meta-keywords', 'palabra clave 1, palabra clave 2, palabra clave 3')">
    {{-- Define cómo los motores de búsqueda deben indexar y rastrear el documento. --}}
    <meta name="robots" content="index,follow">
    {{-- Indica el software utilizado para generar el documento. --}}
    <meta name="generator" content="Laravel">
    {{-- Título que se muestra cuando se comparte el enlace del documento en redes sociales. --}}
    <meta property="og:title" content="@yield('og-title', config('app.name'))">
    {{-- URL de la imagen que se muestra cuando se comparte el enlace del documento en redes sociales. --}}
    <meta property="og:image" content="@yield('og-image', url('/images/John_Deere_Logo.png'))">
    {{-- Color principal del tema. --}}
    <meta name="theme-color" content="#000000" />
    {{-- Icono de pestaña de la página web --}}
    <link rel="shortcut icon" href="{{ url('/images/John_Deere_Logo.png') }}" />

    {{-- Importación de fuentes externas --}}
    {{-- <link rel="preload" href="/fonts/Inter-roman.var.woff2?v=3.18" as="font" type="font/woff2" crossorigin=""> --}}

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" rel="stylesheet" />

    {{-- Titulo del sitio web --}}
    <title inertia>@yield('meta-title', config('app.name'))</title>

    {{-- Styles Vite Compiled --}}
    @vite('resources/css/app.css')
    {{-- Styles Vite Compiled Finished --}}

    {{-- Enlaces a hojas de estilo CSS --}}
    <link rel="stylesheet" href="{{ url('/css/styles.css') }}">
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
    {{--
    <link rel="stylesheet" href="{{ url('/css/components.css') }}"> --}}

    {{-- Clases CSS incorporados --}}
    @stack('styles')
    {{-- Fin CSS Incorporados --}}

</head>

<body style="min-height: 100vh"
    class="h-32 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-slate-100 scrollbar-track-rounded-full scrollbar-thumb-rounded-full overflow-y-scroll"
    @stack('body_style') scroll-region>

    {{-- Contenido Dinámico --}}
    @yield('content')

    {{-- Enlaces a Scripts de JS --}}
    {{-- <script type="text/javascript" src="{{ url('/js/components.js') }}"></script> --}}
    {{-- <script type="text/javascript" src="https://cdn.tailwindcss.com"></script> --}}
    <script type="text/javascript" src="{{ url('js/jquery-3.6.4.min.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}

    {{-- Scripts Vite Compiled --}}
    @vite('resources/js/app.js')
    {{-- Scripts Vite Compiled Finished --}}

    {{-- Clases Scripts Incorporados --}}
    @stack('scripts')
    {{-- Fin Scripts Incorporados --}}

    {{-- <footer> --}}

    {{-- </footer> --}}

</body>

</html>
