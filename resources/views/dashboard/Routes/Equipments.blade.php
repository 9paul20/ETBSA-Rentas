@if (getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Admin' &&
        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'Equipments')
    {{-- @include('Dashboard.Components.Equipments.Table') --}}
    <div id="vueApp">
        <div>
            <index-equipments createequipmentroute="{{ route('Dashboard.Admin.Equipments.Create') }}"
                imagetractor="{{ url('/images/TractorUE.jpg') }}" yieldtitle="@yield('meta-title', config('app.name'))"
                routetitle="{{ getDashboardNameFromUrlSecond(request()->fullUrl()) }}" />
        </div>
    </div>
@endif
@if (getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Equipments' &&
        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'create')
    {{-- @include('Dashboard.Components.Equipments.Create') --}}
    <div id="vueApp">
        <div>
            <create-equipments backtoindex="{{ route('Dashboard.Admin.Equipments.Index') }}"
                yieldtitle="@yield('meta-title', config('app.name'))" routetitle="{{ getDashboardNameFromUrlSecond(request()->fullUrl()) }}" />
        </div>
    </div>
@elseif(getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Equipments' &&
        is_numeric(getDashboardNameFromUrlSecond(request()->fullUrl())))
    {{-- @include('Dashboard.Components.Equipments.Show') --}}
    @include('Dashboard.Components.Equipments.ShowVue')
    {{-- <div id="vueApp">
        <div>
            <show-equipments />
        </div>
    </div> --}}
@elseif(getDashboardNameFromUrlFirst(request()->fullUrl()) == 'Equipments' &&
        getDashboardNameFromUrlSecond(request()->fullUrl()) == 'edit')
    @include('Dashboard.Components.Equipments.Create')
    {{-- <div id="vueApp">
        <div>
            <edit-equipments backtoindex="{{ route('Dashboard.Admin.Equipments.Index') }}"
                yieldtitle="@yield('meta-title', config('app.name'))" routetitle="{{ getDashboardNameFromUrlSecond(request()->fullUrl()) }}" />
        </div>
    </div> --}}
@endif
