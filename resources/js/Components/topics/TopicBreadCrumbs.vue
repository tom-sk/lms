<script setup>
import { Link } from "@inertiajs/vue3";
import { useSlidesStore } from "@/stores/slides.js";
import { storeToRefs } from "pinia";
const slidesStore = useSlidesStore();
const { module, topic } = storeToRefs(slidesStore);
</script>

<template>
    <nav class="flex justify-start bg-black p-4" aria-label="Breadcrumb">
        <ol
            class="mx-auto inline-flex w-full max-w-7xl items-start space-x-1 px-4 sm:px-6 md:space-x-3 lg:px-8"
        >
            <li class="inline-flex items-center">
                <Link
                    :href="route('dashboard')"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white"
                >
                    <svg
                        class="mr-2.5 h-3 w-3"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                    >
                        <path
                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"
                        />
                    </svg>
                    Dashboard
                </Link>
            </li>
            <li>
                <div class="flex items-center">
                    <svg
                        class="mx-1 h-3 w-3 text-gray-400"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 6 10"
                    >
                        <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="m1 9 4-4-4-4"
                        />
                    </svg>
                    <Link
                        v-if="module"
                        :href="route('module', module.id)"
                        class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white md:ml-2"
                    >
                        {{ module.title }}
                    </Link>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg
                        class="mx-1 h-3 w-3 text-gray-400"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 6 10"
                    >
                        <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="m1 9 4-4-4-4"
                        />
                    </svg>
                    <span
                        v-if="topic"
                        class="ml-1 cursor-pointer text-sm font-medium text-gray-500 dark:text-gray-400 md:ml-2"
                        >{{ topic.title }}</span
                    >
                </div>
            </li>
        </ol>
    </nav>
</template>
