import { defineStore } from "pinia";
import { ref } from "vue";

export const useCheckoutStore = defineStore("checkout", () => {
    const coupon = ref("");

    const productId = ref("");

    const customerEmail = ref("");

    return {
        customerEmail,
        coupon,
        productId,
    };
});
