<div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
    <div class="overflow-hidden bg-white shadow sm:rounded-lg">
        <div class="px-4 py-1 sm:px-6 bg-gray-50">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Información del equipo</h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">Detalles Básicos.</p>
        </div>
        <div class="border-t border-gray-200 px-4 py-3 sm:px-6">
            <dl class="grid grid-cols-1 gap-x-4 gap-y-3 sm:grid-cols-2">
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">No Serie del Equipo</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $Data['rent']['equipment']['noSerieEquipo'] }}</dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Modelo</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $Data['rent']['equipment']['modelo'] }}</dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Precio Adquirido</dt>
                    <dd class="mt-1 text-sm text-gray-900"><span
                            class="text-green-600 font-semibold">$</span>{{ number_format($Data['rent']['equipment']['precioEquipo'], 2) }}
                    </dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Precio Actual</dt>
                    <dd class="mt-1 text-sm text-gray-900"><span
                            class="text-green-600 font-semibold">$</span>{{ number_format($Data['rent']['equipment']['precioEquipoActual'], 2) }}
                    </dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Descripción</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        {{ $Data['rent']['equipment']['descripcion'] ? $Data['rent']['equipment']['descripcion'] : 'Sin Descripción' }}
                    </dd>
                </div>
                <div class="sm:col-span-1">
                    <a target="_blank"
                        href="{{ route('Dashboard.Admin.Equipments.Show', $Data['rent']['equipment']['clvEquipo']) }}"
                        class="text-base font-semibold text-white bg-green-600 hover:bg-green-700 p-2 rounded-lg">Ir a
                        más
                        detalles</a>
                </div>
            </dl>
        </div>
    </div>
    <div class="overflow-hidden bg-white shadow sm:rounded-lg">
        <div class="px-4 py-1 sm:px-6 bg-gray-50">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Información del Cliente</h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">Detalles Básicos.</p>
        </div>
        <div class="border-t border-gray-200 px-4 py-3 sm:px-6">
            <dl class="grid grid-cols-1 gap-x-4 gap-y-3 sm:grid-cols-2">
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Nombre del cliente</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $Data['rent']['person']['nombrePersona'] }}
                        {{ $Data['rent']['person']['apePaternoPersona'] }}
                        {{ $Data['rent']['person']['apeMaternoPersona'] }}</dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Ocupación</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        {{ $Data['rent']['person']['ocupacion'] ? $Data['rent']['person']['ocupacion'] : 'Sin Ocupación' }}
                    </dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Información adicional</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        {{ $Data['rent']['person']['informacion'] ? $Data['rent']['person']['informacion'] : 'Sin Información' }}
                    </dd>
                </div>
                <div class="sm:col-span-1">
                    <a href="#"
                        class="text-base font-semibold text-white bg-green-600 hover:bg-green-700 p-2 rounded-lg">Ir a
                        más
                        detalles</a>
                </div>
            </dl>
        </div>
    </div>
</div>
