<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import ProfileNav from "@/Pages/Profile/Partials/ProfileNav.vue";
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

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Profile
            </h2>
        </template>

        <div class="mx-auto max-w-7xl space-y-6 py-12 sm:px-6 lg:px-8">
            <div class="grid grid-cols-4 gap-4">
                <div class="col-span-1">
                    <div
                        class="sticky top-0 bg-white p-4 shadow sm:rounded-lg sm:p-8"
                    >
                        <ProfileNav />
                    </div>
                </div>
                <div class="col-span-3 space-y-4">
                    <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                        <h2 class="mb-12 text-2xl font-bold">
                            Manage Onboarding Questions
                        </h2>
                        <OnboardForm
                            :reset="false"
                            :post-route="route('profile.onboard.update')"
                            :questions="questions"
                            :answers="answers"
                            button-text="Update"
                        />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
