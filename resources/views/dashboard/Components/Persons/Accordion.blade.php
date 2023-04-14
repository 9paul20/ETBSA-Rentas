@push('styles')
    <style>
        .accordion-content {
            transition: max-height 0.2s ease-out, padding 0.2s ease;
        }

        .swal2-container.swal2-center>.swal2-popup {
            background-color: #FFFCF2;
            /* Cambiar a tu color deseado */
        }
    </style>
@endpush

<div class="bg-white p-10 overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
    <h3 class="text-lg font-medium text-gray-800">Administrar Campos adicionales para
        {{ getDashboardNameFromUrlFirst(request()->fullUrl()) }}</h3>
    <p class="text-sm font-light text-gray-600 my-3">
        Agrega, actualiza o elimina los datos que {{ getDashboardNameFromUrlFirst(request()->fullUrl()) }} necesite para
        la funcionalidad de la tabla principal
    </p>

    @include('Dashboard.Components.Divisor')

    <!-- Compañias Telefónicas -->
    <div class="transition hover:bg-indigo-50 overflow-hidden rounded-lg p-2 mb-2">
        <!-- header -->
        <div class="accordion-header cursor-pointer transition flex space-x-5 px-5 items-center h-16">
            <i class="fas fa-angle-down"></i>
            <h3>Compañias Telefónicas</h3>
        </div>
        <!-- Content -->
        <div class="accordion-content px-2 pt-0 overflow-hidden max-h-0 mb-2">
            <div class="bg-white rounded-lg border px-4 sm:px-6 lg:px-8 py-6">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h1 class="text-xl font-semibold text-gray-900">Compañias Telefónicas</h1>
                    </div>
                    <x-Dashboard.Persons.ComTel.Button-Create-Modal text="Añadir Compañia Telefónica"
                        action="{{ route('Dashboard.Admin.Persons.ComTel.Store') }}" />
                </div>
                @if (count($Data['tableComTels']['columnComTels']) > 0)
                    <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
                        <div class="relative text-gray-600 py-1">
                            <input type="search" name="serch" placeholder="Realizar Busqueda"
                                class="bg-white h-10 px-5 pr-4 rounded-full text-sm focus:outline-none">
                        </div>
                        <table
                            class="min-w-full border-collapse bg-white text-left text-sm text-gray-500 divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    @foreach ($Data['tableComTels']['columnComTels'] as $columnComTel)
                                        <th scope="col"
                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                            {{ $columnComTel }}
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 border-t  bg-white">
                                @foreach ($Data['tableComTels']['rowComTels'] as $rowComTel)
                                    <tr class="hover:bg-gray-100">
                                        <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                                            <div class="text-sm">
                                                <div class="font-medium text-gray-700">
                                                    {{ $rowComTel->companiaTelefonica }}
                                                </div>
                                            </div>
                                        </th>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            <div class="text-gray-700 truncate break-words max-w-sm">
                                                {{ $rowComTel->descripcion }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex justify-end gap-4">
                                                <x-Dashboard.IconButton-Show_SA id="comtel_{{ $rowComTel->clvComTel }}"
                                                    name="{{ $rowComTel->companiaTelefonica }}"
                                                    description="{{ $rowComTel->descripcion }}" href="" />
                                                <x-Dashboard.Persons.ComTel.Button-Edit-Modal
                                                    id="comtel_{{ $rowComTel->clvComTel }}"
                                                    companiaTelefonica="{{ $rowComTel->companiaTelefonica }}"
                                                    descripcion="{{ $rowComTel->descripcion }}"
                                                    href="{{ route('Dashboard.Admin.Persons.ComTel.Update', $rowComTel->clvComTel) }}" />
                                                <x-Dashboard.IconButton-Delete id="comtel_{{ $rowComTel->clvComTel }}"
                                                    name="{{ $rowComTel->companiaTelefonica }}"
                                                    href="{{ route('Dashboard.Admin.Persons.ComTel.Destroy', $rowComTel->clvComTel) }}" />
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $Data['tableComTels']['rowComTels']->appends(['comtels_page' => $Data['tableComTels']['rowComTels']->currentPage()])->links('vendor.pagination.tailwind') }}
                    </div>
                @else
                    <main class="flex items-center justify-center flex-1 px-4 py-8">
                        <!-- Content -->
                        <h1 class="text-5xl font-bold text-gray-500">No hay datos de Compañias Telefónicas</h1>
                    </main>
                @endif
            </div>
        </div>
    </div>

    <!-- Nacionalidades -->
    <div class="transition hover:bg-indigo-50 overflow-hidden rounded-lg p-2 mb-2">
        <!-- header -->
        <div class="accordion-header cursor-pointer transition flex space-x-5 px-5 items-center h-16">
            <i class="fas fa-angle-down"></i>
            <h3>Nacionalidades</h3>
        </div>
        <!-- Content -->
        <div class="accordion-content px-2 pt-0 overflow-hidden max-h-0 mb-2">
            <div class="bg-white rounded-lg border px-4 sm:px-6 lg:px-8 py-6">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h1 class="text-xl font-semibold text-gray-900">Compañias Telefónicas</h1>
                    </div>
                    <x-Dashboard.Persons.Nacionalidad.Button-Create-Modal text="Añadir Nacionalidades"
                        action="{{ route('Dashboard.Admin.Persons.Nacionalidad.Store') }}" />
                </div>
                @if (count($Data['tableNacionalidades']['rowNacionalidades']) > 0)
                    <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
                        <div class="relative text-gray-600 py-1">
                            <input type="search" name="serch" placeholder="Realizar Busqueda"
                                class="bg-white h-10 px-5 pr-4 rounded-full text-sm focus:outline-none">
                        </div>
                        <table
                            class="min-w-full border-collapse bg-white text-left text-sm text-gray-500 divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    @foreach ($Data['tableNacionalidades']['columnNacionalidades'] as $columnNacionalidad)
                                        <th scope="col"
                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                            {{ $columnNacionalidad }}
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 border-t  bg-white">
                                @foreach ($Data['tableNacionalidades']['rowNacionalidades'] as $rowNacionalidad)
                                    <tr class="hover:bg-gray-100">
                                        <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                                            <div class="text-sm">
                                                <div class="font-medium text-gray-700">
                                                    {{ $rowNacionalidad->nacionalidad }}
                                                </div>
                                            </div>
                                        </th>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            <div class="text-gray-700 truncate break-words max-w-sm">
                                                {{ $rowNacionalidad->descripcion }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex justify-end gap-4">
                                                <x-Dashboard.IconButton-Show_SA
                                                    id="nacionalidad_{{ $rowNacionalidad->clvNacionalidad }}"
                                                    name="{{ $rowNacionalidad->nacionalidad }}"
                                                    description="{{ $rowNacionalidad->descripcion }}" href="#" />
                                                <x-Dashboard.Persons.Nacionalidad.Button-Edit-Modal
                                                    id="nacionalidad_{{ $rowNacionalidad->clvNacionalidad }}"
                                                    nacionalidad="{{ $rowNacionalidad->nacionalidad }}"
                                                    descripcion="{{ $rowNacionalidad->descripcion }}"
                                                    href="{{ route('Dashboard.Admin.Persons.Nacionalidad.Update', $rowNacionalidad->clvNacionalidad) }}" />
                                                <x-Dashboard.IconButton-Delete
                                                    id="nacionalidad_{{ $rowNacionalidad->clvNacionalidad }}"
                                                    name="{{ $rowNacionalidad->nacionalidad }}"
                                                    href="{{ route('Dashboard.Admin.Persons.Nacionalidad.Destroy', $rowNacionalidad->clvNacionalidad) }}" />
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $Data['tableNacionalidades']['rowNacionalidades']->appends(['nacionalidades_page' => $Data['tableNacionalidades']['rowNacionalidades']->currentPage()])->links('vendor.pagination.tailwind') }}
                    </div>
                @else
                    <main class="flex items-center justify-center flex-1 px-4 py-8">
                        <!-- Content -->
                        <h1 class="text-5xl font-bold text-gray-500">No hay datos de Nacionalidades</h1>
                    </main>
                @endif
            </div>
        </div>
    </div>

    {{-- <!-- Extra -->
    <div class="transition hover:bg-indigo-50 overflow-hidden rounded-lg p-2 mb-2">
        <!-- header -->
        <div class="accordion-header cursor-pointer transition flex space-x-5 px-5 items-center h-16">
            <i class="fas fa-angle-down"></i>
            <h3>How can it be defined?</h3>
        </div>
        <!-- Content -->
        <div class="accordion-content px-2 pt-0 overflow-hidden max-h-0 mb-2">
            <p class="leading-6 font-light pl-9 text-justify">
                Our asked sex point her she seems. New plenty she horses parish design you. Stuff sight equal of
                my woody. Him children bringing goodness suitable she entirely put
                far daughter.
            </p>
            <button class="rounded-full bg-indigo-600 text-white font-medium font-lg px-6 py-2 my-5 ml-9">Learn
                more</button>
        </div>
    </div> --}}
