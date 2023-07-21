<script setup>
import { StripeElements, StripeElement } from "vue-stripe-js";
import { loadStripe } from "@stripe/stripe-js";
import { ref, onBeforeMount } from "vue";
import { useForm } from "@inertiajs/vue3";
import { useCheckoutStore } from "@/stores/checkout.js";
import { storeToRefs } from "pinia";
const checkoutStore = useCheckoutStore();
const { productId, coupon } = storeToRefs(checkoutStore);

const props = defineProps({
    secret: {
        type: String,
        required: true,
    },
    productId: {
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

const instanceOptions = ref({});

const elementsOptions = ref({
    clientSecret: props.secret,
});
const paymentOptions = ref({
    paymentMethodOrder: ["apple_pay", "google_pay", "card", "klarna"],
});
const stripeLoaded = ref(false);
const payment = ref();
const elms = ref();
const paymentMethod = "";

const form = useForm({
    productId: "",
    coupon: "",
    paymentMethod,
});

const paymentElementSubmit = async () => {
    const elements = elms.value.elements;
    const stripe = elms.value.instance;

    const { setupIntent, error } = await stripe
        .confirmSetup({
            elements,
            redirect: "if_required",
        })
        .then();

    form.productId = props.productId;
    form.paymentMethod = setupIntent.payment_method;
    form.coupon = coupon.value;

    // form.post(route("pay"));
    form.post(route("onboard.payment"));

    // if (error.type === "card_error" || error.type === "validation_error") {
    //     console.log(error.message);
    // } else {
    //     console.log("An unexpected error occurred.");
    // }
};
</script>

<template>
    <form @submit.prevent="paymentElementSubmit">
        <StripeElements
            v-if="stripeLoaded"
            v-slot="{ elements, instance }"
            ref="elms"
            :stripe-key="stripeKey"
            :instance-options="instanceOptions"
            :elements-options="elementsOptions"
        >
            <StripeElement
                ref="payment"
                type="payment"
                :elements="elements"
                :options="paymentOptions"
            />
        </StripeElements>
        <button
            type="submit"
            class="mt-2 w-full rounded-md border border-transparent bg-indigo-600 px-4 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50"
        >
            Pay
        </button>
    </form>
</template>
