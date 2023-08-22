<script setup>
import SliderContainer from "@/Components/SliderContainer.vue";
import VimeoPlayer from "@/Components/video/VimeoPlayer.vue";
import { ref } from "vue";
const props = defineProps({
    videos: {
        type: Array,
        required: true,
    },
});

const activeVideo = ref(props.videos[0]);
const image = "/storage/" + activeVideo.value.thumbnail;

const setVideo = (video) => {
    activeVideo.value = video;
};
</script>

<template>
    <div class="mb-8 rounded-2xl bg-white p-4">
        <div
            class="bg-cover bg-center"
            :style="{
                backgroundImage: 'url(' + image + ')',
            }"
        >
            <VimeoPlayer class="w-full" :video-url="activeVideo.url" />
        </div>
    </div>

    <SliderContainer :items="videos" @set-item="setVideo" />
</template>
