<template>
    <div>
        <div class="mx-auto max-w-7xl">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-xl font-semibold text-gray-900">{{ routetitle }}</h1>
                </div>
                <button-component text="Add Equipment" :href="createequipmentroute" color-button="green-600"
                    color-button-hover="green-700" color-ring-focus="green-500" />
            </div>
        </div>
        <div class="grid xl:grid-cols-10 md:grid-cols-6 grid-cols-4">
            <div class="xl:col-span-2 md:col-span-4 col-span-4 mx-auto items-center">
                <Transition name="bounce">
                    <table-filter-equipments-component />
                </Transition>
            </div>
            <div class="xl:col-span-8 md:col-span-6 col-span-2 mx-auto">
                <Transition name="bounce">
                    <table-equipments-component :routeTitle="routetitle" :imageTractor="imagetractor" />
                </Transition>
            </div>
        </div>
    </div>
</template>

<script setup>
import buttonComponent from '@/js/components/Common/button.vue';
import tableFilterEquipmentsComponent from '@/js/components/Equipments/tableFilterEquipments.vue';
import tableEquipmentsComponent from '@/js/components/Equipments/tableEquipments.vue';

defineProps({
    createequipmentroute: {
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
    imagetractor: {
        type: String,
        required: false,
        default: null,
    },
});
</script>

<style lang="scss" scoped></style>