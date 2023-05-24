<template>
    <div>
        <div class="w-full md:w-2/2 shadow p-5 rounded-lg bg-white hover:scale-105 transition-transform duration-150">
            <search-inputs-rents-component />

            <div class="flex items-center justify-between mt-4">
                <p class="font-medium">
                    Filters
                </p>

                <button class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 text-sm font-medium rounded-md">
                    Reset Filter
                </button>
            </div>

            <div>
                <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-1 gap-4 mt-4">
                    <list-box-equipments-categories-component :list="rentsIndex.categoriesList" />
                    <list-box-status-rents-component :list="rentsIndex.statusRentsList" />
                    <!-- <list-box-component :list="rentsIndex.statusRentsList" /> -->
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, watch, onMounted } from 'vue';
import listBoxEquipmentsCategoriesComponent from '@/js/components/Rents/listBoxEquipmentsCategoriesComponent.vue';
import listBoxStatusRentsComponent from '@/js/components/Rents/listBoxStatusRentsComponent.vue';
import searchInputsRentsComponent from '@/js/components/Rents/searchInputsRentsComponent.vue';
import { useRentsIndex } from '@/js/store/Admin/Rents.js';

name: 'tableFilterRentsComponent';

const rentsIndex = useRentsIndex();

onMounted(async () => {
    await rentsIndex.index();
});
</script>

<style lang="css" scoped></style>