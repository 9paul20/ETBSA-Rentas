@extends('layout')

@push('styles')
    <link rel="stylesheet"
        href="https://horizon-tailwind-react-git-tailwind-components-horizon-ui.vercel.app/static/css/main.ad49aa9b.css" />

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

@section('content')
    <!-- component -->
    <!-- This is an example component -->
    <div
        class='flex items-center justify-center min-h-screen from-[#F9F5E0] via-[#F9F5D0] to-[#F9F5C0] bg-gradient-to-br px-2 py-5'>

        @include('Dashboard.Components.Equipments.Show.Tractor')

        @include('Dashboard.Components.Equipments.Show.Services')
    </div>
@endsection

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
                    header.parentElement.classList.remove("bg-orange-50");
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
                    header.parentElement.classList.add("bg-orange-50");
                } else {
                    accordionContent.style.maxHeight = `0px`;
                    icon.classList.add("fa-angle-down");
                    icon.classList.remove("fa-angle-up");
                    header.parentElement.classList.remove("bg-orange-50");
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
    </script>
@endpush
