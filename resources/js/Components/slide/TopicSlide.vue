<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { computed } from "vue";
import slideApi from "@/api/slide-api";

const props = defineProps({
    topic: {
        type: Object,
        required: true,
    },
    slide: {
        type: Object,
        required: true,
    },
    slides: {
        type: Array,
        required: true,
    },
});
const emits = defineEmits(["setSlide"]);

const nextSlide = computed(() => {
    const index = props.slides.findIndex((s) => s.id === props.slide.id);
    return props.slides[index + 1] ? props.slides[index + 1] : null;
});

const prevSlide = computed(() => {
    const index = props.slides.findIndex((s) => s.id === props.slide.id);
    return props.slides[index - 1] ? props.slides[index - 1] : null;
});

const setSlide = (currentSlideId, nextSlide, complete) => {
    if (nextSlide && nextSlide.id) {
        emits("setSlide", nextSlide.id);
    }

    slideApi
        .setSlideState({
            slide_id: currentSlideId,
            slide_complete: complete,
            topic_id: props.topic.id,
        })
        .then((res) => {
            console.log(res.data);
        })
        .catch((err) => {
            console.log(err);
        });
};
</script>

<template>
    <div>
        <h3 class="text-2xl font-bold">
            {{ slide.title }}
            {{ slide.slide_complete }}
        </h3>

        <div class="flex justify-between">
            <PrimaryButton @click="setSlide(slide.id, prevSlide)">
                Previous
            </PrimaryButton>

            <div>
                <PrimaryButton
                    class="mr-4"
                    @click="setSlide(slide.id, nextSlide)"
                >
                    Next
                </PrimaryButton>
                <PrimaryButton @click="setSlide(slide.id, nextSlide, true)">
                    Mark as complete
                </PrimaryButton>
            </div>
        </div>
    </div>
</template>
