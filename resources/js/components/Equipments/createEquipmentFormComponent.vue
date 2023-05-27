<template>
    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Equipment Information</h3>
                    <p class="mt-1 text-sm text-gray-600">Use a permanent address where you can receive mail.</p>
                    <divisor-component v-if="routeTitle === 'edit'" />
                    <!-- @include('Dashboard.Components.Equipments.Create.Tables.TableValues') -->
                    <span class="text-center font-semibold text-6xl text-black font-semibold"
                        v-if="routeTitle === 'edit'">Se supone que debe mostrarse
                        solamente si está en edit</span>
                </div>
            </div>
            <div class="mt-5 md:col-span-2 md:mt-0">
                <form action="{{ route('Dashboard.Admin.Equipments.Store') }}" method="POST" v-if="routeTitle === 'create'">
                    <div class="overflow-hidden shadow sm:rounded-md">
                        <div class="bg-white px-4 py-5 sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-6">
                                    <label for="noSerieEquipo" class="block text-sm font-medium text-gray-700">No. Serie
                                        Del
                                        Equipo</label>
                                    <input type="text" name="noSerieEquipo" id="noSerieEquipo"
                                        autocomplete="given-noSerieEquipo"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm"
                                        required autofocus>
                                </div>
                                <div class="col-span-6 sm:col-span-6">
                                    <label for="noSerieMotor" class="block text-sm font-medium text-gray-700">No. Serie
                                        Del
                                        Motor</label>
                                    <input type="text" name="noSerieMotor" id="noSerieMotor"
                                        autocomplete="given-noSerieMotor"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm"
                                        required>
                                </div>
                                <div class="col-span-6 sm:col-span-6">
                                    <label for="noEconomico" class="block text-sm font-medium text-gray-700">No.
                                        Económico</label>
                                    <input type="text" name="noEconomico" id="noEconomico" autocomplete="given-noEconomico"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm"
                                        required>
                                </div>
                                <div class="col-span-6 sm:col-span-6">
                                    <label for="modelo" class="block text-sm font-medium text-gray-700">Modelo</label>
                                    <input type="text" name="modelo" id="modelo" autocomplete="given-modelo"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm"
                                        required>
                                </div>
                                <div class="col-span-6 sm:col-span-6">
                                    <label for="precioEquipo" class="block text-sm font-medium text-gray-700">Precio de
                                        Compra
                                        Del Equipo</label>
                                    <input type="number" name="precioEquipo" id="precioEquipo" pattern="[0-9]+(\.[0-9]+)?"
                                        min="0" max="99999999.99" step="0.01" autocomplete="given-precioEquipo"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm"
                                        required>
                                </div>
                                <!-- <div class="col-span-6 sm:col-span-6">
                                <label for="clvDisponibilidad"
                                    class="block text-sm font-medium text-gray-700">Disponibilidad</label>
                                <select id="clvDisponibilidad" name="clvDisponibilidad"
                                    class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-green-500 focus:outline-none focus:ring-green-500 sm:text-sm"
                                    required>
                                    @if (count($Data['status']) > 0)
                                        <option value="" disabled selected>
                                            Seleccione Una Disponibilidad</option>
                                        @foreach ($Data['status'] as $disponibilidad)
                                            <option value="{{ $disponibilidad['clvDisponibilidad'] }}"
                                                @if ($disponibilidad['clvDisponibilidad'] == $Data['equipment']['clvDisponibilidad']) selected @endif>
                                                {{ $disponibilidad['disponibilidad'] }}
                                            </option>
                                        @endforeach
                                    @else
                                        <option value="" disabled selected>
                                            No Hay Opciones De Disponibilidad</option>
                                    @endif
                                </select>
                            </div> -->
                                <!-- <div class="col-span-6 sm:col-span-6">
                                <label for="clvCategoria" class="block text-sm font-medium text-gray-700">Categoria</label>
                                <select id="clvCategoria" name="clvCategoria"
                                    class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-green-500 focus:outline-none focus:ring-green-500 sm:text-sm"
                                    required>
                                    @if (count($Data['categories']) > 0)
                                        <option value="" disabled selected>
                                            Seleccione Una Categoria</option>
                                        @foreach ($Data['categories'] as $category)
                                            <option value="{{ $category['clvCategoria'] }}"
                                                @if ($category['clvCategoria'] == $Data['equipment']['clvCategoria']) selected @endif>
                                                {{ $category['categoria'] }}
                                            </option>
                                        @endforeach
                                    @else
                                        <option value="" disabled selected>
                                            No Hay Opciones De Categoria Disponible</option>
                                    @endif
                                </select>
                            </div> -->
                                <div class="col-span-6 sm:col-span-6">
                                    <label for="folioEquipo" class="block text-sm font-medium text-gray-700">Folio De
                                        Factura</label>
                                    <input type="text" name="folioEquipo" id="folioEquipo" min="6" max="20"
                                        autocomplete="given-folioEquipo"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm"
                                        required>
                                </div>
                                <div class="col-span-6 sm:col-span-6">
                                    <label for="fechaAdquisicion" class="block text-sm font-medium text-gray-700">Fecha
                                        De
                                        Adquisición</label>
                                    <VueDatePicker v-model="fechaAdquisicion" placeholder="Selecciona una fecha"
                                        autocomplete="off"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm"
                                        :max-date="new Date()" :format="datePickerFormat" required position="left"
                                        locale="es-MX" cancel-text="Cerrar" select-text="seleccionar"
                                        :day-names="['Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa', 'Do']" />
                                </div>
                                <div class="col-span-6 sm:col-span-6">
                                    <label for="porDeprAnual" class="block text-sm font-medium text-gray-700">Depreciación
                                        Anual Del Equipo
                                        (Porcentaje)</label>
                                    <input type="number" name="porDeprAnual" id="porDeprAnual" pattern="[0-9]+(\.[0-9]+)?"
                                        min="0" max="100.00" step="0.01" autocomplete="off"
                                        placeholder="Porcentaje actual para cada Equipo es del %25"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm"
                                        required>
                                </div>
                                <div class="col-span-6 sm:col-span-6">
                                    <label for="fechaGarantiaExtendida"
                                        class="block text-sm font-medium text-gray-700">Fecha
                                        De La Garantia Extendida
                                        del Equipo</label>
                                    <VueDatePicker v-model="fechaGarantiaExtendida" :max-date="new Date()"
                                        :format="datePickerFormat" placeholder='Selecciona una fecha' autocomplete="off"
                                        position="left" locale="es-MX" cancel-text="Cerrar" select-text="seleccionar"
                                        :day-names="['Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa', 'Do']" />
                                </div>
                                <div class="col-span-6 sm:col-span-6">
                                    <label for="descripcion"
                                        class="block text-sm font-medium text-gray-700">Descripción</label>
                                    <textarea rows="3" name="descripcion" id="descripcion" autocomplete="given-descripcion"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm"
                                        required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                            <button-component type="submit" text="Guardar Equipo" colorButton="green-600"
                                colorButtonHover="green-700" colorRingFocus="green-600" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import divisorComponent from '@/js/components/Common/divisor.vue';
import buttonComponent from '@/js/components/Common/button.vue';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

const fechaAdquisicion = ref(null);
const fechaGarantiaExtendida = ref(null);
const datePickerFormat = 'dd/MM/yyyy';

const props = defineProps({
    routeTitle: {
        type: String,
        required: false,
        default: '',
    },
});
const modelCreate = ref({
    equipment: {
        noSerieEquipo: '',
        noSerieMotor: '',
        noEconomico: '',
        modelo: '',
        clvDisponibilidad: '',
        clvCategoria: '',
        descripcion: '',
        precioEquipo: '',
        folioEquipo: '',
        fechaAdquisicion: '',
        porDeprAnual: '',
    }
});
</script>

<script>
export default {
    name: 'createEquipmentFormComponent',
}
</script>

<style lang="scss">
@import url(public/css/datePicker.css);
</style>