<script setup>
import { Head } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import stripeApi from "@/api/stripe-api.js";

const props = defineProps({
    product: {
        type: Object,
        required: true,
    },
});

const submit = () => {
    stripeApi
        .checkoutSubscription({
            id: props.product.id,
            title: props.product.title,
            price: props.product.price,
        })
        .then((response) => {
            window.location.href = response.data.url;
        });
};
</script>

<template>
    <Head title="Product Page" />

    <GuestLayout>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                {{ product.title }}
                {{ product.price }}

                <!--                <SubscriptionCardDetails-->
                <!--                    :product-id="productId"-->
                <!--                    :secret="intent.client_secret">-->
                <!--                />-->

                <!--                <SingleProductPayment :secret="secret" />-->

                <button type="button" @click="submit">Pay</button>
            </div>
        </div>
    </GuestLayout>
</template>
