<script setup>
import { StripeElements, StripeElement } from "vue-stripe-js";
import { loadStripe } from "@stripe/stripe-js";
import { ref, onBeforeMount } from "vue";
import { useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import { useCheckoutStore } from "../../stores/checkout";
import { storeToRefs } from "pinia";
const checkoutStore = useCheckoutStore();
const { customerEmail } = storeToRefs(checkoutStore);

const props = defineProps({
    productId: {
        type: Number,
        required: true,
    },
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

const paymentMethod = "";

const form = useForm({
    paymentMethod,
    email: customerEmail.value,
    productId: props.productId,
});

const pay = async () => {
    const elements = elms.value.elements;
    const stripe = elms.value.instance;

    const { setupIntent } = await stripe.confirmSetup({
        elements,
        redirect: "if_required",
    });

    form.paymentMethod = setupIntent.payment_method;
    form.email = customerEmail.value;

    form.post(route("single.payment"));
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

    {{ form.errors }}
    <InputError :message="form.errors.password" class="mt-2" />
    <button
        type="submit"
        class="mt-2 w-full rounded-md border border-transparent bg-indigo-600 px-4 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50"
        @click="pay"
    >
        Pay
    </button>
</template>
