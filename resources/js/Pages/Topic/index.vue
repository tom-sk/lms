<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
defineOptions({ layout: AuthenticatedLayout });
import { computed, ref } from "vue";
import { Head, Link } from "@inertiajs/vue3";
import {
    Dialog,
    DialogPanel,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import { Bars3Icon, XMarkIcon } from "@heroicons/vue/24/outline";
import TopicSlide from "@/Components/slide/TopicSlide.vue";

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

const sidebarOpen = ref(false);
const slideId = ref(props.slide.id);

const setSlide = (slide) => {
    slideId.value = slide;
};

const activeSlide = computed(() => {
    return props.slides.find((slide) => slide.id === slideId.value);
});
</script>

<template>
    <Head :title="'Topic ' + topic.id" />
    <div class="">
        <TransitionRoot as="template" :show="sidebarOpen">
            <Dialog
                as="div"
                class="relative z-50 lg:hidden"
                @close="sidebarOpen = false"
            >
                <TransitionChild
                    as="template"
                    enter="transition-opacity ease-linear duration-300"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="transition-opacity ease-linear duration-300"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                >
                    <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" />
                </TransitionChild>

                <div class="fixed inset-0 flex">
                    <TransitionChild
                        as="template"
                        enter="transition ease-in-out duration-300 transform"
                        enter-from="-translate-x-full"
                        enter-to="translate-x-0"
                        leave="transition ease-in-out duration-300 transform"
                        leave-from="translate-x-0"
                        leave-to="-translate-x-full"
                    >
                        <DialogPanel
                            class="relative mr-16 flex w-full max-w-xs flex-1"
                        >
                            <TransitionChild
                                as="template"
                                enter="ease-in-out duration-300"
                                enter-from="opacity-0"
                                enter-to="opacity-100"
                                leave="ease-in-out duration-300"
                                leave-from="opacity-100"
                                leave-to="opacity-0"
                            >
                                <div
                                    class="absolute left-full top-0 flex w-16 justify-center pt-5"
                                >
                                    <button
                                        type="button"
                                        class="-m-2.5 p-2.5"
                                        @click="sidebarOpen = false"
                                    >
                                        <span class="sr-only"
                                            >Close sidebar</span
                                        >
                                        <XMarkIcon
                                            class="h-6 w-6 text-white"
                                            aria-hidden="true"
                                        />
                                    </button>
                                </div>
                            </TransitionChild>
                            <!-- Sidebar component, swap this element with another sidebar if you like -->
                            <div
                                class="flex grow flex-col gap-y-5 overflow-y-auto bg-white px-6 pb-2"
                            >
                                <nav class="flex flex-1 flex-col">
                                    <ul
                                        role="list"
                                        class="flex flex-1 flex-col gap-y-7"
                                    >
                                        <li>
                                            <ul
                                                role="list"
                                                class="-mx-2 space-y-1"
                                            >
                                                <li
                                                    v-for="item in topics"
                                                    :key="item.title"
                                                >
                                                    <Link
                                                        :href="
                                                            route(
                                                                'module.topics',
                                                                {
                                                                    module: module.id,
                                                                    topic: item.id,
                                                                }
                                                            )
                                                        "
                                                    >
                                                        {{ item.title }}
                                                    </Link>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </Dialog>
        </TransitionRoot>

        <!-- Static sidebar for desktop -->
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

                                    <ul
                                        v-if="topic.id === item.id"
                                        class="pl-2"
                                    >
                                        <li
                                            v-for="slide in slides"
                                            :key="slide.id"
                                            :class="{
                                                'font-bold':
                                                    slide.id === activeSlide.id,
                                            }"
                                            class="cursor-pointer"
                                            @click="setSlide(slide.id)"
                                        >
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

        <div
            class="sticky top-0 z-40 flex items-center gap-x-6 bg-white px-4 py-4 shadow-sm sm:px-6 lg:hidden"
        >
            <button
                type="button"
                class="-m-2.5 p-2.5 text-gray-700 lg:hidden"
                @click="sidebarOpen = true"
            >
                <span class="sr-only">Open sidebar</span>
                <Bars3Icon class="h-6 w-6" aria-hidden="true" />
            </button>
            <div class="flex-1 text-sm font-semibold leading-6 text-gray-900">
                Dashboard
            </div>
            <a href="#">
                <span class="sr-only">Your profile</span>
                <img
                    class="h-8 w-8 rounded-full bg-gray-50"
                    src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                    alt=""
                />
            </a>
        </div>

        <main class="lg:pl-72">
            <div class="grid grid-cols-2 xl:pl-0">
                <div class="bg-blue-200 px-4 py-10 sm:px-6 lg:px-8 lg:py-6">
                    <!-- Main area -->
                    <TopicSlide
                        :slide="activeSlide"
                        :slides="slides"
                        @set-slide="setSlide"
                    />
                </div>
                <div>Resources</div>
            </div>
        </main>
    </div>
</template>
