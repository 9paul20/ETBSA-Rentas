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
        <search-inputs-rents-component @inputs-box="onInputs" />
        <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-1 gap-4 mt-4">
            <list-box-equipments-categories-component :list="rentsIndex.categoriesList"
                @category-selected="onCategorySelected" />
            <list-box-status-rents-component :list="rentsIndex.statusRentsList" @status-selected="onStatusSelected" />
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import searchInputsRentsComponent from '@/js/components/Rents/searchInputsRents.vue';
import listBoxEquipmentsCategoriesComponent from '@/js/components/Rents/listBoxEquipmentsCategories.vue';
import listBoxStatusRentsComponent from '@/js/components/Rents/listBoxStatusRents.vue';
import { rents } from '@/js/store/Admin/Rents.js';

const rentsIndex = rents();
const constInputBoxNoSerieEquipment = ref("");
const constInputBoxClientName = ref("");
const constInputBoxClientAP = ref("");
const constInputBoxClientAM = ref("");
const constSelectedCategory = ref("");
const constSelectedStatus = ref("");

onMounted(async () => {
    await rentsIndex.index();
});

const onInputs = (noSerieEquipment, clientName, clientAP, clientAM) => {
    constInputBoxNoSerieEquipment.value = noSerieEquipment;
    constInputBoxClientName.value = clientName;
    constInputBoxClientAP.value = clientAP;
    constInputBoxClientAM.value = clientAM;
    filterRentsVue();
};

const onCategorySelected = (category) => {
    constSelectedCategory.value = category;
    filterRentsVue();
};

const onStatusSelected = (status) => {
    constSelectedStatus.value = status;
    filterRentsVue();
};

const filterRentsVue = () => {
    // Actualizar valor o realizar cualquier acción con el valor seleccionado
    // Aquí puedes combinarlo con los valores de los inputs para enviarlos todos juntos
    rentsIndex.filterRents(
        constInputBoxNoSerieEquipment.value,
        constInputBoxClientName.value,
        constInputBoxClientAP.value,
        constInputBoxClientAM.value,
        constSelectedCategory.value,
        constSelectedStatus.value,
    );
}

const resetFilter = () => {
    constInputBoxNoSerieEquipment.value = null;
    constInputBoxClientName.value = null;
    constInputBoxClientAP.value = null;
    constInputBoxClientAM.value = null;
    constSelectedCategory.value = null;
    constSelectedStatus.value = null;
    filterRentsVue();
}
</script>

<style lang="css" scoped></style>