<div
    class="flex flex-col items-start justify-center rounded-2xl bg-white bg-clip-border px-1 py-1 shadow-3xl shadow-shadow-500 dark:!bg-navy-700 dark:shadow-none">
    <div class="table-auto">
        <table class="table-auto">
            <tbody>
                <tr>
                    <td class="px-1 py text-lg font-medium leading-6 text-gray-600">Precio Total del Equipo</td>
                    <td class="px-1 py text-lg font-medium leading-6 text-gray-600">
                        <div class='flex flex-row'>
                            <p class='text-[17px] font-bold text-[#0FB478]'>$</p>
                            <p class='text-[#3C3C4399] text-[17px] mr-2'>
                                {{ number_format($Data['equipment']['precioEquipo'], 2) }}</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="px-1 py text-lg font-medium leading-6 text-gray-600">Total de Gastos Fijos
                    </td>
                    <td class="px-1 py text-lg font-medium leading-6 text-gray-600">
                        <div class='flex flex-row'>
                            <p class='text-[17px] font-bold text-[#0FB478]'>$</p>
                            <p class='text-[#3C3C4399] text-[17px] mr-2'>
                                {{ number_format($Data['equipment']->sum_gastos_fijos, 2) }}</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="px-1 py text-lg font-medium leading-6 text-gray-600">Total de Gastos Variables
                    </td>
                    <td class="px-1 py text-lg font-medium leading-6 text-gray-600">
                        <div class='flex flex-row'>
                            <p class='text-[17px] font-bold text-[#0FB478]'>$</p>
                            <p class='text-[#3C3C4399] text-[17px] mr-2'>
                                {{ number_format($Data['equipment']->sum_gastos_variables, 2) }}</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="px-1 py text-lg font-medium leading-6 text-gray-600">Total de Gastos Mensuales
                    </td>
                    <td class="px-1 py text-lg font-medium leading-6 text-gray-600">
                        <div class='flex flex-row'>
                            <p class='text-[17px] font-bold text-[#0FB478]'>$</p>
                            <p class='text-[#3C3C4399] text-[17px] mr-2'>
                                {{ number_format($Data['equipment']->sum_gastos_mensuales, 2) }}</p>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@include('Dashboard.Components.Divisor')

<h3 class="text-lg font-medium leading-6 text-gray-900">Total Inicial: <span
        class="font-fold text-[17px] text-green-600">$</span>
    {{ number_format($Data['equipment']['precioEquipo'] + $Data['equipment']->sum_gastos_fijos, 2) }}
</h3>
<h3 class="text-lg font-medium leading-6 text-gray-900">Total Actual: <span
        class="font-fold text-[17px] text-green-600">$</span>
    {{ number_format($Data['equipment']['precioEquipoActual'] + $Data['equipment']->sum_gastos_fijos, 2) }}
</h3>
<h3 class="text-lg font-medium leading-6 text-gray-900">
    Valor real con gastos:
    <span class="font-fold text-[17px] text-green-600">$</span>
    <span class="mt-2" id="calcularValorRealConGastos" name="calcularValorRealConGastos"></span>
</h3>
<h3 class="text-lg font-medium leading-6 text-gray-900">
    Valor comercial con gastos:
    <span class="font-fold text-[17px] text-green-600">$</span>
    <span class="mt-2" id="calcularValorComercialConGastos" name="calcularValorComercialConGastos"></span>
</h3>
<h3 class="text-lg font-medium leading-6 text-gray-900">
    Calcular Renta Aproximada:
    <input type="number" pattern="[0-9]+(\.[0-9]+)?" min="0" max="1" step="1" value="25"
        class="rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm"
        id="inputRentaMensual" name="inputRentaMensual" placeholder="%">
    <span class="font-fold text-[17px]">=</span>
    <span class="font-fold text-[17px] text-green-600">$</span>
    <span class="mt-2" id="calcularRentaMensual" name="calcularRentaMensual"></span>
