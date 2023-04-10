@if (getDashboardNameFromUrlSecond(request()->fullUrl()) == 'Users')
    @can('View Users')
        @include('Dashboard.Components.Users.Table')
    @endcan
@endif
@if (getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Users' &&
        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'create')
    @can('Create Users')
        @include('Dashboard.Components.Users.Create')
    @endcan
@elseif(getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Users' &&
        is_numeric(getDashboardNameFromUrlSecond(request()->fullUrl())))
    @can('View Users')
        @include('Dashboard.Components.Users.Show')
    @endcan
@elseif(getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Users' &&
        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'edit')
    @can('Update Users')
        @include('Dashboard.Components.Users.Create')
    @endcan
@endif
