<script setup>
import { StripeElements, StripeElement } from "vue-stripe-js";
import { loadStripe } from "@stripe/stripe-js";
import { ref, onBeforeMount } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    secret: {
        type: String,
        required: true,
    },
});

onBeforeMount(() => {
    const stripePromise = loadStripe(stripeKey.value);
    stripePromise.then(() => {
        stripeLoaded.value = true;
    });
});

const stripeKey = ref(
    "pk_test_51K59QtBmxT5gIh6pYdyliYMQKQtlvl354uJr2jTuXF7wi0r797i8N5M0hPR10OhMQjqY8qCeSEYOLTQPXUtFlI3K00rIhR1XFP"
); // test key

const instanceOptions = ref({
    // https://stripe.com/docs/js/initializing#init_stripe_js-options
});
const elementsOptions = ref({
    // https://stripe.com/docs/js/elements_object/create#stripe_elements-options
});
const cardOptions = ref({
    // https://stripe.com/docs/stripe.js#element-options
    value: {
        postalCode: "12345",
    },
});
const stripeLoaded = ref(false);
const card = ref();
const elms = ref();

const clientSecret = ref(props.secret);

const pay = async () => {
    // Get stripe element
    const cardElement = card.value.stripeElement;
    const stripe = elms.value.instance;
    let paymentMethod = "";

    const { setupIntent, error } = await stripe.confirmCardSetup(props.secret, {
        payment_method: {
            card: cardElement,
            billing_details: { name: "test card name" },
        },
    });

    if (error) {
        // Display "error.message" to the user...
    } else {
        paymentMethod = setupIntent.payment_method;
        // The card has been verified successfully...
    }

    // elms.value.instance.createToken(cardElement).then((result) => {
    //     // Handle result.error or result.token
    //     console.log(result);
    // });

    // router.post("/pay", {
    //     paymentMethod,
    //     card: cardElement,
    //     billing_details: { name: "test card name" },
    // });
};
</script>

<template>
    <StripeElements
        v-if="stripeLoaded"
        v-slot="{ elements, instance }"
        ref="elms"
        :stripe-key="stripeKey"
        :instance-options="instanceOptions"
        :elements-options="elementsOptions"
    >
        <StripeElement ref="card" :elements="elements" :options="cardOptions" />
    </StripeElements>
    <button type="submit">Pay</button>
</template>
