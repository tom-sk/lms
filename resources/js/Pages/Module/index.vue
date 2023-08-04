<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
defineOptions({ layout: AuthenticatedLayout });
import { Head, Link } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import VideoSlider from "@/Components/video/VideoSlider.vue";
import CaroselSlider from "@/Components/video/CaroselSlider.vue";

defineProps({
    module: {
        type: Object,
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

    <div>
        <div
            v-for="topic in topics"
            :key="topic.id"
            class="flex flex-col items-center"
        >
            {{ topic.title }}

            <!--            <VideoSlider :videos="topic.videos" />-->

            <CaroselSlider />

            <Link
                :href="
                    route('module.topics', {
                        module: module.id,
                        topic: topic.id,
                    })
                "
            >
                <PrimaryButton class="mb-4"> Continue </PrimaryButton>
            </Link>
        </div>
    </div>
</template>
