@if (getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Admin' &&
        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'MonthlyExpenses')
    @include('Dashboard.Components.MonthlyExpenses.Table')
@endif
@if (getDashboardNameFromUrlFirst(request()->fullUrl()) == 'MonthlyExpenses' &&
        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'create')
    @include('Dashboard.Components.MonthlyExpenses.Create')
@elseif(getDashboardNameFromUrlFirst(request()->fullUrl()) == 'MonthlyExpenses' &&
        is_numeric(getDashboardNameFromUrlSecond(request()->fullUrl())))
    @include('Dashboard.Components.MonthlyExpenses.Show')
@elseif(getDashboardNameFromUrlFirst(request()->fullUrl()) == 'MonthlyExpenses' &&
        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'edit')
    @include('Dashboard.Components.MonthlyExpenses.Create')
@endif
