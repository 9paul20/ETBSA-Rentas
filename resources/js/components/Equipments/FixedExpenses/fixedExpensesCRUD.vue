<template>
    <div class="mx-auto max-w-7xl" id="fixedExpensesScroll">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900">Gastos Fijos</h1>
            </div>
            <button-component text="Add Fixed Expense" colorButton="green-600" colorButtonHover="green-700"
                colorRingFocus="green-600" @click="openModal()" />
            <create-modal-component :open="open" @open-value="openValue" />
        </div>
        <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-1">
            <div class="overflow-x-auto">
                <table class="min-w-full border-collapse bg-white text-left text-sm text-gray-500 divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                        <tr>
                            <th v-for="columnFixedExpense in getFixedExpenses.columnFixedExpenses" :key="columnFixedExpense"
                                scope="col" class="py-1 pl-1 pr-1 text-left text-sm font-semibold text-gray-900 sm:pl-1">
                                {{ columnFixedExpense }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 border-t bg-white" is="vue:transition-group" tag="tbody"
                        name="list">
                        <tr v-for="rowFixedExpense in getFixedExpenses.rowFixedExpenses.data" :key="rowFixedExpense"
                            class="hover:bg-gray-100">
                            <th class="flex gap-1 px-1 py-2 font-normal text-gray-900">
                                <div class="text-sm">
                                    <div class="font-medium text-gray-700">
                                        {{ rowFixedExpense.type_fixed_expense.tipoGastoFijo }}</div>
                                </div>
                            </th>
                            <td class="whitespace-nowrap px-1 py-2 text-sm text-gray-500">
                                <div class="text-gray-600">
                                    {{ rowFixedExpense.gastoFijo }}</div>
                            </td>
                            <td class="whitespace-nowrap px-1 py-2 text-sm text-gray-500">
                                <div class="text-gray-600">
                                    {{ rowFixedExpense.fechaGastoFijo }}</div>
                            </td>
                            <td class="whitespace-nowrap px-1 py-2 text-sm text-gray-500">
                                <div class="text-gray-600"><span class="font-medium text-green-600">$</span>
                                    {{ rowFixedExpense.costoGastoFijo }}</div>
                            </td>
                            <td class="whitespace-nowrap px-1 py-2 text-sm text-gray-500">
                                <div v-if="rowFixedExpense.folioFactura" class="text-gray-600">{{
                                    rowFixedExpense.folioFactura }}</div>
                                <div v-else class="text-orange-600">Sin Folio</div>
                            </td>
                            <td class="px-1 py-2">
                                <div class="flex justify-end gap-4">
                                    <icon-button color="text-green-500"
                                        :tooltip="`'ShowFixedExpense_` + rowFixedExpense.clvGastoFijo + `'`"
                                        svg="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                        :id="'Show_' + rowFixedExpense.clvGastoFijo" :clv="rowFixedExpense.clvGastoFijo"
                                        @click.prevent="show(
                                            rowFixedExpense.type_fixed_expense.tipoGastoFijo,
                                            rowFixedExpense.gastoFijo,
                                            rowFixedExpense.costoGastoFijo,
                                            'info',
                                        )" />
                                    <!-- <icon-button color="text-blue-500" :href="rowData.routeUpdateEquipment"
                                            :tooltip="`'EditEquipment_` + rowData.clvEquipo + `'`"
                                            svg="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"
                                            :id="'Edit_' + rowData.clvEquipo" :clv="rowData.clvEquipo" /> -->
                                    <icon-button color="text-red-500"
                                        :tooltip="`'DeleteFixedExpense_` + rowFixedExpense.clvGastoFijo + `'`"
                                        svg="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                                        :id="'Delete_' + rowFixedExpense.clvGastoFijo" :clv="rowFixedExpense.clvGastoFijo"
                                        @click.prevent="confirmDelete(
                                            rowFixedExpense.type_fixed_expense.tipoGastoFijo,
                                            rowFixedExpense.gastoFijo,
                                            'warning',
                                            rowFixedExpense,
                                            rowFixedExpense,
                                        )" />
                                </div>
                            </td>
                        </tr>
                        <tr v-if="getFixedExpenses.rowFixedExpenses.data.length === 0">
                            <th colspan="8" class="py-2 text-center text-gray-500">Sin datos a mostrar</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import buttonComponent from '@/js/components/Common/button.vue';
import iconButton from '@/js/components/Common/iconButton.vue';
import createModalComponent from '@/js/components/Equipments/FixedExpenses/createModal.vue';

const open = ref(false);
console.log("open en padre es:", open.value);
function openModal() {
    open.value = open.value = true;
    console.log("open en padre es:", open.value);
}
function openValue(openV) {
    open.value = openV;
    console.log("open en padre es:", open.value);
}

//Función para ver el dato de renta con SA2
function show(name, description, price, icon) {
    Swal.fire({
        title: name,
        text: `${description} con un precio de $${price}`,
        icon: icon,
        cancelButtonColor: '#3085d6',
        cancelButtonText: 'Cerrar',
    })
}
//Función para eliminar el dato de renta con SA2
function confirmDelete(name, price, icon, item, url) {
    Swal.fire({
        title: `¿Estás seguro de eliminar el dato de ${name} con precio de $${price}?`,
        text: "Esta acción no se puede deshacer.",
        icon: icon,
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            //Eliminación usando axios con una función try catch
            try {
                // axios.delete(url).then(() => {
                // Mostrar mensaje de éxito
                Swal.fire({
                    title: '¡Dato eliminado!',
                    text: 'El dato ha sido eliminado correctamente.',
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar'
                }).then(() => {
                    //Transition de VueJS 3, al eliminar un dato
                    const index = props.getFixedExpenses.rowFixedExpenses.data.indexOf(item);
                    if (index !== -1) {
                        props.getFixedExpenses.rowFixedExpenses.data.splice(index, 1);
                    }
                });
                // }).catch((error) => {
                //     console.error(error);
                //     // Mostrar mensaje de error
                //     Swal.fire({
                //         title: 'Error',
                //         text: 'Ha ocurrido un error al eliminar el dato.',
                //         icon: 'error',
                //         confirmButtonColor: '#3085d6',
                //         confirmButtonText: 'Aceptar'
                //     });
                // });
            } catch (error) {
                console.error(error);
            }
        }
    });
}
const props = defineProps({
    id: {
        type: Number,
        required: false,
        default: null,
    },
    getFixedExpenses: {
        type: Object,
        required: false,
        default: null,
    },
});
</script>

<style lang="scss">
.list-move {
    transition: 0.5s
}

.list-enter-active,
.list-leave-active {
    transition: all 0.5s
}

.list-leave-active {
    transition: all 0.5s
}

.list-enter-from,
.list-leave-to {
    opacity: 0;
    transform: translateX(100%) scale(0)
}

.list {}
</style>