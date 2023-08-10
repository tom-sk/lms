<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { computed } from "vue";
import { useSlidesStore } from "@/stores/slides.js";
import { storeToRefs } from "pinia";
const slidesStore = useSlidesStore();
const { setSlideAPI } = slidesStore;
const { topicSlides } = storeToRefs(slidesStore);

const props = defineProps({
    slide: {
        type: Object,
        required: true,
    },
});

const prevSlide = computed(() => {
    const index = topicSlides.value.findIndex((s) => s.id === props.slide.id);
    return topicSlides.value[index - 1] ? topicSlides.value[index - 1] : null;
});
</script>

<template>
    <PrimaryButton v-if="prevSlide" @click="setSlideAPI(slide.id, prevSlide)">
        Previous
    </PrimaryButton>
</template>
