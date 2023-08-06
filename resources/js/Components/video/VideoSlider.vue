<script setup>
import VimeoPlayer from "@/Components/video/VimeoPlayer.vue";
import { Carousel, Slide } from "vue3-carousel";
import { ref } from "vue";
import {
    ChevronLeftIcon,
    ChevronRightIcon,
} from "@heroicons/vue/20/solid/index.js";

const emit = defineEmits(["setVideo"]);
defineProps({
    videos: {
        type: Array,
        required: true,
    },
});

const settings = {
    itemsToShow: 2,
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

const setVideo = (video) => {
    emit("setVideo", video);
};
</script>

<template>
    <div class="flex max-w-6xl flex-col justify-center">
        <div class="">
            <div class="flex w-full items-center">
                <div class="w-12">
                    <ChevronLeftIcon
                        class="w-12 cursor-pointer"
                        @click="prev"
                    />
                </div>

                <div class="w-full">
                    <Carousel v-bind="settings" v-model="currentSlide">
                        <Slide
                            v-for="video in videos"
                            :key="video.id"
                            class="h-32 bg-red-100"
                        >
                            <div class="p-4" @click="setVideo(video)">
                                <img
                                    :src="'/storage/' + video.thumbnail"
                                    class="cursor-pointer hover:opacity-75"
                                />
                            </div>
                        </Slide>
                    </Carousel>
                </div>

                <div class="w-12">
                    <ChevronRightIcon
                        class="w-12 cursor-pointer"
                        @click="next"
                    />
                </div>
            </div>
        </div>
    </div>
</template>
