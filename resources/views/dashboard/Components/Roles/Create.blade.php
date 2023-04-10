<x-Dashboard.BackTo-Button href="Dashboard.Admin.Roles.Index" name="Regresar a Roles" />

@include('Dashboard.Components.Divisor')

@include('Dashboard.Components.Roles.CreateRole')

@if (getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Roles' &&
        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'edit')
    @include('Dashboard.Components.Divisor')

    @include('Dashboard.Components.Roles.AssignPermissions', ['permission' => $role])
@endif

@include('Dashboard.Components.Divisor')
