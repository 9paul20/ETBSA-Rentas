<template>
    <div v-if="show">
        <div>
            <label>Porcentaje ganancia para utilidad: </label>
            <input type="number" min="1" max="100" v-model="porGananciaRenta" />
            ${{ loader.precioFormatter(rentaOptima) }} ->
            ${{ loader.precioFormatter(valorComAdqYGastFiMasPorc) }}
            <br>
            <label>Mes: </label>
            <input type="number" min="1" max="100" v-model="mes" />
            ${{ loader.precioFormatter(valorComercialDolar(mes)) }}->
            ${{ loader.precioFormatter(valorComercialDolarRT(mes)) }}->
            ${{ loader.precioFormatter(renta(mes)) }}->
            ${{ loader.precioFormatter(utilidad(mes)) }}->
            ${{ loader.precioFormatter(costo(mes)) }}->
            ${{ loader.precioFormatter(precioVenta(mes)) }}
        </div>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>MES</th>
                    <th>GASTO</th>
                    <th>Valor Comercial</th>
                    <th>Valor Real</th>
                    <th>Dollar ($20.00)</th>
                    <th>Dollar RT (${{ loader.precioFormatter(usdToMXNRealTime) }})</th>
                    <th>Renta</th>
                    <th>Utilidad</th>
                    <th>Valor Comercial(%)</th>
                    <th>Costo</th>
                    <th>Precio Venta</th>
                    <th>Ganancia</th>
                    <th>Costo(%)</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in mesesDepEq" :key="item" :class="{ 'active-row': item % 12 === 0 }">
                    <td>{{ item }}</td>
                    <td>${{ loader.precioFormatter(GastoEnMes(item)) }}</td>
                    <td>${{ loader.precioFormatter(valorComercial(item)) }}</td>
                    <td>${{ loader.precioFormatter(valorReal(item)) }}</td>
                    <td>${{ loader.precioFormatter(valorComercialDolar(item)) }}</td>
                    <td>${{ loader.precioFormatter(valorComercialDolarRT(item)) }}</td>
                    <td>${{ loader.precioFormatter(renta(item)) }}</td>
                    <td>${{ loader.precioFormatter(utilidad(item)) }}</td>
                    <td class="text-right">{{ Math.round(valorComercialPorc(item) * 100) }}%</td>
                    <td>${{ loader.precioFormatter(costo(item)) }}</td>
                    <td>${{ loader.precioFormatter(precioVenta(item)) }}</td>
                    <td>${{ loader.precioFormatter(ganancia(item)) }}</td>
                    <td class="text-right">{{ Math.round(costoPorc(item) * 100) }}%</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import { equipments } from '@/js/store/Admin/Equipments.js';

const loader = equipments(), url = window.location.href, urlWithoutHash = url.split("#")[0],
    segments = urlWithoutHash.split("/"), lastSegment = Number(segments[segments.length - 1]);
const showEq = ref(null), show = ref(false), minDate = ref(), currentDate = new Date(), mesesAdqEq = ref(),
    costoNetoAnualEq = ref(), porDepAnualEq = ref(), dollarToRate = ref(), usdToMXNRealTime = ref();

onMounted(async () => {
    try {
        showEq.value = await loader.show(lastSegment);
        dollarToRate.value = await loader.dollarRates();
        show.value = true;
    } catch (error) {
        console.error(error);
    }
    //Valores asignados
    usdToMXNRealTime.value = dollarToRate.value.rates.MXN;
    precioEquipo.value = parseFloat(showEq.value.equipment.precioEquipo);
    precioEquipoActual.value = parseFloat(showEq.value.equipment.precioEquipoActual);

    gastosFijos.value = Number(showEq.value.equipment.sumGastosFijos);
    gastosMen.value = Number(showEq.value.equipment.sumGastosMensuales);
    minDate.value = new Date(showEq.value.equipment.fechaAdquisicion);
    mesesAdqEq.value = (currentDate.getMonth() + 1) - (minDate.value.getMonth() + 1) + (12 * (currentDate.getFullYear() - minDate.value.getFullYear()));
    costoNetoAnualEq.value = Number(showEq.value.equipment.costoNetoAnual);
    porDepAnualEq.value = Number(showEq.value.equipment.porDeprAnual);
});

//Constantes para las operaciones del equipo
const precioEquipo = ref(), precioEquipoActual = ref(), gastosFijos = ref(), gastosMen = ref(),
    porGananciaRenta = ref(25), mes = ref(mesesAdqEq);

const mesesDepEq = computed(() => {
    return (100 / porDepAnualEq.value) * 12;
});
const valorRealAdqYGastFi = computed(() => {
    return precioEquipo.value + gastosFijos.value;
});
const valorRealActYGastFi = computed(() => {
    return precioEquipoActual.value + gastosFijos.value;
});
const valorRealAdqYGastFiMasPorc = computed(() => {
    return valorRealAdqYGastFi.value / 0.85;
});
const valorComAdqYGastFiMasPorc = computed(() => {
    return valorRealActYGastFi.value / 0.85;
});
const rentaOptima = computed(() => {
    return gastosMen.value * (1 + (porGananciaRenta.value / 100));
});
const utilidadMensual = computed(() => {
    return rentaOptima.value - gastosMen.value;
});
const GastoEnMes = computed(() => {
    return (mes) => {
        if (mes > 0)
            return gastosMen.value * mes;
        else
            return 0;
    };
});
const valorComercial = computed(() => {
    return (mes) => {
        if (mes > 0)
            return valorComAdqYGastFiMasPorc.value - GastoEnMes.value(mes);
        else
            return 0;
    }
});
const valorReal = computed(() => {
    return (mes) => {
        if (mes > 0)
            return valorRealAdqYGastFiMasPorc.value - GastoEnMes.value(mes);
        else
            return 0;
    }
});
const valorComercialDolar = computed(() => {
    return (mes) => {
        if (mes > 0)
            return valorComercial.value(mes) / 20;
        else
            return 0;
    }
});
const valorComercialDolarRT = computed(() => {
    return (mes) => {
        if (mes > 0)
            return valorComercial.value(mes) / usdToMXNRealTime.value;
        else
            return 0;
    }
});
const renta = computed(() => {
    return (mes) => {
        if (mes > 0)
            return rentaOptima.value * mes;
        else
            return 0;
    }
});
const utilidad = computed(() => {
    return (mes) => {
        if (mes > 0)
            return renta.value(mes) - GastoEnMes.value(mes);
        else
            return 0;
    }
});
const valorComercialPorc = computed(() => {
    return (mes) => {
        if (mes > 0)
            if (mes < 24)
                return valorComercial.value(mes) / valorRealActYGastFi.value;
            else
                return (89 - mes) / 100;
        else
            return 0;
    }
});
const costo = computed(() => {
    return (mes) => {
        if (mes > 0)
            return valorRealActYGastFi.value - GastoEnMes.value(mes - 1);
        else
            return 0;
    }
});
const precioVenta = computed(() => {
    return (mes) => {
        if (mes > 0)
            return valorRealActYGastFi.value * valorComercialPorc.value(mes);
        else
            return 0;
    }
});
const ganancia = computed(() => {
    return (mes) => {
        if (mes > 0)
            return precioVenta.value(mes) - costo.value(mes);
        else
            return 0;
    }
});
const costoPorc = computed(() => {
    return (mes) => {
        if (mes > 0)
            return ganancia.value(mes) / costo.value(mes);
        else
            return 0;
    }
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