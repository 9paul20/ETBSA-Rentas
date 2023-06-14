<template>
    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1"> <!-- Información adicional para el formulario -->
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Equipment Information</h3>
                    <p class="mt-1 text-sm text-gray-600">Lorem ipsum dolor sit amet consectetur adipisicing elit. At
                        laboriosam, iste quasi accusamus voluptatem, rerum molestias aliquam beatae similique, ab ex facere
                        fuga perspiciatis soluta quia veritatis temporibus itaque libero.</p>
                </div>
            </div>
            <Transition name="slide-fade">
                <div class="mt-5 md:col-span-2 md:mt-0" v-if="show">
                    <form method="POST" @submit.prevent="loader.store">
                        <div class="overflow-hidden shadow sm:rounded-md">
                            <div class="bg-white px-1 py-1 sm:p-6">
                                <div class="grid grid-cols-6 gap-2">
                                    <div class="col-span-3 sm:col-span-3"> <!-- Numero serie -->
                                        <div class="relative mt-1 rounded-md shadow-sm">
                                            <label for="noSerieEquipo" class="block text-sm font-medium text-gray-700">No.
                                                Serie
                                                Del
                                                Equipo</label>
                                            <input type="text" autocomplete="given-noSerieEquipo" :class="[
                                                'mt-1 block w-full rounded-md ',
                                                loader.errors.noSerieEquipo ? 'border-red-300' : 'border-gray-300',
                                                ' shadow-sm ',
                                                loader.errors.noSerieEquipo ? 'focus:border-red-500' : 'focus:border-green-500',
                                                ' ',
                                                loader.errors.noSerieEquipo ? 'focus:ring-red-500' : 'focus:ring-green-500',
                                                ' sm:text-sm'
                                            ]" aria-invalid="true" aria-describedby="noSerieEquipo-error"
                                                v-model="loader.equipment.noSerieEquipo" placeholder="No. Serie Del Equipo"
                                                autofocus />
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3"
                                                v-if="loader.errors.noSerieEquipo">
                                                <ExclamationCircleIcon class="h-5 w-5 text-red-500" aria-hidden="true" />
                                            </div>
                                        </div>
                                        <div v-if="loader.errors.noSerieEquipo">
                                            <ul>
                                                <li class="mt-2 text-sm text-red-600" id="noSerieEquipo-error"
                                                    v-for="error in loader.errors.noSerieEquipo" :key="error">{{ error }}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-span-3 sm:col-span-3"> <!-- Numero serie del motor -->
                                        <div class="relative mt-1 rounded-md shadow-sm">
                                            <label for="noSerieMotor" class="block text-sm font-medium text-gray-700">No.
                                                Serie
                                                Del
                                                Motor</label>
                                            <input type="text" autocomplete="given-noSerieMotor" :class="[
                                                'mt-1 block w-full rounded-md ',
                                                loader.errors.noSerieMotor ? 'border-red-300' : 'border-gray-300',
                                                ' shadow-sm ',
                                                loader.errors.noSerieMotor ? 'focus:border-red-500' : 'focus:border-green-500',
                                                ' ',
                                                loader.errors.noSerieMotor ? 'focus:ring-red-500' : 'focus:ring-green-500',
                                                ' sm:text-sm'
                                            ]" aria-invalid="true" aria-describedby="noSerieMotor-error"
                                                v-model="loader.equipment.noSerieMotor" placeholder="No. Serie Del Motor" />
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3"
                                                v-if="loader.errors.noSerieMotor">
                                                <ExclamationCircleIcon class="h-5 w-5 text-red-500" aria-hidden="true" />
                                            </div>
                                        </div>
                                        <div v-if="loader.errors.noSerieMotor">
                                            <ul>
                                                <li class="mt-2 text-sm text-red-600" id="noSerieMotor-error"
                                                    v-for="error in loader.errors.noSerieMotor" :key="error">{{ error }}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-span-3 sm:col-span-3"> <!-- Numero económico -->
                                        <label for="noEconomico" class="block text-sm font-medium text-gray-700">No.
                                            Económico</label>
                                        <div class="relative mt-1 rounded-md shadow-sm">
                                            <input type="text" autocomplete="given-noEconomico" :class="[
                                                'mt-1 block w-full rounded-md ',
                                                loader.errors.noEconomico ? 'border-red-300' : 'border-gray-300',
                                                ' shadow-sm ',
                                                loader.errors.noEconomico ? 'focus:border-red-500' : 'focus:border-green-500',
                                                ' ',
                                                loader.errors.noEconomico ? 'focus:ring-red-500' : 'focus:ring-green-500',
                                                ' sm:text-sm'
                                            ]" aria-invalid="true" aria-describedby="noEconomico-error"
                                                v-model="loader.equipment.noEconomico" placeholder="No. Económico" />
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3"
                                                v-if="loader.errors.noEconomico">
                                                <ExclamationCircleIcon class="h-5 w-5 text-red-500" aria-hidden="true" />
                                            </div>
                                        </div>
                                        <div v-if="loader.errors.noEconomico">
                                            <ul>
                                                <li class="mt-2 text-sm text-red-600" id="noEconomico-error"
                                                    v-for="error in loader.errors.noEconomico" :key="error">{{ error }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-span-3 sm:col-span-3"> <!-- Modelo -->
                                        <label for="modelo" class="block text-sm font-medium text-gray-700">Modelo</label>
                                        <div class="relative mt-1 rounded-md shadow-sm">
                                            <input type="text" autocomplete="given-modelo" :class="[
                                                'mt-1 block w-full rounded-md ',
                                                loader.errors.modelo ? 'border-red-300' : 'border-gray-300',
                                                ' shadow-sm ',
                                                loader.errors.modelo ? 'focus:border-red-500' : 'focus:border-green-500',
                                                ' ',
                                                loader.errors.modelo ? 'focus:ring-red-500' : 'focus:ring-green-500',
                                                ' sm:text-sm'
                                            ]" aria-invalid="true" aria-describedby="modelo-error"
                                                v-model="loader.equipment.modelo" placeholder="Modelo" />
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3"
                                                v-if="loader.errors.modelo">
                                                <ExclamationCircleIcon class="h-5 w-5 text-red-500" aria-hidden="true" />
                                            </div>
                                        </div>
                                        <div v-if="loader.errors.modelo">
                                            <ul>
                                                <li class="mt-2 text-sm text-red-600" id="modelo-error"
                                                    v-for="error in loader.errors.modelo" :key="error">{{ error }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-span-2 sm:col-span-2"> <!-- Precio adquirido -->
                                        <label for="precioEquipo" class="block text-sm font-medium text-gray-700">Precio de
                                            Compra
                                            Del Equipo</label>
                                        <div class="relative mt-1 rounded-md shadow-sm">
                                            <input type="number" pattern="[0-9]+(\.[0-9]+)?" min="0" max="99999999.99"
                                                step="0.01" autocomplete="given-precioEquipo" :class="[
                                                    'mt-1 block w-full rounded-md ',
                                                    loader.errors.precioEquipo ? 'border-red-300' : 'border-gray-300',
                                                    ' shadow-sm ',
                                                    loader.errors.precioEquipo ? 'focus:border-red-500' : 'focus:border-green-500',
                                                    ' ',
                                                    loader.errors.precioEquipo ? 'focus:ring-red-500' : 'focus:ring-green-500',
                                                    ' sm:text-sm'
                                                ]" aria-invalid="true" aria-describedby="precioEquipo-error"
                                                v-model="loader.equipment.precioEquipo"
                                                placeholder="Precio de Compra Del Equipo" />
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3"
                                                v-if="loader.errors.precioEquipo">
                                                <ExclamationCircleIcon class="h-5 w-5 text-red-500" aria-hidden="true" />
                                            </div>
                                        </div>
                                        <div v-if="loader.errors.precioEquipo">
                                            <ul>
                                                <li class="mt-2 text-sm text-red-600" id="precioEquipo-error"
                                                    v-for="error in loader.errors.precioEquipo" :key="error">{{ error }}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-span-2 sm:col-span-2"> <!-- Precio Actual -->
                                        <label for="precioEquipoActual"
                                            class="block text-sm font-medium text-gray-700">Precio Del
                                            Equipo Actual</label>
                                        <div class="relative mt-1 rounded-md shadow-sm">
                                            <input type="number" pattern="[0-9]+(\.[0-9]+)?" min="0" max="99999999.99"
                                                step="0.01" autocomplete="given-precioEquipoActual" :class="[
                                                    'mt-1 block w-full rounded-md ',
                                                    loader.errors.precioEquipoActual ? 'border-red-300' : 'border-gray-300',
                                                    ' shadow-sm ',
                                                    loader.errors.precioEquipoActual ? 'focus:border-red-500' : 'focus:border-green-500',
                                                    ' ',
                                                    loader.errors.precioEquipoActual ? 'focus:ring-red-500' : 'focus:ring-green-500',
                                                    ' sm:text-sm'
                                                ]" aria-invalid="true" aria-describedby="precioEquipoActual-error"
                                                v-model="loader.equipment.precioEquipoActual"
                                                placeholder="Precio del equipo actual" />
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3"
                                                v-if="loader.errors.precioEquipoActual">
                                                <ExclamationCircleIcon class="h-5 w-5 text-red-500" aria-hidden="true" />
                                            </div>
                                        </div>
                                        <div v-if="loader.errors.precioEquipoActual">
                                            <ul>
                                                <li class="mt-2 text-sm text-red-600" id="precioEquipoActual-error"
                                                    v-for="error in loader.errors.precioEquipoActual" :key="error">{{ error
                                                    }}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-span-2 sm:col-span-2"> <!-- Precio Actual Venta -->
                                        <label for="precioActualVenta"
                                            class="block text-sm font-medium text-gray-700">Precio De
                                            Venta Actual</label>
                                        <div class="relative mt-1 rounded-md shadow-sm">
                                            <input type="number" pattern="[0-9]+(\.[0-9]+)?" min="0" max="99999999.99"
                                                step="0.01" autocomplete="given-precioActualVenta" :class="[
                                                    'mt-1 block w-full rounded-md ',
                                                    loader.errors.precioActualVenta ? 'border-red-300' : 'border-gray-300',
                                                    ' shadow-sm ',
                                                    loader.errors.precioActualVenta ? 'focus:border-red-500' : 'focus:border-green-500',
                                                    ' ',
                                                    loader.errors.precioActualVenta ? 'focus:ring-red-500' : 'focus:ring-green-500',
                                                    ' sm:text-sm'
                                                ]" aria-invalid="true" aria-describedby="precioActualVenta-error"
                                                v-model="loader.equipment.precioActualVenta"
                                                placeholder="Precio de venta actual" />
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3"
                                                v-if="loader.errors.precioActualVenta">
                                                <ExclamationCircleIcon class="h-5 w-5 text-red-500" aria-hidden="true" />
                                            </div>
                                        </div>
                                        <div v-if="loader.errors.precioActualVenta">
                                            <ul>
                                                <li class="mt-2 text-sm text-red-600" id="precioActualVenta-error"
                                                    v-for="error in loader.errors.precioActualVenta" :key="error">{{ error
                                                    }}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-span-3 sm:col-span-3"> <!-- Disponibilidad -->
                                        <label for="clvDisponibilidad"
                                            class="block text-sm font-medium text-gray-700">Disponibilidad</label>
                                        <listBoxStatusComponent :list="status" @status-selected="onStatusSelected"
                                            :errorsList="loader.errors.clvDisponibilidad" />
                                        <input v-model="clvDisponibilidad" class="hidden">
                                    </div>
                                    <div class="col-span-3 sm:col-span-3"> <!-- Categoria -->
                                        <label for="clvCategoria"
                                            class="block text-sm font-medium text-gray-700">Categoria</label>
                                        <listBoxCategoriesComponent :list="categories"
                                            @category-selected="onCategorySelected"
                                            :errorsList="loader.errors.clvCategoria" />
                                        <input v-model="clvCategoria" class="hidden">
                                    </div>
                                    <div class="col-span-3 sm:col-span-3"> <!-- Fecha de adquisición -->
                                        <label for="fechaAdquisicion" class="block text-sm font-medium text-gray-700">Fecha
                                            De
                                            Adquisición</label>
                                        <div class="relative mt-1 rounded-md shadow-sm">
                                            <VueDatePicker v-model="loader.equipment.fechaAdquisicion"
                                                placeholder="Fecha De Adquisición" autocomplete="off" :class="[
                                                    'mt-1 block w-full rounded-md ',
                                                    loader.errors.fechaAdquisicion ? 'border-red-300' : 'border-gray-300',
                                                    ' shadow-sm ',
                                                    loader.errors.fechaAdquisicion ? 'focus:border-red-300' : 'focus:border-green-500',
                                                    ' ',
                                                    loader.errors.fechaAdquisicion ? 'focus:ring-red-300' : 'focus:ring-green-500',
                                                    ' sm:text-sm'
                                                ]" :max-date="new Date()" :format="loader.datePickerFormat"
                                                position="left" locale="es-MX" cancel-text="Cerrar"
                                                select-text="seleccionar" aria-invalid="true"
                                                aria-describedby="fechaAdquisicion-error"
                                                :day-names="['Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa', 'Do']" />
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3"
                                                v-if="loader.errors.fechaAdquisicion">
                                                <ExclamationCircleIcon class="h-5 w-5 text-red-500" aria-hidden="true" />
                                            </div>
                                        </div>
                                        <div v-if="loader.errors.fechaAdquisicion">
                                            <ul>
                                                <li class="mt-2 text-sm text-red-600" id="fechaAdquisicion-error"
                                                    v-for="error in loader.errors.fechaAdquisicion" :key="error">{{ error }}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-span-3 sm:col-span-3"> <!-- Fecha de garantia extendida -->
                                        <label for="fechaGarantiaExtendida"
                                            class="block text-sm font-medium text-gray-700">Fecha
                                            De La Garantia Extendida
                                            del Equipo</label>
                                        <div class="relative mt-1 rounded-md shadow-sm">
                                            <VueDatePicker v-model="loader.equipment.fechaGarantiaExtendida"
                                                placeholder="Fecha De La Garantia Extendida" autocomplete="off" :class="[
                                                    'mt-1 block w-full rounded-md ',
                                                    loader.errors.fechaGarantiaExtendida ? 'border-red-300' : 'border-gray-300',
                                                    ' shadow-sm ',
                                                    loader.errors.fechaGarantiaExtendida ? 'focus:border-red-300' : 'focus:border-green-500',
                                                    ' ',
                                                    loader.errors.fechaGarantiaExtendida ? 'focus:ring-red-300' : 'focus:ring-green-500',
                                                    ' sm:text-sm'
                                                ]" :max-date="new Date()" :format="loader.datePickerFormat"
                                                position="left" locale="es-MX" cancel-text="Cerrar"
                                                select-text="seleccionar" aria-invalid="true"
                                                aria-describedby="fechaGarantiaExtendida-error"
                                                :day-names="['Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa', 'Do']" />
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3"
                                                v-if="loader.errors.fechaGarantiaExtendida">
                                                <ExclamationCircleIcon class="h-5 w-5 text-red-500" aria-hidden="true" />
                                            </div>
                                        </div>
                                        <div v-if="loader.errors.fechaGarantiaExtendida">
                                            <ul>
                                                <li class="mt-2 text-sm text-red-600" id="fechaGarantiaExtendida-error"
                                                    v-for="error in loader.errors.fechaGarantiaExtendida" :key="error">{{
                                                        error }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-span-3 sm:col-span-3"> <!-- Depreciación anual -->
                                        <label for="porDeprAnual"
                                            class="block text-sm font-medium text-gray-700">Depreciación
                                            Anual Del Equipo
                                            (Porcentaje)</label>
                                        <div class="relative mt-1 rounded-md shadow-sm">
                                            <input type="number" pattern="[0-9]+(\.[0-9]+)?" min="0" max="100.00"
                                                step="0.01" autocomplete="off" :class="[
                                                    'mt-1 block w-full rounded-md ',
                                                    loader.errors.porDeprAnual ? 'border-red-300' : 'border-gray-300',
                                                    ' shadow-sm ',
                                                    loader.errors.porDeprAnual ? 'focus:border-red-500' : 'focus:border-green-500',
                                                    ' ',
                                                    loader.errors.porDeprAnual ? 'focus:ring-red-500' : 'focus:ring-green-500',
                                                    ' sm:text-sm'
                                                ]" aria-invalid="true" aria-describedby="porDeprAnual-error"
                                                v-model="loader.equipment.porDeprAnual"
                                                placeholder="Depreciación Anual Del Equipo (Porcentaje actual es %25)" />
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3"
                                                v-if="loader.errors.porDeprAnual">
                                                <ExclamationCircleIcon class="h-5 w-5 text-red-500" aria-hidden="true" />
                                            </div>
                                        </div>
                                        <div v-if="loader.errors.porDeprAnual">
                                            <ul>
                                                <li class="mt-2 text-sm text-red-600" id="porDeprAnual-error"
                                                    v-for="error in loader.errors.porDeprAnual" :key="error">{{ error }}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-span-3 sm:col-span-3"> <!-- Folio de factura -->
                                        <label for="folioEquipo" class="block text-sm font-medium text-gray-700">Folio De
                                            Factura</label>
                                        <div class="relative mt-1 rounded-md shadow-sm">
                                            <input type="text" min="6" max="20" autocomplete="given-folioEquipo" :class="[
                                                'mt-1 block w-full rounded-md ',
                                                loader.errors.folioEquipo ? 'border-red-300' : 'border-gray-300',
                                                ' shadow-sm ',
                                                loader.errors.folioEquipo ? 'focus:border-red-500' : 'focus:border-green-500',
                                                ' ',
                                                loader.errors.folioEquipo ? 'focus:ring-red-500' : 'focus:ring-green-500',
                                                ' sm:text-sm'
                                            ]" aria-invalid="true" aria-describedby="folioEquipo-error"
                                                placeholder="Folio De Factura" v-model="loader.equipment.folioEquipo" />
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3"
                                                v-if="loader.errors.folioEquipo">
                                                <ExclamationCircleIcon class="h-5 w-5 text-red-500" aria-hidden="true" />
                                            </div>
                                        </div>
                                        <div v-if="loader.errors.folioEquipo">
                                            <ul>
                                                <li class="mt-2 text-sm text-red-600" id="folioEquipo-error"
                                                    v-for="error in loader.errors.folioEquipo" :key="error">{{ error }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-span-6 sm:col-span-6"> <!-- Descripción -->
                                        <label for="descripcion"
                                            class="block text-sm font-medium text-gray-700">Descripción</label>
                                        <div class="relative mt-1 rounded-md shadow-sm">
                                            <textarea rows="3" autocomplete="given-descripcion" :class="[
                                                'mt-1 block w-full rounded-md ',
                                                loader.errors.descripcion ? 'border-red-300' : 'border-gray-300',
                                                ' shadow-sm ',
                                                loader.errors.descripcion ? 'focus:border-red-500' : 'focus:border-green-500',
                                                ' ',
                                                loader.errors.descripcion ? 'focus:ring-red-500' : 'focus:ring-green-500',
                                                ' sm:text-sm'
                                            ]" aria-invalid="true" aria-describedby="descripcion-error"
                                                v-model="loader.equipment.descripcion" placeholder="Descripción"></textarea>
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3"
                                                v-if="loader.errors.descripcion">
                                                <ExclamationCircleIcon class="h-5 w-5 text-red-500" aria-hidden="true" />
                                            </div>
                                        </div>
                                        <div v-if="loader.errors.descripcion">
                                            <ul>
                                                <li class="mt-2 text-sm text-red-600" id="descripcion-error"
                                                    v-for="error in loader.errors.descripcion" :key="error">{{ error }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 text-right sm:px-6"> <!-- Botón -->
                                <button-component type="submit" text="Guardar Equipo" colorButton="green-600"
                                    colorButtonHover="green-700" colorRingFocus="green-600" />
                            </div>
                        </div>
                    </form>
                </div>
            </Transition>
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

const loader = equipments();
const categories = ref([]);
const status = ref([]);
let show = ref(false);
const clvDisponibilidad = ref(null);
const clvCategoria = ref(null);
const onStatusSelected = (status) => {
    clvDisponibilidad.value = status.clvDisponibilidad;
    loader.clvs(clvDisponibilidad.value, clvCategoria.value);
};
const onCategorySelected = (category) => {
    clvCategoria.value = category.clvCategoria;
    loader.clvs(clvDisponibilidad.value, clvCategoria.value);
};

defineProps({
    routeTitle: {
        type: String,
        required: false,
        default: '',
    },
});
onMounted(async () => {
    await loader.getCategories();
    categories.value = loader.listCategories;
    await loader.getStatus();
    status.value = await loader.listStatus;
    show.value = !show.value;
});
</script>

<style lang="scss">
@import url(public/css/datePicker.css);

.slide-fade-enter-active {
    transition: all 0.3s ease-out;
}

.slide-fade-leave-active {
    transition: all 0.3s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
    transform: translateX(20px);
    opacity: 0;
}
</style>