<x-Dashboard.BackTo-Button href="Dashboard.Admin.Equipments.Index" name="Regresar a Equipments" />

@include('Dashboard.Components.Divisor')

@include('Dashboard.Components.Equipments.CreateEquipment')

@if (getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Equipments' &&
        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'edit')
    @include('Dashboard.Components.Divisor')

    @include('Dashboard.Components.Equipments.Edit.FixedExpensesTable')

    @include('Dashboard.Components.Divisor')

    @include('Dashboard.Components.Equipments.Edit.VariablesExpensesTable')
@endif

@include('Dashboard.Components.Divisor')
