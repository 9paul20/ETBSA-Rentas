<!-- component -->
<!-- This is an example component -->
<div class="min-h-screen flex items-center justify-center px-4 bg-green-50">

    <div class="flex bg-white rounded-lg shadow-lg overflow-hidden mx-auto lg:max-w-7xl w-full">
        <div class="hidden lg:block lg:w-1/3 bg-cover"
            style="background-image:url({{ url('/images/TractorUE2.jpg') }});background-size:cover;background-position:center">
        </div>
        <div class="lg:w-2/3">
            <div class="p-4 border-b w-full">
                <h2 class="text-2xl ">
                    Detalle Del Gasto Mensual
                </h2>
            </div>
            <div class="p-4 border-b w-full">
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                    <p class="text-gray-600">
                        Modelo Del Equipo
                    </p>
                    <p>
                        {{ $monthlyExpense->equipment->modelo }}
                    </p>
                </div>
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                    <p class="text-gray-600">
                        No. Serie Del Equipo
                    </p>
                    <p>
                        {{ $monthlyExpense->equipment->noSerieEquipo }}
                    </p>
                </div>
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                    <p class="text-gray-600">
                        Categoria
                    </p>
                    <p>
                        {{ $monthlyExpense->equipment->categoria->categoria }}
                    </p>
                </div>
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                    <p class="text-gray-600">
                        Gasto Mensual
                    </p>
                    <p>
                        {{ $monthlyExpense->typeFixedExpense->tipoGastoFijo }}
                    </p>
                </div>
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                    <p class="text-gray-600">
                        Descripción Corta del Gasto Mensual
                    </p>
                    <p>
                        {{ $monthlyExpense->gastoMensual }}
                    </p>
                </div>
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                    <p class="text-gray-600">
                        Precio usado
                    </p>
                    <p>
                        @if ($monthlyExpense->indiceValorFijo = 1)
                            Precio del equipo
                        @elseif($monthlyExpense->indiceValorFijo = 2)
                            Precio del equipo más gastos fijos
                        @else
                            Precio Personalizado
                        @endif
                    </p>
                </div>
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                    <p class="text-gray-600">
                        Porcentaje del gasto mensual
                    </p>
                    <p>
                        {{ $monthlyExpense->porGastoMensual ? $monthlyExpense->porGastoMensual : 'Sin porcentaje' }}<span
                            class="text-green-500 font-medium">{{ $monthlyExpense->porGastoMensual ? '%' : '' }}</span>
                    </p>
                </div>
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                    <p class="text-gray-600">
                        Costo Del Gasto Mensual
                    </p>
                    <p>
                        <span class="font-medium text-green-600">$</span>
                        {{ number_format($monthlyExpense->costoMensual, 2) }}
                    </p>
                </div>
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4">
                    <p class="text-gray-600">
                        Descripción Del Gasto Mensual
                    </p>
                    <p>
                        {{ $monthlyExpense->descripcion }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
