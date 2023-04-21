<!-- component -->
<!-- Code block starts -->
<dh-component>
    <div class="py-12 bg-gray-400 transition duration-150 ease-in-out z-10 absolute top-0 right-0 bottom-0 left-0 hidden"
        id="modal">
        <div role="alert" class="container mx-auto w-11/12 md:w-2/3 max-w-lg">
            <form method="POST" action="">
                @csrf
                <div class="relative bg-white shadow-md rounded border border-gray-400">
                    <h1 class="text-gray-800 font-lg font-bold tracking-normal leading-tight mb-4 py-8 text-center">
                        Agregar Detalles del Gasto Variable
                    </h1>
                    <div class="flex flex-col px-6 py-5 ">
                        <p class="mb-2 font-semibold text-gray-700">Gasto Variable</p>
                        <input type="text"
                            class="p-5 mb-5 bg-white border border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 rounded shadow-sm"
                            value="" required autofocus>
                        <p class="mb-2 font-semibold text-gray-700">Descripción</p>
                        <textarea type="text" name="" placeholder="Detalles del Gasto Variado"
                            class="p-5 mb-5 bg-white border border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 rounded shadow-sm h-36"
                            id=""></textarea>
                        {{-- <div class="flex flex-col sm:flex-row items-center mb-5 sm:space-x-5">
                        <div class="w-full sm:w-1/2">
                            <p class="mb-2 font-semibold text-gray-700">Customer Response</p>
                            <select type="text" name=""
                                class="w-full p-5 bg-white border border-gray-200 rounded shadow-sm appearance-none"
                                id="">
                                <option value="0">Add service</option>
                            </select>
                        </div>
                        <div class="w-full sm:w-1/2 mt-2 sm:mt-0">
                            <p class="mb-2 font-semibold text-gray-700">Next step</p>
                            <select type="text" name=""
                                class="w-full p-5 bg-white border border-gray-200 rounded shadow-sm appearance-none"
                                id="">
                                <option value="0">Book Appointment</option>
                            </select>
                        </div>
                        </div> --}}
                    </div>
                    <div class="flex flex-row items-center justify-between p-5 rounded-bl-lg rounded-br-lg bg-gray-100">
                        <button class="px-4 py-2 font-semibold text-white font-semibold bg-orange-500 rounded"
                            onclick="modalHandler()" type="button">Cancel</button>
                        <button class="px-4 py-2 text-white font-semibold bg-indigo-500 rounded" type="submit">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="w-full flex justify-center py-12" id="button">
        <button
            class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 mx-auto transition duration-150 ease-in-out hover:bg-indigo-600 bg-indigo-700 rounded text-white px-4 sm:px-8 py-2 text-xs sm:text-sm"
            onclick="modalHandler(true)">Open Modal</button>
    </div>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        let modal = document.getElementById("modal");

        function modalHandler(val) {
            if (val) {
                fadeIn(modal);
            } else {
                fadeOut(modal);
            }
        }

        function fadeOut(el) {
            el.style.opacity = 1;
            (function fade() {
                if ((el.style.opacity -= 0.1) < 0) {
                    el.style.display = "none";
                } else {
                    requestAnimationFrame(fade);
                }
            })();
        }

        function fadeIn(el, display) {
            el.style.opacity = 0;
            el.style.display = display || "flex";
            (function fade() {
                let val = parseFloat(el.style.opacity);
                if (!((val += 0.2) > 1)) {
                    el.style.opacity = val;
                    requestAnimationFrame(fade);
                }
            })();
        }
    </script>

</dh-component>
<!-- Code block ends -->
