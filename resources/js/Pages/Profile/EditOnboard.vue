<script setup>
import ProfileLayout from "@/Layouts/ProfileLayout.vue";
defineOptions({ layout: ProfileLayout });
import { Head } from "@inertiajs/vue3";
import OnboardForm from "@/Components/form/onboard/OnboardForm.vue";

defineProps({
    answers: {
        type: Array,
        default: () => [],
    },
    questions: {
        type: Array,
        default: () => [],
    },
});
</script>

<template>
    <Head title="Profile" />

    <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
        <h2 class="mb-12 text-2xl font-bold">Manage Onboarding Questions</h2>
        <OnboardForm
            :reset="false"
            :post-route="route('profile.onboard.update')"
            :questions="questions"
            :answers="answers"
            button-text="Update"
        />
    </div>
</template>
