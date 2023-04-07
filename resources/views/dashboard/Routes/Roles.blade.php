@if (getDashboardNameFromUrlSecond(request()->fullUrl()) == 'Roles')
    @include('Dashboard.Components.Roles.Table')
@endif
@if (getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Roles' &&
        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'create')
    @include('Dashboard.Components.Roles.Create')
@elseif(getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Roles' &&
        is_numeric(getDashboardNameFromUrlSecond(request()->fullUrl())))
    @include('Dashboard.Components.Roles.Show')
@elseif(getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Roles' &&
        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'edit')
    @include('Dashboard.Components.Roles.Create')
@endif
