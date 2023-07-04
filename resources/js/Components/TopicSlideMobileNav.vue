<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import {
    Dialog,
    DialogPanel,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import { Bars3Icon, XMarkIcon } from "@heroicons/vue/24/outline";

defineProps({
    topics: {
        type: Array,
        required: true,
    },
    module: {
        type: Object,
        required: true,
    },
});

const sidebarOpen = ref(false);
</script>

<template>
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
                                    <span class="sr-only">Close sidebar</span>
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
                                        <ul role="list" class="-mx-2 space-y-1">
                                            <li
                                                v-for="item in topics"
                                                :key="item.title"
                                            >
                                                <Link
                                                    :href="
                                                        route('module.topics', {
                                                            module: module.id,
                                                            topic: item.id,
                                                        })
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
            Topics
        </div>
    </div>
</template>
