<div class='w-full max-w-md mx-auto bg-green-50 rounded-3xl shadow-xl overflow-hidden grid'>
    <div class='h-[236px]'
        style='background-image:url(https://agevolution.canalrural.com.br/wp-content/uploads/2021/07/john-deere-5g-1024x576.jpeg);background-size:cover;background-position:center'>
    </div>
    <div class='p-4 sm:p-6'>
        <p class='font-bold text-gray-700 text-[22px] leading-7 mb-1'>{{ $Data['equipment']['modelo'] }} -
            {{ $Data['equipment']['noSerieEquipo'] }}</p>
        <div class='flex flex-row'>
            <p class='text-[17px] font-bold text-[#0FB478]'>$</p>
            <p class='text-[#3C3C4399] text-[17px] mr-2'>{{ $Data['equipment']['precioEquipo'] }}</p>
        </div>
        <p class='text-[#7C7C80] font-[15px] mt-6'>{{ $Data['equipment']['descripcion'] }}</p>
        <div class="grid grid-cols-1 gap-4 px-2 py-4 w-full">
            <div
                class="flex flex-col items-start justify-center rounded-2xl bg-white bg-clip-border px-3 py-4 shadow-3xl shadow-shadow-500 dark:!bg-navy-700 dark:shadow-none">
                <p class="text-sm text-gray-600">Categoria</p>
                <p class="text-base font-medium text-navy-700 dark:text-white">
                    {{ $Data['equipment']->categoria->categoria }}
                </p>
            </div>
            <div
                class="flex flex-col items-start justify-center rounded-2xl bg-white bg-clip-border px-3 py-4 shadow-3xl shadow-shadow-500 dark:!bg-navy-700 dark:shadow-none">
                <p class="text-sm text-gray-600">Disponibilidad</p>
                <span
                    class="inline-flex items-center gap-1 rounded-full {{ $Data['equipment']->disponibilidad->bgColorPrimary }} px-2 py-1 text-sm font-semibold {{ $Data['equipment']->disponibilidad->textColor }}">
                    <span
                        class="h-1.5 w-1.5 rounded-full {{ $Data['equipment']->disponibilidad->bgColorSecondary }}"></span>
                    {{ $Data['equipment']->disponibilidad->disponibilidad }}
                </span>
            </div>
        </div>
    </div>
    <div
        class="flex flex-col justify-center  bg-white bg-clip-border px-3 py-4 shadow-3xl shadow-shadow-500 dark:!bg-navy-700 dark:shadow-none">
        <div class="bg-white shadow-2xl p-6 rounded-2xl border-2 border-gray-50">
            <div class="flex flex-col">
                <div>
                    <h2 class="font-bold text-gray-600 text-center">Rendimiento</h2>
                </div>
                <div class="my-6">
                    <div class="flex flex-row space-x-4 items-center">
                        <div id="icon">
                            <span>
                                <svg class="w-20 h-20 fill-stroke text-yellow-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 15m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0l0 .01zM19 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0zM10.5 17l6.5 0zM20 15.2v-4.2a1 1 0 0 0 -1 -1h-6l-2 -5h-6v6.5zM18 5h-1a1 1 0 0 0 -1 1v4z">
                                    </path>
                                </svg>
                            </span>
                        </div>
                        <div id="temp">
                            <span class="text-4xl text-[17px] font-bold text-[#0FB478]">$</span>
                            <span class="text-4xl">12000</span>
                            <p class="text-xm text-gray-500">Ganancia de Renta Del equipo Por Mes/Año</p>
                            <p class="text-xs text-gray-500">Precio Fijo(Aun falta por funcionar)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
