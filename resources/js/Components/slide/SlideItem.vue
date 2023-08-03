<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { computed } from "vue";
import slideApi from "@/api/slide-api";
import { CheckIcon } from "@heroicons/vue/20/solid/index.js";
import BardContainer from "@/Components/bard/BardContainer.vue";

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
const emits = defineEmits(["setSlide", "setAllSlides"]);

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
            emits("setAllSlides", res.data.slides);
        })
        .catch((err) => {
            console.log(err);
        });
};
</script>

<template>
    <div
        class="rounded-xl border-2 border-dashed border-green-300 bg-white p-8"
    >
        <h3 class="mb-12 flex text-2xl font-bold">
            <CheckIcon v-if="slide.slide_complete" class="mr-4 h-6 w-6" />

            {{ slide.title }}
        </h3>

        <div>
            <BardContainer
                v-if="slide.content"
                :content="JSON.parse(slide.content)"
            />
        </div>

        <div class="flex justify-between">
            <PrimaryButton @click="setSlide(slide.id, prevSlide)">
                Previous
            </PrimaryButton>

            <div>
                <PrimaryButton
                    v-if="!slide.slide_complete"
                    @click="setSlide(slide.id, nextSlide, true)"
                >
                    Complete
                </PrimaryButton>
                <PrimaryButton v-else @click="setSlide(slide.id, nextSlide)">
                    Next
                </PrimaryButton>

                <!--                <PrimaryButton-->
                <!--                    v-else-->
                <!--                    @click="setSlide(slide.id, nextSlide, false)"-->
                <!--                >-->
                <!--                    Un mark-->
                <!--                </PrimaryButton>-->
            </div>
        </div>
    </div>
</template>
