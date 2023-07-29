<script setup>
import { Head } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import helpers from "@/utils/helpers.js";
import StripeCheckout from "@/Components/products/StripeCheckout.vue";

defineProps({
    product: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <Head title="Product Page" />

    <GuestLayout>
        <div class="py-12">
            <div class="mx-auto flex max-w-7xl flex-col sm:px-6 lg:px-8">
                <div class="mb-8">
                    <div class="mb-12 flex justify-between">
                        <h3 class="text-2xl font-bold">{{ product.title }}</h3>
                        <div>{{ helpers.formatCurrency(product.price) }}</div>
                    </div>
                </div>

                <StripeCheckout :product="product" />
            </div>
        </div>
    </GuestLayout>
</template>
