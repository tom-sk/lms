<script setup>
import { Head } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import SingleProductPayment from "@/Components/products/SingleProductPayment.vue";
import TextInput from "@/Components/form/TextInput.vue";

import { useCheckoutStore } from "../stores/checkout";
import { storeToRefs } from "pinia";
const checkoutStore = useCheckoutStore();
const { customerEmail } = storeToRefs(checkoutStore);

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

const formatCurrency = (number) => {
    return new Intl.NumberFormat("en-GB", {
        style: "currency",
        currency: "GBP",
    })
        .format(number)
        .replace(/(\.|,)00$/g, "");
};
</script>

<template>
    <Head title="Product Page" />

    <GuestLayout>
        <div class="py-12">
            <div class="mx-auto flex max-w-7xl flex-col sm:px-6 lg:px-8">
                <div class="mb-8">
                    <div class="mb-12 flex justify-between">
                        <h3 class="text-2xl font-bold">{{ product.title }}</h3>
                        <div>{{ formatCurrency(product.price) }}</div>
                    </div>

                    <TextInput v-model="customerEmail" label="Email" />
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
