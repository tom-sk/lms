<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
defineOptions({ layout: AuthenticatedLayout });
import { computed, onBeforeMount, onMounted, ref } from "vue";
import { Head, Link } from "@inertiajs/vue3";
import {
    Dialog,
    DialogPanel,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import { Bars3Icon, XMarkIcon } from "@heroicons/vue/24/outline";
import TopicSlide from "@/Components/slide/SlideItem.vue";
import TopicSideNav from "@/Components/TopicSideNav.vue";
import TopicSlideMobileNav from "@/Components/TopicSlideMobileNav.vue";

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
});

const topicSlides = ref([]);
const sidebarOpen = ref(false);
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
    <div class="">
        <div
            class="hidden lg:fixed lg:inset-y-0 lg:top-16 lg:z-50 lg:flex lg:w-72 lg:flex-col"
        >
            <TopicSideNav
                :topic="topic"
                :topics="topics"
                :module="module"
                :slides="topicSlides"
                :active-slide="activeSlide"
                @set-slide="setSlide"
            />
        </div>

        <TopicSlideMobileNav :topics="topics" :module="module" />

        <main class="lg:pl-72">
            <div class="grid grid-cols-2 xl:pl-0">
                <div class="bg-blue-200 px-4 py-10 sm:px-6 lg:px-8 lg:py-6">
                    <TopicSlide
                        :topic="topic"
                        :slide="activeSlide"
                        :slides="topicSlides"
                        @set-slide="setSlide"
                        @set-all-slides="setAllSlides"
                    />
                </div>
                <div>Resources</div>
            </div>
        </main>
    </div>
</template>
