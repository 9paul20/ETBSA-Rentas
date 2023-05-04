@if (getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Admin' &&
        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'MonthlyExpenses')
    @include('Dashboard.Components.MounthlyExpenses.Table')
@endif
@if (getDashboardNameFromUrlFirst(request()->fullUrl()) == 'MounthlyExpenses' &&
        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'create')
    @include('Dashboard.Components.MounthlyExpenses.Create')
@elseif(getDashboardNameFromUrlFirst(request()->fullUrl()) == 'MounthlyExpenses' &&
        is_numeric(getDashboardNameFromUrlSecond(request()->fullUrl())))
    @include('Dashboard.Components.MounthlyExpenses.Show')
@elseif(getDashboardNameFromUrlFirst(request()->fullUrl()) == 'MounthlyExpenses' &&
        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'edit')
    @include('Dashboard.Components.MounthlyExpenses.Create')
@endif
