<template>
    <div class="col-span-6 sm:col-span-6">
        <Listbox as="div" v-model="selected" @click.prevent="handleSelection()">
            <ListboxLabel class="block text-sm font-medium text-gray-700">Disponibilidad Del Equipo</ListboxLabel>
            <div class="relative mt-1 rounded-md shadow-sm">
                <ListboxButton :class="[
                    'relative w-full cursor-default rounded-md border ',
                    errorsList ? 'border-red-300' : 'border-gray-300',
                    ' bg-white py-2 pl-3 pr-10 text-left shadow-sm ',
                    errorsList ? 'focus:border-red-500' : 'focus:border-green-500',
                    ' focus:outline-none focus:ring-1 ',
                    errorsList ? 'focus:ring-red-500' : 'focus:ring-green-500',
                    ' sm:text-sm'
                ]">
                    <span class="block truncate">{{ selected?.disponibilidad || 'Seleccione una disponibilidad' }}</span>
                    <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                        <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                    </span>
                </ListboxButton>
                <transition leave-active-class="transition ease-in duration-100" leave-from-class="opacity-100"
                    leave-to-class="opacity-0">
                    <ListboxOptions
                        class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                        aria-invalid="true" aria-describedby="disponibilidad-error">
                        <ListboxOption as="template" v-for="status in list" :key="status.clvDisponibilidad" :value="status"
                            v-slot="{ active, selected }">
                            <li
                                :class="[active ? 'text-white bg-green-600' : 'text-gray-900', 'relative cursor-default select-none py-2 pl-3 pr-9']">
                                <span :class="[selected ? 'font-semibold' : 'font-normal', 'block truncate']">{{
                                    status.disponibilidad
                                }}</span>
                                <span v-if="selected"
                                    :class="[active ? 'text-white' : 'text-green-600', 'absolute inset-y-0 right-0 flex items-center pr-4']">
                                    <CheckIcon class="h-5 w-5" aria-hidden="true" />
                                </span>
                            </li>
                        </ListboxOption>
                    </ListboxOptions>
                </transition>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3" v-if="errorsList">
                    <ExclamationCircleIcon class="h-5 w-5 text-red-500" aria-hidden="true" />
                </div>
            </div>
            <div v-if="errorsList">
                <ul>
                    <li class="mt-2 text-sm text-red-600" id="disponibilidad-error" v-for="error in errorsList"
                        :key="error">{{
                            error }}</li>
                </ul>
            </div>
        </Listbox>
    </div>
</template>

<script setup>
import { defineProps, defineEmits, ref } from 'vue';
import { Listbox, ListboxButton, ListboxLabel, ListboxOption, ListboxOptions } from '@headlessui/vue';
import { CheckIcon, ChevronUpDownIcon, ExclamationCircleIcon } from '@heroicons/vue/20/solid';

const props = defineProps({
    list: {
        type: Array,
        required: false,
        default: [],
    },
    select: {
        type: Number,
        required: false,
        default: () => null,
    },
    errorsList: {
        type: String,
        required: false,
        default: () => "",
    },
});
const selected = ref(props.list[props.select]);
const emit = defineEmits([
    'status-selected'
]);
const handleSelection = () => {
    let status = "";
    if (selected.value)
        status = selected.value;
    emit("status-selected", status);
};
</script>

<script>
export default {
    name: 'listBoxStatusComponent',
}
</script>

<style lang="scss" scoped></style>