<script setup>
import stripeApi from "@/api/stripe-api.js";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
    product: {
        type: Object,
        required: true,
    },
});

const changePageUrl = (id) => {
    stripeApi
        .checkoutProduct({
            id,
        })
        .then((res) => {
            window.location.href = res.data.url;
        });
};
</script>

<template>
    <PrimaryButton class="w-full" @click="changePageUrl(product.id)"
        >Checkout
    </PrimaryButton>
</template>
