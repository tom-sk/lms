<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
defineOptions({ layout: GuestLayout });
import { Head } from "@inertiajs/vue3";
import CardDetails from "@/Pages/Payments/CardDetails.vue";
import SelectProduct from "@/Pages/Payments/SelectProduct.vue";
import { useCheckoutStore } from "@/stores/checkout";
import { storeToRefs } from "pinia";

const checkoutStore = useCheckoutStore();
const { coupon } = storeToRefs(checkoutStore);

defineProps({
    intent: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <Head title="Modules" />

    <div class="py-12">
        <div class="mx-auto max-w-7xl bg-white p-12 sm:px-6 lg:px-8">
            Subscription page

            <SelectProduct />

            <div class="mt-4 w-1/3">
                <label
                    for="coupon "
                    class="block text-sm font-medium text-gray-700"
                    >Coupon</label
                >
                <div class="mb-12">
                    <input
                        id="coupon"
                        v-model="coupon"
                        type="text"
                        name="coupon"
                        autocomplete="email"
                        class="mb-4 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    />
                    <button
                        type="submit"
                        class="w-full rounded-md border border-transparent bg-indigo-600 px-4 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50"
                    >
                        Submit
                    </button>
                </div>
            </div>

            <CardDetails :secret="intent.client_secret" />
        </div>
    </div>
</template>
