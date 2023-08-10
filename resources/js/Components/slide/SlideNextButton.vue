<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { useSlidesStore } from "@/stores/slides.js";
import { computed } from "vue";
import { storeToRefs } from "pinia";
import { Link } from "@inertiajs/vue3";

const slidesStore = useSlidesStore();
const { topicSlides, nextTopic, module } = storeToRefs(slidesStore);
const { setSlideAPI } = slidesStore;

const props = defineProps({
    slide: {
        type: Object,
        required: true,
    },
});

const nextSlide = computed(() => {
    const index = topicSlides.value.findIndex((s) => s.id === props.slide.id);

    return topicSlides.value[index + 1] ? topicSlides.value[index + 1] : null;
});
</script>

<template>
    <div>
        <div v-if="nextSlide">
            <PrimaryButton
                v-if="!slide.slide_complete"
                @click="setSlideAPI(slide.id, nextSlide, true)"
            >
                Complete and Continue
            </PrimaryButton>
            <PrimaryButton v-else @click="setSlideAPI(slide.id, nextSlide)">
                Complete and Continue
            </PrimaryButton>
        </div>
        <div v-else>
            <Link
                v-if="nextTopic"
                :href="
                    route('module.topics', {
                        module: module.id,
                        topic: nextTopic.id,
                    })
                "
            >
                <PrimaryButton> Next Topic </PrimaryButton>
            </Link>
        </div>
    </div>
</template>
