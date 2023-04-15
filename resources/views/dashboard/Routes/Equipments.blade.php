@if (getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Admin' &&
        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'Equipments')
    @include('Dashboard.Components.Equipments.Table')
@endif
@if (getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Equipments' &&
        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'create')
    @include('Dashboard.Components.Equipments.Create')
@elseif(getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Equipments' &&
        is_numeric(getDashboardNameFromUrlSecond(request()->fullUrl())))
    @include('Dashboard.Components.Equipments.Show')
@elseif(getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Equipments' &&
        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'edit')
    @include('Dashboard.Components.Equipments.Create')
@endif
