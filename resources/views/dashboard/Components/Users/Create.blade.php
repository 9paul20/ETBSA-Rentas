<x-Dashboard.BackTo-Button href="Dashboard.Admin.Users.Index" name="Regresar a Users" />

@include('Dashboard.Components.Divisor')

@include('Dashboard.Components.Users.CreateUser')

@if (getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Users' &&
        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'edit')
    @include('Dashboard.Components.Divisor')

    @include('Dashboard.Components.Users.Edit.AssignRoles', ['role' => $user])

    @include('Dashboard.Components.Divisor')

    @include('Dashboard.Components.Users.Edit.AssignPermissions', ['permission' => $user])
@endif

@include('Dashboard.Components.Divisor')
