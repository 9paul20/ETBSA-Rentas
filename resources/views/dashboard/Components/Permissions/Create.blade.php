<button type="button" onclick="window.location.href='{{ route('Dashboard.Admin.Permissions.Index') }}'"
    class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
        class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
    </svg>
    Regresar
</button>

@include('Dashboard.Components.Divisor')

@include('Dashboard.Components.Permissions.CreatePermission')

@include('Dashboard.Components.Divisor')