</div>

@push('scripts')
    <script>
        // Obtener el último acordeón abierto del almacenamiento local
        const lastAccordionIndex = localStorage.getItem('lastAccordionIndex');

        // Obtener todos los encabezados de los acordeones
        const accordionHeader = document.querySelectorAll(".accordion-header");

        // Función para cerrar todos los acordeones excepto uno específico
        function closeAllAccordionsExcept(index) {
            accordionHeader.forEach((header, i) => {
                if (i !== index) {
                    const content = header.parentElement.querySelector(".accordion-content");
                    content.style.maxHeight = `0px`;
                    header.querySelector(".fas").classList.add("fa-angle-down");
                    header.querySelector(".fas").classList.remove("fa-angle-up");
                    header.parentElement.classList.remove("bg-indigo-50");
                }
            });
        }

        // Agregar evento de clic a cada encabezado de acordeón
        accordionHeader.forEach((header, index) => {
            header.addEventListener("click", function() {
                const accordionContent = header.parentElement.querySelector(".accordion-content");
                let accordionMaxHeight = accordionContent.style.maxHeight;
                const icon = header.querySelector(".fas");

                // Cerrar todos los acordeones excepto el que se ha clicado
                closeAllAccordionsExcept(index);

                // Condición de manejo
                if (accordionMaxHeight == "0px" || accordionMaxHeight.length == 0) {
                    accordionContent.style.maxHeight = `${accordionContent.scrollHeight + 32}px`;
                    icon.classList.remove("fa-angle-down");
                    icon.classList.add("fa-angle-up");
                    header.parentElement.classList.add("bg-indigo-50");
                } else {
                    accordionContent.style.maxHeight = `0px`;
                    icon.classList.add("fa-angle-down");
                    icon.classList.remove("fa-angle-up");
                    header.parentElement.classList.remove("bg-indigo-50");
                }

                // Guardar el índice del acordeón abierto en el almacenamiento local
                localStorage.setItem('lastAccordionIndex', index);

                // Aplicar animación de 0.2 segundos para enderezar el icono cuando se guarda un acordeón
                setTimeout(() => {
                    icon.style.transition = "transform 0.5s";
                    icon.style.transform = "";
                }, 500);
            });

            // Abrir el último acordeón abierto
            if (lastAccordionIndex === `${index}`) {
                header.click();
            }
        });

        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('click', () => {
                const errorDiv = input.nextElementSibling;
                if (errorDiv && errorDiv.classList.contains('text-red-400')) {
                    errorDiv.style.opacity = '0';
                    errorDiv.style.transition =
                        'opacity 0.5s ease-in-out';
                    setTimeout(() => {
                            errorDiv.style.display = 'none';
                        },
                        500
                    );
                }
            });
        });
    </script>
@endpush
