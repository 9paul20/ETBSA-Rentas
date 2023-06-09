<template>
    <div class="w-full md:w-2/2 shadow p-5 rounded-lg bg-white hover:scale-105 transition-transform duration-150">
        <div class="flex items-center justify-between mt-4">
            <p class="font-medium">
                Filters
            </p>
            <button class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-md"
                @click="resetFilter">
                Reset Filter
            </button>
        </div>
        <search-inputs-equipments-component @inputs-box="onInputs" />
        <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-1 gap-4 mt-4">
            <list-box-status-component :list="loader.listStatus" @status-selected="onStatusSelected" />
            <list-box-categories-component :list="loader.listCategories" @category-selected="onCategorySelected" />
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import searchInputsEquipmentsComponent from '@/js/components/Equipments/searchInputsEquipments.vue';
import listBoxCategoriesComponent from '@/js/components/Equipments/listBoxCategories.vue';
import listBoxStatusComponent from '@/js/components/Equipments/listBoxStatus.vue';
import { equipments } from '@/js/store/Admin/Equipments.js';

const loader = equipments();
const constInputBoxNoSerieEquipo = ref("");
const constInputBoxModelo = ref("");
const constSelectedCategory = ref("");
const constSelectedStatus = ref("");
const clearInputs = ref("");

const onInputs = (noSerieEquipo, Modelo) => {
    constInputBoxNoSerieEquipo.value = noSerieEquipo;
    constInputBoxModelo.value = Modelo;
    filterEquipmentsVue();
};
const onCategorySelected = (category) => {
    constSelectedCategory.value = category.categoria;
    filterEquipmentsVue();
};
const onStatusSelected = (status) => {
    constSelectedStatus.value = status.disponibilidad;
    filterEquipmentsVue();
};
const filterEquipmentsVue = () => {
    // Actualizar valor o realizar cualquier acción con el valor seleccionado
    // Aquí puedes combinarlo con los valores de los inputs para enviarlos todos juntos
    loader.filterEquipments(
        constInputBoxNoSerieEquipo.value,
        constInputBoxModelo.value,
        constSelectedCategory.value,
        constSelectedStatus.value,
    );
}
const resetFilter = () => {
    constInputBoxNoSerieEquipo.value = "";
    constInputBoxModelo.value = "";
    constSelectedCategory.value = "";
    constSelectedStatus.value = "";
    clearInputs.value = "";
    filterEquipmentsVue();
}

onMounted(async () => {
    await loader.getCategories();
    await loader.getStatus();
});
</script>

<style lang="scss" scoped></style>