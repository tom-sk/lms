<script setup>
import { router } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import { FireIcon } from "@heroicons/vue/24/outline/index.js";
import BardContainer from "@/Components/bard/BardContainer.vue";

defineProps({
    modules: {
        type: Array,
        required: true,
    },
});

function submit(id) {
    router.post(route("module.enrol", id));
}
</script>

<template>
    <div class="grid grid-cols-1 gap-12">
        <div
            v-for="module in modules"
            :key="module.email"
            class="relative flex items-center space-x-3 rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:border-gray-400"
        >
            <div class="flex w-full flex-col items-center justify-between">
                <div class="mb-8 grid grid-cols-2 gap-4">
                    <div>
                        <h4 class="mb-6 text-xl font-bold text-gray-900">
                            {{ module.title }}
                        </h4>

                        <span v-if="module.progress > 0">
                            {{ module.progress }}%</span
                        >

                        <BardContainer :content="module.content" />

                        <form
                            v-if="!module.enrolled"
                            @submit.prevent="submit(module.id)"
                        >
                            <button
                                type="submit"
                                class="rounded-md bg-white px-3.5 py-2.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                            >
                                Enrol
                            </button>
                        </form>
                        <Link v-else :href="route('module', module.id)">
                            <button
                                type="button"
                                class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                            >
                                <span v-if="module.progress > 0">Continue</span>
                                <span v-else>Start</span>
                            </button>
                        </Link>
                    </div>
                    <div>Module LOGO</div>
                </div>

                <div class="mb-8 w-full rounded bg-gray-200 p-4">
                    <div class="flex items-center">
                        <FireIcon class="w-6" />
                        <span>{{ module.topics.length }} Topics</span>
                    </div>
                </div>

                <h4 class="mr-auto text-xl font-bold">Topics</h4>
                <ul
                    class="grid w-full grid-cols-2 gap-4 rounded bg-gray-300 p-4"
                >
                    <li v-for="topic in module.topics" :key="topic.id" class="">
                        {{ topic.title }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>
