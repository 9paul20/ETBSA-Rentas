<template>
    <div>
        <back-to-button-component :href="backtoindex" text="Back to Equipments" textColor="white" bgColor="green-600"
            bgColorHover="green-700" ringColorFocus="green-600" />
        <divisor-component />
        <create-equipment-form-component :routeTitle="routetitle" />
    </div>
</template>

<script setup>
import backToButtonComponent from '@/js/components/Common/backToButton.vue';
import divisorComponent from '@/js/components/Common/divisor.vue';
import createEquipmentFormComponent from '@/js/components/Equipments/createEquipmentFormComponent.vue';

const props = defineProps({
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
    // createroute: {
    //     type: String,
    //     required: false,
    //     default: '',
    // },
});
</script>

<script>
export default {
    name: 'createEquipmentView',
}
</script>

<style lang="scss" scoped></style>