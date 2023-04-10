@if (getDashboardNameFromUrlSecond(request()->fullUrl()) == 'Permissions')
    @can('View Permissions')
        @include('Dashboard.Components.Permissions.Table')
    @endcan
@endif
@if (getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Permissions' &&
        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'create')
    @can('Create Permissions')
        @include('Dashboard.Components.Permissions.Create')
    @endcan
@elseif(getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Permissions' &&
        is_numeric(getDashboardNameFromUrlSecond(request()->fullUrl())))
    @can('View Permissions')
        @include('Dashboard.Components.Permissions.Show')
    @endcan
@elseif(getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Permissions' &&
        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'edit')
    @can('Update Permissions')
        @include('Dashboard.Components.Permissions.Create')
    @endcan
@endif
