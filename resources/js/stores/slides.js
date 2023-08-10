import { defineStore } from "pinia";
import { computed, ref } from "vue";
import slideApi from "@/api/slide-api.js";
import { router } from "@inertiajs/vue3";

export const useSlidesStore = defineStore("slides", () => {
    const module = ref(null);
    const topic = ref(null);
    const topics = ref([]);
    const topicSlides = ref([]);
    const slideId = ref(null);
    const moduleProgress = ref(null);

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

    const setProgress = (progress) => {
        moduleProgress.value = progress;
    };

    const setSlideAPI = (currentSlideId, newSlide, complete) => {
        slideApi
            .setSlideState({
                slide_id: currentSlideId,
                slide_complete: complete,
                topic_id: topic.value.id,
            })
            .then((res) => {
                if (nextSlide.value === null && nextTopic.value !== null) {
                    router.get(
                        route("module.topics", {
                            module: module.value.id,
                            topic: nextTopic.value.id,
                        })
                    );
                }

                setAllSlides(res.data.slides);

                if (newSlide && newSlide.id) {
                    setSlide(newSlide.id);
                }
            })
            .catch((err) => {
                console.log(err);
            });
    };

    const nextTopic = computed(() => {
        const index = topics.value.findIndex((s) => s.id === topic.value.id);

        return topics.value[index + 1] ? topics.value[index + 1] : null;
    });

    const nextSlide = computed(() => {
        const index = topicSlides.value.findIndex(
            (s) => s.id === slideId.value
        );

        return topicSlides.value[index + 1]
            ? topicSlides.value[index + 1]
            : null;
    });

    return {
        topicSlides,
        slideId,
        activeSlide,
        topics,
        topic,
        module,
        nextTopic,
        moduleProgress,
        nextSlide,
        setModule,
        setTopics,
        setSlide,
        setAllSlides,
        setSlideAPI,
        setTopic,
        setProgress,
    };
});
