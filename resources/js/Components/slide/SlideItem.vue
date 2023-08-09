<script setup>
import { CheckIcon } from "@heroicons/vue/20/solid/index.js";
import BardContainer from "@/Components/bard/BardContainer.vue";

import { useSlidesStore } from "@/stores/slides.js";
import SlideNavContainer from "@/Components/slide/SlideNavContainer.vue";

defineProps({
    topic: {
        type: Object,
        required: true,
    },
    slide: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <div
        class="rounded-xl border-2 border-dashed border-green-300 bg-white p-8"
    >
        <h3 class="mb-12 flex text-2xl font-bold">
            <CheckIcon v-if="slide.slide_complete" class="mr-4 h-6 w-6" />

            {{ slide.title }}
        </h3>

        <div>
            <BardContainer
                v-if="slide.content"
                :content="JSON.parse(slide.content)"
            />
        </div>

        <SlideNavContainer :slide="slide" :topic="topic" />
    </div>
</template>
