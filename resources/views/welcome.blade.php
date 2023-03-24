<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style></style>

    <!-- Vite Compiled Styles -->
    @vite('resources/css/app.css')
    <!-- Finish Compiled Styles -->
</head>

<body class="antialiased">
    <div id="app">
        <router-view></router-view>
    </div>

    <!-- Vite Compiled Scripts -->
    @vite('resources/js/app.js')
    <!-- Finish Compiled Scripts -->
</body>

</html>
