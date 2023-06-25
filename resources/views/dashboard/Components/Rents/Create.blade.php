<x-Dashboard.BackTo-Button href="Dashboard.Admin.Rents.Index" name="Regresar a Rents" />

@include('Dashboard.Components.Divisor')

@include('Dashboard.Components.Rents.CreateRents')

@if (getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Rents' &&
        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'edit')
    @include('Dashboard.Components.Divisor')

    @include('Dashboard.Components.Rents.Edit.EquipmentDescription')

    @include('Dashboard.Components.Divisor')

    @include('Dashboard.Components.Rents.Edit.PaymentRentsTable')
@endif
@include('Dashboard.Components.Divisor')
