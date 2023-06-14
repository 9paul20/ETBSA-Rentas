<template>
    <div>
        <button :type="type" :class="[
            'inline-flex items-center justify-center rounded-md border',
            'border-' + borderColor,
            'px-4 py-2 text-sm font-medium',
            'text-' + textColor,
            'shadow-sm',
            'bg-' + colorButton, // Usa el valor de la propiedad colorButton en la clase CSS
            'hover:bg-' + colorButtonHover, // Usa el valor de la propiedad colorButtonHober en la clase CSS
            'focus:outline-none focus:ring-2 focus:ring-' + colorRingFocus,
            'focus:ring-offset-2 sm:w-auto',
            addClass
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
    type: {
        type: String,
        required: false,
        default: "button",
    },
    colorButton: {
        type: String,
        required: false,
        default: "indigo-600",
    },
    colorButtonHover: {
        type: String,
        required: false,
        default: "indigo-700",
    },
    colorRingFocus: {
        type: String,
        required: false,
        default: "indigo-500",
    },
    borderColor: {
        type: String,
        required: false,
        default: "transparent",
    },
    textColor: {
        type: String,
        required: false,
        default: "white",
    },
    addClass: {
        type: String,
        required: false,
        default: "",
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