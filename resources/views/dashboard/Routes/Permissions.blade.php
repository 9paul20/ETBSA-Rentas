@if (getDashboardNameFromUrlSecond(request()->fullUrl()) == 'Permissions')
    @include('Dashboard.Components.Permissions.Table')
@endif
@if (getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Permissions' &&
        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'create')
    @include('Dashboard.Components.Permissions.Create')
@elseif(getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Permissions' &&
        is_numeric(getDashboardNameFromUrlSecond(request()->fullUrl())))
    @include('Dashboard.Components.Permissions.Show')
@elseif(getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Permissions' &&
        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'edit')
    @include('Dashboard.Components.Permissions.Create')
@endif
