import { defineStore } from "pinia";
import { computed, ref } from "vue";
import slideApi from "@/api/slide-api.js";

export const useSlidesStore = defineStore("slides", () => {
    const module = ref(null);
    const topic = ref(null);
    const topics = ref([]);
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

    const setTopics = (newTopics) => {
        topics.value = newTopics;
    };

    const setModule = (mod) => {
        module.value = mod;
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

    const nextTopic = computed(() => {
        const index = topics.value.findIndex((s) => s.id === topic.value.id);

        return topics.value[index + 1];
    });

    return {
        topicSlides,
        slideId,
        activeSlide,
        topics,
        topic,
        module,
        nextTopic,
        setModule,
        setTopics,
        setSlide,
        setAllSlides,
        setSlideAPI,
        setTopic,
    };
});
