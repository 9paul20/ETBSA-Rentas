@if (getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Panel' &&
        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'Persons')
    @include('Dashboard.Components.Panel.Persons')
@endif
