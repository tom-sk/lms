<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
defineOptions({ layout: GuestLayout });
import { Head } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";

defineProps({
    product: {
        type: Object,
    },
});
</script>

<template>
    <Head title="Modules" />

    <div class="py-12">
        <div class="mx-auto max-w-7xl bg-white p-12 sm:px-6 lg:px-8">
            <a :href="product.asset" target="_blank" download>
                <PrimaryButton>Download</PrimaryButton>
            </a>
            Purchase Success!
        </div>
    </div>
</template>
