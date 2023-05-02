@if (getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Admin' &&
        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'FixedExpenses')
    @include('Dashboard.Components.FixedExpenses.Table')
@endif
@if (getDashboardNameFromUrlFirst(request()->fullUrl()) == 'FixedExpenses' &&
        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'create')
    @include('Dashboard.Components.FixedExpenses.Create')
@elseif(getDashboardNameFromUrlFirst(request()->fullUrl()) == 'FixedExpenses' &&
        is_numeric(getDashboardNameFromUrlSecond(request()->fullUrl())))
    @include('Dashboard.Components.FixedExpenses.Show')
@elseif(getDashboardNameFromUrlFirst(request()->fullUrl()) == 'FixedExpenses' &&
        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'edit')
    @include('Dashboard.Components.FixedExpenses.Create')
@endif
