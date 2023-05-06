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
                        {{ $fixedExpense->equipment->modelo }}
                    </p>
                </div>
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                    <p class="text-gray-600">
                        No. Serie Del Equipo
                    </p>
                    <p>
                        {{ $fixedExpense->equipment->noSerieEquipo }}
                    </p>
                </div>
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                    <p class="text-gray-600">
                        Categoria
                    </p>
                    <p>
                        {{ $fixedExpense->equipment->categoria->categoria }}
                    </p>
                </div>
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                    <p class="text-gray-600">
                        Gasto Fijo
                    </p>
                    <p>
                        {{ $fixedExpense->typeFixedExpense->tipoGastoFijo }}
                    </p>
                </div>
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                    <p class="text-gray-600">
                        Costo Del Gasto Fijo
                    </p>
                    <p>
                        <span class="font-medium text-green-600">$</span>
                        {{ number_format($fixedExpense->costoGastoFijo, 2) }}
                    </p>
                </div>
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                    <p class="text-gray-600">
                        Folio
                    </p>
                    <div class="space-y-2">
                        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4">
                            <p>
                                {{ $fixedExpense->folioFactura }}
                            </p>
                        </div>

                        <div class="border-2 flex items-center p-2 rounded justify-between space-x-2">
                            <div class="space-x-2 truncate">
                                <svg xmlns="http://www.w3.org/2000/svg" class="fill-current inline text-gray-500"
                                    width="24" height="24" viewBox="0 0 24 24">
                                    <path
                                        d="M17 5v12c0 2.757-2.243 5-5 5s-5-2.243-5-5v-12c0-1.654 1.346-3 3-3s3 1.346 3 3v9c0 .551-.449 1-1 1s-1-.449-1-1v-8h-2v8c0 1.657 1.343 3 3 3s3-1.343 3-3v-9c0-2.761-2.239-5-5-5s-5 2.239-5 5v12c0 3.866 3.134 7 7 7s7-3.134 7-7v-12h-2z" />
                                </svg>
                                <span>
                                    resume_for_manager.pdf
                                </span>
                            </div>
                            <a href="#" class="text-purple-700 hover:underline">
                                Download
                            </a>
                        </div>
                    </div>
                </div>
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4">
                    <p class="text-gray-600">
                        Descripción Corta Del Gasto Fijo
                    </p>
                    <p>
                        {{ $fixedExpense->gastoFijo }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
