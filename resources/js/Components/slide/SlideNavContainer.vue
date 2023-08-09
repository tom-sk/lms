<script setup>
import SlideNextButton from "@/Components/slide/SlideNextButton.vue";
import { computed } from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SlidePrevButton from "@/Components/slide/SlidePrevButton.vue";

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
</script>

<template>
    <div class="flex w-full justify-between">
        <SlidePrevButton :slide="slide" :topic="topic" />

        <SlideNextButton :slide="slide" :topic="topic" />
    </div>

    <!--                <PrimaryButton-->
    <!--                    v-else-->
    <!--                    @click="setSlide(slide.id, nextSlide, false)"-->
    <!--                >-->
    <!--                    Un mark-->
    <!--                </PrimaryButton>-->
</template>
