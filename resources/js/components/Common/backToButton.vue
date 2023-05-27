<template>
    <div>
        <button type="button" @click="redirectToLink(href)"
            class="inline-flex items-center rounded-md border border-transparent px-4 py-2 text-base font-medium shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2"
            :class="['text-' + textColor + ' bg-' + bgColor + ' hover:bg-' + bgColorHover + ' focus:ring-' + ringColorFocus]">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
            </svg>
            {{ text }}
        </button>
    </div>
</template>

<script setup>
name: 'backToButtonComponent';
const props = defineProps({
    href: {
        type: String,
        required: false,
        default: '#',
    },
    text: {
        type: String,
        required: false,
        default: 'Default',
    },
    textColor: {
        type: String,
        required: false,
        default: 'text-black',
    },
    bgColor: {
        type: String,
        required: false,
        default: 'indigo-600',
    },
    bgColorHover: {
        type: String,
        required: false,
        default: 'indigo-700',
    },
    ringColorFocus: {
        type: String,
        required: false,
        default: 'ring-indigo-500',
    },
});
const redirectToLink = (href) => {
    window.location.href = href;
}
</script>

<style lang="scss" scoped></style>