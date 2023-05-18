@if (getDashboardNameFromUrlSecond(request()->fullUrl()) == 'Menu')
    <main class="flex items-center justify-center flex-1 px-4 py-8">
        <h1 class="text-5xl font-bold text-gray-500">@yield('meta-title', config('app.name'))</h1>
    </main>
    {{-- <div id="vueApp">
        <div>
            <app-view />
        </div>
        <div>
            <table-view-component />
        </div>
    </div> --}}
@endif
