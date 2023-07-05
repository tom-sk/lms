import { defineStore } from "pinia";
import { ref } from "vue";

export const useCheckoutStore = defineStore("checkout", () => {
    const coupon = ref("");

    const products = [
        {
            id: 1,
            title: "Essential",
            price: "£4.99",
            strip_id: "price_1K59RIBmxT5gIh6p9bYtrAdY",
        },
        {
            id: 2,
            title: "Premium",
            price: "£15",
            strip_id: "price_1NJhk1BmxT5gIh6pt1UwfQqp",
        },
    ];

    const productId = ref("");

    return {
        coupon,
        productId,
        products,
    };
});
