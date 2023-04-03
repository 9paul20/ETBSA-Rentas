<div class="flex flex-1">
    <!-- Main -->
    <main class="justify-center flex-1 px-4">
        <!-- Content -->
        {{-- <h1 class="text-5xl font-bold text-gray-500">@yield('meta-title', config('app.name'))</h1> --}}
        @if (getDashboardNameFromUrlSecond(request()->fullUrl()) == 'create')
            {{-- <h1>Estas en {{ getDashboardNameFromUrlSecond(request()->fullUrl()) }} de
                {{ getDashboardNameFromUrlFirst(request()->fullUrl()) }}</h1> --}}
            @include('Dashboard.Components.Create')
        @elseif(getDashboardNameFromUrlSecond(request()->fullUrl()) == 'show')
            <h1>Estas en {{ getDashboardNameFromUrlSecond(request()->fullUrl()) }} de
                {{ getDashboardNameFromUrlFirst(request()->fullUrl()) }}</h1>
        @elseif(getDashboardNameFromUrlSecond(request()->fullUrl()) == 'edit')
            <h1>Estas en {{ getDashboardNameFromUrlSecond(request()->fullUrl()) }} de
                {{ getDashboardNameFromUrlFirst(request()->fullUrl()) }}</h1>
        @else
            @include('Dashboard.Components.Table')
        @endif
    </main>
</div>
