<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import OnboardForm from "@/Components/form/onboard/OnboardForm.vue";

defineOptions({ layout: GuestLayout });

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
    <Head title="Register" />

    <div class="gap-4">
        <Link :href="route('onboard.questions.step-one')"> back </Link>
        <OnboardForm
            :post-route="route('onboard.questions.step-two')"
            :questions="questions"
            :answers="answers"
        />

        <Link :href="route('dashboard')">
            <PrimaryButton class="mt-4">Dashboard</PrimaryButton>
        </Link>
    </div>
</template>
