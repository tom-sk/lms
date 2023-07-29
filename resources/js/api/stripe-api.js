import apiBase from "./api-base";

export default {
    checkoutSubscription(payload) {
        return apiBase.post("/api/v1/checkout/subscription", payload);
    },
    checkoutProduct(id) {
        return apiBase.post("/api/v1/checkout/product", id);
    },
};
