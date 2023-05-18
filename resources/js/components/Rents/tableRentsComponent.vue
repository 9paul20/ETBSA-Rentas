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
                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-4">
                                    <!-- <x-Dashboard.IconButton-Show
                                        href="{{ route('Dashboard.Admin.Rents.Show', $rowData->clvRenta) }}" />
                                    <x-Dashboard.IconButton-Edit
                                        href="{{ route('Dashboard.Admin.Rents.Edit', $rowData->clvRenta) }}" />
                                    <x-Dashboard.IconButton-Delete id="{{ $rowData->clvRenta }}"
                                        name="Renta con Equipo: {{ $rowData->equipment->noSerieEquipo }}, Cliente: {{ $rowData->person->nombrePersona }} Y Una Renta Total de ${{ number_format($rowData->payments_rents_sum_pago_renta + $rowData->payments_rents_sum_iva_renta, 2) }}"
                                        href="{{ route('Dashboard.Admin.Rents.Destroy', $rowData->clvRenta) }}" /> -->
                                    <button @click="del(rowData)">X</button>
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
// import { columnNames, rowDatas } from '@/js/views/Rents/index.vue';
import { ref, onMounted } from 'vue';

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
        return { del, rowDatasList };
    },
}

function del(item) {
    // console.log(item);
    // console.log(this.rowDatasList);
    const index = this.rowDatasList.data.indexOf(item);
    if (index !== -1) {
        this.rowDatasList.data.splice(index, 1);
    }
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