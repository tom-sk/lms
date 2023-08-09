import { defineStore } from "pinia";
import { computed, ref } from "vue";
import slideApi from "@/api/slide-api.js";

export const useSlidesStore = defineStore("slides", () => {
    const topic = ref(null);
    const topicSlides = ref([]);
    const slideId = ref(null);

    const setSlide = (slide) => {
        slideId.value = slide;
    };

    const activeSlide = computed(() => {
        return topicSlides.value.find((slide) => slide.id === slideId.value);
    });

    const setAllSlides = (slides) => {
        topicSlides.value = slides;
    };

    const setTopic = (newTopic) => {
        topic.value = newTopic;
    };

    const setSlideAPI = (currentSlideId, newSlide, complete) => {
        if (newSlide && newSlide.id) {
            setSlide(newSlide.id);
        }

        slideApi
            .setSlideState({
                slide_id: currentSlideId,
                slide_complete: complete,
                topic_id: topic.value.id,
            })
            .then((res) => {
                setAllSlides(res.data.slides);
            })
            .catch((err) => {
                console.log(err);
            });
    };

    return {
        topicSlides,
        slideId,
        activeSlide,
        setSlide,
        setAllSlides,
        setSlideAPI,
        setTopic,
    };
});
