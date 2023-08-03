<script setup>
import TopicLayout from "@/Layouts/TopicLayout.vue";

defineOptions({ layout: TopicLayout });
import { computed, onBeforeMount, ref } from "vue";
import { Head } from "@inertiajs/vue3";
import TopicSlide from "@/Components/slide/SlideItem.vue";
import TopicSideNav from "@/Components/TopicSideNav.vue";
import TopicSlideMobileNav from "@/Components/TopicSlideMobileNav.vue";
import VimeoPlayer from "@/Components/video/VimeoPlayer.vue";

const props = defineProps({
    module: {
        type: Object,
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
    },
});

const topicSlides = ref([]);
const slideId = ref(null);

const setSlide = (slide) => {
    slideId.value = slide;
};

const activeSlide = computed(() => {
    return topicSlides.value.find((slide) => slide.id === slideId.value);
});

const setAllSlides = (slides) => {
    topicSlides.value = slides;
};

onBeforeMount(() => {
    setAllSlides(props.slides);
    setSlide(props.slide.id);
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
                    <TopicSlide
                        :topic="topic"
                        :slide="activeSlide"
                        :slides="topicSlides"
                        @set-slide="setSlide"
                        @set-all-slides="setAllSlides"
                    />
                </div>
                <div>
                    <div v-for="video in videos" :key="video.id" class="w-full">
                        <div>
                            <VimeoPlayer :video-url="video.url" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
