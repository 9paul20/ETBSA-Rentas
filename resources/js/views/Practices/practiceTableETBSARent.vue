<template>
    <input type="number" min="1" max="100" v-model="porGananciaRenta" />
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import { equipments } from '@/js/store/Admin/Equipments.js';

const loader = equipments();
const url = window.location.href;
const urlWithoutHash = url.split("#")[0];
const segments = urlWithoutHash.split("/");
const lastSegment = Number(segments[segments.length - 1]);
const yet = ref(null);
const show = ref(false);
const currentDate = new Date();
const minDate = ref();
const diffInMonths = ref();

//Constantes para las operaciones del equipo
const precioEquipo = ref(), precioEquipoActual = ref(), gastosFijos = ref(), gastosMen = ref(), mesesEq = ref();
const porGananciaRenta = ref(25);
// const porDepAnualEq = ref(), mesesDepEq = ref(),
//     valorRealActual = ref(), valorRealYGastos = ref(), valorComActual = ref(), valorComYGastos = ref(), porGananciaRenta = ref(25), rentaOptima = ref(),
//     utilidadMensual = ref();

// valorRealActual.value = precioEquipo.value + gastosFijos.value;
// valorRealYGastos.value = valorRealActual.value / 0.85;
// valorComActual.value = precioEquipoActual.value + gastosFijos.value;
// valorComYGastos.value = valorComActual.value / 0.85;
// let renta = gastosMen.value * (1 + (porGananciaRenta.value / 100));
// rentaOptima.value = renta;
// utilidadMensual.value = rentaOptima.value - gastosMen.value;

// const mesesDepEq = computed(() => {
//     return Number((100 / porDepAnualEq.value) * 12);
// });
const valorRealActual = computed(() => {
    return yet.value.equipment.costoNetoAnual / 0.85;
});
const valorRealYGastos = computed(() => {
    return valorRealActual;
});
const valorComActual = computed(() => {
    return precioEquipoActual.value + gastosFijos.value;
});
const valorComYGastos = computed(() => {
    return valorComActual / 0.85;
});

const renta = computed(() => {
    return gastosMen.value * (1 + (porGananciaRenta.value / 100));
});
const utilidadMensual = computed(() => {
    return renta - gastosMen.value;
});
onMounted(async () => {
    try {
        yet.value = await loader.show(lastSegment);
        show.value = true;
        console.log(yet.value.equipment);
    } catch (error) {
        console.error(error);
    }
    //Valores asignados
    precioEquipo.value = Number(yet.value.equipment.precioEquipo);
    precioEquipoActual.value = Number(yet.value.equipment.precioEquipoActual);
    // porDepAnualEq.value = Number(yet.value.equipment.porDeprAnual);
    // mesesDepEq.value = Number((100 / porDepAnualEq.value) * 12);

    gastosFijos.value = Number(yet.value.equipment.sumGastosFijos);
    gastosMen.value = Number(yet.value.equipment.sumGastosMensuales);
    minDate.value = new Date(yet.value.equipment.fechaAdquisicion);
    diffInMonths.value = (currentDate.getMonth() + 1) - (minDate.value.getMonth() + 1) + (12 * (currentDate.getFullYear() - minDate.value.getFullYear()));
});
</script>

<style lang="scss" scoped>
.styled-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}

.styled-table thead tr {
    background-color: #009879;
    color: #ffffff;
    text-align: left;
}

.styled-table th,
.styled-table td {
    padding: 12px 15px;
}

.styled-table tbody tr {
    border-bottom: 1px solid #dddddd;
}

.styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

.styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
}

.styled-table tbody tr.active-row {
    font-weight: bold;
    color: #009879;
}
</style>