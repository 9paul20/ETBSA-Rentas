@if (getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Admin' &&
        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'VariablesExpenses')
    @include('Dashboard.Components.VariablesExpenses.Table')
@endif
@if (getDashboardNameFromUrlFirst(request()->fullUrl()) == 'VariablesExpenses' &&
        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'create')
    @include('Dashboard.Components.VariablesExpenses.Create')
@elseif(getDashboardNameFromUrlFirst(request()->fullUrl()) == 'VariablesExpenses' &&
        is_numeric(getDashboardNameFromUrlSecond(request()->fullUrl())))
    @include('Dashboard.Components.VariablesExpenses.Show')
@elseif(getDashboardNameFromUrlFirst(request()->fullUrl()) == 'VariablesExpenses' &&
        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'edit')
    @include('Dashboard.Components.VariablesExpenses.Create')
@endif
