<script setup>
import ProfileLayout from "@/Layouts/ProfileLayout.vue";
defineOptions({ layout: ProfileLayout });
import { Head } from "@inertiajs/vue3";
import PurchasedAsset from "@/Pages/Product/PurchasedAsset.vue";

defineProps({
    products: {
        type: Array,
    },
});
</script>

<template>
    <Head title="Profile" />

    <div class="col-span-3 space-y-4">
        <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
            <div v-if="products.length > 0">
                <PurchasedAsset :products="products" />
            </div>
            <div v-else>No products purchases!</div>
        </div>
    </div>
</template>
