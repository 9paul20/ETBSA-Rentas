@if (getDashboardNameFromUrlSecond(request()->fullUrl()) == 'Roles')
    @can('View Roles')
        @include('Dashboard.Components.Roles.Table')
    @endcan
@endif
@if (getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Roles' &&
        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'create')
    @can('Create Roles')
        @include('Dashboard.Components.Roles.Create')
    @endcan
@elseif(getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Roles' &&
        is_numeric(getDashboardNameFromUrlSecond(request()->fullUrl())))
    @can('View Roles')
        @include('Dashboard.Components.Roles.Show')
    @endcan
@elseif(getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Roles' &&
        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'edit')
    @can('Update Roles')
        @include('Dashboard.Components.Roles.Create')
    @endcan
@endif
