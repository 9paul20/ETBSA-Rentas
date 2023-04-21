@if (getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Panel' &&
        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'Persons')
    @include('Dashboard.Components.Panels.Persons')
@elseif (getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Panel' &&
        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'Equipments')
    @include('Dashboard.Components.Panels.Equipments')
@elseif (getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Panel' &&
        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'Rents')
    @include('Dashboard.Components.Panels.Rents')
@elseif (getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Panel' &&
        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'FixedExpenses')
    @include('Dashboard.Components.Panels.FixedExpenses')
@endif
