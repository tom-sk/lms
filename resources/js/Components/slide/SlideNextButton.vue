<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { useSlidesStore } from "@/stores/slides.js";
import { storeToRefs } from "pinia";

const slidesStore = useSlidesStore();
const { nextTopic, nextSlide } = storeToRefs(slidesStore);
const { setSlideAPI } = slidesStore;

defineProps({
    slide: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <div v-if="nextSlide || nextTopic">
        <PrimaryButton
            v-if="!slide.slide_complete"
            @click="setSlideAPI(slide.id, nextSlide, true)"
        >
            Complete and Continue
        </PrimaryButton>
        <PrimaryButton v-else @click="setSlideAPI(slide.id, nextSlide)">
            Continue
        </PrimaryButton>
    </div>
    <div v-else>
        <PrimaryButton
            v-if="!slide.slide_complete"
            @click="setSlideAPI(slide.id, nextSlide, true)"
        >
            Complete
        </PrimaryButton>
    </div>
</template>
