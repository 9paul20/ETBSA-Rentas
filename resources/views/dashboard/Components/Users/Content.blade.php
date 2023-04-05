<h1>Estas en {{ getDashboardNameFromUrlSecond(request()->fullUrl()) }} de
    {{ getDashboardNameFromUrlFirst(request()->fullUrl()) }}</h1>
{{-- @if (getDashboardNameFromUrlSecond(request()->fullUrl()) == 'create')
    <h1>Estas en {{ getDashboardNameFromUrlSecond(request()->fullUrl()) }} de
        {{ getDashboardNameFromUrlFirst(request()->fullUrl()) }}</h1>
@elseif(getDashboardNameFromUrlSecond(request()->fullUrl()) == 'show')
    <h1>Estas en {{ getDashboardNameFromUrlSecond(request()->fullUrl()) }} de
        {{ getDashboardNameFromUrlFirst(request()->fullUrl()) }}</h1>
@elseif(getDashboardNameFromUrlSecond(request()->fullUrl()) == 'edit')
    <h1>Estas en {{ getDashboardNameFromUrlSecond(request()->fullUrl()) }} de
        {{ getDashboardNameFromUrlFirst(request()->fullUrl()) }}</h1>
@else --}}
@include('Dashboard.Components.Users.Table')
{{-- @endif --}}
