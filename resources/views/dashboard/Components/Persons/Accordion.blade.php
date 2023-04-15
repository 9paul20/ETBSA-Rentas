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

    @include('Dashboard.Components.Persons.ComTel.Table')

    @include('Dashboard.Components.Persons.Nacionalidad.Table')

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
