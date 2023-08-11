<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
defineOptions({ layout: AuthenticatedLayout });
import { Head, Link } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { FireIcon } from "@heroicons/vue/24/outline/index.js";
import ProgressBar from "@/Components/ProgressBar.vue";

defineProps({
    module: {
        type: Object,
        required: true,
    },
    progress: {
        type: Number,
        required: true,
    },
    topics: {
        type: Array,
        required: true,
    },
});
</script>

<template>
    <Head title="Module" />

    <div class="p-4">
        <div class="rounded-md bg-white p-8">
            <h1 class="mb-8 text-3xl font-bold">{{ module.title }}</h1>
            <p class="mb-8">Module content</p>

            <ProgressBar class="mb-12" :progress="progress" />

            <h4 class="mb-4 text-2xl font-bold">Topics</h4>

            <div class="space-y-4">
                <div
                    v-for="topic in topics"
                    :key="topic.id"
                    class="flex items-center justify-between rounded-xl bg-blue-200 p-4"
                >
                    <div class="flex flex-col">
                        {{ topic.title }}

                        <div class="flex space-x-4">
                            <div class="flex">
                                <FireIcon class="w-6" />{{ topic.slideCount }}
                                Slides
                            </div>

                            <div v-if="topic.progress > 0">
                                {{ topic.progress }}% Complete
                            </div>
                        </div>
                    </div>

                    <Link
                        :href="
                            route('module.topics', {
                                module: module.id,
                                topic: topic.id,
                            })
                        "
                    >
                        <PrimaryButton v-if="topic.progress > 0">
                            Continue
                        </PrimaryButton>
                        <PrimaryButton v-else>Start</PrimaryButton>
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>
