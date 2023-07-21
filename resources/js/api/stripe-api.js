import apiBase from "./api-base";

export default {
    checkoutSubscription(payload) {
        console.log(payload);
        return apiBase.post("/api/v1/checkout/subscription", payload);
    },
};
