<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { computed } from "vue";
import slideApi from "@/api/slide-api";
import axios from "axios";

const props = defineProps({
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

const setSlide = (slide) => {
    if (slide && slide.id) {
        emits("setSlide", slide.id);

        slideApi
            .setSlideState(slide.id)
            .then((res) => {
                console.log(res);
            })
            .catch((err) => {
                console.log(err);
            });
    }
};
</script>

<template>
    <div>
        <h3 class="text-2xl font-bold">
            {{ slide.title }}
        </h3>

        <div class="flex justify-between">
            <PrimaryButton @click="setSlide(prevSlide)">
                Previous
            </PrimaryButton>

            <div>
                <PrimaryButton class="mr-4" @click="setSlide(nextSlide)">
                    Next
                </PrimaryButton>
                <PrimaryButton> Mark as complete </PrimaryButton>
            </div>
        </div>
    </div>
</template>
