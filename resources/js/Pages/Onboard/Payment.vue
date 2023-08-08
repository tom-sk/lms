<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
defineOptions({ layout: GuestLayout });
import { Head } from "@inertiajs/vue3";
import SelectProduct from "@/Pages/Payments/SelectProduct.vue";
import { ref } from "vue";
import CouponVerification from "@/Components/products/CouponVerification.vue";
import SubscriptionCardDetails from "@/Pages/Payments/SubscriptionCardDetails.vue";
import SubStripeCheckout from "@/Components/products/SubStripeCheckout.vue";

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

const productId = ref(props.products[0].id);
</script>

<template>
    <Head title="Modules" />

    <div class="py-12">
        <div class="mx-auto max-w-7xl bg-white p-12 sm:px-6 lg:px-8">
            <SelectProduct
                v-model="productId"
                class="mb-12"
                :products="products"
            />

            <SubStripeCheckout v-if="productId" :product-id="productId" />

            <!--            <CouponVerification />-->

            <!--            <SubscriptionCardDetails-->
            <!--                :product-id="productId"-->
            <!--                :secret="intent.client_secret"-->
            <!--            />-->
        </div>
    </div>
</template>
