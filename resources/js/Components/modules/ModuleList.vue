<script setup>
import { router } from "@inertiajs/vue3";

defineProps({
    modules: {
        type: Array,
        required: true,
    },
});

function submit(id) {
    console.log("post!");
    router.post(route("module.enrol", id));
}
</script>

<template>
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
        <div
            v-for="module in modules"
            :key="module.email"
            class="relative flex items-center space-x-3 rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:border-gray-400"
        >
            <div class="flex w-full flex-col items-center justify-between">
                <p class="mb-6 text-sm font-medium text-gray-900">
                    {{ module.title }}
                </p>

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
                <button
                    v-else
                    type="button"
                    class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                >
                    Start
                </button>
            </div>
        </div>
    </div>
</template>
