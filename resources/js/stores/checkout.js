import { defineStore } from "pinia";
import { ref } from "vue";

export const useCheckoutStore = defineStore("checkout", () => {
    const coupon = ref("");

    const productId = ref("");

    return {
        coupon,
        productId,
    };
});
