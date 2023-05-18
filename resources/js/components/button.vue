<template>
    <div>
        <button type="button" :class="[
            'inline-flex items-center justify-center rounded-md border border-transparent px-4 py-2 text-sm font-medium text-white shadow-sm',
            'bg-' + colorButton, // Usa el valor de la propiedad colorButton en la clase CSS
            'hover:bg-' + colorButtonHober, // Usa el valor de la propiedad colorButtonHober en la clase CSS
            'focus:outline-none focus:ring-2 focus:ring-' + colorRingFocus + ' focus:ring-offset-2',
            'sm:w-auto',
        ]" @click="redirectToLink(href)">
            {{ text }}
        </button>
    </div>
</template>

<script setup>
defineProps({
    href: {
        type: String,
        required: false,
        default: '#',
    },
    text: {
        type: String,
        required: false,
        default: null,
    },
    colorButton: {
        type: String,
        required: false,
        default: "indigo-600",
    },
    colorButtonHober: {
        type: String,
        required: false,
        default: "indigo-700",
    },
    colorRingFocus: {
        type: String,
        required: false,
        default: "indigo-500",
    },
});
function redirectToLink(href) {
    window.location.href = href;
}
</script>

<script>
export default {
    name: 'buttonComponent',
}
</script>

<style lang="css"></style>