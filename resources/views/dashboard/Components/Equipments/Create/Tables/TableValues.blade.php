<div
    class="flex flex-col items-start justify-center rounded-2xl bg-white bg-clip-border px-1 py-1 shadow-3xl shadow-shadow-500 dark:!bg-navy-700 dark:shadow-none">
    <div class="table-auto">
        <table class="table-auto">
            <tbody>
                <tr>
                    <td class="px-1 py text-lg font-medium leading-6 text-gray-600">Precio del Equipo</td>
                    <td class="px-1 py text-lg font-medium leading-6 text-gray-600">
                        <div class='flex flex-row'>
                            <p class='text-[17px] font-bold text-[#0FB478]'>$</p>
                            <p class='text-[#3C3C4399] text-[17px] mr-2'>
                                {{ number_format($Data['equipment']['precioEquipo'], 2) }}</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="px-1 py text-lg font-medium leading-6 text-gray-600">Total de Gastos Fijos del Equipo
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
                    <td class="px-1 py text-lg font-medium leading-6 text-gray-600">Total de Gastos Variables del Equipo
                    </td>
                    <td class="px-1 py text-lg font-medium leading-6 text-gray-600">
                        <div class='flex flex-row'>
                            <p class='text-[17px] font-bold text-[#0FB478]'>$</p>
                            <p class='text-[#3C3C4399] text-[17px] mr-2'>
                                {{ number_format($Data['equipment']->sum_gastos_variables, 2) }}</p>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@include('Dashboard.Components.Divisor')

<h3 class="text-lg font-medium leading-6 text-gray-900">Total: <span
        class="font-fold text-[17px] text-green-600">$</span>
    {{ number_format($Data['equipment']->costo_base, 2) }}
</h3>
