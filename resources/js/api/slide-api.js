import apiBase from "./api-base";

export default {
    setSlideState(slideId, payload) {
        return apiBase.post("/api/v1/slide/" + slideId, payload);
    },
};
