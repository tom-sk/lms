<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";

defineOptions({ layout: GuestLayout });
</script>

<template>
    <Head title="Register" />

    <div class="grid grid-cols-2 gap-4">
        THis is where the onboard questions will go

        <Link :href="route('dashboard')">
            <PrimaryButton class="mt-4">Dashboard</PrimaryButton>
        </Link>
    </div>
</template>
