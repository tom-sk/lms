<script setup>
import { Link } from "@inertiajs/vue3";
import { CheckCircleIcon, ChevronRightIcon } from "@heroicons/vue/24/outline";
import TopicProgress from "@/Components/topics/TopicProgress.vue";

defineProps({
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
    slides: {
        type: Array,
        required: true,
    },
    activeSlide: {
        type: Object,
        required: true,
    },
});

const emit = defineEmits(["setSlide"]);

const setSlide = (slide) => {
    emit("setSlide", slide);
};
</script>

<template>
    <div class="min-h-full bg-green-300">
        <!-- Sidebar component, swap this element with another sidebar if you like -->
        <div
            class="flex grow flex-col overflow-y-auto border-r border-gray-200 bg-green-200 font-bold text-white"
        >
            <TopicProgress />

            <nav class="flex flex-1 flex-col">
                <ul role="list" class="flex flex-1 flex-col">
                    <li>
                        <ul role="list" class="">
                            <li
                                v-for="item in topics"
                                :key="item.title"
                                class="border-b border-white p-4"
                                :class="{
                                    'bg-green-300': !$page.url.startsWith(
                                        `/module/${module.id}/topic/${item.id}`
                                    ),
                                }"
                            >
                                <Link
                                    class="cursor-pointer text-lg font-bold transition-opacity hover:opacity-75"
                                    :href="
                                        route('module.topics', {
                                            module: module.id,
                                            topic: item.id,
                                        })
                                    "
                                >
                                    {{ item.title }}
                                </Link>

                                <ul v-if="topic.id === item.id" class="pl-4">
                                    <li
                                        v-for="slide in slides"
                                        :key="slide.id"
                                        class="flex cursor-pointer transition-opacity hover:opacity-75"
                                        @click="setSlide(slide.id)"
                                    >
                                        <ChevronRightIcon
                                            v-if="slide.id === activeSlide.id"
                                            class="h-6 w-6"
                                        />

                                        <span
                                            :class="{
                                                'ml-6':
                                                    slide.id !== activeSlide.id,
                                            }"
                                            >{{ slide.title }}</span
                                        >
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>
