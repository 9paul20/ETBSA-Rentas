<div class="flex flex-1">
    <!-- Main -->
    <main class="justify-center flex-1 px-4">
        <!-- Content -->
        {{-- <h1 class="text-5xl font-bold text-gray-500">@yield('meta-title', config('app.name'))</h1> --}}
        @include('Dashboard.Components.Table')
    </main>
</div>
