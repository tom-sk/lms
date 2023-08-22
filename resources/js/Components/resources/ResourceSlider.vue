<script setup>
import { ref } from "vue";

import SliderContainer from "@/Components/SliderContainer.vue";

const props = defineProps({
    resources: {
        type: Array,
        required: true,
    },
});

const setResource = (resource) => {
    activeResource.value = resource;
};

const activeResource = ref(props.resources[0]);
</script>

<template>
    <div class="mb-8 rounded-2xl bg-white p-4">
        {{ activeResource }}
    </div>

    <SliderContainer :items="resources" @set-item="setResource" />
</template>
