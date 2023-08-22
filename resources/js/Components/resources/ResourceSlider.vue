<script setup>
import { ref } from "vue";

import SliderContainer from "@/Components/SliderContainer.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

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
        <div class="flex justify-between">
            <h5 class="text-bold text-xl">{{ activeResource.title }}</h5>
            {{ activeResource.type }}
        </div>
        <a :href="'/storage/' + activeResource.content" download>
            <PrimaryButton class="mt-4"> Download </PrimaryButton>
        </a>
    </div>

    <SliderContainer :items="resources" @set-item="setResource" />
</template>
