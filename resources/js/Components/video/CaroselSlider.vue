<script setup>
import { Carousel, Slide } from "vue3-carousel";

import { ref } from "vue";
import {
    ChevronLeftIcon,
    ChevronRightIcon,
} from "@heroicons/vue/20/solid/index.js";
const settings = {
    itemsToShow: 4,
    snapAlign: "start",
};

const currentSlide = ref(0);

const next = () => {
    currentSlide.value++;
};

const prev = () => {
    if (currentSlide.value === 0) return;
    currentSlide.value--;
};
</script>

<template>
    <div class="grid w-full grid-cols-4">
        <div class="col-span-1">
            <ChevronLeftIcon class="w-12 cursor-pointer" @click="prev" />
        </div>

        <div class="col-span-2">
            <Carousel v-bind="settings" v-model="currentSlide">
                <Slide v-for="slide in 10" :key="slide" class="w-32 bg-red-100">
                    <div>{{ slide }}</div>
                </Slide>
            </Carousel>
        </div>

        <div class="col-span-1">
            <ChevronRightIcon class="w-12 cursor-pointer" @click="next" />
        </div>
    </div>
</template>
