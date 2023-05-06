<div
    class="relative rounded-3xl w-[950px] max-w-auto mx-auto bg-white dark:!bg-navy-800 dark:text-white dark:!shadow-none p-5">
    <div class="mt-2 mb-8 w-full">
        <h4 class="px-2 text-xl font-bold text-navy-700">
            General Information
        </h4>
        <p class="mt-2 px-2 text-base text-gray-600">
            As we live, our hearts turn colder. Cause pain is what we go through
            as we become older. We get insulted by others, lose trust for those
            others. We get back stabbed by friends. It becomes harder for us to
            give others a hand. We get our heart broken by people we love, even
            that we give them all...
        </p>
    </div>

    <!-- component -->
    <div class="flex -m-4 text-center py-2">
        {{-- <div class="p-4 sm:w-1/2 lg:w-1/3 w-full hover:scale-105 duration-500">
            <div class=" flex items-center  justify-between p-4  rounded-lg bg-white shadow-indigo-50 shadow-md">
                <div>
                    <h2 class="text-gray-900 text-lg font-bold">Total Ballance</h2>
                    <h3 class="mt-2 text-xl font-bold text-yellow-500 text-left">+ 150.000 ₭</h3>
                    <p class="text-sm font-semibold text-gray-400">Last Transaction</p>
                    <button
                        class="text-sm mt-6 px-4 py-2 bg-yellow-400 text-white rounded-lg  tracking-wider hover:bg-yellow-300 outline-none">Add
                        to cart</button>
                </div>
                <div
                    class="bg-gradient-to-tr from-yellow-500 to-yellow-400 w-32 h-32  rounded-full shadow-2xl shadow-yellow-400 border-white  border-dashed border-2  flex justify-center items-center ">
                    <div>
                        <h1 class="text-white text-2xl">Basic</h1>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="p-2 sm:w-1/4 lg:w-1/4 w-full hover:scale-105 duration-500 py-2 h-full">
            <div
                class="flex items-center justify-between p-4 rounded-lg bg-orange-50 shadow-indigo-100 shadow-md h-full">
                <div>
                    <h2 class="text-gray-900 text-lg font-bold">Gastos Fijos</h2>
                    <h3 class="mt-2 text-xl font-bold text-orange-500 text-left">$
                        {{ number_format($Data['equipment']->sumGastosFijos, 2) }}</h3>
                    <span class="text-xs text-gray-500">Total De Gastos Fijos</span>
                </div>
            </div>
        </div>
        <div class="p-2 sm:w-1/4 lg:w-1/4 w-full hover:scale-105 duration-500 py-2 h-full">
            <div
                class="flex items-center justify-between p-4 rounded-lg bg-orange-50 shadow-indigo-100 shadow-md h-full">
                <div>
                    <h2 class="text-gray-900 text-lg font-bold">Gastos Variables</h2>
                    <h3 class="mt-2 text-xl font-bold text-orange-500 text-left">$
                        {{ number_format($Data['equipment']->sumGastosVariables, 2) }}</h3>
                    <span class="text-xs text-gray-500">Total De Gastos Variables</span>
                </div>
            </div>
        </div>
        <div class="p-2 sm:w-1/4 lg:w-1/4 w-full hover:scale-105 duration-500 py-2 h-full">
            <div
                class="flex items-center justify-between p-4 rounded-lg bg-orange-50 shadow-indigo-100 shadow-md h-full">
                <div>
                    <h2 class="text-gray-900 text-lg font-bold">Costo Bruto Actual</h2>
                    <h3 class="mt-2 text-xl font-bold text-yellow-500 text-left">$
                        {{ number_format($Data['equipment']->precioActualPorDepreciacionAnual, 2) }}
                    </h3>
                    <span class="text-xs text-gray-500">Descuento Con Depreciación Anual</span>
                </div>
            </div>
        </div>
        <div class="p-2 sm:w-1/4 lg:w-1/4 w-full hover:scale-105 duration-500 py-2 h-full">
            <div
                class="flex items-center justify-between p-4 rounded-lg bg-orange-50 shadow-indigo-100 shadow-md h-full">
                <div>
                    <h2 class="text-gray-900 text-lg font-bold">Costo Neto Actual</h2>
                    <h3 class="mt-2 text-xl font-bold text-yellow-500 text-left">$
                        {{ number_format($Data['equipment']->costoNetoAnual, 2) }}
                    </h3>
                    <span class="text-xs text-gray-500">Descuento Con Depreciación Anual</span>
                </div>
            </div>
        </div>
    </div>
    <div class="flex -m-4 text-center py-2">
        <div class="p-2 sm:w-1/4 lg:w-1/2 w-full hover:scale-105 duration-500 py-2 h-full">
            <div
                class="flex items-center justify-between p-4 rounded-lg bg-orange-50 shadow-indigo-100 shadow-md h-full">
                <div>
                    <h2 class="text-gray-900 text-lg font-bold">Costo Mensual</h2>
                    <h3 class="mt-2 text-xl font-bold text-red-500 text-center">$
                        {{ number_format($Data['equipment']->sumGastosMensuales, 2) }}
                    </h3>
                    <span class="text-xs text-gray-500">Gasto Actual Al Equipo por mes</span>
                </div>
            </div>
        </div>
        <div class="p-2 sm:w-1/4 lg:w-1/2 w-full hover:scale-105 duration-500 py-2 h-full">
            <div
                class="flex items-center justify-between p-4 rounded-lg bg-orange-50 shadow-indigo-100 shadow-md h-full">
                <div>
                    <h2 class="text-gray-900 text-lg font-bold">Renta Mensual Recomendada</h2>
                    <h3 class="mt-2 text-xl font-bold text-green-500 text-center">$
                        {{ number_format($Data['equipment']->sumGastosMensuales / 0.8, 2) }}
                    </h3>
                    <span class="text-xs text-gray-500">Precio de Renta Mensual Recomendada (Se añade un %25 de
                        rendimiento)</span>
                </div>
            </div>
        </div>
        {{-- <div class="p-2 sm:w-1/4 lg:w-1/2 w-full hover:scale-105 duration-500 py-2 h-full">
            <div
                class="flex items-center justify-between p-4 rounded-lg bg-orange-50 shadow-indigo-100 shadow-md h-full">
                <div>
                    <h2 class="text-gray-900 text-lg font-bold">Renta Mensual Recomendada</h2>
                    <h3 class="mt-2 text-xl font-bold text-green-500 text-left">$
                        {{ number_format($Data['equipment']->costoNetoAnual, 2) }}
                    </h3>
                    <span class="text-xs text-gray-500">Descuento Con Depreciación Anual</span>
                </div>
            </div>
        </div> --}}
    </div>

    <div class="mt-2 mb-8 w-full">
        <h4 class="px-2 text-xl font-bold text-navy-700">
            General Information
        </h4>
    </div>

    @include('Dashboard.Components.Equipments.Show.Tables.TableFixedExpenses')

    @include('Dashboard.Components.Equipments.Show.Tables.TableVariablesExpenses')

    @include('Dashboard.Components.Equipments.Show.Tables.TableMonthlyExpenses')

</div>
