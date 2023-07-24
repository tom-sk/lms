<script setup>
import { Head } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import SingleProductPayment from "@/Components/products/SingleProductPayment.vue";

defineProps({
    product: {
        type: Object,
        required: true,
    },
    intent: {
        type: String,
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
                    <h3 class="text-2xl font-bold">Fake cart</h3>
                    {{ product.title }}
                    {{ product.price }}
                </div>

                <!--                <SubscriptionCardDetails-->
                <!--                    :product-id="productId"-->
                <!--                    :secret="intent.client_secret">-->
                <!--                />-->

                <SingleProductPayment
                    :secret="intent.client_secret"
                    :product-id="product.id"
                />
            </div>
        </div>
    </GuestLayout>
</template>
