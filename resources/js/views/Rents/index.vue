<template>
    <div>
        <div class="mx-auto max-w-7xl">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-xl font-semibold text-gray-900">{{ routetitle }}</h1>
                </div>
                <button-component text="Add Rent" :href="createrentroute" color-button="green-600"
                    color-button-hober="green-700" color-ring-focus="green-500" />
            </div>
        </div>
        <div class="grid xl:grid-cols-10 md:grid-cols-6 grid-cols-4">
            <div class="xl:col-span-2 md:col-span-4 col-span-4 mx-auto items-center" v-if="columnNames">
                <Transition name="bounce">
                    <table-filter-rents-component />
                </Transition>
            </div>
            <div class="xl:col-span-8 md:col-span-6 col-span-2 mx-auto" v-if="columnNames">
                <Transition name="bounce">
                    <table-rents-component :routeTitle="routetitle" :imageTractor="imagetractor" :columnNames="columnNames"
                        :rowDatas="rowDatas" v-if="tableRentsTransition" />
                </Transition>
            </div>
            <div class="mx-auto max-w-7xl" v-else>
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h1 class="text-5xl font-bold text-gray-500 text-center">{{ yieldtitle }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import buttonComponent from '@/js/components/button.vue';
import tableRentsComponent from '@/js/components/Rents/tableRentsComponent.vue';
import tableFilterRentsComponent from '@/js/components/Rents/tableFilterRentsComponent.vue';
import { ref, onMounted } from 'vue';
import axios from 'axios';

let columnNames = ref([]);
let rowDatas = ref({});
let tableRentsTransition = ref(false);

export default {
    name: 'indexRents',
    props: {
        createrentroute: {
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
    },
    components: {
        'buttonComponent': buttonComponent,
        'tableRentsComponent': tableRentsComponent,
        'tableFilterRentsComponent': tableFilterRentsComponent,
    },
    setup(props) {
        onMounted(() => {
            setTimeout(() => getAll(props), 0);
        });
        return { getAll, columnNames, rowDatas, tableRentsTransition };
    },
    data() {
        return {
            // tableRentsTransation: '',
        };
    }
}

export async function getAll(props) {
    try {
        const { data } = await axios.get('http://etbsa-rentas.test/api/RentsListAPI');
        tableRentsTransition.value = !tableRentsTransition.value;
        columnNames.value = [...data.columnNames];
        rowDatas.value = { ...data.rowDatas };
        // console.log("El arreglo es: ", columnNames, rowDatas);
    } catch (error) {
        console.error(error);
    }
    // nextTick(() => { })
}
</script>

<style lang="css" scoped>
.bounce-enter-active {
    animation: bounce-in 0.5s;
}

.bounce-leave-active {
    animation: bounce-in 0.5s reverse;
}

@keyframes bounce-in {
    0% {
        transform: scale(0);
    }

    50% {
        transform: scale(1.09);
    }

    100% {
        transform: scale(1);
    }
}
</style>