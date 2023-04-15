@if (getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Admin' &&
        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'Rents')
    @include('Dashboard.Components.Rents.Table')
@endif
@if (getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Rents' &&
        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'create')
    @include('Dashboard.Components.Rents.Create')
@elseif(getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Rents' &&
        is_numeric(getDashboardNameFromUrlSecond(request()->fullUrl())))
    @include('Dashboard.Components.Rents.Show')
@elseif(getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Rents' &&
        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'edit')
    @include('Dashboard.Components.Rents.Create')
@endif
