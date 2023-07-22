<script setup>
import { useCheckoutStore } from "@/stores/checkout.js";
import { storeToRefs } from "pinia";
import slideApi from "@/api/slide-api";
import { ref } from "vue";
import InputError from "@/Components/InputError.vue";
import InputSuccess from "@/Components/InputSuccess.vue";
const checkoutStore = useCheckoutStore();
const { coupon } = storeToRefs(checkoutStore);

const userCoupon = ref("");

const errorMsg = ref("");
const successMsg = ref("");

const submitCoupon = () => {
    slideApi
        .verifyCoupon({
            userCoupon: userCoupon.value,
        })
        .then((res) => {
            console.log(res);

            if (res.status === 200) {
                coupon.value = res.data.couponID;
                successMsg.value = "Coupon applied!";
                errorMsg.value = "";
            } else {
                errorMsg.value = "Coupon not found";
            }
        })
        .catch((err) => {
            if (
                err.response &&
                err.response.data &&
                err.response.data.message
            ) {
                errorMsg.value = err.response.data.message;
            }
        });
};
</script>

<template>
    coupon: {{ coupon }}
    <div class="mt-4 w-1/3">
        <label for="coupon " class="block text-sm font-medium text-gray-700"
            >Coupon</label
        >
        <div class="mb-12">
            <input
                id="coupon"
                v-model="userCoupon"
                type="text"
                name="coupon"
                autocomplete="email"
                class="mb-4 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
            />

            <InputError :message="error" name="coupon" class="mb-4" />
            <InputSuccess :message="successMsg" name="coupon" class="mb-4" />

            <button
                type="submit"
                class="w-full rounded-md border border-transparent bg-indigo-600 px-4 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50"
                @click="submitCoupon"
            >
                Submit
            </button>
        </div>
    </div>
</template>
