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
import VideoSlider from "@/Components/video/VideoSlider.vue";
import ResourceSlider from "@/Components/resources/ResourceSlider.vue";

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
    resources: {
        type: Array,
        required: false,
        default: () => [],
    },
});

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

        <div class="mr-4 h-full lg:w-4/5">
            <div class="grid grid-cols-2 xl:pl-0">
                <div class="px-4 py-10 sm:px-6 lg:px-4 lg:py-6">
                    <SlideItem
                        :topic="topic"
                        :slide="activeSlide"
                        :slides="topicSlides"
                    />
                </div>
                <div class="pb-12 pt-4">
                    <div class="mb-12">
                        <VideoSlider :videos="videos" />
                    </div>

                    <ResourceSlider :resources="resources" />
                </div>
            </div>
        </div>
    </div>
</template>
