<template>
    <div v-if="open">
        <TransitionRoot as="template" :show="open">
            <Dialog as="div" class="relative z-10">
                <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100"
                    leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
                </TransitionChild>
                <div class="fixed inset-0 z-10 overflow-y-auto">
                    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                        <TransitionChild as="template" enter="ease-out duration-300"
                            enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                            enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200"
                            leave-from="opacity-100 translate-y-0 sm:scale-100"
                            leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                            <DialogPanel
                                class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                                <form @submit.prevent="" method="PUT">
                                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                        <!-- Contenido -->
                                        <div class="sm:flex sm:items-start justify-center"> <!-- Titulo -->
                                            <div class="mt-3 text-center sm:mt-0 sm:text-left">
                                                <div>
                                                    <h3 class="text-lg font-medium leading-6 text-gray-900"
                                                        id="modal-title">
                                                        Agregar Gasto Fijo
                                                    </h3>
                                                    <p class="mt-2 text-sm text-gray-500">Por favor, completa los siguientes
                                                        campos:</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-span-6 sm:col-span-6"> <!-- Disponibilidad -->
                                            <listBoxTypeFixedExpensesComponent :list="allTypeFixedExpensesList"
                                                @type-fixed-expense-selected="onTypeFixedExpenseSelected"
                                                :errorsList="loader.fixedExpenseErrors.clvTipoGastoFijo"
                                                :select="model.clvTipoGastoFijo" />
                                            <input v-model="clvTipoGastoFijo" class="hidden">
                                        </div>
                                        <div class="col-span-6 sm:col-span-6 my-1"> <!-- Gasto fijo -->
                                            <label for="gastoFijo"
                                                class="block text-sm font-medium text-gray-700">Descripción
                                                Corta Del
                                                Gasto
                                                Fijo</label>
                                            <div class="relative mt-1 rounded-md shadow-sm">
                                                <input type="text" v-model="model.gastoFijo" autocomplete="given-gastoFijo"
                                                    min="4" max="255" :class="[
                                                        'mt-1 block w-full rounded-md ',
                                                        loader.fixedExpenseUpdateErrors.gastoFijo ? 'border-red-300' : 'border-gray-300',
                                                        ' shadow-sm ',
                                                        loader.fixedExpenseUpdateErrors.gastoFijo ? 'focus:border-red-500' : 'focus:border-green-500',
                                                        ' ',
                                                        loader.fixedExpenseUpdateErrors.gastoFijo ? 'focus:ring-red-500' : 'focus:ring-green-500',
                                                        ' sm:text-sm'
                                                    ]" pattern=".{4,255}" aria-describedby="gastoFijo-error"
                                                    title="El campo debe contener entre 4 y 255 caracteres" autofocus>
                                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3"
                                                    v-if="loader.fixedExpenseUpdateErrors.gastoFijo">
                                                    <ExclamationCircleIcon class="h-5 w-5 text-red-500"
                                                        aria-hidden="true" />
                                                </div>
                                            </div>
                                            <div v-if="loader.fixedExpenseUpdateErrors.gastoFijo">
                                                <ul>
                                                    <li class="mt-2 text-sm text-red-600" id="gastoFijo-error"
                                                        v-for="error in loader.fixedExpenseUpdateErrors.gastoFijo"
                                                        :key="error">{{
                                                            error }}
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-span-6 sm:col-span-6"> <!-- Fecha del gasto -->
                                            <label for="fechaGastoFijo"
                                                class="block text-sm font-medium text-gray-700">Fecha Del
                                                Gasto
                                                Fijo</label>
                                            <div class="relative mt-1 rounded-md shadow-sm">
                                                <VueDatePicker v-model="model.fechaGastoFijo"
                                                    placeholder="Fecha De Gasto Fijo" autocomplete="off"
                                                    class="mt-1 block w-full rounded-md shadow-sm sm:text-sm"
                                                    :max-date="new Date()" :format="loader.datePickerFormat" position="left"
                                                    locale="es-MX" cancel-text="Cerrar" select-text="seleccionar"
                                                    aria-invalid="true" aria-describedby="fechaGastoFijo-error"
                                                    :day-names="['Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa', 'Do']" />
                                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3"
                                                    v-if="loader.fixedExpenseUpdateErrors.fechaGastoFijo">
                                                    <ExclamationCircleIcon class="h-5 w-5 text-red-500"
                                                        aria-hidden="true" />
                                                </div>
                                            </div>
                                            <div v-if="loader.fixedExpenseUpdateErrors.fechaGastoFijo">
                                                <ul>
                                                    <li class="mt-2 text-sm text-red-600" id="fechaGastoFijo-error"
                                                        v-for="error in loader.fixedExpenseUpdateErrors.fechaGastoFijo"
                                                        :key="error">{{ error }}
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-span-6 sm:col-span-6"> <!-- Costo del gasto -->
                                            <label for="costoGastoFijo"
                                                class="block text-sm font-medium text-gray-700">Costo Del
                                                Gasto
                                                Fijo</label>
                                            <div class="relative mt-1 rounded-md shadow-sm">
                                                <input type="number" pattern="[0-9]+(\.[0-9]+)?" min="0" step="0.01"
                                                    autocomplete="given-costoGastoFijo" v-model="model.costoGastoFijo"
                                                    :class="[
                                                        'mt-1 block w-full rounded-md ',
                                                        loader.fixedExpenseUpdateErrors.gastoFijo ? 'border-red-300' : 'border-gray-300',
                                                        ' shadow-sm ',
                                                        loader.fixedExpenseUpdateErrors.gastoFijo ? 'focus:border-red-500' : 'focus:border-green-500',
                                                        ' ',
                                                        loader.fixedExpenseUpdateErrors.gastoFijo ? 'focus:ring-red-500' : 'focus:ring-green-500',
                                                        ' sm:text-sm'
                                                    ]" aria-describedby="costoGastoFijo-error" max="99999999.99">
                                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3"
                                                    v-if="loader.fixedExpenseUpdateErrors.costoGastoFijo">
                                                    <ExclamationCircleIcon class="h-5 w-5 text-red-500"
                                                        aria-hidden="true" />
                                                </div>
                                            </div>
                                            <div v-if="loader.fixedExpenseUpdateErrors.costoGastoFijo">
                                                <ul>
                                                    <li class="mt-2 text-sm text-red-600" id="costoGastoFijo-error"
                                                        v-for="error in loader.fixedExpenseUpdateErrors.costoGastoFijo"
                                                        :key="error">{{ error }}
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-span-6 sm:col-span-6"> <!-- folio factura -->
                                            <label for="folioFactura" class="block text-sm font-medium text-gray-700">Folio
                                                Del Gasto
                                                Fijo</label>
                                            <div class="relative mt-1 rounded-md shadow-sm">
                                                <input type="text" v-model="model.folioFactura"
                                                    autocomplete="given-folioFactura" :class="[
                                                        'mt-1 block w-full rounded-md ',
                                                        loader.fixedExpenseUpdateErrors.folioFactura ? 'border-red-300' : 'border-gray-300',
                                                        ' shadow-sm ',
                                                        loader.fixedExpenseUpdateErrors.folioFactura ? 'focus:border-red-500' : 'focus:border-green-500',
                                                        ' ',
                                                        loader.fixedExpenseUpdateErrors.folioFactura ? 'focus:ring-red-500' : 'focus:ring-green-500',
                                                        ' sm:text-sm'
                                                    ]" aria-describedby="folioFactura-error" minlength="4"
                                                    maxlength="20" />
                                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3"
                                                    v-if="loader.fixedExpenseUpdateErrors.folioFactura">
                                                    <ExclamationCircleIcon class="h-5 w-5 text-red-500"
                                                        aria-hidden="true" />
                                                </div>
                                            </div>
                                            <div v-if="loader.fixedExpenseUpdateErrors.folioFactura">
                                                <ul>
                                                    <li class="mt-2 text-sm text-red-600" id="folioFactura-error"
                                                        v-for="error in loader.fixedExpenseUpdateErrors.folioFactura"
                                                        :key="error">{{ error }}
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6"> <!-- Botones -->
                                        <button-component text="Guardar" type="submit" colorButton="blue-600"
                                            colorButtonHover="blue-700" colorRingFocus="blue-500" addClass="sm:ml-3" />
                                        <button-component text="Cerrar" type="button" colorButton="red-600"
                                            colorButtonHover="red-700" colorRingFocus="red-500"
                                            @click="closeModalEditFixedExpense()" addClass="sm:ml-3" />
                                    </div>
                                </form>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>
    </div>
