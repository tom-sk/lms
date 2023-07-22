<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active ? "bg-green-300" : "bg-gray-700 "
);
</script>

<template>
    <Link
        :href="href"
        class="transition-text ease block rounded-md px-3 py-2 text-base font-bold text-white transition-all transition-opacity hover:bg-gray-700 hover:opacity-75"
        :class="classes"
    >
        <slot />
    </Link>
</template>
