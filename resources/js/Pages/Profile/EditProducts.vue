<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import PurchasedAsset from "@/Pages/Product/PurchasedAsset.vue";
import ProfileNav from "@/Pages/Profile/Partials/ProfileNav.vue";

defineProps({
    products: {
        type: Array,
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
                        <div v-if="products.length > 0">
                            <PurchasedAsset :products="products" />
                        </div>
                        <div v-else>No products purchases!</div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
