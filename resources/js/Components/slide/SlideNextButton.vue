<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import slideApi from "@/api/slide-api.js";

const props = defineProps({
    slide: {
        type: Object,
        required: true,
    },
    topic: {
        type: Object,
        required: true,
    },
});

import { useSlidesStore } from "@/stores/slides.js";
import { computed } from "vue";
import { storeToRefs } from "pinia";
const slidesStore = useSlidesStore();
const { topicSlides } = storeToRefs(slidesStore);
const { setSlideAPI } = slidesStore;

const nextSlide = computed(() => {
    const index = topicSlides.value.findIndex((s) => s.id === props.slide.id);

    return topicSlides.value[index + 1] ? topicSlides.value[index + 1] : null;
});
</script>

<template>
    <PrimaryButton
        v-if="!slide.slide_complete"
        @click="setSlideAPI(slide.id, nextSlide, true)"
    >
        Complete
    </PrimaryButton>
    <PrimaryButton v-else @click="setSlideAPI(slide.id, nextSlide)">
        Next
    </PrimaryButton>
</template>
