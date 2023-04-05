@if (getDashboardNameFromUrlSecond(request()->fullUrl()) == 'Users')
    @include('Dashboard.Components.Users.Table')
@endif
@if (getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Users' &&
        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'create')
    @include('Dashboard.Components.Users.Create')
@elseif(getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Users' &&
        is_numeric(getDashboardNameFromUrlSecond(request()->fullUrl())))
    @include('Dashboard.Components.Users.Show')
@elseif(getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Users' &&
        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'edit')
    @include('Dashboard.Components.Users.Create')
@endif
