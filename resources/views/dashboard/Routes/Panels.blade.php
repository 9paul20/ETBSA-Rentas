@if (getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Panel' &&
        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'Persons')
    @include('Dashboard.Components.Panels.Persons')
@elseif (getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Panel' &&
        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'Equipments')
    @include('Dashboard.Components.Panels.Equipments')
@endif