</template>

<script setup>
import { ref, watch, defineEmits, onMounted } from 'vue';
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue';
import { ExclamationTriangleIcon } from '@heroicons/vue/24/outline';
import { ExclamationCircleIcon } from '@heroicons/vue/20/solid';
import listBoxTypeFixedExpensesComponent from '@/js/components/Equipments/FixedExpenses/listBoxTypeFixedExpenses.vue';
import buttonComponent from '@/js/components/Common/button.vue';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';
import { equipments } from '@/js/store/Admin/Equipments.js';

const open = ref(props.open);
const clvTipoGastoFijo = ref(null);
const loader = equipments();

const props = defineProps({
    open: {
        type: Boolean,
        required: false,
        default: null,
    },
    allTypeFixedExpensesList: {
        type: Object,
        required: false,
        default: null,
    },
    model: {
        type: Object,
        required: false,
        default: null,
    },
    id: {
        type: Number,
        required: false,
        default: null,
    },
});
const emit = defineEmits([
    'closeModalEditFixedExpense-value'
]);
watch(
    () => props.open,
    (newValue) => {
        open.value = newValue;
    }
);
function closeModalEditFixedExpense() {
    open.value = false;
    emit("closeModalEditFixedExpense-value", open.value);
    window.location.hash = "fixedExpensesScroll";
}
const onTypeFixedExpenseSelected = (select) => {
    clvTipoGastoFijo.value = select.clvTipoGastoFijo;
    loader.clvs(null, null, clvTipoGastoFijo.value);
};
</script>

<style lang="scss" scoped></style>