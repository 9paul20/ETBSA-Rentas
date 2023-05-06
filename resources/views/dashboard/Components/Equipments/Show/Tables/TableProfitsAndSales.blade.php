<div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center text-center py-2">
        <div class="sm:flex-auto">
            <h1 class="text-xl font-semibold text-gray-900">Acumulado De Gastos Mensuales</h1>
            <p class="mt-2 text-sm text-gray-700">Tabla de Gastos Mensuales y sugerencia de precio para venta del equipo.
            </p>
            <p class="mt-2 text-sm text-gray-700">NOTA: El precio Total Del Equipo (Precio Del Equipo más Gastos Fijos
                más Gastos Variales) es de <span class="text-green-500 font-bold text-grey-darker">$</span><span
                    class="font-semibold">{{ number_format($Data['equipment']->costoBase, 2) }}.</span>
            </p>
        </div>
    </div>
    <div class="mt-8 flex flex-col">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8"
                style="max-height: 610px; overflow-y: auto;">
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                            <tr class="divide-x divide-gray-200">
                                <th scope="col"
                                    class="px-3 py-3 text-center text-sm font-semibold text-gray-900 sm:pl-6">
                                    Mes
                                </th>
                                <th scope="col" class="px-3 py-3 text-center text-sm font-semibold text-gray-900">
                                    Gastos Mensuales<br>Acumulados
                                    <p class="text-xs text-gray-500 font-normal">(Gasto Mensual Actual)<br><span
                                            class="font-semibold text-green-600">$</span><span
                                            class="font-semibold">{{ number_format($Data['equipment']->sumGastosMensuales, 2) }}</span>
                                    </p>
                                </th>
                                <th scope="col" class="px-3 py-3 text-center text-sm font-semibold text-gray-900">
                                    Renta Mensual<br>Acumulada
                                    <div class="flex flex-row col-span-6 sm:col-span-6">
                                        <span
                                            class="flex items-center bg-grey-lighter text-green-500 rounded rounded-r-none px-3 font-bold text-grey-darker">%</span>
                                        <input type="number" name="porRentaMensual" id="porRentaMensual"
                                            autocomplete="given-porRentaMensual" step="0.01" min="0.00"
                                            max="1.00" pattern="[0-9]+(\.[0-9]+)?"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm"
                                            value="25.00" oninput="calcularRentaMensual()">
                                    </div>
                                </th>
                                <th scope="col"
                                    class="px-3 py-3 text-center text-sm font-semibold text-gray-900 sm:pr-6">
                                    Utilidad
                                    <p class="text-xs text-gray-500 font-normal">(Renta Mensual Menos <br>Gasto Mensual)
                                    </p>
                                </th>
                                <th scope="col" class="px-3 py-3 text-center text-sm font-semibold text-gray-900">
                                    Venta Del<br>Equipo
                                    <div class="flex flex-row col-span-6 sm:col-span-6">
                                        <span
                                            class="flex items-center bg-grey-lighter text-green-500 rounded rounded-r-none px-3 font-bold text-grey-darker">%</span>
                                        <input type="number" name="porVentaEquipo" id="porVentaEquipo"
                                            autocomplete="given-porVentaEquipo" step="0.01" min="0.00"
                                            max="1.00" pattern="[0-9]+(\.[0-9]+)?"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('porVentaEquipo') border-red-400 @enderror"
                                            value="30.00" oninput="calcularRentaMensual()">
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white text-center">
                            @for ($i = 1; $i <= $Data['equipment']->tiempoAmortizacionMeses; $i++)
                                <tr class="divide-x divide-gray-200 hover:bg-gray-100">
                                    @if ($i % 12 == 0)
                                        <td id="noMes_{{ $i }}"
                                            class="whitespace-nowrap px-3 py-3 text-sm font-bold text-gray-900 sm:pl-6">
                                            {{-- Primer TD --}}
                                            {{ $i }}</td>
                                    @else
                                        <td id="noMes_{{ $i }}"
                                            class="whitespace-nowrap px-3 py-3 text-sm font-medium text-gray-900 sm:pl-6">
                                            {{-- Primer TD --}}
                                            {{ $i }}</td>
                                    @endif
                                    <td class="whitespace-nowrap px-3 py-3 text-sm text-gray-500">{{-- Segundo TD --}}
                                        <span class="font-medium text-green-600">$</span>
                                        {{ number_format($Data['equipment']->sumGastosMensuales * $i, 2) }}
                                    </td>
                                    <td id="tdRentaMensualAcumulada"
                                        class="whitespace-nowrap px-3 py-3 text-sm text-yellow-500">
                                        {{-- Tercer TD --}}
                                    </td>
                                    <td id="tdUtilidadEquipo_{{ $i }}"
                                        class="whitespace-nowrap px-3 py-3 text-sm text-gray-500 font-semibold pl-4 pr-4 sm:pr-6">
                                        {{-- Cuarto TD --}}
                                    </td>
                                    <td id="tdVentaEquipo_{{ $i }}"
                                        class="whitespace-nowrap px-3 py-3 text-sm text-gray-500 font-semibold pl-4 pr-4 sm:pr-6">
                                        {{-- Quinto TD --}}
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        const gastosMensuales = {{ $Data['equipment']->sumGastosMensuales }};
        const gastosMensualesJSON = <?= json_encode($Data['equipment']->sumGastosMensuales) ?>;

        function calcularRentaMensual() {
            let inputRentaMensual = document.getElementById("porRentaMensual").value;
            let inputVentaEquipo = document.getElementById("porVentaEquipo").value;
            let tdList = document.querySelectorAll("#tdRentaMensualAcumulada");
            let precioEquipoScript = {{ $Data['equipment']['precioEquipo'] }};
            let equipoRecuperado = false;
            let equipoRecuperado2 = false;
            let equipoRecuperado3 = false;
            let i = 1;

            tdList.forEach(function(td) {
                //Calculos
                const rentaMensual = gastosMensuales * i * (1 + inputRentaMensual / 100);
                const tdNoMes = document.querySelector(`#noMes_${i}`);
                const tdUtilidadEquipo = document.querySelector(`#tdUtilidadEquipo_${i}`);
                const tdVentaEquipo = document.querySelector(`#tdVentaEquipo_${i}`);
                const utilidadEquipo = rentaMensual - (gastosMensuales * i);
                const ventaEquipo = ({{ $Data['equipment']->costoBase }} - utilidadEquipo) * (1 +
                    inputVentaEquipo / 100);

                //Formato
                const formattedRentaMensual = rentaMensual.toLocaleString('es-MX', {
                    style: 'decimal',
                    minimumFractionDigits: 2
                });
                const formattedUtilidadEquipo = utilidadEquipo.toLocaleString('es-MX', {
                    style: 'decimal',
                    minimumFractionDigits: 2
                });
                const formattedVentaEquipo = ventaEquipo.toLocaleString('es-MX', {
                    style: 'decimal',
                    minimumFractionDigits: 2
                });

                //InnerHTML para td correspondiente
                td.innerHTML =
                    `<span class="font-medium text-green-600">$</span><span class="text-yellow-500 font-semibold">${formattedRentaMensual}</span>`;
                tdUtilidadEquipo.innerHTML =
                    `<span class="font-medium text-green-600">$</span><span class="text-green-500">${formattedUtilidadEquipo}</span>`;
                tdVentaEquipo.innerHTML =
                    `<span class="font-medium text-green-600">$</span><span class="text-green-500">${formattedVentaEquipo}</span>`;

                //Casos Especificos
                if (rentaMensual >= precioEquipoScript && !equipoRecuperado) {
                    equipoRecuperado = true;
                    if (!tdNoMes.innerHTML.includes(
                            '<p class="text-xs text-gray-500">(Punto De<br>Equilibrio)</p>')) {
                        const existingP = tdNoMes.querySelector("p");
                        if (existingP) {
                            tdNoMes.removeChild(existingP);
                        }
                        tdNoMes.innerHTML +=
                            '<p class="text-xs text-gray-500 font-semibold">(Punto De<br>Equilibrio)</p>';
                    }
                } else {
                    const existingP = tdNoMes.querySelector("p");
                    if (existingP) {
                        tdNoMes.removeChild(existingP);
                    }
                }

                if (rentaMensual >= precioEquipoScript && !equipoRecuperado2) {
                    equipoRecuperado2 = true;
                    if (!tdUtilidadEquipo.innerHTML.includes(
                            '<p class="text-xs text-gray-500">(Mes Para Vender<br>Equipo)</p>')) {
                        const existingUtilidadP = tdUtilidadEquipo.querySelector("p");
                        if (existingUtilidadP) {
                            tdUtilidadEquipo.removeChild(existingUtilidadP);
                        }
                        tdUtilidadEquipo.innerHTML +=
                            '<p class="text-xs text-gray-500">(Mes Para Vender<br>Equipo)</p>';
                    }
                } else {
                    const existingUtilidadP = tdUtilidadEquipo.querySelector("p");
                    if (existingUtilidadP) {
                        tdUtilidadEquipo.removeChild(existingUtilidadP);
                    }
                }

                if (rentaMensual >= precioEquipoScript && !equipoRecuperado3) {
                    equipoRecuperado3 = true;
                    if (!tdVentaEquipo.innerHTML.includes(
                            '<p class="text-xs text-gray-500">(Precio Sugerido<br>Para Vender)</p>')) {
                        const existingVentaEquipo = tdVentaEquipo.querySelector("p");
                        if (existingVentaEquipo) {
                            tdVentaEquipo.removeChild(existingVentaEquipo);
                        }
                        tdVentaEquipo.innerHTML +=
                            '<p class="text-xs text-gray-500">(Precio Sugerido<br>Para Vender)</p>';
                    }
                } else {
                    const existingVentaEquipo = tdVentaEquipo.querySelector("p");
                    if (existingVentaEquipo) {
                        tdVentaEquipo.removeChild(existingVentaEquipo);
                    }
                }

                i++;
            });
        }
        document.addEventListener("DOMContentLoaded", function() {
            calcularRentaMensual();
        });
    </script>
@endpush
