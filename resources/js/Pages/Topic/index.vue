<script setup>
import TopicLayout from "@/Layouts/TopicLayout.vue";
defineOptions({ layout: TopicLayout });

import { useSlidesStore } from "@/stores/slides.js";
import { storeToRefs } from "pinia";
const slidesStore = useSlidesStore();
const { topicSlides, activeSlide } = storeToRefs(slidesStore);
const { setSlide, setAllSlides, setTopic, setTopics, setModule, setProgress } =
    slidesStore;
import { onBeforeMount, ref } from "vue";
import { Head } from "@inertiajs/vue3";
import SlideItem from "@/Components/slide/SlideItem.vue";
import TopicSideNav from "@/Components/TopicSideNav.vue";
import TopicSlideMobileNav from "@/Components/TopicSlideMobileNav.vue";
import VimeoPlayer from "@/Components/video/VimeoPlayer.vue";
import VideoSlider from "@/Components/video/VideoSlider.vue";

const props = defineProps({
    module: {
        type: Object,
        required: true,
    },
    moduleProgress: {
        type: Number,
        required: true,
    },
    topic: {
        type: Object,
        required: true,
    },
    topics: {
        type: Array,
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
    videos: {
        type: Array,
        required: false,
        default: () => [],
    },
});

const activeVideo = ref(props.videos[0]);

const setVideo = (video) => {
    activeVideo.value = video;
};

const image = "/storage/" + activeVideo.value.thumbnail;

onBeforeMount(() => {
    setAllSlides(props.slides);
    setSlide(props.slide.id);
    setTopic(props.topic);
    setTopics(props.topics);
    setModule(props.module);
    setProgress(props.moduleProgress);
});
</script>

<template>
    <Head :title="'Topic ' + topic.id" />

    <div class="flex w-full flex-col items-stretch bg-gray-50 lg:flex-row">
        <TopicSlideMobileNav :topics="topics" :module="module" />
        <div class="hidden h-full lg:block lg:w-1/5">
            <TopicSideNav
                :topic="topic"
                :topics="topics"
                :module="module"
                :slides="topicSlides"
                :active-slide="activeSlide"
                @set-slide="setSlide"
            />
        </div>

        <div class="h-full lg:w-4/5">
            <div class="grid grid-cols-2 xl:pl-0">
                <div class="px-4 py-10 sm:px-6 lg:px-4 lg:py-6">
                    <SlideItem
                        :topic="topic"
                        :slide="activeSlide"
                        :slides="topicSlides"
                    />
                </div>
                <div class="pt-4">
                    <div class="mb-8 rounded-2xl bg-white p-4">
                        <div
                            class="bg-cover bg-center"
                            :style="{
                                backgroundImage: 'url(' + image + ')',
                            }"
                        >
                            <VimeoPlayer
                                class="w-full"
                                :video-url="activeVideo.url"
                            />
                        </div>
                    </div>

                    <VideoSlider :videos="videos" @set-video="setVideo" />
                </div>
            </div>
        </div>
    </div>
</template>
