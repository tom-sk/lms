<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
defineOptions({ layout: GuestLayout });
import { Head } from "@inertiajs/vue3";
import SubscriptionCardDetails from "@/Pages/Payments/SubscriptionCardDetails.vue";
import SelectProduct from "@/Pages/Payments/SelectProduct.vue";
import { useCheckoutStore } from "@/stores/checkout";
import CouponVerification from "@/Components/products/CouponVerification.vue";
import { computed, ref } from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

import stripeApi from "@/api/stripe-api";

const props = defineProps({
    intent: {
        type: Object,
        required: true,
    },
    products: {
        type: Array,
        required: true,
    },
});

const productId = ref(props.products[0].stripe_id);

const product = computed(() => {
    return props.products.find(
        (product) => product.stripe_id === productId.value
    );
});

const submit = () => {
    stripeApi
        .checkoutSubscription({
            ...product.value,
        })
        .then((response) => {
            window.location.href = response.data.url;
        });
};
</script>

<template>
    <Head title="Modules" />

    <div class="py-12">
        <div class="mx-auto max-w-7xl bg-white p-12 sm:px-6 lg:px-8">
            Subscription page

            <SelectProduct v-model="productId" :products="products" />

            <CouponVerification />
            <!---->
            <SubscriptionCardDetails
                :product-id="productId"
                :secret="intent.client_secret"
            />
        </div>

        <div class="mx-auto max-w-7xl bg-white p-12 sm:px-6 lg:px-8">
            <!--            <PrimaryButton type="button" @click="submit">Submit</PrimaryButton>-->
        </div>
    </div>
</template>
