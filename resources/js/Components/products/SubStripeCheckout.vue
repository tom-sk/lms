<script setup>
import stripeApi from "@/api/stripe-api.js";
import PrimaryButton from "@/Components/PrimaryButton.vue";

defineProps({
    productId: {
        type: String,
        required: true,
    },
});

const changePageUrl = (id) => {
    stripeApi
        .checkoutSubscription({
            id,
        })
        .then((res) => {
            window.location.href = res.data.url;
        });
};
</script>

<template>
    <PrimaryButton class="w-full" @click="changePageUrl(productId)"
        >Checkout
    </PrimaryButton>
</template>
