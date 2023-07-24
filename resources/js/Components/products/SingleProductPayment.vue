<script setup>
import { StripeElements, StripeElement } from "vue-stripe-js";
import { loadStripe } from "@stripe/stripe-js";
import { ref, onBeforeMount } from "vue";

const props = defineProps({
    secret: {
        type: String,
        required: true,
    },
});

const stripeKey = ref(
    "pk_test_51K59QtBmxT5gIh6pYdyliYMQKQtlvl354uJr2jTuXF7wi0r797i8N5M0hPR10OhMQjqY8qCeSEYOLTQPXUtFlI3K00rIhR1XFP"
); // test key

const elementsOptions = ref({
    clientSecret: props.secret,
});

const stripeLoaded = ref(false);
const payment = ref();
const elms = ref();

onBeforeMount(() => {
    const stripePromise = loadStripe(stripeKey.value);
    stripePromise.then(() => {
        stripeLoaded.value = true;
    });
});

const pay = async () => {
    const elements = elms.value.elements;
    const stripe = elms.value.instance;

    const { setupIntent, error } = await stripe
        .confirmPayment({
            elements,
            redirect: "if_required",
        })
        .then();

    // form.post(route("onboard.payment"));
};
</script>

<template>
    <StripeElements
        v-if="stripeLoaded"
        v-slot="{ elements }"
        ref="elms"
        :stripe-key="stripeKey"
        :elements-options="elementsOptions"
    >
        <StripeElement ref="payment" type="payment" :elements="elements" />
    </StripeElements>
    <button type="button" @click="pay">Pay</button>
</template>
