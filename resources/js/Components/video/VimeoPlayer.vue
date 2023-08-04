<script setup>
import { vueVimeoPlayer } from "vue-vimeo-player";
defineProps({
    videoUrl: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <vue-vimeo-player :video-url="videoUrl" />
</template>

<style>
iframe {
    width: 100% !important;
}
</style>
