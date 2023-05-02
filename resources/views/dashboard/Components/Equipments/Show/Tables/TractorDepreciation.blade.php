<div
    class="flex flex-col items-start justify-center rounded-2xl bg-white bg-clip-border px-3 py-4 shadow-3xl shadow-shadow-500 dark:!bg-navy-700 dark:shadow-none">
    <p class="text-sm text-gray-600">Depreciación Del Equipo</p>
    <div class="table-auto">
        <table class="table-auto">
            <tbody>
                <tr>
                    <td class="px-4 py font-semibold">Diaria</td>
                    <td class="px-4 py">
                        <div class='flex flex-row'>
                            <p class='text-[17px] font-bold text-[#0FB478]'>$</p>
                            <p class='text-[#3C3C4399] text-[17px] mr-2'>
                                {{ number_format($Data['equipment']->depreciacionPorDias, 2) }}</p>
                        </div>
                    </td>
                    <td class="text-sm text-gray-600">{{ number_format($Data['equipment']->tiempoAmortizacionDias, 0) }}
                        Día(s)</td>
                </tr>
                <tr>
                    <td class="px-4 py font-semibold">Mensual</td>
                    <td class="px-4 py">
                        <div class='flex flex-row'>
                            <p class='text-[17px] font-bold text-[#0FB478]'>$</p>
                            <p class='text-[#3C3C4399] text-[17px] mr-2'>
                                {{ number_format($Data['equipment']->depreciacionPorMeses, 2) }}</p>
                        </div>
                    </td>
                    <td class="text-sm text-gray-600">{{ number_format($Data['equipment']->tiempoAmortizacionMeses, 0) }}
                        Mes(es)</td>
                </tr>
                <tr>
                    <td class="px-4 py font-semibold">Anual</td>
                    <td class="px-4 py">
                        <div class='flex flex-row'>
                            <p class='text-[17px] font-bold text-[#0FB478]'>$</p>
                            <p class='text-[#3C3C4399] text-[17px] mr-2'>
                                {{ number_format($Data['equipment']->depreciacionPorAnios, 2) }}</p>
                        </div>
                    </td>
                    <td class="text-sm text-gray-600">{{ number_format($Data['equipment']->tiempoAmortizacionAnios, 0) }}
                        Año(s)</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
