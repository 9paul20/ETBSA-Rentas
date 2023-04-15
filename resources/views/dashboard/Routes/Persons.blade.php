@if (getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Admin' &&
        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'Persons')
    @include('Dashboard.Components.Persons.Table')
@endif
@if (getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Persons' &&
        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'create')
    @include('Dashboard.Components.Persons.Create')
@elseif(getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Persons' &&
        is_numeric(getDashboardNameFromUrlSecond(request()->fullUrl())))
    @include('Dashboard.Components.Persons.Show')
@elseif(getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Persons' &&
        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'edit')
    @include('Dashboard.Components.Persons.Create')
@endif
