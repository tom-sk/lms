<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
defineOptions({ layout: AuthenticatedLayout });
import { Head, Link } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";

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
