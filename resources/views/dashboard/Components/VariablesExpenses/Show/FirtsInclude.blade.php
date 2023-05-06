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
                    Detalle Del Gasto Fijo
                </h2>
            </div>
            <div class="p-4 border-b w-full">
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                    <p class="text-gray-600">
                        Modelo Del Equipo
                    </p>
                    <p>
                        {{ $variableExpense->equipment->modelo }}
                    </p>
                </div>
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                    <p class="text-gray-600">
                        No. Serie Del Equipo
                    </p>
                    <p>
                        {{ $variableExpense->equipment->noSerieEquipo }}
                    </p>
                </div>
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                    <p class="text-gray-600">
                        Categoria
                    </p>
                    <p>
                        {{ $variableExpense->equipment->categoria->categoria }}
                    </p>
                </div>
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                    <p class="text-gray-600">
                        Gasto Variable
                    </p>
                    <p>
                        {{ $variableExpense->gastoVariable }}
                    </p>
                </div>
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                    <p class="text-gray-600">
                        Costo Del Gasto Variable
                    </p>
                    <p>
                        <span class="font-medium text-green-600">$</span>
                        {{ number_format($variableExpense->costoGastoVariable, 2) }}
                    </p>
                </div>
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4">
                    <p class="text-gray-600">
                        Descripción Del Gasto Variable
                    </p>
                    <p>
                        {{ $variableExpense->descripcion }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
