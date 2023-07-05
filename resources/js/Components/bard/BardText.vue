<script setup>
import { computed } from "vue";

const props = defineProps({
    text: {
        type: Array,
        required: true,
        default: () => [],
    },
});

const formatted = computed(() => {
    if (props.text.length >= 1) {
        return { ...props.text[0] };
    } else {
        return { ...props.text };
    }
});
</script>

<template>
    <p v-html="formatted.text" />
</template>
