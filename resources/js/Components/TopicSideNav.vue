<script setup>
import { Link } from "@inertiajs/vue3";
import { CheckCircleIcon } from "@heroicons/vue/24/outline";

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
    <div
        class="hidden lg:fixed lg:inset-y-0 lg:top-16 lg:z-50 lg:flex lg:w-72 lg:flex-col"
    >
        <!-- Sidebar component, swap this element with another sidebar if you like -->
        <div
            class="flex grow flex-col gap-y-5 overflow-y-auto border-r border-gray-200 bg-white px-6"
        >
            <nav class="mt-6 flex flex-1 flex-col">
                <ul role="list" class="flex flex-1 flex-col gap-y-7">
                    <li>
                        <ul role="list" class="-mx-2 space-y-4">
                            <li v-for="item in topics" :key="item.title">
                                <Link
                                    class="text-lg font-bold"
                                    :href="
                                        route('module.topics', {
                                            module: module.id,
                                            topic: item.id,
                                        })
                                    "
                                >
                                    {{ item.title }}
                                </Link>

                                <ul v-if="topic.id === item.id" class="pl-2">
                                    <li
                                        v-for="slide in slides"
                                        :key="slide.id"
                                        :class="{
                                            'font-bold':
                                                slide.id === activeSlide.id,
                                        }"
                                        class="flex cursor-pointer"
                                        @click="setSlide(slide.id)"
                                    >
                                        <CheckCircleIcon
                                            :class="{
                                                'text-green-400':
                                                    slide.slide_complete,
                                            }"
                                            class="mr-4 h-6 w-6"
                                        />
                                        {{ slide.title }}
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
