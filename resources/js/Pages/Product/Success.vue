<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
defineOptions({ layout: GuestLayout });
import { Head } from "@inertiajs/vue3";

defineProps({
    customer: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <Head title="Modules" />

    <div class="py-12">
        <div class="mx-auto max-w-7xl bg-white p-12 sm:px-6 lg:px-8">
            Purchase Success!

            <div>
                {{ customer }}
            </div>
        </div>
    </div>
</template>