</h3>
<h3>
    <table class="min-w-full divide-y divide-gray-300">
        <tbody class="divide-y divide-gray-200 bg-white">
            <tr class="divide-x divide-gray-200">
                <td class="whitespace-nowrap py-4 pl-4 pr-4 text-sm font-medium text-gray-900 sm:pl-6">Utilidad Mensual
                </td>
                <td><span class="font-fold text-[17px] text-green-600">$</span><span
                        class="whitespace-nowrap text-sm text-gray-500" id="calcularUtilidadMensual"
                        name="calcularUtilidadMensual"></span></td>
            </tr>
            <tr class="divide-x divide-gray-200">
                <td class="whitespace-nowrap py-4 pl-4 pr-4 text-sm font-medium text-gray-900 sm:pl-6">Costo Por Día
                </td>
                <td><span class="font-fold text-[17px] text-green-600">$</span><span
                        class="whitespace-nowrap text-sm text-red-500" id="calcularCostoPorDia"
                        name="calcularCostoPorDia"></span></td>
            </tr>
            <tr class="divide-x divide-gray-200">
                <td class="whitespace-nowrap py-4 pl-4 pr-4 text-sm font-medium text-gray-900 sm:pl-6">Costo Por Año
                </td>
                <td><span class="font-fold text-[17px] text-green-600">$</span><span
                        class="whitespace-nowrap text-sm text-red-500" id="calcularCostoPorAnio"
                        name="calcularCostoPorAnio"></span></td>
            </tr>
            <tr class="divide-x divide-gray-200">
                <td class="whitespace-nowrap py-4 pl-4 pr-4 text-sm font-medium text-gray-900 sm:pl-6">AÑO 4
                </td>
                <td><span class="font-fold text-[17px] text-green-600">$</span><span
                        class="whitespace-nowrap text-sm text-blue-500" id="calcularAnioCuatro"
                        name="calcularAnioCuatro"></span></td>
            </tr>
        </tbody>
    </table>
</h3>

<script>
    const calcularValorRealConGastos = document.getElementById('calcularValorRealConGastos');
    const calcularValorComercialConGastos = document.getElementById('calcularValorComercialConGastos');
    const inputRentaMensual = document.getElementById('inputRentaMensual');
    const calcularRentaMensual = document.getElementById('calcularRentaMensual');
    const calcularUtilidadMensual = document.getElementById('calcularUtilidadMensual');
    const calcularCostoPorDia = document.getElementById('calcularCostoPorDia');
    const calcularCostoPorAnio = document.getElementById('calcularCostoPorAnio');
    const calcularAnioCuatro = document.getElementById('calcularAnioCuatro');

    //Calculo del valor del equipo actual con gastos fijos
    let valorRealActual =
        {{ $Data['equipment']['precioEquipo'] + $Data['equipment']->sum_gastos_fijos }};
    let valorReal = valorRealActual / 0.85;
    calcularValorRealConGastos.innerText = precioFormatter(valorReal);

    //Calculo del valor comercial del equipo con gastos fijos
    let valorComercialActual = {{ $Data['equipment']['precioEquipoActual'] + $Data['equipment']->sum_gastos_fijos }}
    let valorComercial = valorComercialActual / 0.85;
    calcularValorComercialConGastos.innerText = precioFormatter(valorComercial);

    //Calculo de la renta con valor prefijo a %25
    inputRentaMensual.addEventListener('input', function() {
        calculadoraRentaMensual();
        calcularDatosATabla();
    });

    function calculadoraRentaMensual() {
        if (inputRentaMensual.value < 0)
            inputRentaMensual.value = "";
        else {
            let rentaPorcentajeAdicional = (inputRentaMensual.value) / 100 + 1;
            let valorRentaMensual = {{ $Data['equipment']->sum_gastos_mensuales }} * rentaPorcentajeAdicional;
            calcularRentaMensual.innerText = precioFormatter(valorRentaMensual);
        }
    }

    //Calculo para los datos de la tabla
    function calcularDatosATabla() {
        if (inputRentaMensual.value < 0) {
            calcularUtilidadMensual.value = "";
            calcularCostoPorAnio.value = "";
        } else {
            let rentaPorcentajeAdicional = (inputRentaMensual.value) / 100 + 1;
            let valorRentaMensual = {{ $Data['equipment']->sum_gastos_mensuales }} * rentaPorcentajeAdicional;
            let valorUtilidadMensual = valorRentaMensual - {{ $Data['equipment']->sum_gastos_mensuales }};
            let valorCostoPorDia = {{ $Data['equipment']->sum_gastos_mensuales }} / 30;
            let valorCostoPorAnio = valorCostoPorDia * 365;
            let valorAnioCuatro = {{ $Data['equipment']['precioEquipo'] + $Data['equipment']->sum_gastos_fijos }} /
                0.7;
            calcularUtilidadMensual.innerText = precioFormatter(valorUtilidadMensual);
            calcularCostoPorDia.innerText = precioFormatter(valorCostoPorDia);
            calcularCostoPorAnio.innerText = precioFormatter(valorCostoPorAnio);
            calcularAnioCuatro.innerText = precioFormatter(valorAnioCuatro);
        }
    }
    //El DOOM es para inicializar algunas instrucciones en especifico cuando se carga el contenido de la pagina
    document.addEventListener('DOMContentLoaded', function() {
        calculadoraRentaMensual();
        calcularDatosATabla();
    });

    //Funciones dedicadas
    function precioFormatter(Precio) {
        const formattedPrice = (Number(Precio)).toLocaleString('es-MX', {
            style: 'currency',
            currency: 'MXN',
        });
        return formattedPrice.replace('$', '');
    }
</script>
