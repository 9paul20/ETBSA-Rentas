@extends('layout')

@push('styles')
@endpush

@push('body_style')
    class="bg-gray-100"
@endpush

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div x-data="setup()" x-init="$refs.loading.classList.add('hidden');" @resize.window="watchScreen()">
        <div class="flex min-h-screen inset-y-0 antialiased text-gray-900 dark:bg-dark dark:text-light">
            <!-- Loading screen -->
            <div x-ref="loading"
                class="fixed inset-0 z-50 flex items-center justify-center text-2xl font-semibold text-white bg-green-800">
                Loading.....
            </div>
            <!-- Sidebar -->
            @include('Components.Sidebar.SidebarNavigarionComponent')
            <div class="flex-col flex-1">
                @include('Dashboard.Components.Navbar')
                <div class="flex flex-1">
                    <!-- Main -->
                    <main class="justify-center flex-1 px-4">
                        <!-- Content -->
                        @include('Dashboard.Components.Notification')
                        @include('Dashboard.Routes.Menu')

                        @can('View Permissions')
                            @include('Dashboard.Routes.Permissions')
                        @endcan
                        @can('View Roles')
                            @include('Dashboard.Routes.Roles')
                        @endcan
                        @can('View Users')
                            @include('Dashboard.Routes.Users')
                        @endcan
                        @include('Dashboard.Routes.Persons')
                        @include('Dashboard.Routes.Equipments')
                        @include('Dashboard.Routes.Rents')
                        @include('Dashboard.Routes.FixedExpenses')
                        @include('Dashboard.Routes.VariablesExpenses')
                        @include('Dashboard.Routes.MonthlyExpenses')
                        @include('Dashboard.Routes.Panels')
                    </main>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const setup = () => {
            return {
                isSidebarOpen: false,
                currentSidebarTab: null,
                isSubHeaderOpen: false,
                watchScreen() {
                    if (window.innerWidth <= 1024) {
                        this.isSidebarOpen = false
                    }
                },
            }
        }
        $(window).scroll(function() {
            var sidebar = $(".left-mini-bar");
            var offset = sidebar.offset();
            var topPadding = 15;
        });
        if (typeof objeto !== 'undefined') {
            // leer la propiedad 'top' del objeto
        }

        const successMessage = sessionStorage.getItem('success');

        if (successMessage) {
            alert(successMessage);
            sessionStorage.removeItem('success');
        }
    </script>
@endpush
