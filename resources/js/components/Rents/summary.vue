<template>
    <div>
        <div class="flex items-start rounded-xl bg-white p-3 shadow-lg m-5 flex-row border-l-4 border-yellow-300 hover:scale-110 transition-transform duration-150"
            v-if="sumPrimerPagoEnRenta">
            <Transition name="bounce">
                <div class="ml-4">
                    <h2 class="font-semibold">Rentas Mensuales: <span class="text-yellow-500">$</span>{{ sumPrimerPagoEnRenta }}</h2>
                    <p class="mt-2 text-sm text-gray-500">Referente a equipos "En Renta"</p>
                </div>
            </Transition>
        </div>
        <div class="flex items-start rounded-xl bg-white p-3 shadow-lg m-5 flex-row border-l-4 border-green-300 hover:scale-110 transition-transform duration-150"
            v-if="sumRentaTotalPagado">
            <Transition name="bounce">
                <div class="ml-4">
                    <h2 class="font-semibold">Total Pagado: <span class="text-green-500">$</span>{{ sumRentaTotalPagado }}</h2>
                    <p class="mt-2 text-sm text-gray-500">Referente a mensualidades abonadas</p>
                </div>
            </Transition>
        </div>
        <div class="flex items-start rounded-xl bg-white p-3 shadow-lg m-5 flex-row border-l-4 border-amber-300 hover:scale-110 transition-transform duration-150"
            v-if="sumRentaTotalPendienteDePago">
            <Transition name="bounce">
                <div class="ml-4">
                    <h2 class="font-semibold">Total Por Pagar: <span class="text-amber-500">$</span>{{ sumRentaTotalPendienteDePago }}</h2>
                    <p class="mt-2 text-sm text-gray-500">Referente a mensualidades pendientes de pagar</p>
                </div>
            </Transition>
        </div>
        <div class="flex items-start rounded-xl bg-white p-3 shadow-lg m-5 flex-row border-l-4 border-red-300 hover:scale-110 transition-transform duration-150"
            v-if="sumRentaTotalEnMora">
            <Transition name="bounce">
                <div class="ml-4">
                    <h2 class="font-semibold">Total Atrasado: <span class="text-red-500">$</span>{{ sumRentaTotalEnMora }}</h2>
                    <p class="mt-2 text-sm text-gray-500">Referente a mensualidades atrasadas</p>
                </div>
            </Transition>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { rents } from '@/js/store/Admin/Rents.js';

const loader = rents();
let sumPrimerPagoEnRenta = ref(null), sumRentaTotalPendienteDePago = ref(null), sumRentaTotalEnMora = ref(null), sumRentaTotalPagado = ref(null);

onMounted(async () => {
    await loader.index();
    if (loader.sumFirstPaymentsEnRenta)
        sumPrimerPagoEnRenta.value = loader.precioFormatter(Number(loader.sumFirstPaymentsEnRenta.totalIvaRenta) + Number(loader.sumFirstPaymentsEnRenta.totalPagoRenta));
    if(loader.sumAllPaymentsByState['En Mora'])
        sumRentaTotalEnMora.value = loader.precioFormatter(Number(loader.sumAllPaymentsByState['En Mora']));
    if(loader.sumAllPaymentsByState['Pagado'])
        sumRentaTotalPagado.value = loader.precioFormatter(Number(loader.sumAllPaymentsByState['Pagado']));
    if(loader.sumAllPaymentsByState['Pendiente de pago'])
        sumRentaTotalPendienteDePago.value = loader.precioFormatter(Number(loader.sumAllPaymentsByState['Pendiente de pago']));
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