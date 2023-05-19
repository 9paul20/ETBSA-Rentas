<template>
    <div>
        <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5" v-if="rowDatas">
            <div class="overflow-x-auto">
                <table class="min-w-full border-collapse bg-white text-left text-sm text-gray-500 divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                        <tr>
                            <th v-for="columnName in columnNames" scope="col"
                                class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
                                :key="columnName">
                                {{ columnName }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 border-t bg-white text-center" is="vue:transition-group"
                        tag="tbody" name="list">
                        <tr v-for="rowData in rowDatas.data" class="hover:bg-gray-100" :key="rowData.clvRenta">
                            <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                                <div class="relative h-16 w-16">
                                    <img class="h-full w-full rounded-full object-cover object-center" :src="imageTractor"
                                        :alt="'TractorUE_' + rowData.equipment.noSerieEquipo">
                                </div>
                                <div class="text-sm">
                                    <div class="font-medium text-gray-700">No.Serie:
                                        {{ rowData.equipment.noSerieEquipo }}</div>
                                    <div class="font-medium text-gray-700">Modelo:
                                        {{ rowData.equipment.modelo }}</div>
                                    <div class="text-gray-400">Categoria:
                                        {{ rowData.equipment.categoria.categoria }}
                                    </div>
                                </div>
                            </th>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                <div class="text-gray-500">{{ rowData.person.nombrePersona }}</div>
                                <div class="text-gray-500">{{ rowData.person.apePaternoPersona }}</div>
                                <div class="text-gray-500">{{ rowData.person.apeMaternoPersona }}</div>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                <div class="text-gray-600" v-if="rowData.descripcion">{{ rowData.descripcion }}</div>
                                <div class="text-orange-600" v-else>Sin Descripción</div>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                <div class="text-gray-600">{{ rowData.fecha_inicio }}</div>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                <div class="text-gray-600">{{ rowData.fecha_fin }}</div>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                <span
                                    :class="'inline-flex items-center gap-1 rounded-full ' + rowData.status_rent.bgColorPrimary + ' px-2 py-1 text-xs font-semibold ' + rowData.status_rent.textColor">
                                    <span
                                        :class="'h-1.5 w-1.5 rounded-full ' + rowData.status_rent.bgColorSecondary"></span>
                                    {{ rowData.status_rent.estadoRenta }}
                                </span>
                            </td>
                            <td class="px-2 py-2">
                                <div class="flex justify-end gap-2">
                                    <icon-button color="text-green-500" :tooltip="`'ShowRent_` + rowData.clvRenta + `'`"
                                        svg="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                        :id="'Show_' + rowData.clvRenta" :clv="rowData.clvRenta" @click.prevent="show(
                                            getTitle(rowData.person.nombrePersona, rowData.person.apePaternoPersona, rowData.person.apeMaternoPersona),
                                            getDescription(rowData.equipment.noSerieEquipo, rowData.equipment.modelo, Number(rowData.payments_rents_sum_pago_renta), Number(rowData.payments_rents_sum_iva_renta)),
                                            'info',)" />
                                    <icon-button color="text-blue-500" :href="rowData.routeUpdateRent"
                                        :tooltip="`'EditRent_` + rowData.clvRenta + `'`"
                                        svg="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"
                                        :id="'Edit_' + rowData.clvRenta" :clv="rowData.clvRenta" />
                                    <icon-button color="text-red-500" :tooltip="`'DeleteRent_` + rowData.clvRenta + `'`"
                                        svg="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                                        :id="'Delete_' + rowData.clvRenta" :clv="rowData.clvRenta" @click.prevent="confirmDelete(
                                            getTitle(rowData.person.nombrePersona, rowData.person.apePaternoPersona, rowData.person.apeMaternoPersona),
                                            'warning',
                                            rowData,
                                            rowData.routeDeleteRent)" method="delete" />
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- {{ $Data['rowDatas'] -> links('vendor.pagination.tailwind') }} -->
        </div>
        <main class="flex items-center justify-center flex-1 px-4 py-8" v-else>
            <h1 class="text-5xl font-bold text-gray-500">No hay datos de
                {{ routeTitle }}</h1>
        </main>
    </div>
</template>

<script>
import iconButton from '@/js/components/iconButton.vue';
import { ref, onMounted } from 'vue';
import axios from 'axios';

export default {
    name: 'tableRentsComponent',
    props: {
        routeTitle: {
            type: String,
            required: false,
            default: 'Default',
        },
        imageTractor: {
            type: String,
            required: false,
            default: null,
        },
        columnNames: {
            type: Array,
            required: false,
            default: [],
        },
        rowDatas: {
            type: Object,
            required: false,
            default: {},
        },
    },
    setup(props) {
        onMounted(() => {
            // console.log(rowDatas)
        });
        const rowDatasList = ref(props.rowDatas);
        return { getTitle, getDescription, show, confirmDelete, rowDatasList };
    },
    components: {
        iconButton,
    },
}

function getTitle(nombre, apePaterno, apeMaterno) {
    const name = "La renta de " + nombre + " " + apePaterno + " " + apeMaterno;
    return name;
}

function getDescription(noSerie, modelo, precio, iva) {
    const description = "Con el equipo " + noSerie + " - " + modelo + " y un precio total de " + (precio + iva).toLocaleString('es-MX', {
        style: 'currency',
        currency: 'MXN',
    });
    return description;
}

function show(name, description, icon) {
    Swal.fire({
        title: name,
        text: description,
        icon: icon,
        cancelButtonColor: '#3085d6',
        cancelButtonText: 'Cerrar',
    })
}

function confirmDelete(name, icon, item, url) {
    Swal.fire({
        title: `¿Estás seguro de eliminar el dato de ${name}?`,
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
                axios.delete(url).then(() => {
                    // Mostrar mensaje de éxito
                    Swal.fire({
                        title: '¡Dato eliminado!',
                        text: 'El dato ha sido eliminado correctamente.',
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar'
                    }).then(() => {
                        // Actualizar la interfaz o redirigir a otra página
                        // Puedes realizar alguna acción aquí según tus necesidades
                    });
                }).catch((error) => {
                    console.error(error);
                    // Mostrar mensaje de error
                    Swal.fire({
                        title: 'Error',
                        text: 'Ha ocurrido un error al eliminar el dato.',
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar'
                    });
                });
            } catch (error) {
                console.error(error);
            }

            //Transition de VueJS 3
            const index = this.rowDatasList.data.indexOf(item);
            if (index !== -1) {
                this.rowDatasList.data.splice(index, 1);
            }
        }
    })
}

</script>

<style>
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