<template>
    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Equipment Information</h3>
                    <p class="mt-1 text-sm text-gray-600">Use a permanent address where you can receive mail.</p>
                </div>
            </div>
            <div class="mt-5 md:col-span-2 md:mt-0" v-if="show">
                <form method="POST" @submit.prevent="post">
                    <div class="overflow-hidden shadow sm:rounded-md">
                        <div class="bg-white px-4 py-5 sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-6">
                                    <!-- <label>{{ errors.noSerieEquipo[0] }}</label> -->
                                    <!-- <label>{{ errors }}</label> -->
                                </div>
                                <div class="col-span-6 sm:col-span-6">
                                    <label for="noSerieEquipo" class="block text-sm font-medium text-gray-700">No. Serie
                                        Del
                                        Equipo</label>
                                    <div class="relative mt-1 rounded-md shadow-sm">
                                        <input type="text" autocomplete="given-noSerieEquipo" :class="[
                                            'mt-1 block w-full rounded-md ',
                                            errors.noSerieEquipo ? 'border-red-300' : 'border-gray-300',
                                            ' shadow-sm ',
                                            errors.noSerieEquipo ? 'focus:border-red-500' : 'focus:border-green-500',
                                            ' ',
                                            errors.noSerieEquipo ? 'focus:ring-red-500' : 'focus:ring-green-500',
                                            ' sm:text-sm'
                                        ]" aria-invalid="true" aria-describedby="noSerieEquipo-error"
                                            v-model="equipment.noSerieEquipo" autofocus />
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3"
                                            v-if="errors.noSerieEquipo">
                                            <ExclamationCircleIcon class="h-5 w-5 text-red-500" aria-hidden="true" />
                                        </div>
                                    </div>
                                    <div v-if="errors.noSerieEquipo">
                                        <ul>
                                            <li class="mt-2 text-sm text-red-600" id="noSerieEquipo-error"
                                                v-for="error in errors.noSerieEquipo" :key="error">{{ error }}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-span-6 sm:col-span-6">
                                    <label for="noSerieEquipo" class="block text-sm font-medium text-gray-700">No. Serie
                                        Del
                                        Motor</label>
                                    <div class="relative mt-1 rounded-md shadow-sm">
                                        <input type="text" autocomplete="given-noSerieMotor" :class="[
                                            'mt-1 block w-full rounded-md ',
                                            errors.noSerieMotor ? 'border-red-300' : 'border-gray-300',
                                            ' shadow-sm ',
                                            errors.noSerieMotor ? 'focus:border-red-500' : 'focus:border-green-500',
                                            ' ',
                                            errors.noSerieMotor ? 'focus:ring-red-500' : 'focus:ring-green-500',
                                            ' sm:text-sm'
                                        ]" aria-invalid="true" aria-describedby="noSerieMotor-error"
                                            v-model="equipment.noSerieMotor" autofocus />
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3"
                                            v-if="errors.noSerieMotor">
                                            <ExclamationCircleIcon class="h-5 w-5 text-red-500" aria-hidden="true" />
                                        </div>
                                    </div>
                                    <div v-if="errors.noSerieMotor">
                                        <ul>
                                            <li class="mt-2 text-sm text-red-600" id="noSerieMotor-error"
                                                v-for="error in errors.noSerieMotor" :key="error">{{ error }}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-span-6 sm:col-span-6">
                                    <label for="noEconomico" class="block text-sm font-medium text-gray-700">No.
                                        Económico</label>
                                    <div class="relative mt-1 rounded-md shadow-sm">
                                        <input type="text" autocomplete="given-noEconomico" :class="[
                                            'mt-1 block w-full rounded-md ',
                                            errors.noEconomico ? 'border-red-300' : 'border-gray-300',
                                            ' shadow-sm ',
                                            errors.noEconomico ? 'focus:border-red-500' : 'focus:border-green-500',
                                            ' ',
                                            errors.noEconomico ? 'focus:ring-red-500' : 'focus:ring-green-500',
                                            ' sm:text-sm'
                                        ]" aria-invalid="true" aria-describedby="noEconomico-error"
                                            v-model="equipment.noEconomico" autofocus />
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3"
                                            v-if="errors.noEconomico">
                                            <ExclamationCircleIcon class="h-5 w-5 text-red-500" aria-hidden="true" />
                                        </div>
                                    </div>
                                    <div v-if="errors.noEconomico">
                                        <ul>
                                            <li class="mt-2 text-sm text-red-600" id="noEconomico-error"
                                                v-for="error in errors.noEconomico" :key="error">{{ error }}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-span-6 sm:col-span-6">
                                    <label for="modelo" class="block text-sm font-medium text-gray-700">Modelo</label>
                                    <div class="relative mt-1 rounded-md shadow-sm">
                                        <input type="text" autocomplete="given-modelo" :class="[
                                            'mt-1 block w-full rounded-md ',
                                            errors.modelo ? 'border-red-300' : 'border-gray-300',
                                            ' shadow-sm ',
                                            errors.modelo ? 'focus:border-red-500' : 'focus:border-green-500',
                                            ' ',
                                            errors.modelo ? 'focus:ring-red-500' : 'focus:ring-green-500',
                                            ' sm:text-sm'
                                        ]" aria-invalid="true" aria-describedby="modelo-error"
                                            v-model="equipment.modelo" autofocus />
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3"
                                            v-if="errors.modelo">
                                            <ExclamationCircleIcon class="h-5 w-5 text-red-500" aria-hidden="true" />
                                        </div>
                                    </div>
                                    <div v-if="errors.modelo">
                                        <ul>
                                            <li class="mt-2 text-sm text-red-600" id="modelo-error"
                                                v-for="error in errors.modelo" :key="error">{{ error }}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-span-6 sm:col-span-6">
                                    <label for="precioEquipo" class="block text-sm font-medium text-gray-700">Precio de
                                        Compra
                                        Del Equipo</label>
                                    <div class="relative mt-1 rounded-md shadow-sm">
                                        <input type="number" pattern="[0-9]+(\.[0-9]+)?" min="0" max="99999999.99"
                                            step="0.01" autocomplete="given-precioEquipo" :class="[
                                                'mt-1 block w-full rounded-md ',
                                                errors.precioEquipo ? 'border-red-300' : 'border-gray-300',
                                                ' shadow-sm ',
                                                errors.precioEquipo ? 'focus:border-red-500' : 'focus:border-green-500',
                                                ' ',
                                                errors.precioEquipo ? 'focus:ring-red-500' : 'focus:ring-green-500',
                                                ' sm:text-sm'
                                            ]" aria-invalid="true" aria-describedby="precioEquipo-error"
                                            v-model="equipment.precioEquipo" autofocus />
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3"
                                            v-if="errors.precioEquipo">
                                            <ExclamationCircleIcon class="h-5 w-5 text-red-500" aria-hidden="true" />
                                        </div>
                                    </div>
                                    <div v-if="errors.precioEquipo">
                                        <ul>
                                            <li class="mt-2 text-sm text-red-600" id="precioEquipo-error"
                                                v-for="error in errors.precioEquipo" :key="error">{{ error }}</li>
                                        </ul>
                                    </div>
                                </div>
                                <listBoxStatusComponent :list="status" @status-selected="onStatusSelected"
                                    :errorsList="errors.clvDisponibilidad" />
                                <input v-model="clvDisponibilidad" class="hidden">
                                <listBoxCategoriesComponent :list="categories" @category-selected="onCategorySelected"
                                    :errorsList="errors.clvCategoria" />
                                <input v-model="clvCategoria" class="hidden">
                                <div class="col-span-6 sm:col-span-6">
                                    <label for="folioEquipo" class="block text-sm font-medium text-gray-700">Folio De
                                        Factura</label>
                                    <div class="relative mt-1 rounded-md shadow-sm">
                                        <input type="text" min="6" max="20" autocomplete="given-folioEquipo" :class="[
                                            'mt-1 block w-full rounded-md ',
                                            errors.folioEquipo ? 'border-red-300' : 'border-gray-300',
                                            ' shadow-sm ',
                                            errors.folioEquipo ? 'focus:border-red-500' : 'focus:border-green-500',
                                            ' ',
                                            errors.folioEquipo ? 'focus:ring-red-500' : 'focus:ring-green-500',
                                            ' sm:text-sm'
                                        ]" aria-invalid="true" aria-describedby="folioEquipo-error"
                                            v-model="equipment.folioEquipo" />
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3"
                                            v-if="errors.folioEquipo">
                                            <ExclamationCircleIcon class="h-5 w-5 text-red-500" aria-hidden="true" />
                                        </div>
                                    </div>
                                    <div v-if="errors.folioEquipo">
                                        <ul>
                                            <li class="mt-2 text-sm text-red-600" id="folioEquipo-error"
                                                v-for="error in errors.folioEquipo" :key="error">{{ error }}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-span-6 sm:col-span-6">
                                    <label for="fechaAdquisicion" class="block text-sm font-medium text-gray-700">Fecha
                                        De
                                        Adquisición</label>
                                    <div class="relative mt-1 rounded-md shadow-sm">
                                        <VueDatePicker v-model="equipment.fechaAdquisicion"
                                            placeholder="Selecciona una fecha" autocomplete="off" :class="[
                                                'mt-1 block w-full rounded-md ',
                                                errors.fechaAdquisicion ? 'border-red-300' : 'border-gray-300',
                                                ' shadow-sm ',
                                                errors.fechaAdquisicion ? 'focus:border-red-300' : 'focus:border-green-500',
                                                ' ',
                                                errors.fechaAdquisicion ? 'focus:ring-red-300' : 'focus:ring-green-500',
                                                ' sm:text-sm'
                                            ]" :max-date="new Date()" :format="datePickerFormat" position="left"
                                            locale="es-MX" cancel-text="Cerrar" select-text="seleccionar"
                                            aria-invalid="true" aria-describedby="fechaAdquisicion-error"
                                            :day-names="['Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa', 'Do']" />
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3"
                                            v-if="errors.fechaAdquisicion">
                                            <ExclamationCircleIcon class="h-5 w-5 text-red-500" aria-hidden="true" />
                                        </div>
                                    </div>
                                    <div v-if="errors.fechaAdquisicion">
                                        <ul>
                                            <li class="mt-2 text-sm text-red-600" id="fechaAdquisicion-error"
                                                v-for="error in errors.fechaAdquisicion" :key="error">{{ error }}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-span-6 sm:col-span-6">
                                    <label for="porDeprAnual" class="block text-sm font-medium text-gray-700">Depreciación
                                        Anual Del Equipo
                                        (Porcentaje)</label>
                                    <div class="relative mt-1 rounded-md shadow-sm">
                                        <input type="number" pattern="[0-9]+(\.[0-9]+)?" min="0" max="100.00" step="0.01"
                                            autocomplete="off" :class="[
                                                'mt-1 block w-full rounded-md ',
                                                errors.porDeprAnual ? 'border-red-300' : 'border-gray-300',
                                                ' shadow-sm ',
                                                errors.porDeprAnual ? 'focus:border-red-500' : 'focus:border-green-500',
                                                ' ',
                                                errors.porDeprAnual ? 'focus:ring-red-500' : 'focus:ring-green-500',
                                                ' sm:text-sm'
                                            ]" aria-invalid="true" aria-describedby="porDeprAnual-error"
                                            placeholder="Porcentaje actual para cada Equipo es del %25"
                                            v-model="equipment.porDeprAnual" autofocus />
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3"
                                            v-if="errors.porDeprAnual">
                                            <ExclamationCircleIcon class="h-5 w-5 text-red-500" aria-hidden="true" />
                                        </div>
                                    </div>
                                    <div v-if="errors.porDeprAnual">
                                        <ul>
                                            <li class="mt-2 text-sm text-red-600" id="porDeprAnual-error"
                                                v-for="error in errors.porDeprAnual" :key="error">{{ error }}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-span-6 sm:col-span-6">
                                    <label for="fechaGarantiaExtendida"
                                        class="block text-sm font-medium text-gray-700">Fecha
                                        De La Garantia Extendida
                                        del Equipo</label>
                                    <div class="relative mt-1 rounded-md shadow-sm">
                                        <VueDatePicker v-model="equipment.fechaGarantiaExtendida"
                                            placeholder="Selecciona una fecha" autocomplete="off" :class="[
                                                'mt-1 block w-full rounded-md ',
                                                errors.fechaGarantiaExtendida ? 'border-red-300' : 'border-gray-300',
                                                ' shadow-sm ',
                                                errors.fechaGarantiaExtendida ? 'focus:border-red-300' : 'focus:border-green-500',
                                                ' ',
                                                errors.fechaGarantiaExtendida ? 'focus:ring-red-300' : 'focus:ring-green-500',
                                                ' sm:text-sm'
                                            ]" :max-date="new Date()" :format="datePickerFormat" position="left"
                                            locale="es-MX" cancel-text="Cerrar" select-text="seleccionar"
                                            aria-invalid="true" aria-describedby="fechaGarantiaExtendida-error"
                                            :day-names="['Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa', 'Do']" />
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3"
                                            v-if="errors.fechaGarantiaExtendida">
                                            <ExclamationCircleIcon class="h-5 w-5 text-red-500" aria-hidden="true" />
                                        </div>
                                    </div>
                                    <div v-if="errors.fechaGarantiaExtendida">
                                        <ul>
                                            <li class="mt-2 text-sm text-red-600" id="fechaGarantiaExtendida-error"
                                                v-for="error in errors.fechaGarantiaExtendida" :key="error">{{ error }}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-span-6 sm:col-span-6">
                                    <label for="descripcion"
                                        class="block text-sm font-medium text-gray-700">Descripción</label>
                                    <div class="relative mt-1 rounded-md shadow-sm">
                                        <textarea rows="3" autocomplete="given-descripcion" :class="[
                                            'mt-1 block w-full rounded-md ',
                                            errors.descripcion ? 'border-red-300' : 'border-gray-300',
                                            ' shadow-sm ',
                                            errors.descripcion ? 'focus:border-red-500' : 'focus:border-green-500',
                                            ' ',
                                            errors.descripcion ? 'focus:ring-red-500' : 'focus:ring-green-500',
                                            ' sm:text-sm'
                                        ]" aria-invalid="true" aria-describedby="descripcion-error"
                                            v-model="equipment.descripcion"></textarea>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3"
                                            v-if="errors.descripcion">
                                            <ExclamationCircleIcon class="h-5 w-5 text-red-500" aria-hidden="true" />
                                        </div>
                                    </div>
                                    <div v-if="errors.descripcion">
                                        <ul>
                                            <li class="mt-2 text-sm text-red-600" id="descripcion-error"
                                                v-for="error in errors.descripcion" :key="error">{{ error }}</li>
                                        </ul>
                                    </div>
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
import { ref, onMounted } from 'vue';
import buttonComponent from '@/js/components/Common/button.vue';
import listBoxStatusComponent from '@/js/components/Equipments/listBoxStatus.vue';
import listBoxCategoriesComponent from '@/js/components/Equipments/listBoxCategories.vue';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';
import { ExclamationCircleIcon } from '@heroicons/vue/20/solid';
import { equipments } from '@/js/store/Admin/Equipments.js';

const { datePickerFormat, formatDate, equipment, errors, getStatus, getCategories, clvs, post } = equipments();
const categories = ref([]);
const status = ref([]);
let show = ref(false);
const clvDisponibilidad = ref(null);
const clvCategoria = ref(null);

defineProps({
    routeTitle: {
        type: String,
        required: false,
        default: '',
    },
});

onMounted(async () => {
    categories.value = await getCategories();
    status.value = await getStatus();
    show.value = !show.value;
});

const onStatusSelected = (status) => {
    clvDisponibilidad.value = status.clvDisponibilidad;
    clvs(clvDisponibilidad.value, clvCategoria.value);
};
const onCategorySelected = (category) => {
    clvCategoria.value = category.clvCategoria;
    clvs(clvDisponibilidad.value, clvCategoria.value);
};
</script>

<script>
export default {
    name: 'createEquipmentFormComponent',
}
</script>

<style lang="scss">
@import url(public/css/datePicker.css);
</style>