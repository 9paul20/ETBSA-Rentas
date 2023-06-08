<template>
    <div>
        <back-to-button-component :href="backtoindex" text="Back to Equipments" textColor="white" bgColor="green-600"
            bgColorHover="green-700" ringColorFocus="green-600" />
        <divisor-component />
        <edit-equipment-form-component v-if="editEquipment" :editEquipment="editEquipment" :id="Number(id)"
            :datePickerFormat="datePickerFormat" />
        <divisor-component />
        <!-- Aqui las tablas que se van a ocupar para guardar los gastos del equipo -->
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import backToButtonComponent from '@/js/components/Common/backToButton.vue';
import divisorComponent from '@/js/components/Common/divisor.vue';
import editEquipmentFormComponent from '@/js/components/Equipments/editEquipmentForm.vue';
import { equipments } from '@/js/store/Admin/Equipments.js';

const loader = equipments();
const currentUrl = window.location.href;
const id = currentUrl.match(/Equipments\/(\d+)\/edit/)[1];
let editEquipment = ref(null);
let datePickerFormat = ref(null);

defineProps({
    backtoindex: {
        type: String,
        required: false,
        default: '#',
    },
    yieldtitle: {
        type: String,
        required: false,
        default: 'Default',
    },
    routetitle: {
        type: String,
        required: false,
        default: 'Default',
    },
});

onMounted(async () => {
    try {
        const editer = await loader.edit(id);
        const equipment = {
            noSerieEquipo: editer.equipment.noSerieEquipo,
            noSerieMotor: editer.equipment.noSerieMotor,
            noEconomico: editer.equipment.noEconomico,
            modelo: editer.equipment.modelo,
            clvDisponibilidad: editer.equipment.clvDisponibilidad,
            clvCategoria: editer.equipment.clvCategoria,
            descripcion: editer.equipment.descripcion,
            precioEquipo: editer.equipment.precioEquipo,
            precioEquipoActual: editer.equipment.precioEquipoActual,
            precioActualVenta: editer.equipment.precioActualVenta,
            folioEquipo: editer.equipment.folioEquipo,
            // fechaAdquisicion: editer.equipment.fechaAdquisicion,
            fechaAdquisicion: "2020-06-15",
            fechaGarantiaExtendida: editer.equipment.fechaGarantiaExtendida,
            fechaVenta: editer.equipment.fechaVenta,
            porDeprAnual: editer.equipment.porDeprAnual,
        };
        datePickerFormat.value = loader.datePickerFormat;
        editEquipment.value = {
            status: editer.status,
            categories: editer.categories,
            equipment: equipment,
        };
        console.log(editer);
    } catch (error) {
        console.error(error);
    }
});
</script>

<style lang="scss" scoped></style>
