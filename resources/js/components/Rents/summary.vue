<template>
    <div class="flex items-start rounded-xl bg-white p-3 shadow-lg m-5 flex-row border-l-4 border-green-300 hover:scale-110 transition-transform duration-150"
        v-if="rentaTotal">
        <Transition name="bounce">
            <div class="ml-4">
                <h2 class="font-semibold">Rentas Mensuales: <span class="text-green-500">$</span>{{ rentaTotal }}</h2>
                <p class="mt-2 text-sm text-gray-500">Referente a equipos "En Renta"</p>
            </div>
        </Transition>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { rents } from '@/js/store/Admin/Rents.js';

const loader = rents();
let rentaTotal = ref(null);

onMounted(async () => {
    await loader.index();
    rentaTotal.value = loader.precioFormatter(Number(loader.sumPayments.totalPagoRenta) + Number(loader.sumPayments.totalIvaRenta));
});
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