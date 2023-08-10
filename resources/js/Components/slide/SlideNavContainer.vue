<script setup>
import SlideNextButton from "@/Components/slide/SlideNextButton.vue";
import SlidePrevButton from "@/Components/slide/SlidePrevButton.vue";

defineProps({
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

        <SlideNextButton class="ml-auto" :slide="slide" :topic="topic" />
    </div>

    <!--                <PrimaryButton-->
    <!--                    v-else-->
    <!--                    @click="setSlide(slide.id, nextSlide, false)"-->
    <!--                >-->
    <!--                    Un mark-->
    <!--                </PrimaryButton>-->
</template>
