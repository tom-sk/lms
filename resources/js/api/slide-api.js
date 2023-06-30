import apiBase from "./api-base";

export default {
    setSlideState(slideId) {
        return apiBase.post("/api/v1/slide/" + slideId);
    },
    getSlideState(payload) {
        return apiBase.get("/api/v1/slide", payload);
    },
};
