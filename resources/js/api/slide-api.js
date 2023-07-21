import apiBase from "./api-base";

export default {
    setSlideState(payload) {
        return apiBase.post("/api/v1/slide", payload);
    },
    verifyCoupon(payload) {
        console.log(payload);
        return apiBase.post("/api/v1/coupon/verify", payload);
    },
};
